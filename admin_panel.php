<?php
session_start();

// Simple admin check for demonstration purposes
if (!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] !== true) {
    die("Access denied: Admins only");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <h1>Admin Panel</h1>
    <nav>
        <a href="add_movie.php">Add Movie</a>
        <a href="view_rentals.php">View User Rentals</a>
        <a href="Admin_logout.php">Logout</a>
    </nav>

    <h2>Manage Movies</h2>
    <ul id="movieList">
        <!-- Movie list will be dynamically loaded here -->
    </ul>

    <script src="admin.js"></script>
</body>
</html>
