<!DOCTYPE html>

<?php

//connect to database
require_once "config.php";
require_once 'index2.php';

//getting Inventory
$query= $con->prepare("SELECT * FROM inventory");
$query -> execute();
$resultInventory = $query->fetchALL();

//getting all items in cart

?>


<html>

<head>

<link rel="stylesheet" href="styles.css">


<title>Webstore Inventory Adminpage</title>
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
		<th>edit</th>
		<th>delete</th>
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
			<td><a href='adminEditInventory.php?ID=<?= $row['itemid']?>'>Edit</a></td>
			<td><a href='adminDeleteInventory.php?ID=<?= $row['itemid']?>'>Delete</a></td>
		</tr>
	<?php } ?>
</table>

<a href='adminAddInventory.php'>Add</a>


</body>

</html>
