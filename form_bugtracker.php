<?php
include("/includes/header.php");
include("/includes/config.php");

//used for Sourcepage info
$url=$_SERVER['HTTP_REFERER'];
 

?>

<form action="process_bugtracker.php" method="post">
<h3><b>Report Type</b></h3> <br>
<b>Bug: <input type="radio" name="type" value="bug"> &nbsp&nbsp&nbsp&nbsp&nbsp
Enhancement Request: <input type="radio" name="type" value="enhancement"> <br>
<b/>
Description:     <input type="text" name="bugdesc" size="100" maxlength="4000"><br>
Your Name: 		 <input type="text" name="username">
                 <input type="hidden" name="pagename" value="<?php echo $url; ?>"><br>
<input type="Submit">
</form>
<p>
<a href="view_bugtracker.php">View Bug/Enhancement List</a>
<?php

include ("/includes/footer.php");
?>