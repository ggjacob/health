<?php
include("includes/header.php");
include("../health_config.php");

//used by form_editmeds.php and form_insertmeds.php
$medname = $_POST['medname'];
$frequ = $_POST['frequ'];
$frequinc = $_POST['frequinc'];
$starttime = $_POST['starttime'];
$uselimit = $_POST['uselimit'];
$supplycount = $_POST['supply'];
$supplywarning = $_POST['supplywarning'];
  

if ($medname == NULL or !is_numeric($frequ) )
	{
		echo "Bad data, try again.";
		header("Refresh: 2.5; URL=form_insertmeds.php"); 
	}
else
	{
		$query = "select medicinename from medicinetypes where medicinename = '$medname'";

		mysql_connect($servername,$username,$password);
		mysql_select_db($database) or die( "Unable to select database"); 
		mysql_query($query) or die (mysql_error());
		$result=mysql_query($query);
		mysql_close();

		if (mysql_num_rows($result))

			{
				echo 'Medicine Name: '.$medname.' already exists!';
				header("Refresh: 2.5; URL=form_insertmeds.php"); 
			}
		else
			{ 


				// INSERT NEW DATA
				$query = "insert into medicinetypes (medicinename, frequency, frequencyincrement, scheduledstart, uselimit, supplycount,supplywarning)
				values ('$medname', $frequ, '$frequinc', '$starttime', '$uselimit', '$supplycount', '$supplywarning')";

				mysql_connect($servername,$username,$password);
				mysql_select_db($database) or die( "Unable to select database"); 
				mysql_query($query) or die (mysql_error());
				mysql_close();
				
				
				echo 'Successfully added new medicine!';
				header("Refresh: 1.5; URL=medlog.php"); 
			}
	}

include("includes/footer.php");
?>
