<?php

//connect to database
require_once "config.php";
require_once 'index2.php';

// Get the item ID from the URL parameter
$id = isset($_GET['ID']) ? $_GET['ID'] : null;

// Fetch the cartitem details from the database for the specified ID
$query = $con->prepare("SELECT * FROM inventory WHERE itemid = ?");
$query->execute([$id]);
$inventoryItemDetails = $query->fetch(PDO::FETCH_ASSOC);
// Handle the update operation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_button'])) {
    
    $newName = $_POST['name'];
    $newPrice = $_POST['price'];
    $newQuantity = $_POST['quantity'];
    $newDescription = $_POST['description'];
    $newPicture = $_POST['picture'];
    // Update the item details in the database
    $updateQuery = $con->prepare("UPDATE inventory SET itemname = ?,price = ?,quantity = ?,description = ?,picture = ? WHERE itemid = ?");
    $updateQuery->execute([$newName, $newPrice, $newQuantity,$newDescription,$newPicture, $id]);
    
    // Redirect to index.php after updating
    header("Location: adminInventory.php");
    exit();
}

?>

<!DOCTYPE html>
	<html lang="en">
		<head>
			<meta charset="UTF-8">
			
			<link rel="stylesheet" href="styles.css">

			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title>Edit Item</title>
		</head>

		<style>
		p {
		text-align: left;
		max-width: 300px; /* Set a maximum width for better readability */
		margin: 0 auto; /* Center the div */
		}
		
		label {
        display: inline-block;
        width: 120px; /* Adjust the width as needed */
        margin: 10px 0;
        }

        #p {
        width: calc(100% - 130px); /* Adjust the width as needed */
        padding: 5px;
        box-sizing: border-box;
        }
        </style>
        
	<body>
		<div style="text-align:center;">---------------------------------------
			<div>
				<h2>Edit Item</h2>
				<form action="<?php echo $_SERVER['PHP_SELF'] . "?ID=" . $id; ?>" method="post">
				---------------------------------------------------------------------------------------------
					<p>
						<label for="name">Item Name:</label>
						<input id ="p" type="text" name="name" value="<?= $inventoryItemDetails['itemname'] ?>" required>
						
						<label for="price">Item Price:</label>
						<input id ="p" type="text" name="price" value="<?= $inventoryItemDetails['price'] ?>" required>
						
						<label for="quantity">Item Quantity:</label>
						<input id ="p" type="text" name="quantity" value="<?= $inventoryItemDetails['quantity'] ?>" required>
						
						<label for="description">Description:</label>
						<input id ="p" type="text" name="description" value="<?= $inventoryItemDetails['description'] ?>" required>
						
						<label for="picture">Item Picture:</label>
						<input id ="p" type="text" name="picture" value="<?= $inventoryItemDetails['picture'] ?>" required>
						
						<br> --------------------------------------- ------------------------------------------------------
					</p>
					<input style="margin-block-start: 10px; margin-block-end: 10px; margin-inline-start: 190px" type="submit" name="update_button" value="Update Record">
				</form>

			</div>

		</div>

</body>

</html>