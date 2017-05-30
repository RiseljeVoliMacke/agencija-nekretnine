var tmp = 1;
var next;
var imgArray = [];
var sliderBtnArray = [];
var i = 0;
var interval;
var stack = [];
var numOfImages = 5;

$(document).ready(function() 
{	
	//Get images from db with php
	var picArr = JSON.parse($(".hiddenp").text());
	var upperBound = picArr.length;

	var randomArr = [];
	var coef = 0.25;
	var tmp1, tmp2;
	
	while(randomArr.length<numOfImages)
	{
		tmp1 = Math.random();

		if(tmp1<coef)
		{
			tmp1 = Math.floor(Math.random()*upperBound);
			tmp2 = picArr[tmp1];

			if(!randomArr.includes(tmp2))
				randomArr.push(tmp2);
		}
	}
	
	//Populating array with image elements and adding them to div
	for(i; i<numOfImages; i++)
	{
		imgArray[i] = document.createElement("img");
		imgArray[i].src = "../oglasi_images/"+randomArr[i];
		imgArray[i].alt = "sliderimage"+(i+1);
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
		
		next = elem.target.id.charAt(9);

		sliderBtnArray[tmp-1].classList.remove("sliderSelected");
		document.getElementById(elem.target.id).classList.add("sliderSelected");
		
		if(tmp!=next)
		{
			$("img:nth-child("+tmp+")").animate({right: "200%"}, 1000, function()
			{
				i = stack.shift()
				document.getElementById("img"+ i ).style.right = "-100%";	
				
				stack.shift();
			});
			
			stack.push(tmp);
			stack.push(next);
		
			tmp = next;
			$("img:nth-child("+next+")").animate({right: "0"}, 650);
		}
	});
});

function createSlideshow()
{	
	next = (tmp + 1) % (numOfImages+1);
	if (next == 0)
		next = 1;
	
	$("img:nth-child("+tmp+")").animate({right: "200%"}, 1000);
	$("img:nth-child(" + next + ")").animate({right: "0"}, 650);
	
	sliderBtnArray[tmp-1].classList.remove("sliderSelected");
	sliderBtnArray[next-1].classList.add("sliderSelected");
	
	if(tmp>1)
		document.getElementById("img"+ (tmp-1)).style.right = "-100%";
	else 
		document.getElementById("img"+numOfImages).style.right = "-100%";
	
	
	tmp = (tmp + 1) % (numOfImages+1);
	if(tmp==0)
		tmp = 1;
}