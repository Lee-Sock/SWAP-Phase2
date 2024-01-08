<?php
require_once "deleteuser.php";
require_once "config.php";

$userid=$_POST['userid'];

deleteuser($userid);

try {
    $con=mysqli_connect($db_hostname,$db_username,$db_password,$db_database);
    
}
    catch (Exception $e) {
        printerror($e->getMessage(),$con);
}

$query = "SELECT * FROM user";

// Execute the query
$result = mysqli_query($con, $query);


if (mysqli_num_rows($result) > 0) {
    echo "<table border='1'>";
    echo "<tr><th>User ID</th><th>Email</th><th>Password</th><th>Username</th><th>Firstname</th><th>Lastname</th><th>Phone Number</th></tr>";
    
    // Fetch and display each row
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['userid'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['password'] . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['firstname'] . "</td>";
        echo "<td>" . $row['lastname'] . "</td>";
        echo "<td>" . $row['phoneno'] . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
} else {
    echo "No users found.";
}

?>

<html>
<head>
    <style>
    form {
        width: 25%;
        clear: both;
    }
    input  {
        width: 100%;
        clear: both;
    }
    </style>
</head>
<body>
    <b>Delete user</b><br>
    <form action="" method="post">
        User ID: <input type="text" name="userid"><br>
        <input type="submit" value="Submit">
    </form>
    

</body>
</html>