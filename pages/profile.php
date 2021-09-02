<?php
session_start();
if(!isset($_SESSION['user']))
    header("refresh:0; url=../index.php")
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile | bookpass</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<meta charset="UTF-8"/>
	<link rel="shortcut icon" href="#"/>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../css/profile.css"/>
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
        <?php //php script start

        $db = 'bookpass';
        $host = 'localhost';
        $user = 'igor';
        $password = 'test';

        $conn = new mysqli($host, $user, $password, $db) or die("Cannot connect to the database");

        $curr_user = $_SESSION['user'];

        $sql = "SELECT user.user_id AS 'user_id', CONCAT(user.name, ' ', user.surname) AS 'full_name', user.email AS 'email', user.username AS 'username', LENGTH(user.password_hash) AS 'pwd_length', IFNULL((SELECT user.profile_image_path AS 'img' FROM user WHERE user.username RLIKE '^$curr_user$'), '../img/user/default.png') AS 'img' FROM user WHERE user.username RLIKE '^$curr_user$'";

        try {
            $res = $conn->query($sql);
            if(!isset($res)) throw new Exception('SQL query returned no results.');
            //$errors = 0;
            if ($res->num_rows > 0) { //-------------------------------------------------------------------------------------
                while( $row = $res->fetch_assoc()) {
                    $user_id = $row['user_id'];
                    $full_name = $row['full_name'];
                    $email = $row['email'];
                    $username = $row['username'];
                    $pwd_length = $row['pwd_length'];
                    $img = $row['img'];
                    //$errors++;
                }
            }//if ($errors == 0)
            else
                throw new Exception('SQL query for member not working correctly');

            $pwd_length_string = "";
            for($i = 0; $i < $pwd_length; $i++)
                $pwd_length_string .= "*";
            
            if (!isset($full_name) || !isset($email) || !isset($username) || !isset($pwd_length_string))
                throw new Exception('SQL returned some incorrect values.');
            echo '<div class="memberInfoDiv">';
                echo '<img src="' . $img . '" alt="Profile Picture" id="profilePicture"/>';
                echo '<div id="memberInfo">';
                    echo '<form id="memberInfoForm" name="memberInfoForm" method="POST" enctype="multipart/form-data" action="profileUpdateConfirm.php">';
                        echo '<p>Full name: ' . $full_name . '</p>';
                        echo '<p>Username: ' . $username . '</p>';
                        echo '<input type="text" id="newusername" name="newusername" class="toggleInput" placeholder="New username"/>';
                        echo '<p>Password: ' . $pwd_length_string . '</p>';
                        echo '<input type="password" id="newpassword" name="newpassword" class="toggleInput" placeholder="New password"/>';
                        echo '<p>E-mail: ' . $email . '</p>';
                        echo '<input type="text" id="newemail" name="newemail" class="toggleInput" placeholder="New e-mail"/>';
                        echo '<input type="hidden" name="userid" value="' . $user_id . '"/>';
                        echo '<input type="file" id="newimg" name="newimg" />';
                        echo '<input type="submit" id="updateSubmit" name="' . $user_id . '" value="Update" />';
                        echo '<button type="button" id="updateButton" name="updateButton">Show more</button>';
                    echo '</form>';
                    echo '<form id="deleteUser" name="deleteUser" method="POST" action="profileUpdateConfirm.php">';
                        echo '<hr>';
                        echo '<button type="submit" id="delete" name="delete" value="delete">Delete account</button>';
                    echo '</form>';
                echo '</div>';
            echo '</div>';
        } 
        catch (Exception $e) {
            echo '<p>Caught exception: ',  $e->getMessage(), "</p>\n";
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript" src="../js/profile.js"></script>
</body>

</html>