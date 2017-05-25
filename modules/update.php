<?php
 session_start();
 ?>

<!doctype html>
<html>
<head>
    <title>Izmjena oglasa</title>
    <meta charset="utf8">
	<link rel="stylesheet" type="text/css" href="../css/update.css?version2">
	<link rel="stylesheet" type="text/css" href="../css/navbar.css">
</head>
<body>

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
		
		<?php
		//Log-out handler
		if ($_SERVER["REQUEST_METHOD"] == "POST") 
		{
			if(empty($_POST))
			{
				session_unset();
				session_destroy();
				
				header("Location: homepage.php");
			}
			else if(isset($_POST["update"]))
			{
				//Code for updating
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

				$sql = "select username, firstName, email, phoneNum, opis, slika, grad, ulica, cijena, povrsina, povrsina_placa, broj_soba from
				oglas as o, nekretnina as n, user as u where o.n_id=n.id and o.u_username=u.username and o.id=".$index;
				
				$row = "";
				$result = mysqli_query($conn, $sql);
				if($result->num_rows == 1)
				{
					$row = $result->fetch_assoc();
				}
				else
					die("Error in retrieving data from database");
				
				//Suvisno?
				if(!(isset($_SESSION["user"]) && $_SESSION["user"]==$row["username"]))
					die("<p class=\"permError\">You do not have required permissions to perform this action");
			}	
			else if(isset($_POST["delete"]))
			{
				//Code for deleting oglas
				
			}
			else
				die("<p class=\"permError\">You do not have required permissions to perform this action");
		}
		else
			die("<p class=\"permError\">You do not have required permissions to perform this action");
		?>
		
		<div id="oglas">
			<!-- Upload slike -->
		
			<div id="tblinfo">
				<table>
					<tr>
						<td>
							Vlasnik
						</td>
						<td>
							<input type="txt" value="<?php echo $row["firstName"]; ?>" name="firstName">
						</td>
					</tr>
					<tr>
						<td>
							E-Mail
						</td>
						<td>
							<input type="txt" value="<?php echo $row["email"]; ?>" name="email">
						</td>
					</tr>
					<tr>
						<td>
							Telefon
						</td>
						<td>
							<input type="txt" value="<?php echo $row["phoneNum"]; ?>" name="phoneNum">
						</td>
					</tr>
					<tr>
						<td>
							Grad
						</td>
						<td>
							<input type="txt" value="<?php echo $row["grad"]; ?>" name="grad">
						</td>
					</tr>
					<tr>
						<td>
							Ulica
						</td>
						<td>
							<input type="txt" value="<?php echo $row["ulica"]; ?>" name="ulica">
						</td>
					</tr>
					<tr>
						<td>
							Površina objekta
						</td>
						<td>
							<input type="txt" value="<?php echo $row["povrsina"]; ?>" name="povrsina">
						</td>
					</tr>
					<tr>
						<td>
							Površina placa
						</td>
						<td>
							<input type="txt" value="<?php echo $row["povrsina_placa"]; ?>" name="povrsina_placa">
						</td>
					</tr>
					<tr>
						<td>
							Broj soba
						</td>
						<td>
							<input type="txt" value="<?php echo $row["broj_soba"]; ?>" name="broj_soba">
						</td>
					</tr>
					<tr>
						<td>
							Cijena
						</td>
						<td>
							<input type="txt" value="<?php echo $row["cijena"]; ?>€" name="cijena">
						</td>
					</tr>
				</table>
			</div>
			
			<hr>
			
			<div id="opis">
			
				<h2>Više detalja:</h2>
			<br>
				<textarea id="opisp" rows="10" ><?php echo $row["opis"]; ?></textarea>
			</div>
			
			<hr>
			
			<input type="submit" value="Update" id="submit" name="finalupdate" class="btn">
			
		</div>
	</div>
	
</body>
</html>