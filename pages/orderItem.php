<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order | bookpass</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<meta charset="UTF-8"/>
	<link rel="shortcut icon" href="#"/>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../css/orderItem.css"/>
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
        echo '<div class="order">';
            
                if(!isset($_SESSION['user'])) {
                    header( "refresh: 0; url=login.php" );
                }
                else {
                    if(isset($_SESSION['items'])) {
                        $db = 'bookpass';
                        $host = 'localhost';
                        $user = 'igor';
                        $password = 'test';
                        $conn = new mysqli($host, $user, $password, $db) or die("Cannot connect to the database");

                        //$total = 0; //total price

                        foreach ( $_SESSION['items'] as $key=>$value) {

                            $sql = "
                            SELECT book.title AS 'title',
                            book.price AS 'price',
                            GROUP_CONCAT(CONCAT(author.`name`, ' ', author.surname) ORDER BY author.`name`) AS 'author',
                            book.quantity AS 'quantity',
                            book.book_id AS 'bookID',
                            book.image_path AS 'path'
                            FROM
                                book
                            INNER JOIN book_author ON book.book_id = book_author.book_id
                            INNER JOIN author ON book_author.author_id = author.author_id
                            WHERE book.book_id = '$value'
                            GROUP BY book.book_id; 
                            ";

                            $result = $conn->query($sql);

                            while ( $row = $result->fetch_assoc()) {
                                $title = $row['title'];
                                $price = $row['price'];
                                $author = $row['author'];
                                $quantity = $row['quantity'];
                                $book_id = $row['bookID'];
                                $path = $row['path'];
        
                                //$total = $total + $price;

                                echo '<div class="browsingItem">';
                                    echo '<img src=' . $path . ' />';
                                    echo '<p class="browsingItemTitle">' . $title . '</p>';
                                    echo '<p>' . $author . '</p>';
                                    echo '<p>' . $price . '&pound;</p>';
                                    echo '<p>Available: ' . $quantity . '</p>';
                                    echo '<label for="qnty">Amount:</label>';
                                    echo '<input type="number" class="amount" name="' . $book_id . '" form="orderForm" placeholder="0" min="1" max="' . $quantity . '"/>';
                                    echo '<form class="buyForm" name="buyForm" method="POST" action="orderItem.php">';
                                    //display different button depending on whether the cart contains the item or not
                                    if(isset($_SESSION['items']) && in_array($book_id, $_SESSION['items']))
                                        echo '<button type="submit" class="buyButton" name="' . $book_id . '" value="' . $book_id . '">Remove from cart</button>';
                                    else
                                        echo '<button type="submit" class="buyButton" name="' . $book_id . '" value="' . $book_id . '">Add to cart</button>';
                                
                                echo '</form>';
                                echo '</div>';
                            } //end while





                        } //end foreach

                        echo '</div>';
                        //get available payment methods
                        $sql = "SELECT payment_method.payment_name AS 'payment' FROM payment_method";
                
                        $result = $conn->query($sql);
                
                        // user order input settings
                        echo '<div class="infoDiv">';
                        echo '<form id="orderForm" name="orderForm" method="POST" action="confirmOrder.php">'; //confirmOrder.php form
                            //echo '<p id="totalPrice">Total price: ' . $total . '&pound;</p>';
                            //echo '<input type="hidden" name="totalPrice" value="' . $total . '" />';
                            echo '<label for="paymentMethod">Payment Method:</label>';
                            echo '<select id="paymentMethod" name="paymentMethod">';
                            while ( $row = $result->fetch_assoc())
                                echo '<option value="' . $row['payment'] . '">' . $row['payment'] . '</option>';
                            echo '</select>';
                
                            echo '<label for="address">Shipping Address:</label>';
                            echo '<input type="text" id="address" name="address" placeholder="Beogradska ulica b4 11000 Beograd"/>';
                
                            echo '<button type="submit" id="orderButton" name="orderButton">Order</button>';
                        echo '</form>';
                
                        echo '</div>';

                    } //end ifset $_SESSION

                    else { //data is not available
                        echo '<div class="orderMessage">';
                            echo '<p>No items in your cart.</p>';
                        echo '</div>';
                    }
                    

                } //end else branch ()
            
        
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script type="text/javascript" src="../js/orderItem.js"></script>
</body>

</html>