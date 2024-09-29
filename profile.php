<?php
// Start session to access session variables
session_start();
include 'header.php';

// Check if user is logged in, if not redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Mock user data for demonstration (In a real application, retrieve these from the database)
$userData = [
    'username' => $_SESSION['username'],
    'email' => isset($_SESSION['email']) ? $_SESSION['email'] : '', // Provide a default value if email is not set
    'profile_picture' => !empty($_SESSION['profile_picture']) ? $_SESSION['profile_picture'] : 'default.jpg'
];

?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card text-center">
                <div class="card-header">
                    <h3><?php echo htmlspecialchars($userData['username']); ?>'s Profile</h3>
                </div>
                <div class="card-body">
                    <!-- Display Profile Picture -->
                    <img src="uploads/profile_pictures/<?php echo htmlspecialchars($userData['profile_picture']); ?>" class="rounded-circle mb-3" width="150" height="150" alt="Profile Picture">

                    <!-- Display Username -->
                    <h5>Username: <strong><?php echo htmlspecialchars($userData['username']); ?></strong></h5>

                    <!-- Display Email -->
                    <p>Email: <strong><?php echo htmlspecialchars($userData['email']); ?></strong></p>
                    
                    <!-- Edit Profile and Logout Buttons -->
                    <a href="edit_profile.php" class="btn btn-outline-primary">Edit Profile</a>
                    <a class="btn btn-outline-success " href="index.php">Home</a>
                    <a href="logout.php" class="btn btn-outline-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
