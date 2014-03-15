function validateFormPhone(test)
{
var x=document.forms["phone"]["sendto"].value;
var provider=document.forms["phone"]["provider"].value;
len=x.length;
if (provider == "none")
  {
	alert("Please select a Cell Provider.")
	test="test";
	return false;

  }


if (provider !== "other")
{
if (len!==10) 
  {


	alert("Phone number must be 10 digits.");
	return false;
  }
}
}




function DropDown()
{
	var mylist=document.getElementById("mylist");
	var output=document.getElementById("output");
 	if (mylist.options[mylist.selectedIndex].value == "other")
		{
			//custom
			var html = '<b>Send to (See next tab below):</b></legend><input type="text" name="sendto" size="20" maxlength="50"><br><input type="Submit" value ="Save Reminder!">';
			output.innerHTML = html;
 
		}
	else if (mylist.options[mylist.selectedIndex].value == "none")
		{
			output.innerHTML = "";

		}
	else

		{
			//phone
			var html = '<b>Send to (10 digit phone):</b><input type="number" name="sendto" size="10" maxlength="10"><br><input type="Submit" value ="Save Reminder!">';
			output.innerHTML = html;
			

		}
	
 
}


