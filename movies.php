<!DOCTYPE html>
<html lang="en">
<head>

    <header>
        <div class="logo">
            <h1>Movie paradise</h1>
        </div>
        <nav>
            <ul class="menu">
                
                
                
                <li><a href="logout.php">Logout</a></li>
                
            </ul>
        </nav>
    </header>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Movies</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Available Movies</h1>
    <form id="searchForm">
        <input type="text" id="searchTerm" placeholder="Search by title" required>
        <button type="submit">Search</button>
    </form>
    <div id="movieList"></div>
    <script src="movies.js"></script>
    <script src="search.js"></script>

    <!-- Footer will be inserted here -->
<div id="footer"></div>

<script>
    // Load footer from footer.html
    fetch('footer.html')
        .then(response => response.text())
        .then(data => {
            document.getElementById('footer').innerHTML = data;
        });
</script>
</body>
</html>