


/*function validateForm() {
	"use strict";
    var x = document.forms.contactus.FirstName.value;
    if (x === "") {
		document.getElementById("head").innerHTML = "* All fields are mandatory *";
        //alert("Name must be filled out");
        return false;
    }
}*/





function ContactusValidation()
{
	"use strict";
	var firstname = document.forms.contactus.FirstName.value;
	var lastname = document.forms.contactus.LastName.value;
	var email = document.forms.contactus.Email.value;
	var comment = document.forms.contactus.Comments.value;

	
	
	if( firstname === "" || lastname === ""|| email === "" || comment === ""  )
	{
		document.getElementById("head").innerHTML = "* All fields are mandatory *";
		//this segment displays the validation rule for all fields
		//firstname.focus();
		return false;
	}

	
	
	// Check each input in the order that it appears in the form!
	else if( inputAlphabet(firstname, "* For your name please use alphabets only *") )
		{
			if( inputAlphabet(lastname, "* For your name please use alphabets only *") )
			{
				if(emailValidation(email, "* Invalid E-mail * ") )
					{
			//			if( comment === "" )
			//			{
						return false;
			//			}
			//		}	
				}
			}	
		}
	else
		{
		return false;
		}
}




// Function that checks whether an user entered valid email address or not and displays alert message on wrong email address format.
function emailValidation(inputtext, alertMsg)
	{
		"use strict";
		var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
		if(emailExp.test(inputtext) )
		{
			document.getElementById("head").innerHTML = "";
			return true;
		}
		else
		{
	
		document.getElementById('head').innerHTML = alertMsg; //this segment displays the validation rule for email
		inputtext.focus();
			return false; 
		}
	}
	
function inputAlphabet(inputtext, alertMsg)
{
	
	"use strict";
	var alphaExp = /[a-zA-Z]{2,30}/;
	if(alphaExp.test(inputtext) )
	{
		document.getElementById("head").innerHTML = "";
		return true;
	}
	else
	{
		 
		document.getElementById("head").innerHTML = alertMsg; //this segment displays the validation rule for name
		inputtext.focus();
		return false;
	}
}




