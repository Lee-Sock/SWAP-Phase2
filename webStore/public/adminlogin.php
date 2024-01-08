<?php 
require 'config.php';
if(isset($_POST["submit"])){
    $adminId = $_POST["adminId"];
    $password = $_POST["password"];
    $result = mysqli_query($conn, "SELECT * FROM admin WHERE adminId = '$adminId'");
    $row = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result)> 0){
        if($password == $row["password"]){
            $_SESSION["login1"] = true;
            $_SESSION["adminId"] = $row["adminId"];
            header("Location: index2.php");
        }
        else{
            echo 
            "<script> alert('Wrong Password'); </script>";
            
        }
    }
    else{
        echo 
        "<script> alert ('User Not Registered'); </script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title> Login</title>
	</head>
	<body>
		<h2>Login</h2>
		<form class="" action="" method="post" autocomplete="off">
			<label for="adminId">Admin ID :</label>
			<input type="int" name="adminId" id= "adminId" required value=""> <br>
			<label for="password">Password</label>
			<input type="password" name="password" id = "password" required value=""> <br>
			<button type="submit" name="submit">Login</button>
		</form>
		<br>
		<a href="registration.php">Registration</a>
	</body>
</html>
