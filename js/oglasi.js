var tmp, i;
var pageNumArray = [];

//Avoid using jquery?
$(document).ready(function()
{
	tmp = $(".hiddenp").text();

    var xoffSet = 50 - (tmp*3);
    var list = document.getElementById("pagecountlist");

    
	for(i=0; i<tmp; i++)
	{
		pageNumArray[i] = document.createElement("li");
        pageNumArray[i].innerHTML = "<a href=\"http://localhost:8080/agencija-nekretnine/modules/oglasi.php?page="+(i+1)+"\">"+(i+1)+"</a>";
        pageNumArray[i].classList.add("pagenum");
        pageNumArray[i].style.left = xoffSet+"%";
        xoffSet++;
		
        list.appendChild(pageNumArray[i]);
	}
});