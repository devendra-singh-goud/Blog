<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #121212; /* Dark background */
            color: white; /* Text color */
        }
        .sidebar {
            background-color: #181818; /* Sidebar background */
            min-height: 100vh; /* Full height */
            padding: 20px;
        }
        .sidebar .nav-link {
            color: #b3b3b3; /* Link color */
        }
        .sidebar .nav-link:hover {
            color: white; /* Hover effect */
        }
        .content {
            padding: 20px; /* Content padding */
        }
        .card {
            background-color: #282828; /* Card background */
            border: none; /* Remove border */
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="sidebar flex-shrink-0">
            <a href="#" class="navbar-brand mt-4">Blog</a>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <?php if (isset($_SESSION['username'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="create.php">Add New Post</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                    <li class="nav-item">
                        <span class="text-muted">Logged in as: <strong class="text-info"><?php echo htmlspecialchars($_SESSION['username']); ?></strong></span>
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
