<?php
	$host = "localhost"; 
	$user = "root"; 
	$bdd = "abciss"; 
	$pass = "simplon62200"; 
	//mysql_connect($host,$user,$pass) or die("Impossible de se connecter");
	$link=mysqli_connect($host,$user,$pass) or die("Impossible de se connecter");
	mysqli_select_db($link,$bdd);
?>