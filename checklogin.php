<?php
include("/includes/header.php");


if(isset($_POST['username']))
	{	
		$user = $_POST['username'];
	}
else
	{
		echo "Login Failed...";
		header("Refresh: 1; URL=index.php"); 
	}		

if(isset($_POST['password']))
	{
		$pass = $_POST['password'];
	}
else
	{
		echo "Login Failed...";
		header("Refresh: 1; URL=index.php"); 
	}
		
	
//valid login
$gooduser = "tlaib";
$goodpass = "test";

if ($user == $gooduser and $pass == $goodpass)
	{
		echo "Login Successful...";
		header("Refresh: 1; URL=healthtrack.php"); 
			
	}
else
	{
		echo "Login Failed...";
		header("Refresh: 1; URL=index.php"); 
	}
	

include("/includes/footer.php");


?>
 
