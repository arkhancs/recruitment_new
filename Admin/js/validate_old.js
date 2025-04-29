function echeck(str) {
	var at="@";
	var dot=".";
	var lat=str.indexOf(at);
	var lstr=str.length;
	var ldot=str.indexOf(dot);
	var pattern=/^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|me|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i;
	if (str.indexOf(at)==-1){
		alert("Please enter your Email like (abc@abc.com)");
		return false;
	}
	if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
		alert("Please enter your Email like (abc@abc.com)");
		return false;
	}
	if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
		alert("Please enter your Email like (abc@abc.com)");
		return false;
	}
	if (str.indexOf(at,(lat+1))!=-1){
		alert("Please enter your Email like (abc@abc.com)");
		return false;
	}
	if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
		alert("Please enter your Email like (abc@abc.com)");
		return false;
	}
	if (str.indexOf(dot,(lat+2))==-1){
		alert("Please enter your Email like (abc@abc.com)");
		return false;
	}
	if (str.indexOf(" ")!=-1){
		alert("Please enter your Email like (abc@abc.com)");
		return false;
	}
	if(!pattern.test(str)){         
		alert("Please enter your Email like (abc@abc.com)");
		return false;   
    }
	return true;				
}

function checkpolice()
{

		if(document.frmregister.police.value=="Yes")
	{
		document.frmregister.txtpolice.style.visibility='visible';	
		}
		if(document.frmregister.police.value=="No")
	{
		document.frmregister.txtpolice.style.visibility='hidden';	
		}
}
function checkcourt()
{

		if(document.frmregister.court.value=="Yes")
	{
		document.frmregister.txtcourt.style.visibility='visible';	
		}
		if(document.frmregister.court.value=="No")
	{
		document.frmregister.txtcourt.style.visibility='hidden';	
		}
}
function checkcriminal()
{

		if(document.frmregister.criminal.value=="Yes")
	{
		document.frmregister.txtcriminal.style.visibility='visible';	
		}
		if(document.frmregister.criminal.value=="No")
	{
		document.frmregister.txtcriminal.style.visibility='hidden';	
		}
}


function validate()
{	
	

	if(document.frmregister.post.value=="NA")
	{
		alert("Please select your Post");
		document.frmregister.post.focus();
		return false;
	}
	if(document.frmregister.name.value=="" || document.frmregister.name.value==null)
	{
		alert("Please enter your Name");
		document.frmregister.name.focus();
		return false;
	}
	if(document.frmregister.fname.value=="" || document.frmregister.fname.value==null)
	{
		alert("Please enter your FirstName");
		document.frmregister.fname.focus();
		return false;
	}
	if(document.frmregister.dob.value=="" || document.frmregister.dob.value==null)
	{
		alert("Please enter your DOB");
		document.frmregister.dob.focus();
		return false;
	}
		if(document.frmregister.email.value=="" || document.frmregister.email.value==null)
	{
		alert("Please enter your Email");
		document.frmregister.email.focus();
		return false;
	}
	if(document.frmregister.sex.value=="NA")
	{
		alert("Please select your Sex");
		document.frmregister.sex.focus();
		return false;
    }
    if (document.frmregister.caste.value == "NA") {
    alert("Please select your Caste");
    document.frmregister.caste.focus();
    return false;
    }
		if(document.frmregister.nation.value=="NA" || document.frmregister.nation.value==null)
	{
		alert("Please enter your Nationality");
		document.frmregister.nation.focus();
		return false;
	}
	if(document.frmregister.mstatus.value=="NA")
	{
		alert("Please select your marital status");
		document.frmregister.mstatus.focus();
		return false;
	}
		if(document.frmregister.address.value=="" || document.frmregister.address.value==null)
	{
		alert("Please enter your Address");
		document.frmregister.address.focus();
		return false;
	}
		if(document.frmregister.city.value=="" || document.frmregister.city.value==null)
	{
		alert("Please enter your City");
		document.frmregister.city.focus();
		return false;
	}
		if(document.frmregister.state.value=="" || document.frmregister.state.value==null)
	{
		alert("Please enter your state");
		document.frmregister.state.focus();
		return false;
	}
		if(document.frmregister.pincode.value=="" || document.frmregister.pincode.value==null)
	{
		alert("Please enter your pincode");
		document.frmregister.pincode.focus();
		return false;
	}

		if(document.frmregister.paddress.value=="" || document.frmregister.paddress.value==null)
	{
		alert("Please enter your Permanent Address");
		document.frmregister.paddress.focus();
		return false;
	}
		if(document.frmregister.pcity.value=="" || document.frmregister.pcity.value==null)
	{
		alert("Please enter your Permanent City");
		document.frmregister.pcity.focus();
		return false;
	}
		if(document.frmregister.pstate.value=="" || document.frmregister.pstate.value==null)
	{
		alert("Please enter your Permanent state");
		document.frmregister.pstate.focus();
		return false;
	}
		if(document.frmregister.ppincode.value=="" || document.frmregister.ppincode.value==null)
	{
		alert("Please enter your Permanent pincode");
		document.frmregister.ppincode.focus();
		return false;
	}
		if(document.frmregister.mobile.value=="" || document.frmregister.mobile.value==null)
	{
		alert("Please enter your mobile");
		document.frmregister.mobile.focus();
		return false;
	}	
	
	if(document.frmregister.edu1.value=="" || document.frmregister.edu1.value==null)
	{
		alert("Please enter your Education Details");
		document.frmregister.edu1.focus();
		return false;
	}
		if(document.frmregister.board1.value=="" || document.frmregister.board1.value==null)
	{
		alert("Please enter your Board Details");
		document.frmregister.board1.focus();
		return false;
	}
		if(document.frmregister.year1.value=="" || document.frmregister.year1.value==null)
	{
		alert("Please enter your Passing Year");
		document.frmregister.year1.focus();
		return false;
	}
	if (document.frmregister.per1.value == "" || document.frmregister.per1.value == null) {
	    alert("Please enter your Percentage");
	    document.frmregister.per1.focus();
	    return false;
	}
	
	if (document.frmregister.div1.value=="" || document.frmregister.div1.value==null)
	{
		alert("Please enter your Division");
		document.frmregister.div1.focus();
		return false;
	}
	
		if(document.frmregister.edu2.value=="" || document.frmregister.edu2.value==null)
	{
		alert("Please enter your Education Details");
		document.frmregister.edu2.focus();
		return false;
	}
		if(document.frmregister.board2.value=="" || document.frmregister.board2.value==null)
	{
		alert("Please enter your Board Details");
		document.frmregister.board2.focus();
		return false;
	}
		if(document.frmregister.year2.value=="" || document.frmregister.year2.value==null)
	{
		alert("Please enter your Passing Year");
		document.frmregister.year2.focus();
		return false;
	}
	if (document.frmregister.per2.value == "" || document.frmregister.per2.value == null) {
	    alert("Please enter your Percentage");
	    document.frmregister.per2.focus();
	    return false;
	}
	
	if (document.frmregister.div2.value=="" || document.frmregister.div2.value==null)
	{
		alert("Please enter your Division");
		document.frmregister.div2.focus();
		return false;
	}
	
			if(document.frmregister.edu3.value=="NA")
	{
		alert("Please enter your Education Details");
		document.frmregister.edu3.focus();
		return false;
	}
		if(document.frmregister.board3.value=="" || document.frmregister.board3.value==null)
	{
		alert("Please enter your Board Details");
		document.frmregister.board3.focus();
		return false;
	}
		if(document.frmregister.year3.value=="" || document.frmregister.year3.value==null)
	{
		alert("Please enter your Passing Year");
		document.frmregister.year3.focus();
		return false;
	}
	if (document.frmregister.per3.value == "" || document.frmregister.per3.value == null) {
	    alert("Please enter your Percentage");
	    document.frmregister.per3.focus();
	    return false;
	}
	
	if (document.frmregister.div3.value=="" || document.frmregister.div3.value==null)
	{
		alert("Please enter your Division");
		document.frmregister.div3.focus();
		return false;
	}
	
	if(document.frmregister.scst.value=="NA")
	{
		alert("Please select your Caste Status");
		document.frmregister.scst.focus();
		return false;
	}
		if(document.frmregister.police.value=="NA")
	{
		alert("Please select your Enquiry Status");
		document.frmregister.police.focus();
		return false;
	}
		if(document.frmregister.court.value=="NA")
	{
		alert("Please select your Court Status");
		document.frmregister.court.focus();
		return false;
	}
		if(document.frmregister.criminal.value=="NA")
	{
		alert("Please select your Criminal Status");
		document.frmregister.criminal.focus();
		return false;
	}
	
		if(document.frmregister.txtref1.value=="" || document.frmregister.txtref1.value==null)
	{
		alert("Please enter your 1st Reference");
		document.frmregister.txtref1.focus();
		return false;
	}		if(document.frmregister.txtref2.value=="" || document.frmregister.txtref2.value==null)
	{
		alert("Please enter your 2nd Reference");
		document.frmregister.txtref2.focus();
		return false;
	}

	return true;
}