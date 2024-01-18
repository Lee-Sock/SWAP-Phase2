<html>

<!-- External stylesheet link -->
<link rel="stylesheet" href="styles.css">

<body>
<?php
// Include the PHP file responsible for adding shipping information
require_once "addshippinginfo.php";

// Function to print messages in a formatted manner
function printmessage($message) {
    // Uncomment the line below if console.log is needed for debugging
    // echo "<script>console.log(\"$message\");</script>";
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
        if ($mandatory) return false;
        else printmessage("but $input is not mandatory");
    }

    // If a pattern is specified, perform pattern matching
    if (strlen($pattern) > 0) {
        $ismatch=preg_match($pattern,$inputvalue);
        // Check if the pattern matches or not
        if (!$ismatch || $ismatch==0) {
            printmessage("$input field wrong format <br>");
            // If the field is mandatory, return false
            if ($mandatory) return false;
        }
    }

    // If all checks pass, return true
    return true;
}

// Flag to check if all input validations pass
$checkall=true;

// Perform input validations for each field
$checkall=$checkall && checkpost("address", true, "");
$checkall=$checkall && checkpost("cardnumber", true, "");
$checkall=$checkall && checkpost("expiry", true, "");
$checkall=$checkall && checkpost("cvc", true, "");

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

// Call the function to add shipping information with the validated data
addshippinginfo($address,$cardnumber,$expiry,$cvc);

?>
</body>
</html>

