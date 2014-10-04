<?php
include("includes/header.php");
include("../health_config.php");


 
mysql_connect($servername,$username,$password);
@mysql_select_db($database) or die( "Unable to select database"); 

$type = mysql_real_escape_string($_POST["type"]);
$sourcepage = $_POST["pagename"];
$bugdesc = mysql_real_escape_string($_POST["bugdesc"]);
$username = mysql_real_escape_string($_POST["username"]); //pass in username from UserCake once implemented

$query = "INSERT INTO bugtracker (TranTime, ReportType, SourcePage, BugDescription, ReportedBy, Status, LastUpdated) VALUES (CURRENT_TIMESTAMP, '$type', '$sourcepage','$bugdesc', '$username', 'NEW', CURRENT_TIMESTAMP)";

mysql_query($query) or die ("Process failed, please try again.");
 
mysql_close();
echo "Processing Bug Report, please wait...";
header("Refresh: 2; URL=$sourcepage"); 


include ("includes/footer.php");
?>
