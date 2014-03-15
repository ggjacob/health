<?php
//if($lastused == "0000-00-00 00:00:00" || $lastused == null) {$lastused = "Never Used";} 

include("includes/header.php");
$startDate = $_POST['sdate'];	
$endDate =   $_POST['edate'];	
$medid = $_POST['medid'];	
$dose = $_POST['dose'];	

$startDate = $startDate;
$datetime1 = new DateTime($startDate);
$datetime2 = new DateTime($endDate);

//if dates are the same then it should be 1 day
if ($datetime1 == $datetime2)
	{
		$numdays = 1;
	}
else
	{
		//if dates are not the same then calculate the number of days
		$interval = $datetime1->diff($datetime2);
		$numdays = $interval->format('%a%');
	}
$intcount = 0;
$dateShown = date('m-d-Y',strtotime($startDate));
// echo 'date'.$intcount;
// echo '<p>';
// echo $startDate;
while ($intcount < $numdays)

	{
		echo '<b>';
		echo '<form method="post" action="process_logmedusebyrange.php">';
		echo '<input type="hidden" name="medid" value='.$medid.'>';
		echo '<input type="hidden" name="numdays" value='.$numdays.'>';
		echo '<input type="hidden" name="date'.$intcount.'" value='.$startDate.'>';
		echo $dateShown.': <input type="time" name="time'.$intcount.'" value = "07:00"><br>';
		echo 'Dose taken: <input type="text" size="5" name="dose" value='.$dose.'><br>';
		echo 'Log Type: <select name ="logtype">';
		echo '<option value ="1" selected>USED</option>';
		echo '<option value ="2" >SKIPPED</option></select><p>';
		echo '</b>';
		$startDate = date('Y-m-d', strtotime($startDate. ' + 1 days'));
		//echo $startDate;
		++$intcount;
	}
echo '<br><button type="submit" formmethod="post" formaction="process_logmedusebyrange.php">Log Med Usage</button><br></form>';

include("includes/footer.php");
?>
