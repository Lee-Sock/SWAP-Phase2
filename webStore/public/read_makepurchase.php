<?php
// Retrieve items in the cart
$conn = mysqli_connect("localhost", "root", "", "phase2");
$sql = "SELECT * FROM cart";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Cart</title>
</head>
<body>

<h2>Shopping Cart</h2>

<?php

require_once 'addtocart.php';

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Item ID</th><th>Item Name</th><th>Quantity</th><th>Price</th><th>Action</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["itemid"] . "</td>";
        echo "<td>" . $row["itemname"] . "</td>";
        echo "<td>" . $row["quantity"] . "</td>";
        echo "<td>" . $row["price"] . "</td>";
        echo "<td><form action='delete_makepurchase.php' method='post'>";
        echo "<input type='hidden' name='itemid' value='" . $row["itemid"] . "'>";
        echo "<input type='submit' value='Delete'></form></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No items in the cart.";
}

// Close connection
$conn->close();
?>

</body>
</html>
