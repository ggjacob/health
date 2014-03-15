<?php
	include("includes/header.php");
	include("includes/config.php"); 
 

$medid = $_POST['medid'];
$medname = $_POST['medname'];
$frequ = $_POST['frequ'];
$frequinc = $_POST['frequinc'];
$starttime = $_POST['starttime'];
$uselimit = $_POST['uselimit'];
$supply = $_POST['supply'];
$supplywarning = $_POST['supplywarning'];
 
if(isset($_POST['dose']))
	{
		
		$dose = $_POST['dose'];
		if ($dose == "")
		{$dose = "NULL";}
	}
else
	{
		$dose = "NULL";
	} 


//super wierd logic, using Disable and active interchangably...  from previous form the option is Disable: TRUE or null  True means active = 0
$disable = "false";
if(isset($_POST['disable']))
	{$disable = $_POST['disable'];}
else
	{$disable = "false";}
$active = 1;
if ($disable == "true")
	{$active = 0;}

elseif ($disable == "false")
	{$active = 1;}
else {$active = 1;}

if ($supplywarning == "")
	{$supplywarning = "NULL";} 
	

if ($supply == "")
	{$supply = "NULL";} 

	 
//do update - this will be a problem if setting to a different medid w/ same name

		$query = "UPDATE  `medicinetypes` 
				  SET  MedicineName = '$medname',
				  Frequency =  '$frequ',
				  FrequencyIncrement = '$frequinc',
				  ScheduledStart = '$starttime',
				  Active = $active,
				  UseLimit = $uselimit,
				  SupplyCount = $supply,
				  SupplyWarning = $supplywarning,
				  Dose = $dose
				  WHERE  `medicinetypes`.`MedicineTypeID` = '$medid';";
 
				  mysql_connect($servername,$username,$password);
				  mysql_select_db($database) or die( "Unable to select database"); 
			      mysql_query($query) or die (mysql_error());
			 
			
			
		//this update will recalc the NextUse date incase the frequency changed
		$query="UPDATE medicinetypes
		SET NextUse=DATE_ADD(LastUsed,INTERVAL $frequ $frequinc)
		WHERE MedicineTypeID = $medid;";
	 

	
		mysql_query($query) or die (mysql_error());
		mysql_close();
		echo 'Success!';
		header("Refresh: 1.5; URL=medlog.php"); 
 
include("includes/footer.php");
?>
