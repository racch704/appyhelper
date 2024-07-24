<?php
session_start();

// Predefined usernames and passwords
$users = [
    "user" => "password",
    "Ella" => "password",
    "Jacob" => "password",
];

$error = "";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate credentials
    if (array_key_exists($username, $users) && $password == $users[$username]) {
        // Set session variable to indicate the user is logged in
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        // Redirect to the home page
        header("Location: home.php");
        exit;
    } else {
        // Set error message for incorrect credentials
        $error = "Incorrect username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Styling for the login container */
        .login-container {
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }
        /* Full-height container to center the login form */
        .full-height {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>
<div class="container full-height">
    <div class="login-container col-md-6 col-lg-4">
        <h2>Login</h2>
        <!-- Login form -->
        <form action="login.php" method="post">
            <div class="mb-3">
                <input type="text" class="form-control" name="username" placeholder="Username" required>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <!-- Display error message if credentials are incorrect -->
            <p class="error mt-3 text-danger"><?php if(isset($error)) echo $error; ?></p>
        </form>
    </div>
</div>
</body>
</html>
