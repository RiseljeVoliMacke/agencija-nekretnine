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