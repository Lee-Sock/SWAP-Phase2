<?php

require 'config.php';
if(!empty($_SESSION["adminId"])){
    $adminId = $_SESSION["adminId"];
    $result = mysqli_query($conn, "SELECT * FROM admin WHERE adminId = '$adminId'");
    $row = mysqli_fetch_assoc($result);
    
}
else{
    header("Location: adminlogin.php");
    
}
?>

<?php
function console_log($output, $with_script_tags = true) {
$js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
');';
if ($with_script_tags) {
$js_code = '<script>' . $js_code . '</script>';
}
echo $js_code;
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>Index</title>
	</head>
	<body>
		<h1> Welcome <?php echo $row["adminId"];?> </h1>
		<a href="logout.php">Logout</a>
		<br>
		<br>
		<a href='adminInventory.php'>Manage Inventory</a>
		<br>
		<br>
		<a href='userdelete.php'>Delete Users</a>
		<br>
		<br>
	</body>




</html>