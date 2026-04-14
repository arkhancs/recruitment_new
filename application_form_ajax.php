<?php

include('dbConfig.php');
include "get_ip.php";

if (!isset($_SERVER['HTTP_REFERER'])) {
    header('location:./index.php');
    exit;
}
session_start();
if (isset($_SESSION)) {
    $data = '';
    $app_id = $_SESSION['app_id'];
    // $sql = "select p.id as app_id, p.*, e.*, ep.*, o.*, re.category as post_category, re.Name, re.closed_date, re.year, re.exam_date, re.exam_time from prsnl p left join edctn e on p.id = e.id left join exprn ep on p.id = ep.id left join othrs o on p.id = o.id left join req_experience re on re.post = p.post where p.id ='$app_id'";
    $sql = " SELECT p.id AS app_id, p.id, p.password, p.job_type, p.prefix, p.surname, p.name, p.fathername, p.lastname, p.dob, p.sex, p.nation, p.address, p.state, p.telephone, p.city, p.pincode, p.paddress, p.pstate, p.pcity, p.ppincode, p.same_address, p.mobile, decrypt_aadhar_no(p.aadhar_no) AS aadhar_no, p.email, p.mstatus, p.post, p.job_location, p.regdate, p.status, p.photo, p.category, p.caste_certi, p.caste_certino, p.caste_certi_issue_year, p.serving, p.type_of_service, p.authority, p.age, p.status_check, p.browser_history, p.is_upload, p.status_remarks, p.disability, p.type_of_disability, p.disability_percentage, p.disability_certi, p.stenoGraphy_speed, p.stenography_certi_no, p.stenography_certi_date, p.stenography_certi, p.typing_speed, p.typing_certi_no, p.typing_certi_date, p.typing_certi, p.typing_language, p.inf_employee, p.payroll_no, p.type_of_job, p.length_of_service, p.service_from_date, p.service_to_date, p.status_date, e.*, ep.*, o.*, re.category AS post_category, re.Name, re.closed_date, re.year, re.exam_date, re.exam_time FROM prsnl p LEFT JOIN edctn e ON p.id = e.id LEFT JOIN exprn ep ON p.id = ep.id LEFT JOIN othrs o ON p.id = o.id LEFT JOIN req_experience re ON re.post = p.post WHERE p.id = '$app_id'; ";

    $result = mysqli_query($link, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $current_year = date('Y');
            $last_year = $current_year - 1;

            if ($row['year'] == $last_year || $row['year'] == $current_year) {

                session_start();
                $_SESSION['is_login'] = 'true';
                $_SESSION['app_id'] = $app_id;
                $_SESSION['post'] = $row['post'];
                $_SESSION['job_location'] = $row['job_location'];
                $_SESSION['job_type'] = $row['job_type'];
                $_SESSION['prefix'] = $row['prefix'];
                $_SESSION['surname'] = $row['surname'];
                $_SESSION['fathername'] = $row['fathername'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['lastname'] = $row['lastname'];
                $_SESSION['dob'] = $row['dob'];
                $_SESSION['age'] = $row['age'];
                $_SESSION['caste'] = $row['category'];
                $_SESSION['caste_certi'] = $row['caste_certi'];
                $_SESSION['caste_certi_issue_year'] = $row['caste_certi_issue_year'];
                $_SESSION['caste_certino'] = $row['caste_certino'];
                $_SESSION['serving'] = $row['serving'];
                $_SESSION['type_of_service'] = $row['type_of_service'];
                $_SESSION['sex'] = $row['sex'];
                $_SESSION['nation'] = $row['nation'];
                $_SESSION['mstatus'] = $row['mstatus'];
                $_SESSION['address'] = $row['address'];
                $_SESSION['paddress'] = $row['paddress'];
                $_SESSION['state'] = $row['state'];
                $_SESSION['pstate'] = $row['pstate'];
                $_SESSION['city'] = $row['city'];
                $_SESSION['pcity'] = $row['pcity'];
                $_SESSION['pincode'] = $row['pincode'];
                $_SESSION['ppincode'] = $row['ppincode'];
                $_SESSION['telephone'] = $row['telephone'];
                $_SESSION['mobile'] = $row['mobile'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['aadhar_no'] = $row['aadhar_no'];
                $_SESSION['same_address'] = $row['same_address'];
                $_SESSION['disability'] = $row['disability'];
                $_SESSION['disability_percentage'] = $row['disability_percentage'];
                $_SESSION['type_of_disability'] = $row['type_of_disability'];
                $_SESSION['disability_certi'] = $row['disability_certi'];
                $_SESSION['stenoGraphy_speed'] = $row['stenoGraphy_speed'];
                $_SESSION['stenography_certi_no'] = $row['stenography_certi_no'];
                $_SESSION['stenography_certi_date'] = $row['stenography_certi_date'];
                $_SESSION['stenography_certi'] = $row['stenography_certi'];
                $_SESSION['typing_speed'] = $row['typing_speed'];
                $_SESSION['typing_certi_no'] = $row['typing_certi_no'];
                $_SESSION['typing_certi_date'] = $row['typing_certi_date'];
                $_SESSION['typing_certi'] = $row['typing_certi'];
                $_SESSION['typing_language'] = $row['typing_language'];
                $_SESSION['inf_employee'] = $row['inf_employee'];
                $_SESSION['payroll_no'] = $row['payroll_no'];
                $_SESSION['type_of_job'] = $row['type_of_job'];
                $_SESSION['length_of_service'] = $row['length_of_service'];
                $_SESSION['service_from_date'] = $row['service_from_date'];
                $_SESSION['service_to_date'] = $row['service_to_date'];

                $_SESSION['edu1'] = $row['edu1'];
                $_SESSION['edu2'] = $row['edu2'];
                $_SESSION['edu3'] = $row['edu3'];
                $_SESSION['edu4'] = $row['edu4'];
                $_SESSION['edu5'] = $row['edu5'];
                $_SESSION['edu6'] = $row['edu6'];
                $_SESSION['edu7'] = $row['edu7'];
                $_SESSION['edu8'] = $row['edu8'];

                $_SESSION['board1'] = $row['board1'];
                $_SESSION['board2'] = $row['board2'];
                $_SESSION['board3'] = $row['board3'];
                $_SESSION['board4'] = $row['board4'];
                $_SESSION['board5'] = $row['board5'];
                $_SESSION['board6'] = $row['board6'];
                $_SESSION['board7'] = $row['board7'];
                $_SESSION['board8'] = $row['board8'];

                $_SESSION['year1'] = $row['year1'];
                $_SESSION['year2'] = $row['year2'];
                $_SESSION['year3'] = $row['year3'];
                $_SESSION['year4'] = $row['year4'];
                $_SESSION['year5'] = $row['year5'];
                $_SESSION['year6'] = $row['year6'];
                $_SESSION['year7'] = $row['year7'];
                $_SESSION['year8'] = $row['year8'];

                $_SESSION['per1'] = $row['per1'];
                $_SESSION['per2'] = $row['per2'];
                $_SESSION['per3'] = $row['per3'];
                $_SESSION['per4'] = $row['per4'];
                $_SESSION['per5'] = $row['per5'];
                $_SESSION['per6'] = $row['per6'];
                $_SESSION['per7'] = $row['per7'];
                $_SESSION['per8'] = $row['per8'];

                $_SESSION['speci1'] = $row['spec1'];
                $_SESSION['speci2'] = $row['spec2'];
                $_SESSION['speci3'] = $row['spec3'];
                $_SESSION['speci4'] = $row['spec4'];
                $_SESSION['speci5'] = $row['spec5'];
                $_SESSION['speci6'] = $row['spec6'];
                $_SESSION['speci7'] = $row['spec7'];
                $_SESSION['speci8'] = $row['spec8'];

                $_SESSION['div1'] = $row['div1'];
                $_SESSION['div2'] = $row['div2'];
                $_SESSION['div3'] = $row['div3'];
                $_SESSION['div4'] = $row['div4'];
                $_SESSION['div5'] = $row['div5'];
                $_SESSION['div6'] = $row['div6'];
                $_SESSION['div7'] = $row['div7'];
                $_SESSION['div8'] = $row['div8'];

                $_SESSION['ssc_certi'] = $row['ssc_certi'];
                $_SESSION['hsc_certi'] = $row['hsc_certi'];
                $_SESSION['bachelor_certi'] = $row['bachelor_certi'];
                $_SESSION['master_certi'] = $row['master_certi'];
                $_SESSION['phd_certi'] = $row['phd_certi'];
                $_SESSION['other_edu_certi'] = $row['other_edu_certi'];
                $_SESSION['comp_certi'] = $row['comp_certi'];

                $_SESSION['org1'] = $row['org1'];
                $_SESSION['pos1'] = $row['pos1'];
                $_SESSION['from1'] = $row['from1'];
                $_SESSION['to1'] = $row['to1'];
                $_SESSION['nature1'] = $row['nature1'];
                $_SESSION['pay1'] = $row['pay1'];
                $_SESSION['otype1'] = $row['otype1'];
                $_SESSION['total1'] = $row['total1'];
                $_SESSION['exp1'] = $row['exp1'];
                $_SESSION['exp_file1'] = $row['exp_file1'];

                $_SESSION['org2'] = $row['org2'];
                $_SESSION['pos2'] = $row['pos2'];
                $_SESSION['from2'] = $row['from2'];
                $_SESSION['to2'] = $row['to2'];
                $_SESSION['nature2'] = $row['nature2'];
                $_SESSION['pay2'] = $row['pay2'];
                $_SESSION['otype2'] = $row['otype2'];
                $_SESSION['total2'] = $row['total2'];
                $_SESSION['exp2'] = $row['exp2'];
                $_SESSION['exp_file2'] = $row['exp_file2'];

                $_SESSION['org3'] = $row['org3'];
                $_SESSION['pos3'] = $row['pos3'];
                $_SESSION['from3'] = $row['from3'];
                $_SESSION['to3'] = $row['to3'];
                $_SESSION['nature3'] = $row['nature3'];
                $_SESSION['pay3'] = $row['pay3'];
                $_SESSION['otype3'] = $row['otype3'];
                $_SESSION['total3'] = $row['total3'];
                $_SESSION['exp3'] = $row['exp3'];
                $_SESSION['exp_file3'] = $row['exp_file3'];

                $_SESSION['org4'] = $row['org4'];
                $_SESSION['pos4'] = $row['pos4'];
                $_SESSION['from4'] = $row['from4'];
                $_SESSION['to4'] = $row['to4'];
                $_SESSION['nature4'] = $row['nature4'];
                $_SESSION['pay4'] = $row['pay4'];
                $_SESSION['otype4'] = $row['otype4'];
                $_SESSION['total4'] = $row['total4'];
                $_SESSION['exp4'] = $row['exp4'];
                $_SESSION['exp_file4'] = $row['exp_file4'];

                $_SESSION['org5'] = $row['org5'];
                $_SESSION['pos5'] = $row['pos5'];
                $_SESSION['from5'] = $row['from5'];
                $_SESSION['to5'] = $row['to5'];
                $_SESSION['nature5'] = $row['nature5'];
                $_SESSION['pay5'] = $row['pay5'];
                $_SESSION['otype5'] = $row['otype5'];
                $_SESSION['total5'] = $row['total5'];
                $_SESSION['exp5'] = $row['exp5'];
                $_SESSION['exp_file5'] = $row['exp_file5'];

                $_SESSION['org6'] = $row['org6'];
                $_SESSION['pos6'] = $row['pos6'];
                $_SESSION['from6'] = $row['from6'];
                $_SESSION['to6'] = $row['to6'];
                $_SESSION['nature6'] = $row['nature6'];
                $_SESSION['pay6'] = $row['pay6'];
                $_SESSION['otype6'] = $row['otype6'];
                $_SESSION['exp6'] = $row['exp6'];
                $_SESSION['exp_file6'] = $row['exp_file6'];

                $_SESSION['org7'] = $row['org7'];
                $_SESSION['pos7'] = $row['pos7'];
                $_SESSION['from7'] = $row['from7'];
                $_SESSION['to7'] = $row['to7'];
                $_SESSION['nature7'] = $row['nature7'];
                $_SESSION['pay7'] = $row['pay7'];
                $_SESSION['otype7'] = $row['otype7'];
                $_SESSION['exp7'] = $row['exp7'];
                $_SESSION['exp_file7'] = $row['exp_file7'];

                $_SESSION['org8'] = $row['org8'];
                $_SESSION['pos8'] = $row['pos8'];
                $_SESSION['from8'] = $row['from8'];
                $_SESSION['to8'] = $row['to8'];
                $_SESSION['nature8'] = $row['nature8'];
                $_SESSION['pay8'] = $row['pay8'];
                $_SESSION['otype8'] = $row['otype8'];
                $_SESSION['exp8'] = $row['exp8'];
                $_SESSION['exp_file8'] = $row['exp_file8'];

                $_SESSION['org9'] = $row['org9'];
                $_SESSION['pos9'] = $row['pos9'];
                $_SESSION['from9'] = $row['from9'];
                $_SESSION['to9'] = $row['to9'];
                $_SESSION['nature9'] = $row['nature9'];
                $_SESSION['pay9'] = $row['pay9'];
                $_SESSION['otype9'] = $row['otype9'];
                $_SESSION['exp9'] = $row['exp9'];
                $_SESSION['exp_file9'] = $row['exp_file9'];

                $_SESSION['org10'] = $row['org10'];
                $_SESSION['pos10'] = $row['pos10'];
                $_SESSION['from10'] = $row['from10'];
                $_SESSION['to10'] = $row['to10'];
                $_SESSION['nature10'] = $row['nature10'];
                $_SESSION['pay10'] = $row['pay10'];
                $_SESSION['otype10'] = $row['otype10'];
                $_SESSION['exp10'] = $row['exp10'];
                $_SESSION['exp_file10'] = $row['exp_file10'];
                $_SESSION['currently_working'] = $row['currently_working'];

                $_SESSION['ref1'] = $row['ref1'];
                $_SESSION['ref2'] = $row['ref2'];
                $_SESSION['detained'] = $row['detained'];
                $_SESSION['detained_details'] = $row['detained_details'];
                $_SESSION['other_info'] = $row['other_info'];
                $_SESSION['police'] = $row['police'];
                $_SESSION['photo'] = $row['photo'];
                $_SESSION['sign'] = $row['sign'];
                $_SESSION['dob_proof'] = $row['dob_proof'];
                $_SESSION['noc'] = $row['noc'];
                $_SESSION['otherdoc'] = $row['otherdoc'];
                //$_SESSION['castecerti'] = $row['castecerti'];
                $_SESSION['transaction_ref_no'] = $row['transaction_ref_no'];
                $_SESSION['dd_date'] = $row['dd_date'];
                $_SESSION['dd_amount'] = $row['dd_amount'];

                $_SESSION['fees_receipt'] = $row['fees_receipt'];
                $_SESSION['apars_doc'] = $row['apars_doc'];
                $_SESSION['grandtotal'] = $row['grandtotal'];
                $_SESSION['expr_certi'] = $row['expr_certi'];
                $_SESSION['app_id'] = $row['app_id'];

                $sql = "select category from req_experience where post ='" . $row['post'] . "'";
                $result = mysqli_query($link, $sql);
                $row = mysqli_fetch_assoc($result);

                $_SESSION['category_job'] = $row['category'];

                $sql_ua = "insert into history_admitcard VALUES(0,'$ua_browser','$ua_version','$ua_platform','$ua_ip','$ua_date','$ua_time','$app_id','Fill Application Form')";
                $result_ua = mysqli_query($link, $sql_ua);

                $data = 'Success';
                echo json_encode($data);
                // header("location:application_form.php");
            } else {
                $data = 'fail';
                echo json_encode($data);
            }
        }
    } else {
        $data = 'fail';
        echo json_encode($data);
    }
}
