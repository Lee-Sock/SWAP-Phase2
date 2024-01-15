<html>

<head>
<title>add shipping info</title>
</head>

<link rel="stylesheet" href="styles.css">



<body>
<?php
require_once "updateshippinginfo.php";

function printmessage($message) {
    echo "<pre>$message<br></pre>";
}

// return true if checks ok
function checkpost($input, $mandatory, $pattern) {
    
    $inputvalue=$_POST[$input];
    
    if (empty($inputvalue)) {
        printmessage("$input field is empty");
        if ($mandatory) { return false; }
        else { printmessage("but $input is not mandatory");}
    }
    if (strlen($pattern) > 0) {
        $ismatch=preg_match($pattern,$inputvalue);
        if (!$ismatch || $ismatch==0) {
            printmessage("$input field wrong format <br>");
            if ($mandatory) { return false;}
        }
    }
    return true;
}

$checkall=true;
$checkall=$checkall && checkpost("address",false,"");
$checkall=$checkall && checkpost("cardnumber",false,"");
$checkall=$checkall && checkpost("expiry",false,"");
$checkall=$checkall && checkpost("cvc",false,"");

if (!$checkall) {
    printmessage("Error checking inputs<br>Please return to the registration form");
    die();
}

$address=$_POST['address'];
$cardnumber=$_POST['cardnumber'];
$expiry=$_POST['expiry'];
$cvc=$_POST['cvc'];

updateshippinginfo($address,$cardnumber,$expiry,$cvc);

?>
</html>
</body>
