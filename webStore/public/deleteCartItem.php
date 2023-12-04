<?php

//connect to database
require_once 'database.php';

// Get the item ID from the URL parameter
$id = isset($_GET['ID']) ? $_GET['ID'] : null;

//delete items
$deleteQuery = $con->prepare("DELETE FROM cartitem WHERE id = ?");
$deleteQuery->execute([$id]);
// Redirect to refresh the page after deletion
header("Location: checkout.php");



?>