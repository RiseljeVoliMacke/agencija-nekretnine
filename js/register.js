var tmp, txt;

$(document).ready(function() 
{
	
	
	//Display guidelines for username
	$("#username").on('input', function()
	{
		if(typeof($("#username").parent().parent().next().attr("class"))!="undefined" && $("#username").parent().parent().next().attr("class").search("msg")>-1)
			$("#username").parent().parent().next().remove();
		
		$("#username").parent().parent().after("<tr class=\"msg\"><td colspan=\"2\" class=\"infomsg\">Username can consist of letters and numbers and should have between 8 and 20 characters</td></tr>");
	});
	
	//Validate username
	$("#username").change(function()
	{
		if(typeof($("#username").parent().parent().next().attr("class"))!="undefined" && $("#username").parent().parent().next().attr("class").search("msg")>-1)
			$("#username").parent().parent().next().remove();
		
		if(validateUserName())
		{
			$("#username").parent().parent().after("<tr class=\"msg\"><td colspan=\"2\" class=\"okmsg\">Valid username</td></tr>");
		}
		else
		{
			$("#username").parent().parent().after("<tr class=\"msg\"><td colspan=\"2\" class=\"errormsg\">Invalid username</td></tr>");
		}
	});
	
	//Display guidelines for password
	$("#password").on('input', function()
	{
		if(typeof($("#password").parent().parent().next().attr("class"))!="undefined" && $("#password").parent().parent().next().attr("class").search("msg")>-1)
			$("#password").parent().parent().next().remove();
		
		$("#password").parent().parent().after("<tr class=\"msg\"><td colspan=\"2\" class=\"infomsg\">Password should be at least 6 characters long and include lower, upper case letter and a number</td></tr>");
	});
	
	//Validate password
	$("#password").change(function()
	{
		if(typeof($("#password").parent().parent().next().attr("class"))!="undefined" && $("#password").parent().parent().next().attr("class").search("msg")>-1)
			$("#password").parent().parent().next().remove();
		
		if(validatePassword())
		{
			$("#password").parent().parent().after("<tr class=\"msg\"><td colspan=\"2\" class=\"okmsg\">Valid password</td></tr>");
		}
		else
		{
			$("#password").parent().parent().after("<tr class=\"msg\"><td colspan=\"2\" class=\"errormsg\">Invalid password</td></tr>");
		}
	});
	
	//Confirm password
	$("#passconfirm").change(function()
	{
		if(typeof($("#passconfirm").parent().parent().next().attr("class"))!="undefined" && $("#passconfirm").parent().parent().next().attr("class").search("msg")>-1)
			$("#passconfirm").parent().parent().next().remove();
		
		if(confirmPassword())
		{
			$("#passconfirm").parent().parent().after("<tr class=\"msg\"><td colspan=\"2\" class=\"okmsg\">Correct</td></tr>");
		}
		else
		{
			$("#passconfirm").parent().parent().after("<tr class=\"msg\"><td colspan=\"2\" class=\"errormsg\">Passwords don't match</td></tr>");
		}
	});
	
	//Validate e-mail
	$("#email").change(function()
	{
		if(typeof($("#email").parent().parent().next().attr("class"))!="undefined" && $("#email").parent().parent().next().attr("class").search("msg")>-1)
			$("#email").parent().parent().next().remove();
		
		if(validateEmail())
		{
			$("#email").parent().parent().after("<tr class=\"msg\"><td colspan=\"2\" class=\"okmsg\">Valid email</td></tr>");
		}
		else
		{
			$("#email").parent().parent().after("<tr class=\"msg\"><td colspan=\"2\" class=\"errormsg\">Invalid e-mail</td></tr>");
		}
	});
	
	//Validate name field
	$("#firstname").change(function()
	{
		if(typeof($("#firstname").parent().parent().next().attr("class"))!="undefined" && $("#firstname").parent().parent().next().attr("class").search("msg")>-1)
			$("#firstname").parent().parent().next().remove();
		
		if(validateName())
		{
			//$("#firstname").parent().parent().after("<tr class=\"msg\"><td colspan=\"2\" class=\"okmsg\"></td></tr>");
		}
		else
		{
			$("#firstname").parent().parent().after("<tr class=\"msg\"><td colspan=\"2\" class=\"errormsg\">Invalid input</td></tr>");
		}
	});
	
	//Validate last name field
	$("#lastname").change(function()
	{
		if(typeof($("#lastname").parent().parent().next().attr("class"))!="undefined" && $("#lastname").parent().parent().next().attr("class").search("msg")>-1)
			$("#lastname").parent().parent().next().remove();
		
		if(validateLastName())
		{
			//$("#lastname").parent().parent().after("<tr class=\"msg\"><td colspan=\"2\" class=\"okmsg\"></td></tr>");
		}
		else
		{
			$("#lastname").parent().parent().after("<tr class=\"msg\"><td colspan=\"2\" class=\"errormsg\">Invalid input</td></tr>");
		}
	});
	
	//Display guidelines for birth-date
	$("#bday").on('input', function()
	{
		if(typeof($("#bday").parent().parent().next().attr("class"))!="undefined" && $("#bday").parent().parent().next().attr("class").search("msg")>-1)
			$("#bday").parent().parent().next().remove();
		
		$("#bday").parent().parent().after("<tr class=\"msg\"><td colspan=\"2\" class=\"infomsg\">Format: dd-mm-yyyy</td></tr>");
	});
	
	//Validate birth-date
	$("#bday").change(function()
	{
		if(typeof($("#bday").parent().parent().next().attr("class"))!="undefined" && $("#bday").parent().parent().next().attr("class").search("msg")>-1)
			$("#bday").parent().parent().next().remove();
		
		if(validateBirthDate())
		{
			//$("#bday").parent().parent().after("<tr class=\"msg\"><td colspan=\"2\" class=\"okmsg\"></td></tr>");
		}
		else
		{
			$("#bday").parent().parent().after("<tr class=\"msg\"><td colspan=\"2\" class=\"errormsg\">Invalid input</td></tr>");
		}
	});
	
	//Validate/handle phone number
	$("#phonenum").change(function()
	{
		if(typeof($("#phonenum").parent().parent().next().attr("class"))!="undefined" && $("#phonenum").parent().parent().next().attr("class").search("msg")>-1)
			$("#phonenum").parent().parent().next().remove();
		
		if(validatePhoneNum())
		{
			//$("#phonenum").parent().parent().after("<tr class=\"msg\"><td colspan=\"2\" class=\"okmsg\"></td></tr>");
		}
		else
		{
			$("#phonenum").parent().parent().after("<tr class=\"msg\"><td colspan=\"2\" class=\"errormsg\">Invalid input</td></tr>");
		}
	});
});

function validateForm()
{
	return validateUserName() && validatePassword() && confirmPassword() && validateEmail() && validateName() && validateLastName() && validateBirthDate() && validatePhoneNum();
}


function validateUserName()
{
	txt = $("#username").val();

	tmp = $("#username").val().match(/[0-9|A-Z|a-z]{8,20}/);
	
	if(txt!=tmp)
		return false;

	return true;
}

function validatePassword()
{
	txt = $("#password").val();

	tmp = /[A-Z]/;
	if(!tmp.test(txt))
		return false;

	tmp = /[a-z]/;
	if(!tmp.test(txt))
		return false;
	
	tmp = /[0-9]/;
	if(!tmp.test(txt))
		return false;
	
	return txt.length>=6 && txt.length<=30;
}

function confirmPassword()
{
	txt = $("#password").val();
	tmp = $("#passconfirm").val();
	
	return txt==tmp;
}

function validateEmail()
{
	txt = $("#email").val();

	if(txt.lenght==0)
		return false;
	
	tmp = /[a-z0-9]+@[a-z0-9]+\.[a-z0-9]+/;
	if(txt.match(tmp)==txt)
		return true;

	tmp = /[a-z0-9]+\.[a-z0-9]+@[a-z0-9]+\.[a-z0-9]+\.[a-z0-9]+/;
	if(txt.match(tmp)==txt)
		return true;
	
	return false;
}

function validateName()
{
	txt = $("#firstname").val();

	//Dodati naša slova?
	tmp = $("#firstname").val().match(/^[A-Z][a-z]{0,20}/);
	
	if(txt!=tmp)
		return false;

	return true;
}

function validateLastName()
{
	txt = $("#lastname").val();

	tmp = $("#lastname").val().match(/^[A-Z][a-z]{0,20}/);
	
	if(txt!=tmp)
		return false;

	return true;
}

function validateBirthDate()
{
	//Provjera po mjesecima, etc? CBA for now
	txt = $("#bday").val();

	tmp = $("#bday").val().match(/[0-9-]{8,10}/);
	if(txt!=tmp)
		return false;
	
	var args = [];
	args = txt.split("-");
	
	if(args[0]<1 || args[0]>31)
		return false;
	
	if(args[1]<1 || args[1]>12)
		return false;
	
	if(args[2]<1900 || args[2]>2017)
		return false;
	
	return true;
}

function validatePhoneNum()
{
	txt = $("#phonenum").val();

	tmp = $("#phonenum").val().match(/[0-9-]{0,15}/);
	
	if(txt!=tmp)
		return false;
	
	txt = txt.replace(/-/g, "")
	
	return (txt.length<=10 && txt.length>=3) || (txt.length==0);
}

function resetWarnings()
{
	$(".msg").remove();
}

function redirect()
{
	var timer = 5;
	
	document.getElementById("redirection_timer").innerHTML = "You will be redirected in "+timer;
	
	var timeOut = setTimeout(function()
	{
		window.location = "homepage.php";
	}, 5000
	);
	
	setInterval(function()
	{
		timer--;
		document.getElementById("redirection_timer").innerHTML = "You will be redirected in "+timer;
	}, 1000
	);
}