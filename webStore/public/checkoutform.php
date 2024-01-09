<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart with Shipping Information</title>
</head>
<body>







<?php
// Your PHP logic for processing form submissions would go here


$cartItems = [
    ['id' => 1, 'name' => 'Product A', 'price' => 19.99],
    ['id' => 2, 'name' => 'Product B', 'price' => 29.99],
    ['id' => 3, 'name' => 'Product C', 'price' => 39.99],
];

require_once "config.php";
require_once 'index1.php';

// Sample userid, replace with the actual userid you want to retrieve data for
$useridToRetrieve = $userid;

// Establish a database connection
$con = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);

// Check the connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// SQL query to retrieve data from the "shippinginfo" table based on userid
$query = "SELECT * FROM shippinginfo WHERE userid = $useridToRetrieve";
$result = mysqli_query($con, $query);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . mysqli_error($con));
}

while ($row = mysqli_fetch_assoc($result)) {
    $shippinginfo = [
    'address' => $row['address'],
    'cardnumber' => $row['cardnumber'],
    'expiry' => $row['expiry'],
    'cvc' => $row['cvc'],
    ];
}
// Close the database connection
mysqli_close($con);

?>

<!DOCTYPE html>

<link rel="stylesheet" href="styles.css">



<h1>Shopping Cart</h1>

<!-- Display cart items -->
<ul>
    <?php foreach ($cartItems as $item): ?>
        <li><?= $item['name'] ?> - $<?= $item['price'] ?></li>
    <?php endforeach; ?>
</ul>

<!-- Display shipping information -->
<h2>Shipping Information</h2>
<p>
    Address: <?= isset($shippinginfo['address']) ? $shippinginfo['address'] : 'N/A' ?><br>
    Card Number: <?= isset($shippinginfo['cardnumber']) ? $shippinginfo['cardnumber'] : 'N/A' ?><br>
    Expiry: <?= isset($shippinginfo['expiry']) ? $shippinginfo['expiry'] : 'N/A' ?><br>
    CVC: <?= isset($shippinginfo['cvc']) ? $shippinginfo['cvc'] : 'N/A' ?><br>
</p>

<form action="shippinginfoform.php" method="post">
        <button type="submit" name="addshippinginfo">Add Shipping Information</button>
	</form>
<form action="updateshippinginfoform.php" method="post">
        <button type="submit" name="updateshippinginfo">Update Shipping Information</button>
    </form>     

</body>
</html>
