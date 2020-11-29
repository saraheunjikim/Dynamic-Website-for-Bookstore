<header>
    <div id="leftHeader">
        <a href="index.php">
            <img src="images/logos/delicious_book_logo.png" alt="Delicious Book Logo">
        </a>
    </div>
    <div id="midHeader">
        <form id="searchBoxForm" action="searched.php" method="post">
            <input id="searchBox" type="text" name="search">
            <input id="searchIcon" type="image" src="images/logos/search_icon.png" alt="search icon">
        </form>
        <?php
        if (isset($_POST['search'])) {
            $searchedBook = "%{$_POST['search']}%";

            $db = new mysqli('localhost', 'root', '', 'delicious_book');
            $query = "SELECT * FROM book WHERE LOWER(title) LIKE ?";
            $statement = $db->prepare($query);
            $statement->bind_param('s', $searchedBook);
            $statement->execute();
            $result = $statement->get_result();
            $retrievedBooks = $result->fetch_all(MYSQLI_ASSOC);

            $_SESSION['retrievedBooks'] = $retrievedBooks;
        }

        ?>
        <div class="dropdown">
            <?php
            if (basename($_SERVER['PHP_SELF']) == "index.php") {
                $db = new mysqli('localhost', 'root', '', 'delicious_book');
                $query = "SELECT categoryId, categoryName FROM category";
                $statement = $db->prepare($query);
                $statement->execute();
                $result = $statement->get_result();
                $categories = $result->fetch_all(MYSQLI_ASSOC);
                $_SESSION['categories'] = $categories;
            }
            // CHECK THE NUMBER OF ITEMS IN THE CART.
            if (isset($_GET['bookId'])) {
                $_SESSION['cartCount'];
            } elseif (!isset($_SESSION['cartCount']) || (isset($_GET['clear']))) {
                $_SESSION['cartCount'] = 0;
            }
            ?>
            <p class="dropdownSelect">Select Category</p>
            <div class="dropdownContent">
                <?php
                if (isset($_SESSION['categories'])) {
                    $categories = $_SESSION['categories'];
                    foreach ($categories as $category) {
                        echo "<p><a href=\"category.php?categoryId=$category[categoryId]\"> $category[categoryName] </a></p>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <div id="rightHeader">
        <div id="cartIcon">
            <a href="cart.php">
                <img src="images/logos/shopping_cart_icon.png" alt="shopping cart icon">
            </a>
        </div>
        <div id=\"cartCount\"> <?php echo $_SESSION['cartCount'] ?> items</div>
        <div id="loginButton"><a href="#">login</a></div>
    </div>
</header>
