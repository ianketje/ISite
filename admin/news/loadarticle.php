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
if(!($dbfunc->isAdmin($username))){
	header("Location: ../");
}
if(!(isset($_POST['title']))){
	die('No title set!');
}
if(!(isset($_POST['description']))){
	die('No description set!');
}
if(!(isset($_POST['story']))){
	die('No story set!');
}

?>
</body>
</html>