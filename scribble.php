<tr>
    <td class="titleColumn">
        <?php
        if (($_SESSION['cartCount'] == 0) && (!isset($_GET['bookId']))){
            echo "";
        } else {
//                       foreach($_SESSION['books'] as $key=>$value) {
//                           if (($value['bookId']) == $_GET['bookId']) {
//                               echo $value['title'];
            foreach ($_SESSION['cartItems'] as $key=>$value) {
                echo $value['title'];
            }
        }

        ?>
    </td>
    <td class="quantityColumn">
        <!-- TODO need to put in form to update quantity-->
        <form action="cart.php" method="post">
            <input type="number" id="quantityInput" name="quantityInput" min="0" max="20"
                <?php
                if (($_SESSION['cartCount'] == 0) && (!isset($_GET['bookId']))) {
                    echo "";
                } else {
                    echo "value='" . $quantityInput . "'";
                }
                ?>>
            <input type="submit" id="updateButton" value="Update">
        </form>
    </td>
    <td class="priceColumn">
        <?php
        if (($_SESSION['cartCount'] == 0) && (!isset($_GET['bookId']))) {
            echo "";
        } else {
//                        foreach($_SESSION['books'] as $key=>$value) {
//                            if (($value['bookId']) == $_GET['bookId']) {
//                                echo "$".$value['price'];
            foreach ($_SESSION['cartItems'] as $key=>$value) {
                echo $value['price'];
            }
        }
        ?>
    </td>
    <td class="totalColumn">
        $9.99
    </td>
</tr>




// ADD ITEMS
//    if (isset($_GET['bookId'])) {
//        $bookId = $_GET['bookId'];
//        if (isset($_SESSION['cartItems'])) {
//            echo "cart NOT empty";
//            $cartItems = $_SESSION['cartItems'];
//
//            // Loop through the cartItems array.
//            $found = 0;
//                foreach ($cartItems as &$cartItem) {
//                    if ($cartItem['bookId'] == $_GET['bookId']) {
//                        $cartItem['quantityInput'] += 1;
//                        $found = 1;
//                } elseif ($found == 0) {
//                        //add the book
//                        echo "new book!";
//                        $db = new mysqli('localhost', 'root', 'Dmdenl1004!', 'delicious_book');
//                        $query = "SELECT bookId, title, price FROM book WHERE bookId = ?";
//                        $statement = $db->prepare($query);
//                        $statement->bind_param('s', $bookId);
//                        $statement->execute();
//                        $result = $statement->get_result();
//
//                        while ($book = $result -> fetch_assoc()) {
//                            echo "   This part is not working well   ";
//
//                            $cartItem = array('bookId'=>$book['bookId'], 'title'=>$book['title'], 'price'=>$book['price'], 'quantityInput'=>1);
//                            $cartItems[$book['bookId']] = $cartItem;
//
//                            echo $cartItems[$book['bookId']]['title'];
//                        }
//                    }
//            }
//        } else {
//            echo "cart empty";
//            $cartItems = array();
//            // Add the book into cart item
//            $db = new mysqli('localhost', 'root', 'Dmdenl1004!', 'delicious_book');
//            $query = "SELECT bookId, title, price FROM book WHERE bookId = ?";
//            $statement = $db->prepare($query);
//            $statement->bind_param('s', $bookId);
//            $statement->execute();
//            $result = $statement->get_result();

//            while ($book = $result -> fetch_assoc()) {
//                $cartItem = array('bookId'=>$book['bookId'], 'title'=>$book['title'], 'price'=>$book['price'], 'quantityInput'=>1);
//                $cartItems[$book['bookId']] = $cartItem;
//            }
//        }
//        $_SESSION['cartItems'] = $cartItems;
//        print_r($cartItems);
//    }
