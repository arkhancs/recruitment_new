function echeck(str) {
    var at = "@";
    var dot = ".";
    var lat = str.indexOf(at);
    var lstr = str.length;
    var ldot = str.indexOf(dot);
    var pattern = /^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|me|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i;
    if (str.indexOf(at) == -1) {
        alert("Please enter your Email like (abc@abc.com)");
        return false;
    }
    if (str.indexOf(at) == -1 || str.indexOf(at) == 0 || str.indexOf(at) == lstr) {
        alert("Please enter your Email like (abc@abc.com)");
        return false;
    }
    if (str.indexOf(dot) == -1 || str.indexOf(dot) == 0 || str.indexOf(dot) == lstr) {
        alert("Please enter your Email like (abc@abc.com)");
        return false;
    }
    if (str.indexOf(at, (lat + 1)) != -1) {
        alert("Please enter your Email like (abc@abc.com)");
        return false;
    }
    if (str.substring(lat - 1, lat) == dot || str.substring(lat + 1, lat + 2) == dot) {
        alert("Please enter your Email like (abc@abc.com)");
        return false;
    }
    if (str.indexOf(dot, (lat + 2)) == -1) {
        alert("Please enter your Email like (abc@abc.com)");
        return false;
    }
    if (str.indexOf(" ") != -1) {
        alert("Please enter your Email like (abc@abc.com)");
        return false;
    }
    if (!pattern.test(str)) {
        alert("Please enter your Email like (abc@abc.com)");
        return false;
    }
    return true;
}

function checkpolice()
{

    if (document.frmregister.police.value == "Yes")
    {
        document.frmregister.txtpolice.style.visibility = 'visible';
    }
    if (document.frmregister.police.value == "No")
    {
        document.frmregister.txtpolice.style.visibility = 'hidden';
    }
}
function checkcourt()
{

    if (document.frmregister.court.value == "Yes")
    {
        document.frmregister.txtcourt.style.visibility = 'visible';
    }
    if (document.frmregister.court.value == "No")
    {
        document.frmregister.txtcourt.style.visibility = 'hidden';
    }
}
function checkcriminal()
{

    if (document.frmregister.criminal.value == "Yes")
    {
        document.frmregister.txtcriminal.style.visibility = 'visible';
    }
    if (document.frmregister.criminal.value == "No")
    {
        document.frmregister.txtcriminal.style.visibility = 'hidden';
    }
}

function validate()
{
    if (document.frmregister.txtref1.value == "" || document.frmregister.txtref1.value == null)
    {
        alert("Please enter your 1st Reference");
        document.frmregister.txtref1.focus();
        return false;
    }
    if (document.frmregister.txtref2.value == "" || document.frmregister.txtref2.value == null)
    {
        alert("Please enter your 2nd Reference");
        document.frmregister.txtref2.focus();
        return false;
    }

    return true;
}