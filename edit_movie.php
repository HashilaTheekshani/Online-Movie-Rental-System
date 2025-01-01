<?php
if (isset($_GET['id'])) {
    $movieId = $_GET['id'];

    // Load the movies.xml file
    $xml = simplexml_load_file('movies.xml');

    // Find the movie by ID
    foreach ($xml->movie as $movie) {
        if ($movie['id'] == $movieId) {
            $title = $movie->title;
            $genre = $movie->genre;
            $release_year = $movie->release_year;
            $rating = $movie->rating;
            break;
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Update movie details
        $movie->title = $_POST['title'];
        $movie->genre = $_POST['genre'];
        $movie->release_year = $_POST['release_year'];
        $movie->rating = $_POST['rating'];

        // Save the updated XML
        $xml->asXML('movies.xml');

        echo "Movie updated successfully!";
        header("Location: admin_panel.php");
    }
} else {
    die("No movie ID provided.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Movie</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <h1>Edit Movie</h1>
    <form action="edit_movie.php?id=<?php echo $movieId; ?>" method="POST">
        <label for="title">Movie Title:</label>
        <input type="text" id="title" name="title" value="<?php echo $title; ?>" required><br><br>

        <label for="genre">Genre:</label>
        <input type="text" id="genre" name="genre" value="<?php echo $genre; ?>" required><br><br>

        <label for="release_year">Release Year:</label>
        <input type="number" id="release_year" name="release_year" value="<?php echo $release_year; ?>" required><br><br>

        <label for="rating">Rating (0-10):</label>
        <input type="number" step="0.1" id="rating" name="rating" value="<?php echo $rating; ?>" required><br><br>

        <button type="submit">Update Movie</button>
    </form>
</body>
</html>
