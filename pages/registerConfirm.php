<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register | bookpass</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<meta charset="UTF-8"/>
	<link rel="shortcut icon" href="#"/>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../css/registerConfirm.css"/>
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
            $db = 'bookpass';
            $host = 'localhost';
            $user = 'igor';
            $pwd = 'test';

            $conn = new mysqli($host, $user, $pwd, $db) or die("Cannot connect to the database");

            class Member {
                public $name, $surname, $dateOfBirth, $email, $pwd, $username; //all is public for testing purposes

                function __construct($name, $surname, $dateOfBirth, $email, $pwd, $username) {
                    $this->name = $name;
                    $this->surname = $surname;
                    $this->dateOfBirth = $dateOfBirth;
                    $this->email = $email;
                    $this->pwd = $pwd;
                    $this->username = $username;
                }

                function __destruct(){}

                public function NewMemberWelcome() {
                    echo '<div class="memberWelcome">';
                        echo '<p>Thank you for registering ' . $this->name . '. Your chosen username is "' . $this->username . '"</p>';
                        echo '<p>You can access your profile info using "Profile" button in the top right.</p>';
                        echo '<p>Enjoy your stay!</p>';
                        echo '<br/>';
                        echo '<p>You will be redirected to the home page shortly.</p>';
                    echo '</div>';
                }
            }

            $new_username = $_POST['username'];
            $new_email = $_POST['email'];

            //$new_username = 'igm1234';
            //$new_email = 'email@email.com';
            $sql = "SELECT IFNULL((SELECT user.user_id FROM user WHERE user.username RLIKE '^$new_username$'),0) AS 'usr'";
            $res = $conn->query($sql);
            try {
                
                    while( $row = $res->fetch_assoc())
                        $username_chk = $row['usr'];
                
                if($username_chk != 0) throw new Exception('User already exists.');
                else {
                    //echo "Username is available.";
                    $sql = "SELECT IFNULL((SELECT user.user_id FROM user WHERE user.email RLIKE '^$new_email$'),0) AS 'email'";
                    $res = $conn->query($sql);
                    while( $row = $res->fetch_assoc())
                        $email_chk = $row['email'];
                    if($email_chk != 0) throw new Exception('E-mail already exists.');
                    else {
                        $new_member = new Member($_POST['name'], $_POST['surname'], $_POST['dateOfBirth'], $new_email, $_POST['pwd'], $new_username );
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $sql = "INSERT INTO user (name, surname, date_of_birth, email, username, password_hash) 
                            VALUES ('$new_member->name', '$new_member->surname', '$new_member->dateOfBirth', '$new_member->email', '$new_member->username', '$new_member->pwd')";
                            if(mysqli_query($conn, $sql)) {
                                $sql = "SELECT user.user_id AS 'user_id' FROM user WHERE user.username RLIKE '^$new_member->username$' ";
                                $res = $conn->query($sql);
                                if ($res->num_rows > 0) {
                                    while( $row = $res->fetch_assoc())
                                        $new_user_id = $row['user_id'];
                                }
                                else { echo "Could not retrive user_id."; exit;}
                                
                                $_SESSION['user'] = $new_member->username;
                                $_SESSION['userid'] = $new_user_id;
                                
                                header('refresh:3 ; url=../index.php');
                            }
                            else throw new Exception('Cannot insert into table "user"');
                            $new_member->NewMemberWelcome();
                        }
                    }
                }
            }
            catch (Exception $e) {
                echo '<div class="memberWelcome">';
                    echo '<p>Caught exception: ',  $e->getMessage(), "</p>\n";
                echo '</div>';
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
	<script type="text/javascript" src="../js/register.js"></script>
</body>

</html>