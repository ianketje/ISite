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

if(isset($_POST['tuser'])){
	$tusername = $_POST['tuser'];
	if($tusername == ""){
		die("No user set");
	}
}

if(!($dbfunc->playerExcist($tusername))){
	die("User doesn't excist");
}

$tuserlvl = $dbfunc->getRankLevel($tusername);
$userlvl = $dbfunc->getRankLevel($username);
			
		$key = "]PX_Z42(:3s|{a2L6dA9jt2h{2I^L";
		function decrypt($string, $key) {
			$result = '';
			$string = base64_decode($string);
			for($i=0; $i<strlen($string); $i++) {
				$char = substr($string, $i, 1);
				$keychar = substr($key, ($i % strlen($key))-1, 1);
				$char = chr(ord($char)-ord($keychar));
				$result.=$char;
			}
			return $result;
		}

if($userlvl > $tuserlvl || $userlvl > 8){
	
	$password = $dbfunc->getSingleValue($dbfunc->getResult("SELECT pass FROM accounts WHERE username = '$tusername'"));
	$email = $dbfunc->getSingleValue($dbfunc->getResult("SELECT email FROM accounts WHERE username = '$tusername'"));
	$registerdate = $dbfunc->getSingleValue($dbfunc->getResult("SELECT registerdate FROM accounts WHERE username = '$tusername'"));
	$birthdate = $dbfunc->getSingleValue($dbfunc->getResult("SELECT birthdate FROM accounts WHERE username = '$tusername'"));
	$messages = $dbfunc->getSingleValue($dbfunc->getResult("SELECT messages FROM accounts WHERE username = '$tusername'"));
	$admin = $dbfunc->getSingleValue($dbfunc->getResult("SELECT admin FROM accounts WHERE username = '$tusername'"));
	$verificated = $dbfunc->getSingleValue($dbfunc->getResult("SELECT verificated FROM accounts WHERE username = '$tusername'"));
	$ranklvl = $dbfunc->getSingleValue($dbfunc->getResult("SELECT ranklvl FROM accounts WHERE username = '$tusername'"));
	
	?>
	<h2>Edit user <br>(WARNING: <ul><b>don't edit random stuff! Be sure what you are doing or you might corrupt this account!</b></ul>)</h2>
	<form action="editsubmit.php" method="POST">
		<input type="hidden" name="oldusername" value="<?php echo $tusername ?>">
		Username <input type="text" name="susername" value="<?php echo $tusername ?>"><br>
		<?php
		if($userlvl > 7){
		?>
			Password <input type="text" name="spass" value="<?php echo decrypt($password, $key) ?>"><br>
		<?php
		}else{
		
		}
		?>
		Email <input type="text" name="semail" value="<?php echo $email ?>"><br>
		Register date (DD - MM - YYYY - hh:mm) <input type="text" name="sregisterdate" value="<?php echo $registerdate ?>"><br>
		Birth date (DD - MM - YYYY) <input type="text" name="sbirthdate" value="<?php echo $birthdate ?>"><br>
		Receive messages (0 - 1) <input type="text" name="smessages" value="<?php echo $messages ?>"><br>
		<?php
		if($userlvl > 5){
		?>
			Admin (0 - 1) <input type="text" name="sadmin" value="<?php echo $admin ?>"><br>
		<?php
		}
		?>
		Verificated email (0 - 1) <input type="text" name="sverificated" value="<?php echo $verificated ?>"><br>
		<?php
		if($userlvl > 7){
		?>
			Rank level (0 - 9) <input type="text" name="sranklvl" value="<?php echo $ranklvl ?>"><br>
		<?php
		}
		?>
		
		<input type="submit">
	</form>
	<?php
}else{
	die("You need a higher rank level to edit this user!");
}
?>
</body>
</html>