<html>
<body> 
<?php 
$con = mysqli_connect("localhost","root","","phase2"); //connect to database 
if (!$con){
    die('Could not connect: ' . mysqli_connect_errno()); //return error is connect fail 
} 
$query= $con->prepare("INSERT INTO `user` (`userid`, `email`, `password`, `username`, `firstname`,`lastname` , `phoneno`) VALUES (?,?,?,?,?,?,?)");  
$userid =1;
$email = 'example@examaple.com'; 
$password = '123'; 
$username = 'test user'; 
$firstname = 'way'; 
$lastname = 'hng'; 
$phoneno=12345678;
$query->bind_param('sssssss',$userid, $email,$password, $username, $firstname, $lastname, $phoneno); //bind the parameters 
if ($query->execute()){ //execute query
    echo "Query executed.";
}else{
    echo "Error executing query.";
}
?>
</body> 
</html>