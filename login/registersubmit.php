<html>
<head>
<script src="../resources/js/register.js"></script>
<script type="text/javascript" src="http://jqueryjs.googlecode.com/files/jquery-1.3.2.js"></script>
</head>
<body>


<?php
	$username = $_POST['username'];		
	$password = $_POST["password"];		
	$passwordc = $_POST["passwordc"];		
	$email = $_POST["email"];		
	$emailc = $_POST["emailc"];		
	$bday = $_POST["bday"];		
	$bmonth = $_POST["bmonth"];		
	$byear = $_POST["byear"];		
	$messages = $_POST["messages"];
	$bdate = $bday . " - " . $bmonth . " - " . $byear;
	session_start();
	
	if(isset($_SESSION['username'])){
		header("location: ../home.php");
	}
	
	$_SESSION['rusername'] = $username;
	$_SESSION['rpassword'] = $password;
	$_SESSION['remail'] = $email;
	$_SESSION['rbdate'] = $bdate;
	$_SESSION['rmessages'] = $messages;
	
	echo '<script type="text/javascript">';
	echo 'register(\'' . $username . '\',\'' . $password . '\',\'' . $passwordc . '\',\'' . $email . '\',\'' . $emailc . '\',\'' . $bday . '\',\'' . $bmonth . '\',\'' . $byear . '\',\'' . $messages . '\');';
	echo '</script>';
	
	
?>
</body>
</html>