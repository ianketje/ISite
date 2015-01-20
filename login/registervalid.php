<html>
<head>
</head>
<body>
<?php
	session_start();
	if(isset($_SESSION['username'])){
		header("location: ../home.php");
	}
	include ("../resources/php/dbfunctions.php");
	include ("../resources/php/email.php");
	$dbfunc = new db();
	$emailfunc = new email();
	$conn = $dbfunc->getConn();
	
	$username = $_SESSION['rusername'];
	$password = $_SESSION['rpassword'];
	$email = $_SESSION['remail'];
	$bdate = $_SESSION['rbdate'];
	$messages = $_SESSION['rmessages'];
	$date = date('d - m - Y - H:i');
	
	$conn = $dbfunc->getConn();
	
	if($conn == null){
		die("Error while connecting to the server! Please ask a administrator for help!");
	}
	
	if($messages == "on"){
		$messages = 1;
	}else{
		$messages = 0;
	}
	
	$resultu = $dbfunc->getResult("SELECT username FROM accounts WHERE username = '$username'");
	$resulte = $dbfunc->getResult("SELECT email FROM accounts WHERE email = '$email'");
	
	if($dbfunc->columnNotContain($resultu)){
		header("Location: ../login/register.php?error=Username%20already%20excists!");
		exit();
	}
	if($dbfunc->columnNotContain($resulte)){
		header("Location: ../login/register.php?error=Email%20already%20excists!");
		exit();
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
	
	function unique_id($l = 8) {
		return substr(md5(uniqid(mt_rand(), true)), 0, $l);
	}
	
	$hash = unique_id();
	
	$password = encrypt($password, $key);
	
	$query = "INSERT INTO accounts (username, pass, email, registerdate, birthdate, messages, hash)
	VALUES ('$username', '$password', '$email', '$date', '$bdate', '$messages', '$hash')";
	
	if($dbfunc->getResult($query) === TRUE){
		$link = "http://212.120.85.106/login/emailverification.php?email=" . $email . "&hash=" . $hash;
		$mail = $mailfunc->getMail();
		
		$message = $_POST['editor'];

		$mailfunc->setTitle($mail, 'Email verification');
		$mailfunc->setTitle($mail, 'Email verifaction click the link to verify your account!<br> ' . $link);
		$mailfunc->addAddress($mail, $email);
		if(!$mailfunc->sendMail($mail)){				
			echo 'Verification Mail not send!<br>';
		}else{
			echo 'Verification Mail send!<br>';
		}
	
		echo "Account created! <a href='../'>Go back to home to log in!</a>";
	}else{
		echo "Account creation failed! Please ask an administrator for help!<br>";
		echo "Error: " . $query . "<br>" . $conn->error;
	}
	
	$dbfunc->closeConn();
	session_destroy();
?>
</body>
</html>