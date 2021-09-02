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
	<link rel="stylesheet" type="text/css" href="../css/privacy.css"/>
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
        <div class="pCont">
            <p class="pTitle">Privacy Policy</p>
            <p class="pText">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec leo nisl, placerat vel tempor venenatis, condimentum quis arcu. Vestibulum rhoncus, diam ut blandit molestie, nisl justo fermentum libero, at malesuada mauris libero ut sapien. Vestibulum vulputate tellus non lorem bibendum, eget cursus diam sollicitudin. Etiam venenatis consectetur volutpat. Nam euismod nisi eleifend, vestibulum ante id, accumsan nulla. Pellentesque iaculis aliquam nulla. Donec felis enim, ornare id sapien et, dignissim eleifend nibh. Morbi pellentesque, libero a ultricies fermentum, lorem libero porta erat, in commodo purus nulla eu erat. Interdum et malesuada fames ac ante ipsum primis in faucibus. Quisque lectus erat, aliquam et est et, malesuada porta nisl. Maecenas ut ullamcorper urna. Aenean facilisis nunc nibh, non scelerisque nisl egestas quis. Proin et tempus tellus, ac suscipit sem. Mauris eleifend lectus eu nisl accumsan vehicula.

            Nam cursus tincidunt faucibus. Sed a urna elementum, interdum dui tincidunt, blandit arcu. Nullam volutpat eleifend elementum. Nulla et volutpat est, vitae fringilla metus. Cras bibendum erat orci, euismod condimentum erat sagittis a. Vestibulum nec faucibus erat, sit amet dapibus elit. Quisque eros felis, efficitur ut quam non, pulvinar varius ex. Praesent nec velit felis. Vivamus sit amet hendrerit magna. Etiam porttitor, justo ut consequat gravida, massa ex facilisis leo, vel pulvinar lorem dui sed risus.

            Nunc hendrerit molestie nibh ullamcorper blandit. Suspendisse mattis dolor a enim lacinia, in ullamcorper sem ornare. Suspendisse mollis rhoncus ligula, lacinia porta ligula vulputate vel. Nullam vel viverra neque. Etiam rhoncus aliquet ex non pellentesque. Aenean tincidunt feugiat leo eu ultricies. Sed finibus augue facilisis nunc aliquam, at egestas velit efficitur.

            Ut a lectus a massa imperdiet mattis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Sed at urna purus. Aenean ipsum metus, venenatis non turpis rhoncus, tincidunt suscipit quam. Maecenas hendrerit, eros vitae porttitor vestibulum, eros risus mollis enim, quis vulputate odio eros rutrum ipsum. Quisque gravida eros eu dolor hendrerit euismod. Cras auctor dolor mi, ut tristique mi pharetra quis. In fringilla blandit ex et placerat. Vivamus luctus, metus ut vestibulum faucibus, tortor augue euismod nisl, sed pulvinar est augue eget ligula. Donec vitae sodales lectus. Morbi bibendum mauris nec posuere tristique. Donec dapibus tortor eu neque venenatis, in tempus sem consectetur. Nam in mauris varius, pharetra massa hendrerit, feugiat tellus. In mollis erat a sapien pulvinar, sit amet facilisis metus accumsan. Donec sapien purus, tristique vitae consequat sit amet, interdum ultrices elit.

            In ornare leo a hendrerit ultrices. Nunc vestibulum sagittis urna, vitae tincidunt purus tincidunt non. Maecenas vitae consectetur tortor. Quisque venenatis justo eu nunc rutrum scelerisque. Sed non tempus augue. Duis ligula metus, rhoncus tincidunt enim id, rutrum lobortis nibh. Mauris semper libero eget elementum semper. Maecenas vulputate bibendum ipsum eget posuere. Aliquam eleifend lorem vel tempus mollis.
            </p>
            <p class="pTitle">Privacy Policy: Part II</p>
            <p class="pText">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec leo nisl, placerat vel tempor venenatis, condimentum quis arcu. Vestibulum rhoncus, diam ut blandit molestie, nisl justo fermentum libero, at malesuada mauris libero ut sapien. Vestibulum vulputate tellus non lorem bibendum, eget cursus diam sollicitudin. Etiam venenatis consectetur volutpat. Nam euismod nisi eleifend, vestibulum ante id, accumsan nulla. Pellentesque iaculis aliquam nulla. Donec felis enim, ornare id sapien et, dignissim eleifend nibh. Morbi pellentesque, libero a ultricies fermentum, lorem libero porta erat, in commodo purus nulla eu erat. Interdum et malesuada fames ac ante ipsum primis in faucibus. Quisque lectus erat, aliquam et est et, malesuada porta nisl. Maecenas ut ullamcorper urna. Aenean facilisis nunc nibh, non scelerisque nisl egestas quis. Proin et tempus tellus, ac suscipit sem. Mauris eleifend lectus eu nisl accumsan vehicula.

            Nam cursus tincidunt faucibus. Sed a urna elementum, interdum dui tincidunt, blandit arcu. Nullam volutpat eleifend elementum. Nulla et volutpat est, vitae fringilla metus. Cras bibendum erat orci, euismod condimentum erat sagittis a. Vestibulum nec faucibus erat, sit amet dapibus elit. Quisque eros felis, efficitur ut quam non, pulvinar varius ex. Praesent nec velit felis. Vivamus sit amet hendrerit magna. Etiam porttitor, justo ut consequat gravida, massa ex facilisis leo, vel pulvinar lorem dui sed risus.
            </p>
            <p class="pTitle">Privacy Policy: Part III</p>
            <p class="pText">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec leo nisl, placerat vel tempor venenatis, condimentum quis arcu. Vestibulum rhoncus, diam ut blandit molestie, nisl justo fermentum libero, at malesuada mauris libero ut sapien. Vestibulum vulputate tellus non lorem bibendum, eget cursus diam sollicitudin. Etiam venenatis consectetur volutpat. Nam euismod nisi eleifend, vestibulum ante id, accumsan nulla. Pellentesque iaculis aliquam nulla. Donec felis enim, ornare id sapien et, dignissim eleifend nibh. Morbi pellentesque, libero a ultricies fermentum, lorem libero porta erat, in commodo purus nulla eu erat. Interdum et malesuada fames ac ante ipsum primis in faucibus. Quisque lectus erat, aliquam et est et, malesuada porta nisl. Maecenas ut ullamcorper urna. Aenean facilisis nunc nibh, non scelerisque nisl egestas quis. Proin et tempus tellus, ac suscipit sem. Mauris eleifend lectus eu nisl accumsan vehicula.

            Nam cursus tincidunt faucibus. Sed a urna elementum, interdum dui tincidunt, blandit arcu. Nullam volutpat eleifend elementum. Nulla et volutpat est, vitae fringilla metus. Cras bibendum erat orci, euismod condimentum erat sagittis a. Vestibulum nec faucibus erat, sit amet dapibus elit. Quisque eros felis, efficitur ut quam non, pulvinar varius ex. Praesent nec velit felis. Vivamus sit amet hendrerit magna. Etiam porttitor, justo ut consequat gravida, massa ex facilisis leo, vel pulvinar lorem dui sed risus.
            </p>
            <p class="pText">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec leo nisl, placerat vel tempor venenatis, condimentum quis arcu. Vestibulum rhoncus, diam ut blandit molestie, nisl justo fermentum libero, at malesuada mauris libero ut sapien. Vestibulum vulputate tellus non lorem bibendum, eget cursus diam sollicitudin. Etiam venenatis consectetur volutpat. Nam euismod nisi eleifend, vestibulum ante id, accumsan nulla. Pellentesque iaculis aliquam nulla. Donec felis enim, ornare id sapien et, dignissim eleifend nibh. Morbi pellentesque, libero a ultricies fermentum, lorem libero porta erat, in commodo purus nulla eu erat. Interdum et malesuada fames ac ante ipsum primis in faucibus. Quisque lectus erat, aliquam et est et, malesuada porta nisl. Maecenas ut ullamcorper urna. Aenean facilisis nunc nibh, non scelerisque nisl egestas quis. Proin et tempus tellus, ac suscipit sem. Mauris eleifend lectus eu nisl accumsan vehicula.

            Nam cursus tincidunt faucibus. Sed a urna elementum, interdum dui tincidunt, blandit arcu. Nullam volutpat eleifend elementum. Nulla et volutpat est, vitae fringilla metus. Cras bibendum erat orci, euismod condimentum erat sagittis a. Vestibulum nec faucibus erat, sit amet dapibus elit. Quisque eros felis, efficitur ut quam non, pulvinar varius ex. Praesent nec velit felis. Vivamus sit amet hendrerit magna. Etiam porttitor, justo ut consequat gravida, massa ex facilisis leo, vel pulvinar lorem dui sed risus.
            </p>
            <p class="pTitle">Privacy Policy: Part IV</p>
            <p class="pText">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec leo nisl, placerat vel tempor venenatis, condimentum quis arcu. Vestibulum rhoncus, diam ut blandit molestie, nisl justo fermentum libero, at malesuada mauris libero ut sapien. Vestibulum vulputate tellus non lorem bibendum, eget cursus diam sollicitudin. Etiam venenatis consectetur volutpat. Nam euismod nisi eleifend, vestibulum ante id, accumsan nulla. Pellentesque iaculis aliquam nulla. Donec felis enim, ornare id sapien et, dignissim eleifend nibh. Morbi pellentesque, libero a ultricies fermentum, lorem libero porta erat, in commodo purus nulla eu erat. Interdum et malesuada fames ac ante ipsum primis in faucibus. Quisque lectus erat, aliquam et est et, malesuada porta nisl. Maecenas ut ullamcorper urna. Aenean facilisis nunc nibh, non scelerisque nisl egestas quis. Proin et tempus tellus, ac suscipit sem. Mauris eleifend lectus eu nisl accumsan vehicula.

            Nam cursus tincidunt faucibus. Sed a urna elementum, interdum dui tincidunt, blandit arcu. Nullam volutpat eleifend elementum. Nulla et volutpat est, vitae fringilla metus. Cras bibendum erat orci, euismod condimentum erat sagittis a. Vestibulum nec faucibus erat, sit amet dapibus elit. Quisque eros felis, efficitur ut quam non, pulvinar varius ex. Praesent nec velit felis. Vivamus sit amet hendrerit magna. Etiam porttitor, justo ut consequat gravida, massa ex facilisis leo, vel pulvinar lorem dui sed risus.
            </p>
            <p class="pText">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec leo nisl, placerat vel tempor venenatis, condimentum quis arcu. Vestibulum rhoncus, diam ut blandit molestie, nisl justo fermentum libero, at malesuada mauris libero ut sapien. Vestibulum vulputate tellus non lorem bibendum, eget cursus diam sollicitudin. Etiam venenatis consectetur volutpat. Nam euismod nisi eleifend, vestibulum ante id, accumsan nulla. Pellentesque iaculis aliquam nulla. Donec felis enim, ornare id sapien et, dignissim eleifend nibh. Morbi pellentesque, libero a ultricies fermentum, lorem libero porta erat, in commodo purus nulla eu erat. Interdum et malesuada fames ac ante ipsum primis in faucibus. Quisque lectus erat, aliquam et est et, malesuada porta nisl. Maecenas ut ullamcorper urna. Aenean facilisis nunc nibh, non scelerisque nisl egestas quis. Proin et tempus tellus, ac suscipit sem. Mauris eleifend lectus eu nisl accumsan vehicula.

            Nam cursus tincidunt faucibus. Sed a urna elementum, interdum dui tincidunt, blandit arcu. Nullam volutpat eleifend elementum. Nulla et volutpat est, vitae fringilla metus. Cras bibendum erat orci, euismod condimentum erat sagittis a. Vestibulum nec faucibus erat, sit amet dapibus elit. Quisque eros felis, efficitur ut quam non, pulvinar varius ex. Praesent nec velit felis. Vivamus sit amet hendrerit magna. Etiam porttitor, justo ut consequat gravida, massa ex facilisis leo, vel pulvinar lorem dui sed risus.
            </p>
            <p class="pTitle">Privacy Policy: Part V</p>
            <p class="pText">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec leo nisl, placerat vel tempor venenatis, condimentum quis arcu. Vestibulum rhoncus, diam ut blandit molestie, nisl justo fermentum libero, at malesuada mauris libero ut sapien. Vestibulum vulputate tellus non lorem bibendum, eget cursus diam sollicitudin. Etiam venenatis consectetur volutpat. Nam euismod nisi eleifend, vestibulum ante id, accumsan nulla. Pellentesque iaculis aliquam nulla. Donec felis enim, ornare id sapien et, dignissim eleifend nibh. Morbi pellentesque, libero a ultricies fermentum, lorem libero porta erat, in commodo purus nulla eu erat. Interdum et malesuada fames ac ante ipsum primis in faucibus. Quisque lectus erat, aliquam et est et, malesuada porta nisl. Maecenas ut ullamcorper urna. Aenean facilisis nunc nibh, non scelerisque nisl egestas quis. Proin et tempus tellus, ac suscipit sem. Mauris eleifend lectus eu nisl accumsan vehicula.

            Nam cursus tincidunt faucibus. Sed a urna elementum, interdum dui tincidunt, blandit arcu. Nullam volutpat eleifend elementum. Nulla et volutpat est, vitae fringilla metus. Cras bibendum erat orci, euismod condimentum erat sagittis a. Vestibulum nec faucibus erat, sit amet dapibus elit. Quisque eros felis, efficitur ut quam non, pulvinar varius ex. Praesent nec velit felis. Vivamus sit amet hendrerit magna. Etiam porttitor, justo ut consequat gravida, massa ex facilisis leo, vel pulvinar lorem dui sed risus.
            </p>
            <p class="pText">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec leo nisl, placerat vel tempor venenatis, condimentum quis arcu. Vestibulum rhoncus, diam ut blandit molestie, nisl justo fermentum libero, at malesuada mauris libero ut sapien. Vestibulum vulputate tellus non lorem bibendum, eget cursus diam sollicitudin. Etiam venenatis consectetur volutpat. Nam euismod nisi eleifend, vestibulum ante id, accumsan nulla. Pellentesque iaculis aliquam nulla. Donec felis enim, ornare id sapien et, dignissim eleifend nibh. Morbi pellentesque, libero a ultricies fermentum, lorem libero porta erat, in commodo purus nulla eu erat. Interdum et malesuada fames ac ante ipsum primis in faucibus. Quisque lectus erat, aliquam et est et, malesuada porta nisl. Maecenas ut ullamcorper urna. Aenean facilisis nunc nibh, non scelerisque nisl egestas quis. Proin et tempus tellus, ac suscipit sem. Mauris eleifend lectus eu nisl accumsan vehicula.

            Nam cursus tincidunt faucibus. Sed a urna elementum, interdum dui tincidunt, blandit arcu. Nullam volutpat eleifend elementum. Nulla et volutpat est, vitae fringilla metus. Cras bibendum erat orci, euismod condimentum erat sagittis a. Vestibulum nec faucibus erat, sit amet dapibus elit. Quisque eros felis, efficitur ut quam non, pulvinar varius ex. Praesent nec velit felis. Vivamus sit amet hendrerit magna. Etiam porttitor, justo ut consequat gravida, massa ex facilisis leo, vel pulvinar lorem dui sed risus.
            </p>
            <p class="pText">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec leo nisl, placerat vel tempor venenatis, condimentum quis arcu. Vestibulum rhoncus, diam ut blandit molestie, nisl justo fermentum libero, at malesuada mauris libero ut sapien. Vestibulum vulputate tellus non lorem bibendum, eget cursus diam sollicitudin. Etiam venenatis consectetur volutpat. Nam euismod nisi eleifend, vestibulum ante id, accumsan nulla. Pellentesque iaculis aliquam nulla. Donec felis enim, ornare id sapien et, dignissim eleifend nibh. Morbi pellentesque, libero a ultricies fermentum, lorem libero porta erat, in commodo purus nulla eu erat. Interdum et malesuada fames ac ante ipsum primis in faucibus. Quisque lectus erat, aliquam et est et, malesuada porta nisl. Maecenas ut ullamcorper urna. Aenean facilisis nunc nibh, non scelerisque nisl egestas quis. Proin et tempus tellus, ac suscipit sem. Mauris eleifend lectus eu nisl accumsan vehicula.

            Nam cursus tincidunt faucibus. Sed a urna elementum, interdum dui tincidunt, blandit arcu. Nullam volutpat eleifend elementum. Nulla et volutpat est, vitae fringilla metus. Cras bibendum erat orci, euismod condimentum erat sagittis a. Vestibulum nec faucibus erat, sit amet dapibus elit. Quisque eros felis, efficitur ut quam non, pulvinar varius ex. Praesent nec velit felis. Vivamus sit amet hendrerit magna. Etiam porttitor, justo ut consequat gravida, massa ex facilisis leo, vel pulvinar lorem dui sed risus.
            </p>
            <p class="pText">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec leo nisl, placerat vel tempor venenatis, condimentum quis arcu. Vestibulum rhoncus, diam ut blandit molestie, nisl justo fermentum libero, at malesuada mauris libero ut sapien. Vestibulum vulputate tellus non lorem bibendum, eget cursus diam sollicitudin. Etiam venenatis consectetur volutpat. Nam euismod nisi eleifend, vestibulum ante id, accumsan nulla. Pellentesque iaculis aliquam nulla. Donec felis enim, ornare id sapien et, dignissim eleifend nibh. Morbi pellentesque, libero a ultricies fermentum, lorem libero porta erat, in commodo purus nulla eu erat. Interdum et malesuada fames ac ante ipsum primis in faucibus. Quisque lectus erat, aliquam et est et, malesuada porta nisl. Maecenas ut ullamcorper urna. Aenean facilisis nunc nibh, non scelerisque nisl egestas quis. Proin et tempus tellus, ac suscipit sem. Mauris eleifend lectus eu nisl accumsan vehicula.

            Nam cursus tincidunt faucibus. Sed a urna elementum, interdum dui tincidunt, blandit arcu. Nullam volutpat eleifend elementum. Nulla et volutpat est, vitae fringilla metus. Cras bibendum erat orci, euismod condimentum erat sagittis a. Vestibulum nec faucibus erat, sit amet dapibus elit. Quisque eros felis, efficitur ut quam non, pulvinar varius ex. Praesent nec velit felis. Vivamus sit amet hendrerit magna. Etiam porttitor, justo ut consequat gravida, massa ex facilisis leo, vel pulvinar lorem dui sed risus.
            </p>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript" src="../js/browse.js"></script>
</body>

</html>