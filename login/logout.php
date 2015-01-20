<html>
<head>
</head>
<body>
<?php
	session_start();
	if(!(isset($_SESSION['username']))){
		header("Location: ../login/index.php?error=Please%20login%20first%20to%20log%20out!");		
	}else{
		session_destroy();
		header("Location: ../");
	}
?>
</body>
</html>