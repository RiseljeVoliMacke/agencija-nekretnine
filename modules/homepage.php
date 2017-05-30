<?php
 session_start();
 ?>

<!doctype html>
<html>
<head>
    <title>Početna</title>
    <meta charset="utf8">
    <script src="../js/jquery-3.2.1.min.js"></script>
	<script src="../js/homepage.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/homepage.css">
	<link rel="stylesheet" type="text/css" href="../css/navbar.css">
	<link rel="icon" type="image/ico" href="../images/favicon.ico">
</head>
<body>

	<?php
		/*Code to handle log-in attempts
		For error handling, will only display 1 message("Invalid username or password") rather then be specific for security reasons*/
		$error = "";

		//Need to secure access to database!	
		$user = "root";
		$pass = "";
		$dbname = "agencija_nekretnine";
			
		$conn = new mysqli("localhost", $user, $pass, $dbname);
		
		if ($conn->connect_error) 
			die("Connection failed: " . $conn->connect_error);
	
		if ($_SERVER["REQUEST_METHOD"] == "POST") 
		{
			if(!empty($_POST))
			{
				$username = test_input($_POST["username"]);
				$password = test_input($_POST["password"]);
				
				$result = mysqli_query($conn, "SELECT username, password FROM user as u WHERE u.username = \"$username\" and u.password = \"$password\"");
				
				//Change condition to something better?
				if($result->num_rows == 1)
				{
					//admin check
					$_SESSION["user"] = $username;
					//$_SESSION["pagenum"] = 1;
					
					//Add all usernames that have admin level priviledges
					if($username=="admin")
						$_SESSION["status"] = "admin";
				}
				else
					$error = "Invalid username or password";
			}
			else
			{
				//Log-out handler
				if(empty($_POST))
				{
					session_unset();
					session_destroy();
				}
			}
		}

		$sql = "select slika from nekretnina";
		$result = mysqli_query($conn, $sql);
		
		$picArr = array();
		while($row = $result->fetch_assoc())
		{
			array_push($picArr, $row["slika"]);
		}

		$json = json_encode($picArr);
		$conn->close();
		
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
				<a href="oglasi.php?page=1">Oglasi</a>
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
				<input type="submit" id="logoutbtn" value="Log out" class="btn" <?php if(!(isset($_SESSION['user']))) echo "class=\"hidden\""; ?>>
				</form>
			</li>
		</ul>
		
		<!-- Header panel -->
		<div id="header">
			<h1>Home Page</h1>
		</div>
	
		<!-- Center slider -->
		<div id="slider">
		</div>
       
        <p class="hiddenp">
			<?php echo $json; ?>
		</p>
	</div>
		
</body>
</html>