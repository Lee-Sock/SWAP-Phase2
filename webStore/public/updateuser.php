<?php
require 'config.php';

session_start();

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php");
    exit();
}

// Fetch user information
if (!empty($_SESSION["userid"])) {
    $userid = $_SESSION["userid"];
    $result = mysqli_query($conn, "SELECT * FROM user WHERE userid = '$userid'");
    $row = mysqli_fetch_assoc($result);
} else {
    header("Location: login.php");
    exit();
}

// Handle form submission
if (isset($_POST["update"])) {
    $newUsername = $_POST["newUsername"];
    $newFirstName = $_POST["newFirstName"];
    $newLastName = $_POST["newLastName"];
    $newPhoneNo = $_POST["newPhoneNo"];
    $newPassword = $_POST["newPassword"];

    // Check if the new information is different from the existing information
    if (
        $newUsername !== $row['username'] ||
        $newFirstName !== $row['firstname'] ||
        $newLastName !== $row['lastname'] ||
        $newPhoneNo !== $row['phoneno']
    ) {
        // Check if the new username is already in use
        $checkUsernameQuery = "SELECT * FROM user WHERE username = '$newUsername' AND userid != '$userid'";
        $checkUsernameResult = mysqli_query($conn, $checkUsernameQuery);

        if (mysqli_num_rows($checkUsernameResult) > 0) {
            $message = 'Username already in use. Please choose a different one.';
        } else {
            // Validate and update the user information
            $passwordUpdate = !empty($newPassword) ? ", password = '" . password_hash($newPassword, PASSWORD_DEFAULT) . "'" : "";

            $updateQuery = "UPDATE user SET username = '$newUsername', firstname = '$newFirstName', lastname = '$newLastName', phoneno = '$newPhoneNo' $passwordUpdate WHERE userid = '$userid'";

            if (mysqli_query($conn, $updateQuery)) {
                $message = 'User information updated successfully.';
                // Fetch updated user information
                $result = mysqli_query($conn, "SELECT * FROM user WHERE userid = '$userid'");
                $row = mysqli_fetch_assoc($result);
            } else {
                $message = 'Error updating user information: ' . mysqli_error($conn);
            }
        }
    } else {
        $message = 'No changes made to the user information.';
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="styles.css">
    <title>Update User Information</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f0f0f0; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0;">
    <div style="background-color: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); text-align: center;">

        <h2>Update User Information</h2>

        <?php if (isset($message)): ?>
            <p style="color: <?php echo (strpos($message, 'Error') !== false) ? 'red' : 'green'; ?>"><?php echo $message; ?></p>
        <?php endif; ?>

        <form action="" method="post" autocomplete="off" style="display: flex; flex-direction: column; align-items: center;">
            <div style="display: flex; flex-direction: row; align-items: center; margin-bottom: 10px;">
                <label for="newUsername" style="width: 120px;">New Username:</label>
                <input type="text" name="newUsername" id="newUsername" required value="<?php echo $row['username']; ?>">
            </div>
            <div style="display: flex; flex-direction: row; align-items: center; margin-bottom: 10px;">
                <label for="newFirstName" style="width: 120px;">New First Name:</label>
                <input type="text" name="newFirstName" id="newFirstName" required value="<?php echo $row['firstname']; ?>">
            </div>
            <div style="display: flex; flex-direction: row; align-items: center; margin-bottom: 10px;">
                <label for="newLastName" style="width: 120px;">New Last Name:</label>
                <input type="text" name="newLastName" id="newLastName" required value="<?php echo $row['lastname']; ?>">
            </div>
            <div style="display: flex; flex-direction: row; align-items: center; margin-bottom: 10px;">
                <label for="newPhoneNo" style="width: 120px;">New Phone Number:</label>
                <input type="text" name="newPhoneNo" id="newPhoneNo" required value="<?php echo $row['phoneno']; ?>">
            </div>
            <div style="display: flex; flex-direction: row; align-items: center; margin-bottom: 10px;">
                <label for="newPassword" style="width: 120px;">New Password:</label>
                <input type="password" name="newPassword" id="newPassword" value="">
            </div>
            <button type="submit" name="update">Update</button>
        </form>

        <br>
        <a href="usermain.php">Back to User Main Page</a>
    </div>
</body>
</html>


