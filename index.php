<!DOCTYPE html>
<html lang="en">
<head>
    <title>Delicious Book</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
<?php
session_start();
include('header.php');
unset($_SESSION['selectedCategory']);
?>
<section>
    <div class="welcomeContainer">
        <div id="welcomeText"> <h1> Welcome to Delicious Book store, <br>
            where you can find delicious foods <br> in the books!</h1>
            <p> As a specialized book store, we have many cooking books on
                holiday specials, vegetarian, desserts, and cultural cuisines.</p>
            <p> The book store is located in Midtown, New York City. However,
                we offer our service online; as we understand, going to bookstores
                can be difficult during a pandemic. We are putting a lot of effort
                into making our books free from germs or any virus, so you do not
                have to worry; let us do all the hard works!</p>
            <p> Anyway, we are glad you are here! Please feel free to contact us
                for anything, and we would love to hear from you.
                Enjoy our delicious books! </p>
        </div>

        <div id="categoryBox"> <h2> Shop By Category </h2>
            <div class="imagesContainer">
                    <?php
                    if (isset($_SESSION['categories'])) {
                        $categories = $_SESSION['categories'];
                        foreach ($categories as $category) {
                            echo "<div class=\"container\"> <a href=\"category.php?categoryId=$category[categoryId]\">
                                    <img src=\"images/categories/" . (str_replace(' ', '_', strtolower($category['categoryName']))) . ".jpg\" 
                                         alt=\"$category[categoryName]\" class=\"image\">
                                    <div class=\"overlay\"> <div class=\"text\">$category[categoryName]</div> </div> </a> </div> ";
                        }
                    }
                    ?>
            </div>
        </div>
    </div>
</section>
<?php
include('footer.php');
?>
</body>
</html>
