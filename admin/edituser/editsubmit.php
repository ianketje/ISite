<html>
<head>
</head>
<body>
<?php
//"UPDATE accounts SET  =  WHERE username = '$oldusername'"
session_start();
if(!(isset($_SESSION['username']))){
	header("Location: ../login/index.php?error=Please%20login%20first!");		
}else{
	$username = $_SESSION['username'];
}
include ("../resources/php/dbfunctions.php");
$dbfunc = new db();
if(!($dbfunc->isAdmin($username))){
	header("Location: ../");
}
	$key = "]PX_Z42(:3s|{a2L6dA9jt2h{2I^L";
	function encrypt($string, $key) {
		$result = '';
		for($i=0; $i<strlen($string); $i++) {
			$char = substr($string, $i, 1);
			$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char)+ord($keychar));
			$result.=$char;
		}
	  return base64_encode($result);
	}
if(isset($_POST['oldusername'])){
	$oldusername = $_POST['oldusername'];
}else{
	die("Username wasn't filled in, is required");
}
if(isset($_POST['susername'])){
	$susername = $_POST['susername'];
	if($dbfunc->getResult("UPDATE accounts SET username = '$susername' WHERE username = '$oldusername'") == true){
		echo 'Username changed!<br>';
		$oldusername = $susername;
	}else{
		echo 'Username wasn\'t changed!<br>';
	}
}
if(isset($_POST['spass'])){
	$spass = encrypt($_POST['spass'], $key);
	if($dbfunc->getResult("UPDATE accounts SET pass = '$spass' WHERE username = '$oldusername'") == true){
		echo 'Password changed!<br>';
	}else{
		echo 'Password wasn\'t changed!<br>';
	}
}
if(isset($_POST['semail'])){
	$semail = $_POST['semail'];
	if($dbfunc->getResult("UPDATE accounts SET email = '$semail' WHERE username = '$oldusername'") == true){
		echo 'Email changed!<br>';
	}else{
		echo 'Email wasn\'t changed!<br>';
	}
}
if(isset($_POST['sregisterdate'])){
	$sregisterdate = $_POST['sregisterdate'];
	if($dbfunc->getResult("UPDATE accounts SET registerdate = '$sregisterdate' WHERE username = '$oldusername'") == true){
		echo 'Register date changed!<br>';
	}else{
		echo 'Register date wasn\'t changed!<br>';
	}
}
if(isset($_POST['sbirthdate'])){
	$sbirthdate = $_POST['sbirthdate'];
	if($dbfunc->getResult("UPDATE accounts SET birthdate = '$sbirthdate' WHERE username = '$oldusername'") == true){
		echo 'Birth date changed!<br>';
	}else{
		echo 'Birth date wasn\'t changed!<br>';
	}
}
if(isset($_POST['smessages'])){
	$smessages = $_POST['smessages'];
	if($dbfunc->getResult("UPDATE accounts SET messages = $smessages WHERE username = '$oldusername'") == true){
		echo 'Accept messages changed!<br>';
	}else{
		echo 'Accept messages wasn\'t changed!<br>';
	}
}
if(isset($_POST['sadmin'])){
	$sadmin = $_POST['sadmin'];
	if($dbfunc->getResult("UPDATE accounts SET admin = $sadmin WHERE username = '$oldusername'") == true){
		echo 'Administrator rights changed!<br>';
	}else{
		echo 'Admininistrator rights wasn\'t changed!<br>';
	}
}
if(isset($_POST['sverificated'])){
	$sverificated = $_POST['sverificated'];
	if($dbfunc->getResult("UPDATE accounts SET verificated = $sverificated WHERE username = '$oldusername'") == true){
		echo 'Email verification changed!<br>';
	}else{
		echo 'Email verification wasn\'t changed!<br>';
	}
}
if(isset($_POST['sranklvl'])){
	$sranklvl = $_POST['sranklvl'];
	if($dbfunc->getResult("UPDATE accounts SET ranklvl = $sranklvl WHERE username = '$oldusername'") == true){
		echo 'Rank level changed!<br>';
	}else{
		echo 'Rank level wasn\'t changed!<br>';
	}
}

echo '<h1>Done</h1>';

?>
</body>
</html>