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
	<link rel="icon" type="image/ico" href="../images/favicon.ico">
</head>

<body>

	<?php
		$userNameErr = $passwordErr = $confirmPasswordErr = $emailErr = $firstNameErr = $lastNameErr = $bdayErr = $phoneNumErr = "";
		
		if ($_SERVER["REQUEST_METHOD"] == "POST") 
		{
			$user = "root";
			$pass = "";
			$dbname = "agencija_nekretnine";
			$conn = new mysqli("localhost", $user, $pass, $dbname);
			
			if ($conn->connect_error) 
					die("Connection failed: " . $conn->connect_error);
			
			//PHP validation
			$register = true;
			
			$userName = test_input($_POST["username"]);
			$password = test_input($_POST["password"]);
			$confirmPassword = test_input($_POST["passconfirm"]);
			$email = test_input($_POST["email"]);
			$firstName = test_input($_POST["firstname"]);
			$lastName = test_input($_POST["lastname"]);
			$bday = test_input($_POST["bday"]);
			$phoneNum = test_input($_POST["phonenum"]);
			$city = $_POST["city"];

			if(empty($userName))
			{
				$userNameErr = "<tr class=\"msg\"><td colspan=\"2\" class=\"errormsg\">Username is required!</td></tr>";
				$register = false;
			}
			elseif(!preg_match("/[A-Za-z0-9]{0,20}/", $userName))
			{
				$userNameErr = "<tr class=\"msg\"><td colspan=\"2\" class=\"errormsg\">Invalid username</td></tr>";
				$register = false;
			}
			else
			{
				$sql = "select username from user as u where u.username=\"$userName\"";
				$result = mysqli_query($conn, $sql);
				
				if($result->num_rows > 0)
				{
					$userNameErr = "<tr class=\"msg\"><td colspan=\"2\" class=\"errormsg\">Username is already taken</td></tr>";
					$register = false;
				}
			}

			if(empty($password))
			{
				$passwordErr = "<tr class=\"msg\"><td colspan=\"2\" class=\"errormsg\">Password is required!</td></tr>";
				$register = false;
			}
			elseif(!preg_match("/[A-Z]/", $password) || !preg_match("/[a-z]/", $password) || !preg_match("/[0-9]/", $password) || strlen($password)<6 || strlen($password)>30)
			{
				$passwordErr = "<tr class=\"msg\"><td colspan=\"2\" class=\"errormsg\">Invalid password</td></tr>";
				$register = false;
			}
			
			if($password != $confirmPassword)
			{
				$confirmPasswordErr = "<tr class=\"msg\"><td colspan=\"2\" class=\"errormsg\">Passwords don't match</td></tr>";
				$register = false;
			}
				 
			if(empty($email))
			{
				$emailErr = "<tr class=\"msg\"><td colspan=\"2\" class=\"errormsg\">E-mail is required!</td></tr>";
				$register = false;
			}
			elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
			{
				$emailErr = "<tr class=\"msg\"><td colspan=\"2\" class=\"errormsg\">Invalid e-mail</td></tr>";
				$register = false;
			}
			else
			{
				$sql = "select email from user as u where u.email=\"$email\"";
				$result = mysqli_query($conn, $sql);
				
				if($result->num_rows > 0)
				{
					$emailErr = "<tr class=\"msg\"><td colspan=\"2\" class=\"errormsg\">E-mail is already taken</td></tr>";
					$register = false;
				}
			}
			
			if(empty($firstName))
			{
				$firstNameErr = "<tr class=\"msg\"><td colspan=\"2\" class=\"errormsg\">First Name is required!</td></tr>";
				$register = false;
			}
			elseif(!preg_match("/^[A-Z][a-z]{0,20}/", $firstName))
			{
				$firstNameErr = "<tr class=\"msg\"><td colspan=\"2\" class=\"errormsg\">Invalid input</td></tr>";
				$register = false;
			}
			
			if(empty($lastName))
			{
				$lastNameErr = "<tr class=\"msg\"><td colspan=\"2\" class=\"errormsg\">Last Name is required!</td></tr>";
				$register = false;
			}
			elseif(!preg_match("/^[A-Z][a-z]{0,20}/", $lastName))
			{
				$lastNameErr = "<tr class=\"msg\"><td colspan=\"2\" class=\"errormsg\">Invalid input</td></tr>";
				$register = false;
			}
			
			if(empty($bday))
			{
				$bdayErr = "<tr class=\"msg\"><td colspan=\"2\" class=\"errormsg\">Birth date is required!</td></tr>";
				$register = false;
			}
			/*else if(!preg_match("/^[A-Z][a-z]{0,20}/", $bday))
				$bdayErr = "<tr class=\"msg\"><td colspan=\"2\" class=\"errormsg\">Invalid username3!</td></tr>";*/
		
			if($register)
			{
				$sql = "insert into user(username, password, email, firstName, lastName, birthDate, phoneNum, city) values (\"$userName\", \"$password\", \"$email\", \"$firstName\", \"$lastName\", \"$bday\", \"$phoneNum\", \"$city\")";
				
				if(mysqli_query($conn, $sql))
				{
					?>		
						<div id="center">
							<p class="succes">Uspješno ste se registrovali</p>
							<div class="container">
								<div class="dummy"></div>
								<div class="loader"></div>
								<p id="redirection_timer"></p>
							</div>
							<script> pageRedirect(); </script>
						</div>
					<?php
					die();
				}
				else
				{
					?>
					<div id="center">
						<p class=\"permError\">Greška tokom upisa</p>
					</div>
					<?php
					die("");
				}
			}
			
			$conn->close();
		}

		function test_input($tmp)
		{
			$tmp = trim($tmp);
			$tmp = stripslashes($tmp);
			$tmp = htmlspecialchars($tmp);
			
			return $tmp;
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
							<input type="text" name="username" id="username" maxlength="20">
						</td>
					</tr>
					<?php
						echo $userNameErr;
					?>
					<tr>
						<td>
							<label for="password">Password:</label>
						</td>
						<td>
							<input type="password" name="password" id="password" maxlength="30">
						</td>
					</tr>
					<?php
						echo $passwordErr;
					?>
					<tr>
						<td>
							<label for="passconfirm">Confirm password:</label>
						</td>
						<td>
							<input type="password" name="passconfirm" id="passconfirm" maxlength="30">
						</td>
					</tr>
					<?php
						echo $confirmPasswordErr;
					?>
					<tr>
						<td>
							<label for="email">E-mail:</label>
						</td>
						<td>
							<input type="email" name="email" id="email" maxlength="30">
						</td>
					</tr>
					<?php
						echo $emailErr;
					?>
					<tr>
						<td>
							<label for="firstname">Ime:</label>
						</td>
						<td>
							<input type="text" name="firstname" id="firstname" maxlength="20">
						</td>
					</tr>
					<?php
						echo $firstNameErr;
					?>
					<tr>
						<td>
							<label for="lastname">Prezime:</label>
						</td>
						<td>
							<input type="text" name="lastname" id="lastname" maxlength="20">
						</td>
					</tr>
					<?php
						echo $lastNameErr;
					?>
					<tr>
						<td>
							<label for="bday">Datum rođenja:</label>
						</td>
						<td>
							<!--<input type="date" name="bday" id="bday" min="01-01-1900" max="01-01-2017">-->
							<input type="text" name="bday" id="bday" maxlength="20">
						</td>
					</tr>
					<?php
						echo $bdayErr;
					?>
					<tr>
						<td>
							<label for="phonenum">Telefon:</label>
						</td>
						<td>
							<input type="text" name="phonenum" id="phonenum" maxlength="20">
						</td>
					</tr>
					<tr>
						<td>
							<label for="city">Grad:</label>
						</td>
						<td>
							<!-- Create dropdown list from database -->
							<!--<input type="text" name="city" id="city">-->
							<select name="city">
							<?php 
								$user = "root";
								$pass = "";
								$dbname = "agencija_nekretnine";
									
								$conn = new mysqli("localhost", $user, $pass, $dbname);
								if ($conn->connect_error) 
									echo("Connection failed: " . $conn->connect_error);
								
								$sql = "select naziv from grad";
								$result = mysqli_query($conn, $sql);
						
								while($row = $result->fetch_assoc())
								{
									echo "<option value=\"".$row["naziv"]."\">".$row["naziv"]."</option>";
								}
								
								$conn->close();
							?>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<input type="submit" id="submitbtn">
						</td>
						<td>
							<input type="reset" id="resetbtn" onclick="resetWarnings()">
						</td>
					</tr>
					
				</table>
				
			</form>
		</div>
		
	</div>
		
</body>
</html>