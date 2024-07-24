<?php
session_start();

// Check if the user is logged in; if not, redirect to the login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Set the current progress step in the session
$_SESSION['progress_step'] = 3;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Text Input</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="checkin.css">
</head>
<body>
    <div class="container checkin-container">
        <h2>Text Input</h2>
        <p>Please describe your feeling in a few words:</p>
        <!-- Progress bar indicating the completion of steps -->
        <div class="progress" style="height: 20px;">
            <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <!-- Text input form for user to describe their feelings -->
        <form method="POST" action="home.php">
            <textarea class="form-control mt-4" rows="5" name="user_text" placeholder="Type your message here..."></textarea>
            <div class="buttons-container justify-content-between mt-4">
                <!-- Back button to return to the intensity selection page -->
                <a href="intensity.php" class="btn btn-secondary">Back</a>
                <!-- Submit button to proceed to the next page -->
                <a href="tada.php" type="submit" class="btn btn-primary">Submit</a>
            </div>
        </form>
        <!-- Home button to return to the home page -->
        <div class="home-button-container text-center mt-3">
            <a href="home.php" class="home-icon"><i class="fas fa-home"></i></a>
        </div>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
