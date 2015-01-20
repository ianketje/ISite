<html>
<head>
</head>
<body>
<form method="POST" action="#">
<input type="text" name="encrypt">Encrypt<br>
<input type="submit">
</form><br>
<?php
if(isset($_POST['encrypt'])){	
	$key = "]PX_Z42(:3s|{a2L6dA9jt2h{2I^L";
	function encrypt($string, $key) {
		$result = '';
		for($i=0; $i<strlen($string); $i++) {
			$char = substr($string, $i, 1);
			$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char)+ord($keychar));
			$result.=$char;
		}
	  return base64_encode($result);
	}
	$ans = encrypt($_POST['encrypt'], $key);
	echo $ans . " ENCRYPTED<br>";
}


?>
</body>
</html>