<html>
<body>
<?php
$con = mysqli_connect("localhost","root","","phase2"); //connect to database
if (!$con){
    die('Could not connect: ' . mysqli_connect_errno()); //return error is connect fail
}
$query= $con->prepare("UPDATE user SET email=?, password=?, username=?, firstname=?, lastname=?, phoneno=? WHERE userid=?");

$email = 'example2@example.com.sg';
$password='updatd password';
$username='testusernumber2';
$firstname='not';
$lastname='shane';
$phoneno = 87654321;

$userid = 1;

$query->bind_param('sssssss', $email, $password, $username, $firstname, $lastname, $phoneno, $userid); //bind the parameters
if ($query->execute()){
    echo "Query executed.";
}else{
    echo "Error executing query."; 
}
?>
</body>
</html>