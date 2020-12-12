<!doctype html>
<html lang="en">
<head>
    <title>Delicious Book - Admin</title>

    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <link rel="stylesheet" type="text/css" href="css/adminHome.css"/>
</head>
<body>
<?php
session_start();
include('header.php');
?>
<main>
    <section id="topSection">
        <h1>Book Management</h1>
    </section>
    <?php
    if (!empty($_POST)) {
        $error = false;

        $title = $_POST['title'];
        $category = $_POST['category'];
        $author = $_POST['author'];
        $price = (float)$_POST['price'];
        $image = $_POST['image'];
        $readNow = $_POST['readNow'];
        $db = getDbConnection();

        if (isset($_POST['add']) || (isset($_POST['update']))) {
            if (empty($title)) {
                echo "<p class='errorMessage'> Title must be entered. </p>";
                $error = true;
            }
            if (empty($category)) {
                echo "<p class='errorMessage'> Category must be selected. </p>";
                $error = true;
            }
            if (empty($author)) {
                echo "<p class='errorMessage'> Author must be entered. </p>";
                $error = true;
            }
            if (empty($price)) {
                echo "<p class='errorMessage'> Price must be entered. </p>";
                $error = true;
            }
            if (!empty($price) && is_numeric($price) != 1){
                echo "<p class='errorMessage'> Price must be numbers. </p>";
                $error = true;
            }
            if (empty($image)) {
                echo "<p class='errorMessage'> Image must be entered. </p>";
                $error = true;
            }
            if (empty($readNow)) {
                echo "<p class='errorMessage'> Read Now must be selected. </p>";
                $error = true;
            }
            if (!$error) {
                if (isset($_POST['add'])) {
                    $stmt = $db->prepare("INSERT INTO book (categoryId, title, author, price, image, readNow) 
                        VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("sssssi", $category, $title, $author, $price, $image, $readNow);
                    $stmt->execute();
                    echo "The book is successfully added!";
                } elseif (isset($_POST['update'])) {
                    $stmt = $db->prepare("UPDATE book SET categoryId=?, author=?, price=?, image=?, readNow=? 
                        WHERE title=?");
                    $stmt->bind_param("ssssis", $category, $author, $price, $image, $readNow, $title);
                    $stmt->execute();
                    echo "The book is successfully updated!";
                }
            }
        } elseif (isset($_POST['delete'])) {
            if (empty($title)) {
                echo "<p class='errorMessage'> Title must be entered. </p>";
                $error = true;
            }
            if (empty($author)) {
                echo "<p class='errorMessage'> Author must be entered. </p>";
                $error = true;
            }
            $stmt = $db->prepare( "DELETE FROM book WHERE title=? AND author=?");
            $stmt->bind_param("ss", $title, $author);
            $stmt->execute();
            echo "The Book is successfully deleted.";
        }
    }
    ?>
    <section id="bottomSection">
        <section id="dataForm">
            <form id="bookForm" method="post" action="adminHome.php">
                <div id="bookTable">
                    <table>
                        <h3>Book Information</h3>
                        <tr>
                            <th><label for="title">Title</label></th>
                            <td><input class="inputField" type="text" id="title" name="title" placeholder="Modern Art Desserts"
                                    <?php
                                    if (isset($_POST["title"])) echo "value='" . $_POST["title"] . "'";
                                    ?>></td>
                        </tr>
                        <tr>
                            <th><label for="category">Category</label></th>
                            <td><select name="category" id="category">
                                    <option value="0">Select Category</option>
                                <?php
                                $categories = $_SESSION['categories'];

                                foreach($categories as $category){
                                    $selected = '';
                                    if(isset($_POST["category"]) && $_POST["category"] == $category['categoryId'] ){
                                        $selected = 'selected';
                                    }
                                    echo "<option value='$category[categoryId]' {$selected}>$category[categoryName]</option>";
                                }
                                ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th><label for="author">Author</label></th>
                            <td><input class="inputField" type="text" id="author" name="author" placeholder="Nancy Silverman"
                                <?php
                                if (isset($_POST["author"])) echo "value='" . $_POST["author"] . "'";
                                ?>></td>
                        </tr>
                        <tr>
                            <th><label for="price">Price</label></th>
                            <td><input class="inputField" type="text" id="price" name="price" placeholder="10.28"
                                    <?php
                                    if (isset($_POST["price"])) echo "value='" . $_POST["price"] . "'";
                                    ?>></td>
                        </tr>
                        <tr>
                            <th><label for="image">Image</label></th>
                            <td><input class="inputField" type="text" id="image" name="image" placeholder="modern_art_desserts.png"
                                    <?php
                                    if (isset($_POST["image"])) echo "value='" . $_POST["image"] . "'";
                                    ?>></td>
                        </tr>
                        <tr>
                            <th><label for="readNow">Read Now</label></th>
                            <td><input type="radio" name="readNow" value="Yes" <?php if (isset($_POST['readNow']) && $_POST['readNow']=='Yes');?> checked>
                                <label for="yes">Yes</label>
                                <input type="radio" name="readNow" value="No" <?php if (isset($_POST['readNow']) && $_POST['readNow']=='No') echo ' checked="checked"';?>>
                                <label for="no">No</label></td>
                        </tr>
                    </table>
                </div>
                <input id="submitButton" type="submit" name="add" value="Add New Book">
                <input id="submitButton" type="submit" name="update" value="Update Current Book">
                <input id="submitButton" type="submit" name="delete" value="Delete Current Book">
            </form>
        </section>
    <section id="information">
        <h3> Too Add or Update Books: </h3>
        <p>Please fill out complete form to add, update books.</p>
        <h3> To Delete Books: </h3>
        <p> Only title and author are required to delete books.</p>
    </section>
</main>
<?php
include('footer.php');
?>
</body>
</html>