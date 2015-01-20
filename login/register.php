<html>
<head>
</head>
<body>
<div id="error" style="color:red">
<?php
if(isset($_GET['error'])){
	echo $_GET['error'];
}
?>
</div>
<?php
session_start();
if(isset($_SESSION['username'])){
	header("location: ../home.php");
}
?>
<form action="registersubmit.php" method="POST">
Username:<br>
<input type="text" name="username" placeholder="Eg: Flaming_Pajama_Man" id="username"><br>
Password:<br>
<input type="password" name="password" placeholder="Eg: ThisIsMySecretPass" id="password"><br>
Password confirmation:<br>
<input type="password" name="passwordc" placeholder="Eg: ThisIsMySecretPass" id="passwordc"><br>
Email (Make sure it's a real email addres!):<br>
<input type="email" name="email" placeholder="Eg: apple@pie.com" id="email"><br>
Email confirmation:<br>
<input type="email" name="emailc" placeholder="Eg: apple@pie.com" id="emailc"><br>
Birth date:<br>
<select name="bday" id="bday">
	<option>Day</option>
	<?php
		for($i = 1; $i <= 31; $i++){
			echo '<option value="'.$i.'">'.$i.'</option>';
		}
	?>
</select>
<select name="bmonth" id="bmonth">
	<option>Month</option>
	<option value="January">January</option>
	<option value="February">February</option>
	<option value="March">March</option>
	<option value="April">April</option>
	<option value="May">May</option>
	<option value="June">June</option>
	<option value="July">July</option>
	<option value="August">August</option>
	<option value="September">September</option>
	<option value="October">October</option>
	<option value="November">November</option>
	<option value="December">December</option>
</select>
<select name="byear" id="byear">
	<option>Year</option>
	<?php
		for($o = 2015; $o >= 1900; $o--){
			echo '<option value="'.$o.'">'.$o.'</option>';
		}
	?>
</select><br>
<input type="checkbox" name="messages" checked="checked" id="messages"> Allow me to send you messages to your Email<br>
<input type="submit" value="Register!">
</form>
</body>
</html>