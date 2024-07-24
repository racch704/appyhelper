<?php
session_start();

// Check if the user is logged in; if not, redirect to the login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Get the username from the session
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'User';

// Set the timezone
date_default_timezone_set('Europe/London');

// Determine the current hour and set the appropriate greeting
$hour = date('H');
$greeting = "Good evening";
if ($hour < 12) {
    $greeting = "Good morning";
} elseif ($hour < 18) {
    $greeting = "Good afternoon";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="home.css">
    <style>
        /* Styling for the logout button */
        .logout-button {
            position: absolute;
            bottom: 20px;
            left: 20px;
            background-color: #dc3545;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
        }
        .logout-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="home-container">
        <div class="animation">
            <!-- Placeholder for animation -->
        </div>
        <h1><?= $greeting ?></h1>
        <!-- Username container -->
        <div class="username" id="username"></div>
        <!-- Links to other pages -->
        <div class="links">
            <a href="checkin.php">Emotional Check-in</a>
            <a href="exercises.php">Mindful Exercises</a>
        </div>
        <!-- Logout button -->
        <a href="logout.php" class="logout-button">Logout</a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the username from the PHP variable
            const username = <?= json_encode($username) ?>;
            // Get the username container element
            const usernameContainer = document.getElementById('username');

            // Loop through each character of the username
            for (let i = 0; i < username.length; i++) {
                // Create a span element for each character
                const span = document.createElement('span');
                span.textContent = username[i];
                // Append the span to the username container
                usernameContainer.appendChild(span);
            }
        });
    </script>
</body>
</html>
