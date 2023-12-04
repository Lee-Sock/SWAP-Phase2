<!DOCTYPE html>

<?php

//connect to database
require_once 'database.php';

//get userid
$userid = 1;

//getting cartid
$query= $con->prepare("SELECT * FROM cart WHERE userid = ?");
$query->bindValue(1,$userid); //bind the parameters
$query -> execute();
$resultCartid = $query->fetchALL();
//$cartid = $resultCartid['cartid'] ;
foreach ($resultCartid as $row) {
    $cartid = $row["cartid"];
};
console_log($cartid);

//getting all items in cart
$query= $con->prepare("SELECT * FROM cartitem WHERE cartid = ?");
$query->bindValue(1,$cartid); //bind the parameters
$query->execute();
$resultItems = $query->fetchALL(PDO::FETCH_ASSOC);
console_log($resultItems);

//checking if items are too many
foreach ($resultItems as $row) {
    $query= $con->prepare("SELECT quantity FROM `inventory` WHERE itemid = ?");
    $query->bindValue(1,$row['itemid']); //bind the parameters
    $query->execute();
    $maxQuantity = $query->fetchAll();
    console_log($row['itemid']);
    console_log($maxQuantity);
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

