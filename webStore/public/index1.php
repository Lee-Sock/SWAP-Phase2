<?php
require 'config.php';

// Start the session
session_start();

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php");
    exit();
}

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
if (!empty($_SESSION["userid"])) {
    $userid = $_SESSION["userid"];
    $result = mysqli_query($conn, "SELECT * FROM user WHERE userid = '$userid'");
    $row = mysqli_fetch_assoc($result);
} else {
    header("Location: login.php");
}
?>

<?php
function console_log($output, $with_script_tags = true) {
$js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
');';
if ($with_script_tags) {
$js_code = '<script>' . $js_code . '</script>';
}
echohttps://localhost/finalphase2/SWAP-Phase2/webStore/public/logout.php $js_code;
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>Index</title>
	</head>
	<body>
		<h1> Welcome <?php echo $row["username"];?> </h1>
		<a href="logout.php">Logout</a>
	</body>




</html>