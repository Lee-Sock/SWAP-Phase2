<?php

require_once 'index2.php';
require_once 'config.php';


  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['insert_button'])) {
        
        $ItemName = $_POST['itemname'];
        
        $Price = $_POST['price'];
        
        $Quantity = $_POST['quantity'];
        
        $Description = $_POST['description'];
        
        $Picture = $_POST['picture'];
        // to prepare the sql code to send to database that adds the supplier each name inside $post reference with the names of html elements
        
        $query = $con->prepare("INSERT INTO inventory (itemid, itemname, price, quantity, description, picture) VALUES (?, ?, ?, ?, ?, ?)");
        
        $query->execute(['', $ItemName, $Price, $Quantity, $Description, $Picture]);
        
    }
    
?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">
<link rel="stylesheet" href="styles.css">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Item Management</title>


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

<div style="text-align:center;">

<!-- Add New Item Form -->

<div>

<h2>Supplier Page</h2>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<!--when click submit button will run the page again when done the check for sending the sql query will go thru and update the database with new supplier
-->

<p>

<label for="itemname">Item name:</label>

<input id="p" type="text" name="itemname" required><br>

<label for="price">Price:</label>

<input id="p" type="text" name="price" required><br>

<label for="quantity">Quantity:</label>

<input id="p" type="text" name="quantity" required><br>

<label for="description">Description:</label>

<input id="p" type="text" name="description" required><br>

<label for="picture">Picture:</label>

<input id="p" type="text" name="picture" required><br>


</p>

<input style="margin-block-start: 10px; margin-block-end: 10px; margin-inline-start: 190px" type="submit" name="insert_button" value="Insert Record">
<a href='adminInventory.php'>go back</a>

</form>

</div>
</div>

</body>

</html>

