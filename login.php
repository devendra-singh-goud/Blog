
<?php
session_start();
include 'db.php';
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = isset($_POST['username']) ? $conn->real_escape_string($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Query to fetch user data
    $sql = "SELECT id, username, password FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Compare plain text passwords
        if ($password === $user['password']) {
            // Set session variables
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_id'] = $user['id'];

            // Redirect to the index page or wherever necessary
            header('Location: index.php');
            exit;
        } else {
            $error = "Invalid username or password.";
        }
    } else {
        $error = "Invalid username or password.";
    }
}
?>


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center bg-primary text-white">
                    <h2>Login</h2>
                </div>
                <div class="card-body">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger text-center"><?php echo $error; ?></div>
                    <?php endif; ?>
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" name="username" id="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <small class="text-muted">Don't have an account? <a href="register.php">Sign up here</a>.</small>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>
