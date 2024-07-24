<?php
session_start();

// Check if the user is logged in; if not, redirect to the login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Example array for meditation videos
$videos = [
    [
        'title' => "Meditation for Kids: Peaceful Mind",
        'description' => "Join us for a calming meditation session to relax your mind.",
        'thumbnail' => "https://img.youtube.com/vi/1ZYbU82GVz4/hqdefault.jpg",
        'videoId' => "1ZYbU82GVz4"
    ],
    [
        'title' => "Meditation for Kids: Body Scan",
        'description' => "Practice body scan meditation to become aware of your body.",
        'thumbnail' => "https://img.youtube.com/vi/ihwcw_ofuME/hqdefault.jpg",
        'videoId' => "ihwcw_ofuME"
    ],
    [
        'title' => "Meditation for Kids: Sleep Meditation",
        'description' => "A guided meditation to help kids fall asleep.",
        'thumbnail' => "https://img.youtube.com/vi/Bk_qU7l-fcU/hqdefault.jpg",
        'videoId' => "Bk_qU7l-fcU"
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Meditation Videos</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="home.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Styling for the video container */
        .video-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }
        /* Styling for each video item */
        .video-item {
            display: flex;
            align-items: center;
            margin: 20px 0;
        }
        .video-item img {
            max-width: 120px;
            margin-right: 20px;
        }
        .video-item div {
            flex-grow: 1;
        }
        /* Styling for the play button */
        .video-item button {
            padding: 10px 20px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .video-item button:hover {
            background-color: #218838;
        }
        /* Styling for the modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            position: relative;
            margin: 10% auto;
            padding: 20px;
            width: 80%;
            max-width: 700px;
            background-color: #fff;
            border-radius: 8px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
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
    <div class="container video-container">
        <h2>Children's Meditation Videos</h2>
        <?php foreach ($videos as $video): ?>
            <div class="video-item">
                <img src="<?= $video['thumbnail'] ?>" alt="Thumbnail">
                <div>
                    <h3><?= $video['title'] ?></h3>
                    <p><?= $video['description'] ?></p>
                </div>
                <button class="play-button" data-video-id="<?= $video['videoId'] ?>">Play</button>
            </div>
        <?php endforeach; ?>
        <div class="buttons-container">
            <!-- Back button to return to the exercises page -->
            <a href="exercises.php" class="btn btn-secondary">Back</a>
        </div>
        <div class="home-button-container text-center mt-3">
            <!-- Home button to return to the home page -->
            <a href="home.php" class="home-icon"><i class="fas fa-home"></i></a>
        </div>
    </div>

    <!-- The Modal -->
    <div id="videoModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div id="videoPlayer"></div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modal = document.getElementById("videoModal");
            var videoPlayer = document.getElementById("videoPlayer");
            var buttons = document.querySelectorAll('.play-button');

            buttons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var videoId = button.getAttribute('data-video-id');
                    videoPlayer.innerHTML = '<iframe width="100%" height="400" src="https://www.youtube.com/embed/' + videoId + '" frameborder="0" allowfullscreen></iframe>';
                    modal.style.display = "block";
                });
            });

            function closeModal() {
                modal.style.display = "none";
                videoPlayer.innerHTML = "";
            }

            document.querySelector('.close').addEventListener('click', closeModal);

            window.onclick = function(event) {
                if (event.target == modal) {
                    closeModal();
                }
            };
        });
    </script>
</body>
</html>
