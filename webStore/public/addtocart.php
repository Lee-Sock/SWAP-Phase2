<?php
require_once 'config.php';
require_once 'index1.php';

$message = ''; // Initialize an empty message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $itemId = $_POST["itemid"];
    $itemQuantity = $_POST["quantity"];
    
    // Use prepared statements to avoid SQL injection
    $checkIfExists = $con->prepare("SELECT * FROM cartitem WHERE cartid IN (SELECT cartid FROM cart WHERE userid = ?) AND itemid = ?");
    $checkIfExists->execute([$userid, $itemId]);
    
    if ($checkIfExists->rowCount() > 0) {
        $con->prepare("UPDATE cartitem SET itemquantity = itemquantity + ? WHERE cartid IN (SELECT cartid FROM cart WHERE userid = ?) AND itemid = ?")
        ->execute([$itemQuantity, $userid, $itemId]);
        $message = "Item updated in the cart successfully.";
    } else {
        $cartIdResult = $con->prepare("SELECT * FROM cart WHERE userid = ?");
        $cartIdResult->execute([$userid]);
        $cartIdRow = $cartIdResult->fetch(PDO::FETCH_ASSOC);
        
        if ($cartIdRow) {
            $cartId = $cartIdRow['cartid'];
            $insertCartItem = $con->prepare("INSERT INTO cartitem (cartid, itemid, itemquantity) VALUES (?, ?, ?)");
            
            if ($insertCartItem->execute([$cartId, $itemId, $itemQuantity])) {
                $message = "Item added to the cart successfully.";
            } else {
                $message = "Error adding item to cart: " . $insertCartItem->errorInfo()[2];
            }
        } else {
            $message = "Error: Unable to retrieve cart ID.";
        }
    }
}

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
