var tmp, tmp1, i;
var pageNumArray = [];

//Avoid using jquery?
$(document).ready(function()
{
	tmp = document.getElementById("hidden1").innerHTML;
	tmp1 = document.getElementById("hidden2").innerHTML;

    var xoffSet = 50 - (tmp*3);
    var list = document.getElementById("pagecountlist");

	for(i=0; i<tmp; i++)
	{
		pageNumArray[i] = document.createElement("li");
		
		if(tmp1!="")
		{
			pageNumArray[i].innerHTML = "<a href=\"oglasi.php?page="+(i+1)+"&filters="+tmp1+"\">"+(i+1)+"</a>";
		}
		else
		{
			pageNumArray[i].innerHTML = "<a href=\"oglasi.php?page="+(i+1)+"\">"+(i+1)+"</a>";
		}
        
        pageNumArray[i].classList.add("pagenum");
        pageNumArray[i].style.left = xoffSet+"%";
        xoffSet++;
		
        list.appendChild(pageNumArray[i]);
	}
	
	document.getElementById("down").style.filter = "grayscale(100%)";
	document.getElementById("sort").value = "asc";
	
	$("#down").click(function()
	{
		document.getElementById("sort").value = "desc";
		document.getElementById("down").style.filter = "grayscale(0%)";
		document.getElementById("up").style.filter = "grayscale(100%)";
	});
	
	$("#up").click(function()
	{
		document.getElementById("sort").value = "asc";
		document.getElementById("up").style.filter = "grayscale(0%)";
		document.getElementById("down").style.filter = "grayscale(100%)";
	});
});