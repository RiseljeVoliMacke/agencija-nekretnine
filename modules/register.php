<?php
 session_start();
 ?>

<!doctype html>
<html>
<head>
    <title>Register</title>
    <meta charset="utf8">
	<script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/register.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/register.css">
	<link rel="stylesheet" type="text/css" href="../css/navbar.css">
</head>

<body>
	<?php
	//Log-out handler
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		 echo $_POST["bday"];
		// echo "tsdadsadasdasdasdasdasdasdasdasdasdasdasdasdext";
	}
	?>
	
	<div id="center">
		<!--Navigation bar on top of central div-->
		<ul id="navbar">
			<li>
				<a href="homepage.php">Početna</a>
			</li>
			<li>
				<a href="oglasi.php">Oglasi</a>
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
				<p id="welcomemsg" <?php if(!(isset($_SESSION['user']))) echo "class=\"hidden\""; ?>>Welcome <?php echo $_SESSION['user']; ?></p>
			</li>
			<li>
				<form id="logout" method="post" action=<?php echo "\"".htmlspecialchars($_SERVER["PHP_SELF"])."\""; if(!isset($_SESSION['user'])) echo "class=\"hidden\""; ?>>
				<input type="submit" id="logoutbtn" value="Log out" <?php if(!(isset($_SESSION['user']))) echo "class=\"hidden\""; ?>>
				</form>
			</li>
		</ul>
		
		<!--Fix caching of values!!!-->
		<div id="registration">
			<h1>Registration</h1>
			<form id="registerform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm()">
				<table id="registertbl">
					<tr>
						<td>
							<label for="username">Username:</label>
						</td>
						<td>
							<input type="text" name="username" id="username">
						</td>
					</tr>
					<tr>
						<td>
							<label for="password">Password:</label>
						</td>
						<td>
							<input type="password" name="password" id="password">
						</td>
					</tr>
					<tr>
						<td>
							<label for="passconfirm">Confirm password:</label>
						</td>
						<td>
							<input type="password" name="passconfirm" id="passconfirm">
						</td>
					</tr>
					<tr>
						<td>
							<label for="email">E-mail:</label>
						</td>
						<td>
							<input type="email" name="email" id="email">
						</td>
					</tr>
					<tr>
						<td>
							<label for="firstname">Ime:</label>
						</td>
						<td>
							<input type="text" name="firstname" id="firstname">
						</td>
					</tr>
					<tr>
						<td>
							<label for="lastname">Prezime:</label>
						</td>
						<td>
							<input type="text" name="lastname" id="lastname">
						</td>
					</tr>
					<tr>
						<td>
							<label for="bday">Datum rođenja:</label>
						</td>
						<td>
							<!--<input type="date" name="bday" id="bday" min="01-01-1900" max="01-01-2017">-->
							<input type="text" name="bday" id="bday">
						</td>
					</tr>
					<tr>
						<td>
							<label for="phonenum">Telefon:</label>
						</td>
						<td>
							<input type="text" name="phonenum" id="phonenum">
						</td>
					</tr>
					<tr>
						<td>
							<label for="city">Grad:</label>
						</td>
						<td>
							<!-- Create dropdown list from database -->
							<input type="text" name="city" id="city">
						</td>
					</tr>
					<tr>
						<td>
							<input type="submit" id="submitbtn">
						</td>
						<td>
							<input type="reset" id="resetbtn">
						</td>
					</tr>
					
				</table>
				
			</form>
		
		</div>
	</div>
		
</body>
</html>