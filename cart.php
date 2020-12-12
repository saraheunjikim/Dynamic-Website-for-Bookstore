<!doctype html>
<html lang="en">
<head>
    <title>Delicious Book - cart</title>
    <meta charset="utf-8">

    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/cart.css">
</head>
<body>
<main>
    <?php
    session_start();

    // Add to cart
    if (isset($_GET['bookId'])) {
        $bookId = $_GET['bookId'];
        $found = 0;
        foreach ($_SESSION['cartItems'] ?? [] as $cartItem) {
            if ($cartItem['bookId'] == $bookId) {
                $_SESSION['cartItems'][$bookId]['quantityInput']++;
                $found = 1;
                break;
            }
        }
        if ($found === 0) {
            $db = new mysqli('localhost', 'root', 'Dmdenl1004!', 'delicious_book');
            $query = "SELECT bookId, title, price FROM book WHERE bookId = ?";
            $statement = $db->prepare($query);
            $statement->bind_param('s', $bookId);
            $statement->execute();
            $result = $statement->get_result();

            while ($book = $result->fetch_assoc()) {
                $newCartItem = array_merge($book, ['quantityInput' => 1]);
                $_SESSION['cartItems'][$book['bookId']] = $newCartItem;
            }
        }
    }

    // INCREASE QUANTITY
    if (isset($_POST['bookId']) && isset($_POST['quantityInput'])) {
        $bookId = $_POST['bookId'];
        foreach ($_SESSION['cartItems'] as $cartItem) {
            if ($bookId == $cartItem['bookId']) {
                $_SESSION['cartItems'][$_POST['bookId']]['quantityInput'] = $_POST['quantityInput'];
            }
        }
    }

    // SELECTED CATEGORY
    if (isset($_SESSION['selectedCategory'])) {
        $selectedCategory = $_SESSION['selectedCategory'];
    }

    // TOTAL PRICE IN CART
    if (isset($_SESSION['cartItems']) && ($_SESSION['cartCount'] != 0)) {
        $totalItems = $_SESSION['cartItems'];
        $totalPrice = 0;
        foreach ($totalItems as $totalItem) {
            $price = $totalItem['price'];
            $quantity = $totalItem['quantityInput'];
            $totalPrice += ($price * $quantity);
        }
    } else {
        $totalPrice = 0;
    } $_SESSION['cartTotal'] = $totalPrice;

    // TOTAL QUANTITY IN CART
    $totalCount = 0;
    if (isset($_SESSION['cartItems'])) {
        foreach ($_SESSION['cartItems'] as $cartItem) {
            $totalCount += $cartItem['quantityInput'];
        }
    } $_SESSION['cartCount'] = $totalCount;

    include('header.php');
    ?>

    <h1>Your Shopping Cart</h1>
    <section id="topSection">
        <a href="cart.php?clear=clearCart" class="commandButton">Clear Cart</a>
        <a href="checkout.php" class="commandButton">Proceed to Checkout</a>
        <?php
        // If selectedCategory then go to that page
        if (isset($_SESSION['selectedCategory'])) {
            echo "<a href=\"category.php?categoryId=$_SESSION[selectedCategory]\" class=\"commandButton\">Continue Shopping</a>";
        } else {
            echo "<a href=\"index.php\" class=\"commandButton\">Continue Shopping</a>";
        }
        ?>
    </section>

    <section id="midSection">
        <?php
        if (!empty($_POST)) {
            $error = false;
            if (empty($_POST["quantityInput"])) {
                unset($_SESSION['cartItems'][$_POST['bookId']]);
                $error = true;
            }
        }
        ?>

        <table>
            <tr>
                <?php
                if (isset($_GET['clear']) && $_GET['clear'] == 'clearCart' || $_SESSION['cartCount'] == 0){
                    $_SESSION['cartCount'] = 0;
                    unset($_SESSION['cartItems']);
                    unset($_SESSION['selectedCategory']);
                    echo "<th><h3> The Cart is Empty! Please Add Books. </h3></th></tr><tr>";
                } elseif (isset($_SESSION['cartItems'])) {
                    echo "<th class=\"titleColumn\">Title</th>
                              <th class=\"quantityColumn\">Quantity</th>
                              <th class=\"priceColumn\">Price</th>
                              <th class=\"totalColumn\">Total Price</th>
                            </tr>
                            <tr>";
                    foreach ($_SESSION['cartItems'] as $cartItem) {
                        $total = $cartItem['price'] * $cartItem['quantityInput'];
                        echo "<td class=\"titleColumn\"> $cartItem[title] </td>
                              <td class=\"quantityColumn\">
                                  <form action=\"cart.php\" method=\"post\">
                                      <input type=\"number\" id=\"quantityInput\" name=\"quantityInput\" 
                                                    min=\"0\" max=\"20\" value=$cartItem[quantityInput]>
                                      <input type=\"hidden\" name=\"bookId\" value=$cartItem[bookId]>                                    
                                      <input type=\"submit\" id=\"updateButton\" value=\"Update\">
                                  </form>
                                  </td>
                              <td class=\"priceColumn\"> $$cartItem[price] </td>
                            <td class=\"totalColumn\"> $$total </td> </tr>";
                    }
                }
                ?>
        </table>
    </section>

    <section id="bottomSection">
        <!--                  Only show totals if something is in the cart-->
        <?php
        if (isset($_GET['clear']) && $_GET['clear'] == 'clearCart'){
            echo " ";
        } elseif ($_SESSION['cartCount'] == 0) {
            echo " ";
        } else {
            if ($_SESSION['cartCount'] > 1 ) {
                echo "<h2>You have " . $_SESSION['cartCount'] . " items in the cart</h2>";
            } else {
                echo "<h2>You have " . $_SESSION['cartCount'] . " item in the cart</h2>";
            }
            echo "<h2>Cart Total: $" . $totalPrice . "</h2>";
        }
        ?>
    </section>
    <?php
    include('footer.php')
    ?>
</main>
</body>



