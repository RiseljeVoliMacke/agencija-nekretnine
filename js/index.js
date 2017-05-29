var res = true;

function proceed()
{
	return res;
}

function popup()
{
	if(confirm("Jeste li sigurni da zelite da izbrisete ovaj oglas?"))
		res = true;
	else
		res = false;
}

function editComm(elem)
{
	var oglasIndex = document.getElementById("oglas_index").innerHTML;
	
	var li = elem.parentElement;
	var index = li.children[0].innerHTML;
	li.classList.add("hiddenp");
	
	var frm = document.createElement("form");
	frm.method = "POST";
	frm.action = "index.php?num=" + oglasIndex;
	
	li.parentNode.insertBefore(frm, li.nextSibling);
	
	var textArea = document.createElement("textarea");
	textArea.rows = 5;
	textArea.maxLength = 400;
	textArea.name = "tekst"
	textArea.value = li.children[4].innerHTML;
	
	var saveBtn = document.createElement("input");
	saveBtn.classList.add("save_btn");
	saveBtn.type = "submit";
	saveBtn.name = "submit";
	saveBtn.value = "Sačuvaj";
	saveBtn.classList.add("btn");
	
	var cancelBtn = document.createElement("button");
	cancelBtn.classList.add("cancel_btn");
	cancelBtn.type = "button";
	cancelBtn.innerHTML = "Cancel";
	cancelBtn.classList.add("btn");
	
	cancelBtn.addEventListener("click", function()
	{
		this.parentElement.previousSibling.classList.remove("hiddenp");
		this.parentElement.parentElement.removeChild(this.parentElement);
	});
	
	var indexElem = document.createElement("input");
	indexElem.type = "text";
	indexElem.value = index;
	indexElem.name = "index";
	indexElem.classList.add("hiddenp");
	
	frm.appendChild(textArea);
	frm.appendChild(saveBtn);
	frm.appendChild(cancelBtn);
	frm.appendChild(indexElem);
}

function deleteComm(elem)
{
	var li = elem.parentElement;
	var index = li.children[0].innerHTML;
	document.getElementById("delete_hidden").value = index;
	
	return confirm("Jeste li sigurni da zelite da obrisete komentar?");
}

function newComm()
{
	var oglasIndex = document.getElementById("oglas_index").innerHTML;
	
	var frm = document.createElement("form");
	frm.method = "POST";
	frm.action = "index.php?num=" + oglasIndex;
	frm.id = "create_frm";
	
	var hr = document.getElementsByTagName("hr")[1];
	hr.parentNode.insertBefore(frm, hr.nextSibling);
	
	var textArea = document.createElement("textarea");
	textArea.rows = 5;
	textArea.maxLength = 400;
	textArea.name = "tekst"
	textArea.id = "create_txt"
	
	var saveBtn = document.createElement("input");
	saveBtn.classList.add("save_btn");
	saveBtn.id = "create_btn";
	saveBtn.type = "submit";
	saveBtn.name = "create";
	saveBtn.value = "Kreiraj";
	saveBtn.classList.add("btn");
	
	var cancelBtn = document.createElement("button");
	cancelBtn.classList.add("cancel_btn");
	cancelBtn.id = ("cancel_btn");
	cancelBtn.type = "button";
	cancelBtn.innerHTML = "Cancel";
	cancelBtn.classList.add("btn");
	
	cancelBtn.addEventListener("click", function()
	{
		this.parentElement.parentElement.removeChild(this.parentElement);
	});
	
	frm.appendChild(textArea);
	frm.appendChild(saveBtn);
	frm.appendChild(cancelBtn);
}