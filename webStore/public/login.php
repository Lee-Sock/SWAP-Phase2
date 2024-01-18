<?php
require 'config.php';

session_start();

if (isset($_SESSION["login"]) && $_SESSION["login"]) {
    header("Location: usermain.php");
    exit();
}

if (isset($_POST["submit"])) {
    $usernameemail = $_POST["usernameemail"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM user WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $usernameemail, $usernameemail);
    $stmt->execute();
    
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row["password"])) {
            $_SESSION["login"] = true;
            $_SESSION["userid"] = $row["userid"];
            header("Location: usermain.php");
            exit();
        } else {
            $error_message = 'Wrong Password';
        }
    } else {
        $error_message = 'User Not Registered';
    }
}
?>


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

        <?php if (isset($error_message)): ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <br>
        <a href="registration.php">Registration</a>
    </div>
</body>
</html>




