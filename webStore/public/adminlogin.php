<?php
require 'config.php';

// Start the session
session_start();

// Check if the admin is already logged in, redirect to index2.php
if (isset($_SESSION["adminLogin"]) && $_SESSION["adminLogin"]) {
    header("Location: adminview.php");
    exit();
}

// Handle admin login form submission
if (isset($_POST["submit"])) {
    $adminId = $_POST["adminId"];
    $password = $_POST["password"];

    // Use prepared statement to prevent SQL injection
    $query = $conn->prepare("SELECT * FROM admin WHERE adminId = ?");
    $query->bind_param("s", $adminId);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if ($password == $row["password"]) {
            // Set session variables
            $_SESSION["adminLogin"] = true;
            $_SESSION["adminId"] = $row["adminId"];

            // Redirect after successful login
            header("Location: adminview.php");
            exit();
        } else {
            echo "<script>alert('Wrong Password');</script>";
        }
    } else {
        echo "<script>alert('Admin Not Registered');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body style="font-family: Arial, sans-serif; background-color: #f0f0f0; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0;">
    <div style="background-color: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); text-align: center;">
        <h2>Admin Login</h2>
        <form action="" method="post" autocomplete="off" style="display: flex; flex-direction: column; align-items: center;">
            <div style="display: flex; flex-direction: row; align-items: center; margin-bottom: 10px;">
                <label for="adminId" style="width: 120px;">Admin ID :</label>
                <input type="text" name="adminId" id="adminId" required value="">
            </div>
            <div style="display: flex; flex-direction: row; align-items: center; margin-bottom: 10px;">
                <label for="password" style="width: 120px;">Password</label>
                <input type="password" name="password" id="password" required value="">
            </div>
            <button type="submit" name="submit">Login</button>
        </form>
        <br>
        <a href="registration.php">Not an admin? Register here</a>
    </div>
</body>
</html>


