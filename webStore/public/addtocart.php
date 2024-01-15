<?php

require_once 'config.php';
require_once 'index1.php';


// Handle form submission
$message = ''; // Initialize an empty message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $itemId = $_POST["itemid"];
    $itemQuantity = $_POST["quantity"];
    
    // Check if the item is already in the cart for the user
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
}

// Fetch item details from the inventory table
$inventoryQuery = $con->query("SELECT itemid, itemname FROM inventory");
$inventoryItems = $inventoryQuery->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add to Cart</title>
    
</head>
<body>

<h2>Add Item to Cart</h2>

<?php
// Display the message
echo $message;
?>

<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <label for="itemid">Select Item:</label>
    <select name="itemid" id="itemid">
        <?php
        foreach ($inventoryItems as $row) { ?>
            <option value="<?= isset($row["itemid"]) ? $row["itemid"] : '' ?>">
                <?= isset($row["itemname"]) ? $row["itemname"] : '' ?>
            </option>
        <?php } ?>
    </select><br>

    <label for="quantity">Quantity:</label>
    <input type="number" name="quantity" id="quantity" min="1" value="1"><br>

    <button type="submit">Add to Cart</button>
    <a href='checkout.php'>checkout</a>
</form>

</body>
</html>
