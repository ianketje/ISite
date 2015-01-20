<html>
<head>
</head>
<body>
<?php
	session_start();
	if(isset($_SESSION['username'])){
		header("location: ../home.php");
	}
	
	if(!isset($_POST['username'])){
		header("location: ../login/index.php?error=Please%20try%20to%20login%20first%20before%20you%20go%20on!");
	}
	
	if(!isset($_POST['password'])){
		header("location: ../login/index.php?error=Please%20try%20to%20login%20first%20before%20you%20go%20on!");
	}
	
	include ("../resources/php/dbfunctions.php");
	
	$dbfunc = new db();
	$conn = $dbfunc->getConn();
	
	$username = $_POST['username'];
	
	$result = $dbfunc->getResult("SELECT username FROM accounts WHERE username = '$username'");
	
	if($dbfunc->columnNotContains($result)){
		header("Location: ../login/index.php?error=Usernamessss%20and%20password%20dont%20match!");
		exit();
	}
	
	$key = "]PX_Z42(:3s|{a2L6dA9jt2h{2I^L";
	function decrypt($string, $key) {
		$result = '';
		$string = base64_decode($string);
		for($i=0; $i<strlen($string); $i++) {
			$char = substr($string, $i, 1);
			$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char)-ord($keychar));
			$result.=$char;
		}
		return $result;
	}
	
	$password = $_POST['password'];
	
	$result2 = $dbfunc->getResult("SELECT pass FROM accounts WHERE username = '$username'");
	
	$gotPass = decrypt($dbfunc->getSingleValue($result2), $key);
	
	if(!($gotPass == $password)){
		header("Location: ../login/index.php?error=Username%20and%20password%20dont%20match!");
		exit();		
	}else{
		if($dbfunc->isAdmin($username)){
			$_SESSION['admin'] = 1;
		}
		
		
		$_SESSION['username'] = $username;
		header("location: ../");
	}
	
	$dbfunc->closeConn();
	
?>
</body>
</html>