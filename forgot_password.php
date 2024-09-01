<?php
session_start();
include 'db.php';
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = isset($_POST['username']) ? $conn->real_escape_string($_POST['username']) : '';

    // Validate form input
    if (empty($username)) {
        $error = "Username is required.";
    } else {
        // Check if the username exists
        $sql = "SELECT id FROM users WHERE username = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows == 0) {
            $error = "No account found with that username.";
        } else {
            // Generate a unique token for password reset
            $token = bin2hex(random_bytes(50));

            // Store the token in the database (consider expiration)
            $sql = "INSERT INTO password_resets (username, token, expires_at) VALUES ('$username', '$token', NOW() + INTERVAL 1 HOUR)";
            if ($conn->query($sql)) {
                // Here you can either redirect to a confirmation page or show a success message
                // Note: Without email, you cannot send a reset link.
                $success = "A password reset link has been generated (not sent via email).";
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
                <div class="card-header text-center bg-warning text-white">
                    <h2>Forgot Password</h2>
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
                        <button type="submit" class="btn btn-warning btn-block">Send Reset Link</button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <small class="text-muted">Remembered your password? <a href="login.php">Log in here</a>.</small>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>
