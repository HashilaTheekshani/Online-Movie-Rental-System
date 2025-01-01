<?php
session_start();

if (!isset($_SESSION['username'])) {
    die("Please log in to rent a movie.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $movieId = $_POST['movie_id'];
    $username = $_SESSION['username'];

    // Load the users.xml file
    $usersXml = simplexml_load_file('users.xml');

    // Find the logged-in user
    foreach ($usersXml->user as $user) {
        if ($user->username == $username) {
            // Add a new rental entry for the user
            $rental = $user->rentals->addChild('rental');
            $rental->addChild('movie_id', $movieId);
            $rental->addChild('rented_on', date("Y-m-d"));
            $rental->addChild('returned', 'false');
            break;
        }
    }

    // Save the updated users.xml file
    $usersXml->asXML('users.xml');

    // Load the movies.xml file and mark the movie as unavailable
    $moviesXml = simplexml_load_file('movies.xml');

    foreach ($moviesXml->movie as $movie) {
        if ($movie['id'] == $movieId) {
            $movie->available = 'false';
            break;
        }
    }

    // Save the updated movies.xml file
    $moviesXml->asXML('movies.xml');

    echo "Movie rented successfully!";
}
?>
