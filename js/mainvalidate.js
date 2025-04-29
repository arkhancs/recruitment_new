
function validate()
{	
	

	if(document.form1.regid.value=="")
	{
		alert("Please enter your ID");
		document.form1.regid.focus();
		return false;
	}
	if(document.form1.dob.value=="")
	{
		alert("Please enter your DOB");
		document.form1.dob.focus();
		return false;
	}
	return true;
}