<html>
<body>
<?php
$con = mysqli_connect("localhost","root","","phase2"); //connect to database
if (!$con){
    die('Could not connect: ' . mysqli_connect_errno()); //return error is connect fail
}
$query= $con->prepare("DELETE FROM user WHERE userid=?");

$userid = 1;

$query->bind_param('s', $userid); //bind the parameters
if ($query->execute()){
    echo "Query executed.";
}else{
    echo "Error executing query.";
}
?>
</body>
</html>
