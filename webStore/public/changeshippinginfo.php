<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <!-- Title for the HTML document -->
    <title>add shipping info</title>
</head>

<!-- External stylesheet link -->
<link rel="stylesheet" href="styles.css">

<body>
<?php
// Include the PHP file responsible for updating shipping information
require_once 'updateshippinginfo.php';

// Function to print messages in a formatted manner
function printmessage($message) {
    echo "<pre>$message<br></pre>";
}

// Function to check POST data with optional pattern validation
// Returns true if checks pass, false otherwise
function checkpost($input, $mandatory, $pattern) {
    
    // Retrieve POST data for the specified input
    $inputvalue=$_POST[$input];
    
    // Check if the input is empty
    if (empty($inputvalue)) {
        printmessage("$input field is empty");
        // Check if the field is mandatory or not
        if ($mandatory) {
            return false;
        } else {
            printmessage("but $input is not mandatory");
        }
    }

    // If a pattern is specified, perform pattern matching
    if (strlen($pattern) > 0) {
        $ismatch=preg_match($pattern,$inputvalue);
        // Check if the pattern matches or not
        if (!$ismatch || $ismatch==0) {
            printmessage("$input field wrong format <br>");
            // If the field is mandatory, return false
            if ($mandatory) {
                return false;
            }
        }
    }

    // If all checks pass, return true
    return true;
}

// Flag to check if all input validations pass
$checkall=true;

// Perform input validations for each field
$checkall=$checkall && checkpost("address",false,"");
$checkall=$checkall && checkpost("cardnumber",false,"");
$checkall=$checkall && checkpost("expiry",false,"");
$checkall=$checkall && checkpost("cvc",false,"");

// If any validation fails, display an error message and terminate
if (!$checkall) {
    printmessage("Error checking inputs<br>Please return to the registration form");
    die();
}

// Retrieve validated POST data
$address=$_POST['address'];
$cardnumber=$_POST['cardnumber'];
$expiry=$_POST['expiry'];
$cvc=$_POST['cvc'];

// Call the function to update shipping information with the validated data
updateshippinginfo($address,$cardnumber,$expiry,$cvc);

?>
</body>
</html>


