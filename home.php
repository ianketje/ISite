<html>
<head>
</head>
<body>
<?php
	session_start();
	if(!(isset($_SESSION['username']))){
		header("Location: ../login/index.php?error=Please%20login%20first%20to%20view%20your%20profile!");		
	}else{
		$username = $_SESSION['username'];
	}
?>
<h2>Hello <?php echo $username; ?>!</h2><br>
<a href="../">Go to homepage</a>

</body>
</html>