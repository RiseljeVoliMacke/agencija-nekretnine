<?php
 session_start();
 ?>

<!doctype html>
<html>
<head>
    <title>Izmjena oglasa</title>
    <meta charset="utf8">
	<link rel="stylesheet" type="text/css" href="../css/update.css?version3">
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
			//Function for opening connection to database
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
			
			function jsdebug($tmp)
			{
				echo "<script>console.log(\"".$tmp."\")</script>";
			}
			
			if(empty($_POST))
			{
				session_unset();
				session_destroy();
				
				header("Location: homepage.php");
			}
			else if(isset($_POST["update"]))
			{
				//Form for updating
				openConn();
	
				//Fetch fields from db
				$sql = "select username, firstName, email, phoneNum, opis, kratki_opis, n_id, slika, grad, ulica, cijena, povrsina, povrsina_placa, broj_soba from
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
				if(!(isset($_SESSION["user"]) && ($_SESSION["user"]==$row["username"] || $_SESSION["user"]=="admin")))
					die("<p class=\"permError\">You do not have required permissions to perform this action</p>");
			
			?>
			<div id="oglas">
				<!-- Upload slike -->
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
				
					<input type="file" name="slika" id="slika_upload">
					<label for="slika_upload" class="btn">Choose a file</label>
			
				<div id="tblinfo">
					<table>
						<tr>
							<td>
								Grad
							</td>
							<td>
								<select name="grad">
								<?php
									$sql = "select naziv from grad";
									$result = mysqli_query($conn, $sql);
							
									while($row2 = $result->fetch_assoc())
									{
										echo "<option value=\"".$row2["naziv"]."\">".$row2["naziv"]."</option>";
									}
								?>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								Ulica
							</td>
							<td>
								<input type="txt" value="<?php echo $row["ulica"]; ?>" name="ulica" maxlength="30">
							</td>
						</tr>
						<tr>
							<td>
								Površina objekta
							</td>
							<td>
								<input type="number" name="povrsina" value="<?php echo $row["povrsina"]; ?>" min="0" max="100000">
								<!--<input type="txt" value="<?php echo $row["povrsina"]; ?>" name="povrsina">-->
							</td>
						</tr>
						<tr>
							<td>
								Površina placa
							</td>
							<td>
								<input type="number" name="povrsina_placa" value="<?php echo $row["povrsina_placa"]; ?>" min="0" max="100000">
							</td>
						</tr>
						<tr>
							<td>
								Broj soba
							</td>
							<td>
								<input type="number" name="broj_soba" value="<?php echo $row["broj_soba"]; ?>" min="0" max="30">
							</td>
						</tr>
						<tr>
							<td>
								Cijena
							</td>
							<td>
								<input type="number" name="cijena" value="<?php echo $row["cijena"]; ?>" min="0" max="100000000">
							</td>
						</tr>
					</table>
				</div>
				
				<hr>
				
				<div id="opis">
				
					<h2>Opis</h2>
				<br>
					<textarea id="opisp" rows="10" maxlength="500" name="opis"><?php echo $row["opis"]; ?></textarea>
				</div>
				
				<hr>
				
				<div id="kratki_opis">
				
					<h2>Kratki opis</h2>
				<br>
					<textarea id="kratki_opisp" rows="4" maxlength="200" name="kratki_opis"><?php echo $row["kratki_opis"]; ?></textarea>
				</div>
				
				<hr>
				
				<select class="hiddenp" name="index">
					<option class="hiddenp" value="<?php echo $index; ?>"></option>
				</select>
				<select class="hiddenp" name="index2">
					<option class="hiddenp" value="<?php echo $row["n_id"]; ?>"></option>
				</select>
					
				<input type="submit" value="Update" id="submit" name="finalupdate" class="btn">
				</form>
			</div>
		<?php	
			}
			elseif(isset($_POST["finalupdate"]))
			{
				//Changes are sent, save them to db
				openConn();
				
				$target_dir = "../oglasi_images/";
				$target_file = $target_dir . "nek".$_POST["index"].".jpg";
				$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
				$upl = 1;
				
				// jsdebug($target_dir);
				// jsdebug($target_file);
				// jsdebug($imageFileType);
				// jsdebug($_FILES["slika"]["name"]);
				// jsdebug($_FILES["slika"]["tmp_name"]);
				
				// Check if image file is a actual image or fake image
				$check = getimagesize($_FILES["slika"]["tmp_name"]);
				if($check !== false) 
					// echo "File is an image - " . $check["mime"] . ".";
				else 
					$upl = 0;
			
				// Check if file already exists
				// if (file_exists($target_file))
					// die("<p class=\"permError\">File already exists</p>");
			
				// Check file size
				if ($_FILES["slika"]["size"] > 2000000) 
				{
					echo("<p class=\"permError\">Sorry, your file is too large ( ͡° ͜ʖ ͡°)</p>");
					$upl = 0;
				}
				
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif")
					$upl = 0;
				
				//Complete update
				$id = $_POST["index2"];
						
				$sql = "update nekretnina set grad=\"".$_POST["grad"]."\", ulica=\"".$_POST["ulica"]."\", povrsina=".$_POST["povrsina"].", povrsina_placa=".$_POST["povrsina_placa"].", broj_soba=".$_POST["broj_soba"]." where id=".$id;
				
				if(mysqli_query($conn, $sql))
				{
					
				}
				else
				{
					die("<p class=\"permError\">Oglas nije promijenjen</p>");
				}
				
				$sql = "update oglas set opis=\"".$_POST["opis"]."\", kratki_opis=\"".$_POST["kratki_opis"]."\" where id=".$_POST["index"];
				
				if(mysqli_query($conn, $sql))
				{
					//Timer with redirection?
					echo("Oglas uspjesno promijenjen");
				}
				else

					die("<p class=\"permError\">Oglas nije promijenjen</p>");

				if ($upl == 1)
				{
					move_uploaded_file($_FILES["slika"]["tmp_name"], $target_file);
				}
		
			}
			elseif(isset($_POST["delete"]))
			{
				//Code for deleting oglas
				
			}
			else
				die("<p class=\"permError\">You do not have required permissions to perform this action</p>");
		}
		else
			die("<p class=\"permError\">You do not have required permissions to perform this action</p>");
		?>
		
		
	</div>
	<?php $conn->close(); ?>
</body>
</html>