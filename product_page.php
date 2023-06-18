<?php
//create a mySQL DB connection:
include "config.php";

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

//testing connection success
if (mysqli_connect_errno()) {
    die("DB connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")"
    );
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>form for new or update</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="./js/script.js"></script>
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

    <main>
        <section class="featured">
            <h1>Featured Books</h1>
        </section>

        <section class="books">
            <h1>All Books</h1>
            <?php


            $query = 'SELECT * FROM tbl_25_books WHERE id="' . $_GET["bookId"] . '"';

            // echo $query;
            $result = mysqli_query($connection, $query);
            if ($result) {
                $row = mysqli_fetch_assoc($result); //there is only 1 with id=X
                $img = $row["image_path"];
                $img2 = $row["image_path_2"];
                echo '<h3>Category ' . $row["category"] . '</h3>';
                echo '<h3>' . $row["book_name"] . ' - ' . $row['price'] . '$' . '</h3>';
                echo '<div class="row">';
                echo '<div class="col-sm-6">';
                echo '<div class="card">';
                echo '<img src="' . $img . '" class="card-img-top">';
                echo '</div></div>';
                echo '<div class="col-sm-6">';
                echo '<div class="card">';
                echo '<img src="' . $img2 . '" class="card-img-top">';
                echo '</div></div></div>';
            } else
                die("DB query failed.");
            
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
</body>

</html>
<?php
//close DB connection
mysqli_close($connection);
?>