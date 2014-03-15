

<?php
include("/includes/header.php");
include("/includes/config.php");
mysql_connect($servername,$username,$password);
mysql_select_db($database) or die( "Unable to select database"); 

$bpm = $_POST["BPM"];
// $caffine = $_POST["caffine"];
// $stress = $_POST["stress"];
// $rest = $_POST["rest"]; 
// $position = $_POST["position"]; 
//$ipaddress = $_POST["sourceip"]; 
$notes = addslashes($_POST["notes"]);
$logtime = $_POST["logtime"];
// $logtime2 = date('m-d H:i', strtotime($logtime));
// echo $logtime2;

/* logical OR returns true if any condition is true */
// returns true
//$result = (($bpm == "") || ($last == ""));
$result = ($bpm == "");
if ($result == TRUE)
	{
		echo "missing data, try again...";
		header("Refresh: 2; URL=form_heartratelog.php"); 
	}
else
	{
		$query = "INSERT INTO `healthtrack`.`heartratelog` (`UID`, `LogTime`, `BPM`, Notes)
			    VALUES (NULL, '$logtime', '$bpm', '$notes');";
	}

mysql_query($query) or die ("Process failed, please try again.");
 
mysql_close();


echo "<b>Saving Info, please wait...<b>";
header("Refresh: 1; URL=form_heartratelog.php"); 
include("/includes/footer.php");
?>  