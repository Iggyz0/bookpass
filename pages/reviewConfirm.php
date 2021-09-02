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
	<link rel="stylesheet" type="text/css" href="../css/review.css"/>
</head>
<body>
<div id="contentContainer">
    <div class="topBar">
        <div class="logoMini">
            <a href="../index.php"><img src="../img/logo.png"/></a>
        </div>
        <!--<div id="searchForm">
            <form id="formSearch" name="formSearch" method="POST" action="browse.php">
                <input type="text" id="searchBar" name="searchBar" placeholder="Enter book title to search..."/>
                <button type="submit" id="searchButton"><i class="fa fa-search"></i></button>
            </form>
        </div>-->
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
        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_SESSION['user'])) {
                    $db = 'bookpass';
                    $host = 'localhost';
                    $user = 'igor';
                    $password = 'test';

                    $conn = new mysqli($host, $user, $password, $db) or die("Cannot connect to the database");
                    
                    //current user
                    $curr_user = $_SESSION['userid']; //user_id

                    //item data
                    $book_id = $_POST['submit'];
                    if(isset($_POST['rec']))
                        $is_rec = 1;
                    else
                        $is_rec = 0;
                    $user_review = $_POST['revtext'];
                    $book_score = $_POST['score'];

                    $sql = "SELECT user_book_id FROM user_book WHERE user_id = $curr_user AND book_id = $book_id";
                    $res = $conn->query($sql);
                    if($res->num_rows > 0) {
                        $sql = "UPDATE user_book SET review = '$user_review', score = $book_score, is_recommended = $is_rec WHERE user_id = $curr_user AND book_id = $book_id";

                        $conn->query($sql) or die('Could not update review');
                    }
                    else {
                        $sql = "INSERT INTO user_book (user_id, book_id, review, score, is_recommended) VALUES ($curr_user, $book_id, '$user_review', $book_score, $is_rec)";

                        $conn->query($sql) or die('Could not insert');
                    }

                    echo '<p>You have successfully sent your review!</p>';
                    header("refresh: 3; url=../index.php");
                    
                }
                else {
                    echo "<p>You have to be logged in first.</p>";
                    header("refresh: 3; url=login.php");
                }
            }
            else {
                echo "<p>Could not retrive data.</p>";
                header("refresh: 3; url=../index.php");
            }
        ?>
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
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript" src="../js/review.js"></script> -->
</body>

</html>