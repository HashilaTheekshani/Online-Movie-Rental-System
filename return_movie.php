<?php
session_start();

if (!isset($_SESSION['username'])) {
    die("Please log in to return a movie.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $movieId = $_POST['movie_id'];
    $username = $_SESSION['username'];

    // Load the users.xml file
    $usersXml = simplexml_load_file('users.xml');

    // Find the logged-in user
    foreach ($usersXml->user as $user) {
        if ($user->username == $username) {
            // Find the rental entry and mark it as returned
            foreach ($user->rentals->rental as $rental) {
                if ($rental->movie_id == $movieId && $rental->returned == 'false') {
                    $rental->returned = 'true';
                    break;
                }
            }
            break;
        }
    }

    // Save the updated users.xml file
    $usersXml->asXML('users.xml');

    // Load the movies.xml file and mark the movie as available
    $moviesXml = simplexml_load_file('movies.xml');

    foreach ($moviesXml->movie as $movie) {
        if ($movie['id'] == $movieId) {
            $movie->available = 'true';
            break;
        }
    }

    // Save the updated movies.xml file
    $moviesXml->asXML('movies.xml');

    echo "Movie returned successfully!";
}
?>
