<?php 
// require_once 'config.php';

// if(isset($_SESSION["login"]) && $_SESSION["login"] === true){
//     header("Location: addtocart.php");
//     exit();
// }
// if(isset($_POST["submit"])){
//     $firstname = $_POST["firstname"];
//     $lastname = $_POST["lastname"];
//     $username = $_POST["username"];
//     $email = $_POST["email"];
//     $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
//     $phoneno = $_POST["phoneno"];

//     $duplicate = mysqli_query($conn, "SELECT * FROM user
//                                       WHERE username = '$username'
//                                       OR email = '$email'
//                                       OR phoneno = '$phoneno'");
    
//     if (mysqli_num_rows($duplicate) > 0) {
//         echo
//         "<script> alert('Username or Email or PhoneNo Is Already Taken'); </script>";
        
//     }
//     else{
//         $query = "INSERT INTO user VALUES('', '$email','$password','$username','$firstname','$lastname','$phoneno')";
//         mysqli_query($conn,$query);
//         $query2 = $con->prepare("SELECT * FROM user WHERE username = ?");
//         $query2 ->bindValue(1,$username); //bind the parameters
//         $query2 -> execute();
//         $resultUserid = $query2->fetchALL();
//         foreach ($resultUserid as $row){
//             $query3= $conn->prepare("INSERT INTO `cart` (`cartid`, `userid`) VALUES (?,?)");
//             $query3->bind_param('ss',$row["userid"], $row["userid"]); //bind the parameters
//             if ($query3->execute()){ //execute query
//                 echo "";
//             }else{
//                 echo "Error executing query.";
//             }
//         }
//         echo
//         "<script> alert('Registration Successful'); </script>";
        
//     }
    
   
// }
// ?>

<?php
require_once 'config.php';

if (isset($_SESSION["login"]) && $_SESSION["login"] === true) {
    header("Location: addtocart.php");
    exit();
}

if (isset($_POST["submit"])) {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $phoneno = $_POST["phoneno"];

    $duplicate = mysqli_prepare($conn, "SELECT * FROM user
                                      WHERE username = ? OR email = ? OR phoneno = ?");
    mysqli_stmt_bind_param($duplicate, "sss", $username, $email, $phoneno);
    mysqli_stmt_execute($duplicate);
    mysqli_stmt_store_result($duplicate);

    if (mysqli_stmt_num_rows($duplicate) > 0) {
        echo "<script> alert('Username or Email or PhoneNo Is Already Taken'); </script>";
    } else {
        $insertQuery = mysqli_prepare($conn, "INSERT INTO user (email, password, username, firstname, lastname, phoneno) VALUES (?, ?, ?, ?, ?, ?)");
        if ($insertQuery) {
            mysqli_stmt_bind_param($insertQuery, "ssssss", $email, $password, $username, $firstname, $lastname, $phoneno);
            
            if (mysqli_stmt_execute($insertQuery)) {
                $userid = mysqli_insert_id($conn);

                $query3 = mysqli_prepare($conn, "INSERT INTO `cart` (`cartid`, `userid`) VALUES (NULL, ?)");
                mysqli_stmt_bind_param($query3, 'i', $userid);

                if (mysqli_stmt_execute($query3)) {
                    echo "<script> alert('Registration Successful'); </script>";
                } else {
                    echo "Error executing query3: " . mysqli_error($conn);
                }

                mysqli_stmt_close($query3);
            } else {
                echo "Error executing insertQuery: " . mysqli_error($conn);
            }

            mysqli_stmt_close($insertQuery);
        } else {
            echo "Error preparing insertQuery: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
}
?>

<!-- The rest of your HTML code remains unchanged. -->









<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		 <link rel="stylesheet" href="styles.css">
		<title>Registration</title>
	</head>

	<body style="font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;">
	

    
    <div style="background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;">
    

        <h1>Registration</h1>
        
           

 			<form action="" method="post" autocomplete="off"
      				style="display: flex; flex-direction: column; align-items: center;">
 			

            <div style="display: flex; flex-direction: row; align-items: center; margin-bottom: 10px;">
                <label for="firstname" style="width: 120px;">First Name:</label>
                <input type="text" name="firstname" id="firstname" required value="">
            </div>

            <div style="display: flex; flex-direction: row; align-items: center; margin-bottom: 10px;">
                <label for="lastname" style="width: 120px;">Last Name:</label>
                <input type="text" name="lastname" id="lastname" required value="">
            </div>

            <div style="display: flex; flex-direction: row; align-items: center; margin-bottom: 10px;">
                <label for="username" style="width: 120px;">Username:</label>
                <input type="text" name="username" id="username" required value="">
            </div>

            <div style="display: flex; flex-direction: row; align-items: center; margin-bottom: 10px;">
                <label for="email" style="width: 120px;">Email:</label>
                <input type="email" name="email" id="email" required value="">
            </div>

            <div style="display: flex; flex-direction: row; align-items: center; margin-bottom: 10px;">
                <label for="password" style="width: 120px;">Password:</label>
                <input type="password" name="password" id="password" required value="">
            </div>

            <div style="display: flex; flex-direction: row; align-items: center; margin-bottom: 10px;">
                <label for="phoneno" style="width: 120px;">Phone Number:</label>
                <input type="phoneno" name="phoneno" id="phoneno" required value="">
            </div>

            <button type="submit" name="submit">Register</button>
        </form>

        <br>
        <a href="login.php">Login</a> <br><br>
        <a href="adminlogin.php">Login as admin</a>
        
    </div>

</body>

</html>
