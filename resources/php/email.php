<?php
	class email{
		function getMail(){
			require '../PHPMailer-master/PHPMailerAutoload.php';
			$mail = new PHPMailer;
			$mail->isSMTP();
			$mail->Host = 'smtp.gmail.com';
			$mail->SMTPAuth = true;
			$mail->Username = 'iansitenoreply@gmail.com';
			$mail->Password = 'pacpar48';
			$mail->SMTPSecure = 'ssl';
			$mail->Port = 465;
			$mail->SetFrom('Noreply@Iansite.com', 'IanSiteNoReply');
			$mail->FromName = 'Ian Site';
			$mail->addReplyTo('IansiteNoreply@gmail.com', 'Ian site NO reply');
			$mail->isHTML(true);
			$mail->AltBody = "This email is only viewable in HTML, you should probably change your email client";
			return $mail;
		}
		
		function setTitle($mail, $title){
			$mail->Subject = $title;
		}
		
		function setBody($mail, $body){
			$mail->Body = $body;
		}
		
		function addAddress($mail, $address){
			$mail->addAddress($address);
		}
		
		function replaceAddress($mail, $address){
			$mail->ClearAddresses();
			$this->addAddress($mail, $address);
		}
		
		function sendMail($mail){
			if($mail->send()){				
				return true;
			}else{
				return false;
			}
		}
	}
?>