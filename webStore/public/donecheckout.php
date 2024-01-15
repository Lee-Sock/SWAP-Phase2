<?php

//connect to database
require_once "config.php";
require_once 'index1.php';
// Sample data, replace it with actual data

//getting cartid
$query= $con->prepare("SELECT * FROM cart WHERE userid = ?");
$query->bindValue(1,$userid); //bind the parameters
$query -> execute();
$resultCartid = $query->fetchALL();
//$cartid = $resultCartid['cartid'] ;
foreach ($resultCartid as $row) {
    $cartid = $row["cartid"];
};

//getting all items in cart
$query= $con->prepare("SELECT * FROM cartitem WHERE cartid = ?");
$query->bindValue(1,$cartid); //bind the parameters
$query->execute();
$resultItems = $query->fetchALL(PDO::FETCH_ASSOC);


// Iterate through cart items and update inventory in the database


$query = $con->prepare("DELETE FROM cartitem WHERE cartid = ?");
$query->bindValue(1,$cartid);//bind the parameters
$query->execute();



foreach ($resultItems as $item) {
    $query2 = $con->prepare("SELECT * FROM inventory WHERE itemid = ?");
    $query2->bindValue(1, $item['itemid']); //bind the parameters
    $query2->execute();
    $resultInventory = $query2 ->fetchALL(PDO::FETCH_ASSOC);
    console_log($resultInventory);
    console_log($item);
    $newQuantity = $resultInventory[0]['quantity'] - $item['itemquantity'];
    $query = $con->prepare("UPDATE inventory SET quantity = ? WHERE itemid = ?");
    $query->execute([$newQuantity, $item['itemid']]);
    
}
// Redirect back to index.php
header('Location: userInventory.php?DELETE=1');
exit;
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

