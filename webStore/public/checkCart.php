<!DOCTYPE html>

<html lang="en" dir="ltr">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="styles.css">

</head>
<body>

</body>





<?php

//connect to database
require_once "config.php";
require_once 'index1.php';

//getting cartid
$query= $con->prepare("SELECT * FROM cart WHERE userid = ?");
$query->bindValue(1,$userid); //bind the parameters
$query -> execute();
$resultCartid = $query->fetchALL();
foreach ($resultCartid as $row) {
    $cartid = $row["cartid"];
};

//getting all items in cart
$query= $con->prepare("SELECT * FROM cartitem WHERE cartid = ?");
$query->bindValue(1,$cartid); //bind the parameters
$query->execute();
$resultItems = $query->fetchALL(PDO::FETCH_ASSOC);

//checking if items are too many
foreach ($resultItems as $row) {
    $query= $con->prepare("SELECT quantity FROM `inventory` WHERE itemid = ?");
    $query->bindValue(1,$row['itemid']); //bind the parameters
    $query->execute();
    $maxQuantity = $query->fetchAll();
    if ($row['itemquantity'] > $maxQuantity[0]['quantity']){
        header("Location: checkout.php");
        ?>
        <html>
     	<script>alert("please make sure cart is not more than inventory");</script>
        </html>
        <?php
        exit();
    }
}

header("Location: completeCheckout.php");


?>

