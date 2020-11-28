<!doctype html>
<html lang="en">
<head>
    <title>Delicious Book - Confirmation</title>

    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <link rel="stylesheet" type="text/css" href="css/confirmation.css"/>
</head>
<body>
<?php
session_start();
include('header.php');
?>
<main>
    <?php
    if (!isset($_SESSION['cartCount']) || ($_SESSION['cartCount'] == 0)) {
        echo "<h1> Nothing to check out here! </h1>";
    } else {
        echo "<h1>Thank you for your order.  Have a great day!</h1>";
        session_destroy();
    }
    ?>
    <p><a href='index.php' class='commandButton'>Return to Home</a></p>
</main>
</body>
</html>
