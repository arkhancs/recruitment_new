$(document).ready(function () {
    var months = 0;
    var years = 0;
    var i = 0;
    var days = 0;
    var day = 1000 * 60 * 60 * 24;
    var days1 = days2 = m_val = d_val = days3 = days4 = days5 = days6 = days7 = days8 = days9 = days10 = 0;

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
        var from1 = $('#from1').datepicker('getDate');
        var to1 = $('#to1').datepicker('getDate');
        var from2 = $('#from2').datepicker('getDate');
        var to2 = $('#to2').datepicker('getDate');
        var from3 = $('#from3').datepicker('getDate');
        var to3 = $('#to3').datepicker('getDate');
        var from4 = $('#from4').datepicker('getDate');
        var to4 = $('#to4').datepicker('getDate');
        var from5 = $('#from5').datepicker('getDate');
        var to5 = $('#to5').datepicker('getDate');
        var from6 = $('#from6').datepicker('getDate');
        var to6 = $('#to6').datepicker('getDate');
        var from7 = $('#from7').datepicker('getDate');
        var to7 = $('#to7').datepicker('getDate');
        var from8 = $('#from8').datepicker('getDate');
        var to8 = $('#to8').datepicker('getDate');
        var from9 = $('#from9').datepicker('getDate');
        var to9 = $('#to9').datepicker('getDate');
        var from10 = $('#from10').datepicker('getDate');
        var to10 = $('#to10').datepicker('getDate');
        months = 0;
        calculate(from1, to1, from2, to2, from3, to3, from4, to4, from5, to5, from6, to6, from7, to7, from8, to8, from9, to9, from10, to10);
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
        var from2 = $('#from2').datepicker('getDate');
        var to2 = $('#to2').datepicker('getDate');
        var from3 = $('#from3').datepicker('getDate');
        var to3 = $('#to3').datepicker('getDate');
        var from4 = $('#from4').datepicker('getDate');
        var to4 = $('#to4').datepicker('getDate');
        var from5 = $('#from5').datepicker('getDate');
        var to5 = $('#to5').datepicker('getDate');
        var from6 = $('#from6').datepicker('getDate');
        var to6 = $('#to6').datepicker('getDate');
        var from7 = $('#from7').datepicker('getDate');
        var to7 = $('#to7').datepicker('getDate');
        var from8 = $('#from8').datepicker('getDate');
        var to8 = $('#to8').datepicker('getDate');
        var from9 = $('#from9').datepicker('getDate');
        var to9 = $('#to9').datepicker('getDate');
        var from10 = $('#from10').datepicker('getDate');
        var to10 = $('#to10').datepicker('getDate');
        months = 0;
        if (to1 < from1) {
            alert("Ending date Must be Greater than starting Date.");
        } else {
            calculate(from1, to1, from2, to2, from3, to3, from4, to4, from5, to5, from6, to6, from7, to7, from8, to8, from9, to9, from10, to10);
        }
    });
    /***************************************************************** For 2 *********************/

    $("#from2").datepicker({
//   defaultDate: "+1w",
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
        var from1 = $('#from1').datepicker('getDate');
        var to1 = $('#to1').datepicker('getDate');
        var from2 = $('#from2').datepicker('getDate');
        var to2 = $('#to2').datepicker('getDate');
        var from3 = $('#from3').datepicker('getDate');
        var to3 = $('#to3').datepicker('getDate');
        var from4 = $('#from4').datepicker('getDate');
        var to4 = $('#to4').datepicker('getDate');
        var from5 = $('#from5').datepicker('getDate');
        var to5 = $('#to5').datepicker('getDate');
        var from6 = $('#from6').datepicker('getDate');
        var to6 = $('#to6').datepicker('getDate');
        var from7 = $('#from7').datepicker('getDate');
        var to7 = $('#to7').datepicker('getDate');
        var from8 = $('#from8').datepicker('getDate');
        var to8 = $('#to8').datepicker('getDate');
        var from9 = $('#from9').datepicker('getDate');
        var to9 = $('#to9').datepicker('getDate');
        var from10 = $('#from10').datepicker('getDate');
        var to10 = $('#to10').datepicker('getDate');
        months = 0;
        if (to1 < from1) {
            alert("Ending date Must be Greater than starting Date.");
        } else {
            calculate(from1, to1, from2, to2, from3, to3, from4, to4, from5, to5, from6, to6, from7, to7, from8, to8, from9, to9, from10, to10);
        }
    });
    $("#to2").datepicker({
//  defaultDate: "+1w",
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
        var from1 = $('#from1').datepicker('getDate');
        var to1 = $('#to1').datepicker('getDate');
        var from2 = $('#from2').datepicker('getDate');
        var to2 = $('#to2').datepicker('getDate');
        var from3 = $('#from3').datepicker('getDate');
        var to3 = $('#to3').datepicker('getDate');
        var from4 = $('#from4').datepicker('getDate');
        var to4 = $('#to4').datepicker('getDate');
        var from5 = $('#from5').datepicker('getDate');
        var to5 = $('#to5').datepicker('getDate');
        var from6 = $('#from6').datepicker('getDate');
        var to6 = $('#to6').datepicker('getDate');
        var from7 = $('#from7').datepicker('getDate');
        var to7 = $('#to7').datepicker('getDate');
        var from8 = $('#from8').datepicker('getDate');
        var to8 = $('#to8').datepicker('getDate');
        var from9 = $('#from9').datepicker('getDate');
        var to9 = $('#to9').datepicker('getDate');
        var from10 = $('#from10').datepicker('getDate');
        var to10 = $('#to10').datepicker('getDate');
        months = 0;
        if (to2 < from2) {
            alert("Ending date Must be Greater than starting Date.");
        } else {
            calculate(from1, to1, from2, to2, from3, to3, from4, to4, from5, to5, from6, to6, from7, to7, from8, to8, from9, to9, from10, to10);
        }
    });
    /***************************************************************** For 3 *********************/
    $("#from3").datepicker({
// defaultDate: "+1w",
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
        var from1 = $('#from1').datepicker('getDate');
        var to1 = $('#to1').datepicker('getDate');
        var from2 = $('#from2').datepicker('getDate');
        var to2 = $('#to2').datepicker('getDate');
        var from3 = $('#from3').datepicker('getDate');
        var to3 = $('#to3').datepicker('getDate');
        var from4 = $('#from4').datepicker('getDate');
        var to4 = $('#to4').datepicker('getDate');
        var from5 = $('#from5').datepicker('getDate');
        var to5 = $('#to5').datepicker('getDate');
        var from6 = $('#from6').datepicker('getDate');
        var to6 = $('#to6').datepicker('getDate');
        var from7 = $('#from7').datepicker('getDate');
        var to7 = $('#to7').datepicker('getDate');
        var from8 = $('#from8').datepicker('getDate');
        var to8 = $('#to8').datepicker('getDate');
        var from9 = $('#from9').datepicker('getDate');
        var to9 = $('#to9').datepicker('getDate');
        var from10 = $('#from10').datepicker('getDate');
        var to10 = $('#to10').datepicker('getDate');
        months = 0;
        calculate(from1, to1, from2, to2, from3, to3, from4, to4, from5, to5, from6, to6, from7, to7, from8, to8, from9, to9, from10, to10);
    });
    $("#to3").datepicker({
//  defaultDate: "+1w",
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
        var from1 = $('#from1').datepicker('getDate');
        var to1 = $('#to1').datepicker('getDate');
        var from2 = $('#from2').datepicker('getDate');
        var to2 = $('#to2').datepicker('getDate');
        var from3 = $('#from3').datepicker('getDate');
        var to3 = $('#to3').datepicker('getDate');
        var from4 = $('#from4').datepicker('getDate');
        var to4 = $('#to4').datepicker('getDate');
        var from5 = $('#from5').datepicker('getDate');
        var to5 = $('#to5').datepicker('getDate');
        var from6 = $('#from6').datepicker('getDate');
        var to6 = $('#to6').datepicker('getDate');
        var from7 = $('#from7').datepicker('getDate');
        var to7 = $('#to7').datepicker('getDate');
        var from8 = $('#from8').datepicker('getDate');
        var to8 = $('#to8').datepicker('getDate');
        var from9 = $('#from9').datepicker('getDate');
        var to9 = $('#to9').datepicker('getDate');
        var from10 = $('#from10').datepicker('getDate');
        var to10 = $('#to10').datepicker('getDate');
        months = 0;
        if (to3 < from3) {
            alert("Ending date Must be Greater than starting Date.");
        } else {
            calculate(from1, to1, from2, to2, from3, to3, from4, to4, from5, to5, from6, to6, from7, to7, from8, to8, from9, to9, from10, to10);
        }
    });
    /***************************************************************** For 4 *********************/

    $("#from4").datepicker({
//  defaultDate: "+1w",
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
//   $(this).val('');
        var from1 = $('#from1').datepicker('getDate');
        var to1 = $('#to1').datepicker('getDate');
        var from2 = $('#from2').datepicker('getDate');
        var to2 = $('#to2').datepicker('getDate');
        var from3 = $('#from3').datepicker('getDate');
        var to3 = $('#to3').datepicker('getDate');
        var from4 = $('#from4').datepicker('getDate');
        var to4 = $('#to4').datepicker('getDate');
        var from5 = $('#from5').datepicker('getDate');
        var to5 = $('#to5').datepicker('getDate');
        var from6 = $('#from6').datepicker('getDate');
        var to6 = $('#to6').datepicker('getDate');
        var from7 = $('#from7').datepicker('getDate');
        var to7 = $('#to7').datepicker('getDate');
        var from8 = $('#from8').datepicker('getDate');
        var to8 = $('#to8').datepicker('getDate');
        var from9 = $('#from9').datepicker('getDate');
        var to9 = $('#to9').datepicker('getDate');
        var from10 = $('#from10').datepicker('getDate');
        var to10 = $('#to10').datepicker('getDate');
        months = 0;
        calculate(from1, to1, from2, to2, from3, to3, from4, to4, from5, to5, from6, to6, from7, to7, from8, to8, from9, to9, from10, to10);
    });
    $("#to4").datepicker({
//  defaultDate: "+1w",
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
        var from1 = $('#from1').datepicker('getDate');
        var to1 = $('#to1').datepicker('getDate');
        var from2 = $('#from2').datepicker('getDate');
        var to2 = $('#to2').datepicker('getDate');
        var from3 = $('#from3').datepicker('getDate');
        var to3 = $('#to3').datepicker('getDate');
        var from4 = $('#from4').datepicker('getDate');
        var to4 = $('#to4').datepicker('getDate');
        var from5 = $('#from5').datepicker('getDate');
        var to5 = $('#to5').datepicker('getDate');
        var from6 = $('#from6').datepicker('getDate');
        var to6 = $('#to6').datepicker('getDate');
        var from7 = $('#from7').datepicker('getDate');
        var to7 = $('#to7').datepicker('getDate');
        var from8 = $('#from8').datepicker('getDate');
        var to8 = $('#to8').datepicker('getDate');
        var from9 = $('#from9').datepicker('getDate');
        var to9 = $('#to9').datepicker('getDate');
        var from10 = $('#from10').datepicker('getDate');
        var to10 = $('#to10').datepicker('getDate');
        months = 0;
        if (to4 < from4) {
            alert("Ending date Must be Greater than starting Date.");
        } else {
            calculate(from1, to1, from2, to2, from3, to3, from4, to4, from5, to5, from6, to6, from7, to7, from8, to8, from9, to9, from10, to10);
        }
    });
    /***************************************************************** For 5 *********************/

    $("#from5").datepicker({
//  defaultDate: "+1w",
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
///  $(this).val('');
        var from1 = $('#from1').datepicker('getDate');
        var to1 = $('#to1').datepicker('getDate');
        var from2 = $('#from2').datepicker('getDate');
        var to2 = $('#to2').datepicker('getDate');
        var from3 = $('#from3').datepicker('getDate');
        var to3 = $('#to3').datepicker('getDate');
        var from4 = $('#from4').datepicker('getDate');
        var to4 = $('#to4').datepicker('getDate');
        var from5 = $('#from5').datepicker('getDate');
        var to5 = $('#to5').datepicker('getDate');
        var from6 = $('#from6').datepicker('getDate');
        var to6 = $('#to6').datepicker('getDate');
        var from7 = $('#from7').datepicker('getDate');
        var to7 = $('#to7').datepicker('getDate');
        var from8 = $('#from8').datepicker('getDate');
        var to8 = $('#to8').datepicker('getDate');
        var from9 = $('#from9').datepicker('getDate');
        var to9 = $('#to9').datepicker('getDate');
        var from10 = $('#from10').datepicker('getDate');
        var to10 = $('#to10').datepicker('getDate');
        months = 0;

        calculate(from1, to1, from2, to2, from3, to3, from4, to4, from5, to5, from6, to6, from7, to7, from8, to8, from9, to9, from10, to10);

    });
    $("#to5").datepicker({
// defaultDate: "+1w",
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
        var from1 = $('#from1').datepicker('getDate');
        var to1 = $('#to1').datepicker('getDate');
        var from2 = $('#from2').datepicker('getDate');
        var to2 = $('#to2').datepicker('getDate');
        var from3 = $('#from3').datepicker('getDate');
        var to3 = $('#to3').datepicker('getDate');
        var from4 = $('#from4').datepicker('getDate');
        var to4 = $('#to4').datepicker('getDate');
        var from5 = $('#from5').datepicker('getDate');
        var to5 = $('#to5').datepicker('getDate');
        var from6 = $('#from6').datepicker('getDate');
        var to6 = $('#to6').datepicker('getDate');
        var from7 = $('#from7').datepicker('getDate');
        var to7 = $('#to7').datepicker('getDate');
        var from8 = $('#from8').datepicker('getDate');
        var to8 = $('#to8').datepicker('getDate');
        var from9 = $('#from9').datepicker('getDate');
        var to9 = $('#to9').datepicker('getDate');
        var from10 = $('#from10').datepicker('getDate');
        var to10 = $('#to10').datepicker('getDate');
        months = 0;
        if (to5 < from5) {
            alert("Ending date Must be Greater than starting Date.");
        } else {

            calculate(from1, to1, from2, to2, from3, to3, from4, to4, from5, to5, from6, to6, from7, to7, from8, to8, from9, to9, from10, to10);
        }
    });
    /***************************************************************** For 6 *********************/
    $('body').on('focus', "#from6", function () {
        $(this).datepicker({
//  defaultDate: "+1w",
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
///  $(this).val('');
            var from1 = $('#from1').datepicker('getDate');
            var to1 = $('#to1').datepicker('getDate');
            var from2 = $('#from2').datepicker('getDate');
            var to2 = $('#to2').datepicker('getDate');
            var from3 = $('#from3').datepicker('getDate');
            var to3 = $('#to3').datepicker('getDate');
            var from4 = $('#from4').datepicker('getDate');
            var to4 = $('#to4').datepicker('getDate');
            var from5 = $('#from5').datepicker('getDate');
            var to5 = $('#to5').datepicker('getDate');
            var from6 = $('#from6').datepicker('getDate');
            var to6 = $('#to6').datepicker('getDate');
            var from7 = $('#from7').datepicker('getDate');
            var to7 = $('#to7').datepicker('getDate');
            var from8 = $('#from8').datepicker('getDate');
            var to8 = $('#to8').datepicker('getDate');
            var from9 = $('#from9').datepicker('getDate');
            var to9 = $('#to9').datepicker('getDate');
            var from10 = $('#from10').datepicker('getDate');
            var to10 = $('#to10').datepicker('getDate');
            months = 0;
            calculate(from1, to1, from2, to2, from3, to3, from4, to4, from5, to5, from6, to6, from7, to7, from8, to8, from9, to9, from10, to10);
        });
    });
    $('body').on('focus', "#to6", function () {
        $(this).datepicker({
// defaultDate: "+1w",
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
            var from1 = $('#from1').datepicker('getDate');
            var to1 = $('#to1').datepicker('getDate');
            var from2 = $('#from2').datepicker('getDate');
            var to2 = $('#to2').datepicker('getDate');
            var from3 = $('#from3').datepicker('getDate');
            var to3 = $('#to3').datepicker('getDate');
            var from4 = $('#from4').datepicker('getDate');
            var to4 = $('#to4').datepicker('getDate');
            var from5 = $('#from5').datepicker('getDate');
            var to5 = $('#to5').datepicker('getDate');
            var from6 = $('#from6').datepicker('getDate');
            var to6 = $('#to6').datepicker('getDate');
            var from7 = $('#from7').datepicker('getDate');
            var to7 = $('#to7').datepicker('getDate');
            var from8 = $('#from8').datepicker('getDate');
            var to8 = $('#to8').datepicker('getDate');
            var from9 = $('#from9').datepicker('getDate');
            var to9 = $('#to9').datepicker('getDate');
            var from10 = $('#from10').datepicker('getDate');
            var to10 = $('#to10').datepicker('getDate');
            months = 0;
            if (to6 < from6) {
                alert("Ending date Must be Greater than starting Date.");
            } else {
                calculate(from1, to1, from2, to2, from3, to3, from4, to4, from5, to5, from6, to6, from7, to7, from8, to8, from9, to9, from10, to10);
            }
        });
    });
    /***************************************************************** For 7 *********************/
    $('body').on('focus', "#from7", function () {
        $(this).datepicker({
//  defaultDate: "+1w",
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
///  $(this).val('');
            var from1 = $('#from1').datepicker('getDate');
            var to1 = $('#to1').datepicker('getDate');
            var from2 = $('#from2').datepicker('getDate');
            var to2 = $('#to2').datepicker('getDate');
            var from3 = $('#from3').datepicker('getDate');
            var to3 = $('#to3').datepicker('getDate');
            var from4 = $('#from4').datepicker('getDate');
            var to4 = $('#to4').datepicker('getDate');
            var from5 = $('#from5').datepicker('getDate');
            var to5 = $('#to5').datepicker('getDate');
            var from6 = $('#from6').datepicker('getDate');
            var to6 = $('#to6').datepicker('getDate');
            var from7 = $('#from7').datepicker('getDate');
            var to7 = $('#to7').datepicker('getDate');
            var from8 = $('#from8').datepicker('getDate');
            var to8 = $('#to8').datepicker('getDate');
            var from9 = $('#from9').datepicker('getDate');
            var to9 = $('#to9').datepicker('getDate');
            var from10 = $('#from10').datepicker('getDate');
            var to10 = $('#to10').datepicker('getDate');
            months = 0;
            calculate(from1, to1, from2, to2, from3, to3, from4, to4, from5, to5, from6, to6, from7, to7, from8, to8, from9, to9, from10, to10);
        });
    });
    $('body').on('focus', "#to7", function () {
        $(this).datepicker({
// defaultDate: "+1w",
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
            var from1 = $('#from1').datepicker('getDate');
            var to1 = $('#to1').datepicker('getDate');
            var from2 = $('#from2').datepicker('getDate');
            var to2 = $('#to2').datepicker('getDate');
            var from3 = $('#from3').datepicker('getDate');
            var to3 = $('#to3').datepicker('getDate');
            var from4 = $('#from4').datepicker('getDate');
            var to4 = $('#to4').datepicker('getDate');
            var from5 = $('#from5').datepicker('getDate');
            var to5 = $('#to5').datepicker('getDate');
            var from6 = $('#from6').datepicker('getDate');
            var to6 = $('#to6').datepicker('getDate');
            var from7 = $('#from7').datepicker('getDate');
            var to7 = $('#to7').datepicker('getDate');
            var from8 = $('#from8').datepicker('getDate');
            var to8 = $('#to8').datepicker('getDate');
            var from9 = $('#from9').datepicker('getDate');
            var to9 = $('#to9').datepicker('getDate');
            var from10 = $('#from10').datepicker('getDate');
            var to10 = $('#to10').datepicker('getDate');
            months = 0;
            if (to7 < from7) {
                alert("Ending date Must be Greater than starting Date.");
            } else {
                calculate(from1, to1, from2, to2, from3, to3, from4, to4, from5, to5, from6, to6, from7, to7, from8, to8, from9, to9, from10, to10);
            }
        });
    });
    /***************************************************************** For 8 *********************/
    $('body').on('focus', "#from8", function () {
        $(this).datepicker({
//  defaultDate: "+1w",
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
///  $(this).val('');
            var from1 = $('#from1').datepicker('getDate');
            var to1 = $('#to1').datepicker('getDate');
            var from2 = $('#from2').datepicker('getDate');
            var to2 = $('#to2').datepicker('getDate');
            var from3 = $('#from3').datepicker('getDate');
            var to3 = $('#to3').datepicker('getDate');
            var from4 = $('#from4').datepicker('getDate');
            var to4 = $('#to4').datepicker('getDate');
            var from5 = $('#from5').datepicker('getDate');
            var to5 = $('#to5').datepicker('getDate');
            var from6 = $('#from6').datepicker('getDate');
            var to6 = $('#to6').datepicker('getDate');
            var from7 = $('#from7').datepicker('getDate');
            var to7 = $('#to7').datepicker('getDate');
            var from8 = $('#from8').datepicker('getDate');
            var to8 = $('#to8').datepicker('getDate');
            var from9 = $('#from9').datepicker('getDate');
            var to9 = $('#to9').datepicker('getDate');
            var from10 = $('#from10').datepicker('getDate');
            var to10 = $('#to10').datepicker('getDate');
            months = 0;
            calculate(from1, to1, from2, to2, from3, to3, from4, to4, from5, to5, from6, to6, from7, to7, from8, to8, from9, to9, from10, to10);
        });
    });
    $('body').on('focus', "#to8", function () {
        $(this).datepicker({
// defaultDate: "+1w",
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
            var from1 = $('#from1').datepicker('getDate');
            var to1 = $('#to1').datepicker('getDate');
            var from2 = $('#from2').datepicker('getDate');
            var to2 = $('#to2').datepicker('getDate');
            var from3 = $('#from3').datepicker('getDate');
            var to3 = $('#to3').datepicker('getDate');
            var from4 = $('#from4').datepicker('getDate');
            var to4 = $('#to4').datepicker('getDate');
            var from5 = $('#from5').datepicker('getDate');
            var to5 = $('#to5').datepicker('getDate');
            var from6 = $('#from6').datepicker('getDate');
            var to6 = $('#to6').datepicker('getDate');
            var from7 = $('#from7').datepicker('getDate');
            var to7 = $('#to7').datepicker('getDate');
            var from8 = $('#from8').datepicker('getDate');
            var to8 = $('#to8').datepicker('getDate');
            var from9 = $('#from9').datepicker('getDate');
            var to9 = $('#to9').datepicker('getDate');
            var from10 = $('#from10').datepicker('getDate');
            var to10 = $('#to10').datepicker('getDate');
            months = 0;
            if (to8 < from8) {
                alert("Ending date Must be Greater than starting Date.");
            } else {
                calculate(from1, to1, from2, to2, from3, to3, from4, to4, from5, to5, from6, to6, from7, to7, from8, to8, from9, to9, from10, to10);
            }
        });
    });
    /***************************************************************** For 9 *********************/
    $('body').on('focus', "#from9", function () {
        $(this).datepicker({
//  defaultDate: "+1w",
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
///  $(this).val('');
            var from1 = $('#from1').datepicker('getDate');
            var to1 = $('#to1').datepicker('getDate');
            var from2 = $('#from2').datepicker('getDate');
            var to2 = $('#to2').datepicker('getDate');
            var from3 = $('#from3').datepicker('getDate');
            var to3 = $('#to3').datepicker('getDate');
            var from4 = $('#from4').datepicker('getDate');
            var to4 = $('#to4').datepicker('getDate');
            var from5 = $('#from5').datepicker('getDate');
            var to5 = $('#to5').datepicker('getDate');
            var from6 = $('#from6').datepicker('getDate');
            var to6 = $('#to6').datepicker('getDate');
            var from7 = $('#from7').datepicker('getDate');
            var to7 = $('#to7').datepicker('getDate');
            var from8 = $('#from8').datepicker('getDate');
            var to8 = $('#to8').datepicker('getDate');
            var from9 = $('#from9').datepicker('getDate');
            var to9 = $('#to9').datepicker('getDate');
            var from10 = $('#from10').datepicker('getDate');
            var to10 = $('#to10').datepicker('getDate');
            months = 0;
            calculate(from1, to1, from2, to2, from3, to3, from4, to4, from5, to5, from6, to6, from7, to7, from8, to8, from9, to9, from10, to10);
        });
    });
    $('body').on('focus', "#to9", function () {
        $(this).datepicker({
// defaultDate: "+1w",
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
            var from1 = $('#from1').datepicker('getDate');
            var to1 = $('#to1').datepicker('getDate');
            var from2 = $('#from2').datepicker('getDate');
            var to2 = $('#to2').datepicker('getDate');
            var from3 = $('#from3').datepicker('getDate');
            var to3 = $('#to3').datepicker('getDate');
            var from4 = $('#from4').datepicker('getDate');
            var to4 = $('#to4').datepicker('getDate');
            var from5 = $('#from5').datepicker('getDate');
            var to5 = $('#to5').datepicker('getDate');
            var from6 = $('#from6').datepicker('getDate');
            var to6 = $('#to6').datepicker('getDate');
            var from7 = $('#from7').datepicker('getDate');
            var to7 = $('#to7').datepicker('getDate');
            var from8 = $('#from8').datepicker('getDate');
            var to8 = $('#to8').datepicker('getDate');
            var from9 = $('#from9').datepicker('getDate');
            var to9 = $('#to9').datepicker('getDate');
            var from10 = $('#from10').datepicker('getDate');
            var to10 = $('#to10').datepicker('getDate');
            months = 0;
            if (to9 < from9) {
                alert("Ending date Must be Greater than starting Date.");
            } else {
                calculate(from1, to1, from2, to2, from3, to3, from4, to4, from5, to5, from6, to6, from7, to7, from8, to8, from9, to9, from10, to10);
            }
        });
    });
    /***************************************************************** For 10 *********************/
    $('body').on('focus', "#from10", function () {
        $(this).datepicker({
//  defaultDate: "+1w",
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
///  $(this).val('');
            var from1 = $('#from1').datepicker('getDate');
            var to1 = $('#to1').datepicker('getDate');
            var from2 = $('#from2').datepicker('getDate');
            var to2 = $('#to2').datepicker('getDate');
            var from3 = $('#from3').datepicker('getDate');
            var to3 = $('#to3').datepicker('getDate');
            var from4 = $('#from4').datepicker('getDate');
            var to4 = $('#to4').datepicker('getDate');
            var from5 = $('#from5').datepicker('getDate');
            var to5 = $('#to5').datepicker('getDate');
            var from6 = $('#from6').datepicker('getDate');
            var to6 = $('#to6').datepicker('getDate');
            var from7 = $('#from7').datepicker('getDate');
            var to7 = $('#to7').datepicker('getDate');
            var from8 = $('#from8').datepicker('getDate');
            var to8 = $('#to8').datepicker('getDate');
            var from9 = $('#from9').datepicker('getDate');
            var to9 = $('#to9').datepicker('getDate');
            var from10 = $('#from10').datepicker('getDate');
            var to10 = $('#to10').datepicker('getDate');
            months = 0;
            calculate(from1, to1, from2, to2, from3, to3, from4, to4, from5, to5, from6, to6, from7, to7, from8, to8, from9, to9, from10, to10);
        });
    });
    $('body').on('focus', "#to10", function () {
        $(this).datepicker({
// defaultDate: "+1w",
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
            var from1 = $('#from1').datepicker('getDate');
            var to1 = $('#to1').datepicker('getDate');
            var from2 = $('#from2').datepicker('getDate');
            var to2 = $('#to2').datepicker('getDate');
            var from3 = $('#from3').datepicker('getDate');
            var to3 = $('#to3').datepicker('getDate');
            var from4 = $('#from4').datepicker('getDate');
            var to4 = $('#to4').datepicker('getDate');
            var from5 = $('#from5').datepicker('getDate');
            var to5 = $('#to5').datepicker('getDate');
            var from6 = $('#from6').datepicker('getDate');
            var to6 = $('#to6').datepicker('getDate');
            var from7 = $('#from7').datepicker('getDate');
            var to7 = $('#to7').datepicker('getDate');
            var from8 = $('#from8').datepicker('getDate');
            var to8 = $('#to8').datepicker('getDate');
            var from9 = $('#from9').datepicker('getDate');
            var to9 = $('#to9').datepicker('getDate');
            var from10 = $('#from10').datepicker('getDate');
            var to10 = $('#to10').datepicker('getDate');
            months = 0;
            if (to10 < from10) {
                alert("Ending date Must be Greater than starting Date.");
            } else {
                calculate(from1, to1, from2, to2, from3, to3, from4, to4, from5, to5, from6, to6, from7, to7, from8, to8, from9, to9, from10, to10);
            }
        });
    });
    function calculate(from1, to1, from2, to2, from3, to3, from4, to4, from5, to5, from6, to6, from7, to7, from8, to8, from9, to9, from10, to10) {

        if (from1 != null && to1 != null) {
            from1 = new Date(from1);
            to1 = new Date(to1);
            var diff1 = Math.floor(to1.getTime() - from1.getTime());
            var f_month1 = from1.getMonth() + 1;
            var t_month1 = to1.getMonth() + 1;
            var tyear11 = 0;
            var tyear12 = 0;
            var f_year1 = from1.getFullYear();
            var t_year1 = to1.getFullYear();
            days = Math.floor(diff1 / day);
            days1 = days;
            if (f_year1 == t_year1) {
                i = 0;
                for (i = f_month1; i <= t_month1; i++)
                {
                    switch_function(i, f_year1);
                    days1 = days;
                }
            } else {

                for (i = f_month1; i <= 12; i++)
                {
                    switch_function(i, f_year1);
                    days1 = days;
                }

                for (i = 1; i <= t_month1; i++)
                {
                    switch_function(i, t_year1);
                    days1 = days;
                }

                tyear11 = f_year1;
                tyear12 = t_year1;
                tyear11++;
                tyear12--;
                for (i = tyear11; i <= tyear12; i++) {

                    if (((i % 4 == 0) &&
                            !(i % 100 == 0))
                            || (i % 400 == 0))
                    {
                        if (days >= 29) {
                            days = days - 29;
                            days1 = days;
                            months++;
                        }
                    } else
                    {
                        if (days >= 28) {
                            days = days - 28;
                            days1 = days;
                            months++;
                        }

                    }
                    for (var j = 1; j <= 12; j++) {
                        switch (j)
                        {
                            case 1:
                            case 3:
                            case 5:
                            case 7:
                            case 8:
                            case 10:
                            case 12:
                                if (days >= 31) {
                                    days = days - 31;
                                    days1 = days;
                                    months++;
                                }
                                break;
                            case 4:
                            case 6:
                            case 9:
                            case 11:
                                if (days >= 30) {
                                    days = days - 30;
                                    days1 = days;
                                    months++;
                                }
                                break;
                            default:
                                break;
                        }
                    }
                }
            }
        }
        if (from2 != null && to2 != null) {
            from2 = new Date(from2);
            to2 = new Date(to2);
            var diff2 = Math.floor(to2.getTime() - from2.getTime());
            var f_month2 = from2.getMonth() + 1;
            var t_month2 = to2.getMonth() + 1;
            var f_year2 = from2.getFullYear();
            var t_year2 = to2.getFullYear();
            var tyear21 = 0;
            var tyear22 = 0;
            days = Math.floor(diff2 / day);
            days2 = days;
            if (f_year2 == t_year2) {
                i = 0;
                for (i = f_month2; i <= t_month2; i++)
                {
                    switch_function(i, f_year2);
                    days2 = days;
                }
            } else {

                for (i = f_month2; i <= 12; i++)
                {
                    switch_function(i, f_year2);
                    days2 = days;
                }

                for (i = 1; i <= t_month2; i++)
                {
                    switch_function(i, t_year2);
                    days2 = days;
                }

                tyear21 = f_year2;
                tyear22 = t_year2;
                tyear21++;
                tyear22--;
                for (i = tyear21; i <= tyear22; i++) {

                    if (((i % 4 == 0) &&
                            !(i % 100 == 0))
                            || (i % 400 == 0))
                    {
                        if (days >= 29) {
                            days = days - 29;
                            days2 = days;
                            months++;
                        }
                    } else
                    {
                        if (days >= 28) {
                            days = days - 28;
                            days2 = days;
                            months++;
                        }

                    }
                    for (var j = 1; j <= 12; j++) {
                        switch (j)
                        {
                            case 1:
                            case 3:
                            case 5:
                            case 7:
                            case 8:
                            case 10:
                            case 12:
                                if (days >= 31) {
                                    days = days - 31;
                                    days2 = days;
                                    months++;
                                }
                                break;
                            case 4:
                            case 6:
                            case 9:
                            case 11:
                                if (days >= 30) {
                                    days = days - 30;
                                    days2 = days;
                                    months++;
                                }
                                break;
                            default:
                                break;
                        }
                    }
                }
            }


        }

        if (from3 != null && to3 != null) {
            from3 = new Date(from3);
            to3 = new Date(to3);
            var diff3 = Math.floor(to3.getTime() - from3.getTime());
            var f_month3 = from3.getMonth() + 1;
            var t_month3 = to3.getMonth() + 1;
            var f_year3 = from3.getFullYear();
            var t_year3 = to3.getFullYear();
            var tyear31 = 0;
            var tyear32 = 0;
            days = Math.floor(diff3 / day);
            days3 = days;
            if (f_year3 == t_year3) {
                i = 0;
                for (i = f_month3; i <= t_month3; i++)
                {
                    switch_function(i, f_year3);
                    days3 = days;
                }
            } else {

                for (i = f_month3; i <= 12; i++)
                {
                    switch_function(i, f_year3);
                    days3 = days;
                }

                for (i = 1; i <= t_month3; i++)
                {
                    switch_function(i, t_year3);
                    days3 = days;
                }

                tyear31 = f_year3;
                tyear32 = t_year3;
                tyear31++;
                tyear32--;
                for (i = tyear31; i <= tyear32; i++) {

                    if (((i % 4 == 0) &&
                            !(i % 100 == 0))
                            || (i % 400 == 0))
                    {
                        if (days >= 29) {
                            days = days - 29;
                            days3 = days;
                            months++;
                        }
                    } else
                    {
                        if (days >= 28) {
                            days = days - 28;
                            days3 = days;
                            months++;
                        }

                    }
                    for (var j = 1; j <= 12; j++) {
                        switch (j)
                        {
                            case 1:
                            case 3:
                            case 5:
                            case 7:
                            case 8:
                            case 10:
                            case 12:
                                if (days >= 31) {
                                    days = days - 31;
                                    days3 = days;
                                    months++;
                                }
                                break;
                            case 4:
                            case 6:
                            case 9:
                            case 11:
                                if (days >= 30) {
                                    days = days - 30;
                                    days3 = days;
                                    months++;
                                }
                                break;
                            default:
                                break;
                        }
                    }
                }
            }

        }

        if (from4 != null && to4 != null) {
            from4 = new Date(from4);
            to4 = new Date(to4);
            var diff4 = Math.floor(to4.getTime() - from4.getTime());
            var f_month4 = from4.getMonth() + 1;
            var t_month4 = to4.getMonth() + 1;
            var f_year4 = from4.getFullYear();
            var t_year4 = to4.getFullYear();
            var tyear41 = 0;
            var tyear42 = 0;
            days = Math.floor(diff4 / day);
            days4 = days;
            if (f_year4 == t_year4) {
                i = 0;
                for (i = f_month4; i <= t_month4; i++)
                {
                    switch_function(i, f_year4);
                    days4 = days;
                }
            } else {

                for (i = f_month4; i <= 12; i++)
                {
                    switch_function(i, f_year4);
                    days4 = days;
                }

                for (i = 1; i <= t_month4; i++)
                {
                    switch_function(i, t_year4);
                    days4 = days;
                }

                tyear41 = f_year4;
                tyear42 = t_year4;
                tyear41++;
                tyear42--;
                for (i = tyear41; i <= tyear42; i++) {

                    if (((i % 4 == 0) &&
                            !(i % 100 == 0))
                            || (i % 400 == 0))
                    {
                        if (days >= 29) {
                            days = days - 29;
                            days4 = days;
                            months++;
                        }
                    } else
                    {
                        if (days >= 28) {
                            days = days - 28;
                            days4 = days;
                            months++;
                        }

                    }
                    for (var j = 1; j <= 12; j++) {
                        switch (j)
                        {
                            case 1:
                            case 3:
                            case 5:
                            case 7:
                            case 8:
                            case 10:
                            case 12:
                                if (days >= 31) {
                                    days = days - 31;
                                    days4 = days;
                                    months++;
                                }
                                break;
                            case 4:
                            case 6:
                            case 9:
                            case 11:
                                if (days >= 30) {
                                    days = days - 30;
                                    days4 = days;
                                    months++;
                                }
                                break;
                            default:
                                break;
                        }
                    }
                }
            }

        }

        if (from5 != null && to5 != null) {
            from5 = new Date(from5);
            to5 = new Date(to5);
            var diff5 = Math.floor(to5.getTime() - from5.getTime());
            var f_month5 = from5.getMonth() + 1;
            var t_month5 = to5.getMonth() + 1;
            var f_year5 = from5.getFullYear();
            var t_year5 = to5.getFullYear();
            var tyear51 = 0;
            var tyear52 = 0;
            days = Math.floor(diff5 / day);
            days5 = days;
            if (f_year5 == t_year5) {
                i = 0;
                for (i = f_month5; i <= t_month5; i++)
                {
                    switch_function(i, f_year5);
                    days5 = days;
                }
            } else {

                for (i = f_month5; i <= 12; i++)
                {
                    switch_function(i, f_year5);
                    days5 = days;
                }

                for (i = 1; i <= t_month5; i++)
                {
                    switch_function(i, t_year5);
                    days5 = days;
                }

                tyear51 = f_year5;
                tyear52 = t_year5;
                tyear51++;
                tyear52--;
                for (i = tyear51; i <= tyear52; i++) {

                    if (((i % 4 == 0) &&
                            !(i % 100 == 0))
                            || (i % 400 == 0))
                    {
                        if (days >= 29) {
                            days = days - 29;
                            days5 = days;
                            months++;
                        }
                    } else
                    {
                        if (days >= 28) {
                            days = days - 28;
                            days5 = days;
                            months++;
                        }

                    }
                    for (var j = 1; j <= 12; j++) {
                        switch (j)
                        {
                            case 1:
                            case 3:
                            case 5:
                            case 7:
                            case 8:
                            case 10:
                            case 12:
                                if (days >= 31) {
                                    days = days - 31;
                                    days5 = days;
                                    months++;
                                }
                                break;
                            case 4:
                            case 6:
                            case 9:
                            case 11:
                                if (days >= 30) {
                                    days = days - 30;
                                    days5 = days;
                                    months++;
                                }
                                break;
                            default:
                                break;
                        }
                    }
                }
            }

        }


        if (from6 != null && to6 != null) {

            from6 = new Date(from6);
            to6 = new Date(to6);
            var diff6 = Math.floor(to6.getTime() - from6.getTime());
            var f_month6 = from6.getMonth() + 1;
            var t_month6 = to6.getMonth() + 1;
            var f_year6 = from6.getFullYear();
            var t_year6 = to6.getFullYear();
            var tyear61 = 0;
            var tyear62 = 0;
            days = Math.floor(diff6 / day);
            days6 = days;
            if (f_year6 == t_year6) {
                i = 0;
                for (i = f_month6; i <= t_month6; i++)
                {
                    switch_function(i, f_year6);
                    days6 = days;
                }
            } else {

                for (i = f_month6; i <= 12; i++)
                {
                    switch_function(i, f_year6);
                    days6 = days;
                }

                for (i = 1; i <= t_month6; i++)
                {
                    switch_function(i, t_year6);
                    days6 = days;
                }

                tyear61 = f_year6;
                tyear62 = t_year6;
                tyear61++;
                tyear62--;
                for (i = tyear61; i <= tyear62; i++) {

                    if (((i % 4 == 0) &&
                            !(i % 100 == 0))
                            || (i % 400 == 0))
                    {
                        if (days >= 29) {
                            days = days - 29;
                            days6 = days;
                            months++;
                        }
                    } else
                    {
                        if (days >= 28) {
                            days = days - 28;
                            days6 = days;
                            months++;
                        }

                    }
                    for (var j = 1; j <= 12; j++) {
                        switch (j)
                        {
                            case 1:
                            case 3:
                            case 5:
                            case 7:
                            case 8:
                            case 10:
                            case 12:
                                if (days >= 31) {
                                    days = days - 31;
                                    days6 = days;
                                    months++;
                                }
                                break;
                            case 4:
                            case 6:
                            case 9:
                            case 11:
                                if (days >= 30) {
                                    days = days - 30;
                                    days6 = days;
                                    months++;
                                }
                                break;
                            default:
                                break;
                        }
                    }
                }
            }
        }

        if (from7 != null && to7 != null) {

            from7 = new Date(from7);
            to7 = new Date(to7);
            var diff7 = Math.floor(to7.getTime() - from7.getTime());
            var f_month7 = from7.getMonth() + 1;
            var t_month7 = to7.getMonth() + 1;
            var f_year7 = from7.getFullYear();
            var t_year7 = to7.getFullYear();
            var tyear71 = 0;
            var tyear72 = 0;
            days = Math.floor(diff7 / day);
            days7 = days;
            if (f_year7 == t_year7) {
                i = 0;
                for (i = f_month7; i <= t_month7; i++)
                {
                    switch_function(i, f_year7);
                    days7 = days;
                }
            } else {

                for (i = f_month7; i <= 12; i++)
                {
                    switch_function(i, f_year7);
                    days7 = days;
                }

                for (i = 1; i <= t_month7; i++)
                {
                    switch_function(i, t_year7);
                    days7 = days;
                }

                tyear71 = f_year7;
                tyear72 = t_year7;
                tyear71++;
                tyear72--;
                for (i = tyear71; i <= tyear72; i++) {

                    if (((i % 4 == 0) &&
                            !(i % 100 == 0))
                            || (i % 400 == 0))
                    {
                        if (days >= 29) {
                            days = days - 29;
                            days7 = days;
                            months++;
                        }
                    } else
                    {
                        if (days >= 28) {
                            days = days - 28;
                            days7 = days;
                            months++;
                        }

                    }
                    for (var j = 1; j <= 12; j++) {
                        switch (j)
                        {
                            case 1:
                            case 3:
                            case 5:
                            case 7:
                            case 8:
                            case 10:
                            case 12:
                                if (days >= 31) {
                                    days = days - 31;
                                    days7 = days;
                                    months++;
                                }
                                break;
                            case 4:
                            case 6:
                            case 9:
                            case 11:
                                if (days >= 30) {
                                    days = days - 30;
                                    days7 = days;
                                    months++;
                                }
                                break;
                            default:
                                break;
                        }
                    }
                }
            }
        }

        if (from8 != null && to8 != null) {
            from8 = new Date(from8);
            to8 = new Date(to8);
            var diff8 = Math.floor(to8.getTime() - from8.getTime());
            var f_month8 = from8.getMonth() + 1;
            var t_month8 = to8.getMonth() + 1;
            var f_year8 = from8.getFullYear();
            var t_year8 = to8.getFullYear();
            var tyear81 = 0;
            var tyear82 = 0;
            days = Math.floor(diff8 / day);
            days8 = days;
            if (f_year8 == t_year8) {
                i = 0;
                for (i = f_month8; i <= t_month8; i++)
                {
                    switch_function(i, f_year8);
                    days8 = days;
                }
            } else {

                for (i = f_month8; i <= 12; i++)
                {
                    switch_function(i, f_year8);
                    days8 = days;
                }

                for (i = 1; i <= t_month8; i++)
                {
                    switch_function(i, t_year8);
                    days8 = days;
                }

                tyear81 = f_year8;
                tyear82 = t_year8;
                tyear81++;
                tyear82--;
                for (i = tyear81; i <= tyear82; i++) {

                    if (((i % 4 == 0) &&
                            !(i % 100 == 0))
                            || (i % 400 == 0))
                    {
                        if (days >= 29) {
                            days = days - 29;
                            days8 = days;
                            months++;
                        }
                    } else
                    {
                        if (days >= 28) {
                            days = days - 28;
                            days8 = days;
                            months++;
                        }

                    }
                    for (var j = 1; j <= 12; j++) {
                        switch (j)
                        {
                            case 1:
                            case 3:
                            case 5:
                            case 7:
                            case 8:
                            case 10:
                            case 12:
                                if (days >= 31) {
                                    days = days - 31;
                                    days8 = days;
                                    months++;
                                }
                                break;
                            case 4:
                            case 6:
                            case 9:
                            case 11:
                                if (days >= 30) {
                                    days = days - 30;
                                    days8 = days;
                                    months++;
                                }
                                break;
                            default:
                                break;
                        }
                    }
                }
            }

        }

        if (from9 != null && to9 != null) {
            from9 = new Date(from9);
            to9 = new Date(to9);
            var diff9 = Math.floor(to9.getTime() - from9.getTime());
            var f_month9 = from9.getMonth() + 1;
            var t_month9 = to9.getMonth() + 1;
            var f_year9 = from9.getFullYear();
            var t_year9 = to9.getFullYear();
            var tyear91 = 0;
            var tyear92 = 0;
            days = Math.floor(diff9 / day);
            days9 = days;
            if (f_year9 == t_year9) {
                i = 0;
                for (i = f_month9; i <= t_month9; i++)
                {
                    switch_function(i, f_year9);
                    days9 = days;
                }
            } else {

                for (i = f_month9; i <= 12; i++)
                {
                    switch_function(i, f_year9);
                    days9 = days;
                }

                for (i = 1; i <= t_month9; i++)
                {
                    switch_function(i, t_year9);
                    days9 = days;
                }

                tyear91 = f_year9;
                tyear92 = t_year9;
                tyear91++;
                tyear92--;
                for (i = tyear91; i <= tyear92; i++) {

                    if (((i % 4 == 0) &&
                            !(i % 100 == 0))
                            || (i % 400 == 0))
                    {
                        if (days >= 29) {
                            days = days - 29;
                            days9 = days;
                            months++;
                        }
                    } else
                    {
                        if (days >= 28) {
                            days = days - 28;
                            days9 = days;
                            months++;
                        }

                    }
                    for (var j = 1; j <= 12; j++) {
                        switch (j)
                        {
                            case 1:
                            case 3:
                            case 5:
                            case 7:
                            case 8:
                            case 10:
                            case 12:
                                if (days >= 31) {
                                    days = days - 31;
                                    days9 = days;
                                    months++;
                                }
                                break;
                            case 4:
                            case 6:
                            case 9:
                            case 11:
                                if (days >= 30) {
                                    days = days - 30;
                                    days9 = days;
                                    months++;
                                }
                                break;
                            default:
                                break;
                        }
                    }
                }
            }

        }

        if (from10 != null && to10 != null) {
            from10 = new Date(from10);
            to10 = new Date(to10);
            var diff10 = Math.floor(to10.getTime() - from10.getTime());
            var f_month10 = from10.getMonth() + 1;
            var t_month10 = to10.getMonth() + 1;
            var f_year10 = from10.getFullYear();
            var t_year10 = to10.getFullYear();
            var tyear101 = 0;
            var tyear102 = 0;
            days = Math.floor(diff10 / day);
            days10 = days;
            if (f_year10 == t_year10) {
                i = 0;
                for (i = f_month10; i <= t_month10; i++)
                {
                    switch_function(i, f_year10);
                    days10 = days;
                }
            } else {

                for (i = f_month10; i <= 12; i++)
                {
                    switch_function(i, f_year10);
                    days10 = days;
                }

                for (i = 1; i <= t_month10; i++)
                {
                    switch_function(i, t_year10);
                    days10 = days;
                }

                tyear101 = f_year10;
                tyear102 = t_year10;
                tyear101++;
                tyear102--;
                for (i = tyear101; i <= tyear102; i++) {

                    if (((i % 4 == 0) &&
                            !(i % 100 == 0))
                            || (i % 400 == 0))
                    {
                        if (days >= 29) {
                            days = days - 29;
                            days10 = days;
                            months++;
                        }
                    } else
                    {
                        if (days >= 28) {
                            days = days - 28;
                            days10 = days;
                            months++;
                        }

                    }
                    for (var j = 1; j <= 12; j++) {
                        switch (j)
                        {
                            case 1:
                            case 3:
                            case 5:
                            case 7:
                            case 8:
                            case 10:
                            case 12:
                                if (days >= 31) {
                                    days = days - 31;
                                    days10 = days;
                                    months++;
                                }
                                break;
                            case 4:
                            case 6:
                            case 9:
                            case 11:
                                if (days >= 30) {
                                    days = days - 30;
                                    days10 = days;
                                    months++;
                                }
                                break;
                            default:
                                break;
                        }
                    }
                }
            }
        }


        function switch_function(i, year)
        {
            switch (i)
            {
                case 1:
                case 3:
                case 5:
                case 7:
                case 8:
                case 10:
                case 12:
                    if (days >= 31) {
                        days = days - 31;
                        months++;
                    }
                    break;
                case 4:
                case 6:
                case 9:
                case 11:
                    if (days >= 30) {
                        days = days - 30;
                        months++;
                    }
                    break;
                case 2:
                    if (((year % 4 == 0) &&
                            !(year % 100 == 0))
                            || (year % 400 == 0))
                    {
                        if (days >= 29) {
                            days = days - 29;
                            months++;
                        }
                    } else
                    {
                        if (days >= 28) {
                            days = days - 28;
                            months++;
                        }

                    }
                    break;
                default:
                    break;
            }
        }
        var check_month = (months % 2);
        if (check_month == 0) {
            years = parseInt(months / 12);
            months = Number(months % 12);
        } else {
            years = parseInt(months / 12);
            months = Number(months % 12);
        }

        years = ('0' + years).slice(-2);
        //  t_days = days1 + days2;
        t_days = days1 + days2 + days3 + days4 + days5 + days6 + days7 + days8 + days9 + days10;
        if (t_days > 30) {
            m_val = parseInt(t_days / 30);
            d_val = Number(t_days % 30);
            months = months + m_val;
            days = d_val;
        } else {
            days = t_days;
        }

        months = ('0' + months).slice(-2);
        days = ('0' + days).slice(-2);
        $('#total_exp').html(years + " Years " + months + " months " + days + " days");
        document.getElementById("exp_count").value = years + " Years " + months + " months " + days + " days";

    }

});




