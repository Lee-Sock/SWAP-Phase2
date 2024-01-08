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
            header("Location: addtocart.php");
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
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form class="" action="" method="post" autocomplete="off">
        <label for="usernameemail">Username or Email :</label>
        <input type="text" name="usernameemail" id="usernameemail" required value=""> <br>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required value=""> <br>
        <button type="submit" name="submit">Login</button>
    </form>
    <br>
    <a href="registration.php">Registration</a>
</body>
</html>



