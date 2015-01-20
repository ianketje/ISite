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
<h1>Admin functions</h1>
<a href="../">Go to index</a><br>
<a href="mail/massmessage.php" target="frame">Mass message</a><br>
<a href="edituser/edituser.php" target="frame">Edit a user</a><br>
<a href="news/submitnews.php" target="frame">Upload news article</a>
</center>
<iframe width="100%" height="80%" name="frame"></iframe>
</body>
</html>
