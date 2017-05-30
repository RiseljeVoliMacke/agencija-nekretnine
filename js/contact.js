function pageRedirect()
{
	var timer = 3;
	var index = document.getElementById("ind").innerHTML;
	
	document.getElementById("redirection_timer").innerHTML = "You will be redirected in "+timer;
	
	var timeOut = setTimeout(function()
	{
		window.location = "index.php?num="+index;
	}, 3000
	);
	
	setInterval(function()
	{
		timer--;
		document.getElementById("redirection_timer").innerHTML = "You will be redirected in "+timer;
	}, 1000
	);
}
