<?php include('header.php'); ?>
<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $created_at = $_POST['created_at']; // Get the datetime from the form input

    // Insert the post with the user-provided created_at timestamp
    $stmt = $conn->prepare("INSERT INTO posts (title, content, created_at) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $content, $created_at);

    if ($stmt->execute()) {
        echo "New post created successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<h1>Create Post</h1>
<form method="POST">
    <label>Title:</label><br>
    <input type="text" name="title" required><br><br>
    <label>Content:</label><br>
    <textarea name="content" required></textarea><br><br>
    <label>Created At:</label><br>
    <input type="datetime-local" name="created_at" required><br><br> <!-- Datetime input field -->
    <input type="submit" value="Submit">
</form>
<a href="index.php">View Posts</a>
<?php include('footer.php'); ?>