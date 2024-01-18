<?php
// Include the configuration file
require 'config.php';

// Start the session
session_start();

// Check if the user is not logged in, redirect to login.php
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php");
    exit();
}

// Prevent caching of the page
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");

// Check if the userid is set in the session
if (!empty($_SESSION["userid"])) {
    // Retrieve user information using the userid
    $userid = $_SESSION["userid"];
    $result = mysqli_query($conn, "SELECT * FROM user WHERE userid = '$userid'");
    $row = mysqli_fetch_assoc($result);
} else {
    // If userid is not set, redirect to login.php
    header("Location: login.php");
}

// Function to log output to the console
function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Index</title>
    <!-- Include your CSS file here -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php include 'navbar.php'; ?>

<!-- Your existing HTML content goes here -->

</body>
</html>




