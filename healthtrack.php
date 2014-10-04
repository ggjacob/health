<?php
include("includes/header.php");
include("../health_config.php");

mysql_connect($servername,$username,$password);
mysql_select_db($database) or die( "Unable to select database"); 

	$query = "INSERT INTO `accesslog` (`UID`, `AccessTime`, `SourceIP`)
			    VALUES (NULL, CURRENT_TIMESTAMP, '$ipaddress');";

mysql_query($query) or die ("Process failed, please try again.");
 
mysql_close();
?>
 <font size=6>
<a href=medlog.php><img src="images/medtrack.png"></a>
<p>
<a href=form_heartratelog.php><img src="images/hearttrack.png"></a>

</font> 
<?php
include("includes/footer.php");
?>