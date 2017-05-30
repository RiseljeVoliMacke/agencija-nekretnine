<?php
 session_start();
 ?>

<!doctype html>
<html>
<head>
    <title>About</title>
    <meta charset="utf8">
	<link rel="stylesheet" type="text/css" href="../css/about.css">
	<link rel="stylesheet" type="text/css" href="../css/navbar.css">
	<link rel="icon" type="image/ico" href="../images/favicon.ico">
</head>
<body>

	<?php
		//Log-out handler
		if ($_SERVER["REQUEST_METHOD"] == "POST") 
		{
			if(empty($_POST))
			{
				session_unset();
				session_destroy();
			}
		}
	?>

	<div id="center">
		<!--Navigation bar on top of central div-->
		<ul id="navbar">
			<li>
				<a href="homepage.php">Početna</a>
			</li>
			<li>
				<a href="oglasi.php?page=1">Oglasi</a>
			</li>
			<li class="selected">
				<a href="about.php">About</a>
			</li>
			<?php 
			if(isset($_SESSION['status']))
			{
			?>
				<li>
					<a href="admin.php">Admin</a>
				</li>
			<?php
			}
			?>
			<li id="welcomemsg">
				<p  <?php if(!(isset($_SESSION['user']))) echo "class=\"hidden\""; ?>>Logged in as <?php echo $_SESSION['user']; ?></p>
			</li>
			<li>
				<form id="logout" method="post" action=<?php echo "\"".htmlspecialchars($_SERVER["PHP_SELF"])."\""; if(!isset($_SESSION['user'])) echo "class=\"hidden\""; ?>>
				<input type="submit" id="logoutbtn" value="Log out" class="btn" <?php if(!(isset($_SESSION['user']))) echo "class=\"hidden\""; ?>>
				</form>
			</li>
		</ul>
		
		<h1>Agencija za nekretnine</h1>
        
		
		Sajt se sastoji od vise modula:
		<ul>
			<li>
			Početna stranica sadrži standardne opcije za log-in/registaciju(redirekcija na specijalizovanu stranicu za registraciju.
            <br>
            Pored toga ima slider slika nekretnina koje vuče iz baze pseudo-randomly.
			</li>
			<li>
			Stranica posvećena oglasima sadrži listing(split by pages), kao i razne vrste za sortiranja.
            <br>
            Na pojedinačnim oglasima može se ugovoriti sastanak sa agentom ili potencijalno iznajmiti lokacija zavisno od vrste oglasa.
			</li>
            <li>
            Kontakt stranica
            </li>
            <li>
            About stranica
            </li>
            <li>
            Administrativna stranica
            </li>
		
    </ul>
		<br>
		<p>Opis baze, bla bla bla</p>
		<img src="../images/er.png">
		

	<ol>
		<li>
			Finish database<br>
			Tables: Agent, Sastanak, Rent<br>
			Fix attributes
		</li>
		<li>
		<s>Kreirati ER dijagram za vašu bazu podataka. Baza podataka mora da sadrži i tabelu UsersPass
		sa podacima o korisnicima aplikacije. Svaki korisnik ima jedinstvenu šifru, korisničko ime
		(username) i password. Pravo da rade sa aplikacijom imaju samo registrovani korisnici (oni koji
		se nalaze u tabeli UsersPass). Pored tabele UsersPass, potrebno je koristiti najmanje 4 tabele.
		Najmanje jedna od tabela mora sadržati i slike. Za proizvode koji se prodaju potrebno je čuvati
		istorijat cijena i poreza. U bazi možete čuvati same slike ili putanje do slika. Za sajtove tipa b) i
		c) korisnik koji je prijavljen može ostavljati komentare na pojedine slike ili predmete od
		interesa.</s>
		</li>  <li> <s>Kreirati relacionu bazu podataka (možete koristiti MySQL, SQL Server, Oracle, SQLite,
		PostgreSQL...)</s>
		</li>  <li> <s>Kreirati HTML5 stranicu koja sadrži opis aplikacije i strukturu baze podataka (spisak tabela,
		tipovi polja, ER dijagram).</s> Opisati i koje ste alate koristili. Dati mogućnost downloada PDF
		dokumenta koji sadrži opis aplikacije.
		</li>  <li> Potrebno je implementirati sledeće radnje:
		<br>a) <s>Naslovna stranica – opšti pregled vaše aplikacije, sa dijelom za registraciju ili logovanje.
		Implementirati slajder proizvoda ili fotografija (pogledati npr. http://www.aliexpress.com/ ).</s>
		<br>b) <s>Prijava za rad sa aplikacijom. Pojavljuje se pozdravna poruka i korisnik bira izmeñu 2
		opcije: novi korisnik i registrovani korisnik. Ako je korisnik registrovan, mora unijeti
		username i password. Ako se njegovo korisničko ime i lozinka nalaze u tabeli UsersPass,
		pojavljuje se nova stranica na kojoj korisnik bira odgovarajuću akciju (opisane u sledećim
		tačkama). Ako korisnik unese pogrešne podatke, prikaže se odgovarajuća poruka i korisniku
		se opet daje mogućnost unošenja podatka. Ako korisnik nije registrovan, treba prikazati
		formu za registrovanje korisnika koja sadrži polja za username, password i potvrdu
		password-a (confirm password), kao i lične podatke o korisniku: ime, prezime, datum
		roñenja, adresu, grad, državu, broj telefona, mail, i slično. Na svakoj stranici vršiti provjeru
		ispravnosti ulaza primjenon JQuery-a ili nekog drugoj JavaScript framework-a (na primjer,
		da li je broj telefona ispravno unešen, da li je datum roñenja ispravan, itd.). Početna strana
		sadrži i link na stranicu sa podacima o aplikaciji. Korisnik mora imati mogućnost da
		pregleda sadržaj prodavnice/sajta bez prijavljivanja.</s> Prijavljivanje je obavezno samo ako
		korisnik želi da kupi neki proizvod ili ako želi da ostavlja komentare.
		<br>c) Stranica za pretragu. Moguća su 2 nivoa pretrage: pretraga podataka u bazi i pretraga veba
		primjenom jednog od tri ponuñena pretraživača (Google, i još dva po vašem izboru).
		Podrazumijevana je pretraga u bazi podataka. Korisnik može da u slučaju veb-prodavnice
		bira pretragu po grupi proizvoda, po proizvodu, cjenovnom opsegu ili opisu. U slučaju
		agencije za nekretnine, može birati lokaciju, cijenu, veličinu nekretnine, itd. U slučaju
		teniskog turnira, može birati igrača, vrijeme, istorijat rezultata, itd. Po unošenju kriterijuma
		pretrage, rezultate upita prikazati u obliku linkova na pojedinačne zapise u tabeli (slično
		rezulatima pretrage na Amazon.com ili Google.com). Ako se kao rezultat upita dobije
		prikazuje više od 5 zapisa, prikazivati ih po 5 na stranici (slično kako Google prikazuje
		rezulate pretrage). Korisnik koji nije registrovan može vršiti pretragu ali ne može
		kupovati/ostavljati komentare. Za svaku sliku implementirati opciju zumiranja (pogledati
		npr. http://www.aliexpress.com/ ).
		<br>d) <s>Implementirati korpu za kupovinu ("shopping cart") – samo za veb-prodavnicu. Svaki
		registrovani korisnik može dodavati jedan ili više proizvoda u svoju korpu za kupovinu.
		Kada izabere proizvode, korisniku se daje mogućnost da prihvati ili odbije kupovinu.
		Potrebno je čuvati istorijat kupovina za svakog registrovanog korisnika i dati mogućnost
		pretraživanja svih kupovina u zadatom vremenskom intervalu (na primjer, od 01. januara
		2011. godine do 15. maja 2011. godine). Ako neregistrovani korisnik pokuša da dodaje u
		korpu, dati mu mogućnost da se registruje.</s>
		<br>e) <s>Stranica sa akcijama (administrativni dio sajta). Ove akcije može izvoditi samo korisnik koji
		ima privilegije vlasnika prodavnice ili sajta.</s> Vlasnik ima pravo dodavanja i brisanja
		korisnika, dodavanja, izmjene i brisanja proizvoda, promjene cijena, dodavanja novih
		vijesti, brisanja komentara korisnika koji naruše pravila ponašanja, itd. U slučaju neuspjeha
		neke od akcija, treba prikazati odgovarajuću poruku. Dodavanje zapisa u tabelu koja sadrži
		slike odraditi unošenjem slike u bazu ili uploadom slike u direktorijum na veb-serveru.
		</li>  <li> Sve stranice moraju da imaju jedinstven izgled odreñen sa jednom ili više eksternih CSS
		datoteka. Sve HTML i CSS datoteke moraju proći validaciju.
		</li>  <li> <s>Primjenom JavaScripta ili JQuery ili neke druge biblioteke vršiti validaciju na strani klijenta.</s>
		</li>
		
	</ol>  
		
	</div>
 
</body>
</html>