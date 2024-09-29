<?php
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


// Handling form submission for profile update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch the new username and email from the form
    $newUsername = htmlspecialchars($_POST['username']);
    $newEmail = htmlspecialchars($_POST['email']);

    // Handle profile picture upload
    if (!empty($_FILES['profile_picture']['name'])) {
        $targetDir = "uploads/profile_pictures/";
        $targetFile = $targetDir . basename($_FILES["profile_picture"]["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Allow only image file types
        $validExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($imageFileType, $validExtensions)) {
            move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $targetFile);
            $_SESSION['profile_picture'] = basename($_FILES["profile_picture"]["name"]);
        }
    }

    // Update session with new username and email
    $_SESSION['username'] = $newUsername;
    $_SESSION['email'] = $newEmail;

    // In a real application, update the database with new data
    // Update user details in the database...
    
    // Redirect to profile page after updating
    header("Location: profile.php");
    exit();
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Profile</h3>
                </div>
                <div class="card-body">
                    <form action="edit_profile.php" method="POST" enctype="multipart/form-data">
                        <!-- Username Field -->
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($userData['username']); ?>" required>
                        </div>

                        <!-- Email Field -->
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($userData['email']); ?>" required>
                        </div>

                        <!-- Profile Picture Upload -->
                        <div class="form-group">
                            <label for="profile_picture">Profile Picture</label><br>
                            <img src="uploads/profile_pictures/<?php echo htmlspecialchars($userData['profile_picture']); ?>" class="rounded-circle mb-3" width="100" height="100" alt="Profile Picture">
                            <input type="file" class="form-control-file" id="profile_picture" name="profile_picture">
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-outline-primary">Save Changes</button>
                        <a href="profile.php" class="btn btn-outline-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
