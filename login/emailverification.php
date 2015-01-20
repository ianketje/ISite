<html>
<head>
</head>
<body>
<?php
include ("../resources/php/dbfunctions.php");
$dbfunc = new db();
include ("../resources/php/email.php");
$emailfunc = new email();

if(isset($_GET['email']) && isset($_GET['hash'])){
	
	$conn = $dbfunc->getConn();
	
	if($conn == null){
		die("Error while connecting to the server! Please ask a administrator for help!");
	}	
	
	$email = $_GET['email'];
	$hash = $_GET['hash'];
	
	$row = $dbfunc->getValues("SELECT email, hash FROM accounts");
	if($row['email'] == $email){
		if($row['hash'] == $hash){
			$query2 = "UPDATE accounts SET verificated = 1 WHERE email = '$email'";
			if($conn->query($query2) == true){
				echo 'Email verified! go back -> <a href="../">Home</a>';	
				echo mysqli_error($conn);
			}else{
				echo 'An error occured! Please ask an administrator for help!';
				$result2 = $conn->query($query2);
				echo mysqli_error($conn);
			}						
		exit();
		}else{
			echo 'Invalid hash';
			exit();
		}
	}
	
	$conn->close();
}
?>
</body>
</html>