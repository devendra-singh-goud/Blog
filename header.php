<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="mystyle.css">
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="sidebar flex-shrink-0">
            <!-- <a href="#" class="navbar-brand mt-4">Blog</a> -->
            <a class="nav-link navbar-brand mt-4" href="index.php">Blog</a>
            <ul class="nav flex-column">
                <?php if (isset($_SESSION['username'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="create.php">Add New Post</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                    <li class="nav-item">
                        <span class="text-muted badge  ">Logged in as: <strong class="text-white  font-italic"><?php echo htmlspecialchars($_SESSION['username']); ?></strong></span>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>

        <!-- End Sidebar -->

        <!-- Main Content -->
        <div class="content flex-grow-1">