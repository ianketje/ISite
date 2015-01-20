<html>
<head>
</head>
<body>
<?php
session_start();
if(!(isset($_SESSION['username']))){
	header("Location: ../login/index.php?error=Please%20login%20first!");		
}else{
	$username = $_SESSION['username'];
}
include ("../resources/php/dbfunctions.php");
$dbfunc = new db();
include ("../resources/php/email.php");
$mailfunc = new email();
if(!($dbfunc->isAdmin($username))){
	header("Location: ../");
}
if (isset($_POST['title']) == true && isset($_POST['editor']) == true)
{

	
	$mail = $mailfunc->getMail();
	
	$title = $_POST['title'];
	$message = $_POST['editor'];

	$mailfunc->setBody($mail, $message);
	$mailfunc->setTitle($mail, $title);
	
	if ( get_magic_quotes_gpc() ){
		$message = htmlspecialchars( stripslashes((string)$message) );
	}else{
		$message = htmlspecialchars( (string)$message );
	}	
	$conn = $dbfunc->getConn();
	
	if($conn == null){
		die("Error while connecting to the server! Please ask a administrator for help!");
	}	
	
	$row = $dbfunc->getValues("SELECT email, messages FROM accounts");
	$mailfunc->replaceAddress($mail, $row['email']);
	if($row["messages"] == 1){
		if(!$mail->send()){				
			echo $row['email'] . ' -> Message not send! Error: ' . $mail->ErrorInfo . '<br>';
		}else{
			echo $row['email'] . ' -> Message send!<br>';
		}
	}else{
			echo $row['email'] . ' -> Message not send because no Mails wanted!<br>';
	}
	
	$dbfunc->closeConn();
}else{
	die('No message set');
}
?>
</body>
</html>