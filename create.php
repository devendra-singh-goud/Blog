<?php
session_start();
include('header.php');
include 'db.php';

// Redirect to login page if the user is not authenticated
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id']; // Get the logged-in user's ID

    // Server-side validation for minimum 6 words in content
    $word_count = str_word_count($content);

    if ($word_count < 6) {
        echo "<div class='alert alert-danger'>Error: Content must contain at least 6 words.</div>";
    } else {
        // Automatically set the current timestamp for created_at
        $created_at = date('Y-m-d H:i:s'); // MySQL DATETIME format

        // Insert the post with the user ID and the automatically generated created_at timestamp
        $stmt = $conn->prepare("INSERT INTO posts (title, content, created_at, user_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $title, $content, $created_at, $user_id);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>New post created successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
        }

        $stmt->close();
    }
}
?>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Create Post</h5>
        </div>
        <div class="card-body">
            <form method="POST" id="postForm">
                <div class="mb-3">
                    <label for="title" class="form-label">Title:</label>
                    <input type="text" name="title" id="title" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Content:</label>
                    <textarea name="content" id="content" class="form-control" required></textarea>
                    <div id="content-error" style="color: red;"></div>
                </div>
                <!-- Removed Created At field -->
                <button type="submit" class="btn btn-outline-primary">Submit</button>
            </form>
            <a href="index.php" class="btn btn-link mt-3">View Posts</a>
        </div>
    </div>
</div>

<script src="index.js"></script>
<?php include('footer.php'); ?>
