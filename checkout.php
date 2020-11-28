<!doctype html>
<html lang="en">
<head>
    <title>Delicious Book - Checkout</title>

    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <link rel="stylesheet" type="text/css" href="css/checkout.css"/>

</head>
<body>
<?php
session_start();
include('header.php');
if ((!$_SESSION['cartCount']) || ($_SESSION['cartCount'] == 0)) {
    header("Location: confirmation.php");
    exit;
}
?>
<main>
    <section id="topSection">
        <h1>Checkout</h1>
    </section>
    <section id="bottomSection">
        <section id="dataForm">
            <p id="formTitleText">In order to purchase the items in your shopping cart, please provide the
                following information:</p>
            <!-- TODO Create a form for customer information -->
            <?php
            if (!empty($_POST)) {
                $error = false;
                if (empty($_POST["name"])) {
                    echo "<p class='errorMessage'> Name must be entered. </p>";
                    $error = true;
                }
                if (empty($_POST["address"])) {
                    echo "<p class='errorMessage'> Address must be entered. </p>";
                    $error = true;
                }
                if (empty($_POST["email"])) {
                    echo "<p class='errorMessage'> Email must be entered. </p>";
                    $error = true;
                }
                if (empty($_POST["phone"])) {
                    echo "<p class='errorMessage'> Phone must be entered. </p>";
                    $error = true;
                }
                if (!empty($_POST["phone"])) {
                    if (!preg_match("/^[2-9]\d{2}-\d{3}-\d{4}$/", $_POST['phone'])) {
                        $error = true;
                        echo "<p class='errorMessage'>Phone number is invalid</p>";
                    }
                }
                if (empty($_POST["card"])) {
                    echo "<p class='errorMessage'> Card number must be entered. </p>";
                    $error = true;
                }
                if (!empty($_POST["card"])) {
                    if (!preg_match("/(?:[0-9]{15,16})+/s", $_POST['card'])) {
                        $error = true;
                        echo "<p class='errorMessage'>Card number is invalid</p>";
                    }
                }
                if (($_POST["expMonth"]) == '0') {
                    echo "<p class='errorMessage'> Month must be selected. </p>";
                    $error = true;
                }
                if ($_POST["expYear"] == '0') {
                    echo "<p class='errorMessage'> Year must be selected. </p>";
                    $error = true;
                }
                if (!$error) {
                    header("Location: confirmation.php");
                    exit;
                }
            }
            ?>
            <form id="checkoutForm" method="post" action="checkout.php">
                <div id="checkoutTable">
                    <table>
                        <h3>Customer Information</h3>
                        <tr>
                            <th><label for="name">Full Name</label></th>
                            <td><input class="inputField" type="text" id="name" name="name" placeholder="Jone Doe"
                            <?php
                            if (isset($_POST["name"])) echo "value='" . $_POST["name"] . "'";
                            ?>></td>
                        </tr>
                        <tr>
                            <th><label for="address">Address</label></th>
                            <td><input class="inputField" type="text" id="address" name="address" placeholder="1234 Jane st, New York, NY 10001"
                            <?php
                            if (isset($_POST["address"])) echo "value='" . $_POST["address"] . "'";
                            ?>></td>
                        </tr>
                        <tr>
                            <th><label for="email">Email Address</label></th>
                            <td><input class="inputField" type="email" id="email" name="email" placeholder="abc@def.com"
                            <?php
                            if (isset($_POST["email"])) echo "value='" . $_POST["email"] . "'";
                            ?>></td>
                        </tr>
                        <tr>
                            <th><label for="phone">Phone Number</label></th>
                            <td><input class="inputField" type="text" id="phone" name="phone" placeholder="xxx-xxx-xxxx"
                            <?php
                            if (isset($_POST["phone"])) echo "value='" . $_POST["phone"] . "'";
                            ?>></td>
                        </tr>
                    </table>
                    <table>
                        <h3>Payment Information</h3>
                        <tr>
                            <th><label for="card">Credit Card</label></th>
                            <td><input class="inputField" type="text" id="card" name="card" placeholder="Numbers without space"
                            <?php
                            if (isset($_POST["card"])) echo "value='" . $_POST["card"] . "'";
                            ?>></td>
                        </tr>
                        <tr>
                            <th><label for="expDate">Expiration Date</label></th>
                            <td><select id="expMonth" name="expMonth">
                                <?php
                                $months = array('0' => 'Select Month',
                                    '1' => 'January',
                                    '2' => 'February',
                                    '3' => 'March',
                                    '4' => 'April',
                                    '5' => 'May',
                                    '6' => 'June',
                                    '7' => 'July',
                                    '8' => 'August',
                                    '9' => 'September',
                                    '10' => 'October',
                                    '11' => 'November',
                                    '12' => 'December'
                                );
                                foreach($months as $key => $value ){
                                    $selected = '';
                                    if(isset($_POST["expMonth"]) && $_POST["expMonth"] == $key ){
                                        $selected = 'selected';
                                    }
                                    echo "<option value='{$key}' {$selected}>{$value}</option>";
                                }
                                ?>
                                </select>
                                <select id="expYear" name="expYear">
                                    <option value="0">Select Year</option>
                                <?php
                                $currentYear = 2020;
                                foreach(range($currentYear, $currentYear+10) as $year) {
                                    $selected = '';
                                    if(isset($_POST["expYear"]) && $_POST["expYear"] == $year) {
                                        $selected = 'selected';
                                    }
                                    echo "<option value='$year' $selected>$year</option>";
                                }
                                ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
                <input id="submitButton" type="submit" value="Submit">
            </form>
        </section>
        <section id="checkoutSummary">
            <ul>
                <li>Next day delivery is guaranteed.</li>
                <li>A $5.00 shipping fee is applied to all orders</li>
            </ul>
            <div id="checkoutTotals">
                <table>
                    <tr>
                        <td>Cart Subtotal</td>
                        <td>
                            <?php echo "$".$_SESSION['cartTotal'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Shipping Fee</td>
                        <td>
                            $5.00
                        </td>
                    </tr>
                    <tr>
                        <td class="total">Total</td>
                        <td class="total">
                            <?php
                            $total = $_SESSION['cartTotal'] + 5;
                            echo "$".$total;
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
        </section>
    </section>
</main>
<?php
include('footer.php')
?>
</body>
</html>