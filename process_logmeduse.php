<?php
	include("includes/header.php");
	include("../health_config.php"); 
 
 
if (strlen($_POST['time']) < 5)
	{
		
		echo $_POST['time'];
		echo "<p>";
		echo "Bad Date Format, try again...";
		header("Refresh: 2; URL=medlog.php");
	
	}
else
	{
	//	$date = date("Y-m-d H:i:s", strtotime($_POST['date']));
		$date = date("Y-m-d");
		$time = $_POST['time'];
		$dateTime = $date.' '.$time;
	//echo $dateTime;
		  

	if(isset($_POST['medid']))
		{
		
			$medid = $_POST['medid'];		 
			$logtype = $_POST['logtype'];	
			$dose = $_POST['dose'];
			$query = "call update_medlog ($medid, '$dateTime', '$logtype', '$dose')" ;
						
			mysql_connect($servername,$username,$password);
			mysql_select_db($database) or die( "Unable to select database"); 
			mysql_query($query) or die (mysql_error());
			mysql_close();
				 
			echo "Saving Info, please wait...";
			header("Refresh: 1.5; URL=medlog.php"); 
		}
	}
	

?>

 
<?php include("includes/footer.php"); ?>
