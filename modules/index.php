<?php
 session_start();
 ?>

<!doctype html>
<html>
<head>
    <title>Oglas</title>
    <meta charset="utf8">
	<link rel="stylesheet" type="text/css" href="../css/index.css">
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

		$sql = "select firstName, email, phoneNum, opis, slika, grad, ulica from
		oglas as o, nekretnina as n, user as u where o.n_id=n.id and o.u_username=u.username and o.id=".$index;
	
		$result = mysqli_query($conn, $sql);
		if($result->num_rows == 1)
		{
			$row = $result->fetch_assoc();
		}
		
		$conn->close();
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
				<input type="submit" id="logoutbtn" value="Log out" <?php if(!(isset($_SESSION['user']))) echo "class=\"hidden\""; ?>>
				</form>
			</li>
		</ul>
		
		<div id="oglas">
			<div id="slika">
				<img src="<?php echo $row["slika"]; ?>">
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
							Ulica
						</td>
						<td>
							<?php echo $row["ulica"]; ?>
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
				</table>
			</div>
		
			<div id="opis">
				<h2>Više detalja:</h2>
			<br>
				<p id="opisp"><?php echo $row["opis"]; ?></p>
			</div>
		
		</div>
	</div>
	
</body>
</html>