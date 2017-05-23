<?php
	
$user = "root";
$pass = "";
$dbname = "agencija_nekretnine";
	
$conn = new mysqli("localhost", $user, $pass, $dbname);

//$sql = "insert into user(id, ime, sifra) values(1, 'name1', 'pass1')";

/*if($conn->query($sql) == TRUE )
{
	echo "New record created successfully";
} 
else
{
    echo "Error: " . $sql . "<br>" . $conn->error;
}*/



?>