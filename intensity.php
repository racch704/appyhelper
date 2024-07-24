<?php
session_start();

// Check if the user is logged in; if not, redirect to the login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Handle form submission and selected intensity
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['intensity_value']) && $_POST['intensity_value'] !== '') {
        // Store the selected intensity in the session
        $_SESSION['intensity_value'] = $_POST['intensity_value'];
        // Redirect to the text input page
        header("Location: textinput.php");
        exit;
    } else {
        // Set error message if no intensity level is selected
        $error = 'Please select an intensity level before proceeding.';
    }
}

// Set the current progress step in the session
$_SESSION['progress_step'] = 2;

// Retrieve the selected intensity from the session if it exists
$intensity_value = isset($_SESSION['intensity_value']) ? $_SESSION['intensity_value'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Intensity Check</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="checkin.css">
    <style>
        /* Styling for the slider container */
        .slider-container {
            position: relative;
            width: 100%;
        }
        /* Styling for the slider labels */
        .slider-labels {
            display: flex;
            justify-content: space-between;
            position: absolute;
            top: -25px;
            width: 100%;
            padding: 0 10px;
        }
        /* Styling for the slider lines */
        .slider-lines {
            position: absolute;
            top: 10px;
            width: 100%;
            display: flex;
            justify-content: space-between;
        }
        .slider-line {
            height: 10px;
            width: 1px;
            background-color: black;
        }
        /* Styling for the slider thumb */
        .custom-range::-webkit-slider-thumb {
            width: 20px; /* Larger clickable area */
            height: 20px; /* Larger clickable area */
            background: #007bff;
            border-radius: 50%;
            cursor: pointer;
            -webkit-appearance: none;
            appearance: none;
            margin-top: -6px; /* Center the thumb */
        }
        .custom-range::-moz-range-thumb {
            width: 20px; /* Larger clickable area */
            height: 20px; /* Larger clickable area */
            background: #007bff;
            border-radius: 50%;
            cursor: pointer;
        }
        .custom-range::-ms-thumb {
            width: 20px; /* Larger clickable area */
            height: 20px; /* Larger clickable area */
            background: #007bff;
            border-radius: 50%;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container checkin-container">
        <h2>Intensity Check</h2>
        <p>How intense is your feeling?</p>
        <!-- Display error message if no intensity level is selected -->
        <?php if ($error): ?>
            <div class="alert alert-danger" role="alert">
                <?= $error ?>
            </div>
        <?php endif; ?>
        <!-- Progress bar -->
        <div class="progress" style="height: 20px;">
            <div class="progress-bar" role="progressbar" style="width: 66%;" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <!-- Intensity selection form -->
        <form method="POST" action="intensity.php">
            <div class="slider-container mt-4">
                <div class="slider-labels">
                    <span>0</span>
                    <span>5</span>
                    <span>10</span>
                </div>
                <div class="slider-lines">
                    <?php for ($i = 0; $i <= 10; $i++): ?>
                        <div class="slider-line"></div>
                    <?php endfor; ?>
                </div>
                <input type="range" class="form-range custom-range" min="0" max="10" step="1" id="intensityRange" name="intensity_value" value="<?= $intensity_value ?>">
                <div id="rangeValue" class="mt-2">Intensity: <?= $intensity_value !== '' ? $intensity_value : '0' ?></div>
            </div>
            <div class="buttons-container justify-content-between mt-4">
                <a href="checkin.php" class="btn btn-secondary">Back</a>
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
        // Get the intensity range input and range value display elements
        const intensityRange = document.getElementById('intensityRange');
        const rangeValue = document.getElementById('rangeValue');

        // Update the displayed intensity value when the slider is moved
        intensityRange.addEventListener('input', function() {
            rangeValue.textContent = `Intensity: ${intensityRange.value}`;
        });
    </script>
</body>
</html>
