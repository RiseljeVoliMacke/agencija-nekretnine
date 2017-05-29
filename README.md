# To-do:
-Search function from google?
-Online iznajmljivanje prostora??????
-Ugovaranje sastanaka
-Administratorske akcije
-add log-in panel on every page(except register/admin)?
-ogranici broj oglasa/komentara koje user moze postaviti
-fix welcome message
-Za svaku sliku implementirati opciju zumiranja (pogledati
npr. http://www.aliexpress.com/ ).

List of leftovers from files:
//Provjera po mjesecima, etc? CBA for now
//Dodati naša slova?
//Php validacija datuma rodjenja?
//Need to secure access to database!	

-brisanje oglasa -> greska sa sliderom na home page-u
-breadcrumbs?
-capcha code on registration
-copy LogOutRedirection on every page

function jsdebug($tmp)
{
	echo "<script>console.log(\"".$tmp."\")</script>";
}

function openConn()
{
	global $conn, $index;
	$user = "root";
	$pass = "";
	$dbname = "agencija_nekretnine";

	$conn = new mysqli("localhost", $user, $pass, $dbname);
	if ($conn->connect_error) 
		die("Connection failed: " . $conn->connect_error);
	
	if(isset($_POST["index"]))
		$index = $_POST["index"];
	else
		die("<p class=\"permError\">Index not found");
}

<div class="container">
	<div class="dummy"></div>
	<div class="loader"></div>
	<p id="redirection_timer"></p>
</div>

<script> redirect(); </script>

echo "<p class=\"succes\">Oglas uspješno obrisan</p>";
die("<p class=\"permError\">Oglas nije mogao biti obrisan</p>");