<!DOCTYPE html>

<?php

//connect to database
require_once "config.php";
require_once 'index1.php';

//getting Inventory
$query= $con->prepare("SELECT * FROM inventory");
$query -> execute();
$resultInventory = $query->fetchALL();
$success = isset($_GET['SUCCESS']) ? $_GET['SUCCESS'] : null;;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_button'])) {
    $id = $_POST['add_button'];
    $amount = $_POST[$id];
    
    console_log($id);
    console_log($amount);
   
    header("Location: userInventoryToCart.php?ID=$id&AMOUNT=$amount");
}

if ($success == "1"){
    echo "<script> alert ('Item added'); </script>";
}



?>


<html>
<head>


<link rel="stylesheet" href="styles.css">



<title>Webstore Shopping page</title>
</head>
<body>

<!-- DISPLAY CART ITEMS -->
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
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
            <label for="amount"></label>
			<input id ="p" type="text" name="<?= isset($row['itemid']) ? $row['itemid'] : '' ?>" value="">
            </td>
            <td>
            <input type="submit" name="add_button" value="<?= $row['itemid']?>">
            
            </td>
		</tr>
	<?php } ?>
</table>
<a href='checkout.php'>checkout</a>
</form>
</body>
</html>