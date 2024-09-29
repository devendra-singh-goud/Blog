<?php
session_start();
include 'db.php';
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = isset($_POST['username']) ? $conn->real_escape_string($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Query to fetch user data including email and profile picture
    $sql = "SELECT id, username, email, password, profile_picture FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Compare plain text passwords (stored directly in the database)
        if ($password === $user['password']) {
            // Set session variables
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email']; // Store email in session
            $_SESSION['profile_picture'] = $user['profile_picture']; // Store profile picture in session

            // Redirect to the index page
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

<div class="container lll mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card text-white">
                <div class="card-header text-center">
                    <h3 class="mt-3">Sign In</h3>
                </div>
                <div class="card-body">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger text-center"><?php echo $error; ?></div>
                    <?php endif; ?>
                    <form method="POST" action="">
                        <div class="form-group">
                            <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn btn-outline-danger btn-block">Sign In</button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <div class="text-muted">New to Blog? <a href="register.php">Sign up now</a>.</div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
