<!DOCTYPE html>

<?php

//connect to database
require_once "config.php";
require_once 'index1.php';

$useridToRetrieve =$userid;

//getting c;artid
$query= $con->prepare("SELECT * FROM cart WHERE userid = ?");
$query->bindValue(1,$userid); //bind the parameters
$query -> execute();
$resultCartid = $query->fetchALL();
foreach ($resultCartid as $row) {
    $cartid = $row["cartid"];
}

//getting all items in cart
$query= $con->prepare("SELECT * FROM cartitem WHERE cartid = ?");
$query->bindValue(1,$cartid); //bind the parameters
$query->execute();
$resultItems = $query->fetchALL(PDO::FETCH_ASSOC);

//get shipping information
$query= $con->prepare("SELECT * FROM shippinginfo WHERE userid = ?");
$query->bindValue(1,$userid); //bind the parameters
$query -> execute();
$resultShippingInfo = $query->fetchALL();
?>


<html>
<head>

<link rel="stylesheet" href="styles.css">



<title>Webstore finalize checkout</title>
</head>
<body>

<!-- DISPLAY CART ITEMS -->
<table style "margin: 0 auto; text-align: center;" border '1'>
	<tr>
		<th>cartid</th>
		<th>itemid</th>
		<th>itemname</th>
		<th>itemquantity</th>
		<th>price</th>
		<th>picture</th>
		<th>description</th>
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
			<td>
                <?php
                // Assuming the 'picture' column contains the path or URL to the image
                $picture = isset($resultItemsInfo[0]['picture']) ? $resultItemsInfo[0]['picture'] : '';
                echo "<img src='$picture' alt='picture' style='width: 50px; height: 50px;'>";
                ?>
            </td>
			<td><?= isset($resultItemsInfo[0]['description']) ? $resultItemsInfo[0]['description'] : '' ?></td>
		</tr>
	<?php } ?>
</table>

<p>
Address: <?= isset($resultShippingInfo[0]['address']) ? $resultShippingInfo[0]['address'] : 'N/A' ?><br>
Card Number: <?= isset($resultShippingInfo[0]['cardnumber']) ? $resultShippingInfo[0]['cardnumber'] : 'N/A' ?><br>
Expiry: <?= isset($resultShippingInfo[0]['expiry']) ? $resultShippingInfo[0]['expiry'] : 'N/A' ?><br>
CVC: <?= isset($resultShippingInfo[0]['cvc']) ? $resultShippingInfo[0]['cvc'] : 'N/A' ?><br>
</p>
<?php if ($resultShippingInfo == null) { ?>
	<input type='button' name ='addShipping' value='Please add Shipping Info' class='button' onclick="location.href='shippinginfoform.php?>';" />
<?php } else {?>
	<input type='button' name ='changeShipping' value='Update Shipping info' class='button' onclick="location.href='updateshippinginfoform.php?>';" />
	<input type='button' name ='emptycart' value='Finish Checkout' class='button' onclick="location.href='donecheckout.php?>';" />
<?php }?>



</body>
</html>
