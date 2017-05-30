var selectedMonth = 1;
var numOfMonths = 12

function leftArrow()
{
	if(selectedMonth>1)
	{
		document.getElementById("month"+selectedMonth).classList.add("hiddenp");
		document.getElementById("month"+(selectedMonth-1)).classList.remove("hiddenp");
		
		selectedMonth--;
		if(selectedMonth==1)
			document.getElementById("arrow_left"+selectedMonth).classList.remove("btn");
	}
}

function rightArrow()
{
	if(selectedMonth<numOfMonths)
	{
		document.getElementById("month"+selectedMonth).classList.add("hiddenp");
		document.getElementById("month"+(selectedMonth+1)).classList.remove("hiddenp");
		
		selectedMonth++;
		if(selectedMonth==numOfMonths)
			document.getElementById("arrow_right"+selectedMonth).classList.remove("btn");
	}
}

function exec()
{
	//Fixing max values of input="date" elements
	tmp1 = document.getElementById("start_date").max;
	tmp2 = tmp1.split("-");
	document.getElementById("start_date").max = tmp2[0]+"-"+("0"+tmp2[1]).slice(-2)+"-"+("0"+(tmp2[2]-1)).slice(-2);
	
	tmp1 = document.getElementById("end_date").max;
	tmp2 = tmp1.split("-");
	document.getElementById("end_date").max = tmp2[0]+"-"+("0"+tmp2[1]).slice(-2)+"-"+("0"+tmp2[2]).slice(-2);
	
	var arr1 = JSON.parse(document.getElementById("hidden1").innerHTML);
	var arr2 = JSON.parse(document.getElementById("hidden2").innerHTML);
	
	var i, j, startDate, endDate, now, numOfDays;
	for(i=0; i<arr1.length; i++)
	{
		startDate = arr1[i].split("-");
		endDate = arr2[i].split("-");

		startDate[0] = parseInt(startDate[0]);
		startDate[1] = parseInt(startDate[1]);
		startDate[2] = parseInt(startDate[2]);
		
		endDate[0] = parseInt(endDate[0]);
		endDate[1] = parseInt(endDate[1]);
		endDate[2] = parseInt(endDate[2]);

		numOfDays = new Date(startDate[0], startDate[1], 0).getDate();
		while(startDate[0] != endDate[0] || startDate[1] != endDate[1] || startDate[2] != endDate[2])
		{
			document.getElementById(startDate[0]+" "+startDate[1]+" "+startDate[2]).classList.add("reserved");
			document.getElementById(startDate[0]+" "+startDate[1]+" "+startDate[2]).classList.remove("free");
			document.getElementById(startDate[0]+" "+startDate[1]+" "+startDate[2]).removeAttribute("onclick");
			
			if(startDate[2] < numOfDays)
				startDate[2]++;
			else
			{
				startDate[2] = 1;
				if(startDate[1]<12)
					startDate[1]++;
				else
				{
					startDate[1] = 1;
					startDate[0]++;
				}
				
				numOfDays = new Date(startDate[0], startDate[1]+1, 0).getDate();
			}
		}
		console.log(startDate);
		document.getElementById(startDate[0]+" "+startDate[1]+" "+startDate[2]).classList.add("reserved");
		document.getElementById(startDate[0]+" "+startDate[1]+" "+startDate[2]).classList.remove("free");
		document.getElementById(startDate[0]+" "+startDate[1]+" "+startDate[2]).removeAttribute("onclick");
	}
}

var mode = 0;
var date1, date2, date1Arr, date2Arr;
var elem1, elem2, tmp1, tmp2;

function reserve(elem)
{
	document.getElementById("msg").classList.remove("errormsg");
	document.getElementById("msg").classList.remove("okmsg");
	document.getElementById("msg").classList.add("hiddenp");
	//Obradjujemo pocetni datum
	if(mode==0)
	{
		if(typeof(elem1)!="undefined")
		{
			elem1.classList.remove("marked");
			document.getElementById("start_date").value = "";
		}
		if(typeof(elem2)!="undefined")
		{
			elem2.classList.remove("marked");
			document.getElementById("end_date").value = "";
		}
		
		elem1 = elem;
		date1 = elem.id;
		elem.classList.add("marked");
		
		date1Arr = date1.split(" ");
		document.getElementById("start_date").value = date1Arr[0]+"-"+("0"+date1Arr[1]).slice(-2)+"-"+("0"+date1Arr[2]).slice(-2);
		
		document.getElementById("end_date").disabled = false;
		mode = 1;
	}
	//Obradjujemo krajnji datum
	else
	{
		date2 = elem.id;
		elem2 = elem;
		
		if(date2<date1)
		{
			document.getElementById("msg").classList.remove("hiddenp");
			document.getElementById("msg").classList.add("errormsg");
			document.getElementById("msg").innerHTML = "Krajnji datum nije validan";
			
			mode = 0;
			elem1.classList.remove("marked");
			document.getElementById("start_date").value = "";
			
			return;
		}
		
		date2Arr = date2.split(" ");

		var numOfDays = new Date(date1Arr[0], date1Arr[1], 0).getDate();
		while(date1Arr[0]<date2Arr[0] || date1Arr[1]<date2Arr[1] || date1Arr[2]<date2Arr[2])
		{
			tmp1 = date1Arr[0]+" "+date1Arr[1]+" "+date1Arr[2];

			if(document.getElementById(tmp1).classList.contains("reserved"))
			{
				document.getElementById("msg").classList.remove("hiddenp");
				document.getElementById("msg").classList.add("errormsg");
				document.getElementById("msg").innerHTML = "Krajnji datum nije validan";
				
				mode = 0;
				elem1.classList.remove("marked");
				document.getElementById("start_date").value = "";
				
				return;
			}
			
			if(date1Arr[2] < numOfDays)
				date1Arr[2]++;
			else
			{
				date1Arr[2] = 1;
				if(date1Arr[1]<12)
					date1Arr[1]++;
				else
				{
					date1Arr[1] = 1;
					date1Arr[0]++;
				}

				numOfDays = new Date(date1Arr[0], date1Arr[1], 0).getDate();
			}
		}
		
		//Unos je pravilan, lez go
		document.getElementById("msg").classList.remove("hiddenp");
		document.getElementById("msg").classList.remove("errormsg");
		document.getElementById("msg").classList.add("okmsg");
		document.getElementById("msg").innerHTML = "Unos je ok";
		elem.classList.add("marked");
		document.getElementById("end_date").value = date2Arr[0]+"-"+("0"+date2Arr[1]).slice(-2)+"-"+("0"+date2Arr[2]).slice(-2);

		mode = 0;
	}
}

function startDateChanged(elem)
{
	document.getElementById("msg").classList.remove("errormsg");
	document.getElementById("msg").classList.remove("okmsg");
	document.getElementById("msg").classList.add("hiddenp");
	
	mode = 0;
	document.getElementById("end_date").disabled = true;
	tmp1 = elem.value;
	date1Arr = tmp1.split("-");
	
	date1Arr[1] = parseInt(date1Arr[1]);
	date1Arr[2] = parseInt(date1Arr[2]);

	tmp1 = document.getElementById(date1Arr[0]+" "+date1Arr[1]+" "+date1Arr[2]);
	if(tmp1!=null && !(tmp1.classList.contains("reserved")))
	{
		date1 = tmp1.id;
		
		if(typeof(elem1)!="undefined")
		{
			elem1.classList.remove("marked");
			// document.getElementById("start_date").value = "";
		}
		if(typeof(elem2)!="undefined")
		{
			elem2.classList.remove("marked");
			// document.getElementById("end_date").value = "";
		}
		
		tmp1.classList.add("marked");
		elem1 = tmp1;
		date1 = tmp1.id;
		
		document.getElementById("end_date").disabled = false;
		mode = 1;
	}
}

function endDateChanged(elem)
{
	document.getElementById("msg").classList.remove("errormsg");
	document.getElementById("msg").classList.remove("okmsg");
	document.getElementById("msg").classList.add("hiddenp");
	
	mode = 1;
	tmp1 = elem.value;
	date2Arr = tmp1.split("-");
	
	date2Arr[0] = parseInt(date2Arr[0]);
	date2Arr[1] = parseInt(date2Arr[1]);
	date2Arr[2] = parseInt(date2Arr[2]);
	
	tmp1 = document.getElementById(date2Arr[0]+" "+date2Arr[1]+" "+date2Arr[2]);
	console.log(tmp1);
	
	if(typeof(elem2)!="undefined")
	{
		elem2.classList.remove("marked");
	}
	
	if(tmp1!=null)
	{
		if(!(tmp1.classList.contains("reserved")))
		{
			date2 = tmp1.id;

			if(date2<date1)
			{
				document.getElementById("msg").classList.remove("hiddenp");
				document.getElementById("msg").classList.add("errormsg");
				document.getElementById("msg").innerHTML = "Krajnji datum nije validan, pokusajte ponovo";
				
				/*mode = 0;
				elem1.classList.remove("marked");
				document.getElementById("start_date").value = "";
				document.getElementById("end_date").value = "";
				document.getElementById("end_date").disabled = true;*/
				
				return;
			}
			
			
			
			var numOfDays = new Date(date2Arr[0], date2Arr[1], 1).getDate();
			while(date1Arr[0]<date2Arr[0] || date1Arr[1]<date2Arr[1] || date1Arr[2]<date2Arr[2])
			{
				tmp2 = date1Arr[0]+" "+date1Arr[1]+" "+date1Arr[2];

				if(document.getElementById(tmp2).classList.contains("reserved"))
				{
					document.getElementById("msg").classList.remove("hiddenp");
					document.getElementById("msg").classList.add("errormsg");
					document.getElementById("msg").innerHTML = "Krajnji datum nije validan, pokusajte ponovo";
					
					/*mode = 0;
					elem1.classList.remove("marked");
					document.getElementById("start_date").value = "";
					document.getElementById("end_date").value = "";
					document.getElementById("end_date").disabled = true;*/
				
					return;
				}
				
				if(date1Arr[2] < numOfDays)
					date1Arr[2]++;
				else
				{
					date1Arr[2] = 1;
					if(date1Arr[1]<12)
						date1Arr[1]++;
					else
					{
						date1Arr[1] = 1;
						date1Arr[0]++;
					}
					
					numOfDays = new Date(date1Arr[0], date1Arr[1]+1, 0).getDate();
				}
			}
			
			document.getElementById("msg").classList.remove("hiddenp");
			document.getElementById("msg").classList.remove("errormsg");
			document.getElementById("msg").classList.add("okmsg");
			document.getElementById("msg").innerHTML = "Unos je ok";
			tmp1.classList.add("marked");
			elem2 = tmp1;
			
			mode = 0;
		}
		else
		{
			document.getElementById("msg").classList.remove("hiddenp");
			document.getElementById("msg").classList.add("errormsg");
			document.getElementById("msg").innerHTML = "Krajnji datum nije validan, pokusajte ponovo";
		}
	}	
}

function validate()
{
	if(document.getElementById("msg").innerHTML == "Unos je ok")
		return true;
	else
		return false;
}

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
