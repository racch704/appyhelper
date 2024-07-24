<?php
session_start();

// Check if the user is logged in; if not, redirect to the login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Get the selected emotion from the session
$selected_emoji = isset($_SESSION['selected_emoji']) ? $_SESSION['selected_emoji'] : '';

// Set the message based on the selected emotion
switch ($selected_emoji) {
    case 'happy':
        $message = "Here's a joke to keep you smiling: Why don’t scientists trust atoms? Because they make up everything!";
        break;
    case 'sad':
        $message = "We are sorry that you are feeling down. Remember, it's okay to have bad days. Take care of yourself.";
        break;
    case 'calm':
        $message = "Here's an inspirational message: 'The greatest glory in living lies not in never falling, but in rising every time we fall.' - Nelson Mandela";
        break;
    case 'anxious':
        $message = "It's okay to feel anxious sometimes. Take deep breaths and try to relax. You are stronger than you think.";
        break;
    case 'angry':
        $message = "It's understandable to feel angry. Take a moment to cool down. It's okay to express your feelings in a healthy way.";
        break;
    default:
        $message = "Thank you for checking in. We hope you have a great day!";
        break;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Unset session variables to reset user inputs
    unset($_SESSION['selected_emoji']);
    unset($_SESSION['intensity_value']);
    unset($_SESSION['user_text']);
    unset($_SESSION['progress_step']);
    // Redirect to the home page
    header("Location: home.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Thank You</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="checkin.css">
    <!-- Canvas Confetti JS -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.4.0/dist/confetti.browser.min.js"></script>
</head>
<body>
    <div class="container checkin-container">
        <h2>Thank You</h2>
        <p>Your check-in is complete. Here is a message for you:</p>
        <!-- Display the message based on the selected emotion -->
        <div class="alert alert-info mt-4" role="alert">
            <?= $message ?>
        </div>
        <div class="text-center mt-4">
            <form method="POST" action="tada.php">
                <!-- Done button to submit the form and reset session variables -->
                <button type="submit" class="btn btn-primary" id="doneButton">Done</button>
            </form>
        </div>
    </div>
    <!-- Completion Chime -->
    <audio id="completionChime" src="completion-chime.mp3" preload="auto"></audio>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Confetti effect
            confetti({
                particleCount: 100,
                spread: 70,
                origin: { y: 0.6 }
            });
        });
    </script>
</body>
</html>
