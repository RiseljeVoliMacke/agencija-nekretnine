<!doctype html>
<html>
<head>
    <title>Home Page</title>
    <meta charset="utf8">
    <script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/slideshow.js"></script>
	<link rel="stylesheet" type="text/css" href="css/homepage.css">
	<link rel="stylesheet" type="text/css" href="css/navbar.css">
</head>
<body>
	<?php
		$login = false;
		
		if ($_SERVER["REQUEST_METHOD"] == "POST") 
		{
			//Need to secure acces to database!
			
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
				$row = $result->fetch_assoc();
				// echo $row["username"];
				// echo $row["password"];
				$login = true;
			}
			
			$conn->close();
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
    <div id="login" <?php if($login) echo "class=\"hidden\""; ?>>
		<form id="loginform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
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
					<input type="text" id="password" name="password">
				</li>
				<li>
					<input type="submit" id="submitbtn" value="Log in">
				</li>
				<li>
					Need an account? <a href="register.php">Register</a>
				</li>
			
			</ul>
		</form>
	</div>
    
	<div id="center">
	
		<!--Navigation bar on top of central div-->
		<div id="navbar">
			<a href="homepage.php" class="selected">Home Page</a><a href="about.php">About</a>
		</div>
		
		<!-- Header panel -->
		<div id="header">
			<h1>Home Page</h1>
	
		</div>
	
		<!-- Center slider -->
		<!-- using images from folder for now, 
		query them from db later-->
		<div id="slider">
			
		</div>
		
		<!-- Code to handle log-in attempts -->
		
	</div>
		
</body>
</html>