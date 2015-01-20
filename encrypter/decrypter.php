<html>
<head>
</head>
<body>
<form method="POST" action="#">
<input type="text" name="decrypt">Decrypt<br>
<input type="submit">
</form><br>
<?php
	$key = "]PX_Z42(:3s|{a2L6dA9jt2h{2I^L";
	if(isset($_POST['decrypt'])){
			
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
		
		$ans = decrypt($_POST['decrypt'], $key);
		echo $ans . " DECRYPTED<br>";
		
	}


?>
</body>
</html>