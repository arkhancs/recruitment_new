$(document).ready(function () {

    $('#dob').datepicker({
        dateFormat: "mm/dd/yy",
        yearRange: '-50:+0',
        onSelect: function (value, ui) {
//            var dob = new Date(value);
//            var today = new Date();
//            var age = Math.floor((today - dob) / (365.25 * 24 * 60 * 60 * 1000));
            var age = getDOB(value);
            $('#agenew').val("");
            $('#agenew').val(age);

        },

        changeMonth: true,
        changeYear: true,
        yearRange: '1940:2008',
        // yearRange: '1940:2008',
        defaultDate: '01/01/1940'

    });

    $('#service_from_date').datepicker({
        dateFormat: "dd/mm/yy",
        yearRange: '-50:+0',
        changeMonth: true,
        changeYear: true,
        yearRange: '1940:2025',
        defaultDate: '01/01/1940'
    });

    $('#service_to_date').datepicker({
        dateFormat: "dd/mm/yy",
        yearRange: '-50:+0',
        changeMonth: true,
        changeYear: true,
        yearRange: '1940:2025',
        defaultDate: '01/01/1940'
    });

    var year = (new Date).getFullYear();
    $("#dd_date").datepicker({
        changeMonth: true,
        changeYear: true,
        minDate: new Date(2025, 01 - 1),
        //yearRange: '-1:+0',
        maxDate: 0,
        numberOfMonths: 1,
        onClose: function () {
            $("#dd_date").datepicker();
        }
    });

    $("#certidate").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: '-50:+0',
        onClose: function (selectedDate) {
            $("#certidate").datepicker("option", "minDate", selectedDate);
        }
    });

    $("#stenography_certi_date").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: '-50:+0',
        onClose: function (selectedDate) {
            $("#certidate").datepicker("option", "minDate", selectedDate);
        }
    });

    $("#typing_certi_date").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: '-50:+0',
        onClose: function (selectedDate) {
            $("#certidate").datepicker("option", "minDate", selectedDate);
        }
    });

    $('#year1').datepicker({
        dateFormat: "MM, yy",
        changeMonth: true,
        changeYear: true,
        yearRange: '1990:2025',
        defaultYear: '1990'
    });

    $('#year2').datepicker({
        dateFormat: "MM, yy",
        changeMonth: true,
        changeYear: true,
        yearRange: '1990:2025',
        defaultYear: '1990'
    });

    $('#year3').datepicker({
        dateFormat: "MM, yy",
        changeMonth: true,
        changeYear: true,
        yearRange: '1990:2025',
        defaultYear: '1990'
    });

    $('#year4').datepicker({
        dateFormat: "MM, yy",
        changeMonth: true,
        changeYear: true,
        yearRange: '1990:2025',
        defaultYear: '1990'
    });

    $('#year5').datepicker({
        dateFormat: "MM, yy",
        changeMonth: true,
        changeYear: true,
        yearRange: '1990:2025',
        defaultYear: '1990'
    });

    $('#year7').datepicker({
        dateFormat: "MM, yy",
        changeMonth: true,
        changeYear: true,
        yearRange: '1990:2025',
        defaultYear: '1990'
    });

    $('#year8').datepicker({
        dateFormat: "MM, yy",
        changeMonth: true,
        changeYear: true,
        yearRange: '1990:2025',
        defaultYear: '1990'
    });

    function getDOB(dateString) {
        var now = new Date('2025, 07, 12');
        var today = new Date(now.getYear(), now.getMonth(), now.getDate());

        var yearNow = now.getYear();
        var monthNow = now.getMonth();
        var dateNow = now.getDate();

        var dob = new Date(dateString.substring(6, 10),
                dateString.substring(0, 2) - 1,
                dateString.substring(3, 5)
                );

        var yearDob = dob.getYear();
        var monthDob = dob.getMonth();
        var dateDob = dob.getDate();
        var age = {};
        var ageString = "";
        var yearString = "";
        var monthString = "";
        var dayString = "";


        yearAge = yearNow - yearDob;

        if (monthNow >= monthDob)
            var monthAge = monthNow - monthDob;
        else {
            yearAge--;
            var monthAge = 12 + monthNow - monthDob;
        }

        if (dateNow >= dateDob)
            var dateAge = dateNow - dateDob;
        else {
            monthAge--;
            var dateAge = 31 + dateNow - dateDob;

            if (monthAge < 0) {
                monthAge = 11;
                yearAge--;
            }
        }

        age = {
            years: yearAge,
            months: monthAge,
            days: dateAge
        };

        if (age.years > 1)
            yearString = " years";
        else
            yearString = " year";
        if (age.months > 1)
            monthString = " months";
        else
            monthString = " month";
        if (age.days > 1)
            dayString = " days";
        else
            dayString = " day";


        if ((age.years > 0) && (age.months > 0) && (age.days > 0))
            ageString = age.years + yearString + ", " + age.months + monthString + ", and " + age.days + dayString;
        else if ((age.years == 0) && (age.months == 0) && (age.days > 0))
            ageString = "Only " + age.days + dayString;
        else if ((age.years > 0) && (age.months == 0) && (age.days == 0))
            ageString = age.years + yearString;
        else if ((age.years > 0) && (age.months > 0) && (age.days == 0))
            ageString = age.years + yearString + " and " + age.months + monthString;
        else if ((age.years == 0) && (age.months > 0) && (age.days > 0))
            ageString = age.months + monthString + " and " + age.days + dayString;
        else if ((age.years > 0) && (age.months == 0) && (age.days > 0))
            ageString = age.years + yearString + " and " + age.days + dayString;
        else if ((age.years == 0) && (age.months > 0) && (age.days == 0))
            ageString = age.months + monthString;
        else
            ageString = "Oops! Could not calculate age!";

        return ageString;
    }

});


