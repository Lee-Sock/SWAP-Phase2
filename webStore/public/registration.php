<?php 
require 'config.php';
if(isset($_POST["submit"])){
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $phoneno = $_POST["phoneno"];
    $duplicate = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username' OR email = '$email' OR phoneno = '$phoneno'");
    if (mysqli_num_rows($duplicate) > 0) {
        echo 
        "<script> alert('Username or Email or PhoneNo Is Already Taken'); </script>";
        
    }
    else{
        $query = "INSERT INTO user VALUES('', '$email','$password','$username','$firstname','$lastname','$phoneno')";
        mysqli_query($conn,$query);
        echo 
        "<script> alert('Registration Successful'); </script>";
        
    }
    
}
?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>Registration</title>
	</head>
	<body>
		<h1>Registraton</h1>
		<form class="" action="" method="post" autocomplete="off">
			<label for="firstname">First Name: </label>
			<input type="text" name="firstname" id= "firstname" required value=""> <br>
			<label for="lastname">Last Name: </label>
			<input type="text" name="lastname" id= "lastname" required value=""> <br>
			<label for="username">Username: </label>
			<input type="text" name="username" id= "username" required value=""> <br>
			<label for="email">Email: </label>
			<input type="email" name="email" id= "email" required value=""> <br>
			<label for="password">Password: </label>
			<input type="password" name="password" id= "password" required value=""> <br>
			<label for="phoneno">Phone Number: </label>
			<input type="phoneno" name="phoneno" id= "phoneno" required value=""> <br>
			<button type="submit" name="submit">Register</button>
			
		</form>
		<br>
		<a href="login.php">Login</a>
		
	</body>
</html>