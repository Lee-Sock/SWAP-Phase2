<?php
require_once 'config.php';

session_start();

if (isset($_SESSION["login"]) && $_SESSION["login"]) {
    header("Location: usermain.php");
    exit();
}

if (isset($_SESSION['login_attempts']) && $_SESSION['login_attempts'] >= 5) {
    $remainingTime = $_SESSION['lockout_time'] - time();

    if ($remainingTime > 0) {
        $error_message = 'Too many failed login attempts. Please try again after ' . $remainingTime . ' seconds.';
        exit();
    } else {
        unset($_SESSION['login_attempts']);
        unset($_SESSION['lockout_time']);
    }
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
            unset($_SESSION['login_attempts']);
            unset($_SESSION['lockout_time']);
            header("Location: usermain.php");
            exit();
        } else {
            $_SESSION['login_attempts'] = isset($_SESSION['login_attempts']) ? $_SESSION['login_attempts'] + 1 : 1;
            $error_message = 'Wrong Password';
        }
    } else {
        $_SESSION['login_attempts'] = isset($_SESSION['login_attempts']) ? $_SESSION['login_attempts'] + 1 : 1;
        $error_message = 'User Not Registered';
    }

    // Lock the user out for 10 minutes after 5 failed attempts
    if ($_SESSION['login_attempts'] >= 5) {
        $_SESSION['lockout_time'] = time() + 60; // Lockout for 600 seconds (10 minutes)
        $error_message = 'Too many failed login attempts. Account locked. Please try again after 10 minutes.';
        exit();
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

        <?php if (isset($error_message)): ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <br>
        <a href="registration.php">Registration</a>
    </div>
</body>
</html>

