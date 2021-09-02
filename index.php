<?php
session_start();
if(isset($_SESSION['user'])) {
    $cookie_name = "lifetime";
    $cookie_value = time();
    setcookie($cookie_name, $cookie_value, time()+(86400*30), "/");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home | bookpass</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<meta charset="UTF-8"/>
    <link rel="shortcut icon" href="#"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/w3.css"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    
    <?php
        //-------------------------------------                     OBAVEZNO                               ----------------------------------------
        //------------------ OVDE POCETI KOMENTAR NAKON PRVOG POKRETANJA SAJTA (ZA BLOK KREIRANJA BAZE NA INDEX.php) ------------------------------

        /*    // MOZE OVDE

        $db='bookpass';
        $host = 'localhost';
        $user = 'igor';
        $password = 'test';

        // connection -----------------------------------------------------
        $conn = new mysqli($host, $user, $password, $db) or die("Cannot connect to the database");

        $fkchk = "SET FOREIGN_KEY_CHECKS = 0";

        // drop table list -----------------------------------------------------
        $drop_table = "
        DROP TABLE IF EXISTS author, book, user, user_book, book_author, book_genre, category, genre, order_items, payment_method, `order`
        ";

        // create table data -----------------------------------------------------
        $sql = "

        CREATE TABLE `author`  (
        `author_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
        `added_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
        `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
        `surname` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
        PRIMARY KEY (`author_id`) USING BTREE
        ) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic; 

        CREATE TABLE `book`  (
        `book_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
        `added_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
        `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
        `image_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
        `price` decimal(10, 2) UNSIGNED NOT NULL,
        `category_id` int(10) UNSIGNED NOT NULL,
        `quantity` int(10) UNSIGNED NOT NULL,
        PRIMARY KEY (`book_id`) USING BTREE,
        INDEX `fk_book_category_id`(`category_id`) USING BTREE,
        CONSTRAINT `fk_book_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE RESTRICT ON UPDATE CASCADE
        ) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

        CREATE TABLE `book_author`  (
        `book_author_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
        `book_id` int(10) UNSIGNED NOT NULL,
        `author_id` int(10) UNSIGNED NOT NULL,
        PRIMARY KEY (`book_author_id`) USING BTREE,
        INDEX `fk_book_author_book_id`(`book_id`) USING BTREE,
        INDEX `fk_book_author_author_id`(`author_id`) USING BTREE,
        CONSTRAINT `fk_book_author_author_id` FOREIGN KEY (`author_id`) REFERENCES `author` (`author_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
        CONSTRAINT `fk_book_author_book_id` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE RESTRICT ON UPDATE CASCADE
        ) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

        CREATE TABLE `book_genre`  (
        `book_genre_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
        `book_id` int(10) UNSIGNED NOT NULL,
        `genre_id` int(10) UNSIGNED NOT NULL,
        PRIMARY KEY (`book_genre_id`) USING BTREE,
        INDEX `fk_book_genre_book_id`(`book_id`) USING BTREE,
        INDEX `fk_book_genre_genre_id`(`genre_id`) USING BTREE,
        CONSTRAINT `fk_book_genre_book_id` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
        CONSTRAINT `fk_book_genre_genre_id` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`genre_id`) ON DELETE RESTRICT ON UPDATE CASCADE
        ) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

        CREATE TABLE `category`  (
        `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
        `category_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
        PRIMARY KEY (`category_id`) USING BTREE,
        UNIQUE INDEX `uq_category_category_name`(`category_name`) USING BTREE
        ) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

        CREATE TABLE `genre`  (
        `genre_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
        `genre_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
        PRIMARY KEY (`genre_id`) USING BTREE,
        UNIQUE INDEX `uq_genre_genre_name`(`genre_name`) USING BTREE
        ) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

        CREATE TABLE `order`  (
        `order_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
        `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
        `user_id` int(10) UNSIGNED NOT NULL,
        `payment_method_id` int(10) UNSIGNED NOT NULL,
        `total_price` decimal(10, 2) UNSIGNED NOT NULL,
        `shipping_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
        PRIMARY KEY (`order_id`) USING BTREE,
        INDEX `fk_order_user_id`(`user_id`) USING BTREE,
        INDEX `fk_order_payment_method_id`(`payment_method_id`) USING BTREE,
        CONSTRAINT `fk_order_payment_method_id` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_method` (`payment_method_id`) ON DELETE CASCADE ON UPDATE CASCADE,
        CONSTRAINT `fk_order_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
        ) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

        CREATE TABLE `order_items`  (
        `order_items_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
        `order_id` int(10) UNSIGNED NOT NULL,
        `book_id` int(10) UNSIGNED NOT NULL,
        `quantity` int(10) UNSIGNED NOT NULL,
        `price` decimal(10, 2) UNSIGNED NOT NULL,
        PRIMARY KEY (`order_items_id`) USING BTREE,
        INDEX `fk_order_items_order_id`(`order_id`) USING BTREE,
        INDEX `fk_order_items_book_id`(`book_id`) USING BTREE,
        CONSTRAINT `fk_order_items_book_id` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE,
        CONSTRAINT `fk_order_items_order_id` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE
        ) ENGINE = InnoDB AUTO_INCREMENT = 32 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

        CREATE TABLE `payment_method`  (
        `payment_method_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
        `payment_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
        PRIMARY KEY (`payment_method_id`) USING BTREE,
        UNIQUE INDEX `uq_payment_method_payment_name`(`payment_name`) USING BTREE
        ) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

        CREATE TABLE `user`  (
        `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
        `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
        `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
        `surname` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
        `date_of_birth` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
        `email` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
        `username` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
        `password_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
        `profile_image_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
        PRIMARY KEY (`user_id`) USING BTREE,
        UNIQUE INDEX `uq_user_email`(`email`) USING BTREE,
        UNIQUE INDEX `uq_user_username`(`username`) USING BTREE
        ) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

        CREATE TABLE `user_book`  (
        `user_book_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
        `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
        `user_id` int(10) UNSIGNED NOT NULL,
        `book_id` int(10) UNSIGNED NOT NULL,
        `review` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
        `score` tinyint(2) UNSIGNED NOT NULL,
        `is_recommended` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
        PRIMARY KEY (`user_book_id`) USING BTREE,
        UNIQUE INDEX `uq_book_user_user_id_book_id`(`user_id`, `book_id`) USING BTREE,
        INDEX `fk_book_user_book_id`(`book_id`) USING BTREE,
        CONSTRAINT `fk_book_user_book_id` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
        CONSTRAINT `fk_book_user_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
        ) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

        ";
        
        // insert data ----------------------------------------------------------------------------------
        $sql_insert_data = "

        INSERT INTO `author` VALUES (1, '2020-05-12 12:17:13', 'John', 'Ronald Reuel Tolkien');
        INSERT INTO `author` VALUES (2, '2020-05-12 12:18:00', 'Andrzej', 'Sapkowski');
        INSERT INTO `author` VALUES (3, '2020-05-12 12:19:04', 'Fyodor', 'Mikhailovich Dostoevsky');
        INSERT INTO `author` VALUES (4, '2020-05-12 12:19:38', 'Ivo', 'Andric');
        INSERT INTO `author` VALUES (5, '2020-05-12 12:20:13', 'Mesa', 'Selimovic');
        INSERT INTO `author` VALUES (6, '2020-05-12 12:20:42', 'William', 'Shakespeare');
        INSERT INTO `author` VALUES (7, '2020-05-12 12:22:07', 'Stephen Edwin', 'King');
        INSERT INTO `author` VALUES (8, '2020-05-12 12:22:45', 'Ernest Miller', 'Hemingway');
        INSERT INTO `author` VALUES (9, '2020-05-12 12:24:04', 'Patrick James', 'Rothfuss');
        INSERT INTO `author` VALUES (10, '2020-05-12 12:25:29', 'Johann Wolfgang', 'Goethe');
        INSERT INTO `author` VALUES (11, '2020-05-12 12:47:49', 'Isaac', 'Newton');
        INSERT INTO `author` VALUES (12, '2020-05-18 17:54:47', 'Sasha', 'Alsberg');
        INSERT INTO `author` VALUES (13, '2020-05-18 17:55:05', 'Lindsay', 'Cummings');

        INSERT INTO `book` VALUES (1, '2020-05-12 12:36:12', 'The Lord of the Rings', '../img/books/book1.jpg', 27.00, 3, 162);
        INSERT INTO `book` VALUES (2, '2020-05-12 12:37:01', 'Faust', '../img/books/book1.jpg', 25.00, 3, 29);
        INSERT INTO `book` VALUES (3, '2020-05-12 12:37:38', 'Na drini cuprija', '../img/books/book1.jpg', 12.00, 1, 6);
        INSERT INTO `book` VALUES (5, '2020-05-12 12:38:12', 'Prokleta avlija', '../img/books/book1.jpg', 8.00, 2, 640);
        INSERT INTO `book` VALUES (6, '2020-05-12 12:39:00', 'Old man and the sea', '../img/books/book1.jpg', 6.00, 1, 42);
        INSERT INTO `book` VALUES (7, '2020-05-12 12:40:01', 'Name of the wind', '../img/books/book1.jpg', 14.25, 3, 26);
        INSERT INTO `book` VALUES (8, '2020-05-12 12:41:05', 'Macbeth', '../img/books/book1.jpg', 17.50, 3, 754);
        INSERT INTO `book` VALUES (9, '2020-05-12 12:48:56', 'Philosophiæ Naturalis Principia Mathematica', '../img/books/book1.jpg', 25.00, 7, 14);
        INSERT INTO `book` VALUES (10, '2020-05-13 20:24:26', 'The Lord of the Rings (trilogy)', '../img/books/book1.jpg', 50.00, 3, 79);
        INSERT INTO `book` VALUES (11, '2020-05-18 17:54:17', 'Zenith', '../img/books/book1.jpg', 31.00, 3, 64);

        INSERT INTO `book_author` VALUES (1, 1, 1);
        INSERT INTO `book_author` VALUES (2, 2, 10);
        INSERT INTO `book_author` VALUES (3, 3, 4);
        INSERT INTO `book_author` VALUES (4, 5, 4);
        INSERT INTO `book_author` VALUES (5, 6, 8);
        INSERT INTO `book_author` VALUES (9, 10, 1);
        INSERT INTO `book_author` VALUES (10, 7, 9);
        INSERT INTO `book_author` VALUES (11, 8, 6);
        INSERT INTO `book_author` VALUES (12, 9, 11);
        INSERT INTO `book_author` VALUES (13, 11, 12);
        INSERT INTO `book_author` VALUES (14, 11, 13);

        INSERT INTO `book_genre` VALUES (1, 1, 2);
        INSERT INTO `book_genre` VALUES (2, 1, 1);
        INSERT INTO `book_genre` VALUES (3, 2, 1);
        INSERT INTO `book_genre` VALUES (4, 2, 6);
        INSERT INTO `book_genre` VALUES (5, 3, 4);
        INSERT INTO `book_genre` VALUES (6, 6, 3);
        INSERT INTO `book_genre` VALUES (7, 7, 1);
        INSERT INTO `book_genre` VALUES (8, 7, 3);
        INSERT INTO `book_genre` VALUES (9, 8, 1);
        INSERT INTO `book_genre` VALUES (10, 9, 7);
        INSERT INTO `book_genre` VALUES (11, 9, 11);
        INSERT INTO `book_genre` VALUES (12, 11, 2);
        INSERT INTO `book_genre` VALUES (13, 11, 9);

        INSERT INTO `category` VALUES (4, 'Art & Photography');
        INSERT INTO `category` VALUES (5, 'Business, Law');
        INSERT INTO `category` VALUES (6, 'Dictionary');
        INSERT INTO `category` VALUES (1, 'Education');
        INSERT INTO `category` VALUES (2, 'Entertainment');
        INSERT INTO `category` VALUES (3, 'Fiction');
        INSERT INTO `category` VALUES (7, 'Science');

        INSERT INTO `genre` VALUES (3, 'Adventure');
        INSERT INTO `genre` VALUES (10, 'Biography');
        INSERT INTO `genre` VALUES (1, 'Fantasy');
        INSERT INTO `genre` VALUES (4, 'History');
        INSERT INTO `genre` VALUES (5, 'Horror');
        INSERT INTO `genre` VALUES (6, 'Mystery');
        INSERT INTO `genre` VALUES (11, 'Philosophy');
        INSERT INTO `genre` VALUES (8, 'Poetry');
        INSERT INTO `genre` VALUES (2, 'Sci-fi');
        INSERT INTO `genre` VALUES (7, 'Science');
        INSERT INTO `genre` VALUES (9, 'Thriller');

        INSERT INTO `order` VALUES (16, '2020-05-17 01:38:58', 1, 3, 77.00, 'Beogradska 6 11000 Beograd');
        INSERT INTO `order` VALUES (17, '2020-05-17 01:40:36', 1, 3, 25.00, 'Beogradska 6 11000 Beograd');
        INSERT INTO `order` VALUES (18, '2020-05-17 02:00:14', 1, 3, 39.00, 'Beogradska 6 11000 Beograd');
        INSERT INTO `order` VALUES (19, '2020-05-17 02:03:28', 1, 1, 33.00, 'Beogradska 6 11000 Beograd');
        INSERT INTO `order` VALUES (20, '2020-05-17 02:26:40', 1, 2, 75.00, 'asfafsagdgagsgsfhsrhrhshshsh');
        INSERT INTO `order` VALUES (21, '2020-05-17 02:27:20', 1, 3, 50.00, '');
        INSERT INTO `order` VALUES (22, '2020-05-17 02:40:13', 1, 3, 25.00, 'Beogradskaasf');
        INSERT INTO `order` VALUES (23, '2020-05-18 14:27:12', 2, 3, 27.00, 'Bsahafsj 4 ');
        INSERT INTO `order` VALUES (24, '2020-05-18 14:31:16', 2, 2, 27.00, 'Beogradska b4');
        INSERT INTO `order` VALUES (25, '2020-05-18 14:54:37', 2, 3, 204.00, 'Beogradkasd 7');

        INSERT INTO `order_items` VALUES (18, 16, 1, 3, 27.00);
        INSERT INTO `order_items` VALUES (19, 16, 10, 1, 50.00);
        INSERT INTO `order_items` VALUES (20, 17, 9, 1, 25.00);
        INSERT INTO `order_items` VALUES (21, 18, 1, 3, 27.00);
        INSERT INTO `order_items` VALUES (22, 18, 3, 1, 12.00);
        INSERT INTO `order_items` VALUES (23, 19, 2, 3, 25.00);
        INSERT INTO `order_items` VALUES (24, 19, 5, 1, 8.00);
        INSERT INTO `order_items` VALUES (25, 20, 10, 1, 50.00);
        INSERT INTO `order_items` VALUES (26, 20, 9, 1, 25.00);
        INSERT INTO `order_items` VALUES (27, 21, 10, 1, 50.00);
        INSERT INTO `order_items` VALUES (28, 22, 2, 3, 25.00);
        INSERT INTO `order_items` VALUES (29, 24, 1, 3, 27.00);
        INSERT INTO `order_items` VALUES (30, 25, 1, 2, 27.00);
        INSERT INTO `order_items` VALUES (31, 25, 10, 3, 50.00);

        INSERT INTO `payment_method` VALUES (3, 'Cash');
        INSERT INTO `payment_method` VALUES (2, 'Credit Card');
        INSERT INTO `payment_method` VALUES (1, 'PayPal');

        INSERT INTO `user` VALUES (1, '2020-05-15 19:30:41', 'Igor', 'Markovic', '2020-05-15 19:30:09', 'email@email.com', 'igm1234', 'test1234', '../img/user/blackmage.jpg');
        INSERT INTO `user` VALUES (2, '2020-05-17 10:26:44', 'Marko', 'Markovic', '2001-02-07', 'mark@email.com', 'mmark1234', 'Ajd proba 123!', '../img/user/172065.jpg');
        INSERT INTO `user` VALUES (17, '2020-05-17 10:50:00', 'Branko', 'Brankovic', '2001-05-15', 'email7@email.com', 'branbro1234', 'Ajd proba 123!', '../img/user/172065.jpg');

        INSERT INTO `user_book` VALUES (1, '2020-05-17 22:35:08', 1, 1, 'Excellent book, would recommend to everyone to read if they like adventres!', 10, 1);
        INSERT INTO `user_book` VALUES (2, '2020-05-17 22:41:26', 17, 1, 'Yes! Some of the best, if not the best, fantasy book!', 10, 1);
        INSERT INTO `user_book` VALUES (3, '2020-05-18 14:58:05', 2, 9, 'Phesajd ioasjdio sjoaihaosf osafusahfohasfu! OHOUHfsaufh!', 8, 0);
        INSERT INTO `user_book` VALUES (4, '2020-05-18 18:09:12', 1, 2, 'Asafjahfi ahfsahsf afhaifhafdai', 4, 0);
        INSERT INTO `user_book` VALUES (5, '2020-05-18 18:09:48', 2, 1, 'Afsauhfau afuhiafhui asifuhauifd', 9, 1);
        INSERT INTO `user_book` VALUES (7, '2020-05-18 18:37:35', 2, 2, 'Ajsfaojas asoifjaoifjaso joasfias', 7, 1);
        INSERT INTO `user_book` VALUES (8, '2020-05-18 18:37:56', 2, 7, 'Afajifao aiodfjaidf', 6, 0);
        INSERT INTO `user_book` VALUES (9, '2020-05-18 18:38:26', 1, 8, 'Jfaeufuii aenifuaiufnia eifun', 9, 1);

        ";

        $conn->query($fkchk) or die("cannot disable fk check"); //disable foreign key check
        $conn->query($drop_table) or die("drop not working");  //drop all tables
        $conn->multi_query($sql) or die("create not working") ; //create all tables
        while ($conn->next_result()) {;} //flush multi query

        $conn->multi_query($sql_insert_data) or die("insert data not working") ; //insert all static data
        while ($conn->next_result()) {;}

        $fkchk = "SET FOREIGN_KEY_CHECKS = 1;"; 
        $conn->query($fkchk) or die("cannot enable fk check"); //enable foreign key check

        $conn->close();







        */    // MOZE OVDE

        //------------------ OVDE ZATVORITI KOMENTAR NAKON PRVOG POKRETANJA SAJTA (ZA BLOK KREIRANJA BAZE NA INDEX.php) ---------------------------
        //-------------------------------------                     OBAVEZNO                               ----------------------------------------
    ?> 
</head>
<body>
    <div id="mainContainer">
        <div id="mainBarTop">
            <?php
            if (!isset($_SESSION['user'])) {
                echo '<ul>';
                    echo '<li><a href="pages/login.php"><i class="fas fa-user"></i> Log in </a></li>';
                    echo '<li><a href="pages/register.php"><i class="fas fa-users"></i> Register </a></li>';
                echo '</ul>';
            }
            else {
                echo '<ul>';
                    echo '<li><a href="pages/orderItem.php">Cart <i class="fas fa-shopping-cart"></i></a></li>';
                    echo '<li><p>' . $_SESSION['user'] . '</p></li>';
                    echo '<li><a href="pages/profile.php"><i class="fas fa-user-cog"></i>Profile</a></li>';
                    echo '<li><a href="pages/logout.php"><i class="fas fa-sign-out-alt"></i> Logout </a></li>';
                echo '</ul>';
            }
            ?>
        </div>
        <div id="midBelt">
            <div id="welcomeText">
                <br/>
                <p>Welcome to BOOK PASS - your first stop when searching for new adventures and worlds to explore!</p>
                <br/>
                <p>Enjoy your stay!</p>
                <br/>
            </div>
            <div id="logo">
                <img src="img/logo.png"/>
            </div>
            <div id="navigationList">
                <ul>
                    <form id="indexForm" name="indexForm" method="POST" action="pages/browse.php">
                        <li><button type="submit" id="latestButton" value="latest"><i class="far fa-clock"></i><p>Latest</p></button></li>
                        <li><button type="submit" id="toplistButton" value="toplist"><i class="fas fa-list-ol"></i><p>Toplist</p></button></li>
                        <li><button type="submit" id="randomButton" value="random"><i class="fas fa-random"></i><p>Random book</p></button></li>
                        <input type="hidden" id="howToSort" name="howToSort"/>
                    </form>
                </ul>
            </div>
            <div id="searchForm">
                <form id="formSearch" name="formSearch" method="POST" action="pages/browse.php">
                    <input type="text" id="searchBar" name="searchBar" placeholder="Enter book title to search..."/>
                    <button type="submit" id="searchButton"><i class="fa fa-search"></i></button>
                </form>
            </div>
            <div id="midNav">
                <ul>
                    <li><a href="pages/browse.php">Browse all</a></li>
                    <!--<li><a href="#">About us</a></li>
                    <li><a href="#">Contact</a></li>-->
                </ul>
            </div>
            <br/>
            <div id="featuredText">
                <p>Featured gallery:</p>
            </div>
            <br/>
            <div class="featured">
               
            </div>
            <!-- W3 slider -->
            <div class="w3-content w3-display-container" style="max-width:800px">
                <img class="mySlides" src="img/background1.jpg" style="width:100%">
                <img class="mySlides" src="img/background2.jpg" style="width:100%">
                <img class="mySlides" src="img/background3.jpg" style="width:100%">
                <div class="w3-center w3-container w3-section w3-large w3-text-white w3-display-bottommiddle" style="width:100%">
                    <div class="w3-left w3-hover-text-khaki" onclick="plusDivs(-1)">&#10094;</div>
                    <div class="w3-right w3-hover-text-khaki" onclick="plusDivs(1)">&#10095;</div>
                    <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(1)"></span>
                    <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(2)"></span>
                    <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(3)"></span>
                </div>
            </div>
            <hr/>
            <div id="announcements">
                <p><b>Announcements</b></p> 
                <p>Here you will read the latest news regarding the site...</p>
                <p>Latest forum posts...</p>
                <p>Newest member of the community...</p>
            </div>
            <hr/>
            <br/>
        </div>
        <div class="footer">
            <ul>
                <li><a href="pages/privacy.php"><i class="fas fa-book-open"></i> Privacy Policy</a></li>
                <li><a href="#"><i class="fas fa-envelope-square"></i> Contact Author</a></li>
            </ul>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
</body>
</html>