
function registerForm(event)
{
	var elements = event.currentTarget;

	// declare variables
	var email = elements[0].value;
	var pwd = elements[1].value;
	var pin = elements[2].value;
	
	var rt = true;

	// javascript regular expressions for valid email, password, and pin
	var email_v = /^(([\-\w]+)\.?)+@[a-zA-Z_]+?\.[a-zA-Z]{2,4}$/;
	var pwd_v = /^[a-zA-Z0-9_-]+$/;
	var pin_v = /^[0-9]*$/;
	
	// initialize the error messages
	document.getElementById("email_msg").innerHTML = "";
	document.getElementById("pwd_msg").innerHTML = "";
	document.getElementById("pin_msg").innerHTML = "";

	// validate email
	if (email == null || email == "")
	{
		document.getElementById("email_msg").innerHTML = "Please enter an email.";
		rt = false;
	}
	else if (!email_v.test(email))
	{
		document.getElementById("email_msg").innerHTML = "Incorrect email format! (Must be in the form yourname@domain.sth)";
		rt = false;
	}
	
	//validate password
	if (pwd == null || pwd == "")
	{
		document.getElementById("pwd_msg").innerHTML = "Please enter a password.";
		rt = false;
	}
	else if (pwd.length < 8)
	{
		document.getElementById("pwd_msg").innerHTML = "Password must be at least 8 characters long!";
		rt = false;
	}
	else if (!pwd_v.test(pwd))
	{
		document.getElementById("pwd_msg").innerHTML = "Password invalid! (Needs at least one letter and one number)";
		rt = false;
	}
	
	//validate pin
	if (pin == null || pin == "")
	{
		document.getElementById("pin_msg").innerHTML = "Please enter a pin.";
		rt = false;
	}
	else if (pin.length < 4 || pin.length > 4)
	{
		document.getElementById("pin_msg").innerHTML = "Pin must be exactly 4 characters in length!";
		rt = false;
	}
	else if (!pin_v.test(pin))
	{
		document.getElementById("pin_msg").innerHTML = "Pin can only contain numbers.";
		rt = false;
	}
		
	// prevent form submittion if one of the fields is invalid
	if (rt == false)
	{
		event.preventDefault();
	}
}