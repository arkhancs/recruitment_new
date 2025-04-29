$(document).ready(function () {
    $("#from1").datepicker({
        // defaultDate: "+1w",
        changeMonth: true,
        dateFormat: "dd/mm/yy",
        changeYear: true,
        yearRange: '-50:+0',
        maxDate: 0,
        onClose: function (selectedDate) {
            // $("#to1").datepicker("option", "minDate", selectedDate);
        },
        onSelect: function (dateStr) {
            // $(this).val('');
            $(this).change();
        }
    }).on("change", function () {
        CalculateTotalExp();
    });
    $("#to1").datepicker({
//   defaultDate: "+1w",
        changeMonth: true,
        dateFormat: "dd/mm/yy",
        changeYear: true,
        yearRange: '-50:+0',
        maxDate: 0,
        onClose: function (selectedDate) {
            // $("#from1").datepicker("option", "maxDate", selectedDate);
        },
        onSelect: function (dateStr) {
            $(this).change();
        }
    }).on("change", function () {
        var from1 = $('#from1').datepicker('getDate');
        var to1 = $('#to1').datepicker('getDate');
        months = 0;
        if (to1 < from1) {
            alert("Ending date Must be Greater than starting Date.");
        } else {
            CalculateTotalExp();
        }
    });

    if ($("#current_working").prop("checked") == true) {
        $("#to1").datepicker("destroy");
    }

    /********** For 2 *********/

    $("#from2").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd/mm/yy",
        yearRange: '-50:+0',
        maxDate: 0,
        onClose: function (selectedDate) {
            //  $("#to2").datepicker("option", "minDate", selectedDate);
        },
        onSelect: function (dateStr) {
            $(this).change();
        }
    }).on("change", function () {
        CalculateTotalExp();
    });
    $("#to2").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd/mm/yy",
        yearRange: '-50:+0',
        maxDate: 0,
        onClose: function (selectedDate) {
            //  $("#from2").datepicker("option", "maxDate", selectedDate);
        },
        onSelect: function (dateStr) {
            $(this).change();
        }
    }).on("change", function () {
        var from2 = $('#from2').datepicker('getDate');
        var to2 = $('#to2').datepicker('getDate');
        months = 0;
        if (to2 < from2) {
            alert("Ending date Must be Greater than starting Date.");
        } else {
            CalculateTotalExp();
        }
    });
    /****************** For 3 *********************/
    $("#from3").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd/mm/yy",
        yearRange: '-50:+0',
        maxDate: 0,
        onClose: function (selectedDate) {
            // $("#to3").datepicker("option", "minDate", selectedDate);
        },
        onSelect: function (dateStr) {
            $(this).change();
        }
    }).on("change", function () {
        CalculateTotalExp();
    });
    $("#to3").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd/mm/yy",
        yearRange: '-50:+0',
        maxDate: 0,
        onClose: function (selectedDate) {
            //  $("#from3").datepicker("option", "maxDate", selectedDate);
        },
        onSelect: function (dateStr) {
            $(this).change();
        }
    }).on("change", function () {
        var from3 = $('#from3').datepicker('getDate');
        var to3 = $('#to3').datepicker('getDate');

        months = 0;
        if (to3 < from3) {
            alert("Ending date Must be Greater than starting Date.");
        } else {
            CalculateTotalExp();
        }
    });
    /************************* For 4 *********************/

    $("#from4").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd/mm/yy",
        yearRange: '-50:+0',
        maxDate: 0,
        onClose: function (selectedDate) {
            //  $("#to4").datepicker("option", "minDate", selectedDate);
        }, onSelect: function (dateStr) {
            $(this).change();
        }
    }).on("change", function () {
        CalculateTotalExp();
    });
    $("#to4").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd/mm/yy",
        yearRange: '-50:+0',
        maxDate: 0,
        onClose: function (selectedDate) {
        },
        onSelect: function (dateStr) {
            $(this).change();
        }
    }).on("change", function () {
        var from4 = $('#from4').datepicker('getDate');
        var to4 = $('#to4').datepicker('getDate');

        months = 0;
        if (to4 < from4) {
            alert("Ending date Must be Greater than starting Date.");
        } else {
            CalculateTotalExp();
        }
    });
    /******************** For 5 *********************/

    $("#from5").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd/mm/yy",
        yearRange: '-50:+0',
        maxDate: 0,
        onClose: function (selectedDate) {
            //   $("#to5").datepicker("option", "minDate", selectedDate);
        }, onSelect: function (dateStr) {
            $(this).change();
        }
    }).on("change", function () {
        CalculateTotalExp();
    });
    $("#to5").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd/mm/yy",
        yearRange: '-50:+0',
        maxDate: 0,
        onClose: function (selectedDate) {
            //   $("#from5").datepicker("option", "maxDate", selectedDate);
        },
        onSelect: function (dateStr) {
            $(this).change();
        }
    }).on("change", function () {
        var from5 = $('#from5').datepicker('getDate');
        var to5 = $('#to5').datepicker('getDate');

        months = 0;
        if (to5 < from5) {
            alert("Ending date Must be Greater than starting Date.");
        } else {
            CalculateTotalExp();
        }
    });
    /********************* For 6 *********************/
    $('body').on('focus', "#from6", function () {
        $(this).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "dd/mm/yy",
            yearRange: '-50:+0',
            maxDate: 0,
            onClose: function (selectedDate) {
                //   $("#to5").datepicker("option", "minDate", selectedDate);
            }, onSelect: function (dateStr) {
                $(this).change();
            }
        }).on("change", function () {
            CalculateTotalExp();
        });
    });
    $('body').on('focus', "#to6", function () {
        $(this).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "dd/mm/yy",
            yearRange: '-50:+0',
            maxDate: 0,
            onClose: function (selectedDate) {
                //   $("#from5").datepicker("option", "maxDate", selectedDate);
            },
            onSelect: function (dateStr) {
                $(this).change();
            }
        }).on("change", function () {
            var from6 = $('#from6').datepicker('getDate');
            var to6 = $('#to6').datepicker('getDate');
            months = 0;
            if (to6 < from6) {
                alert("Ending date Must be Greater than starting Date.");
            } else {
                CalculateTotalExp();
            }
        });
    });
    /************************ For 7 *********************/
    $('body').on('focus', "#from7", function () {
        $(this).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "dd/mm/yy",
            yearRange: '-50:+0',
            maxDate: 0,
            onClose: function (selectedDate) {
                //   $("#to5").datepicker("option", "minDate", selectedDate);
            }, onSelect: function (dateStr) {
                $(this).change();
            }
        }).on("change", function () {
            CalculateTotalExp();
        });
    });
    $('body').on('focus', "#to7", function () {
        $(this).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "dd/mm/yy",
            yearRange: '-50:+0',
            maxDate: 0,
            onClose: function (selectedDate) {
                //   $("#from5").datepicker("option", "maxDate", selectedDate);
            },
            onSelect: function (dateStr) {
                $(this).change();
            }
        }).on("change", function () {
            var from7 = $('#from7').datepicker('getDate');
            var to7 = $('#to7').datepicker('getDate');
            months = 0;
            if (to7 < from7) {
                alert("Ending date Must be Greater than starting Date.");
            } else {
                CalculateTotalExp();
            }
        });
    });
    /*************************** For 8 *********************/
    $('body').on('focus', "#from8", function () {
        $(this).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "dd/mm/yy",
            yearRange: '-50:+0',
            maxDate: 0,
            onClose: function (selectedDate) {
                //   $("#to5").datepicker("option", "minDate", selectedDate);
            }, onSelect: function (dateStr) {
                $(this).change();
            }
        }).on("change", function () {
            CalculateTotalExp();
        });
    });
    $('body').on('focus', "#to8", function () {
        $(this).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "dd/mm/yy",
            yearRange: '-50:+0',
            maxDate: 0,
            onClose: function (selectedDate) {
                //   $("#from5").datepicker("option", "maxDate", selectedDate);
            },
            onSelect: function (dateStr) {
                $(this).change();
            }
        }).on("change", function () {
            var from8 = $('#from8').datepicker('getDate');
            var to8 = $('#to8').datepicker('getDate');

            months = 0;
            if (to8 < from8) {
                alert("Ending date Must be Greater than starting Date.");
            } else {
                CalculateTotalExp();
            }
        });
    });
    /********************** For 9 *********************/
    $('body').on('focus', "#from9", function () {
        $(this).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "dd/mm/yy",
            yearRange: '-50:+0',
            maxDate: 0,
            onClose: function (selectedDate) {
                //   $("#to5").datepicker("option", "minDate", selectedDate);
            }, onSelect: function (dateStr) {
                $(this).change();
            }
        }).on("change", function () {
            CalculateTotalExp();
        });
    });
    $('body').on('focus', "#to9", function () {
        $(this).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "dd/mm/yy",
            yearRange: '-50:+0',
            maxDate: 0,
            onClose: function (selectedDate) {
                //   $("#from5").datepicker("option", "maxDate", selectedDate);
            },
            onSelect: function (dateStr) {
                $(this).change();
            }
        }).on("change", function () {
            var from9 = $('#from9').datepicker('getDate');
            var to9 = $('#to9').datepicker('getDate');

            months = 0;
            if (to9 < from9) {
                alert("Ending date Must be Greater than starting Date.");
            } else {
                CalculateTotalExp();
            }
        });
    });
    /*********************** For 10 *********************/
    $('body').on('focus', "#from10", function () {
        $(this).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "dd/mm/yy",
            yearRange: '-50:+0',
            maxDate: 0,
            onClose: function (selectedDate) {
                //   $("#to5").datepicker("option", "minDate", selectedDate);
            }, onSelect: function (dateStr) {
                $(this).change();
            }
        }).on("change", function () {
            CalculateTotalExp();
        });
    });
    $('body').on('focus', "#to10", function () {
        $(this).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "dd/mm/yy",
            yearRange: '-50:+0',
            maxDate: 0,
            onClose: function (selectedDate) {
                //   $("#from5").datepicker("option", "maxDate", selectedDate);
            },
            onSelect: function (dateStr) {
                $(this).change();
            }
        }).on("change", function () {
            var from10 = $('#from10').datepicker('getDate');
            var to10 = $('#to10').datepicker('getDate');
            months = 0;
            if (to10 < from10) {
                alert("Ending date Must be Greater than starting Date.");
            } else {
                CalculateTotalExp();
            }
        });
    });
});

function CalculateTotalExp() {
    var TotalExp = [];
    $("#add_more_rows").find('tr').each(function () {
        var tr = $(this);
        var fromDate = tr.find('.fromdt');
        var toDate = tr.find('.todt');
        if (fromDate.val() !== '' && toDate.val() !== '')
        {
            var fdt = stringToDate(fromDate.val(), 'dd/MM/yyyy', '/');
            var tdt = stringToDate(toDate.val(), 'dd/MM/yyyy', '/');
            //alert(getAge(new Date(1990, 8, 10), new Date(2020, 1, 4))) 
            var rexpr = getExp(fdt, tdt);
            var expr = rexpr.split(',');
            TotalExp.push([expr[0], expr[1], expr[2]]);
        }
    });
    var Year = 0, Month = 0, Day = 0;
    $.each(TotalExp, function (index, item) {
        Year = parseInt(Year) + parseInt(item[0]);
        Month = parseInt(Month) + parseInt(item[1]);
        Day = parseInt(Day) + parseInt(item[2]);
    });
    Month = Month + parseInt(Day / 30);
    Day = parseInt(Day % 30);
    Year = Year + parseInt(Month / 12);
    Month = parseInt(Month % 12);

    var yAppendix = '', mAppendix = '', dAppendix = '';
    if (Year > 1)
        yAppendix = " years";
    else
        yAppendix = " year";
    if (Month > 1)
        mAppendix = " months";
    else
        mAppendix = " month";
    if (Day > 1)
        dAppendix = " days";
    else
        dAppendix = " day";

    $("#exp_count").val(Year + yAppendix + ", " + Month + mAppendix + ", and " + Day + dAppendix);
    $("#total_exp").text(Year + yAppendix + ", " + Month + mAppendix + ", and " + Day + dAppendix);
    //return TotalExp;
}


function getExp(date_1, date_2)
{

//convert to UTC
    var date2_UTC = new Date(Date.UTC(date_2.getUTCFullYear(), date_2.getUTCMonth(), date_2.getUTCDate()));
    var date1_UTC = new Date(Date.UTC(date_1.getUTCFullYear(), date_1.getUTCMonth(), date_1.getUTCDate()));


    var yAppendix, mAppendix, dAppendix;


//--------------------------------------------------------------
    var days = date2_UTC.getDate() - date1_UTC.getDate();
    if (days < 0)
    {

        date2_UTC.setMonth(date2_UTC.getMonth() - 1);
        days += DaysInMonth(date2_UTC);
    }
//--------------------------------------------------------------
    var months = date2_UTC.getMonth() - date1_UTC.getMonth();
    if (months < 0)
    {
        date2_UTC.setFullYear(date2_UTC.getFullYear() - 1);
        months += 12;
    }
//--------------------------------------------------------------
    var years = date2_UTC.getFullYear() - date1_UTC.getFullYear();


    return years + "," + months + "," + days;
}