<?php
	include("includes/header.php");
	
 
//if(isset($_post['medid']))
	
		$numdays = $_POST['numdays'];
		$medid = $_POST['medid'];		 
		$logtype = $_POST['logtype'];	
		$dose = $_POST['dose'];
	
 $i = 0;
 //echo $numdays;
 while ($i < $numdays)
	{
		${'date'.$i} = $_POST['date'.$i];
		${'time'.$i} = $_POST['time'.$i];
		
		${'dateTime'.$i} = ${'date'.$i}.' '.${'time'.$i};
		echo ${'dateTime'.$i};
		echo "<br>";
		
		update_medlog($medid, ${'dateTime'.$i}, $logtype, $dose);
		++$i;
	}
	
	echo "saving info, please wait...";
	header("refresh: 1.5; url=medlog.php"); 
 
 function update_medlog($medid, $dateTime, $logtype, $dose)
	{
		include("../health_config.php"); 
		$datetime = date("Y-m-d h:i:s", strtotime($dateTime)); 
		$query = "call update_medlog ($medid, '$datetime', '$logtype', '$dose')";
		//echo $query;			
		mysql_connect($servername,$username,$password);
		mysql_select_db($database) or die( "unable to select database"); 
		mysql_query($query) or die (mysql_error());
		mysql_close();
			 
		// echo "saving info, please wait...";
		// header("refresh: .5; url=medlog.php"); 
	}
 
// 	$datetime = date("y-m-d h:i:s", strtotime($datetime);
	
		  

//	if(isset($_post['medid']))
 
?>

 
<?php include("includes/footer.php"); ?>
