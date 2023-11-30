<?php

//connect to database
require_once 'database.php';
   
// Get the item ID from the URL parameter    
$cartid = isset($_GET['id']) ? $_GET['id'] : null;
    
// Fetch the cartitem details from the database for the specified ID    
$query = $con->prepare("SELECT * FROM cartitem WHERE ITEM_ID = ?");
$query->execute([$cartid]);    
$cartItemDetails = $query->fetch(PDO::FETCH_ASSOC);
    
// Handle the update operation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_button'])) {              
    $newQuantity = $_POST['quantity'];        
    // Update the item details in the database        
    $updateQuery = $con->prepare("UPDATE cartitem SET itemquantity = ?, WHERE id = ?");     
    $updateQuery->execute([$newQuantity, $cartid]);
        
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
		<div style="text-align:center;">---------------------------------------<div>
		<h2>Edit Item</h2>
		<form action="<?php echo $_SERVER['PHP_SELF'] . "?ITEM_ID=" . $itemId; ?>" method="post">
		--------------------------------------- ------------------------------------------------------
		<p>
			<label for="itemname">Item Name:</label>
			<input id ="p" type="text" name="itemquantity" value="<?= $itemDetails['ITEM_NAME'] ?>" required><br>
<label for="stock">Stock:</label>

<input id ="p" type="text" name="stock" value="<?= $itemDetails['STOCK'] ?>" required><br>

<label for="unitprice">Unit Price:</label>

<input id ="p" type="text" name="unitprice" value="<?= $itemDetails['UNITPRICE'] ?>" required><br>

<label for="costprice">Cost Price:</label>

<input id ="p" type="text" name="costprice" value="<?= $itemDetails['COSTPRICE'] ?>" required><br>

<label for="shortdesc">Short Description:</label>

<input id ="p" type="text" name="shortdesc" value="<?= $itemDetails['SHORT_DESC'] ?>" required><br>

<label for="merchant">Merchant:</label>

<input id ="p" type="text" name="merchant" value="<?= $itemDetails['MERCHANT'] ?>" required><br>

--------------------------------------- ------------------------------------------------------ </p>

--------------------------------------- ------------------------------------------------------------ <input style="margin-block-start: 10px; margin-block-end: 10px; margin-inline-start: 190px" type="submit" name="update_button" value="Update Record">

</form>

</div>

</div>

</body>

</html>