<?php
require 'config.php';

// Start the session
session_start();

// Check if the user is already logged in, redirect to addtocart.php
if (isset($_SESSION["login"]) && $_SESSION["login"]) {
    header("Location: addtocart.php");
    exit();
}

// Your login logic here
if (isset($_POST["submit"])) {
    $usernameemail = $_POST["usernameemail"];
    $password = $_POST["password"];
    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$usernameemail' OR email = '$usernameemail'");
    $row = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) > 0) {
        if (password_verify($password, $row["password"])) {
            $_SESSION["login"] = true;
            $_SESSION["userid"] = $row["userid"];
            // Redirect only after successful login
            header("Location: usermain.php");
            exit();
        } else {
            echo "<script> alert('Wrong Password'); </script>";
        }
    } else {
        echo "<script> alert ('User Not Registered'); </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="styles.css">
    <title>Login</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f0f0f0; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0;">
<div style="background-color: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); text-align: center;">


    <h2>Login</h2>
   
     <form action="" method="post" autocomplete="off" style="display: flex; flex-direction: column; align-items: center;">
     <div style="display: flex; flex-direction: row; align-items: center; margin-bottom: 10px;">
        <label for="usernameemail" style="width: 120px;">Username or Email :</label>
        <input type="text" name="usernameemail" id="usernameemail" required value="">
     </div>
     <div style="display: flex; flex-direction: row; align-items: center; margin-bottom: 10px;">
     
        <label for="password" style="width: 120px;">Password</label>
        <input type="password" name="password" id="password" required value="">
      </div>
        <button type="submit" name="submit">Login</button>
    </form>
    <br>
    <a href="registration.php">Registration</a>
</body>
</html>



