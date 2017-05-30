function pageRedirect()
{
	var timer = 5;
	
	document.getElementById("redirection_timer").innerHTML = "You will be redirected in "+timer;
	
	var timeOut = setTimeout(function()
	{
		window.location = "oglasi.php?page=1";
	}, 5000
	);
	
	setInterval(function()
	{
		timer--;
		document.getElementById("redirection_timer").innerHTML = "You will be redirected in "+timer;
	}, 1000
	);
}