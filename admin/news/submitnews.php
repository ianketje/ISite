<html>
<head>
	<script src="../ckeditor/ckeditor.js"></script>
	<style>
		textarea{
			resize: none;
			width: 100%;
			height: 10%;
		}
	</style>
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
<form>
	Title (max 50)<br><input type="text" name="title"><br><br>
	Description (max 420)<br><textarea name="description"></textarea><br><br>
	Story itself (max 4000)<br><textarea class="ckeditor" name="story"></textarea><br>
</form>
</body>