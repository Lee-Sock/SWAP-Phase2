<?php 
require_once 'config.php';
require_once 'index1.php';

$message = '';

$itemId = isset($_GET['ID']) ? $_GET['ID'] : null;
$itemQuantity = isset($_GET['AMOUNT']) ? $_GET['AMOUNT'] : null;


$checkIfExists = $con->query("SELECT * FROM cartitem WHERE cartid IN (SELECT cartid FROM cart WHERE userid = $userid) AND itemid = $itemId");

if ($checkIfExists->rowCount() > 0) {
    // Item is already in the cart, update the quantity
    $con->query("UPDATE cartitem SET itemquantity = itemquantity + $itemQuantity WHERE cartid IN (SELECT cartid FROM cart WHERE userid = $userid) AND itemid = $itemId");
    $message = "Item updated in the cart successfully.";
} else {
    // Item is not in the cart, insert a new row
    $cartIdResult = $con->query("SELECT * FROM cart WHERE userid = $userid");
    $cartIdRow = $cartIdResult->fetch(PDO::FETCH_ASSOC);
    
    if ($cartIdRow) {
        $cartId = $cartIdRow['cartid'];
        
        $insertCartItem = $con->prepare("INSERT INTO cartitem (cartid, itemid, itemquantity) VALUES (?, ?, ?)");
        if ($insertCartItem->execute([$cartId, $itemId, $itemQuantity])) {
            $message = "Item added to the cart successfully.";
        } else {
            // Handle the error, e.g., log it or display a user-friendly message
            $message = "Error adding item to cart: " . $insertCartItem->errorInfo()[2];
        }
    } else {
        $message = "Error: Unable to retrieve cart ID.";
    }
}

header("Location: userInventory.php?SUCCESS=1")

?>