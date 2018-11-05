function confirmPWD()
{
	"use strict";
	var pwd = document.regform.Password.value;
	var cpwd = document.regform.ConfirmPassword.value;
	
	if( pwd === cpwd )
	{
		alert("Registration Successful !");
		return true;
	}
	else
	{
		alert("Passwords don't match! Re-Enter ");
		document.getElementsByName("Password").value = 0;
		document.getElementsByName("ConfirmPassword").value = 0;
		return 0;	
	}
	
}