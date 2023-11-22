<html>
<body>
<?php
$servername = "localhost";
$dbname ="phase2";

$con = new PDO("mysql:host=$servername;dbname=$dbname","root",""); //connect to database
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$query= $con->prepare("SELECT * FROM user");

$query->execute();

$result = $query->fetchALL(PDO::FETCH_ASSOC);

?>

<table style "margin: 0 auto; text-align: center;" border '1'>
	<tr>
		<th>userid</th>
		<th>email</th>
		<th>password</th>
		<th>username</th>
		<th>firstname</th>
		<th>lastname</th>
		<th>phoneno</th>
	<tr>
	<?php foreach ($result as $row) { ?>
		<tr>
			<td><?= isset($row['userid']) ? $row['userid'] : '' ?></td>
			<td><?= isset($row['email']) ? $row['email'] : '' ?></td>
			<td><?= isset($row['password']) ? $row['password'] : '' ?></td>
			<td><?= isset($row['username']) ? $row['username'] : '' ?></td>
			<td><?= isset($row['firstname']) ? $row['firstname'] : '' ?></td>
			<td><?= isset($row['lastname']) ? $row['lastname'] : '' ?></td>
			<td><?= isset($row['phoneno']) ? $row['phoneno'] : '' ?></td>
		</tr>
	<?php } ?>
</table>

</body>
</html>