<?php
session_start();
include 'db.php';
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = isset($_POST['username']) ? $conn->real_escape_string($_POST['username']) : '';
    $email = isset($_POST['email']) ? $conn->real_escape_string($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';

    // Validate form inputs
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $error = "All fields are required.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // Check if the username or email already exists
        $sql = "SELECT id FROM users WHERE username = '$username' OR email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $error = "Username or email already exists. Please choose a different one.";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert the new user into the database
            $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
            if ($conn->query($sql)) {
                $success = "Registration successful! You can now <a href='login.php'>log in</a>.";
            } else {
                $error = "Error: " . $conn->error;
            }
        }
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center bg-success text-white">
                    <h2>Register</h2>
                </div>
                <div class="card-body">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger text-center"><?php echo $error; ?></div>
                    <?php endif; ?>
                    <?php if (isset($success)): ?>
                        <div class="alert alert-success text-center"><?php echo $success; ?></div>
                    <?php endif; ?>
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" name="username" id="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password:</label>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success btn-block">Register</button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <small class="text-muted">Already have an account? <a href="login.php">Log in here</a>.</small>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>
