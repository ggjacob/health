<?php
include("includes/header.php");
include("../health_config.php"); 
 
echo "<a href=medlog.php>Back to Medicine List</a>";
$global_dbh = mysql_connect($servername, $username, $password)
or die("Could not connect to database");
mysql_select_db($database, $global_dbh)
or die("Could not select database");
function display_db_query($query_string, $connection, $header_bool, $table_params) {
	// perform the database query
	$result_id = mysql_query($query_string, $connection)
	or die("display_db_query:" . mysql_error());
	// find out the number of columns in result
	$column_count = mysql_num_fields($result_id)
	or die("display_db_query:" . mysql_error());
	// Here the table attributes from the $table_params variable are added
	print("<TABLE $table_params >\n");
	// optionally print a bold header at top of table
	if($header_bool) {
		 print("<TR>");
		for($column_num = 0; $column_num < $column_count; $column_num++) {
			$field_name = mysql_field_name($result_id, $column_num);
			print("<TH>$field_name</TH>");
		}
		print("</TR>\n");
	}
	// print the body of the table
	while($row = mysql_fetch_row($result_id)) {
		print("<TR>");
		for($column_num = 0; $column_num < $column_count; $column_num++) {
			
				print("<TD>$row[$column_num]</TD>\n");
			
		}
		print("</TR>\n");
	}
	print("</TABLE>\n"); 
}

function display_db_table($tablename, $connection, $header_bool, $table_params) {
	$query_string = "SELECT * FROM $tablename";
	display_db_query($query_string, $connection,
	$header_bool, $table_params);
}
?> 
<TABLE><TR><TD>
<?php
//In this example the table name to be displayed is  static, but it could be taken from a form

//can also add on parameters for additional clauses in SQL SELECT statement (WHERE ,GROUP BY, ORDER BY)
$table = "medicinetypes";
//$params = "";//" WHERE Status <> 'fixed' or Status is Null";
//$params = " WHERE MedicineTypeID = 1 ORDER BY LogTime Desc";
$table = $table;//.' '.$params;
display_db_table($table, $global_dbh,
TRUE, "border='2'");
?>
</TD></TR></TABLE> 




 
<?php 

  //$url=$_SERVER['HTTP_REFERER'];
 echo "<a href=medlog.php>Back</a>";

include "includes/footer.php";?>
