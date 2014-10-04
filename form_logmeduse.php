<?php

include("includes/header.php");
include("../health_config.php"); 

$medid = $_POST['medid'];	
$medname = $_POST['medname'];	
$lastused = $_POST['lastused'];
$dose = $_POST['dose'];

?> 
<?php
if($lastused == "0000-00-00 00:00:00" || $lastused == null) {$lastused = "Never Used";} 
?>
<b>Log Medicine Usage for:<br><font color='red' size = 6><?php echo $medname; ?></font></b>
<p>Current Dose: <?php echo $dose; ?><p>
<b>Last Use: </b><br><font color='red'><?php echo $lastused; ?></font>
<form method="post" action="process_logmeduse.php">
<input type="hidden" name="medid" value="<?php echo $medid; ?>">
<input type="hidden" name="dose" value="<?php echo $dose; ?>">

Use Time: <input type="time" name="time" value="<?php echo date('H:i'); ?>"><br> 
Log Type: <select name ="logtype">
<option value ="1" selected>USED</option>
<option value ="2" >SKIPPED</option>
</select><br>
<button type="submit" formmethod="post" formaction="process_logmeduse.php">Log Med Usage</button><br>
</form>
Press button to log time as NOW or manually enter DATE and TIME
<hr>
<form method="post">
<input type="hidden" name="medid" value="<?php echo $medid; ?>">
<input type="hidden" name="dose" value="<?php echo $dose; ?>">

Start Date: <input type="date" name="sdate"><br> 
End Date: <input type="date" name="edate"><br> 
  
<button type="submit" formmethod="post" formaction="form_logmedusebyrange.php">Log Med Usage By Range</button><br>
</form>
<BR>
<font color ="red">added default value for Dose, incase it has changed<br>added default value for time<br>supply count is reduced...</font>
<hr>





<form>
<input type ="hidden" name="medid" value="<?php echo $medid;?>">
<button type="submit" formmethod="post" formaction="form_editmeds.php">Edit <?php echo $medname;?></button>
</form>
<br>
<form>
<input type="hidden" name="medid" value="<?php echo $medid; ?>">
<button type="submit" formmethod="post" formaction="view_medlog.php">View Usage History</button>
</form>
<p>
<hr>
<a href="medlog.php">View Meds</a><br>


<p> 
<?php
include ("includes/footer.php");
?>
