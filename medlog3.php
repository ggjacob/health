<h3>Dashboard</h3>
<div>
<p>

<?php
//include("includes/header.php");
include("../health_config.php"); 
//echo $servername.','.$username.','.$password;
 
mysql_connect($servername,$username,$password);
mysql_select_db($database) or die( "Unable to select database"); 
$query = "call get_medusage" ;
 
$result=mysql_query($query);
$num=mysql_numrows($result); 
if ($result === false) { echo "An error occurred."; }
mysql_close();

//VALID Views are TODAY or ACTIVE
	//TODAY = all meds needed to be taken < tomorrow
	//ACTIVE = show all meds that are not disabled
if(isset($_POST['view']))
{$view = $_POST['view'];}
else
{$view = "ACTIVE";}
	

?>


 
<table>
<tr> 
<th>Medicine<br><font size = 1>click to edit med <u>or</u> log use</font></th>
<th>Last Used</th>
<th>Next Use</th> 
<th>Used / Limit</th>
<th>Start Time</th> 
<th>Supply Left</th> 
</tr>
<tr>  
<?php 
$i=0;
while ($i < $num) {
$medid=mysql_result($result,$i,"medicinetypeid");
$medname=mysql_result($result,$i,"medicinename");
$lastused=mysql_result($result,$i,"lastused");
$nextuse=mysql_result($result,$i,"nextuse");
$scheduledstart=mysql_result($result,$i,"scheduledstart");
$count=mysql_result($result,$i,"usecount");
$uselimit=mysql_result($result,$i,"uselimit");
$supplycount=mysql_result($result,$i,"supplycount");
$supplywarning=mysql_result($result,$i,"supplywarning");
$dose=mysql_result($result,$i,"dose");
// $usecount=mysql_result($result,$i,"usecount");
// $freq=mysql_result($result,$i,"frequency");
// $freqinc=mysql_result($result,$i,"frequencyincrement");
?>

<?php 

if ( date('m-d', strtotime($nextuse)) > date('m-d', strtotime($getdate)) and $view == "TODAY")
{++$i;}
else
{
?>
<!-- COLUMN - MedName -->
<td>
	<form>
		<input type="hidden" name="medid" value="<?php echo $medid; ?>">
		<input type="hidden" name="medname" value="<?php echo $medname; ?>">
		<input type="hidden" name="lastused" value="<?php echo $lastused; ?>">
		<input type="hidden" name="supplycount" value="<?php echo $supplycount; ?>">
		<input type="hidden" name="dose" value="<?php echo $dose; ?>">
		<button type="submit" formmethod="post" formaction="form_logmeduse.php"><?php echo $medname;?></button>
	</form>
</td>

<?php 

//COLUMN - LastUsed
echo "<td>";
if ($lastused == "0000-00-00 00:00:00" || $lastused == null) {echo "--:--";} else {echo date('m-d H:i', strtotime($lastused));}
echo "</td>";

//COLUMN - NextUse - !currently won't hand a med thats expired with a scheduled start time
	//if Med has Scheduled Start then display that as NextUse
// if ($scheduledstart !== "00:00:00" and date('Y-m-d H:i',strtotime($scheduledstart)) > $nextuse) //<<< NOT SURE ON THIS CODE
	// {
		// echo "<td>";
		// echo date('m-d H:i', strtotime($scheduledstart)); 
		// echo "</td>";
	// }
		//if nextuse time is in the past, then make cell RED
		 if (($nextuse < $getdate) and ($nextuse !== "0000-00-00 00:00:00"))
			{ 
				echo '<td class="expired">';
				if ($nextuse == "0000-00-00 00:00:00" || $nextuse == null) {echo "--:--";} else {echo date('m-d H:i', strtotime($nextuse));}
				echo "</td>";
			}
				//If nextuse is same calendar day then highlight text yellow
				elseif (date('Y-m-d',strtotime($nextuse))==date('Y-m-d',strtotime($getdate)))	
					{
						echo "<td>";
						if ($nextuse == "0000-00-00 00:00:00") {echo "--:--";} else {echo "<b><font color = green>".date('m-d H:i', strtotime($nextuse))."</font></b>";} 
						echo "</td>";
					}
				
				
					//If nextuse is not until next calendar day then highlight text blue
					elseif (date('Y-m-d',strtotime($nextuse))>date('Y-m-d',strtotime($getdate)))	
						{
							echo "<td>";
							if ($nextuse == "0000-00-00 00:00:00") {echo "--:--";} else {echo "<b><font color = blue>".date('m-d H:i', strtotime($nextuse))."</font></b>";} 
							echo "</td>";
						}
							//if it meets none of above, just display NextUse time in plain text
							else
								{
									echo "<td>";
									if ($nextuse == "0000-00-00 00:00:00") {echo "--:--";} else {echo date('m-d H:i', strtotime($nextuse));} 
									echo "</td>";	
								}
//COLUMN - TodaysUseCount
// echo "<td>";
// echo $count.'/'.$uselimit;
// echo "</td>";
echo "<td>";
if ($uselimit > 0){echo $count.' / '.$uselimit;} else {echo $count;}
echo "</td>";




//COLUMN - ScheduledStart Time - should this be removed??
echo "<td>";
if ($scheduledstart == "00:00:00") {echo "--:--";} else {echo date('H:i', strtotime($scheduledstart));}
echo "</td>";



//COLUMN - Supply Left
if ($supplycount == null) 
{echo "<td>--</td>";} 
	elseif ($supplycount <= $supplywarning) 
	{echo '<td class="expired">'.$supplycount.'</td>';}
		else
		{echo "<td>".$supplycount."</td>";}
	

echo "</tr>";

++$i;
} }
?> 

</table>
<br>
<font color=blue>tomorrow</font>
<br>
<font color=green>today</font>
<hr>
<form action="medlog.php" method="post">
View:
<select name ="view">
<option value ="TODAY" <?php if($view == "TODAY"){echo "selected";}?>>Today</option>
<option value ="ACTIVE" <?php if($view == "ACTIVE"){echo "selected";}?>>All Active</option>
</select>
<input type="Submit" value ="Refresh">
</form> 
 
<p>
 

</p>
</div>
