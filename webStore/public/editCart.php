<?php

//connect to database
require_once "config.php";
require_once 'index1.php';

// Get the item ID from the URL parameter    
$id = isset($_GET['ID']) ? $_GET['ID'] : null;
    
// Fetch the cartitem details from the database for the specified ID    
$query = $con->prepare("SELECT * FROM cartitem WHERE id = ?");
$query->execute([$id]);    
$cartItemDetails = $query->fetch(PDO::FETCH_ASSOC);
// Handle the update operation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_button'])) {              
    $newQuantity = $_POST['quantity'];        
    // Update the item details in the database        
    $updateQuery = $con->prepare("UPDATE cartitem SET itemquantity = ? WHERE id = ?");     
    $updateQuery->execute([$newQuantity, $id]);
        
    // Redirect to index.php after updating        
    header("Location: checkout.php");
    exit();
}

?>

<!DOCTYPE html>
	<html lang="en">
		<head>
			<meta charset="UTF-8">
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
						<label for="itemquantity">Item Quantity:</label>
						<input id ="p" type="text" name="quantity" value="<?= $cartItemDetails['itemquantity'] ?>" required>
						<br> --------------------------------------- ------------------------------------------------------
					</p>
					<input style="margin-block-start: 10px; margin-block-end: 10px; margin-inline-start: 190px" type="submit" name="update_button" value="Update Record">
				</form>

			</div>

		</div>

</body>

</html>