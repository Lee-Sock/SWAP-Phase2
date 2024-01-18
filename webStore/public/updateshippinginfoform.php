<html>

<link rel="stylesheet" href="styles.css">



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
<body style="font-family: Arial, sans-serif; background-color: #f0f0f0; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0;">
    <div style="background-color: white; padding: 40px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); text-align: center;">

        <h2>Update Shipping info</h2>

        <form action="changeshippinginfo.php" method="post" autocomplete="off" style="display: flex; flex-direction: column; align-items: center; justify-content: center; margin: auto;">

            <div style="display: flex; flex-direction: row; align-items: center; margin-bottom: 10px; width:300px;">
                <label for="address" style="width: 120px;">Address</label>
                <input type="text" name="address" id="address" >
            </div>

            <div style="display: flex; flex-direction: row; align-items: center; margin-bottom: 10px;width:300px;">
                <label for="cardnumber" style="width: 120px;">Card number</label>
                <input type="text" name="cardnumber" id="cardnumber">
            </div>

            <div style="display: flex; flex-direction: row; align-items: center; margin-bottom: 10px;width:300px;">
                <label for="expiry" style="width: 120px;">Expiry Date</label>
                <input type="text" name="expiry" id="expiry" >
            </div>

            <div style="display: flex; flex-direction: row; align-items: center; margin-bottom: 10px;width:300px;">
                <label for="cvc" style="width: 120px;">CVC</label>
                <input type="password" name="cvc" id="cvc" >
            </div>

            <button type="submit" name="submit">Update</button>
        </form>
    </div>
</body>



</html>