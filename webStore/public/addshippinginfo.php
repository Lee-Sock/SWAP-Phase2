<?php

function addshippinginfo($address,$cardnumber,$expiry,$cvc){

    require_once "config.php";
    require_once 'completeCheckout.php';
    
    $con = mysqli_connect("localhost", "root", "", "phase2");
    
    $userQuery = "SELECT userid FROM user WHERE userid = $useridToRetrieve";
    $userResult = mysqli_query($con, $userQuery);

    if (!$userResult || mysqli_num_rows($userResult) == 0) {
        printerror("Error: User with ID $userid does not exist.", $con);
        mysqli_close($con);
        die();
    }

    $query="INSERT INTO shippinginfo (userid,address,cardnumber,expiry,cvc)
        VALUES ('$useridToRetrieve', '$address', '$cardnumber', '$expiry', '$cvc')";
    $result=mysqli_query($con,$query);

    mysqli_close($con);
    header("Location: completeCheckout.php?SUCCESS=1");
    
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<title> add shipping </title>
</head>

<meta charset="utf-8">
<link rel="stylesheet" href="styles.css">

</head>
<body>

</body>


</html>

