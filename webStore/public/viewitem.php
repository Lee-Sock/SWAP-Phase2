<?php

require_once 'config.php';

$query= $conn->prepare("SELECT * FROM inventory");

$query->execute();

$result = $query->fetchALL(PDO::FETCH_ASSOC);

?>

<table style "margin: 0 auto; text-align: center;" border '1'>
	<tr>
		<th>itemid</th>
		<th>itemname</th>
		<th>price</th>
		<th>quantity</th>
		<th>description</th>
		<th>picture</th>
	<tr>
	<?php foreach ($result as $row) { ?>
		<tr>
			<td><?= isset($row['itemid']) ? $row['itemid'] : '' ?></td>
			<td><?= isset($row['itemname']) ? $row['itemname'] : '' ?></td>
			<td><?= isset($row['price']) ? $row['price'] : '' ?></td>
			<td><?= isset($row['quantity']) ? $row['quantity'] : '' ?></td>
			<td><?= isset($row['description']) ? $row['description'] : '' ?></td>
			<td><?= isset($row['picture']) ? $row['picture'] : '' ?></td>
		</tr>
	<?php } ?>
</table>
