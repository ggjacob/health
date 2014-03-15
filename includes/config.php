<?php
//DB CONNECTION
$username="healthadmin";
$password="Rd9ecYGhftxdbS9J";
$database="healthtrack";
$servername="localhost";


//SET Timezone and set Getdate variable
date_default_timezone_set('America/Los_Angeles');
//$getdate = date('Y-m-d h:i:s');
$getdate = date('Y-m-d H:i:s');


//GET BROWSER INFO- used for logging, can be used to set appropriate style sheet
//$styleSheet = "iphone.css";
$agent = $_SERVER['HTTP_USER_AGENT']; // Put browser name into local variable


if (preg_match("/iPhone/", $agent)) {$devicetype = "iPhone";} // Apple iPhone Device
elseif (preg_match("/Chrome/", $agent)) {$devicetype = "Chrome";} // Chrome
elseif (preg_match("/MSIE/", $agent))   {$devicetype = "IE";}     // IE
    // // Set style sheet variable value to target your iPhone style sheet
    // $styleSheet = "iphone.css";
//if browser not iphone, chrome, or IE, then Unknown
else {$devicetype = "Unknown";}

	
	//GET USER IP Address for logging
	if (getenv('HTTP_X_FORWARDED_FOR')) 
		{
			$pipaddress = getenv('HTTP_X_FORWARDED_FOR');
			$ipaddress = getenv('REMOTE_ADDR');
		} 
	else 
		{
			$ipaddress = getenv('REMOTE_ADDR');
        }

//LOG Connection
mysql_connect($servername,$username,$password);
mysql_select_db($database) or die( "Unable to select database"); 

	$query = "INSERT INTO `accesslog` (`UID`, `AccessTime`, `SourceIP`,`DevType` )
			    VALUES (NULL, CURRENT_TIMESTAMP, '$ipaddress', '$devicetype');";

mysql_query($query) or die ("Process failed, please try again.");
 
mysql_close();
?>
