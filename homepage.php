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
        <div id="login">
			<form id="loginform" action="login.php" method="post">
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
		
			<div id="navbar">
				<a href="homepage.php" class="selected">Home Page</a><a href="about.php">About</a>
			</div>
		
			<div id="header">
				<h1>Home Page</h1>
		
			</div>
		
			<!-- using images from folder for now, 
			query them from db later-->
			<div id="slider">
				
			</div>
				
		</div>
		
</body>
</html>