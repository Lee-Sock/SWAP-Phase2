<?php
require 'config.php';

session_start();

// Check if the admin is not logged in, redirect to adminlogin.php
if (!isset($_SESSION['adminLogin']) || $_SESSION['adminLogin'] !== true) {
    header("Location: adminlogin.php");
    exit();
}

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
if (!empty($_SESSION["adminId"])) {
    $adminId = $_SESSION["adminId"];
    // You can fetch additional admin details here if needed
} else {
    header("Location: adminlogin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Index</title>
</head>
<body>
    <h1>Welcome <?php echo $adminId; ?></h1>
    <a href="logout.php">Logout</a>
    <br>
    <br>
    <a href='adminInventory.php'>Manage Inventory</a>
    <br>
    <br>
    <a href='userdelete.php'>Delete Users</a>
    <br>
    <br>
</body>
</html>
