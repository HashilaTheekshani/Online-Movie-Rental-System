<?php
if (isset($_GET['id'])) {
    $movieId = $_GET['id'];

    // Load the movies.xml file
    $xml = simplexml_load_file('movies.xml');

    // Find the index of the movie to be deleted
    $index = 0;
    foreach ($xml->movie as $movie) {
        if ($movie['id'] == $movieId) {
            unset($xml->movie[$index]);
            break;
        }
        $index++;
    }

    // Save the updated XML
    $xml->asXML('movies.xml');

    echo "Movie deleted successfully!";
    header("Location: admin_panel.php");
} else {
    die("No movie ID provided.");
}
?>
