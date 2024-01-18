<?php

// Function to update shipping information in the database
function updateshippinginfo($address, $cardnumber, $expiry, $cvc)
{
    // Include necessary configuration and functions
    require_once "config.php";
    require_once 'completeCheckout.php';
    
    // Function to print error messages
    function printerror($message, $con)
    {
        echo "<pre>";
        echo "$message<br>";
        if ($con) echo "FAILED: " . mysqli_error($con) . "<br>";
        echo "</pre>";
    }
    
    // Function to print success messages
    function printok($message)
    {
        echo "<pre>";
        echo "$message<br>";
        echo "OK<br>";
        echo "</pre>";
    }
    
    // Attempt to establish a connection to the database
    try {
        $con = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
    } catch (Exception $e) {
        printerror($e->getMessage(), $con);
    }
    
    // Check if the connection was successful
    if (!$con) {
        printerror("Connecting to $db_hostname", $con);
        die();
    } else {
        printok("Connecting to $db_hostname");
    }
    
    // Select the specified database
    $result = mysqli_select_db($con, $db_database);
    if (!$result) {
        printerror("Selecting $db_database", $con);
        die();
    } else {
        printok("Selecting $db_database");
    }
    
    // Check if the user with the specified ID exists
    $userQuery = "SELECT userid FROM user WHERE userid = $useridToRetrieve";
    $userResult = mysqli_query($con, $userQuery);
    
    // If user does not exist, print an error and terminate
    if (!$userResult || mysqli_num_rows($userResult) == 0) {
        printerror("Error: User with ID $userid does not exist.", $con);
        mysqli_close($con);
        die();
    }
    
    // Update shipping information if the corresponding field is not empty
    if ($address !== "") {
        $query = "UPDATE shippinginfo SET address = '$address' WHERE userid = $useridToRetrieve";
        $result = mysqli_query($con, $query);
        if (!$result) {
            printerror("Error updating address", $con);
            die();
        } else {
            printok($query);
        }
    }
    
    if ($cardnumber !== "") {
        $query = "UPDATE shippinginfo SET cardnumber = '$cardnumber' WHERE userid = $useridToRetrieve";
        $result = mysqli_query($con, $query);
        if (!$result) {
            printerror("Error updating cardnumber", $con);
            die();
        } else {
            printok($query);
        }
    }
    
    if ($expiry !== "") {
        $query = "UPDATE shippinginfo SET expiry = '$expiry' WHERE userid = $useridToRetrieve";
        $result = mysqli_query($con, $query);
        if (!$result) {
            printerror("Error updating expiry", $con);
            die();
        } else {
            printok($query);
        }
    }
    
    if ($cvc !== "") {
        $query = "UPDATE shippinginfo SET cvc = '$cvc' WHERE userid = $useridToRetrieve";
        $result = mysqli_query($con, $query);
        if (!$result) {
            printerror("Error updating cvc", $con);
            die();
        } else {
            printok($query);
        }
    }
    
    // Close the database connection
    mysqli_close($con);
    printok("Closing connection");
    
    // Redirect to the specified page on successful update
    header("Location: completeCheckout.php?SUCCESS=2");
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <!-- Meta charset and external stylesheet link -->
    <meta charset="utf-8">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Body content can be added as needed -->
</body>

</html>

