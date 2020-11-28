<!DOCTYPE html>
<html lang="en">
<head>
    <title>Delicious Book</title>
    <meta charset="utf-8">
    <meta name="description" content="The homepage for Delicious Book">

    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/searched.css">
</head>

<body class="home">
<main>
    <?php
    session_start();
    include('header.php');
    ?>
<section>
    <div class="contentsContainer">
        <div class="searchResult">
            <h3> Search Result for <?php echo "'{$_POST['search']}'"; ?>: </h3>
        </div>
        <div class="booksContainer">
        <?php
        if (isset($_SESSION['retrievedBooks'])) {
            $retrievedBooks = $_SESSION['retrievedBooks'];
            foreach ($retrievedBooks as $retrievedBook) {
                echo "<div class=\"bookItem\">
                                  <img src=\"images/books/$retrievedBook[image]\" alt=\"$retrievedBook[image]\" class=\"image\">
                                  <ul>
                                      <li class=\"title\"> $retrievedBook[title] </li>
                                      <li class=\"author\"> $retrievedBook[author] </li>
                                      <li class=\"price\"> $$retrievedBook[price] </li>
                                  </ul>
                                  <div class=\"buttons\">
                                      <a href=\"cart.php?bookId=$retrievedBook[bookId]\"> <button class=\"button buttonCart\">Add to Cart</button> </a>";
                if ($retrievedBook['readNow'] == 0) {
                    echo "</div> </div>";
                } else {
                    echo "<a href=\"#\"> <button class=\"button buttonOnline\">Read Now</button> </a>
                                  </div> </div>";
                }
            }
        }
        ?>
        </div>
    </div>
</section>
<?php
include('footer.php');
?>
</main>
</body>
</html>