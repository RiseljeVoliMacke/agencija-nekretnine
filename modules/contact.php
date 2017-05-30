<?php
 session_start();
 ?>

<!doctype html>
<html>
<head>
    <title>Kontakt</title>
    <meta charset="utf8">
	<script src="../js/contact.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/contact.css?version1">
	<link rel="stylesheet" type="text/css" href="../css/navbar.css">
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
	<?php
		function openConn()
		{
			global $conn;
			$user = "root";
			$pass = "";
			$dbname = "agencija_nekretnine";

			$conn = new mysqli("localhost", $user, $pass, $dbname);
			if ($conn->connect_error) 
				die("Connection failed: " . $conn->connect_error);
		}
		
		//Log-out handler
		if ($_SERVER["REQUEST_METHOD"] == "POST") 
		{
			if(empty($_POST))
			{
				session_unset();
				session_destroy();
			}
			elseif(isset($_POST["index"]))
			{
				$index = $_POST["index"];
				
			?>
			<div id="msgfield">
				<h2>Poruka</h2>
				<br>
				<form method="post" action="contact.php">
					<textarea id="opisp" rows="10" maxlength="500" name="tekst"></textarea>
					<input type="hidden" name="indexOglasa" value="<?php echo $index; ?>">
					<input type="submit" name="send" value="Posalji">
				</form>
			</div>
			<?php	
			}
			elseif(isset($_POST["send"]))
			{
				openConn();
				
				$index = $_POST["indexOglasa"];
				$msg = $_POST["tekst"];
				$datum = date("Y-m-d H:i:s");
				
				$sql = "insert into sastanak(`o_id`, `u_username`, `tekst`, `datum`) values(".$index.", \"".$_SESSION["user"]."\", \"".$msg."\", \"".$datum."\")";
				
				if(mysqli_query($conn, $sql))
				{
					$conn->close();
					?>
					<p class="succes">Poruka uspješno poslata</p>
					<div class="container">
						<div class="dummy"></div>
						<div class="loader"></div>
						<p id="redirection_timer"></p>
					</div>
					<p class="hiddenp" id="ind"><?php echo $index; ?></p>
					<script> pageRedirect(); </script>
					<?php
				}
				else
				{
					die("<p class=\"permError\">Poruka nije mogla biti poslata");
				}
			}
			else
			{
				die("<p class=\"permError\">You do not have required permissions to perform this action");
			}
		}
		else
			die("<p class=\"permError\">You do not have required permissions to perform this action");
	?>
	</div>
 
</body>
</html>