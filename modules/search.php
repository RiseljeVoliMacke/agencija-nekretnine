<?php
 session_start();
 ?>

<!doctype html>
<html>
<head>
    <title>Napredna pretraga</title>
    <meta charset="utf8">
	<link rel="stylesheet" type="text/css" href="../css/search.css">
	<link rel="stylesheet" type="text/css" href="../css/navbar.css">
	<link rel="icon" type="image/ico" href="../images/favicon.ico">
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
		
		
		
		
	</div>
	
</body>
</html>