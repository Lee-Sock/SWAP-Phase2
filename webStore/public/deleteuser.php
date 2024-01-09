<?php

function deleteuser($userid){
    
    require "config.php";
    
    try {
        $con=mysqli_connect($db_hostname,$db_username,$db_password,$db_database);
        
    }
    catch (Exception $e) {
        printerror($e->getMessage(),$con);
    }
    
    
    $query="DELETE FROM user WHERE userid = '$userid'";
    $result=mysqli_query($con,$query);
    
    mysqli_close($con);
    
    
}
?>

