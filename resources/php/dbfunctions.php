<?php
	class db{
		function getConn(){
			$servername = "localhost";
			$user = "root";
			$pass = "noob00";
			$dbname = "site";
			
			$conn = new mysqli($servername, $user, $pass, $dbname);
			
			if($conn->connect_error){
				return null;
			}
			return $conn;
		}
		
		function closeConn(){
			$conn = $this->getConn();
			$conn->close();
		}
		
		function getSingleValue($result){	
			if($result){
				while($row=mysqli_fetch_row($result)){
					$returnvalue = $row[0];
				}
				return $returnvalue;
			}else{
				return null;
			}
		}
		
		function getResult($query){
			$conn = $this->getConn();
			$result = $conn->query($query);
			$this->closeConn();
			return $result;
		}
		
		function columnNotContains($result){
			if($result && mysqli_num_rows($result) < 1){
				return true;
			}else{
				return false;
			}
		}
		
		function getValues($query){
			$result = $this->getResult();
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					return $row;
				}
			} else {
				return null;
			}
		}
		
		function isAdmin($username){
			$result = $this->getResult("SELECT admin FROM accounts WHERE username = '$username'");	
			$admin = $this->getSingleValue($result);
			if($admin == 1){
				$this->closeConn();
				return true;
			}else{
				$this->closeConn();
				return false;
			}
		}
		
		function getRankLevel($username){
			$result = $this->getResult("SELECT ranklvl FROM accounts WHERE username = '$username'");	
			$lvl = $this->getSingleValue($result);
			return $lvl;
			$this->closeConn();
			
		}
		
		function PlayerExcist($username){
			$result = $this->getResult("SELECT username FROM accounts WHERE username = '$username'");
			if($result && mysqli_num_rows($result) < 1){
				return false;
			}else{
				return true;
			}
		}
	}
?>