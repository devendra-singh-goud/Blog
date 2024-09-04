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

// Set the number of posts per page
$postsPerPage = 5;

// Get the current page number from the query string, default to 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

// Calculate the offset for the SQL query
$offset = ($page - 1) * $postsPerPage;

// SQL query to fetch the total number of posts (for pagination calculation)
$sqlCount = "SELECT COUNT(*) as total FROM posts";
if ($search) {
    $sqlCount .= " WHERE title LIKE '%$search%' OR content LIKE '%$search%'";
}
$resultCount = $conn->query($sqlCount);
$totalPosts = $resultCount->fetch_assoc()['total'];
$totalPages = ceil($totalPosts / $postsPerPage);

// SQL query to fetch posts for the current page
$sql = "SELECT id, title, content, created_at FROM posts";
if ($search) {
    $sql .= " WHERE title LIKE '%$search%' OR content LIKE '%$search%'";
}
$sql .= " LIMIT $postsPerPage OFFSET $offset";

$result = $conn->query($sql);

if (!$result) {
    die("Error executing query: " . $conn->error);
}
?>

<div class="d-flex">
    <!-- Main Content -->
    <div class="content flex-grow-1">
        <h1 class="mb-4">Posts</h1>

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
        <div class="row">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-primary"><?php echo htmlspecialchars($row['title']); ?></h5>

                                <?php
                                $content = explode(' ', $row['content']);
                                if (count($content) > 5) {
                                    $shortContent = implode(' ', array_slice($content, 0, 5)) . '...';
                                    $fullContent = implode(' ', $content);
                                } else {
                                    $shortContent = $fullContent = implode(' ', $content);
                                }
                                ?>

                                <p class="card-text">
                                    <span class="short-content"><?php echo htmlspecialchars($shortContent); ?></span>
                                    <span class="full-content d-none"><?php echo htmlspecialchars($fullContent); ?></span>
                                </p>

                                <?php if (count($content) > 5): ?>
                                    <button class="btn btn-outline-primary btn-sm read-more">Read More</button>
                                    <button class="btn btn-outline-primary btn-sm d-none read-less">Show Less</button>
                                <?php endif; ?>

                                <p class="card-text"><small class="text-muted">Created at: <?php echo htmlspecialchars($row['created_at']); ?></small></p>
                                <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                                <a href="view.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">View</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-md-12">
                    <div class="alert alert-warning" role="alert">No posts found.</div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <nav>
            <ul class="pagination justify-content-center">
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($search); ?>">Previous</a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($search); ?>">Next</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function() {
    $('.read-more').click(function() {
        var cardBody = $(this).closest('.card-body');
        cardBody.find('.short-content').addClass('d-none');
        cardBody.find('.full-content').removeClass('d-none');
        $(this).addClass('d-none');
        cardBody.find('.read-less').removeClass('d-none');
    });

    $('.read-less').click(function() {
        var cardBody = $(this).closest('.card-body');
        cardBody.find('.full-content').addClass('d-none');
        cardBody.find('.short-content').removeClass('d-none');
        $(this).addClass('d-none');
        cardBody.find('.read-more').removeClass('d-none');
    });
});
</script>
</body>
</html>

<?php include('footer.php'); ?>
