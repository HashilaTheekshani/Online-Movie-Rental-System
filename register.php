<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Load the users.xml file
    $xml = simplexml_load_file('users.xml');

    // Check if the username already exists
    foreach ($xml->user as $user) {
        if ($user->username == $username) {
            echo "Username already exists!";
            exit(); // Stop execution if the username exists
        }
    }

    // Create a new user element
    $newUser = $xml->addChild('user');
    $newUser->addChild('id', count($xml->user) + 1);
    $newUser->addChild('username', $username);
    $newUser->addChild('password', password_hash($password, PASSWORD_DEFAULT));  // Hash the password
    $newUser->addChild('rentals', '');

    // Save the updated XML
    $xml->asXML('users.xml');

    // Redirect to the login page after successful registration
    header('Location: login.html'); // Change this to your actual login page
    exit(); // Stop further script execution

    
}
?>