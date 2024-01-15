
<style>
    body {
        font-family: 'Arial', sans-serif;
        background: #f0f0f0 url(/finalphase2/SWAP-Phase2/webStore/public/inventoryimages/background3.jpg) no-repeat center center fixed;
        background-size: cover;
        margin: 0;
        padding: 0;
    }

    h1 {
        color: #333;
    }

    .container {
        width: 80%;
        margin: 0 auto;
    }

    .topnav {
        background-color: #333; /* Set a background color for the top nav */
        overflow: hidden;
    }

    .topnav a {
        float: left;
        display: block;
        color: #f2f2f2;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    .topnav a:hover {
        background-color: #fff;
        color: black;
    }

    /* Add a common style for all navigation links */
    .topnav a, .welcome a {
        text-decoration: none;
        color: white; /* Change the color to your preference */
        font-size: 16px; /* Change the font size to your preference */
        font-family: Arial, sans-serif; /* Change the font family to your preference */
        padding: 15px; /* Adjust the padding as needed */
        display: inline-block;
    }

    /* Style the "Welcome" section */
    .welcome {
        float: right;
        display: inline-block;
        padding: 15px; /* Adjust the padding as needed */
        color:violet ;
    }
</style>

<nav class="topnav">
    <a href="usermain.php">Home</a>
    

    <a href="checkout.php">checkout</a>
    <?php if (isset($row["username"])): ?>
        <div class="welcome">
            Welcome, <?php echo $row["username"];?>
        </div>
        <a href="logout.php">Logout</a>
    <?php endif; ?>
</nav>


