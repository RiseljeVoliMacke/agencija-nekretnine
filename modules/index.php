<?php
 session_start();
 ?>

<!doctype html>
<html>
<head>
    <title>Oglas</title>
    <meta charset="utf8">
	<script src="../js/index.js?version1"></script>
	<link rel="stylesheet" type="text/css" href="../css/index.css?version1">
	<link rel="stylesheet" type="text/css" href="../css/navbar.css">
</head>
<body>

	<?php
	function jsdebug($tmp)
	{
		echo "<script>console.log(\"".$tmp."\")</script>";
	}
	
	//Log-out handler
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		if(empty($_POST))
		{
			session_unset();
			session_destroy();
		}
	}

	$user = "root";
	$pass = "";
	$dbname = "agencija_nekretnine";

	$conn = new mysqli("localhost", $user, $pass, $dbname);
	if ($conn->connect_error) 
		die("Connection failed: " . $conn->connect_error);
	
	if(isset($_GET["num"]))
		$index = $_GET["num"];
	else
		$index = 1;

	$sql = "select username, firstName, email, phoneNum, opis, slika, grad, ulica, cijena, povrsina, povrsina_placa, broj_soba from
	oglas as o, nekretnina as n, user as u where o.n_id=n.id and o.u_username=u.username and o.id=".$index;

	$row = "";
	$result = mysqli_query($conn, $sql);
	if($result->num_rows == 1)
	{
		$row = $result->fetch_assoc();
	}
	else
		die("<p class=\"permError\">You do not have required permissions to perform this action");
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
		
		<div id="oglas">
			<div id="slika">
				<img src="../oglasi_images/<?php echo $row["slika"]; ?>">
			</div>
			<div id="tblinfo">
				<table>
					<tr>
						<td>
							Vlasnik
						</td>
						<td>
							<?php echo $row["firstName"]; ?>
						</td>
					</tr>
					<tr>
						<td>
							E-Mail
						</td>
						<td>
							<?php echo $row["email"]; ?>
						</td>
					</tr>
					<tr>
						<td>
							Telefon
						</td>
						<td>
							<?php echo $row["phoneNum"]; ?>
						</td>
					</tr>
					<tr>
						<td>
							Grad
						</td>
						<td>
							<?php echo $row["grad"]; ?>
						</td>
					</tr>
					<tr>
						<td>
							Ulica
						</td>
						<td>
							<?php echo $row["ulica"]; ?>
						</td>
					</tr>
					<tr>
						<td>
							Površina objekta
						</td>
						<td>
							<?php echo $row["povrsina"]; ?> m<sup>2</sup>
						</td>
					</tr>
					<tr>
						<td>
							Površina placa
						</td>
						<td>
							<?php echo $row["povrsina_placa"]; ?> m<sup>2</sup>
						</td>
					</tr>
					<tr>
						<td>
							Broj soba
						</td>
						<td>
							<?php echo $row["broj_soba"]; ?>
						</td>
					</tr>
					<tr>
						<td>
							Cijena
						</td>
						<td>
							<?php echo $row["cijena"]; ?>€
						</td>
					</tr>
				</table>
			</div>
		<?php
		if(isset($_SESSION['user']) && ($_SESSION['user']==$row["username"] || $_SESSION['user']=="admin"))
		{
			echo "<form method=\"POST\" action=\"update.php\" onsubmit=\"return proceed()\">";
			echo "<select class=\"hiddenp\" name=\"index\">";
			echo "<option class=\"hiddenp\" value=\"".$_GET["num"]."\"></option>";
			echo "</select>";
			echo "<input type=\"submit\" value=\"Izmijeniti oglas\" id=\"change\" name=\"update\" class=\"btn\">";
			echo "<input type=\"submit\" value=\"Izbrisati oglas\" id=\"delete\" name=\"delete\" class=\"btn\" onclick=\"popup()\">";
			echo "</form>";
		}
		?>
			<hr>
			
			<div id="opis">
				<h2>Više detalja:</h2>
				<br>
				<p id="opisp"><?php echo $row["opis"]; ?></p>
			</div>
			
			<hr>
			
			<div id="komentari">
				<h2>Komentari</h2>
				<ul>
				<?php
				//Sacuvaj komentar u db
				if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"]))
				{
					$sql = "update komentar
							set tekst=\"".$_POST["tekst"]."\"
							, datum = \"".date('Y-m-d H:i:s')."\" 
							where id=".$_POST["index"];
							
					mysqli_query($conn, $sql);
				}
				
				//Brisanje komentara
				if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"]))
				{
					$sql = "delete from komentar 
							where id=".$_POST["delete"];
							
					mysqli_query($conn, $sql);
				}
				
				$sql = "select id, u_username, tekst, datum
					from komentar as k
					where k.oglas_id=".$index."
					order by datum desc";
			
				$result = mysqli_query($conn, $sql);
				
				while($row = $result->fetch_assoc())
				{
					echo "<li><p class=\"hiddenp\">".$row["id"]."</p>";
					echo "<span class=\"username\">".$row["u_username"]." said:</span>";
					
					if(isset($_SESSION["user"]) && ($row["u_username"]==$_SESSION["user"] || $_SESSION["user"]=="admin"))
					{
						echo "<img src=\"../images/edit.ico\" alt=\"edit_comment\" class=\"edit_comm\" onclick=\"editComm(this)\">";
					
						echo "<form method=\"post\" action=\"index.php\" onsubmit=\"return deleteComm(this)\" id=\"deletefrm\"><input type=\"hidden\" name=\"delete\" id=\"delete_hidden\"><input type=\"image\" src=\"../images/delete.ico\" alt=\"delete_comment\" class=\"delete_comm\"></form>";
					}
					
					echo "<p class=\"comment\">".$row["tekst"]."</p>";
					echo "<span class=\"date\">".date('d-m-Y H:i:s', strtotime($row["datum"]))."</span></li>";
				}
				
				$conn->close();
				?>
				</ul>
			</div>
			
		</div>
	</div>
	
</body>
</html>