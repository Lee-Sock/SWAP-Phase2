<?php

// Function to add shipping information to the database
function addshippinginfo($address, $cardnumber, $expiry, $cvc)
{
    // Include necessary configuration and functions
    require_once "config.php";
    require_once 'completeCheckout.php';
    
    // Establish a connection to the database
    $con = mysqli_connect("localhost", "root", "", "phase2");
    
    // Check if the user with the specified ID exists
    $userQuery = "SELECT userid FROM user WHERE userid = $useridToRetrieve";
    $userResult = mysqli_query($con, $userQuery);
    
    // If user does not exist, print an error and terminate
    if (!$userResult || mysqli_num_rows($userResult) == 0) {
        printerror("Error: User with ID $userid does not exist.", $con);
        mysqli_close($con);
        die();
    }
    
    // Insert shipping information into the 'shippinginfo' table
    $query = "INSERT INTO shippinginfo (userid, address, cardnumber, expiry, cvc)
              VALUES ('$useridToRetrieve', '$address', '$cardnumber', '$expiry', '$cvc')";
    $result = mysqli_query($con, $query);
    
    // Close the database connection
    mysqli_close($con);
    
    // Redirect to the specified page on successful insertion
    header("Location: completeCheckout.php?SUCCESS=1");
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <!-- Title for the HTML document -->
    <title>add shipping</title>
</head>

<!-- Meta charset and external stylesheet link -->
<meta charset="utf-8">
<link rel="stylesheet" href="styles.css">

<body>
    <!-- Body content can be added as needed -->
</body>

</html>


