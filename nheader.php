<?php

session_start(); 
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Bible Verse Reminder</title>
     	<meta id="viewport" name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
	<link rel="stylesheet" href="includes/iphone.css" />
	<link href="css/pepper-grinder/jquery-ui-1.10.4.custom.css" rel="stylesheet">
	 
	<script src="js/jquery-1.10.2.js"></script>
	<script src="js/jquery-ui-1.10.4.custom.js"></script>

	 
  <script>
  $(function() {
    $( "#accordion" ).accordion({
      collapsible: true,
     heightStyle: "content",
     active: 9
//,animate: "easeInOutBack"
    });
  });
  </script>
  	 
  <script>
  $(function() {
    $( "#accordion2" ).accordion({
      collapsible: true,
     heightStyle: "content",
     active: 0
//,animate: "easeInOutBack"
    });
  });
  </script>


</head>
<body>
