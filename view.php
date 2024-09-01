<?php
session_start();
include 'header.php';

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

// Include the database connection
include 'db.php';

// Get the post ID from the URL
$post_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($post_id > 0) {
    // Fetch the post details from the database
    $sql = "SELECT title, content, created_at FROM posts WHERE id = $post_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $post = $result->fetch_assoc();
    } else {
        echo "Post not found.";
        exit;
    }
} else {
    echo "Invalid post ID.";
    exit;
}
?>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h1 class="card-title"><?php echo htmlspecialchars($post['title']); ?></h1>
        </div>
        <div class="card-body">
            <p class="card-text"><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
            <p class="text-muted"><small>Created at: <?php echo htmlspecialchars($post['created_at']); ?></small></p>
            <a href="index.php" class="btn btn-primary">Back to Posts</a>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
