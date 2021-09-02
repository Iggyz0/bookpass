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
	<link rel="stylesheet" type="text/css" href="../css/loginConfirm.css"/>
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
            <ul>
                <li><a href="login.php">Log in</a></li>
                <li><a href="register.php">Register</a></li>
            </ul>
        </div>
    </div>
    <div class="midContent">
        <?php

            //php class Login where we store user data
            class Login {
                public $username;
                public $password;
                public $user_id;
            
                function __construct($username, $password) {
                    $this->username = $username;
                    $this->password = $password;
                }

                function __destruct(){}

                public function check_login() {
                    $sql = "
                    SELECT user.username AS 'username', user.password_hash AS 'pwd', user.user_id AS 'userID' FROM user WHERE user.username RLIKE '^$this->username$'
                    ";

                    $db = 'bookpass';
                    $host = 'localhost';
                    $user = 'igor';
                    $pwd = 'test';

                    $conn = new mysqli($host, $user, $pwd, $db) or die("Cannot connect to the database");
                    $result = $conn->query($sql);

                    if ( $result->num_rows > 0) {
                        while( $row = $result->fetch_assoc()) {
                            $usr_check = $row['username'];
                            $pwd_check = $row['pwd'];
                            $this->user_id = $row['userID'];
                        }
                    
                    
                        if($usr_check == $this->username && $pwd_check == $this->password) {
                            echo '<div class="loginTextTop">';
                                echo '<p class="loginTextMid">You have successfully logged in. You will be redirected to the home page in <span class="countdown"></span> seconds.</p>';
                            echo '</div>';
                            return TRUE;
                        }
                        else {
                            echo '<div class="loginTextTop">';
                                echo '<p class="loginTextMid">Incorrect password. Please try again.</p>';
                            echo '</div>';
                            header( "refresh: 3; url=login.php" );
                            return FALSE;
                        }
                    }
                    else {
                    
                        echo '<div class="loginTextTop">';
                            echo '<p class="loginTextMid">Error ocurred, could not log-in. Please make sure that you have entered the correct  username.</p>';
                        echo '</div>';
                        header( "refresh: 3; url=login.php" );
                        return FALSE;
                    }
                }
                
            }

            //php get data and check
            $login = new Login($username=$_POST["username"], $password=$_POST["pwd"]);

            if ($login->check_login()) {
                $_SESSION['user'] = $login->username;
                $_SESSION['userid'] = $login->user_id;
                header( "refresh: 0; url=../index.php" );
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
	<script type="text/javascript" src="../js/loginConfirm.js"></script>
</body>

</html>