<?php
session_start();
include 'db.php';
include 'header.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Verify the token
    $stmt = $conn->prepare("SELECT username FROM password_resets WHERE token = ? AND expires_at > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $new_password = isset($_POST['password']) ? $_POST['password'] : '';
            $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';

            // Validate form inputs
            if (empty($new_password) || empty($confirm_password)) {
                $error = "All fields are required.";
            } elseif ($new_password !== $confirm_password) {
                $error = "Passwords do not match.";
            } else {
                // Hash the new password
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                // Update the password in the database
                $stmt->close();
                $stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = (SELECT username FROM password_resets WHERE token = ?)");
                $stmt->bind_param("ss", $hashed_password, $token);
                $stmt->execute();

                // Delete the token
                $stmt = $conn->prepare("DELETE FROM password_resets WHERE token = ?");
                $stmt->bind_param("s", $token);
                $stmt->execute();

                $success = "Your password has been reset successfully.";
            }
        }
    } else {
        $error = "Invalid or expired token.";
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center bg-info text-white">
                    <h2>Reset Password</h2>
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
                            <label for="password">New Password:</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password:</label>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-info btn-block">Reset Password</button>
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
