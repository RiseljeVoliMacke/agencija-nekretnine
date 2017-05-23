var tmp = 1;
var next;
imgArray = [];
sliderBtnArray = [];
var i = 0;
var interval;
var stack = [];

$(document).ready(function() 
{	
	//Get images from db with php
	var numOfImages = 5;
	
	//Populating array with image elements and adding them to div
	for(i; i<numOfImages; i++)
	{
		imgArray[i] = document.createElement("img");
		imgArray[i].src = "images/rak"+(i+1)+".png";
		imgArray[i].id = "img" + (i+1);
		
		document.getElementById("slider").appendChild(imgArray[i]);
	}

	/*Populating array with p elements(clickable circles) that
	show which picture is currently selected*/
	var xOffSet = 34;
	for(i=0; i<numOfImages; i++)
	{
		
		sliderBtnArray[i] = document.createElement("p");
		sliderBtnArray[i].id = "sliderbtn" + (i+1);
		sliderBtnArray[i].classList.add("sliderbtns");
		sliderBtnArray[i].style.top = "90%";
		sliderBtnArray[i].style.left = xOffSet + (i*8) + "%";
		
		document.getElementById("slider").appendChild(sliderBtnArray[i]);
	}
	
	$("img:nth-child("+tmp+")").animate({right: "0"}, 1000);
	sliderBtnArray[0].classList.add("sliderSelected");
	
	//Periodic change of the image
	interval = setInterval(function()
	{
		createSlideshow();
	}, 5000);
	
	//Making circles clickable
	$(".sliderbtns").click(function(elem)
	{
		clearInterval(interval);
		
		var targ = elem.target.id.charAt(9);

		document.getElementById(elem.target.id).classList.add("sliderSelected");
		sliderBtnArray[tmp-1].classList.remove("sliderSelected");
		
		stack.push(tmp);
		
		$("img:nth-child("+tmp+")").animate({right: "200%"}, 1000, function()
		{
			var tmp2 = stack.shift()
			// console.log(tmp2);
			document.getElementById("img"+ tmp2).style.right = "-100%";	
		});
		
		$("img:nth-child("+targ+")").animate({right: "0"}, 650);
		
		tmp = targ;
	});
});

function createSlideshow()
{	
	next = (tmp + 1) % 6;
	if (next == 0)
		next = 1;
	
	$("img:nth-child("+tmp+")").animate({right: "200%"}, 1000);
	$("img:nth-child(" + next + ")").animate({right: "0"}, 650);
	
	sliderBtnArray[tmp-1].classList.remove("sliderSelected");
	sliderBtnArray[next-1].classList.add("sliderSelected");
	
	if(tmp>1)
		document.getElementById("img"+ (tmp-1)).style.right = "-100%";
	else 
		document.getElementById("img5").style.right = "-100%";
	
	
	tmp = (tmp + 1) % 6;
	if(tmp==0)
		tmp = 1;
}



