$(document).ready(function () {

    $('#dob').datepicker({
       // defaultDate: "+1w",
        dateFormat: "mm/dd/yy",
        yearRange: '-50:+0',
        onSelect: function (value, ui) {
           
            var dob = new Date(value);
            var today = new Date();
            var age = Math.floor((today - dob) / (365.25 * 24 * 60 * 60 * 1000));
          //  $('#age').html('<b>' + age + ' Years' + '</b>').show();
	$('#agenew').val("");
	$('#agenew').val(age+" years");		
                        
        },
        //maxDate: '+0d',
       
        changeMonth: true,
        changeYear: true,
         yearRange: '1967:2000',
         defaultDate: '01/01/1967'
       
    });
    $("#certidate").datepicker({
      //  defaultDate: "+1w",
        changeMonth: true,
        //dateFormat: "dd/mm/yy",
        changeYear: true,
        yearRange: '-50:+0',
        onClose: function (selectedDate) {
            $("#certidate").datepicker("option", "minDate", selectedDate);
        }
    });
   
});
/*function checkExperience() {
    var total = $('#total_exp').html();
	var edu3 = $('#edu3').val();
	var edu5 = $('#edu5').val();
    var t_array = total.split('.');
	var post = $('#post').val();
    var age = $('#age').html().replace(' Years','').replace('<b>','').replace('</b>','');
	if (post == 'Scientist-B(LS-OBC(NCL)-16' && parseInt(age) > 38)
		{    
        alert('Maximun age should be 38 years only.');
        return false;
    }
	else if (post == 'Scientist-D(LS-OBC(NCL)-16' && parseInt(age) > 48)
		{    
        alert('Maximun age should be 48 years only.');
        return false;
    }
    if (t_array.length == 3) 
	{
        var y_day = parseInt(t_array[0]) * 365;
        var m_day = parseInt(t_array[1]) * 30;
        var day = parseInt(t_array[2]);
        var total = (y_day + m_day + day) / 365;
        
        if (post == 'Scientist-B(LS-OBC(NCL)-16') 
		{
            if (total >= 1 && edu3=='MLISc')
				{
                return true;
            } 
			else 
			{
                alert('Minimum experience/qualification are not matching as per advertisement.');
                return false;
            }
					
		}	
			if (post == 'Scientist-D(LS-OBC(NCL)-16') 
			{

				if (total >= 10 && edu3=='MLISc')
				{
					return true;
				} 
				else if(total >= 4 && $('#speci4').val()!=''&& $('#board4').val()!=''&& $('#year4').val()!=''&& $('#per4').val()!='')
				{
					return true;				
				}						
				else
				{
                alert('Minimum experience/qualification are not matching as per advertisement.');
					return false;	
				}
			}
        
    } else {
        alert('Invalid experience');
        return false;
    }
}
*/
/*function periodCalc(startDate, endDate) {

    var output = '';
    var sYear = startDate.getFullYear();
    var sMonth = startDate.getMonth();
    var sDay = startDate.getDate() - 1;
    var eYear = endDate.getFullYear();
    var eMonth = endDate.getMonth();
    var eDay = endDate.getDate();
    var tMonths = eYear * 12 + eMonth - sYear * 12 - sMonth;
    var days = eDay - sDay;
    if (days < 0) {
        tMonths--;
        var sDate = new Date(sYear, sMonth + tMonths, sDay);
        var eDate = new Date(eYear, eMonth, eDay);
        days = (eDate.getTime() - sDate.getTime()) / 86400000;
    }

    if (tMonths < 0)
        return '0';
    var months = tMonths % 12;
    var years = (tMonths - months) / 12;
    output += (years == 0 ? '0' : (years));
    output += (months == 0 ? '.0' : ('.' + months));
    output += (days == 0 ? '.0' : ('.' + days));
    return output;
}*/