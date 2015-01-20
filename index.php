<html>
<head>
</head>
<body>
<?php
session_start();
if(isset($_SESSION['username'])){
	$username = $_SESSION['username'];
	?>
	<b>Hello <?php echo $username; ?>! </b>
	<a href="../home.php">Profile home </a>	
	<?php
	include ("/resources/php/dbfunctions.php");
	$dbfunc = new db();
	if($dbfunc->isAdmin($username)){
		echo '<a href="/admin/">Admin home</a> ';
		echo '<a href="/CanvasTesting/">Canvas Testing home</a>';
	}	
}
?>
<br>
<hr>
<a href="../login/register.php">Register</a><br>
<a href="../login/">Log in</a><br>
<a href="../login/logout.php">Log out</a>

</body>
</html>