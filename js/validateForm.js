function validateForm()
{
var x=document.forms["confirm"]["start"].value;
var y=document.forms["confirm"]["stop"].value;
var subject=document.forms["confirm"]["subject"].value;
var chapter=document.forms["confirm"]["chapter"].value;
var verses=document.forms["confirm"]["verses"].value;
 

if (x > y) 
  {
	alert("Stop time must be greater than Start time.");
	return false;
  }
else if (subject == null || subject == "" || chapter==null || chapter==""|| verses==null || verses==""  || x==null || x==""|| y==null || y=="")
  {
  	alert("Missing info")
	return false;
  }
}
