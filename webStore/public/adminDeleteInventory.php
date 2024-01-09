<?php

//connect to database
require_once "config.php";
require_once 'index2.php';

// Get the item ID from the URL parameter
$id = isset($_GET['ID']) ? $_GET['ID'] : null;

//delete items
$deleteQuery = $con->prepare("DELETE FROM inventory WHERE itemid = ?");
$deleteQuery->execute([$id]);
// Redirect to refresh the page after deletion
header("Location: adminInventory.php");



?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="styles.css">

</head>
<body>

</body>


</html>
