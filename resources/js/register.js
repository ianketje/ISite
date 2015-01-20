var username;
var password;
var passwordc;
var email;
var emailc;
var bday;
var bmonth;
var byear;
var bdate;
var messages;

var error;

function setVar(susername, spassword, spasswordc, semail, semailc, sbday, sbmonth, sbyear, smessages){
	username = susername;
	password = spassword;
	passwordc = spasswordc;
	email = semail;
	emailc = semailc;
	bday = sbday;
	bmonth = sbmonth;
	byear = sbyear;
	bdate = bday + " - " + bmonth + " - " + byear;
	messages = smessages;
}

function register(susername, spassword, spasswordc, semail, semailc, sbday, sbmonth, sbyear, smessages){
	setVar(susername, spassword, spasswordc, semail, semailc, sbday, sbmonth, sbyear, smessages);
	if(isValid() == true){
		window.location.href = '../login/registervalid.php';
	}else{
		window.location.href = '../login/register.php?error=' + error;
	}
}

function isValid(){
	if(password !== passwordc){
		error = "The password doesn't match!";
		return false;
	}
	
	if(email !== emailc){
		error = "The email doesn't match!";
		return false;
	}
	
	if(username == ""){
		error = "Username is empty!";
		return false;
	}
	
	if(username.length > 32){
		error = "The size of your username is too big! (32 max)";
		return false;
	}
	
	if(password == ""){
		error = "Password is empty!";
		return false;
	}
	
	if(password.length > 256){
		error = "The size of your password is too big! (256 max)";
		return false;
	}
	
	if(email == ""){
		error = "Email is empty!";
		return false;	
	}
	
	if(email.length > 256){
		error = "The size of your email is too big! (256 max)";
		return false;
	}
	
	if(bday == "Day"){
		error = "Birth date day is empty!";
		return false;
	}
	
	if(bmonth == "Month"){
		error = "Birth date month is empty!";
		return false;
	}
	
	if(byear == "Year"){
		error = "Birth date year is empty!";
		return false;
	}

	if(username.indexOf(' ') !== -1){
		error = "The username can't contain spaces!";
		return false;		
	}

	if(password.indexOf(' ') !== -1){
		error = "The password can't contain spaces!";
		return false;		
	}

	if(email.indexOf(' ') !== -1){
		error = "The email can't contain spaces!";
		return false;		
	}
	
	if(email.indexOf('@') == -1){ 
		error = "The email is invalid!";
		return false;	
	}
	
	var p2 = email.split("@");
	var stri = p2[1];
	if(stri.indexOf('.') == -1){
		error = "The email is invalid!";
		return false;		
	}
	
	return true;
}