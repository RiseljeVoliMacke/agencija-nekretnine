<?php
 session_start();
 ?>

<!doctype html>
<html>
<head>
    <title>Početna</title>
    <meta charset="utf8">
    <script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/slideshow.js"></script>
	<link rel="stylesheet" type="text/css" href="css/homepage.css">
	<link rel="stylesheet" type="text/css" href="css/navbar.css">
</head>
<body>

	<!-- Code to handle log-in attempts -->
	<?php
	/*For error handling, will only display 1 message("Invalid username or password") rather then be specific for security reasons*/
	$error = "";

		if ($_SERVER["REQUEST_METHOD"] == "POST") 
		{
			if(!empty($_POST))
			{
				//Need to secure access to database!
				
				$user = "root";
				$pass = "";
				$dbname = "agencija_nekretnine";
					
				$conn = new mysqli("localhost", $user, $pass, $dbname);
				
				if ($conn->connect_error) 
					echo("Connection failed: " . $conn->connect_error);
				
				$username = test_input($_POST["username"]);
				$password = test_input($_POST["password"]);
				
				$result = mysqli_query($conn, "SELECT username, password FROM user as u WHERE u.username = \"$username\" and u.password = \"$password\"");
				
				//Change condition to something better?
				if($result->num_rows == 1)
				{
					//admin check
					$_SESSION["user"] = $username;
					
					//Add all usernames that have admin level priviledges
					if($username=="admin")
						$_SESSION["status"] = "admin";
					
					//$row = $result->fetch_assoc();
					// echo $row["username"];
					// echo $row["password"];
				}
				else
					$error = "Invalid username or password";
				
				$conn->close();
			}
			else
			{
				session_unset();
				session_destroy();
			}
		}
		
		function test_input($data) 
		{
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  
		  return $data;
		}
	?>
	
	<!-- Log in form on the left side -->
    <div id="login">
		<form id="loginform" method="post" action=<?php echo "\"".htmlspecialchars($_SERVER["PHP_SELF"])."\""; if(isset($_SESSION['user'])) echo "class=\"hidden\""; ?>>
			<ul>
				<li>
					<label for="username">Username</label>
				</li>
				<li>
					<input type="text" id="username" name="username">
				</li>
				<li>
					<label for="password">Password</label>
				</li>
				<li>
					<input type="password" id="password" name="password">
				</li>
				<li>
					<input type="submit" id="submitbtn" value="Log in">
					<?php echo "<span class=\"errortext\">".$error."</span>"; ?>
				</li>
				<li>
					Need an account? <a href="register.php">Register</a>
				</li>
			
			</ul>
		</form>
	</div>
	
	<div id="center">
		<!--Navigation bar on top of central div-->
		<ul id="navbar">
			<li class="selected">
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
		
		<!-- Header panel -->
		<div id="header">
			<h1>Home Page</h1>
		</div>
	
		<!-- Center slider -->
		<!-- using images from folder for now, 
		query them from db later-->
		<div id="slider">
		</div>
       
        
	</div>
		
</body>
</html>