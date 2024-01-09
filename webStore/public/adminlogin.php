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
		<link rel="stylesheet" href="styles.css">
	</head>
	<body>
	<body style="font-family: Arial, sans-serif; background-color: #f0f0f0; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0;">
<div style="background-color: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); text-align: center;">

	
		<h2>Login</h2>
		<form action="" method="post" autocomplete="off" style="display: flex; flex-direction: column; align-items: center;">
     	<div style="display: flex; flex-direction: row; align-items: center; margin-bottom: 10px;">
			<label for="adminId"  style="width: 120px;">Admin ID :</label>
			<input type="int" name="adminId" id= "adminId" required value=""> <br>
		</div>
		<div style="display: flex; flex-direction: row; align-items: center; margin-bottom: 10px;">
			<label for="password" style="width: 120px;">Password</label>
			<input type="password" name="password" id = "password" required value=""> <br>
		</div>
			<button type="submit" name="submit">Login</button>
		</form>
		<br>
		<a href="registration.php">Not an admin? Register here</a>
	</body>
</html>
