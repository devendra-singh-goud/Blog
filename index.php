<?php 
session_start();

// Redirect to login page if not authenticated
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

include('header.php'); 
include 'db.php'; 

$username = $_SESSION['username'];

// Handle search input
$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

// SQL query to fetch posts, filtering by title or content if search is set
$sql = "SELECT id, title, content, created_at FROM posts";
if ($search) {
    $sql .= " WHERE title LIKE '%$search%' OR content LIKE '%$search%'";
}

$result = $conn->query($sql);

if (!$result) {
    die("Error executing query: " . $conn->error);
}
?>

<div class="container mt-5">
    <h1 class="mb-4">Posts</h1>
    <p class="text-right">Logged in as: <strong><?php echo htmlspecialchars($username); ?></strong></p>
    <a href="create.php" class="btn btn-primary mb-3">Add New Post</a>
    <!-- <a href="logout.php" class="btn btn-danger mb-3">Logout</a> Logout button -->

    <!-- Search Form -->
    <form method="GET" action="" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search posts by title or content..." value="<?php echo htmlspecialchars($search); ?>">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </div>
    </form>

    <!-- Posts List -->
    <ul class="list-group">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <li class="list-group-item mb-3 p-4"> <!-- Added margin-bottom and padding classes -->
                    <h2 class="h5"><strong class= "text-primary">Title: </strong> <?php echo htmlspecialchars($row['title']); ?></h2>
                    <p><strong class= "text-primary">Content: </strong><?php echo htmlspecialchars($row['content']); ?></p>
                    <p><small class="text-muted"><strong class= "text-primary">Created at: </strong> <?php echo htmlspecialchars($row['created_at']); ?></small></p>
                    <div class="btn-group" role="group">
                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                        <a href="view.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">View</a> <!-- View button -->
                    </div>
                </li>
            <?php endwhile; ?>
        <?php else: ?>
            <li class="list-group-item">No posts found.</li>
        <?php endif; ?>
    </ul>
</div>

<?php include('footer.php'); ?>
