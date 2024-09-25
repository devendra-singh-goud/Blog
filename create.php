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
    $created_at = $_POST['created_at'];

    // Server-side validation for minimum 6 words in content
    $word_count = str_word_count($content);

    if ($word_count < 6) {
        echo "<div class='alert alert-danger'>Error: Content must contain at least 6 words.</div>";
    } else {
        // Insert the post with the user-provided created_at timestamp
        $stmt = $conn->prepare("INSERT INTO posts (title, content, created_at) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $title, $content, $created_at);

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
                <div class="mb-3">
                    <label for="created_at" class="form-label">Created At:</label>
                    <input type="datetime-local" name="created_at" id="created_at" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-outline-primary">Submit</button>
            </form>
            <a href="index.php" class="btn btn-link mt-3">View Posts</a>
        </div>
    </div>
</div>

<script src="index.js"></script>
<?php include('footer.php'); ?>
