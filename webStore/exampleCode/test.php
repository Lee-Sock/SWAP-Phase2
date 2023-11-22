<html> 
<body> 
<?php 
$con = mysqli_connect("localhost","root","","phase2"); //connect to database 
if (!$con){
    die('Could not connect: ' . mysqli_connect_errno()); //return error is connect fail 
} 
$query= $con->prepare("INSERT INTO `user` (`NAME`,`USERNAME`, `PASSWORD`, `ADDRESS`, `EMAIL`,`CONTACT` , `ROLE`) VALUES (?,?,?,?,?,?,?)"); 
$name='ADMIN USER1'; 
$pwd = 'admin1pwd'; 
$address = 'ang mo kio ave 2'; 
$email = 'admin1@email.com'; 
$contact = '11223344'; 
$role = 'ADMIN'; 
$query->bind_param('sssssss', $name,$name, $pwd, $address, $email,$contact, $role); //bind the parameters 
if ($query->execute()){ //execute query 
    echo "Query executed."; 
}else{ 
    echo "Error executing query."; 
} 
?> 
</body> 
</html>