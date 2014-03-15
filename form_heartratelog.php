<?php
	include("/includes/config.php"); 
	include("/includes/header.php"); 
	
?>
  
<h1>Heart Rate Logger</h1>
<font size=5>
<form action="process_heartratelog.php" method="post">

Log Time: <input type="text" name="logtime" value="<?php echo $getdate;?>"><br>
BPM: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" name="BPM" size=5><br>
<textarea name="notes" id="comments";">
</textarea>
<input type="Submit">
</form>
<br>
<a href=view_heartratelog.php>View Heartrate History</a>
</font>
<?php include("/includes/footer.php"); ?>