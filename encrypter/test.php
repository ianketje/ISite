<html>
<head>
</head>
<body>
<?php	
	function unique_id($l = 8) {
		return substr(md5(uniqid(mt_rand(), true)), 0, $l);
	}
	echo(unique_id());
?>
</body>
</html>