<h3>Insert Meds</h3>
<div>
<?php
//include("includes/header.php");
?>
<b>
<form action="process_insertmeds.php" method="post">
MedicineName: <input type="text" name="medname" maxlength="50"><br>
Frequency: <input type="number" name="frequ" size="11" maxlength="11"><br>

Frequency Increment: 
<select name ="frequinc">
<option value ="DAY">DAY</option>
<option value ="DAY">HOUR</option>
</select>
<br>
Daily Use Limit: <input type="number" name="uselimit" size="11" maxlength="11"><br>
Scheduled Start: <input type="time" name="starttime" value="00:00" size="6" maxlength="6"><br> 
Supply Count: <input type="number" name="supply" maxlength ="6" size="8"><br> 
Supply Warning: <input type="number" name="supplywarning" maxlength ="6" size="8"><br> 
<input type="Submit" name ="Add New Medicine">
</form></b>

<hr>
<b>
Example: Taking Tylenol every 4 hours with no specific start time,<br> time will just be incremented from first logged time:
</b>
<P>
MedicineName = Tylenol<br>
Frequency = 4<br>
Frequency Increment = HOUR<BR>
Scheduled Start = 0
<P>
<b>
Example: Taking Synthroid once every (1) day, with a start time at 6:30 am.
</b>
<P>
MedicineName = Synthroid<br>
Frequency = 1<br>
Frequency Increment = DAY<BR>
Scheduled Start = 6:30
<p>
<?php
//include("includes/footer.php");
?>
</div>
