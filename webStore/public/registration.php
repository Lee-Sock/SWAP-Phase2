<?php 
// Include the configuration file
require_once 'config.php';

// Check if the user is already logged in, redirect to addtocart.php
if(isset($_SESSION["login"]) && $_SESSION["login"] === true){
    header("Location: addtocart.php");
    exit();
}

// Handle user registration form submission
if(isset($_POST["submit"])){
    // Get user registration form data
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $phoneno = $_POST["phoneno"];

    // Check for duplicate entries in the database
    $duplicate = mysqli_query($conn, "SELECT * FROM user
                                      WHERE username = '$username'
                                      OR email = '$email'
                                      OR phoneno = '$phoneno'");
    
    // Display an alert if there are duplicate entries
    if (mysqli_num_rows($duplicate) > 0) {
        echo "<script> alert('Username or Email or PhoneNo Is Already Taken'); </script>";
    } else {
        // Insert user data into the user table
        $query = "INSERT INTO user VALUES('', '$email','$password','$username','$firstname','$lastname','$phoneno')";
        mysqli_query($conn, $query);

        // Retrieve the user ID of the registered user
        $query2 = $conn->prepare("SELECT * FROM user WHERE username = ?");
        $query2->bindValue(1, $username); // Bind the parameters
        $query2->execute();
        $resultUserid = $query2->fetchAll();

        // Insert a corresponding record into the cart table for the registered user
        foreach ($resultUserid as $row){
            $query3 = $conn->prepare("INSERT INTO `cart` (`cartid`, `userid`) VALUES (?,?)");
            $query3->bind_param('ss', $row["userid"], $row["userid"]); // Bind the parameters

            // Execute the query
            if ($query3->execute()){
                echo "";
            } else {
                echo "Error executing query.";
            }
        }

        // Display a success message for successful registration
        echo "<script> alert('Registration Successful'); </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Registration</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body style="font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;">

    <div style="background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;">

        <h1>Registration</h1>
        
        <form action="" method="post" autocomplete="off"
              style="display: flex; flex-direction: column; align-items: center;">
            <!-- Input fields for user registration -->
            <!-- ... (your existing HTML code) ... -->
            <button type="submit" name="submit">Register</button>
        </form>

        <br>
        <!-- Links for login and admin login pages -->
        <a href="login.php">Login</a> <br><br>
        <a href="adminlogin.php">Login as admin</a>
        
    </div>
</body>
</html>
