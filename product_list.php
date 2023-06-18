<?php
include "config.php";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

//testing connection success
if (mysqli_connect_errno()) {
    die("DB connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")");
}

//get data from DB
$query = "SELECT * FROM tbl_25_books order by book_name";
$result = mysqli_query($connection, $query);
if (!$result) {
    die("DB query failed.");
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>form for new or update</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>My Boutique Bookstore</title>
    <link rel="stylesheet" type="text/css" href="style/styles.css">
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Books</a></li>
                <li><a href="#">About</a></li>
            </ul>
        </nav>
    </header>
    
    <main id="dataServices">
        <section class="featured">
            <h1>Featured Books</h1>
            <!-- Replace with PHP code to fetch and display featured books from DB -->
        </section>
        <select id="categoryDropDown">
            <option value="">all categories</option>
            <option value="Children">Children</option>
            <option value="Fantasy">Fantasy</option>
            <option value="Fiction">Fiction</option>
        </select>
        <section class="books">
            <h1>All Books</h1>
            <?php
            echo '<div class="row mb-5">';
            while ($row = mysqli_fetch_assoc($result)) { //results are in associative array. keys are cols names
                $img = $row["image_path"];
                $bookId = $row['id'];
                if (!$img)
                $img = "images/default.jpg";
                $category = $row['category'];
                //output data from each row
                echo '<div class="col-sm-6">';
                echo '<div class="card" data-category="' . $category . '">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $row["book_name"] . " - " . $row["price"] . "$" . '</h5>' . '</div>';
                echo '<img src="' . $img . '" class="card-img-top">';
                echo '<a href="product_page.php?bookId=' . $bookId . '" id="seeProd" class="btn btn-primary">See product page</a>';
                echo '</div></div>';
            }
            
            echo '</div>';
            ?>
        </section>
        
        <?php
        //release returned data
        mysqli_free_result($result);
        ?>
    </main>

    <footer>
        <p>&copy; 2023 My Boutique Bookstore</p>
    </footer>
    <script src="./js/script.js"></script>
</body>

</html>
<?php
//close DB connection
mysqli_close($connection);
?>
