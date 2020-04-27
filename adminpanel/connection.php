<?php
	$host = "localhost";
	$database = "data";
	$username = "root";
	$pass = "";
	
	$conn = new mysqli($host,$username,$pass,$database);
	mysqli_set_charset($conn,"utf8");
?>