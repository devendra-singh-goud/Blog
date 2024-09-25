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
    // Fetch the post details along with the creator's username
    $sql = "SELECT posts.title, posts.content, posts.created_at, users.username 
            FROM posts 
            JOIN users ON posts.user_id = users.id 
            WHERE posts.id = $post_id";

    // Debugging: Print the SQL query
    // echo $sql; // Uncomment to see the SQL query for debugging

    $result = $conn->query($sql);

    // Check for query execution errors
    if ($result === false) {
        echo "Error: " . $conn->error;
        exit;
    }

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

<div class="container m-5">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><strong class="text-primary">Title: </strong> <?php echo htmlspecialchars($post['title']); ?></h3>
        </div>
        <div class="card-body">
            <p class="card-text"><strong class="text-primary">Content: </strong> <?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
            <p class="text-muted"><small><strong class="text-primary">Created by: </strong> <?php echo htmlspecialchars($post['username']); ?></small></p>
            <p class="text-muted"><small><strong class="text-primary">Created at: </strong> <?php echo htmlspecialchars($post['created_at']); ?></small></p>
            <a href="index.php" class="btn btn-outline-primary">Back to Posts</a>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
