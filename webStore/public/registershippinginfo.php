<html>

<link rel="stylesheet" href="styles.css">


<body>
<?php
require_once "addshippinginfo.php";

function printmessage($message) {
    // echo "<script>console.log(\"$message\");</script>";
    echo "<pre>$message<br></pre>";
}

// return true if checks ok
function checkpost($input, $mandatory, $pattern) {
    
    $inputvalue=$_POST[$input];
    
    if (empty($inputvalue)) {
        printmessage("$input field is empty");
        if ($mandatory) return false;
        else printmessage("but $input is not mandatory");
    }
    if (strlen($pattern) > 0) {
        $ismatch=preg_match($pattern,$inputvalue);
        if (!$ismatch || $ismatch==0) {
            printmessage("$input field wrong format <br>");
            if ($mandatory) return false;
        }
    }
    return true;
}

$checkall=true;
$checkall=$checkall && checkpost("address",true,"");
$checkall=$checkall && checkpost("cardnumber",true,"");
$checkall=$checkall && checkpost("expiry",true,"");
$checkall=$checkall && checkpost("cvc",true,"");

if (!$checkall) {
    printmessage("Error checking inputs<br>Please return to the registration form");
    die();
}

$address=$_POST['address'];
$cardnumber=$_POST['cardnumber'];
$expiry=$_POST['expiry'];
$cvc=$_POST['cvc'];

addshippinginfo($address,$cardnumber,$expiry,$cvc);

?>
</html>
</body>
