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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
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

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php include('footer.php'); ?>
