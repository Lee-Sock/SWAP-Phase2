<!DOCTYPE html>

<?php

//connect to database
require_once "config.php";
// require_once 'index2.php';

//getting Inventory
$query= $con->prepare("SELECT * FROM inventory");
$query -> execute();
$resultInventory = $query->fetchALL();

//getting all items in cart

?>


<html>
<head>
<title>Webstore Shopping page</title>
</head>
<body>

<!-- DISPLAY CART ITEMS -->
<table style "margin: 0 auto; text-align: center;" border '1'>
	<tr>
		<th>itemid</th>
		<th>itemname</th>
		<th>price</th>
		<th>quantity</th>
		<th>description</th>
		<th>picture</th>
		<th>Quantity to add to your cart</th>
		<th>Add to cart</th>
	<tr>
	<?php foreach ($resultInventory as $row) { 	    ?>
		
		<tr>
			<td><?= isset($row['itemid']) ? $row['itemid'] : '' ?></td>
			<td><?= isset($row['itemname']) ? $row['itemname'] : '' ?></td>
			<td><?= isset($row['price']) ? $row['price'] : '' ?></td>
			<td><?= isset($row['quantity']) ? $row['quantity'] : '' ?></td>
			<td><?= isset($row['description']) ? $row['description'] : '' ?></td>
			
			<td>
                <?php
                // Assuming the 'picture' column contains the path or URL to the image
                $picture = isset($row['picture']) ? $row['picture'] : '';
                echo "<img src='$picture' alt='picture' style='width: 50px; height: 50px;'>";
                ?>
            </td>
            <td>
            <label for="name"></label>
			<input id ="p" type="text" name="name" value="" required>
            </td>
            <td>
            <a href="addtocart.php">Add to cart</a>
            </td>
		</tr>
	<?php } ?>
</table>

</body>
</html>