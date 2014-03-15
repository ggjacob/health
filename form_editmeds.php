<?php
include("includes/header.php");
include("../health_config.php");


$medid = $_POST['medid'];

mysql_connect("$servername", "$username", "$password") or die("cannot connect");
mysql_select_db("$database") or die("cannot select DB");

$sql = "SELECT * FROM medicinetypes where medicinetypeid = $medid";
$result = mysql_query($sql) or die(mysql_error());

$num = mysql_numrows($result);




if ($result === false) {
    echo "An error occurred.";
}
mysql_close();
?>

<?php
//set variables
$i = 0;
while ($i < $num) {
//$medid=mysql_result($result,$i,"medicinetypeid");
    $medname = mysql_result($result, $i, "medicinename");
    $frequ = mysql_result($result, $i, "frequency");
    $frequinc = mysql_result($result, $i, "frequencyincrement");
    $starttime = mysql_result($result, $i, "scheduledstart");
    $active = mysql_result($result, $i, "active");
    $uselimit = mysql_result($result, $i, "uselimit");
//$meta1desc=mysql_result($result,$i,"meta1desc");
//$meta1name=mysql_result($result,$i,"meta1name");
    $dose = mysql_result($result, $i, "dose");
    $supply = mysql_result($result, $i, "supplycount");
    $supplywarning = mysql_result($result, $i, "supplywarning");
    ++$i;
}
?> 

<p>
    <b>
        Edit Medicine: <br><font color="red" size=6><?php echo $medname; ?></font>
    </b>
<p>



<form action="process_editmeds.php" method="post">
    MedicineName: <input type="text" name="medname" value ="<?php echo $medname; ?>" maxlength="50"><br>
    Frequency: <input type="text" name="frequ" value ="<?php echo $frequ; ?>" size="8" maxlength="11"><br>
    Frequency Increment: 
    <select name ="frequinc">
        <option value ="DAY" <?php if ($frequinc == "DAY") {
    echo "selected";
}; ?>>DAY</option>
        <option value ="HOUR" <?php if ($frequinc == "HOUR") {
    echo "selected";
}; ?>>HOUR</option>
    </select>
    <br>
    Daily Use Limit: <input type="text" name="uselimit" value ="<?php echo $uselimit; ?>" size="8" maxlength="11"><br>
    Scheduled Start: <input type="time" name="starttime" value="<?php echo $starttime; ?>" maxlength ="6" size="8"><br> 

    Current Dose: <input type="text" name="dose" value="<?php echo $dose; ?>" maxlength ="6" size="8"><br> 
    Supply Count: <input type="text" name="supply" value="<?php echo $supply; ?>" maxlength ="6" size="8"><br> 
    Supply Warning: <input type="text" name="supplywarning" value="<?php echo $supplywarning; ?>" maxlength ="6" size="8"><br> 
    Disable: <input type="checkbox" name="disable" value="true"><br>  <!-- only option user has is to disable, no option to enable - read note on process page -->
    <input type ="hidden" name="medid" value="<?php echo $medid; ?>">
    <p>
<?php echo "Take <font color=red>" . $medname . "</font> every " . $frequ . " " . $frequinc . "(s)"; ?>
        <br>
        <input type="Submit" value ="Update">
</form>
<a href=medlog.php>Back</a>
<?php
include("includes/footer.php");
?>
