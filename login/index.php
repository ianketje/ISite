<html>
<head>
</head>
<body>
<?php
session_start();
if(isset($_SESSION['username'])){
	header("location: ../home.php");
}
?>
<a href="../login/register.php">Click here to register!</a><br>
<div style="color:red;">
<?php
if(isset($_GET['error'])){
	echo $_GET['error'];
}
?>
</div>
<form method="POST" action="loginsubmit.php">
	<input type="text" name="username"> Username<br>
	<input type="password" name="password"> Password<br>
	<input type="submit">
</form>
</body>
</html>