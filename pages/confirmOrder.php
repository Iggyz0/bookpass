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
	<link rel="stylesheet" type="text/css" href="../css/confirmOrder.css"/>
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
            $db = 'bookpass';
            $host = 'localhost';
            $user = 'igor';
            $password = 'test';
            $conn = new mysqli($host, $user, $password, $db) or die("Cannot connect to the database");

            $errors = 0;
            $item_list = array();
            $price_list = array();
            $total_books = 0;
            //$total_price = $_POST['totalPrice'];
            $adr = $_POST['address'];
            
            $usr_id = $_SESSION['user'];
            $sql = "SELECT user.user_id AS 'usr' FROM user WHERE user.username RLIKE '^$usr_id$' ";

            $res = $conn->query($sql);
            while ( $row = $res->fetch_assoc())
                $usr_id = $row['usr']; //get user id from DB (searching by $_SESSION['user'])

            //get payment_method_id
            $payment = $_POST['paymentMethod'];
            $sql = "SELECT payment_method_id AS 'pym_id' FROM payment_method WHERE payment_method.payment_name RLIKE '^$payment$' ";
            $res = $conn->query($sql);
            while ( $row = $res->fetch_assoc())
                $payment = $row['pym_id'];
            
            $total_price = 0;
            foreach ($_SESSION['items'] as $key=>$value) {
                $qnty = $_POST["$value"];

                $sql = "
                SELECT book.quantity AS 'available_quantity', book.price AS 'price' FROM book WHERE book.book_id = '$value'
                ";

                $res = $conn->query($sql);

                while ( $row = $res->fetch_assoc()) {
                    $available_quantity = $row['available_quantity'];
                    $price_list[] = $row['price'];
                    $total_price += ($qnty*$row['price']);
                }

                if ($available_quantity < $qnty || $qnty <= 0) {
                    $errors++;
                }
                else {
                    $available_quantity = $available_quantity - $qnty;
                    $sql = "
                    UPDATE book SET quantity = '$available_quantity' WHERE book.book_id = '$value'
                    ";
                    $conn->query($sql);

                    $item_list += [$value => $qnty];

                    $total_books += $qnty;


                }
            }

            if ($errors > 0 || !isset($_SESSION['items'])) {
                echo '<div id="orderMessage">Not enough books available.</div>';
                exit;
            }
            else {
                $sql = "INSERT INTO `order` (user_id, payment_method_id, total_price, shipping_address) VALUES ($usr_id, $payment, $total_price, '$adr')";
                $conn->query($sql) or die("Cannot insert into 'order' table.");

                $sql = "SELECT order_id AS 'ord' FROM `order` ORDER BY order.created_at DESC LIMIT 1";
                $res = $conn->query($sql);

                while ( $row = $res->fetch_assoc()) 
                    $ord = $row['ord'];
                $i = 0;
                foreach ($item_list as $book=>$qnty) {
                    $sql = "INSERT INTO order_items (order_id, book_id, quantity, price) VALUES ($ord, $book, $qnty, $price_list[$i])";
                    $conn->query($sql) or die("Cannot insert into 'order_items' table.");
                    $i++;
                }
                echo '<div id="orderMessage">';
                    $sql = "SELECT CONCAT(user.name, ' ', user.surname) AS 'fullname' FROM user WHERE user.user_id = $usr_id";
                    $res = $conn->query($sql);
                    while ( $row = $res->fetch_assoc()) 
                        $fullname = $row['fullname'];

                    $d=strtotime("+2 days"); //arrival time interval

                    echo '<p id="orderTitle">Order details:</p>';
                    echo '<p>Full name: ' . $fullname . '</p>';
                    echo '<p>Shipping address: ' . $adr . '</p>';
                    echo '<p>Number of books: ' . $total_books . '</p>';
                    echo '<p>Total price: ' . $total_price . '&pound;</p>';
                    echo '<hr>';
                    echo '<p>Order date: ' . date("l, d/m/Y, H:i:s") . '</p>';
                    echo '<p>Expected arrival: ' . date("d/m/Y", $d) . '</p>';
                    echo '<form id="confirmRedirect" name="confirmRedirect" action="../index.php">';
                        echo '<input type="submit" value="OK">';
                    echo '</form>';
                echo '</div>';

                unset($_SESSION['items']);
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script type="text/javascript" src="../js/orderItem.js"></script>
</body>

</html>