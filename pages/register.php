<!DOCTYPE html>
<html>
<head>
    <title>Register | bookpass</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<meta charset="UTF-8"/>
	<link rel="shortcut icon" href="#"/>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../css/register.css"/>
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
        <div class="loginTextTop">
            <p>Please fill out the registration form:</p>
        </div>
        <div class="formWrap">
            <form id="regForm" name="regForm" method="POST" action="registerConfirm.php">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" placeholder="Your name" required/>
                <label for="surname">Surname:</label>
                <input type="text" id="surname" name="surname" placeholder="Your surname" required/>
                <label for="dateOfBirth">Date of birth:</label>
                <input type="date" id="dateOfBirth" name="dateOfBirth"/>
                <label for="email">E-mail:</label>
                <input type="text" id="email" name="email" placeholder="Your e-mail address" required/>

                <label for="username">Username (to log-in to the website):</label>
                <input type="text" id="username" name="username" placeholder="Username" required/>
                <label for="pwd">Password:</label>
                <input type="password" id="pwd" name="pwd" placeholder="Password" required/>
                <label for="pwdC">Confirm your password:</label>
                <input type="password" id="pwdC" name="pwdC" placeholder="Confirm password" required/>

                <ul>
                    <li><input type="checkbox" id="agree" name="agree"/> I agree with the privacy policy</li>
                </ul>
                <button type="submit" id="regSend" name="regSend" value="Register">Register</button>
            </form>
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
	<script type="text/javascript" src="../js/register.js"></script>
</body>

</html>