<?php include('header.php'); ?>
<?php
include 'db.php';

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "Post deleted successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
header("Location: index.php");
exit();
?>
<?php include('footer.php'); ?>
