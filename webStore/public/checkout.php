<!DOCTYPE html>

<?php

//connect to database
require_once "config.php";
require_once 'index1.php';

$useridToRetrieve = $userid;

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

?>


<html>
<head>
<title>Webstore show cart page</title>

<link rel="stylesheet" href="styles.css">


<body>

<!-- DISPLAY CART ITEMS -->
<table style "margin: 0 auto; text-align: center;" border '1'>
	<tr>
		<th>cartid</th>
		<th>itemid</th>
		<th>itemname</th>
		<th>itemquantity</th>
		<th>price</th>
		<th>description</th>
		<th>edit</th>
		<th>delete</th>
	<tr>
	<?php foreach ($resultItems as $row) { 
	    // grabbing all item information
	    $itemid = $row['itemid'];
	    $query= $con->prepare("SELECT * FROM inventory WHERE itemid = ?");
	    $query->bindValue(1,$itemid); //bind the parameters
	    $query->execute();
	    $resultItemsInfo = $query->fetchALL(PDO::FETCH_ASSOC);
	    ?>
		
		<tr>
			<td><?= isset($row['cartid']) ? $row['cartid'] : '' ?></td>
			<td><?= isset($row['itemid']) ? $row['itemid'] : '' ?></td>
			<td><?= isset($resultItemsInfo[0]['itemname']) ? $resultItemsInfo[0]['itemname'] : '' ?></td>
			<td><?= isset($row['itemquantity']) ? $row['itemquantity'] : '' ?></td>
			<td><?= isset($resultItemsInfo[0]['price']) ? $row['itemquantity'] * $resultItemsInfo[0]['price'] : '' ?></td>
			<td><?= isset($resultItemsInfo[0]['description']) ? $resultItemsInfo[0]['description'] : '' ?></td>
			<td><a href='editCart.php?ID=<?= $row['id']?>'>Edit</a></td>
			<td><a href='deleteCartItem.php?ID=<?= $row['id']?>'>delete</a></td>
		</tr>
	<?php } ?>
</table>

<input type='button' name ='finishCheckout' value='Finalize Order' class='button' onclick="location.href='checkCart.php?>';" />		


</body>
</html>