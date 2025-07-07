<?php
session_start();
//error_reporting(E_ALL ^ E_DEPRECATED);
error_reporting(0);
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("X-Frame-Options: SAMEORIGIN");
header("X-XSS-Protection: 1; mode=block");
setcookie("recrutmentcookie", "recrutment", 0, "/", "https://recruitment.inflibnet.ac.in/", true, true);
header("Content-Security-Policy: default-src 'self' https: data: 'unsafe-inline' 'unsafe-eval';");
header_remove("X-Powered-By");
ini_set("session.cookie_secure", 1);
include "dbConfig.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
$srno = 0;
$unid = "";
$mail_name = '';

include "get_ip.php";
date_default_timezone_set('Asia/Kolkata');

if (isset($_POST['Submit'])) {

    $result = "";
    $regid = trim(mysqli_real_escape_string($link, $_POST['regid']));
    $password = trim(mysqli_real_escape_string($link, $_POST['password']));
    $password1 = md5($password);
    error_log("Received Application ID: $regid, Password Hash: $password1");
    //    $sql = "select p.id as app_id, p.*, e.*, ep.*, o.*, re.category as post_category, re.Name as post_name, re.closed_date, re.year, re.exam_date, re.exam_time, re.open_date_admin, re.closed_date_admin from prsnl p left join edctn e on p.id = e.id left join exprn ep on p.id = ep.id left join othrs o on p.id = o.id left join req_experience re on re.post = p.post where p.id ='$regid' and p.password = '$password1'";
    //    $result = mysqli_query($link, $sql);
    // $stmt = $link->prepare("select p.id as app_id, p.*, e.*, ep.*, o.*, re.category as post_category, re.Name as post_name, re.closed_date, re.year, re.exam_date, re.exam_time, re.open_date_admin, re.closed_date_admin from prsnl p left join edctn e on p.id = e.id left join exprn ep on p.id = ep.id left join othrs o on p.id = o.id left join req_experience re on re.post = p.post where p.id =? and p.password = ?");

    $stmt = $link->prepare("SELECT p.id, p.password, p.job_type, p.prefix, p.surname, p.name, p.fathername, p.lastname, p.dob, p.sex, p.nation, p.address, p.state, p.telephone, p.city, p.pincode, p.paddress, p.pstate, p.pcity, p.ppincode, p.same_address, p.mobile, decrypt_aadhar_no(p.aadhar_no) AS aadhar_no, p.email, p.mstatus, p.post, p.job_location, p.regdate, p.status, p.photo, p.category, p.caste_certi, p.caste_certino, p.caste_certi_issue_year, p.serving, p.type_of_service, p.authority, p.age, p.status_check, p.browser_history, p.is_upload, p.status_remarks, p.disability, p.type_of_disability, p.disability_percentage, p.disability_certi, p.stenoGraphy_speed, p.stenography_certi_no, p.stenography_certi_date, p.stenography_certi, p.typing_speed, p.typing_certi_no, p.typing_certi_date, p.typing_certi, p.typing_language, p.inf_employee, p.payroll_no, p.type_of_job, p.length_of_service, p.service_from_date, p.service_to_date, p.status_date, e.*, ep.*, o.*, re.category AS post_category, re.Name AS post_name, re.closed_date, re.year, re.exam_date, re.exam_time, re.open_date_admin, re.closed_date_admin FROM prsnl p LEFT JOIN edctn e ON p.id = e.id LEFT JOIN exprn ep ON p.id = ep.id LEFT JOIN othrs o ON p.id = o.id LEFT JOIN req_experience re ON re.post = p.post WHERE p.id = ? AND p.password = ? ");

    $stmt->bind_param("ss", $regid, $password1);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        error_log("Query executed successfully.");
        if (mysqli_num_rows($result) == 0) {
            $msg = " Incorrect ID or Password.";
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                error_log("Match found for Application ID: $regid");
                $current_year = date('Y'); // Current year
                $last_year = $current_year - 1; // Last year

                if (
                    $row['year'] == $current_year || $row['year'] == $last_year
                ) {
                    session_start();
                    if ($_POST["captcha_code"] != $_SESSION["code"]) {
                        error_log("Captcha mismatch.");
                        $msg = " Incorrect Captcha.";
                    } else {
                        if ($password1 != $row['password']) {
                            error_log("Password mismatch.");
                            $msg = "Incorrect Password.";
                        } else {
                            error_log("Login successful for Application ID: $regid");
                            $_SESSION['post'] = $row['post'];
                            $_SESSION['post_name'] = $row['post_name'];
                            $_SESSION['job_location'] = $row['job_location'];
                            $_SESSION['job_type'] = $row['job_type'];
                            $_SESSION['prefix'] = $row['prefix'];
                            $_SESSION['surname'] = $row['surname'];
                            $_SESSION['fathername'] = $row['fathername'];
                            $_SESSION['name'] = $row['name'];
                            $_SESSION['lastname'] = $row['lastname'];
                            $_SESSION['app_id'] = $regid;
                            $_SESSION['photo'] = $row['photo'];
                            $_SESSION['status'] = $row['status'];
                            $_SESSION['status_check'] = $row['status_check'];
                            $_SESSION['exam_date'] = $row['exam_date'];
                            $_SESSION['exam_time'] = $row['exam_time'];
                            $_SESSION['post_category'] = $row['post_category'];
                            $_SESSION['year'] = $row['year'];
                            $_SESSION['closed_date'] = $row['closed_date'];
                            $_SESSION['open_date_admin'] = $row['open_date_admin'];
                            $_SESSION['closed_date_admin'] = $row['closed_date_admin'];
                            $_SESSION['hard_copy_received'] = $row['hard_copy_received'];
                            $_SESSION['remarks'] = $row['status_remarks'];
                            $_SESSION['inward_no'] = $row['inward_no'];
                            $_SESSION['inward_date'] = $row['inward_date'];
                            $_SESSION['transaction_ref_no'] = $row['transaction_ref_no'];
                            $_SESSION['dd_amount'] = $row['dd_amount'];
                            $_SESSION['is_login'] = 'true';

                            //                            $sql_ua = "insert into history_admitcard VALUES(0,'$ua_browser','$ua_version','$ua_platform','$ua_ip','$ua_date','$ua_time','$regid','Login')";
                            //                            $result_ua = mysqli_query($link, $sql_ua);
                            $activity = "Login";
                            $sql_ua = $link->prepare("INSERT INTO history_admitcard(browser, version, platform, ip, date, time, user_id, activity) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                            $sql_ua->bind_param("ssssssss", $ua_browser, $ua_version, $ua_platform, $ua_ip, $ua_date, $ua_time, $regid, $activity);
                            $sql_ua->execute();
                            header("location:dashboard.php");

                            //                            date_default_timezone_set('Asia/Kolkata');
                            //                            $current_date = date("Y-m-d H:i:s");
                            //                            $dateTimestamp1 = strtotime($current_date);
                            //
                            //                            $db_date = date("Y-m-d H:i:s", strtotime(strtr($row['closed_date'], '/', '-')));
                            //                            $dateTimestamp2 = strtotime($db_date);
                            //
                            //                            if ($row['status'] == 'current' && ($row['status_check'] == 'Eligible' || $row['status_check'] == 'Provisionally') && $row['exam_date'] != '' && $row['post_category'] == 'LS' && $row['year'] == '2022' && $row['post'] == 'STOILS-1-2022') {
                            //                                session_start();
                            //                                $_SESSION['is_login'] = 'true';
                            //                                $_SESSION['app_id'] = $regid;
                            //                                $_SESSION['post'] = $row['post'];
                            //                                $_SESSION['post_category'] = $row['post_category'];
                            //                                $_SESSION['Name'] = $row['Name'];
                            //                                $_SESSION['prefix'] = $row['prefix'];
                            //                                $_SESSION['surname'] = $row['surname'];
                            //                                $_SESSION['fathername'] = $row['fathername'];
                            //                                $_SESSION['name'] = $row['name'];
                            //                                $_SESSION['lastname'] = $row['lastname'];
                            //                                $_SESSION['dob'] = $row['dob'];
                            //                                $_SESSION['photo'] = $row['photo'];
                            //                                $_SESSION['exam_date'] = $row['exam_date'];
                            //                                $_SESSION['exam_time'] = $row['exam_time'];
                            //
                            //                                $sql_download_admitcard = "update othrs set download_admitcard='Yes' where id='$regid'";
                            //                                $result_download_admitcard = mysqli_query($link, $sql_download_admitcard);
                            //
                            //                                $sql_ua = "insert into history_admitcard VALUES(0,'$ua_browser','$ua_version','$ua_platform','$ua_ip','$ua_date','$ua_time','$regid','Login for Download Admit Card')";
                            //                                $result_ua = mysqli_query($link, $sql_ua);
                            //
                            //                                header("location:admit_card.php");
                            //                                //header("location:print_application.php");
                            //                            } else if ($row['status'] == 'current') {
                            //                                session_start();
                            //                                $_SESSION['is_login'] = 'true';
                            //                                $_SESSION['user'] = $row['name'] . $row['surname'];
                            //                                $_SESSION['app_id'] = $regid;
                            //
                            //                                $sql_ua = "insert into history_admitcard VALUES(0,'$ua_browser','$ua_version','$ua_platform','$ua_ip','$ua_date','$ua_time','$regid','Login for Print Application')";
                            //                                $result_ua = mysqli_query($link, $sql_ua);
                            //
                            //                                header("location:print_application.php");
                            //                            } else if ($row['status'] == 'panding' && $dateTimestamp2 >= $dateTimestamp1) {
                            //                                session_start();
                            //                                $_SESSION['is_login'] = 'true';
                            //                                $_SESSION['app_id'] = $regid;
                            //                                $_SESSION['post'] = $row['post'];
                            //                                $_SESSION['job_location'] = $row['job_location'];
                            //                                $_SESSION['job_type'] = $row['job_type'];
                            //                                $_SESSION['prefix'] = $row['prefix'];
                            //                                $_SESSION['surname'] = $row['surname'];
                            //                                $_SESSION['fathername'] = $row['fathername'];
                            //                                $_SESSION['name'] = $row['name'];
                            //                                $_SESSION['lastname'] = $row['lastname'];
                            //                                $_SESSION['dob'] = $row['dob'];
                            //                                $_SESSION['age'] = $row['age'];
                            //                                $_SESSION['caste'] = $row['category'];
                            //                                $_SESSION['caste_certi'] = $row['caste_certi'];
                            //                                $_SESSION['caste_certi_issue_year'] = $row['caste_certi_issue_year'];
                            //                                $_SESSION['caste_certino'] = $row['caste_certino'];
                            //                                $_SESSION['type_of_service'] = $row['type_of_service'];
                            //                                $_SESSION['sex'] = $row['sex'];
                            //                                $_SESSION['nation'] = $row['nation'];
                            //                                $_SESSION['mstatus'] = $row['mstatus'];
                            //                                $_SESSION['address'] = $row['address'];
                            //                                $_SESSION['paddress'] = $row['paddress'];
                            //                                $_SESSION['state'] = $row['state'];
                            //                                $_SESSION['pstate'] = $row['pstate'];
                            //                                $_SESSION['city'] = $row['city'];
                            //                                $_SESSION['pcity'] = $row['pcity'];
                            //                                $_SESSION['pincode'] = $row['pincode'];
                            //                                $_SESSION['ppincode'] = $row['ppincode'];
                            //                                $_SESSION['telephone'] = $row['telephone'];
                            //                                $_SESSION['mobile'] = $row['mobile'];
                            //                                $_SESSION['email'] = $row['email'];
                            //                                $_SESSION['aadhar_no'] = $row['aadhar_no'];
                            //                                $_SESSION['same_address'] = $row['same_address'];
                            //                                $_SESSION['disability'] = $row['disability'];
                            //                                $_SESSION['disability_percentage'] = $row['disability_percentage'];
                            //                                $_SESSION['type_of_disability'] = $row['type_of_disability'];
                            //                                $_SESSION['disability_certi'] = $row['disability_certi'];
                            //                                $_SESSION['stenoGraphy_speed'] = $row['stenoGraphy_speed'];
                            //                                $_SESSION['stenography_certi_no'] = $row['stenography_certi_no'];
                            //                                $_SESSION['stenography_certi_date'] = $row['stenography_certi_date'];
                            //                                $_SESSION['stenography_certi'] = $row['stenography_certi'];
                            //                                $_SESSION['typing_speed'] = $row['typing_speed'];
                            //                                $_SESSION['typing_certi_no'] = $row['typing_certi_no'];
                            //                                $_SESSION['typing_certi_date'] = $row['typing_certi_date'];
                            //                                $_SESSION['typing_certi'] = $row['typing_certi'];
                            //                                $_SESSION['typing_language'] = $row['typing_language'];
                            //                                $_SESSION['inf_employee'] = $row['inf_employee'];
                            //                                $_SESSION['payroll_no'] = $row['payroll_no'];
                            //                                $_SESSION['type_of_job'] = $row['type_of_job'];
                            //                                $_SESSION['length_of_service'] = $row['length_of_service'];
                            //                                $_SESSION['service_from_date'] = $row['service_from_date'];
                            //                                $_SESSION['service_to_date'] = $row['service_to_date'];
                            //
                            //                                $_SESSION['edu1'] = $row['edu1'];
                            //                                $_SESSION['edu2'] = $row['edu2'];
                            //                                $_SESSION['edu3'] = $row['edu3'];
                            //                                $_SESSION['edu4'] = $row['edu4'];
                            //                                $_SESSION['edu5'] = $row['edu5'];
                            //                                $_SESSION['edu6'] = $row['edu6'];
                            //                                $_SESSION['edu7'] = $row['edu7'];
                            //
                            //                                $_SESSION['board1'] = $row['board1'];
                            //                                $_SESSION['board2'] = $row['board2'];
                            //                                $_SESSION['board3'] = $row['board3'];
                            //                                $_SESSION['board4'] = $row['board4'];
                            //                                $_SESSION['board5'] = $row['board5'];
                            //                                $_SESSION['board6'] = $row['board6'];
                            //                                $_SESSION['board7'] = $row['board7'];
                            //
                            //                                $_SESSION['year1'] = $row['year1'];
                            //                                $_SESSION['year2'] = $row['year2'];
                            //                                $_SESSION['year3'] = $row['year3'];
                            //                                $_SESSION['year4'] = $row['year4'];
                            //                                $_SESSION['year5'] = $row['year5'];
                            //                                $_SESSION['year6'] = $row['year6'];
                            //                                $_SESSION['year7'] = $row['year7'];
                            //
                            //                                $_SESSION['per1'] = $row['per1'];
                            //                                $_SESSION['per2'] = $row['per2'];
                            //                                $_SESSION['per3'] = $row['per3'];
                            //                                $_SESSION['per4'] = $row['per4'];
                            //                                $_SESSION['per5'] = $row['per5'];
                            //                                $_SESSION['per6'] = $row['per6'];
                            //                                $_SESSION['per7'] = $row['per7'];
                            //
                            //                                $_SESSION['speci1'] = $row['spec1'];
                            //                                $_SESSION['speci2'] = $row['spec2'];
                            //                                $_SESSION['speci3'] = $row['spec3'];
                            //                                $_SESSION['speci4'] = $row['spec4'];
                            //                                $_SESSION['speci5'] = $row['spec5'];
                            //                                $_SESSION['speci6'] = $row['spec6'];
                            //                                $_SESSION['speci7'] = $row['spec7'];
                            //
                            //                                $_SESSION['div1'] = $row['div1'];
                            //                                $_SESSION['div2'] = $row['div2'];
                            //                                $_SESSION['div3'] = $row['div3'];
                            //                                $_SESSION['div4'] = $row['div4'];
                            //                                $_SESSION['div5'] = $row['div5'];
                            //                                $_SESSION['div6'] = $row['div6'];
                            //                                $_SESSION['div7'] = $row['div7'];
                            //
                            //                                $_SESSION['ssc_certi'] = $row['ssc_certi'];
                            //                                $_SESSION['hsc_certi'] = $row['hsc_certi'];
                            //                                $_SESSION['bachelor_certi'] = $row['bachelor_certi'];
                            //                                $_SESSION['master_certi'] = $row['master_certi'];
                            //                                $_SESSION['phd_certi'] = $row['phd_certi'];
                            //                                $_SESSION['other_edu_certi'] = $row['other_edu_certi'];
                            //
                            //                                $_SESSION['org1'] = $row['org1'];
                            //                                $_SESSION['pos1'] = $row['pos1'];
                            //                                $_SESSION['from1'] = $row['from1'];
                            //                                $_SESSION['to1'] = $row['to1'];
                            //                                $_SESSION['nature1'] = $row['nature1'];
                            //                                $_SESSION['pay1'] = $row['pay1'];
                            //                                $_SESSION['otype1'] = $row['otype1'];
                            //                                $_SESSION['total1'] = $row['total1'];
                            //                                $_SESSION['exp1'] = $row['exp1'];
                            //                                $_SESSION['exp_file1'] = $row['exp_file1'];
                            //
                            //                                $_SESSION['org2'] = $row['org2'];
                            //                                $_SESSION['pos2'] = $row['pos2'];
                            //                                $_SESSION['from2'] = $row['from2'];
                            //                                $_SESSION['to2'] = $row['to2'];
                            //                                $_SESSION['nature2'] = $row['nature2'];
                            //                                $_SESSION['pay2'] = $row['pay2'];
                            //                                $_SESSION['otype2'] = $row['otype2'];
                            //                                $_SESSION['total2'] = $row['total2'];
                            //                                $_SESSION['exp2'] = $row['exp2'];
                            //                                $_SESSION['exp_file2'] = $row['exp_file2'];
                            //
                            //                                $_SESSION['org3'] = $row['org3'];
                            //                                $_SESSION['pos3'] = $row['pos3'];
                            //                                $_SESSION['from3'] = $row['from3'];
                            //                                $_SESSION['to3'] = $row['to3'];
                            //                                $_SESSION['nature3'] = $row['nature3'];
                            //                                $_SESSION['pay3'] = $row['pay3'];
                            //                                $_SESSION['otype3'] = $row['otype3'];
                            //                                $_SESSION['total3'] = $row['total3'];
                            //                                $_SESSION['exp3'] = $row['exp3'];
                            //                                $_SESSION['exp_file3'] = $row['exp_file3'];
                            //
                            //                                $_SESSION['org4'] = $row['org4'];
                            //                                $_SESSION['pos4'] = $row['pos4'];
                            //                                $_SESSION['from4'] = $row['from4'];
                            //                                $_SESSION['to4'] = $row['to4'];
                            //                                $_SESSION['nature4'] = $row['nature4'];
                            //                                $_SESSION['pay4'] = $row['pay4'];
                            //                                $_SESSION['otype4'] = $row['otype4'];
                            //                                $_SESSION['total4'] = $row['total4'];
                            //                                $_SESSION['exp4'] = $row['exp4'];
                            //                                $_SESSION['exp_file4'] = $row['exp_file4'];
                            //
                            //                                $_SESSION['org5'] = $row['org5'];
                            //                                $_SESSION['pos5'] = $row['pos5'];
                            //                                $_SESSION['from5'] = $row['from5'];
                            //                                $_SESSION['to5'] = $row['to5'];
                            //                                $_SESSION['nature5'] = $row['nature5'];
                            //                                $_SESSION['pay5'] = $row['pay5'];
                            //                                $_SESSION['otype5'] = $row['otype5'];
                            //                                $_SESSION['total5'] = $row['total5'];
                            //                                $_SESSION['exp5'] = $row['exp5'];
                            //                                $_SESSION['exp_file5'] = $row['exp_file5'];
                            //
                            //                                $_SESSION['org6'] = $row['org6'];
                            //                                $_SESSION['pos6'] = $row['pos6'];
                            //                                $_SESSION['from6'] = $row['from6'];
                            //                                $_SESSION['to6'] = $row['to6'];
                            //                                $_SESSION['nature6'] = $row['nature6'];
                            //                                $_SESSION['pay6'] = $row['pay6'];
                            //                                $_SESSION['otype6'] = $row['otype6'];
                            //                                $_SESSION['exp6'] = $row['exp6'];
                            //                                $_SESSION['exp_file6'] = $row['exp_file6'];
                            //
                            //                                $_SESSION['org7'] = $row['org7'];
                            //                                $_SESSION['pos7'] = $row['pos7'];
                            //                                $_SESSION['from7'] = $row['from7'];
                            //                                $_SESSION['to7'] = $row['to7'];
                            //                                $_SESSION['nature7'] = $row['nature7'];
                            //                                $_SESSION['pay7'] = $row['pay7'];
                            //                                $_SESSION['otype7'] = $row['otype7'];
                            //                                $_SESSION['exp7'] = $row['exp7'];
                            //                                $_SESSION['exp_file7'] = $row['exp_file7'];
                            //
                            //                                $_SESSION['org8'] = $row['org8'];
                            //                                $_SESSION['pos8'] = $row['pos8'];
                            //                                $_SESSION['from8'] = $row['from8'];
                            //                                $_SESSION['to8'] = $row['to8'];
                            //                                $_SESSION['nature8'] = $row['nature8'];
                            //                                $_SESSION['pay8'] = $row['pay8'];
                            //                                $_SESSION['otype8'] = $row['otype8'];
                            //                                $_SESSION['exp8'] = $row['exp8'];
                            //                                $_SESSION['exp_file8'] = $row['exp_file8'];
                            //
                            //                                $_SESSION['org9'] = $row['org9'];
                            //                                $_SESSION['pos9'] = $row['pos9'];
                            //                                $_SESSION['from9'] = $row['from9'];
                            //                                $_SESSION['to9'] = $row['to9'];
                            //                                $_SESSION['nature9'] = $row['nature9'];
                            //                                $_SESSION['pay9'] = $row['pay9'];
                            //                                $_SESSION['otype9'] = $row['otype9'];
                            //                                $_SESSION['exp9'] = $row['exp9'];
                            //                                $_SESSION['exp_file9'] = $row['exp_file9'];
                            //
                            //                                $_SESSION['org10'] = $row['org10'];
                            //                                $_SESSION['pos10'] = $row['pos10'];
                            //                                $_SESSION['from10'] = $row['from10'];
                            //                                $_SESSION['to10'] = $row['to10'];
                            //                                $_SESSION['nature10'] = $row['nature10'];
                            //                                $_SESSION['pay10'] = $row['pay10'];
                            //                                $_SESSION['otype10'] = $row['otype10'];
                            //                                $_SESSION['exp10'] = $row['exp10'];
                            //                                $_SESSION['exp_file10'] = $row['exp_file10'];
                            //                                $_SESSION['currently_working'] = $row['currently_working'];
                            //
                            //                                $_SESSION['ref1'] = $row['ref1'];
                            //                                $_SESSION['ref2'] = $row['ref2'];
                            //                                $_SESSION['detained'] = $row['detained'];
                            //                                $_SESSION['detained_details'] = $row['detained_details'];
                            //                                $_SESSION['other_info'] = $row['other_info'];
                            //                                $_SESSION['police'] = $row['police'];
                            //                                $_SESSION['photo'] = $row['photo'];
                            //                                $_SESSION['sign'] = $row['sign'];
                            //                                $_SESSION['dob_proof'] = $row['dob_proof'];
                            //                                $_SESSION['noc'] = $row['noc'];
                            //                                //$_SESSION['otherdoc'] = $row['otherdoc'];
                            //                                $_SESSION['otherdoc'] = $row['othrdoc'];
                            //                                //$_SESSION['castecerti'] = $row['castecerti'];
                            //                                $_SESSION['transaction_ref_no'] = $row['transaction_ref_no'];
                            //                                $_SESSION['dd_date'] = $row['dd_date'];
                            //                                $_SESSION['dd_amount'] = $row['dd_amount'];
                            ////                                $_SESSION['bank_name'] = $row['bank_name'];
                            ////                                $_SESSION['branch_name'] = $row['branch_name'];
                            //                                //$_SESSION['previous_applied'] = $row['previous_applied'];
                            //                                //$_SESSION['previous_app_id'] = $row['previous_app_id'];
                            //                                $_SESSION['declaration'] = $row['declaration'];
                            //                                $_SESSION['fees_receipt'] = $row['fees_receipt'];
                            //                                $_SESSION['grandtotal'] = $row['grandtotal'];
                            //                                $_SESSION['expr_certi'] = $row['expr_certi'];
                            //                                $_SESSION['app_id'] = $row['app_id'];
                            //                                // $_SESSION['gov_project'] = $row['gov_project'];
                            //
                            //                                $sql = "select category from req_experience where post ='" . $row['post'] . "'";
                            //                                $result = mysqli_query($link, $sql);
                            //                                $row = mysqli_fetch_assoc($result);
                            //
                            //                                $_SESSION['category_job'] = $row['category'];
                            //
                            //                                $sql_ua = "insert into history_admitcard VALUES(0,'$ua_browser','$ua_version','$ua_platform','$ua_ip','$ua_date','$ua_time','$regid','Login for Fill Application Form')";
                            //                                $result_ua = mysqli_query($link, $sql_ua);
                            //
                            //                                header("location:application_form.php");
                            //                            } else {
                            //                                $msg = "You can not procced further because of you have not submitted all the details and online application has been closed now.";
                            //                            }
                        }
                    }
                } else {
                    error_log("Invalid year: " . $row['year']);
                    $msg = "This post is closed.";
                }
            }
        }
    } else {
        error_log("Query execution failed: " . $stmt->error);
        $msg = "Database error. Please try again later.";
    }
} else if (isset($_POST['save_temp'])) {


    session_start();
    if (isset($_POST['captcha_code_p'])) {
        if ($_POST['captcha_code_p'] != $_SESSION['code_p']) {
            echo "<script>window.location.href='application_form.php';</script>";
            exit();
        }
    }


    function clean_input($link, $value)
    {
        return htmlspecialchars(mysqli_real_escape_string($link, trim($value)), ENT_QUOTES, 'UTF-8');
    }

    $job_location = clean_input($link, $_POST['job_location']);
    $job_type = clean_input($link, $_POST['job_type']);

    $post = clean_input($link, $_POST['post']);
    $nation = clean_input($link, $_POST["nation"]);
    $prefix = clean_input($link, $_POST['prefix']);
    $surname = clean_input($link, $_POST["surname"]);
    $firstname = clean_input($link, $_POST['fname']);
    $fatherorhusband = clean_input($link, $_POST['lastname']);
    $fathername = clean_input($link, $_POST["fathername"]);
    $caste = clean_input($link, $_POST["caste"]);
    $issue_year = clean_input($link, $_POST["issue_year"]);
    $certi_no = clean_input($link, $_POST["certi_no"]);
    $serving = clean_input($link, $_POST["serving"]);
    $type_of_service = clean_input($link, $_POST["type_of_service"]);
    $dob = clean_input($link, $_POST["dob"]);
    $agenew = clean_input($link, $_POST['agenew']);
    $sex = clean_input($link, $_POST["sex"]);
    $mstatus = clean_input($link, $_POST["mstatus"]);
    $email = clean_input($link, $_POST["email"]);
    $mobile = clean_input($link, $_POST["mobile"]);
    $telephone = clean_input($link, $_POST["telephone"]);
    $aadhar_no = clean_input($link, $_POST["aadhar_no"]);
    $disability = clean_input($link, $_POST['disability']);
    $disability_percentage = clean_input($link, $_POST['disability_percentage']);
    $type_of_disability = clean_input($link, $_POST['type_of_disability']);
    $address = clean_input($link, $_POST["address"]);
    $state = clean_input($link, $_POST["state"]);
    $city = clean_input($link, $_POST["city"]);
    $pincode = clean_input($link, $_POST["pincode"]);
    $same_address = clean_input($link, $_POST["copy_address"]);
    $paddress = clean_input($link, $_POST["paddress"]);
    $pstate = clean_input($link, $_POST["pstate"]);
    $pcity = clean_input($link, $_POST["pcity"]);
    $ppincode = clean_input($link, $_POST["ppincode"]);
    $type_of_job = clean_input($link, $_POST["type_of_job"]);
    $length_of_service = clean_input($link, $_POST["length_of_service"]);
    $service_from_date = clean_input($link, $_POST["service_from_date"]);
    $service_to_date = clean_input($link, $_POST["service_to_date"]);

    $stenoGraphy_speed = clean_input($link, $_POST["stenoGraphy_speed"]);
    $stenography_certi_no = clean_input($link, $_POST["stenography_certi_no"]);
    $stenography_certi_date = clean_input($link, $_POST["stenography_certi_date"]);
    $typing_speed = clean_input($link, $_POST["typing_speed"]);
    $typing_certi_no = clean_input($link, $_POST["typing_certi_no"]);
    $typing_certi_date = clean_input($link, $_POST["typing_certi_date"]);
    $typing_language = clean_input($link, $_POST["typing_language"]);

    $inf_employee = clean_input($link, $_POST["inf_employee"]);
    $payroll_no = clean_input($link, $_POST["payroll_no"]);


    $authority = "";
    $app_status = NULL;
    $status_remarks = "";
    $is_upload = "n";
    $status_date = "";
    $ua = getBrowser();
    $brawser_h = implode(", ", $ua);
    $regdate = date("d/m/Y H:i:s");

    // Secure SQL query using prepared statement
    $stmt_check = $link->prepare("SELECT email, post, job_location FROM prsnl WHERE email = ? AND post = ? AND job_location = ?");
    $stmt_check->bind_param("sss", $email, $post, $job_location);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    //    $stmt1 = $link->prepare("SELECT email, post, job_location FROM prsnl WHERE email=? AND post=? AND job_location=?");
    //    $stmt1->bind_param("sss", $email, $post, $job_location);
    //    $stmt1->execute();
    //    $result_check = $stmt1->get_result();

    if (mysqli_num_rows($result_check) == 0) {
        // Secure SQL Injection Protection using prepared statement
        $stmt_age_check = $link->prepare("SELECT age_limit, category FROM req_experience WHERE post = ?");
        $stmt_age_check->bind_param("s", $post);
        $stmt_age_check->execute();
        $result_age_check = $stmt_age_check->get_result();
        $db_age = mysqli_fetch_assoc($result_age_check);


        //        $stmt2 = $link->prepare("SELECT age_limit, category FROM req_experience WHERE post=?");
        //        $stmt2->bind_param("s", $post);
        //        $stmt2->execute();
        //        $db_age = $stmt2->get_result();

        $length_of_service_new = substr($length_of_service, 0, 2);

        if (($db_age['category'] == "Admin" || $db_age['category'] == "Finance") && $inf_employee == "No") {
            if ($post == "AOAdmin-1-2023" || $post == "AOFAdmin-1-2023" || $post == "PSAdmin-2-2023" || $post == "TestCCTAdmin-2-2025" || $post == "MTSAdmin-1-2025") {
                if ($disability == "Yes" && $disability_percentage >= 40 && $caste != "Ex-servicemen" && $type_of_job == "Permanent") {
                    $db_age_new = $db_age['age_limit'] + 15;
                } else if ($disability == "Yes" && $disability_percentage >= 40 && $caste != "Ex-servicemen" && $type_of_job != "Permanent") {
                    $db_age_new = $db_age['age_limit'] + 10;
                } else if ($disability == "Yes" && $disability_percentage >= 40 && $caste == "Ex-servicemen" && $type_of_job != "Permanent") {
                    $db_age_new = $db_age['age_limit'] + $length_of_service_new + 13;
                } else if ($disability == "Yes" && $disability_percentage >= 40 && $caste == "Ex-servicemen" && $type_of_job == "Permanent") {
                    $db_age_new = $db_age['age_limit'] + $length_of_service_new + 18;
                } else if ($disability == "No" && $caste != "Ex-servicemen" && $type_of_job != "Permanent") {
                    $db_age_new = $db_age['age_limit'];
                } else if ($disability == "No" && $caste == "Ex-servicemen" && $type_of_job == "Permanent") {
                    $db_age_new = $db_age['age_limit'] + $length_of_service_new + 8;
                } else if ($disability == "No" && $caste != "Ex-servicemen" && $type_of_job == "Permanent") {
                    $db_age_new = $db_age['age_limit'] + 5;
                } else if ($disability == "No" && $caste == "Ex-servicemen" && $type_of_job != "Permanent") {
                    $db_age_new = $db_age['age_limit'] + $length_of_service_new + 3;
                } else {
                    $db_age_new = $db_age['age_limit'];
                }
            } else if ($post == "AAdmin-1-2022") {
                if ($disability == "Yes" && $disability_percentage >= 40 && $caste != "Ex-servicemen" && $type_of_job == "Permanent") {
                    $db_age_new = $db_age['age_limit'] + 20;
                } else if ($disability == "Yes" && $disability_percentage >= 40 && $caste != "Ex-servicemen" && $type_of_job != "Permanent") {
                    $db_age_new = $db_age['age_limit'] + 10;
                } else if ($disability == "Yes" && $disability_percentage >= 40 && $caste == "Ex-servicemen" && $type_of_job != "Permanent") {
                    $db_age_new = $db_age['age_limit'] + $length_of_service_new + 13;
                } else if ($disability == "Yes" && $disability_percentage >= 40 && $caste == "Ex-servicemen" && $type_of_job == "Permanent") {
                    $db_age_new = $db_age['age_limit'] + $length_of_service_new + 23;
                } else if ($disability == "No" && $caste != "Ex-servicemen" && $type_of_job != "Permanent") {
                    $db_age_new = $db_age['age_limit'];
                } else if ($disability == "No" && $caste == "Ex-servicemen" && $type_of_job == "Permanent") {
                    $db_age_new = $db_age['age_limit'] + $length_of_service_new + 13;
                } else if ($disability == "No" && $caste != "Ex-servicemen" && $type_of_job == "Permanent") {
                    $db_age_new = $db_age['age_limit'] + 10;
                } else if ($disability == "No" && $caste == "Ex-servicemen" && $type_of_job != "Permanent") {
                    $db_age_new = $db_age['age_limit'] + $length_of_service_new + 3;
                } else {
                    $db_age_new = $db_age['age_limit'];
                }
            } else {
                if ($disability == "Yes" && $disability_percentage >= 40 && $caste != "Ex-servicemen" && $type_of_job == "Permanent") {
                    $db_age_new = $db_age['age_limit'] + 15;
                } else if ($disability == "Yes" && $disability_percentage >= 40 && $caste != "Ex-servicemen" && $type_of_job != "Permanent") {
                    $db_age_new = $db_age['age_limit'] + 10;
                } else if ($disability == "Yes" && $disability_percentage >= 40 && $caste == "Ex-servicemen" && $type_of_job != "Permanent") {
                    $db_age_new = $db_age['age_limit'] + $length_of_service_new + 13;
                } else if ($disability == "Yes" && $disability_percentage >= 40 && $caste == "Ex-servicemen" && $type_of_job == "Permanent") {
                    $db_age_new = $db_age['age_limit'] + $length_of_service_new + 18;
                } else if ($disability == "No" && $caste != "Ex-servicemen" && $type_of_job != "Permanent") {
                    $db_age_new = $db_age['age_limit'];
                } else if ($disability == "No" && $caste == "Ex-servicemen" && $type_of_job == "Permanent") {
                    $db_age_new = $db_age['age_limit'] + $length_of_service_new + 8;
                } else if ($disability == "No" && $caste != "Ex-servicemen" && $type_of_job == "Permanent") {
                    $db_age_new = $db_age['age_limit'] + 5;
                } else if ($disability == "No" && $caste == "Ex-servicemen" && $type_of_job != "Permanent") {
                    $db_age_new = $db_age['age_limit'] + $length_of_service_new + 3;
                } else {
                    $db_age_new = $db_age['age_limit'];
                }
            }
        } else if ($db_age['category'] == "CS" && $inf_employee == "No") {
            if ($post == "STACS-1-2023" && $caste == "OBC") {
                if ($disability == "Yes" && $disability_percentage >= 40 && $caste != "Ex-servicemen") {
                    $db_age_new = $db_age['age_limit'] + 13;
                } else if ($disability == "Yes" && $disability_percentage >= 40 && $caste == "Ex-servicemen") {
                    $db_age_new = $db_age['age_limit'] + $length_of_service_new + 16;
                } else if ($disability == "No" && $caste != "Ex-servicemen") {
                    $db_age_new = $db_age['age_limit'] + 3;
                } else if ($disability == "No" && $caste == "Ex-servicemen") {
                    $db_age_new = $db_age['age_limit'] + $length_of_service_new + 6;
                } else {
                    $db_age_new = $db_age['age_limit'] + 3;
                }
            } else {
                if ($disability == "Yes" && $disability_percentage >= 40 && $caste != "Ex-servicemen") {
                    $db_age_new = $db_age['age_limit'] + 10;
                } else if ($disability == "Yes" && $disability_percentage >= 40 && $caste == "Ex-servicemen") {
                    $db_age_new = $db_age['age_limit'] + $length_of_service_new + 13;
                } else if ($disability == "No" && $caste != "Ex-servicemen") {
                    $db_age_new = $db_age['age_limit'];
                } else if ($disability == "No" && $caste == "Ex-servicemen") {
                    $db_age_new = $db_age['age_limit'] + $length_of_service_new + 3;
                } else {
                    $db_age_new = $db_age['age_limit'];
                }
            }
        } else if ($db_age['category'] == "LS" && $inf_employee == "No") {
            if ($post == "SCLS-1-2024" && $caste == "OBC") {
                if ($disability == "Yes" && $disability_percentage >= 40 && $caste != "Ex-servicemen") {
                    $db_age_new = $db_age['age_limit'] + 13;
                } else if ($disability == "Yes" && $disability_percentage >= 40 && $caste == "Ex-servicemen") {
                    $db_age_new = $db_age['age_limit'] + $length_of_service_new + 16;
                } else if ($disability == "No" && $caste != "Ex-servicemen") {
                    $db_age_new = $db_age['age_limit'] + 3;
                } else if ($disability == "No" && $caste == "Ex-servicemen") {
                    $db_age_new = $db_age['age_limit'] + $length_of_service_new + 3;
                } else {
                    $db_age_new = $db_age['age_limit'] + 3;
                }
            } else {
                if ($disability == "Yes" && $disability_percentage >= 40 && $caste != "Ex-servicemen") {
                    $db_age_new = $db_age['age_limit'] + 10;
                } else if ($disability == "Yes" && $disability_percentage >= 40 && $caste == "Ex-servicemen") {
                    $db_age_new = $db_age['age_limit'] + $length_of_service_new + 13;
                } else if ($disability == "No" && $caste != "Ex-servicemen") {
                    $db_age_new = $db_age['age_limit'];
                } else if ($disability == "No" && $caste == "Ex-servicemen") {
                    $db_age_new = $db_age['age_limit'] + $length_of_service_new + 3;
                } else {
                    $db_age_new = $db_age['age_limit'];
                }
            }
        } else if ($inf_employee == "Yes") {
            $db_age_new = 58;
        } else {
            $db_age_new = $db_age['age_limit'];
        }

        /* if (($caste == "SC" || $caste == "ST" || $caste == "OBC") && ($db_age['category'] != "Admin") && ($inf_employee == "No") && ($caste != "Ex-servicemen")) {
          if ($disability == "Yes" && $disability_percentage >= 40) {
          if ($caste == "SC" || $caste == "ST") {
          $db_age_new = $db_age['age_limit'] + 20;
          } else if ($caste == "OBC") {
          $db_age_new = $db_age['age_limit'] + 18;
          }
          } else {
          $db_age_new = $db_age['age_limit'] + 5;
          }
          } else if ($disability == "Yes" && $disability_percentage >= 40) {
          if ($caste == "GENERAL") {
          $db_age_new = $db_age['age_limit'] + 10;
          } else if ($caste == "SC" || $caste == "ST") {
          $db_age_new = $db_age['age_limit'] + 15;
          } else if ($caste == "OBC") {
          $db_age_new = $db_age['age_limit'] + 13;
          }
          } else if ($inf_employee == "Yes" || $caste == "Ex-servicemen") {
          $db_age_new = $db_age['age_limit'] + 50;
          } else {
          $db_age_new = $db_age['age_limit'];
          } */

        $agenew1 = substr($agenew, 0, 2);

        // Print all relevant values
        // echo "<pre>";
        // echo "agenew: $agenew\n";
        // echo "agenew1: $agenew1\n";
        // echo "db_age_new: $db_age_new\n";
        // echo "disability: $disability\n";
        // echo "</pre>";
        // exit;

        if ($agenew1 > 56 && $disability == "Yes") {
            $_SESSION['registration_notification'] = '<div class="text-center alert alert-danger">Your age is greater than compare to required age limit 56, therefore you are not eligible for this post.</div>';
            header("Location:" . $_POST['redirect_url']);
        } else {
            if ($agenew1 <= $db_age_new && $agenew1 >= 18) {
                if ($db_age_new == $agenew1) {
                    if (strpos($agenew, 'and') !== false) {
                        // $_SESSION['registration_notification'] = '<div class="text-center alert alert-danger">Your age is greater than compare to required age limit ' . $db_age_new . ', therefore you are not eligible for this post.</div>';
                        if ($agenew1 < 18) {
                            $_SESSION['registration_notification'] = '<div class="text-center alert alert-danger">Your age is below 18, which is the minimum required age. Therefore, you are not eligible for this post.</div>';
                            header("Location:" . $_POST['redirect_url']);
                            exit;
                        }

                        if ($agenew1 > $db_age_new) {
                            $_SESSION['registration_notification'] = '<div class="text-center alert alert-danger">Your age exceeds the required age limit of ' . $db_age_new . '. Therefore, you are not eligible for this post.</div>';
                            header("Location:" . $_POST['redirect_url']);
                            exit;
                        }

                        header("Location:" . $_POST['redirect_url']);
                    } else {
                        // Secure version using prepared statement
                        $stmt = $link->prepare("SELECT MAX(srno) AS sr FROM prsnl");
                        $stmt->execute();
                        $result = $stmt->get_result();


                        while ($row = mysqli_fetch_array($result)) {
                            $srno = $row['sr'];
                            $srno = $srno + 1;
                        }

                        $unid = $post . '-' . $srno;
                        $criminal = '';
                        $court = '';
                        $pdetails = '';
                        $ctdetails = '';
                        $crdetails = '';
                        $cate1 = '';
                        $caste = $caste;
                        $file_1_path = '';

                        $new_password = rand(11111111, 99999999);
                        $enc_password = md5($new_password);
                        $status = 'panding';

                        $current_date = date("Y-m-d H:i:s");
                        $enc_current_date = strtotime($current_date);

                        $certi_file_path = '';
                        if ($_FILES["caste_certi"]["name"]) {
                            $temp1 = explode(".", $_FILES["caste_certi"]["name"]);
                            $newfilename = md5($unid) . md5($enc_current_date) . md5('caste') . '.' . end($temp1);
                            $certi_file_path = 'uploads/caste/' . $newfilename;
                            move_uploaded_file($_FILES["caste_certi"]["tmp_name"], $certi_file_path);
                        }

                        $disability_certi_path = '';
                        if ($_FILES["disability_certi"]["name"]) {
                            $temp = explode(".", $_FILES["disability_certi"]["name"]);
                            $newfilename = md5($unid) . md5($enc_current_date) . md5('disability') . '.' . end($temp);
                            $disability_certi_path = 'uploads/disability/' . $newfilename;
                            move_uploaded_file($_FILES["disability_certi"]["tmp_name"], $disability_certi_path);
                        }

                        $stenography_certi_path = '';
                        if ($_FILES["stenography_certi"]["name"]) {
                            $temp3 = explode(".", $_FILES["stenography_certi"]["name"]);
                            $newfilename3 = md5($unid) . md5($enc_current_date) . md5('stenography') . '.' . end($temp3);
                            $stenography_certi_path = 'uploads/steno/' . $newfilename3;
                            move_uploaded_file($_FILES["stenography_certi"]["tmp_name"], $stenography_certi_path);
                        }

                        $typing_certi_path = '';
                        if ($_FILES["typing_certi"]["name"]) {
                            $temp2 = explode(".", $_FILES["typing_certi"]["name"]);
                            $newfilename2 = md5($unid) . md5($enc_current_date) . md5('typing') . '.' . end($temp2);
                            $typing_certi_path = 'uploads/typing/' . $newfilename2;
                            move_uploaded_file($_FILES["typing_certi"]["tmp_name"], $typing_certi_path);
                        }

                        $sql1 = "insert into prsnl VALUES(0,'$unid','$enc_password','$job_type','$prefix','$surname','$firstname','$fathername','$fatherorhusband','$dob','$sex','$nation','$address','$state','$telephone','$city','$pincode','$paddress','$pstate','$pcity','$ppincode','$same_address','$mobile','$aadhar_no','$email','$mstatus','$post','$job_location','$regdate','$status','$file_1_path','$caste','$certi_file_path','$certi_no','$issue_year','$serving','$type_of_service','$authority','$agenew','$app_status','$brawser_h','$is_upload','$status_remarks','$disability','$type_of_disability','$disability_percentage','$disability_certi_path','$stenoGraphy_speed','$stenography_certi_no','$stenography_certi_date','$stenography_certi_path','$typing_speed','$typing_certi_no','$typing_certi_date','$typing_certi_path','$typing_language','$inf_employee','$payroll_no','$type_of_job','$length_of_service','$service_from_date','$service_to_date','$status_date')";
                        $result1 = mysqli_query($link, $sql1);

                        //                        $sql1 = $link->prepare("INSERT INTO prsnl(id, password, job_type, prefix, surname, name, fathername, lastname, dob, sex, nation, address, state, telephone, city, pincode, paddress, pstate, pcity, ppincode, same_address, mobile, aadhar_no, email, mstatus, post, job_location, regdate, status, photo, category, caste_certi, caste_certino, caste_certi_issue_year, serving, type_of_service, authority, age, status_check, browser_history, is_upload, status_remarks, disability, type_of_disability, disability_percentage, disability_certi, stenoGraphy_speed, stenography_certi_no, stenography_certi_date, stenography_certi, typing_speed, typing_certi_no, typing_certi_date, typing_certi, typing_language, inf_employee, payroll_no, type_of_job, length_of_service, service_from_date, service_to_date, status_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                        //                        $sql1->bind_param("ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss", $unid, $enc_password, $job_type, $prefix, $surname, $firstname, $fathername, $fatherorhusband, $dob, $sex, $nation, $address, $state, $telephone, $city, $pincode, $paddress, $pstate, $pcity, $ppincode, $same_address, $mobile, $aadhar_no, $email, $mstatus, $post, $job_location, $regdate, $status, $file_1_path, $caste, $certi_file_path, $certi_no, $issue_year, $serving, $type_of_service, $authority, $agenew, $app_status, $brawser_h, $is_upload, $status_remarks, $disability, $type_of_disability, $disability_percentage, $disability_certi_path, $stenoGraphy_speed, $stenography_certi_no, $stenography_certi_date, $stenography_certi_path, $typing_speed, $typing_certi_no, $typing_certi_date, $typing_certi_path, $typing_language, $inf_employee, $payroll_no, $type_of_job, $length_of_service, $service_from_date, $service_to_date, $status_date);
                        //                        $sql1->execute();

                        //                        if ($result1) {
                        $sql2 = "insert into edctn VALUES(0,'$unid','','','','','','', '','','','','', '','','','','', '','','','','', '','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','')";
                        $result2 = mysqli_query($link, $sql2);

                        $sql3 = "insert into exprn VALUES(0,'$unid','', '','','','','','', '','','','','','', '','','','','','', '','','','','','', '','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','n','No')";
                        $result3 = mysqli_query($link, $sql3);

                        $sql4 = "insert into othrs VALUES(0,'$unid','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','n','No','','','',NULL)";
                        $result4 = mysqli_query($link, $sql4);

                        $sql5 = "select prefix, surname,name,fathername,post from prsnl where id='$unid'";
                        $result5 = mysqli_query($link, $sql5);

                        //                        $sql5 = $link->prepare("select prefix, surname,name,fathername,post from prsnl where id=?");
                        //                        $sql5->bind_param("s", $unid);
                        //                        $sql5->execute();
                        //                        $result5 = $sql5->get_result();

                        $sql_ua = "insert into history_admitcard VALUES(0,'$ua_browser','$ua_version','$ua_platform','$ua_ip','$ua_date','$ua_time','$unid','Register for Application')";
                        $result_ua = mysqli_query($link, $sql_ua);

                        //                        $activity = "Register for Application";
                        //                        $sql_ua = $link->prepare("INSERT INTO history_admitcard(browser, version, platform, ip, date, time, user_id, activity) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                        //                        $sql_ua->bind_param("ssssssss", $ua_browser, $ua_version, $ua_platform, $ua_ip, $ua_date, $ua_time, $unid, $activity);
                        //                        $sql_ua->execute();
                        //                        }

                        if ($result5) {
                            $row5 = mysqli_fetch_row($result5);
                        }

                        $sql6 = "select * from req_experience where status='OPEN' and post='$post'";
                        $result6 = mysqli_query($link, $sql6);

                        //                        $sql6 = $link->prepare("select * from req_experience where status='OPEN' and post=?");
                        //                        $sql6->bind_param("s", $post);
                        //                        $sql6->execute();
                        //                        $result6 = $sql6->get_result();

                        if (mysqli_num_rows($result6) > 0) {
                            while ($row6 = mysqli_fetch_assoc($result6)) {
                                if ($row6['category'] == '') {
                                    $val = $row6['post_id'] . '-' . $row6['sequence'] . '-' . $row6['year'];
                                    if ($row5[4] == $val) {
                                        $post_name = $row6['Name'];
                                        $closing_date = $row6['closed_date'];
                                    }
                                } else {
                                    //                                if ($row6['category'] == 'Finance') {
                                    //                                    $post_category = 'Admin';
                                    //                                } else {
                                    //                                    $post_category = $row6['category'];
                                    //                                }
                                    //                                $val = $row6['post_id'] . $post_category . '-' . $row6['sequence'] . '-' . $row6['year'];
                                    //                                if ($row5[4] == $val) {
                                    $post_name = $row6['Name'] . '(' . $row6['category'] . ')';
                                    $closing_date = $row6['closed_date'];
                                    //                                }
                                }
                            }
                        }

                        $mail_name = $row5[0] . ' ' . $row5[1] . ' ' . $row5[2] . ' ' . $row5[3];
                        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
                        try {
                            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                            $mail->isSMTP();                                      // Set mailer to use SMTP
                            $mail->Host = 'smtp.office365.com';  // Specify main and backup SMTP servers
                            $mail->SMTPAuth = true;                               // Enable SMTP authentication
                            $mail->Username = 'no-reply@mail.inflibnet.ac.in';                 // SMTP username
                            $mail->Password = 'No@gK21C!R#lyTpm';                           // SMTP password
                            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                            $mail->Port = 587;                                    // TCP port to connect to
                            $mail->setFrom('no-reply@mail.inflibnet.ac.in', 'INFLIBNET Centre');
                            $mail->addAddress($email);     // Add a recipient
                            $mail->isHTML(true);
                            $mail->Subject = "Login credentials for the post of $post_name";

                            $message = '<table cellpadding="10" width="100%" border="1">
                <tr>
                <td style="border:none;">
                Dear ' . $mail_name . ',<br/><br/>
                Please find your login credentials for an online application for the post of ' . $post_name . ':<br/>
                <b>URL: </b><a href="https://recruitment.inflibnet.ac.in/login.php">https://recruitment.inflibnet.ac.in/login.php</a><br/>
                <b>Application ID : </b>' . $unid . '<br/>' . '<b>Password : </b>' . $new_password . '
                </td>
                </tr>
                <tr> <td style="border:none;"> </td> </tr>
                    <tr> <td style="border:none;"> <b>Note:</b> This is an auto generated email. In case of any technical queries please contact: recruitment[at]inflibnet[dot]ac[dot]in</td> </tr>
                 <tr>
                <td style="border:none;padding-top:25px">
                With regards,<br/>
                INFLIBNET Centre, Gandhinagar

                </td>
                </tr>
                </table>';
                            $mail->Body = $message;
                            if ($mail->send()) {
                                $_SESSION['notification'] = "<br/><div class='text-center alert alert-success'>Your Application ID and Password have been sent to your registered email ID.<br/>Kindly login and complete the application.</div>";
                                header("Location: login.php");
                            }
                        } catch (Exception $e) {
                        }
                    }
                } else {
                    $sql = "select max(srno) as sr from prsnl";
                    $result = mysqli_query($link, $sql);

                    while ($row = mysqli_fetch_array($result)) {
                        $srno = $row['sr'];
                        $srno = $srno + 1;
                    }

                    $unid = $post . '-' . $srno;
                    $criminal = '';
                    $court = '';
                    $pdetails = '';
                    $ctdetails = '';
                    $crdetails = '';
                    $cate1 = '';
                    $caste = $caste;
                    $file_1_path = '';

                    $new_password = rand(11111111, 99999999);
                    $enc_password = md5($new_password);
                    $status = 'panding';

                    $current_date = date("Y-m-d H:i:s");
                    $enc_current_date = strtotime($current_date);

                    $certi_file_path = '';
                    if ($_FILES["caste_certi"]["name"]) {
                        $temp1 = explode(".", $_FILES["caste_certi"]["name"]);
                        $newfilename = md5($unid) . md5($enc_current_date) . md5('caste') . '.' . end($temp1);
                        $certi_file_path = 'uploads/caste/' . $newfilename;
                        move_uploaded_file($_FILES["caste_certi"]["tmp_name"], $certi_file_path);
                    }

                    $disability_certi_path = '';
                    if ($_FILES["disability_certi"]["name"]) {
                        $temp = explode(".", $_FILES["disability_certi"]["name"]);
                        $newfilename = md5($unid) . md5('disability') . md5($enc_current_date) . '.' . end($temp);
                        $disability_certi_path = 'uploads/disability/' . $newfilename;
                        move_uploaded_file($_FILES["disability_certi"]["tmp_name"], $disability_certi_path);
                    }

                    $stenography_certi_path = '';
                    if ($_FILES["stenography_certi"]["name"]) {
                        $temp3 = explode(".", $_FILES["stenography_certi"]["name"]);
                        $newfilename3 = md5('stenography') . md5($enc_current_date) . md5($unid) . '.' . end($temp3);
                        $stenography_certi_path = 'uploads/steno/' . $newfilename3;
                        move_uploaded_file($_FILES["stenography_certi"]["tmp_name"], $stenography_certi_path);
                    }

                    $typing_certi_path = '';
                    if ($_FILES["typing_certi"]["name"]) {
                        $temp2 = explode(".", $_FILES["typing_certi"]["name"]);
                        $newfilename2 = md5($enc_current_date) . md5('typing') . md5($unid) . '.' . end($temp2);
                        $typing_certi_path = 'uploads/typing/' . $newfilename2;
                        move_uploaded_file($_FILES["typing_certi"]["tmp_name"], $typing_certi_path);
                    }

                    $sql1 = "insert into prsnl VALUES(0,'$unid','$enc_password','$job_type','$prefix','$surname','$firstname','$fathername','$fatherorhusband','$dob','$sex','$nation','$address','$state','$telephone','$city','$pincode','$paddress','$pstate','$pcity','$ppincode','$same_address','$mobile','$aadhar_no','$email','$mstatus','$post','$job_location','$regdate','$status','$file_1_path','$caste','$certi_file_path','$certi_no','$issue_year','$serving','$type_of_service','$authority','$agenew','$app_status','$brawser_h','$is_upload','$status_remarks','$disability','$type_of_disability','$disability_percentage','$disability_certi_path','$stenoGraphy_speed','$stenography_certi_no','$stenography_certi_date','$stenography_certi_path','$typing_speed','$typing_certi_no','$typing_certi_date','$typing_certi_path','$typing_language','$inf_employee','$payroll_no','$type_of_job','$length_of_service','$service_from_date','$service_to_date','$status_date')";
                    $result1 = mysqli_query($link, $sql1);
                    //                    $sql1 = $link->prepare("INSERT INTO prsnl(id, password, job_type, prefix, surname, name, fathername, lastname, dob, sex, nation, address, state, telephone, city, pincode, paddress, pstate, pcity, ppincode, same_address, mobile, aadhar_no, email, mstatus, post, job_location, regdate, status, photo, category, caste_certi, caste_certino, caste_certi_issue_year, serving, type_of_service, authority, age, status_check, browser_history, is_upload, status_remarks, disability, type_of_disability, disability_percentage, disability_certi, stenoGraphy_speed, stenography_certi_no, stenography_certi_date, stenography_certi, typing_speed, typing_certi_no, typing_certi_date, typing_certi, typing_language, inf_employee, payroll_no, type_of_job, length_of_service, service_from_date, service_to_date, status_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    //                    $sql1->bind_param("ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss", $unid, $enc_password, $job_type, $prefix, $surname, $firstname, $fathername, $fatherorhusband, $dob, $sex, $nation, $address, $state, $telephone, $city, $pincode, $paddress, $pstate, $pcity, $ppincode, $same_address, $mobile, $aadhar_no, $email, $mstatus, $post, $job_location, $regdate, $status, $file_1_path, $caste, $certi_file_path, $certi_no, $issue_year, $serving, $type_of_service, $authority, $agenew, $app_status, $brawser_h, $is_upload, $status_remarks, $disability, $type_of_disability, $disability_percentage, $disability_certi_path, $stenoGraphy_speed, $stenography_certi_no, $stenography_certi_date, $stenography_certi_path, $typing_speed, $typing_certi_no, $typing_certi_date, $typing_certi_path, $typing_language, $inf_employee, $payroll_no, $type_of_job, $length_of_service, $service_from_date, $service_to_date, $status_date);
                    //                    $sql1->execute();

                    //                    if ($result1) {
                    $sql2 = "insert into edctn VALUES(0,'$unid','','','','','','','','','','','', '','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','')";
                    $result2 = mysqli_query($link, $sql2);

                    $sql3 = "insert into exprn VALUES(0,'$unid','', '','','','','','', '','','','','','', '','','','','','', '','','','','','', '','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','n','No')";
                    $result3 = mysqli_query($link, $sql3);

                    $sql4 = "insert into othrs VALUES(0,'$unid','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','n','No','','','',NULL)";
                    $result4 = mysqli_query($link, $sql4);

                    $sql5 = "select prefix, surname,name,fathername,post from prsnl where id='$unid'";
                    $result5 = mysqli_query($link, $sql5);

                    //                    $sql5 = $link->prepare("select prefix, surname,name,fathername,post from prsnl where id=?");
                    //                    $sql5->bind_param("s", $unid);
                    //                    $sql5->execute();
                    //                    $result5 = $sql5->get_result();

                    $sql_ua = "insert into history_admitcard VALUES(0,'$ua_browser','$ua_version','$ua_platform','$ua_ip','$ua_date','$ua_time','$unid','Register for Application')";
                    $result_ua = mysqli_query($link, $sql_ua);

                    //                    $activity = "Register for Application";
                    //                    $sql_ua = $link->prepare("INSERT INTO history_admitcard(browser, version, platform, ip, date, time, user_id, activity) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                    //                    $sql_ua->bind_param("ssssssss", $ua_browser, $ua_version, $ua_platform, $ua_ip, $ua_date, $ua_time, $unid, $activity);
                    //                    $sql_ua->execute();
                    //                    }
                    if ($result5) {
                        $row5 = mysqli_fetch_row($result5);
                    }

                    $sql6 = "select * from req_experience where status='OPEN' and post='$post'";
                    $result6 = mysqli_query($link, $sql6);
                    //                    $sql6 = $link->prepare("select * from req_experience where status='OPEN' and post=?");
                    //                    $sql6->bind_param("s", $post);
                    //                    $sql6->execute();
                    //                    $result6 = $sql6->get_result();

                    if (mysqli_num_rows($result6) > 0) {
                        while ($row6 = mysqli_fetch_assoc($result6)) {
                            if ($row6['category'] == '') {
                                $val = $row6['post_id'] . '-' . $row6['sequence'] . '-' . $row6['year'];
                                if ($row5[4] == $val) {
                                    $post_name = $row6['Name'];
                                    $closing_date = $row6['closed_date'];
                                }
                            } else {
                                //                                if ($row6['category'] == 'Finance') {
                                //                                    $post_category = 'Admin';
                                //                                } else {
                                //                                    $post_category = $row6['category'];
                                //                                }
                                //                                $val = $row6['post_id'] . $post_category . '-' . $row6['sequence'] . '-' . $row6['year'];
                                //                                if ($row5[4] == $val) {
                                $post_name = $row6['Name'] . '(' . $row6['category'] . ')';
                                $closing_date = $row6['closed_date'];
                                //                                }
                            }
                        }
                    }

                    $mail_name = $row5[0] . ' ' . $row5[1] . ' ' . $row5[2] . ' ' . $row5[3];
                    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
                    try {
                        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                        $mail->isSMTP();                                      // Set mailer to use SMTP
                        $mail->Host = 'smtp.office365.com';  // Specify main and backup SMTP servers
                        $mail->SMTPAuth = true;                               // Enable SMTP authentication
                        $mail->Username = 'no-reply@mail.inflibnet.ac.in';                 // SMTP username
                        $mail->Password = 'No@gK21C!R#lyTpm';                           // SMTP password
                        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                        $mail->Port = 587;                                    // TCP port to connect to
                        $mail->setFrom('no-reply@mail.inflibnet.ac.in', 'INFLIBNET Centre');
                        $mail->addAddress($email);     // Add a recipient
                        $mail->isHTML(true);
                        $mail->Subject = "Login credentials for the post of $post_name";

                        $message = '<table cellpadding="10" width="100%" border="1">
                <tr>
                <td style="border:none;">
               Dear ' . $mail_name . ',<br/><br/>
                Please find your login credentials for an online application for the post of ' . $post_name . ':<br/>
                <b>URL: </b><a href="https://recruitment.inflibnet.ac.in/login.php">https://recruitment.inflibnet.ac.in/login.php</a><br/>
                <b>Application ID : </b>' . $unid . '<br/>' . '<b>Password : </b>' . $new_password . '
                </td>
                </tr>
                <tr> <td style="border:none;"> </td> </tr>
                    <tr> <td style="border:none;"> <b>Note:</b> This is an auto generated email. In case of any technical queries please contact: recruitment[at]inflibnet[dot]ac[dot]in</td> </tr>
                 <tr>
                <td style="border:none;padding-top:25px">
                With regards,<br/>
                INFLIBNET Centre, Gandhinagar

                </td>
                </tr>
                </table>';
                        $mail->Body = $message;
                        if ($mail->send()) {
                            $_SESSION['notification'] = "<br/><div class='text-center alert alert-success'>Your Application ID and Password have been sent to your registered email ID.<br/>Kindly Login and complete the application.</div>";
                            header("Location: login.php");
                        }
                    } catch (Exception $e) {
                    }
                    //                    $sql = "select prsnl.id as app_id,prsnl.*,edctn.*,exprn.*,othrs.* from prsnl,edctn,exprn,othrs where othrs.id ='$unid' and edctn.id ='$unid' and exprn.id ='$unid' and prsnl.id ='$unid'";
                    //                    $result = mysqli_query($link, $sql);
                    //                    if ($result) {
                    //                        if (mysqli_num_rows($result) == 0) {
                    //
                    //                        } else {
                    //                            while ($row = mysqli_fetch_assoc($result)) {
                    //
                    //                                if ($row['status'] == 'panding') {
                    //                                    session_start();
                    //                                    $_SESSION['is_login'] = 'true';
                    //                                }
                    //                            }
                    //                        }
                    //                    }
                }
            } else {
                // $_SESSION['registration_notification'] = '<div class="text-center alert alert-danger">Your age is greater than compare to required age limit ' . $db_age_new . ', therefore you are not eligible for this post.</div>';

                if ($agenew1 < 18) {
                    $_SESSION['registration_notification'] = '<div class="text-center alert alert-danger">Your age is below 18, which is the minimum required age. Therefore, you are not eligible for this post.</div>';
                    header("Location:" . $_POST['redirect_url']);
                    exit;
                }

                if ($agenew1 > $db_age_new) {
                    $_SESSION['registration_notification'] = '<div class="text-center alert alert-danger">Your age exceeds the required age limit of ' . $db_age_new . '. Therefore, you are not eligible for this post.</div>';
                    header("Location:" . $_POST['redirect_url']);
                    exit;
                }

                header("Location:" . $_POST['redirect_url']);
            }
        }
    } else {
        $_SESSION['registration_notification'] = '<div class="text-center alert alert-danger">Email id already registered for this Post.</div>';
        header("Location:" . $_POST['redirect_url']);
    }
} else if (isset($_POST['reset_password'])) {
    $appli_id = trim($_POST["app_id"]);
    $email = trim($_POST["email"]);

    $new_password = rand(11111111, 99999999);
    $enc_password = md5($new_password);

    $check_data = "select email, post, id from prsnl where email='$email' and id='$appli_id'";
    $result_check = mysqli_query($link, $check_data);

    if (mysqli_num_rows($result_check) > 0) {
        while ($row_check = mysqli_fetch_assoc($result_check)) {
            if ($row_check['email'] == $email && $row_check['id'] == $appli_id) {

                $sql = "update prsnl set password='$enc_password' where email='$email' and id='$appli_id'";
                $result = mysqli_query($link, $sql);

                $sql = "select prefix,surname,name,fathername,id from prsnl where email='$email' and id='$appli_id'";
                $result = mysqli_query($link, $sql);

                //                $sql = $link->prepare("select prefix,surname,name,fathername,id from prsnl where email=? and id=?");
                //                $sql->bind_param("ss", $email, $appli_id);
                //                $sql->execute();
                //                $result = $sql->get_result();

                $sql_ua = "insert into history_admitcard VALUES(0,'$ua_browser','$ua_version','$ua_platform','$ua_ip','$ua_date','$ua_time','$appli_id','Reset Password')";
                $result_ua = mysqli_query($link, $sql_ua);

                //                $activity = "Reset Password";
                //                $sql_ua = $link->prepare("INSERT INTO history_admitcard(browser, version, platform, ip, date, time, user_id, activity) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                //                $sql_ua->bind_param("ssssssss", $ua_browser, $ua_version, $ua_platform, $ua_ip, $ua_date, $ua_time, $appli_id, $activity);
                //                $sql_ua->execute();

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {

                        $mail_name = $row['prefix'] . ' ' . $row['surname'] . ' ' . $row['name'] . ' ' . $row['fathername'];
                        $app_id = $row['id'];

                        $mail = new PHPMailer(true);
                        try {
                            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                            $mail->isSMTP();                                      // Set mailer to use SMTP
                            $mail->Host = 'smtp.office365.com';  // Specify main and backup SMTP servers
                            $mail->SMTPAuth = true;                               // Enable SMTP authentication
                            $mail->Username = 'no-reply@mail.inflibnet.ac.in';                 // SMTP username
                            $mail->Password = 'No@gK21C!R#lyTpm';                           // SMTP password
                            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                            $mail->Port = 587;                                    // TCP port to connect to
                            $mail->setFrom('no-reply@mail.inflibnet.ac.in', '');
                            $mail->addAddress($email);     // Add a recipient
                            $mail->isHTML(true);
                            $mail->Subject = "Forget Password: INFLIBNET";

                            $message = '<table cellpadding="10" width="100%" border="1">
                            <tr>
                            <td style="border:none;">
                            Dear ' . $mail_name . ',  </td>
                            </tr>   <tr>
                            <td style="border:none;">
                            Your password has been reset by the system.<br/>

                            Your new password is : <b>' . $new_password . '</b>
                            <br/>Please login with your application ID(<b>' . $app_id . '</b>) and new password.</td></tr>
                           <tr> <td style="border:none;"> </td> </tr>
                    <tr> <td style="border:none;"> <b>Note:</b> This is an auto generated email. In case of any technical queries please contact: recruitment[at]inflibnet[dot]ac[dot]in</td> </tr>
                 <tr>
                <td style="border:none;padding-top:25px">
                With regards,<br/>
                INFLIBNET Centre, Gandhinagar

                </td>
                </tr>
                            </table>';
                            $mail->Body = $message;

                            if ($mail->send()) {
                                $_SESSION['forget_msg'] = '<div class="text-center alert alert-success">An email has been sent to your registered email id to reset password.</div>';
                                header("Location:forget_password.php");
                            } else {
                                $_SESSION['forget_msg'] = '<div class="text-center alert alert-danger">Something went wrong, Please try again.</div>';
                                header("Location:forget_password.php");
                            }
                        } catch (Exception $e) {
                            echo $e->getMessage();
                            exit;
                        }
                    }
                }
            } else {
                $_SESSION['forget_msg'] = '<div class="text-center alert alert-danger">Your email doest not match with our records. If any query, Please email us on recruitment@inflibnet.ac.in</div>';
                header("Location:forget_password.php");
            }
        }
    } else {
        $_SESSION['forget_msg'] = '<div class="text-center alert alert-danger">Your email doest not match with our records. If any query, Please email us on recruitment@inflibnet.ac.in.</div>';
        header("Location:forget_password.php");
    }
}
?>
<?php

function my_error_handler($errno, $errstr, $errfile, $errline)
{
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

function my_exception_handler($e)
{

    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    session_register_shutdown();

    $_SESSION['error'] = $e;

    header('Location: login.php');
    exit();
}

//set_error_handler('my_error_handler');
//set_exception_handler('my_exception_handler');
?>

<?php
if (!isset($_POST['save_temp']) && isset($_SESSION['notification']) && $_SESSION['notification'] != '') {
    $notification = $_SESSION['notification'];
    unset($_SESSION['notification']);
    session_destroy();
}
?>

<?php include 'header.php'; ?>
<style>
    .login-form {
        width: 400px;
        margin: 25px auto;
        float: left;
    }

    .login-form form {
        margin-bottom: 15px;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        background: rgba(217, 215, 215, 0.21);
        border: 1px solid rgba(255, 255, 255, .2);
        border-top: 4px solid #191e5d;
        padding: 30px;
    }

    .login-form h2 {
        margin: 0 0 15px;
        text-transform: uppercase;
        color: #ffffff;
    }

    .login-btn {
        color: #fff;
        background-color: #f2660e;
        border-color: #f2660e;
    }

    .login-btn:hover {
        color: #fff;
        background-color: #191e5d;
        border-color: #191e5d;
    }
</style>
<div class="container">
    <?php echo $notification; ?>
    <div class="login-form">
        <?php
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
        ?>
        <form name="form1" method="post" onSubmit="return check_captcha();">
            <h2 class="text-center">Log In</h2>
            <div class="form-group">
                <span style="color:red"><?php echo $msg; ?></span>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Application Id" id="regid" name="regid" required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" id="password" name="password" required="required">
            </div>
            <div class="form-group">
                <img id="captcha_img" src="captcha.php" alt="CAPTCHA" height="32" width="80" />
                <a href='javascript: refresh_captcha();'><img id="" src="images/refresh.png" height="40" width="40" /></a>
                <input type="text" id="captcha_code" name="captcha_code" class="form-control" placeholder="Enter captcha" autocomplete="off" />
            </div>
            <div class="form-group">
                <button type="submit" name="Submit" class="login-btn btn btn-block">Log in</button>
            </div>
            <div class="clearfix">
                <p class="text-center pull-left"><a href="index.php">Go to Home</a></p>
                <a href="forget_password.php" class="pull-right">Forgot Password ?</a>
            </div>
        </form>

    </div>
</div>
</div>
<?php include 'footer.php'; ?>
</body>

</html>
<script>
    function check_captcha() {
        if (document.form1.captcha_code.value == "") {
            alert("Please Enter Captcha.");
            return false;
        } else {
            return true;
        }
    }
    //    $("#captcha_code").focusout(function (event) {
    //        $.ajax({
    //            url: 'validate_captcha.php',
    //            data: {code: $("input[name='captcha_code']").val()},
    //            dataType: 'json',
    //            type: 'post',
    //            success: function (data) {
    //                if (data == "true") {
    //                    return true;
    //                    //alert("Captcha is Good");
    //                }
    //                if (data == "false") {
    //                    alert("Captcha is Incorrect.");
    //                    event.preventDefault();
    //                    return false;
    //                }
    //            }
    //        });
    //    });
    function refresh_captcha() {

        $("#captcha_img").replaceWith('<img id="captcha_img" src="captcha.php" alt="CAPTCHA" height="40" width="100" />');
    }
</script>