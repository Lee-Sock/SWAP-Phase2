<?php

function updateshippinginfo($address, $cardnumber, $expiry, $cvc)
{
    require_once "config.php";
    require_once 'completeCheckout.php';
    
    function printerror($message, $con)
    {
        echo "<pre>";
        echo "$message<br>";
        if ($con) echo "FAILED: " . mysqli_error($con) . "<br>";
        echo "</pre>";
    }
    
    function printok($message)
    {
        echo "<pre>";
        echo "$message<br>";
        echo "OK<br>";
        echo "</pre>";
    }
    
    try {
        $con = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
    } catch (Exception $e) {
        printerror($e->getMessage(), $con);
    }
    
    if (!$con) {
        printerror("Connecting to $db_hostname", $con);
        die();
    } else {
        printok("Connecting to $db_hostname");
    }
    
    $result = mysqli_select_db($con, $db_database);
    if (!$result) {
        printerror("Selecting $db_database", $con);
        die();
    } else {
        printok("Selecting $db_database");
    }
    
    $userQuery = "SELECT userid FROM user WHERE userid = $useridToRetrieve";
    $userResult = mysqli_query($con, $userQuery);
    
    if (!$userResult || mysqli_num_rows($userResult) == 0) {
        printerror("Error: User with ID $userid does not exist.", $con);
        mysqli_close($con);
        die();
    }
    
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
    
    mysqli_close($con);
    printok("Closing connection");
    header("Location: completeCheckout.php");
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="styles.css">

</head>
<body>

</body>


</html>
