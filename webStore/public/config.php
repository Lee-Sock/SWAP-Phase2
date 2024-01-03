 <?php 
$db_hostname = "localhost";
$db_username = "root";
$db_password = "";
$db_database = "phase2";

session_start();
$conn = mysqli_connect("localhost", "root", "", "phase2");

$con = new PDO("mysql:host=$db_hostname;dbname=$db_database","root",""); //connect to database
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>
