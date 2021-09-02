<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Browse | bookpass</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<meta charset="UTF-8"/>
	<link rel="shortcut icon" href="#"/>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../css/browse.css"/>
</head>
<body>
<div id="contentContainer">
    <div class="topBar">
        <div class="logoMini">
            <a href="../index.php"><img src="../img/logo.png"/></a>
        </div>
        <div id="searchForm">
            <form id="formSearch" name="formSearch" method="POST" action="browse.php">
                <input type="text" id="searchBar" name="searchBar" placeholder="Enter book title to search..."/>
                <button type="submit" id="searchButton"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <div class="profileMenu">
            <?php
            if(!isset($_SESSION['user'])) {
                echo '<ul>';
                    echo '<li><a href="orderItem.php">Cart <i class="fas fa-shopping-cart"></i></a></li>';
                    echo '<li><a href="login.php">Log in</a></li>';
                    echo '<li><a href="register.php">Register</a></li>';
                echo '</ul>';
            }
            else {
                echo '<ul>';
                    echo '<li><a href="orderItem.php">Cart <i class="fas fa-shopping-cart"></i></a></li>';
                    echo '<li><p>' . $_SESSION['user'] . '</p></li>';
                    echo '<li><a href="profile.php"><i class="fas fa-user-cog"></i>Profile</a></li>';
                    echo '<li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout </a></li>';
                echo '</ul>';
            }
            ?>
        </div>
    </div>
    <div class="midContent">
        <div class="midOptions">
            <div class="optionBox">
                <p class="filters">Filters:</p>
                <?php

                $db = 'bookpass';
                $host = 'localhost';
                $user = 'igor';
                $password = 'test';

                $conn = new mysqli($host, $user, $password, $db) or die("Cannot connect to the database");

                $sql = "SELECT genre_name FROM genre ORDER BY genre_name ASC";

                $res = $conn->query($sql);

                echo '<form id="formFilters" name="formFilters" method="POST" action="browse.php">';
                    echo '<p class="filterNames">Genre</p>';
                    echo '<ul>';
                        if ($res->num_rows > 0) {
                            while ( $row = $res->fetch_assoc()) {
                                echo '<li><input type="checkbox" class="genrechk" name="genre[]" value="' . $row['genre_name'] . '" /> ' . $row['genre_name'] . '</li>';
                            }
                        } else { echo "No results from DB. "; }
                    echo '</ul>';
                    echo '<p class="filterNames">Category</p>';
                    echo '<ul>';
                        $sql = "SELECT category_name FROM category ORDER BY category_name ASC";
                        $res = $conn->query($sql);
                        if ($res->num_rows > 0) {
                            while ( $row = $res->fetch_assoc()) {
                                echo '<li><input type="checkbox" class="catchk" name="category[]" value="' . $row['category_name'] . '" /> ' . $row['category_name'] . '</li>';
                            }
                        } else { echo "No results from DB. "; }
                    echo '</ul>';
                    echo '<p class="filterNames">Score</p>';
                    echo '<ul>';
                        echo '<li><input type="checkbox" class="scorechk" name="score[]" value="score > 5"/> > 5</li>';
                        echo '<li><input type="checkbox" class="scorechk" name="score[]"value="score < 5"/> < 5</li>';
                    echo '</ul>';
                    echo '<button type="submit" id="filterButton">Search by criteria</button>';
                    echo '<input type="hidden" name="searchFilter" value="filter"/>';
                echo '</form>';
                ?>
            </div>
        </div>
        <div class="midBrowsing">
            <?php

                    $db = 'bookpass';
                    $host = 'localhost';
                    $user = 'igor';
                    $password = 'test';

                    $conn = new mysqli($host, $user, $password, $db) or die("Cannot connect to the database");
                    if (isset($_POST['howToSort'])) {
                        $how_to_search = $_POST['howToSort'];
                        if ($how_to_search == "random") { //--------------------- return one random book from the database
                            $searchText = "Random book";
                            echo '<div class="browsingInfo">';
                                echo '<p>Search results for: "' . $searchText . '"';
                            echo '</div>';
                            echo '<div class="browsingResults">';
                            $sql = "
                            SELECT book.title AS 'title',
                            book.price AS 'price',
                            GROUP_CONCAT(DISTINCT CONCAT(author.`name`, ' ', author.surname) ORDER BY author.`name`) AS 'author',
                            book.book_id AS 'bookID',
                            book.image_path AS 'path'
                            FROM
                                book
                            INNER JOIN book_author ON book.book_id = book_author.book_id
                            INNER JOIN author ON book_author.author_id = author.author_id
                            GROUP BY book.book_id
                            ORDER BY RAND()
                            LIMIT 1;
                            
                            ";
                        }
                        else if ($how_to_search == "latest") { //---------------------- SORT BY DATE ADDED, newest first
                            $searchText = "Latest books";
                            echo '<div class="browsingInfo">';
                                echo '<p>Search results for: "' . $searchText . '"';
                            echo '</div>';
                            echo '<div class="browsingResults">';
                            $sql = "
                            SELECT book.title AS 'title',
                            book.price AS 'price',
                            GROUP_CONCAT(DISTINCT CONCAT(author.`name`, ' ', author.surname) ORDER BY author.`name`) AS 'author',
                            book.book_id AS 'bookID',
                            book.image_path AS 'path'
                            FROM
                                book
                            INNER JOIN book_author ON book.book_id = book_author.book_id
                            INNER JOIN author ON book_author.author_id = author.author_id
                            GROUP BY book.book_id
                            ORDER BY book.added_at DESC
                            
                            ";
                        }
                        else if ($how_to_search == "toplist") {
                            $searchText = "Toplist";
                            echo '<div class="browsingInfo">';
                                echo '<p>Search results for: "' . $searchText . '"';
                            echo '</div>';
                            echo '<div class="browsingResults">';
                            $sql = "
                            SELECT 
                                book.title AS 'title',
                                book.price AS 'price',
                                GROUP_CONCAT(DISTINCT CONCAT(author.`name`, ' ', author.surname) ORDER BY author.`name`) AS 'author',
                                book.book_id AS 'bookID',
                                book.image_path AS 'path',
                                IFNULL( ROUND( AVG(user_book.score), 2), 0) AS 'score'
                            FROM
                                book
                            INNER JOIN book_author ON book.book_id = book_author.book_id
                            INNER JOIN author ON book_author.author_id = author.author_id
                            LEFT JOIN user_book ON book.book_id = user_book.book_id
                            GROUP BY book.book_id
                            ORDER BY score DESC
                            
                            ";
                        }

                    }

                    // Custom search - by genre, category, score
                    else if ( (isset($_POST['genre']) && is_array($_POST['genre']) ) || isset($_POST['category']) || isset($_POST['score']) ) {
                        
                        if(isset($_POST['score']) && !empty($_POST['score'])) {  //--------------------------- deal with score
                            $filter_score = "";
                            foreach($_POST['score'] as $score)
                                $filter_score .= $score;
                        } else $filter_score = "score > -1";
                        
                        if (isset($_POST['category']) && !empty($_POST['category'])) { //------------------- deal with categories
                            $filter_category = "";
                            foreach($_POST['category'] AS $category)
                                $filter_category .= "'" . $category . "'";
                        } else $filter_category = "'%%'"  ; 

                        if (isset($_POST['genre']) && !empty($_POST['genre'])) { //--------------------deal with genre(s)
                            $filter_genre = "";
                            foreach($_POST['genre'] as $genre)
                                $filter_genre .= "genre_name LIKE " . "'" . $genre . "'" . " OR ";
                            $filter_genre = substr($filter_genre, 0, -4);
                            //$filter_genre_array = explode(",", $filter_genre);
                        } else $filter_genre = "genre_name LIKE '%%' OR genre_name IS NULL";

                        /*
                        echo "SCORE: " . $filter_score . "<br/>\n";
                        echo "CATEGORY: " . $filter_category . "<br/>\n";
                        if (!empty($filter_genre_array) )
                            print_r($filter_genre_array);
                        else
                            echo "GENRE: " . $filter_genre;

                        exit;
                        */

                        $searchText = "Custom Search";
                        echo '<div class="browsingInfo">';
                            echo '<p>Search results for: "' . $searchText . '"';
                        echo '</div>';
                        echo '<div class="browsingResults">';

                        $sql = "
                        SELECT
                            book.title AS 'title',
                            book.price AS 'price',
                            GROUP_CONCAT(DISTINCT CONCAT(author.`name`, ' ', author.surname) ORDER BY author.`name`) AS 'author',
                            book.book_id AS 'bookID',
                            book.image_path AS 'path',
                            IFNULL( ROUND( AVG(user_book.score), 2), 0) AS 'score'
                        FROM
                            book
                        INNER JOIN book_author ON book.book_id = book_author.book_id
                        INNER JOIN author ON author.author_id = book_author.author_id
                        LEFT JOIN book_genre ON book.book_id = book_genre.book_id
                        INNER JOIN category ON book.category_id = category.category_id
                        LEFT JOIN genre ON book_genre.genre_id = genre.genre_id
                        LEFT JOIN user_book ON book.book_id = user_book.book_id
                        WHERE ($filter_genre) AND category_name LIKE $filter_category
                        GROUP BY book.book_id
                        HAVING $filter_score;
                        ";

                        //echo $sql;
                        //exit;


                    }
                    else if(!isset($_POST["searchBar"])) { // SEARCH ALL BOOKS (FROM INDEX PAGE)-----------------------------
                        $searchText = "ALL";
                        echo '<div class="browsingInfo">';
                            echo '<p>Search results for: "' . $searchText . '"';
                        echo '</div>';
                        echo '<div class="browsingResults">';
                        $sql = "
                        SELECT book.title AS 'title',
                        book.price AS 'price',
                        GROUP_CONCAT(DISTINCT CONCAT(author.`name`, ' ', author.surname) ORDER BY author.`name`) AS 'author',
                        book.book_id AS 'bookID',
                        book.image_path AS 'path'
                        FROM
                            book
                        INNER JOIN book_author ON book.book_id = book_author.book_id
                        INNER JOIN author ON book_author.author_id = author.author_id
                        GROUP BY book.book_id; 
                        
                        ";
                    }
                    else {  //-------------------- Search books by value entered in the search bar
                        $searchText = $_POST["searchBar"];
                        echo '<div class="browsingInfo">';
                            echo '<p>Search results for: "' . $searchText . '"';
                        echo '</div>';
                        echo '<div class="browsingResults">';
                        $sql = "
                        SELECT book.title AS 'title',
                        book.price AS 'price',
                        GROUP_CONCAT(DISTINCT CONCAT(author.`name`, ' ', author.surname) ORDER BY author.`name`) AS 'author',
                        book.book_id AS 'bookID',
                        book.image_path AS 'path'
                        FROM
                            book
                        INNER JOIN book_author ON book.book_id = book_author.book_id
                        INNER JOIN author ON book_author.author_id = author.author_id
                        WHERE book.title LIKE '%$searchText%'
                        GROUP BY book.book_id; 
                        
                        ";
                    }
                    
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                        while ( $row = $result->fetch_assoc()) {
                            $title = $row['title'];
                            $price = $row['price'];
                            $author = $row['author'];
                            $book_id = $row['bookID'];
                            $path = $row['path'];
    
                            echo '<div class="browsingItem">';
                                echo '<img src=' . $path . ' />';
                                echo '<p class="browsingItemTitle">' . $title . '</p>';
                                echo '<p>' . $author . '</p>';
                                echo '<p>' . $price . '&pound;</p>';
                                echo '<form class="buyForm" name="buyForm" method="POST" action="orderItem.php">';
                                    //display different button depending on whether the cart contains the item or not
                                    if(isset($_SESSION['items']) && in_array($book_id, $_SESSION['items']))
                                        echo '<button type="submit" class="buyButton" name="' . $book_id . '" value="' . $book_id . '">Remove from cart</button>';
                                    else
                                        echo '<button type="submit" class="buyButton" name="' . $book_id . '" value="' . $book_id . '">Add to cart</button>';
                                
                                echo '</form>';
                                //review form button
                                echo '<div class="reviewWrap">';
                                    echo '<form class="reviewItem" name="reviewItem" method="POST" action="review.php">';
                                        echo '<input type="hidden" name="revimg" value="' . $path . '"/>';
                                        echo '<input type="hidden" name="revtitle" value="' . $title . '"/>';
                                        echo '<input type="hidden" name="revauthor" value="' . $author . '"/>';
                                        echo '<button type="submit" class="reviewButton" name="submit" value="' . $book_id . '"><i class="fas fa-user-edit"></i> Review</button>';
                                    echo '</form>';
                                echo '</div>';
                            echo '</div>';
                        }
                    }
                    else
                        echo '<p class="noResultP">Search found no results.</p>';

            echo '</div>'; //close div browsingResults

            //$conn->close();

            ?>
        </div>
    </div>
    <footer>
        <div class="socList">
			<ul class="socListUl">
				<li class="liFb"><a href="../index.php" target="_Blank"></a></li>
				<li class="liTw"><a href="../index.php" target="_Blank"></a></li>
				<li class="liYt"><a href="../index.php" target="_Blank"></a></li>
			</ul>
		</div>
		<div class="author">
			<p>Igor Markovic 2018202563 @ Singidunum University</p>
		</div>
		<div class="privacyPolicy">
			<p><a href="privacy.php">Privacy Policy</a></p>
		</div>
    </footer>
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript" src="../js/browse.js"></script>
</body>

</html>