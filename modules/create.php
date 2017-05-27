<?php
 session_start();
 ?>

<!doctype html>
<html>
<head>
    <title>Novi oglas</title>
    <meta charset="utf8">
	<link rel="stylesheet" type="text/css" href="../css/create.css?version1">
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
			elseif(isset($_POST["create"]))
			{
				//Form for creating
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
									openConn();
									$sql = "select naziv from grad";
									$result = mysqli_query($conn, $sql);
							
									while($row2 = $result->fetch_assoc())
									{
										if($row2["naziv"]==$row["grad"])
											echo "<option selected value=\"".$row2["naziv"]."\">".$row2["naziv"]."</option>";
										else
											echo "<option value=\"".$row2["naziv"]."\">".$row2["naziv"]."</option>";
									}
									
									$conn->close();
									?>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									Ulica
								</td>
								<td>
									<input type="txt" name="ulica" maxlength="30">
								</td>
							</tr>
							<tr>
								<td>
									Površina objekta
								</td>
								<td>
									<input type="number" name="povrsina" min="0" max="100000">
								</td>
							</tr>
							<tr>
								<td>
									Površina placa
								</td>
								<td>
									<input type="number" name="povrsina_placa" min="0" max="100000">
								</td>
							</tr>
							<tr>
								<td>
									Broj soba
								</td>
								<td>
									<input type="number" name="broj_soba" min="0" max="30">
								</td>
							</tr>
							<tr>
								<td>
									Cijena
								</td>
								<td>
									<input type="number" name="cijena" min="0" max="100000000">
								</td>
							</tr>
						</table>
					</div>
					
					<hr>
					
					<div id="opis">
					
						<h2>Opis</h2>
					<br>
						<textarea id="opisp" rows="10" maxlength="500" name="opis"></textarea>
					</div>
					
					<hr>
					
					<div id="kratki_opis">
					
						<h2>Kratki opis</h2>
					<br>
						<textarea id="kratki_opisp" rows="4" maxlength="200" name="kratki_opis"></textarea>
					</div>
					
					<hr>
					
					<input type="submit" value="Create" id="create" name="finalcreate" class="btn">
					</form>
				</div>
		<?php	
			}
			elseif(isset($_POST["finalcreate"]))
			{
				//Changes are received, save them in db
				openConn();
				
				$sql = "select max(id) from nekretnina";
				$result = mysqli_query($conn, $sql);
				$row = $result->fetch_assoc();
				$index = $row["max(id)"];
				$index++;

				if($_FILES["slika"]["error"]==1)
					echo("<p class=\"permError\">Sorry, your file is too big ( ͡° ͜ʖ ͡°)</p>");
				
				if($_FILES["slika"]["error"]==0)
				{
					$target_dir = "../oglasi_images/";
					$target_file = $target_dir . "nek".$index.".jpg";
					$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
					$upl = 1;
					
					// Check if image file is a actual image or fake image
					$check = getimagesize($_FILES["slika"]["tmp_name"]);
					if($check !== false) 
					{}
					else 
						$upl = 0;
					
					// Check if file already exists
					/*if (file_exists($target_file))
						die("<p class=\"permError\">File already exists</p>");*/
					
					// Check file size
					if ($_FILES["slika"]["size"] > 2000000) 
					{
						echo("<p class=\"permError\">Sorry, your file is too big ( ͡° ͜ʖ ͡°)</p>");
						$upl = 0;
					}
		
					// Allow certain file formats
					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
					&& $imageFileType != "gif")
					{
						echo("<p class=\"permError\">Only .jpg/.png/.jpeg/.gif extensions are allowed</p>");
						$upl = 0;
					}
				}
				else
				{
					echo("<p class=\"permError\">Slika nije mogla biti upload-ovana</p>");
					$upl = 0;
				}
				
				if ($upl == 1)
				{
					move_uploaded_file($_FILES["slika"]["tmp_name"], $target_file);
					
					//Complete upload	
					$sql = "insert into nekretnina(slika, grad, ulica, cijena, povrsina, povrsina_placa, broj_soba) values(\"nek".$index.".jpg\", \"".$_POST["grad"]."\", \"".$_POST["ulica"]."\", ".$_POST["cijena"].", ".$_POST["povrsina"].", ".$_POST["povrsina_placa"].", ".$_POST["broj_soba"].")";

					if(mysqli_query($conn, $sql))
					{
						$sql = "insert into oglas(n_id, u_username, opis, kratki_opis) values(".$index.", \"".$_SESSION["user"]."\", \"".$_POST["opis"]."\", \"".$_POST["kratki_opis"]."\")";
						
						if(mysqli_query($conn, $sql))
							echo("<p class=\"succes\">Oglas uspješno kreiran</p>");
					}
					else
						echo("<p class=\"permError\">Oglas nije kreiran</p>");
					
				}
				$conn->close();
			}
		}	
		?>
	</div>
	
</body>
</html>