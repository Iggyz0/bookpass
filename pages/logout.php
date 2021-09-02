<?php
session_start();
if (count($_COOKIE) > 0 ) {
    $cookie_name = "lifetime";
    $_SESSION['cookieval'] = $_COOKIE[$cookie_name];
    setcookie($cookie_name, "", time() - 3600); //destroy cookie
}
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
            echo "<br/>\n";
            echo "<p>User has spent " . (time()-$_SESSION['cookieval']) . " seconds on the website logged in.</p>";
            session_unset();
            session_destroy();
            header( "refresh: 3; url=../index.php" );
        ?>
        <div class="loginTextTop">
            <p class="loginTextMid">You have signed out. You will be redirected to the home page in <span class="countdown"></span> seconds.</p>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script type="text/javascript" src="../js/loginConfirm.js"></script>
</body>

</html>