<?php
 session_start();
 ?>

<!doctype html>
<html>
<head>
    <title>Iznajmljivanje</title>
    <meta charset="utf8">
	<script src="../js/rent.js?version1"></script>
	<link rel="stylesheet" type="text/css" href="../css/rent.css?version1">
	<link rel="stylesheet" type="text/css" href="../css/navbar.css?version1">
	<link rel="icon" type="image/ico" href="../images/favicon.ico">
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
				
				if(isset($_POST["index"]))
					$index = $_POST["index"];
				else
					die("<p class=\"permError\">Index not found");
			}
			
			function jsdebug($tmp)
			{
				echo "<script>console.log(\"".$tmp."\")</script>";
			}
			
			//Log-out handler
			if(empty($_POST))
			{
				session_unset();
				session_destroy();
			}
		}
		?>
		
	</div>
	 <?php //$conn->close(); ?>
</body>
</html>