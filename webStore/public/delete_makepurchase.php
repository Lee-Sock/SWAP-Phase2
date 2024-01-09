<?php
// Database connection parameters
//$servername = "localhost"; 
//$dbname = "phase2";
require_once 'addtocart.php';

// Create connection
$conn = mysqli_connect("localhost", "root", "", "phase2");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle item deletion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_id_to_delete = $_POST['itemid'];
    
    // Delete the item from the cart
    $sql_delete = "DELETE FROM cart WHERE itemid = $item_id_to_delete";
    
    if ($conn->query($sql_delete === TRUE)) {
        echo "Item deleted successfully.";
    } else {
        echo "Error deleting item: " . $conn->error;
    }
}

// Close connection
$conn->close();
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
