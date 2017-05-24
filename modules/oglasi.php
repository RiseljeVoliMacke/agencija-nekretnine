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
				<input type="submit" id="logoutbtn" value="Log out" <?php if(!(isset($_SESSION['user']))) echo "class=\"hidden\""; ?>>
				</form>
			</li>
		</ul>
		
		<h1>OGLASI</h1>
		
		<div id="oglasi">
				<?php
					$user = "root";
					$pass = "";
					$dbname = "agencija_nekretnine";
				
					$conn = new mysqli("localhost", $user, $pass, $dbname);
					if ($conn->connect_error) 
						die("Connection failed: " . $conn->connect_error);
					
					$sql = "select count(*) from oglas";
					$result = mysqli_query($conn, $sql);
					$result = $result->fetch_assoc();

					$pageCount = (int) ceil( $result["count(*)"]/ 5);
					
					if(isset($_GET["page"]))
						$split = $_GET["page"];
					else
						$split = 1;
		
					$lowerBound = 1 + ($split-1) * 5;
					$upperBound = $split * 5;
					
					$sql = "select o.id, kratki_opis, slika, grad, ulica from
					oglas as o, nekretnina as n
					where o.n_id=n.id and o.id>=".$lowerBound." and o.id<=".$upperBound."";
					
					$result = mysqli_query($conn, $sql);
					
					while($row = $result->fetch_assoc())
					{
						echo "<table><tr><td colspan=\"2\"><img src=\"".$row["slika"]."\"></td></tr>";
						echo "<tr><td><p>".$row["ulica"]."</p></td>";
						echo "<td class=\"rightcol\"><p>".$row["grad"]."</p></td></tr>";
						echo "<tr><td class=\"opis\"><p>".$row["kratki_opis"]."</p></td>";
						//NEED TO FIX LINKS!!!
						echo "<td class=\"rightcol link\"><a href=\"index.php?num=".$row["id"]."\">More details</a></td></tr></table>";
					}
				?>
		</div>
		
		<div id="pagecount">
			<ul id="pagecountlist">
			</ul>
		</div>
		
		<p class="hiddenp">
			<?php
				echo $pageCount;
			?>
		</p>
	</div>
	
</body>
</html>