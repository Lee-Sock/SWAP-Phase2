<!DOCTYPE html>

<?php

//connect to database
require_once 'database.php';

//get userid
$userid = 1;

//getting cartid
$query= $con->prepare("SELECT * FROM cart WHERE userid = ?");
$query->bindValue(1,$userid); //bind the parameters
$query -> execute();
$resultCartid = $query->fetchALL();
//$cartid = $resultCartid['cartid'] ;
foreach ($resultCartid as $row) {
    $cartid = $row["cartid"];
};
console_log($cartid);

//getting all items in cart
$query= $con->prepare("SELECT * FROM cartitem WHERE cartid = ?");
$query->bindValue(1,$cartid); //bind the parameters
$query->execute();
$resultItems = $query->fetchALL(PDO::FETCH_ASSOC);
console_log($resultItems);
?>


<html>
<head>
<title>Webstore show cart page</title>
</head>
<body>

<!-- DISPLAY CART ITEMS -->
<table style "margin: 0 auto; text-align: center;" border '1'>
	<tr>
		<th>cartid</th>
		<th>itemid</th>
		<th>itemname</th>
		<th>itemquantity</th>
		<th>price</th>
		<th>description</th>
		<th>edit</th>
		<th>delete</th>
	<tr>
	<?php foreach ($resultItems as $row) { 
	    // grabbing all item information
	    $itemid = $row['itemid'];
	    $query= $con->prepare("SELECT * FROM inventory WHERE itemid = ?");
	    $query->bindValue(1,$itemid); //bind the parameters
	    $query->execute();
	    $resultItemsInfo = $query->fetchALL(PDO::FETCH_ASSOC);
	    console_log($resultItemsInfo);
	    ?>
		
		<tr>
			<td><?= isset($row['cartid']) ? $row['cartid'] : '' ?></td>
			<td><?= isset($row['itemid']) ? $row['itemid'] : '' ?></td>
			<td><?= isset($resultItemsInfo[0]['itemname']) ? $resultItemsInfo[0]['itemname'] : '' ?></td>
			<td><?= isset($row['itemquantity']) ? $row['itemquantity'] : '' ?></td>
			<td><?= isset($resultItemsInfo[0]['price']) ? $row['itemquantity'] * $resultItemsInfo[0]['price'] : '' ?></td>
			<td><?= isset($resultItemsInfo[0]['description']) ? $resultItemsInfo[0]['description'] : '' ?></td>
			<td><a href='edit.php?CARTID=<?= $row['id']?>'>Edit</a></td>
			<td>
				<form action='<?php echo $_SERVER['PHP_self']; ?>' method='post'>
					<input type='hidden' name='id' value='<?= isset($row['id']) ? $row['id'] : ''?>' />
					<input type='submit' name ='delete_button' value='Delete' class='button' />
				</form>
			</td>
		</tr>
	<?php } ?>
</table>


</body>
</html>