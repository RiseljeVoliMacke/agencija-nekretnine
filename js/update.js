function pageRedirect()
{
	var timer = 5;
	
	var index = document.getElementById("index").innerHTML;
	document.getElementById("redirection_timer").innerHTML = "You will be redirected in "+timer;
	
	var timeOut = setTimeout(function()
	{
		window.location = "index.php?num="+index;
	}, 5000
	);
	
	setInterval(function()
	{
		timer--;
		document.getElementById("redirection_timer").innerHTML = "You will be redirected in "+timer;
	}, 1000
	);
}