<!DOCTYPE html>
<html lang="en">
<head>
    <title>Delicious Book</title>
    <meta charset="utf-8">
    <meta name="description" content="The homepage for Delicious Book">

    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/category.css">
</head>

<body class="home">
<main>
    <?php
    session_start();
    include('header.php');
    ?>
    <section>
        <div class="contentsContainer">
            <div class="sidebarContainer">
                <div class="sidebar">
                    <?php
                    if (isset($_GET['categoryId'])) {
                        $selectedCategory = $_GET['categoryId'];
                        $_SESSION['selectedCategory'] = $selectedCategory;

                        if (isset($_SESSION['categories'])) {
                            $categories = $_SESSION['categories'];

                            foreach ($categories as $category) {
                                if ($selectedCategory == $category['categoryId']) {
                                    echo "<a href=\"category.php?categoryId=$category[categoryId]\" class=\"selected\">$category[categoryName]</a>";
                                } else {
                                    echo "<a href=\"category.php?categoryId=$category[categoryId]\">$category[categoryName]</a>";
                                }
                            }
                        }
                    }
                    ?>
                </div>
            </div>

            <div class="booksContainer">
                <?php
               $db = new mysqli('localhost', 'root', 'Dmdenl1004!', 'delicious_book');
               $query = "SELECT bookId, title, author, price, image, readNow FROM book WHERE categoryId = ?";
               $statement = $db->prepare($query);
               $statement->bind_param('s', $selectedCategory);
               $statement->execute();
               $result = $statement->get_result();

               while ($book = $result->fetch_assoc()) {
                        echo "<div class=\"bookItem\">
                                  <img src=\"images/books/$book[image]\" alt=\"$book[image]\" class=\"image\">
                                  <ul>
                                      <li class=\"title\"> $book[title] </li>
                                      <li class=\"author\"> $book[author] </li>
                                      <li class=\"price\"> $$book[price] </li>
                                  </ul>
                                  <div class=\"buttons\">
                                      <a href=\"cart.php?bookId=$book[bookId]\"> <button class=\"button buttonCart\">Add to Cart</button> </a>";
                        if ($book['readNow'] == 0) {
                            echo "</div> </div>";
                        } else {
                            echo "<a href=\"#\"> <button class=\"button buttonOnline\">Read Now</button> </a>
                                  </div> </div>";
                        }
                }
                ?>
            </div>
    </section>
    <?php
    include('footer.php');
    ?>
</main>
</body>
</html>