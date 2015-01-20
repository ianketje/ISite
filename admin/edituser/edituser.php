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
?>
<center>
<h2>Type the username you want to edit</h2>
<form action="usersubmit.php" method="POST">
	<input type="text" name="tuser"><br>
	<input type="submit">
</form>
</center>
</body>
</html>