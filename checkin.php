<?php
session_start();

// Check if the user is logged in; if not, redirect to the login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Handle form submission and selected emoji
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['selected_emoji']) && !empty($_POST['selected_emoji'])) {
        // Store the selected emoji in the session
        $_SESSION['selected_emoji'] = $_POST['selected_emoji'];
        $_SESSION['from_checkin'] = true;
        // Redirect to the intensity selection page
        header("Location: intensity.php");
        exit;
    } else {
        // Set error message if no emoji is selected
        $error = 'Please select an emotion before proceeding.';
    }
}

// Set the current progress step in the session
$_SESSION['progress_step'] = 1;

// Retrieve the selected emoji from the session if it exists
$selected_emoji = isset($_SESSION['selected_emoji']) ? $_SESSION['selected_emoji'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Emotional Check-in</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="checkin.css">
</head>
<body>
    <div class="container checkin-container">
        <h2>Emotional Check-in</h2>
        <p>How are you feeling today?</p>
        <!-- Display error message if no emoji is selected -->
        <?php if ($error): ?>
            <div class="alert alert-danger" role="alert">
                <?= $error ?>
            </div>
        <?php endif; ?>
        <!-- Progress bar -->
        <div class="progress" style="height: 20px;">
            <div class="progress-bar" role="progressbar" style="width: 33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <!-- Emoji selection form -->
        <form method="POST" action="checkin.php">
            <div class="row justify-content-center">
                <div class="col-auto emoji-item <?= $selected_emoji == 'happy' ? 'selected' : '' ?>" onclick="selectEmoji(this, 'happy')">
                    <div class="emoji">😊</div>
                    <div class="emoji-text">Happy</div>
                </div>
                <div class="col-auto emoji-item <?= $selected_emoji == 'sad' ? 'selected' : '' ?>" onclick="selectEmoji(this, 'sad')">
                    <div class="emoji">😢</div>
                    <div class="emoji-text">Sad</div>
                </div>
                <div class="col-auto emoji-item <?= $selected_emoji == 'calm' ? 'selected' : '' ?>" onclick="selectEmoji(this, 'calm')">
                    <div class="emoji">😌</div>
                    <div class="emoji-text">Calm</div>
                </div>
                <div class="col-auto emoji-item <?= $selected_emoji == 'anxious' ? 'selected' : '' ?>" onclick="selectEmoji(this, 'anxious')">
                    <div class="emoji">😟</div>
                    <div class="emoji-text">Anxious</div>
                </div>
                <div class="col-auto emoji-item <?= $selected_emoji == 'angry' ? 'selected' : '' ?>" onclick="selectEmoji(this, 'angry')">
                    <div class="emoji">😡</div>
                    <div class="emoji-text">Angry</div>
                </div>
            </div>
            <input type="hidden" name="selected_emoji" id="selectedEmoji" value="<?= $selected_emoji ?>">
            <div class="buttons-container justify-content-end">
                <button type="submit" class="btn btn-primary">Next</button>
            </div>
        </form>
        <!-- Home button -->
        <div class="home-button-container text-center mt-3">
            <a href="home.php" class="home-icon"><i class="fas fa-home"></i></a>
        </div>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Function to handle emoji selection
        function selectEmoji(element, emoji) {
            // Remove 'selected' class from all emoji items
            const items = document.querySelectorAll('.emoji-item');
            items.forEach(item => item.classList.remove('selected'));

            // Add 'selected' class to the clicked emoji item
            element.classList.add('selected');

            // Set the hidden input value to the selected emoji
            document.getElementById('selectedEmoji').value = emoji;
        }
    </script>
</body>
</html>
