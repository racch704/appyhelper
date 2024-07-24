<?php
session_start();

// Check if the user is logged in; if not, redirect to the login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mindful Exercises</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="home.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Styling for the exercise container */
        .exercise-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }
        /* Styling for each exercise item */
        .exercise-item {
            margin: 20px 0;
        }
        .exercise-item img {
            width: 100px;
            height: auto;
            margin-bottom: 10px;
        }
        /* Styling for the exercise links */
        .exercise-item a {
            display: block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            width: 300px;
            margin: 0 auto;
        }
        .exercise-item a:hover {
            background-color: #0056b3;
        }
        /* Styling for the buttons container */
        .buttons-container {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }
        /* Styling for the home button container */
        .home-button-container {
            margin-top: 20px;
        }
        /* Styling for the home icon */
        .home-icon {
            color: #007bff;
            font-size: 24px;
            text-decoration: none;
        }
        .home-icon:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container exercise-container">
        <h2>Mindful Exercises</h2>
        <div class="exercise-item">
            <h3>Yoga</h3>
            <!-- Yoga image -->
            <!-- <img src="https://i.imgur.com/lrV9gH9.png" alt="Yoga"> -->
            <p>Enjoy a list of children's yoga videos</p>
            <a href="yoga.php">Go to Yoga Videos</a>
        </div>
        <div class="exercise-item">
            <h3>Meditation</h3>
            <!-- Meditation image -->
            <!-- <img src="https://i.imgur.com/kUayxHy.png" alt="Meditation"> -->
            <p>Explore guided meditation videos</p>
            <a href="meditation.php">Go to Meditation Videos</a>
        </div>
        <div class="buttons-container">
            <!-- Back button to return to the home page -->
            <a href="home.php" class="btn btn-secondary">Back</a>
        </div>
        <div class="home-button-container text-center mt-3">
            <!-- Home button to return to the home page -->
            <a href="home.php" class="home-icon"><i class="fas fa-home"></i></a>
        </div>
    </div>
</body>
</html>
