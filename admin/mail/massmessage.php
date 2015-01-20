<html>
<head>
	<script src="../ckeditor/ckeditor.js"></script>
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
<form method="POST" action="sendemail.php">
<input type="text" name="title"> Email title
<textarea class="ckeditor" name="editor"></textarea>
<input type="submit"></form>
</form>
</body>
</html>
