<?php
 session_start();
 ?>

<!doctype html>
<html>
<head>
    <title>Iznajmljivanje</title>
    <meta charset="utf8">
	<script src="../js/rent.js?version9"></script>
	<link rel="stylesheet" type="text/css" href="../css/rent.css?version9">
	<link rel="stylesheet" type="text/css" href="../css/navbar.css?version2">
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
				global $conn;
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
			
			function getDatePrevMonth($index, $currMonth, $currYear)
			{
				if($currMonth>1)
				{
					$prevMonth = $currMonth - 1;
					$prevYear = $currYear;
				}
				else
				{
					$prevMonth = 12;
					$prevYear = $currYear - 1;
				}
				
				$maxDays = cal_days_in_month(CAL_GREGORIAN, $prevMonth, $prevYear);
				return $maxDays - $index + 1;
			}
			
			//Log-out handler
			if(empty($_POST))
			{
				session_unset();
				session_destroy();
			}
			elseif(isset($_POST["index"]))
			{
				$index = $_POST["index"];
				
			?>
			<div id="kalendar">
			<?php
			//Drawing calendar
			openConn();
			
			$numOfMonths = 12;
			$currDayIndex = 1;
			$currMonthIndex = 1;
			$currDay = date("d");
			$currMonth = intVal(date("m"));
			$currYear = date("Y");
			$currDate = date("Y-m-d");
			
			$sql = "select start_date, end_date
					from iznajmljivanja
					where o_id=".$index." and end_date>\"".$currDate."\"";
					
			$result = mysqli_query($conn, $sql);
			
			$startDateArr = array();
			$endDateArr = array();
			while($row = $result->fetch_assoc())
			{
				array_push($startDateArr, $row["start_date"]);
				array_push($endDateArr, $row["end_date"]);
			}
			
			// print_r($startDateArr);
			// print_r($endDateArr);
			
			$json1 = json_encode($startDateArr);
			$json2 = json_encode($endDateArr);
			
			while($currMonthIndex <= $numOfMonths)
			{
				$currDayIndex = 1;
				$maxDays = cal_days_in_month(CAL_GREGORIAN, $currMonth, $currYear);

				$tmp1 = gregoriantojd($currMonth, 1, $currYear);
				$monthName = jdmonthname($tmp1, 0);
				$tmp1 = jddayofweek($tmp1, 0);

				if($tmp1==0)
					$previousOffset = 6;
				elseif($tmp1==1)
					$previousOffset = 0;
				else
					$previousOffset = $tmp1 -1;
				
				$tmp1 = gregoriantojd($currMonth, $maxDays, $currYear);
				$tmp1 = jddayofweek($tmp1, 0);

				if($tmp1==1)
					$nextOffset = 6;
				elseif($tmp1==0)
					$nextOffset = 0;
				else
					$nextOffset = 7 -$tmp1;
				
				$numRows = ceil(($previousOffset + $nextOffset + $maxDays) / 7);
			
				//Generisanje tabele i prve vrste
				if($currMonthIndex==1)
					echo "<table class=\"month\" id=\"month".$currMonthIndex."\">";
				else
					echo "<table class=\"month hiddenp\" id=\"month".$currMonthIndex."\">";
				
				echo "<tr><td colspan=\"7\"><img id=\"arrow_left".$currMonthIndex."\" class=\"arrow left btn\" src=\"../images/arrow_left.png\" alt=\"previous month\" onclick=\"leftArrow()\">";
				echo "<span class=\"monthYear\">".$monthName." ".$currYear."</span>";
				echo "<img id=\"arrow_right".$currMonthIndex."\" class=\"arrow right btn\" src=\"../images/arrow_right.png\" alt=\"next month\" onclick=\"rightArrow()\"></td></tr>";
				
				//Generisanje dana
				$k = 1;
				for($i=0; $i<$numRows; $i++)
				{
					echo "<tr>";
					for($j=0; $j<7; $j++)
					{
						if($previousOffset>0)
						{
							echo "<td class=\"otherMonth\">".getDatePrevMonth($previousOffset, $currMonth, $currYear)."</td>";
							$previousOffset--;
						}
						elseif($currDayIndex<=$maxDays)
						{
							if($currDayIndex==$currDay && $currMonthIndex==1)
								echo "<td id=\"".$currYear." ".$currMonth." ".$currDayIndex."\" class=\"free currDay\" onclick=\"reserve(this)\">".$currDayIndex."</td>";
							elseif($currMonthIndex==1 && $currDayIndex<$currDay)
								echo "<td id=\"".$currYear." ".$currMonth." ".$currDayIndex."\" class=\"passed\">".$currDayIndex."</td>";
							else
								echo "<td id=\"".$currYear." ".$currMonth." ".$currDayIndex."\" class=\"free\" onclick=\"reserve(this)\">".$currDayIndex."</td>";
							$currDayIndex++;
						}
						elseif($nextOffset>0)
						{
							echo "<td class=\"otherMonth\">".$k."</td>";
							$nextOffset--;
							$k++;
						}
					}
					echo "</tr>";
				}
				echo "</table>";
				
				if($currMonth<12)
					$currMonth++;
				else
				{
					$currMonth = 1;
					$currYear++;
				}
				
				$currMonthIndex++;
			}
			$conn->close();
			?>
			
			<form method="post" action="rent.php" onsubmit="return validate()">
				<label for="start_date">Start date</label>
				<label for="start_date">End date</label>
				<input type="date" name="start_date" id="start_date" onchange="startDateChanged(this)" min="<?php echo date("Y-m-d");?>" max="<?php echo $currYear."-".($currMonth-1)."-".($currDayIndex-1);?>">
				<input type="date" name="end_date" id="end_date" onchange="endDateChanged(this)" min="<?php echo date("Y-m-d");?>" max="<?php echo $currYear."-".($currMonth-1)."-".($currDayIndex-1);?>" disabled>
				<input type="hidden" name="indexOglasa" value="<?php echo $index; ?>">
				<input type="submit" name="reserve" value="Rezervisi" class="btn" id="reserveBtn">
				<p id="msg" class="hiddenp"></p>
			</form>

			</div>
			<p class="hiddenp" id="hidden1">
				<?php echo $json1; ?>
			</p>
			<p class="hiddenp" id="hidden2">
				<?php echo $json2; ?>
			</p>
			<script> exec(); </script>
			<?php
			}
			elseif(isset($_POST["reserve"]))
			{
				$startDate = $_POST["start_date"];
				$endDate = $_POST["end_date"];
				$index = $_POST["indexOglasa"];
				
				//Mala validacija
				if($startDate>$endDate)
					die("<p class=\"permError\">Unos nije validan");

				openConn();
				$sql = "insert into iznajmljivanja(`o_id`, `u_username`, `start_date`, `end_date`) values(".$index.", \"".$_SESSION["user"]."\", \"".$startDate."\", \"".$endDate."\")";
				
				if(mysqli_query($conn, $sql))
				{
					$conn->close();
					?>
					<p class="succes">Rezervacija je uspješna</p>
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
					die("<p class=\"permError\">Rezervacija nije uspjela");	
					$conn->close();
				}	
			}
			else
				die("<p class=\"permError\">You do not have required permissions to perform this action");	
		}
		else
			die("<p class=\"permError\">You do not have required permissions to perform this action");
		?>
	</div>
</body>
</html>