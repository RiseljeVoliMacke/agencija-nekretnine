<?php
 session_start();
 ?>

<!doctype html>
<html>
<head>
    <title>Oglasi</title>
    <meta charset="utf8">
	<script src="../js/jquery-3.2.1.min.js"></script>
	<script src="../js/oglasi.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/oglasi.css">
	<link rel="stylesheet" type="text/css" href="../css/navbar.css">
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
			<li class="selected">
				<a href="oglasi.php?page=1">Oglasi</a>
			</li>
			<li>
				<a href="contact.php">Kontakt</a>
			</li>
			<li>
				<a href="about.php">About</a>
			</li>
			<li>
				<a href="admin.php" <?php if(!(isset($_SESSION['status']))) echo "class=\"hidden\""; ?>>Admin</a>
			</li>
			<li>
				<p id="welcomemsg" <?php if(!(isset($_SESSION['user']))) echo "class=\"hidden\""; ?>>Welcome <?php if(isset($_SESSION['user'])) echo $_SESSION['user']; ?></p>
			</li>
			<li>
				<form id="logout" method="post" action=<?php echo "\"".htmlspecialchars($_SERVER["PHP_SELF"])."\""; if(!isset($_SESSION['user'])) echo "class=\"hidden\""; ?>>
				<input type="submit" id="logoutbtn" value="Log out" class="btn" <?php if(!(isset($_SESSION['user']))) echo "class=\"hidden\""; ?>>
				</form>
			</li>
		</ul>
		
		<h1>OGLASI</h1>
		
		<div id="oglasi">
				<?php
					function jsdebug($tmp)
					{
						echo "<script>console.log(\"".$tmp."\")</script>";
					}
				
					$user = "root";
					$pass = "";
					$dbname = "agencija_nekretnine";
				
					$conn = new mysqli("localhost", $user, $pass, $dbname);
					if ($conn->connect_error) 
						die("Connection failed: " . $conn->connect_error);
				
					if(isset($_GET["page"]))
						$split = $_GET["page"];
					else
						$split = 1;
					
					$sort = "asc";
					if(isset($_GET["sort"]))
						$sort = $_GET["sort"];
					
					$filter = "";
					if(isset($_GET["filters"]))
					{
						$filter = $_GET["filters"];
						$sql = "select o.id, kratki_opis, slika, grad, cijena from
						oglas as o, nekretnina as n
						where o.n_id=n.id
						order by ".$filter." ".$sort;
					}
					else
					{
						$sql = "select o.id, kratki_opis, slika, grad, cijena from
						oglas as o, nekretnina as n
						where o.n_id=n.id";
					}
					
					$result = mysqli_query($conn, $sql);
					$pageCount = (int) ceil($result->num_rows/ 5);	
					$result->data_seek(($split-1)*5);

					$br = 0;
					while($row = $result->fetch_assoc() and $br<5)
					{
						$br++;
						echo "<table><tr><td colspan=\"2\"><img src=\"../oglasi_images/".$row["slika"]."\"></td></tr>";
						echo "<tr><td><p>".$row["grad"]."</p></td>";
						echo "<td class=\"rightcol\"><p>".$row["cijena"]."€</p></td></tr>";
						echo "<tr><td class=\"opis\"><p>".$row["kratki_opis"]."</p></td>";
						echo "<td class=\"rightcol link\"><a href=\"index.php?num=".$row["id"]."\">More details</a></td></tr></table>";
					}
				?>
		</div>
		
		<div id="pagecount">
			<ul id="pagecountlist">
			</ul>
		</div>
		
		<p class="hiddenp" id="hidden1"><?php
				echo $pageCount;
		?></p>
		<p class="hiddenp" id="hidden2"><?php
				echo $filter;
		?></p>
		
	</div>
    <div id="rightpanel">
		<div>
			<a href="search.php" id="search">Napredna pretraga</a>
			<h3>Sortiraj po:</h3>
			<form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
				<select class="hiddenp" name="page">
					<option class="hiddenp" value="<?php echo $split; ?>"></option>
				</select>
				<select name="filters" id="filters">
					<option value="grad">Grad</option>
					<option value="cijena">Cijena</option>
					<option value="povrsina">Površina</option>
					<option value="povrsina_placa">Površina placa</option>
					<option value="broj_soba">Broj soba</option>
				</select>
				<select class="hiddenp" name="sort">
					<option class="hiddenp" id="sort"></option>
				</select>
				
				<input type="submit" id="sortbtn" value="Sortiraj!" class="btn">
				<img src="../images/arrow_up.png" class="arrow" id="up">
				<img src="../images/arrow_down.png" class="arrow" id="down">
			</form>
			<?php
				if(isset($_SESSION["user"]))
				{
					?>
						<form method="post" action="create.php">
							<input type="submit" id="updatebtn" name="create" value="Novi Oglas" class="btn">
						</form>
					<?php
				}

			?>
		</div>
    </div>
	
</body>
</html>