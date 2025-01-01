<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Load the users.xml file
    $xml = simplexml_load_file('users.xml');

    // Find the user by username
    foreach ($xml->user as $user) {
        if ($user->username == $username && password_verify($password, $user->password)) {
            $_SESSION['username'] = $username;
            echo "Login successful!";
            header("Location: movies.html");  // Redirect to movies page
            exit();
        }
    }
    echo "Invalid username or password.";
}
?>
