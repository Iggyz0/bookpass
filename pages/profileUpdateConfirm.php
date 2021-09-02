<?php
session_start();
if(!isset($_SESSION['user']))
    header("refresh:0; url=../index.php")
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile Update | bookpass</title>
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
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $db = 'bookpass';
        $host = 'localhost';
        $user = 'igor';
        $password = 'test';

        $conn = new mysqli($host, $user, $password, $db) or die("Cannot connect to the database");

        $curr_user = $_SESSION['userid'];

        if (isset($_POST['delete'])) {
            $curr_user_username = $_SESSION['user'];
            echo "User with user_id " . $curr_user . " and username: " . $curr_user_username . " is going to be deleted.\n";
            $sql = "DELETE FROM user WHERE user_id = $curr_user AND username RLIKE '^$curr_user_username$'"; //double proofing
            $conn->query($sql) or die('Cannot delete user.');
            session_unset();
            session_destroy();
            header("refresh: 3; url=../index.php");
        }
        else {
        $update_data = array('username' => $_POST['newusername'], 'password_hash' => $_POST['newpassword'], 'email' => $_POST['newemail']);
        $update_data = array_filter($update_data);

        if (!isset($update_data))
            die("No data to alter.");

        echo '<div class="loginTextTop">';
        foreach ($update_data as $attr=>$value) {
            $sql = "UPDATE user SET $attr = '$value' WHERE user.user_id = $curr_user";
            $conn->query($sql) or die("Could not update table. Check your code, man.");
            echo '<p class="loginTextMid">You have successfully updated your ' . $attr . ' to ' . $value . '.</p>';
        }
        echo '</div>';

        //image file handling ------------------------------------------------------------------------------
        if (!empty($_FILES['newimg']['name'])) {
            // File was selected for upload
        
            $target_dir = "../img/user/";
            $target_file = $target_dir . basename($_FILES["newimg"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // Check if image file is a actual image or not
            if(isset($_POST["$curr_user"])) {
                $check = getimagesize($_FILES["newimg"]["tmp_name"]);
                if($check !== false) {
                    $uploadOk = 1;
                } 
                else {
                    $uploadOk = 0;
                }
            }

            if (file_exists($target_file)) { // if file already exists, it will be used as an image profile - no uploading needed
                echo "<p>File already exists. Your image profile is being updated.</p>";
                $uploadOk = 0;
                $sql = "UPDATE user SET profile_image_path = '$target_file' WHERE user.user_id = $curr_user";
                $conn->query($sql) or die('Could not change profile image.');
            }

            if ($_FILES["newimg"]["size"] > 500000) { //file size of up to ~500KB is allowed
                echo "<p>File is too large. Image file size must be less than 500KB.</p>";
                $uploadOk = 0;
            }

            // Check file format (javascript is already doing this on the frontend), here we do even stricter check
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                echo "<p>Only JPG, JPEG, PNG & GIF files are allowed.</p>";
            $uploadOk = 0;
            }

            if ($uploadOk == 0) {
                echo "<p>Your file was not uploaded. It either exists or an error ocurred.</p>";
            } 
            else {
                if (move_uploaded_file($_FILES["newimg"]["tmp_name"], $target_file)) { // trying to upload
                    echo "<p>The file ". basename( $_FILES["newimg"]["name"]). " has been uploaded.</p>";
                    $sql = "UPDATE user SET profile_image_path = '$target_file' WHERE user.user_id = $curr_user";
                    $conn->query($sql) or die('Could not change profile image.');
                } 
                else {
                    echo "<p>There was an error uploading your file. Please try again.</p>";
                }
            }

        }
        //image file handling ------------------------------------------------------------------------------
        if(array_key_exists('username', $update_data))
            $_SESSION['user'] = $update_data['username'];
            header( "refresh: 3; url=profile.php" );
        }
    }
    else die('Not sent by _POST');   
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