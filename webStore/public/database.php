<?php
$hostName = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "phase2";

$conn = new PDO("mysql:host=$hostName;dbname=$db_name",$db_user,$db_pass); //connect to database
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (!$conn) {
    die("Something went wrong;");
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