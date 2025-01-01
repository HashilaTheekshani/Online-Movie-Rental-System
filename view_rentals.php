<?php
// Load the users.xml file
$usersXml = simplexml_load_file('users.xml');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View User Rentals</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <h1>User Rentals</h1>
    <ul>
        <?php foreach ($usersXml->user as $user): ?>
            <li>
                <strong>User:</strong> <?php echo $user->username; ?><br>
                <strong>Rentals:</strong>
                <ul>
                    <?php foreach ($user->rentals->rental as $rental): ?>
                        <li>Movie ID: <?php echo $rental->movie_id; ?> (Rented on: <?php echo $rental->rented_on; ?>)</li>
                    <?php endforeach; ?>
                </ul>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
