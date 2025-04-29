$(document).ready(function () {
  $("#expr_table").on("change", ".org", function () {
    var id = $(this).attr("id").replace("org", "");
    if ($(this).val() != "") {
      $("#pos" + id).attr("required", true);
      $("#from" + id).attr("required", true);
      $("#to" + id).attr("required", true);
      $("#nature" + id).attr("required", true);
      $("#pay" + id).attr("required", true);
      $("#otype" + id).attr("required", true);
      $("#exp_file" + id).attr("required", true);
    } else {
      $("#pos" + id).removeAttr("required");
      $("#from" + id).removeAttr("required");
      $("#to" + id).removeAttr("required");
      $("#nature" + id).removeAttr("required");
      $("#pay" + id).removeAttr("required");
      $("#otype" + id).removeAttr("required");
      $("#exp_file" + id).removeAttr("required");
    }
  });
  //     $("#caste").on("change", function () {
  //         var val = document.getElementById("caste").value;
  //         if (val == 'OBC') {
  //             $('#caste_certi').attr('required', true);
  //             $('#issue_year').attr('required', true);
  //             $('#certi_no').attr('required', true);
  //             $("#obc").show();
  //             $("#scst").hide();
  //         } else if (val == 'ST' || val == 'SC') {
  // //            $('#caste_certi').attr('required', true);
  // //            $('#issue_year').attr('required', true);
  // //            $('#certi_no').attr('required', true);
  //             $("#scst").show();
  //             $("#obc").hide();
  //         } else if (val == 'EWS') {
  // //            $('#caste_certi').attr('required', true);
  // //            $('#issue_year').attr('required', true);
  // //            $('#certi_no').attr('required', true);
  //             $("#scst").hide();
  //             $("#obc").hide();
  //         } else if (val == 'Ex-servicemen') {
  //             $('#service_from_date').attr('required', true);
  //             $('#service_to_date').attr('required', true);
  //             $("#scst").hide();
  //             $("#obc").hide();
  //         } else {
  //             $('#caste_certi').attr('required', false);
  //             $('#issue_year').attr('required', false);
  //             $('#certi_no').attr('required', false);
  //             $("#scst").hide();
  //             $("#obc").hide();
  //         }
  //     });
  $(document).on("change", "#caste", function () {
    var val = document.getElementById("caste").value;

    if (val == "OBC") {
      $("#caste_certi").attr("required", true);
      $("#issue_year").attr("required", true);
      $("#certi_no").attr("required", true);
      $("#obc").show();
      $("#scst").hide();
    } else if (val == "ST" || val == "SC") {
      // $('#caste_certi').attr('required', true);
      // $('#issue_year').attr('required', true);
      // $('#certi_no').attr('required', true);
      $("#scst").show();
      $("#obc").hide();
    } else if (val == "EWS") {
      // $('#caste_certi').attr('required', true);
      // $('#issue_year').attr('required', true);
      // $('#certi_no').attr('required', true);
      $("#scst").hide();
      $("#obc").hide();
    } else if (val == "Ex-servicemen") {
      $("#service_from_date").attr("required", true);
      $("#service_to_date").attr("required", true);
      $("#scst").hide();
      $("#obc").hide();
    } else {
      $("#caste_certi").attr("required", false);
      $("#issue_year").attr("required", false);
      $("#certi_no").attr("required", false);
      $("#scst").hide();
      $("#obc").hide();
    }
  });

  $("#post").on("change", function () {
    var val1 = document.getElementById("post").value;
    if (val1 == "CCTAdmin-2-2023") {
      $("#stenoGraphy_speed").attr("required", false);
      $("#stenography_certi_no").attr("required", false);
      $("#stenography_certi_date").attr("required", false);
      $("#stenography_certi").attr("required", false);
      $("#typing_speed").attr("required", true);
      $("#typing_certi_no").attr("required", true);
      $("#typing_certi_date").attr("required", true);
      $("#typing_certi").attr("required", true);
      $("#typing_div").hide();
      $("#typing_div1").show();
      $("#typing_type").show();
    } else if (val1 == "PSAdmin-2-2023") {
      $("#stenoGraphy_speed").attr("required", true);
      $("#stenography_certi_no").attr("required", true);
      $("#stenography_certi_date").attr("required", true);
      $("#stenography_certi").attr("required", true);
      $("#typing_speed").attr("required", true);
      $("#typing_certi_no").attr("required", true);
      $("#typing_certi_date").attr("required", true);
      $("#typing_certi").attr("required", true);
      //            $('#type_of_service').attr('required', true);
      //            $("#service_div").show();
      $("#typing_div").show();
      $("#typing_div1").show();
      $("#typing_type").hide();
    } else {
      $("#stenoGraphy_speed").attr("required", false);
      $("#stenography_certi_no").attr("required", false);
      $("#stenography_certi_date").attr("required", false);
      $("#stenography_certi").attr("required", false);
      $("#typing_speed").attr("required", false);
      $("#typing_certi_no").attr("required", false);
      $("#typing_certi_date").attr("required", false);
      $("#typing_certi").attr("required", false);
      //            $('#type_of_service').attr('required', false);
      //            $("#service_div").hide();
      $("#typing_div").hide();
      $("#typing_div1").hide();
      $("#typing_type").hide();
    }
  });
  $("#serving").on("change", function () {
    var val = document.getElementById("serving").value;
    if (val == "Yes") {
      $("#type_of_service").attr("required", true);
      $("#service_div").show();
    } else {
      $("#type_of_service").attr("required", false);
      $("#type_of_job").attr("required", false);
      $("#service_div").hide();
      $("#job_type_div").hide();
    }
  });
  $("#type_of_service").on("change", function () {
    var val = document.getElementById("type_of_service").value;
    if (val != "Not Applicable" && val != "") {
      $("#type_of_job").attr("required", true);
      $("#job_type_div").show();
    } else {
      $("#type_of_job").attr("required", false);
      $("#job_type_div").hide();
    }
  });
  $("#current_working").on("click", function () {
    var tdt_1 = $("#to1").val();
    const to_date = new Date();
    let currentDay = String(to_date.getDate()).padStart(2, "0");
    let currentMonth = String(to_date.getMonth() + 1).padStart(2, "0");
    let currentYear = to_date.getFullYear();
    let currentDate = `${currentDay}/${currentMonth}/${currentYear}`;

    if ($(this).prop("checked") == true) {
      $("#to1").val(currentDate);
      $("#to1").datepicker("destroy");
      var fdt = stringToDate($("#from1").val(), "dd/MM/yyyy", "/");
      var tdt = stringToDate($("#to1").val(), "dd/MM/yyyy", "/");
      $("#diff1").val(getAge(fdt, tdt));
      CalculateTotalExp();
    } else {
      $("#to1").val("");
      $("#diff1").val("");
      sessionStorage.removeItem("grandtotal");
      $("#total_exp").html("");
      $("#exp_count").val("");
      $("#to1")
        .datepicker({
          changeMonth: true,
          dateFormat: "dd/mm/yy",
          changeYear: true,
          yearRange: "-50:+0",
          maxDate: 0,
          onClose: function (selectedDate) {},
          onSelect: function (dateStr) {
            $(this).change();
          },
        })
        .on("change", function () {
          var from1 = $("#from1").datepicker("getDate");
          var to1 = $("#to1").datepicker("getDate");
          months = 0;
          if (to1 < from1) {
            alert("Ending date Must be Greater than starting Date.");
          } else {
            CalculateTotalExp();
          }
        });
    }
  });
  //    $("#applied_ps").on("change", function () {
  //        var val1 = document.getElementById("applied_ps").value;
  //        if (val1 == 'Yes') {
  //            $('#previous_id').attr('required', true);
  //            $('#transaction_ref_no').attr('required', false);
  //            $('#dd_date').attr('required', false);
  //            $('#bank_name').attr('required', false);
  //            $('#branch_name').attr('required', false);
  //            $("#applied_psid_div").show();
  //            $("#dd_div").hide();
  //            $("#dd_div1").hide();
  //        } else if (val1 == 'No') {
  //            $('#previous_id').attr('required', false);
  //            $('#transaction_ref_no').attr('required', true);
  //            $('#dd_date').attr('required', true);
  //            $('#bank_name').attr('required', true);
  //            $('#branch_name').attr('required', true);
  //            $("#applied_psid_div").hide();
  //            $("#dd_div").show();
  //            $("#dd_div1").show();
  //        } else {
  //            $('#previous_ps_id').attr('required', false);
  //            $('#transaction_ref_no').attr('required', false);
  //            $('#dd_date').attr('required', false);
  //            $('#bank_name').attr('required', false);
  //            $('#branch_name').attr('required', false);
  //        }
  //    });

  $("#inf_employee").on("change", function () {
    var val2 = document.getElementById("inf_employee").value;
    if (val2 == "Yes") {
      $("#payroll_no").attr("required", true);
      $("#inf_emp_div").show();
    } else {
      $("#payroll_no").attr("required", false);
      $("#inf_emp_div").hide();
    }
  });
  $("#expr_table").on("change", ".fromdt, .todt", function () {
    var spanaddress = $(this).data("myid");
    var ID = spanaddress.replace("diff", "");
    if ($("#from" + ID).val() != "" && $("#to" + ID).val() != "") {
      var fdt = stringToDate($("#from" + ID).val(), "dd/MM/yyyy", "/");
      var tdt = stringToDate($("#to" + ID).val(), "dd/MM/yyyy", "/");
      //alert(getAge(new Date(1990, 8, 10), new Date(2020, 1, 4)))

      $("#" + spanaddress).val(getAge(fdt, tdt));
    }
  });
  $("#service_from_date, #service_to_date").on("change", function () {
    if (
      $("#service_from_date").val() != "" &&
      $("#service_to_date").val() != ""
    ) {
      var fdt = stringToDate($("#service_from_date").val(), "dd/MM/yyyy", "/");
      var tdt = stringToDate($("#service_to_date").val(), "dd/MM/yyyy", "/");
      //alert(getAge(new Date(1990, 8, 10), new Date(2020, 1, 4)))
      if (tdt < fdt) {
        alert("Ending date Must be Greater than starting Date.");
        document.getElementById("service_to_date").value = null;
      } else {
        $("#length_of_service").val(getAge(fdt, tdt));
      }
    }
  });
});
function check_hsc_date() {
  var year1 = document.getElementById("year1").value;
  var year2 = document.getElementById("year2").value;
  var year_1 = year1.substr(year1.length - 4);
  var year_2 = year2.substr(year2.length - 4);
  if (year_1 >= year_2) {
    alert("Date Must be Greater than SSC Date.");
    document.getElementById("year2").value = null;
    document.educationalform.year2.focus();
    return false;
  } else {
    return true;
  }
}

function check_bachelor_date() {
  var year1 = document.getElementById("year1").value;
  var year2 = document.getElementById("year2").value;
  var year3 = document.getElementById("year3").value;
  var year_1 = year1.substr(year1.length - 4);
  var year_2 = year2.substr(year2.length - 4);
  var year_3 = year3.substr(year3.length - 4);
  if (year_1 >= year_3) {
    alert("Date Must be Greater than HSC/Diploma Degree Date.");
    document.getElementById("year3").value = null;
    document.educationalform.year3.focus();
    return false;
  } else if (year_2 >= year_3) {
    alert("Date Must be Greater than HSC/Diploma Degree Date.");
    document.getElementById("year3").value = null;
    document.educationalform.year3.focus();
    return false;
  } else {
    return true;
  }
}

function check_master_date() {
  var year1 = document.getElementById("year1").value;
  var year2 = document.getElementById("year2").value;
  var year3 = document.getElementById("year3").value;
  var year4 = document.getElementById("year4").value;
  var year_1 = year1.substr(year1.length - 4);
  var year_2 = year2.substr(year2.length - 4);
  var year_3 = year3.substr(year3.length - 4);
  var year_4 = year4.substr(year4.length - 4);
  if (year_1 >= year_4) {
    alert("Date Must be Greater than Bachelor Degree Date.");
    document.getElementById("year4").value = null;
    document.educationalform.year4.focus();
    return false;
  } else if (year_2 >= year_4) {
    alert("Date Must be Greater than Bachelor Degree Date.");
    document.getElementById("year4").value = null;
    document.educationalform.year4.focus();
    return false;
  } else if (year_3 >= year_4) {
    alert("Date Must be Greater than Bachelor Degree Date.");
    document.getElementById("year4").value = null;
    document.educationalform.year4.focus();
    return false;
  } else {
    return true;
  }
}

function stringToDate(_date, _format, _delimiter) {
  var formatLowerCase = _format.toLowerCase();
  var formatItems = formatLowerCase.split(_delimiter);
  var dateItems = _date.split(_delimiter);
  var monthIndex = formatItems.indexOf("mm");
  var dayIndex = formatItems.indexOf("dd");
  var yearIndex = formatItems.indexOf("yyyy");
  var month = parseInt(dateItems[monthIndex]);
  month -= 1;
  var formatedDate = new Date(dateItems[yearIndex], month, dateItems[dayIndex]);
  return formatedDate;
}
function getAge(date_1, date_2) {
  //convert to UTC
  var date2_UTC = new Date(
    Date.UTC(date_2.getUTCFullYear(), date_2.getUTCMonth(), date_2.getUTCDate())
  );
  var date1_UTC = new Date(
    Date.UTC(date_1.getUTCFullYear(), date_1.getUTCMonth(), date_1.getUTCDate())
  );
  var yAppendix, mAppendix, dAppendix;
  //--------------------------------------------------------------
  var days = date2_UTC.getDate() - date1_UTC.getDate();
  if (days < 0) {
    date2_UTC.setMonth(date2_UTC.getMonth() - 1);
    days += DaysInMonth(date2_UTC);
  }
  //--------------------------------------------------------------
  var months = date2_UTC.getMonth() - date1_UTC.getMonth();
  if (months < 0) {
    date2_UTC.setFullYear(date2_UTC.getFullYear() - 1);
    months += 12;
  }
  //--------------------------------------------------------------
  var years = date2_UTC.getFullYear() - date1_UTC.getFullYear();
  if (years > 1) yAppendix = " years";
  else yAppendix = " year";
  if (months > 1) mAppendix = " months";
  else mAppendix = " month";
  if (days > 1) dAppendix = " days";
  else dAppendix = " day";
  return (
    years + yAppendix + ", " + months + mAppendix + ", and " + days + dAppendix
  );
}

function DaysInMonth(date2_UTC) {
  var monthStart = new Date(date2_UTC.getFullYear(), date2_UTC.getMonth(), 1);
  var monthEnd = new Date(date2_UTC.getFullYear(), date2_UTC.getMonth() + 1, 1);
  var monthLength = (monthEnd - monthStart) / (1000 * 60 * 60 * 24);
  return Math.round(monthLength);
}
