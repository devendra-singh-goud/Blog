<?php include('header.php'); ?>
<?php
include 'db.php';

$id = $_GET['id'];
$post = $conn->query("SELECT * FROM posts WHERE id = $id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $created_at = $_POST['created_at']; // Get the datetime from the form input

    // Update the post with the user-provided created_at timestamp
    $stmt = $conn->prepare("UPDATE posts SET title = ?, content = ?, created_at = ? WHERE id = ?");
    $stmt->bind_param("sssi", $title, $content, $created_at, $id);

    if ($stmt->execute()) {
        echo "Post updated successfully!";
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<div class="container text-primary mt-5">
    <h1 class="mb-4">Edit Post</h1>
    <form method="POST">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo $post['title']; ?>" required>
        </div>
        <div class="form-group">
            <label for="content">Content:</label>
            <textarea class="form-control" id="content" name="content" rows="5" required><?php echo $post['content']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="created_at">Created At:</label>
            <input type="datetime-local" class="form-control" id="created_at" name="created_at" value="<?php echo date('Y-m-d\TH:i', strtotime($post['created_at'])); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">View Posts</a>
    </form>
</div>
   
<?php include('footer.php'); ?>
