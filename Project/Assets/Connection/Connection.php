<?php
$server="localhost";
$User="root";
$password="";
$db="db_studentsmart";
$con=mysqli_connect($server,$User,$password,$db);
if(!$con)
	{
		echo "connection failed";
	}
?>    