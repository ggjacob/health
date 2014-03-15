<?php
//refresh page
//header("Refresh: 5; URL=test3.php"); 	

//build temp table for alerts to send as 1 message if possible

//create getalert.php page to get alerts to send based on config
//create sendalert.php secret page that 'includes' the getalerts.php and sends alerts based on config

$myQuery ="select medicinetypeid, medicinename, lastused, nextuse from medicinetypes 
where date_add(lastused,interval .1 DAY) < now()";

$values = executeSQL($myQuery, 'return'); 

$num = $values['num'];
$result = $values['result'];

//if items for alerting, send alert for each
if ($num > 0)
	{
		while ($i < $num) 
		{
			$medicinetypeid=mysql_result($result,$i,"medicinetypeid");			
			$medicinename=mysql_result($result,$i,"medicinename");
			$lastused=mysql_result($result,$i,"lastused");
			$nextuse=mysql_result($result,$i,"nextuse");
			++$i;
		
			$lastused = date('m-d-Y H:i:s', strtotime($lastused));
			$nextuse =  date('m-d-Y H:i:s', strtotime($nextuse));
			
			$link = "http://192.168.2.112/health/medlog.php";	
			$body = $medicinename.' --  LastUsed: '. $lastused.' --  NextUse: '.$nextuse.' Log it: '.$link;
		
			//call email function
			sendMail($body);
			
			//execute SQL to update lastused time
			$myQuery = "update medicinetypes set lastused = NOW() where medicinetypeid = $medicinetypeid";

			executeSQL($myQuery);
		}	
		
	}
else
	{
		echo "No Alerts";
		//header("Refresh: 5; URL=test3.php"); 	
	}


function sendMail($body) {
	require_once "Mail.php";
	require "mailconfig.php";
	$subject = "Take Medicine Now";
//	$from = "healthtrackalerts@gmail.com";
//	$to = "7023306001@tmomail.net";
	$to = "7027380688@mms.att.net";
//	$to = "trevlaib@gmail.com";
	$message = $body;
//	$host = "ssl://smtp.gmail.com";
//	$port = "465";
//	$username = "healthtrackalerts@gmail.com";
//	$password = "M3D1c!ne";
	$headers = array ('From' => $from,
		'To' => $to,
		'Subject' => $subject);
	$smtp = Mail::factory('smtp',
		array ('host' => $host,
                       'port' => $port,
                       'auth' => true,
                       'username' => $username,
                       'password' => $password));
        $mail = $smtp->send($to, $headers, $message);

	if (PEAR::isError($mail)) 
		{
			echo('<p>' . $mail->getMessage() . '</p>');
		} 
	else 
		{
			echo('<p>Message successfully sent!</p><br>Message sent to: '.$to.', Body: '.$message.'');
		}
}


function executeSQL($myQuery, $mode)
	{ 
 
		//get connection info for HealthTracker
		include("includes/config.php");
		
		//make connection
		mysql_connect($servername,$username,$password);
		mysql_select_db($database) or die( "Unable to select database"); 

		$result=mysql_query($myQuery);
		$num=mysql_numrows($result); 
		if ($result === false) { echo "An error occurred."; }
		mysql_close();
   
		if ($mode == "return")
			{
				$values = array('num' => $num, 'result' => $result);
				return $values;
			}
	}
?>
