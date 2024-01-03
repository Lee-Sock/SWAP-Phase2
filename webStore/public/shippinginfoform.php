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
    <b>Register Shipping Information</b><br>
    <form action="registershippinginfo.php" method="post">
        Address: <input type="text" name="address"><br>
        Card Number: <input type="text" name="cardnumber"><br>
        Expiry Date: <input type="text" name="expiry"><br>
        CVC: <input type="text" name="cvc"><br>
        <input type="submit" value="Submit">
    </form>

</body>
</html>
