
<?php
//this page should insert into alertrecordslog
//have sendMail function return error to caller for logging


//refresh page
//header("Refresh: 5; URL=test3.php"); 	

//build temp table for alerts to send as 1 message if possible

//create getalert.php page to get alerts to send based on config
//create sendalert.php secret page that 'includes' the getalerts.php and sends alerts based on config

//$myQuery ="select medicinetypeid, medicinename, lastused, nextuse from medicinetypes 
//where date_add(lastused,interval .1 DAY) < now()";

$myQuery = "call get_alerts";
/*
returns
id
alertname
sendtoaddress
MedicineName
*/

$values = executeSQL($myQuery, 'return'); 

$num = $values['num'];
$result = $values['result'];

//if items for alerting, send alert for each
if ($num > 0)
	{
		$i=0;
		while ($i < $num) 
		{
			$alertname=mysql_result($result,$i,"alertname");			
			$sendtoaddress=mysql_result($result,$i,"sendtoaddress");			
			$medicinename=mysql_result($result,$i,"MedicineName");
			$sendlink=mysql_result($result,$i,"sendlink");
			$alertconfigid=mysql_result($result,$i,"alertconfigid");
		
			if ($sendlink == "1")
				{
					$link = "http://www.trevorlaib.com/health/medlog.php";
					$body = $medicinename.' Log it: '.$link;
				}	
			else
				{
					$body = $medicinename;				
				}

			//echo $body;

			$alertData = array('alertname' => $alertname, 'sendto' => $sendtoaddress, 'body' => $body);

			//call email function
			$emailResult = sendMail($alertData);
			
			//get email results (1=GOOD; 0=FAIL)
			$resultCode = $emailResult['resultCode'];
			$resultMsg  = $emailResult['resultMsg'];
			
			//if email succeeded then log alert into alertrecordslog
			if ($resultCode === 1)
			{
				$myQuery = "insert into alertrecordslog (id, trantime, alertconfigid, emailresult) values (null, now(), $alertconfigid, 'SUCCESS')";
				executeSQL($myQuery, 'none');
				$resultCode = 0;
			}
			else 
			{
				//if email failed then log as failure
				$logResult = "Result Code = ".$resultCode."; Result Message = ".$resultMsg."; AlertConfigID = ".$alertconfigid;				
				$myQuery = "insert into alertrecordslog (id, trantime, alertconfigid, emailresult) values (null, now(), $alertconfigid, '$logResult')";  
				$sqlResult = executeSQL($myQuery, 'none');
				
				echo $logResult;
			}
			++$i;
		}	
		
	}
else
	{
		echo "No Alerts";
		//header("Refresh: 5; URL=test3.php"); 	
	}


function sendMail($alertData) {
	require_once "Mail.php";
	require "../mailconfig.php";

	$subject = $alertData['alertname'];
	$to = $alertData['sendto'];
	$message = $alertData['body']; 
	$headers = array ('From' => $from, 'To' => $to, 'Subject' => $subject); 
	$smtp = Mail::factory('smtp', array ('host' => $host, 'port' => $port, 'auth' => $auth,

//true, 
'username' => $username, 
'password' => $password)); 
$mail = $smtp->send($to, $headers, $message); 

if (PEAR::isError($mail)) 
{ $resultCode = 0; $resultMsg = $mail->getmessage(); $emailResult = array('resultCode'=>$resultCode, 'resultMsg' => $resultMsg); return $emailResult; } 
else 
		{
			$resultCode = 1;
			$resultMsg = 'Message successfully sent!<br>Message sent to: '.$to.', Body: '.$message;
			$emailResult = array('resultCode'=>$resultCode, 'resultMsg' => $resultMsg);
			return $emailResult;
	       	}
}


function executeSQL($myQuery, $mode)
	{ 
 
		//get connection info for HealthTracker
		include("../health_config.php");
		
		//make connection
		mysql_connect($servername,$username,$password);
		mysql_select_db($database) or die( "Unable to select database"); 

		$result=mysql_query($myQuery);
		$num=mysql_numrows($result); 
		if ($result === false) 
			{ 
				//echo "An error occurred."; 
				$sqlResult = "Error with SQL command";
				return $sqlResult; 
			}
		mysql_close();
   
		if ($mode == "return")
			{
				$values = array('num' => $num, 'result' => $result);
				return $values;
			}
	}
?>
