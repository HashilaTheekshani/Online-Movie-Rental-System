<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $release_year = $_POST['release_year'];
    $rating = $_POST['rating'];

    // Load the movies.xml file
    $xml = simplexml_load_file('movies.xml');

    // Create a new movie element
    $newMovie = $xml->addChild('movie');
    $newMovie->addAttribute('id', count($xml->movie) + 1);  // Auto-incremented ID
    $newMovie->addChild('title', $title);
    $newMovie->addChild('genre', $genre);
    $newMovie->addChild('release_year', $release_year);
    $newMovie->addChild('rating', $rating);
    $newMovie->addChild('available', 'true');  // New movie is available

    // Save the updated XML
    $xml->asXML('movies.xml');

    echo "Movie added successfully!";
    header("Location: admin_panel.php");  // Redirect back to admin panel
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Movie</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <h1>Add New Movie</h1>
    <form action="add_movie.php" method="POST">
        <label for="title">Movie Title:</label>
        <input type="text" id="title" name="title" required><br><br>

        <label for="genre">Genre:</label>
        <input type="text" id="genre" name="genre" required><br><br>

        <label for="release_year">Release Year:</label>
        <input type="number" id="release_year" name="release_year" required><br><br>

        <label for="rating">Rating (0-10):</label>
        <input type="number" step="0.1" id="rating" name="rating" required><br><br>

        <button type="submit">Add Movie</button>
    </form>
</body>
</html>
