<?php
session_start();
//error_reporting(E_ALL ^ E_DEPRECATED);
error_reporting(0);
include "dbConfig.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
$srno = 0;
$unid = "";
$mail_name = '';

if (isset($_POST['Submit'])) {

    $result = "";
    $regid = trim(mysqli_real_escape_string($link, $_POST['regid']));
    $password = trim(mysqli_real_escape_string($link, $_POST['password']));
    $password = md5($password);

    $sql = "select p.id as app_id, p.*, e.*, ep.*, o.*, re.category as post_category, re.Name, re.closed_date, re.year, re.exam_date, re.exam_time from prsnl p left join edctn e on p.id = e.id left join exprn ep on p.id = ep.id left join othrs o on p.id = o.id left join req_experience re on re.post = p.post where p.id ='$regid' and p.password = '$password'";
    $result = mysqli_query($link, $sql);

    if ($result) {
        if (mysqli_num_rows($result) == 0) {
            $msg = " Incorrect ID or Password.";
        } else {
            while ($row = mysqli_fetch_assoc($result)) {

                if ($row['year'] == "2020" || $row['year'] == "2019") {
                    session_start();
                    if ($_POST["captcha_code"] != $_SESSION["code"]) {
                        $msg = " Incorrect Captcha.";
                    } else {
                        if ($password != $row['password']) {
                            $msg = "Incorrect Password.";
                        } else {
                            date_default_timezone_set('Asia/Kolkata');
                            $current_date = date("Y-m-d H:i:s");
                            $dateTimestamp1 = strtotime($current_date);

                            $db_date = date("Y-m-d H:i:s", strtotime(strtr($row['closed_date'], '/', '-')));
                            $dateTimestamp2 = strtotime($db_date);

                                $ua = getBrowser();
                                //$brawser_h = implode(", ", $ua);
                                $ua_browser = $ua['name'];
                                $ua_version = $ua['version'];
                                $ua_platform = $ua['platform'];
                                $ua_ip = $_SERVER['REMOTE_ADDR'];
                                $ua_date = date("Y-m-d");
                                $ua_time = date("H:i:s");

                            if ($row['status'] == 'current' && $row['status_check']=='Eligible' && $row['exam_date'] != '' && $row['post_category'] == 'CS' && ($row['year'] == '2020' || $row['year'] == '2019')) {
                                session_start();
                                $_SESSION['is_login'] = 'true';
                                $_SESSION['app_id'] = $regid;
                                $_SESSION['post'] = $row['post'];
                                $_SESSION['post_category'] = $row['post_category'];
                                $_SESSION['Name'] = $row['Name'];
                                $_SESSION['prefix'] = $row['prefix'];
                                $_SESSION['surname'] = $row['surname'];
                                $_SESSION['fathername'] = $row['fathername'];
                                $_SESSION['name'] = $row['name'];
                                $_SESSION['lastname'] = $row['lastname'];
                                $_SESSION['dob'] = $row['dob'];
                                $_SESSION['photo'] = $row['photo'];
                                $_SESSION['exam_date'] = $row['exam_date'];
                                $_SESSION['exam_time'] = $row['exam_time'];
                                
                                $sql_download_admitcard = "update othrs set download_admitcard='Yes' where id='$regid'";
                                $result_download_admitcard = mysqli_query($link, $sql_download_admitcard);
                            
                                $sql_ua = "insert into history_admitcard VALUES(0,'$ua_browser','$ua_version','$ua_platform','$ua_ip','$ua_date','$ua_time','$regid','Login for Download Admit Card')";
                                $result_ua = mysqli_query($link, $sql_ua);                                

                                header("location:admit_card.php");

                            } else if($row['status'] == 'current'){
                                session_start();
                                $_SESSION['is_login'] = 'true';
                                $_SESSION['user'] = $row['name'] . $row['surname'];
                                $_SESSION['app_id'] = $regid;

                                $sql_ua = "insert into history_admitcard VALUES(0,'$ua_browser','$ua_version','$ua_platform','$ua_ip','$ua_date','$ua_time','$regid','Login for Print Application')";
                                $result_ua = mysqli_query($link, $sql_ua);

                                header("location:print_application.php");
                                
                            }else if ($row['status'] == 'panding' && $dateTimestamp2 >= $dateTimestamp1) {
                                session_start();
                                $_SESSION['is_login'] = 'true';
                                $_SESSION['app_id'] = $regid;
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

                                $_SESSION['edu1'] = $row['edu1'];
                                $_SESSION['edu2'] = $row['edu2'];
                                $_SESSION['edu3'] = $row['edu3'];
                                $_SESSION['edu4'] = $row['edu4'];
                                $_SESSION['edu5'] = $row['edu5'];
                                $_SESSION['edu6'] = $row['edu6'];
                                $_SESSION['edu7'] = $row['edu7'];

                                $_SESSION['board1'] = $row['board1'];
                                $_SESSION['board2'] = $row['board2'];
                                $_SESSION['board3'] = $row['board3'];
                                $_SESSION['board4'] = $row['board4'];
                                $_SESSION['board5'] = $row['board5'];
                                $_SESSION['board6'] = $row['board6'];
                                $_SESSION['board7'] = $row['board7'];

                                $_SESSION['year1'] = $row['year1'];
                                $_SESSION['year2'] = $row['year2'];
                                $_SESSION['year3'] = $row['year3'];
                                $_SESSION['year4'] = $row['year4'];
                                $_SESSION['year5'] = $row['year5'];
                                $_SESSION['year6'] = $row['year6'];
                                $_SESSION['year7'] = $row['year7'];

                                $_SESSION['per1'] = $row['per1'];
                                $_SESSION['per2'] = $row['per2'];
                                $_SESSION['per3'] = $row['per3'];
                                $_SESSION['per4'] = $row['per4'];
                                $_SESSION['per5'] = $row['per5'];
                                $_SESSION['per6'] = $row['per6'];
                                $_SESSION['per7'] = $row['per7'];

                                $_SESSION['speci1'] = $row['spec1'];
                                $_SESSION['speci2'] = $row['spec2'];
                                $_SESSION['speci3'] = $row['spec3'];
                                $_SESSION['speci4'] = $row['spec4'];
                                $_SESSION['speci5'] = $row['spec5'];
                                $_SESSION['speci6'] = $row['spec6'];
                                $_SESSION['speci7'] = $row['spec7'];

                                $_SESSION['div1'] = $row['div1'];
                                $_SESSION['div2'] = $row['div2'];
                                $_SESSION['div3'] = $row['div3'];
                                $_SESSION['div4'] = $row['div4'];
                                $_SESSION['div5'] = $row['div5'];
                                $_SESSION['div6'] = $row['div6'];
                                $_SESSION['div7'] = $row['div7'];

                                $_SESSION['ssc_certi'] = $row['ssc_certi'];
                                $_SESSION['hsc_certi'] = $row['hsc_certi'];
                                $_SESSION['bachelor_certi'] = $row['bachelor_certi'];
                                $_SESSION['master_certi'] = $row['master_certi'];
                                $_SESSION['phd_certi'] = $row['phd_certi'];
                                $_SESSION['other_edu_certi'] = $row['other_edu_certi'];

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
                                $_SESSION['bank_name'] = $row['bank_name'];
                                $_SESSION['branch_name'] = $row['branch_name'];
                                //$_SESSION['previous_applied'] = $row['previous_applied'];
                                //$_SESSION['previous_app_id'] = $row['previous_app_id'];
                                //$_SESSION['fees_receipt'] = $row['fees_receipt'];
                                $_SESSION['grandtotal'] = $row['grandtotal'];
                                $_SESSION['expr_certi'] = $row['expr_certi'];
                                $_SESSION['app_id'] = $row['app_id'];
                                // $_SESSION['gov_project'] = $row['gov_project'];

                                $sql = "select category from req_experience where post ='" . $row['post'] . "'";
                                $result = mysqli_query($link, $sql);
                                $row = mysqli_fetch_assoc($result);

                                $_SESSION['category_job'] = $row['category'];
                                header("location:application_form.php");
                            } else {
                                $msg = "You can not procced further because of you are not submitted all the details and application has been closed.";
                            }
                        }
                    }
                } else {
                    $msg = "This post is closed.";
                }
            }
        }
    }
} else if (isset($_POST['save_temp'])) {

    $job_location = mysqli_real_escape_string($link, $_POST['job_location']);
    $job_type = mysqli_real_escape_string($link, $_POST['job_type']);

    $post = mysqli_real_escape_string($link, $_POST['post']);
    $nation = mysqli_real_escape_string($link, $_POST["nation"]);
    $prefix = mysqli_real_escape_string($link, $_POST['prefix']);
    $surname = mysqli_real_escape_string($link, $_POST["surname"]);
    $firstname = mysqli_real_escape_string($link, $_POST['fname']);
    $fatherorhusband = mysqli_real_escape_string($link, $_POST['lastname']);
    $fathername = mysqli_real_escape_string($link, $_POST["fathername"]);
    $caste = mysqli_real_escape_string($link, $_POST["caste"]);
    $issue_year = mysqli_real_escape_string($link, $_POST["issue_year"]);
    $certi_no = mysqli_real_escape_string($link, $_POST["certi_no"]);
    $dob = mysqli_real_escape_string($link, $_POST["dob"]);
    $agenew = mysqli_real_escape_string($link, $_POST['agenew']);
    $sex = mysqli_real_escape_string($link, $_POST["sex"]);
    $mstatus = mysqli_real_escape_string($link, $_POST["mstatus"]);
    $email = trim($_POST["email"]);
    $mobile = mysqli_real_escape_string($link, $_POST["mobile"]);
    $telephone = mysqli_real_escape_string($link, $_POST["telephone"]);
    $aadhar_no = mysqli_real_escape_string($link, $_POST["aadhar_no"]);
    $disability = mysqli_real_escape_string($link, $_POST['disability']);
    $disability_percentage = mysqli_real_escape_string($link, $_POST['disability_percentage']);
    $address = mysqli_real_escape_string($link, $_POST["address"]);
    $state = $_POST["state"];
    $city = mysqli_real_escape_string($link, $_POST["city"]);
    $pincode = mysqli_real_escape_string($link, $_POST["pincode"]);
    $same_address = mysqli_real_escape_string($link, $_POST["copy_address"]);
    $paddress = mysqli_real_escape_string($link, $_POST["paddress"]);
    $pstate = $_POST["pstate"];
    $pcity = mysqli_real_escape_string($link, $_POST["pcity"]);
    $ppincode = mysqli_real_escape_string($link, $_POST["ppincode"]);

    $stenoGraphy_speed = mysqli_real_escape_string($link, $_POST["stenoGraphy_speed"]);
    $stenography_certi_no = mysqli_real_escape_string($link, $_POST["stenography_certi_no"]);
    $stenography_certi_date = mysqli_real_escape_string($link, $_POST["stenography_certi_date"]);
    $typing_speed = mysqli_real_escape_string($link, $_POST["typing_speed"]);
    $typing_certi_no = mysqli_real_escape_string($link, $_POST["typing_certi_no"]);
    $typing_certi_date = mysqli_real_escape_string($link, $_POST["typing_certi_date"]);
    $typing_language = mysqli_real_escape_string($link, $_POST["typing_language"]);

    $inf_employee = mysqli_real_escape_string($link, $_POST["inf_employee"]);
    $payroll_no = mysqli_real_escape_string($link, $_POST["payroll_no"]);

    $authority = "";
    $app_status = "";
    $status_remarks = "";
    $is_upload = "n";
    $status_date = "";
    $ua = getBrowser();
    $brawser_h = implode(", ", $ua);
//$date = date("d/m/Y");

    $sql_check = "SELECT email, post, job_location FROM prsnl WHERE email='$email' AND post='$post' AND job_location='$job_location'";
    $result_check = mysqli_query($link, $sql_check);

    if (mysqli_num_rows($result_check) == 0) {
        $sql_age_check = "SELECT age_limit, category FROM req_experience WHERE post='$post'";
        $result_age_check = mysqli_query($link, $sql_age_check);
        $db_age = mysqli_fetch_assoc($result_age_check);

        if (($caste == "SC" || $caste == "ST" || $caste == "OBC") && ($db_age['category'] != "Admin") && ($inf_employee == "No") && ($caste != "Ex-servicemen")) {

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
        }

        $agenew1 = substr($agenew, 0, 2);

        if ($agenew1 > 56 && $disability == "Yes") {
            $_SESSION['registration_notification'] = '<div class="text-center alert alert-danger">Your age is greater than compare to required age limit 56, therefore you are not aligible for this post.</div>';
            header("Location:" . $_POST['redirect_url']);
        } else {
            if ($agenew1 <= $db_age_new) {
                if ($db_age_new == $agenew1) {
                    if (strpos($agenew, 'and') !== false) {
                        $_SESSION['registration_notification'] = '<div class="text-center alert alert-danger">Your age is greater than compare to required age limit ' . $db_age['age_limit'] . ', therefore you are not aligible for this post.</div>';
                        header("Location:" . $_POST['redirect_url']);
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

                        $certi_file_path = '';
                        if ($_FILES["caste_certi"]["name"]) {
                            $temp1 = explode(".", $_FILES["caste_certi"]["name"]);
                            $newfilename = $unid . '-caste.' . end($temp1);
                            $certi_file_path = 'uploads/caste/' . $newfilename;
                            move_uploaded_file($_FILES["caste_certi"]["tmp_name"], $certi_file_path);
                        }

                        $disability_certi_path = '';
                        if ($_FILES["disability_certi"]["name"]) {
                            $temp = explode(".", $_FILES["disability_certi"]["name"]);
                            $newfilename = $unid . '-disability.' . end($temp);
                            $disability_certi_path = 'uploads/disability/' . $newfilename;
                            move_uploaded_file($_FILES["disability_certi"]["tmp_name"], $disability_certi_path);
                        }

                        $stenography_certi_path = '';
                        if ($_FILES["stenography_certi"]["name"]) {
                            $temp3 = explode(".", $_FILES["stenography_certi"]["name"]);
                            $newfilename3 = $unid . '-stenography_certi.' . end($temp3);
                            $stenography_certi_path = 'uploads/steno/' . $newfilename3;
                            move_uploaded_file($_FILES["stenography_certi"]["tmp_name"], $stenography_certi_path);
                        }

                        $typing_certi_path = '';
                        if ($_FILES["typing_certi"]["name"]) {
                            $temp2 = explode(".", $_FILES["typing_certi"]["name"]);
                            $newfilename2 = $unid . '-typing_certi.' . end($temp2);
                            $typing_certi_path = 'uploads/typing/' . $newfilename2;
                            move_uploaded_file($_FILES["typing_certi"]["tmp_name"], $typing_certi_path);
                        }

                        $sql1 = "insert into prsnl VALUES(0,'$unid','$enc_password','$job_type','$prefix','$surname','$firstname','$fathername','$fatherorhusband','$dob','$sex','$nation','$address','$state','$telephone','$city','$pincode','$paddress','$pstate','$pcity','$ppincode','$same_address','$mobile','$aadhar_no','$email','$mstatus','$post','$job_location','$date','$status','$file_1_path','$caste','$certi_file_path','$certi_no','$issue_year','$authority','$agenew','$app_status','$brawser_h','$is_upload','$status_remarks','$disability','$disability_percentage','$disability_certi_path','$stenoGraphy_speed','$stenography_certi_no','$stenography_certi_date','$stenography_certi_path','$typing_speed','$typing_certi_no','$typing_certi_date',$typing_certi_path','$typing_language','$inf_employee','$payroll_no','$status_date')";
                        $result1 = mysqli_query($link, $sql1);

                        if ($result1) {
                            $sql2 = "insert into edctn VALUES('$unid','','','','','','', '','','','','', '','','','','', '','','','','', '','','','','','','','','','','','','','','','','','','','','','','','','','','','')";
                            $result2 = mysqli_query($link, $sql2);

                            $sql3 = "insert into exprn VALUES('$unid','', '','','','','','', '','','','','','', '','','','','','', '','','','','','', '','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','n')";
                            $result3 = mysqli_query($link, $sql3);

                            $sql4 = "insert into othrs VALUES('$unid','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','No','','','','')";
                            $result4 = mysqli_query($link, $sql4);

                            $sql5 = "select prefix, surname,name,fathername,post from prsnl where id='$unid'";
                            $result5 = mysqli_query($link, $sql5);
                        }

                        if ($result5) {
                            $row5 = mysqli_fetch_row($result5);
                        }

                        $sql6 = "select * from req_experience where status='OPEN'";
                        $result6 = mysqli_query($link, $sql6);

                        if (mysqli_num_rows($result6) > 0) {
                            while ($row6 = mysqli_fetch_assoc($result6)) {
                                if ($row6['category'] == '') {
                                    $val = $row6['post_id'] . '-' . $row6['sequence'] . '-' . $row6['year'];
                                    if ($row5[4] == $val) {
                                        $post_name = $row6['Name'];
                                        $closing_date = $row6['closed_date'];
                                    }
                                } else {
                                    $val = $row6['post_id'] . $row6['category'] . '-' . $row6['sequence'] . '-' . $row6['year'];
                                    if ($row5[4] == $val) {

                                        $post_name = $row6['Name'] . '(' . $row6['category'] . ')';
                                        $closing_date = $row6['closed_date'];
                                    }
                                }
                            }
                        }

                        $mail_name = $row5[0] . ' ' . $row5[1] . ' ' . $row5[2] . ' ' . $row5[3];
                        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
                        try {
                            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                            $mail->isSMTP();                                      // Set mailer to use SMTP
                            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                            $mail->SMTPAuth = true;                               // Enable SMTP authentication
                            $mail->Username = 'hrinf2018@gmail.com';                 // SMTP username
                            $mail->Password = 'recruitment@inflibnet@2018';                           // SMTP password
                            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                            $mail->Port = 587;                                    // TCP port to connect to
//Recipients
                            $mail->setFrom('hrinf2018@gmail.com', '');
                            $mail->addAddress($email);     // Add a recipient     
                            $mail->isHTML(true);                                  // Set email format to HTML
                            $mail->Subject = "Login Credentials for an Online application for the post of $post_name";

                            $message = '<table cellpadding="10" width="100%" border="1">               
                <tr>
                <td style="border:none;">      
                Dear ' . $mail_name . ',<br/><br/>
                Please find your login credentials for an online application for the post of ' . $post_name . ':<br/>
                <b>URL: </b><a href="https://www.inflibnet.ac.in/online/recruitment/login.php">https://www.inflibnet.ac.in/online/recruitment/login.php</a><br/>
                <b>Application ID : </b>' . $unid . '<br/>' . '<b>Password : </b>' . $new_password . '
                </td>
                </tr>
                <tr> <td style="border:none;"> </td> </tr>
                    <tr> <td style="border:none;"> <b>Note:</b>  This is an auto generated email. Please do not reply.</td> </tr>
                 <tr>
                <td style="border:none;padding-top:25px">      
                Thanks & Regards,<br/>
                INFLIBNET Centre, Gandhinagar
                
                </td>
                </tr>
                </table>';
                            $mail->Body = $message;
                            if ($mail->send()) {
                                $_SESSION['notification'] = "<br/><h4 style=color:white><center>Your Application ID and Password have been sent to your registered email ID.<br/>Kindly Login and complete the application.</center></h4>";
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

                    $certi_file_path = '';
                    if ($_FILES["caste_certi"]["name"]) {
                        $temp1 = explode(".", $_FILES["caste_certi"]["name"]);
                        $newfilename = $unid . '-caste.' . end($temp1);
                        $certi_file_path = 'uploads/caste/' . $newfilename;
                        move_uploaded_file($_FILES["caste_certi"]["tmp_name"], $certi_file_path);
                    }

                    $disability_certi_path = '';
                    if ($_FILES["disability_certi"]["name"]) {
                        $temp = explode(".", $_FILES["disability_certi"]["name"]);
                        $newfilename = $unid . '-disability.' . end($temp);
                        $disability_certi_path = 'uploads/disability/' . $newfilename;
                        move_uploaded_file($_FILES["disability_certi"]["tmp_name"], $disability_certi_path);
                    }

                    $stenography_certi_path = '';
                    if ($_FILES["stenography_certi"]["name"]) {
                        $temp3 = explode(".", $_FILES["stenography_certi"]["name"]);
                        $newfilename3 = $unid . '-stenography_certi.' . end($temp3);
                        $stenography_certi_path = 'uploads/steno/' . $newfilename3;
                        move_uploaded_file($_FILES["stenography_certi"]["tmp_name"], $stenography_certi_path);
                    }

                    $typing_certi_path = '';
                    if ($_FILES["typing_certi"]["name"]) {
                        $temp2 = explode(".", $_FILES["typing_certi"]["name"]);
                        $newfilename2 = $unid . '-typing_certi.' . end($temp2);
                        $typing_certi_path = 'uploads/typing/' . $newfilename2;
                        move_uploaded_file($_FILES["typing_certi"]["tmp_name"], $typing_certi_path);
                    }

                    $sql1 = "insert into prsnl VALUES(0,'$unid','$enc_password','$job_type','$prefix','$surname','$firstname','$fathername','$fatherorhusband','$dob','$sex','$nation','$address','$state','$telephone','$city','$pincode','$paddress','$pstate','$pcity','$ppincode','$same_address','$mobile','$aadhar_no','$email','$mstatus','$post','$job_location','$date','$status','$file_1_path','$caste','$certi_file_path','$certi_no','$issue_year','$authority','$agenew','$app_status','$brawser_h','$is_upload','$status_remarks','$disability','$disability_percentage','$disability_certi_path','$stenoGraphy_speed','$stenography_certi_no','$stenography_certi_date','$stenography_certi_path','$typing_speed','$typing_certi_no','$typing_certi_date','$typing_certi_path','$typing_language','$inf_employee','$payroll_no','$status_date')";
                    $result1 = mysqli_query($link, $sql1);

                    if ($result1) {
                        $sql2 = "insert into edctn VALUES('$unid','','','','','','', '','','','','', '','','','','', '','','','','', '','','','','','','','','','','','','','','','','','','','','','','','','','','','')";
                        $result2 = mysqli_query($link, $sql2);

                        $sql3 = "insert into exprn VALUES('$unid','', '','','','','','', '','','','','','', '','','','','','', '','','','','','', '','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','')";
                        $result3 = mysqli_query($link, $sql3);

                        $sql4 = "insert into othrs VALUES('$unid','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','No')";
                        $result4 = mysqli_query($link, $sql4);

                        $sql5 = "select prefix, surname,name,fathername,post from prsnl where id='$unid'";
                        $result5 = mysqli_query($link, $sql5);
                    }
                    if ($result5) {
                        $row5 = mysqli_fetch_row($result5);
                    }

                    $sql6 = "select * from req_experience where status='OPEN'";
                    $result6 = mysqli_query($link, $sql6);
                    if (mysqli_num_rows($result6) > 0) {
                        while ($row6 = mysqli_fetch_assoc($result6)) {
                            if ($row6['category'] == '') {
                                $val = $row6['post_id'] . '-' . $row6['sequence'] . '-' . $row6['year'];
                                if ($row5[4] == $val) {
                                    $post_name = $row6['Name'];
                                    $closing_date = $row6['closed_date'];
                                }
                            } else {
                                $val = $row6['post_id'] . $row6['category'] . '-' . $row6['sequence'] . '-' . $row6['year'];
                                if ($row5[4] == $val) {

                                    $post_name = $row6['Name'] . '(' . $row6['category'] . ')';
                                    $closing_date = $row6['closed_date'];
                                }
                            }
                        }
                    }

                    $mail_name = $row5[0] . ' ' . $row5[1] . ' ' . $row5[2] . ' ' . $row5[3];
                    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
                    try {
                        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                        $mail->isSMTP();                                      // Set mailer to use SMTP
                        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                        $mail->SMTPAuth = true;                               // Enable SMTP authentication
                        $mail->Username = 'hrinf2018@gmail.com';                 // SMTP username
                        $mail->Password = 'recruitment@inflibnet@2018';                           // SMTP password
                        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                        $mail->Port = 587;                                    // TCP port to connect to
//Recipients
                        $mail->setFrom('hrinf2018@gmail.com', '');
                        $mail->addAddress($email);     // Add a recipient     
                        $mail->isHTML(true);                                  // Set email format to HTML
                        $mail->Subject = "Login Credentials for an Online application for the post of $post_name";

                        $message = '<table cellpadding="10" width="100%" border="1">               
                <tr>
                <td style="border:none;">      
               Dear ' . $mail_name . ',<br/><br/>
                Please find your login credentials for an online application for the post of ' . $post_name . ':<br/>
                <b>URL: </b><a href="https://www.inflibnet.ac.in/online/recruitment/login.php">https://www.inflibnet.ac.in/online/recruitment/login.php</a><br/>
                <b>Application ID : </b>' . $unid . '<br/>' . '<b>Password : </b>' . $new_password . '
                </td>
                </tr>
                <tr> <td style="border:none;"> </td> </tr>
                    <tr> <td style="border:none;"> <b>Note:</b>  This is an auto generated email. Please do not reply.</td> </tr>
                 <tr>
                <td style="border:none;padding-top:25px">      
                Thanks & Regards,<br/>
                INFLIBNET Centre, Gandhinagar
                
                </td>
                </tr>
                </table>';
                        $mail->Body = $message;
                        if ($mail->send()) {
                            $_SESSION['notification'] = "<br/><h4 style=color:white><center>Your Application ID and Password have been sent to your registered email ID.<br/>Kindly Login and complete the application.</center></h4>";
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
                $_SESSION['registration_notification'] = '<div class="text-center alert alert-danger">Your age is greater than compare to required age limit ' . $db_age_new . ', therefore you are not aligible for this post.</div>';
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
    $post = trim($_POST["post"]);

    $new_password = rand(11111111, 99999999);
    $enc_password = md5($new_password);

    $check_data = "select email, post, id from prsnl where email='$email' and id='$appli_id'";
    $result_check = mysqli_query($link, $check_data);
    
    if (mysqli_num_rows($result_check) > 0) {
        while ($row_check = mysqli_fetch_assoc($result_check)) {

            if($row_check['post'] == $post && $row_check['email'] == $email && $row_check['id'] == $appli_id){                                        
                $sql = "update prsnl set password='$enc_password' where email='$email' and post='$post' and id='$appli_id'";
                $result = mysqli_query($link, $sql);

                $sql = "select prefix,surname,name,fathername,id from prsnl where email='$email' and post='$post'";
                $result = mysqli_query($link, $sql);
                if (mysqli_num_rows($result) > 0) {
                    
                    while ($row = mysqli_fetch_assoc($result)) {
                        $mail_name = $row['prefix'] . ' ' . $row['surname'] . ' ' . $row['name'] . ' ' . $row['fathername'];
                        $app_id = $row['id'];

                        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
                        try {
                            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                            $mail->isSMTP();                                      // Set mailer to use SMTP
                            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                            $mail->SMTPAuth = true;                               // Enable SMTP authentication
                            $mail->Username = 'hrinf2018@gmail.com';                 // SMTP username
                            $mail->Password = 'recruitment@inflibnet@2018';                           // SMTP password
                            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                            $mail->Port = 587;                                    // TCP port to connect to
                            $mail->setFrom('hrinf2018@gmail.com', '');
                            $mail->addAddress($email);     // Add a recipient     
                            $mail->isHTML(true);                                  // Set email format to HTML
                            $mail->Subject = "Forget Password: INFLIBNET";

                            $message = '<table cellpadding="10" width="100%" border="1">               
                            <tr>
                            <td style="border:none;">      
                            Dear ' . $mail_name . ',  </td>
                            </tr>   <tr>
                            <td style="border:none;">
                            Your password has been reset by the system.<br/>
                            
                            Your New Password is : <b>' . $new_password . '</b>
                            <br/>Please login with your Application ID(<b>' . $app_id . '</b>) and new password.</td></tr>
                            <tr> <td style="border:none;"> </td> </tr>
                                <tr> <td style="border:none;"> <b>Note:</b>  This is an auto generated email. Please do not reply.</td> </tr>
                            <tr>
                            <td style="border:none;padding-top:25px">      
                            Thanks & Regards,<br/>
                            INFLIBNET Centre, Gandhinagar
                            
                            </td>
                            </tr>
                            </table>';
                            $mail->Body = $message;
                            if ($mail->send()) {
                                $_SESSION['forget_msg'] = '<div class="text-center alert alert-success">Your Password is reset, Please check your email.</div>';
                                header("Location:forget_password.php");
                            } else {
                                $_SESSION['forget_msg'] = '<div class="text-center alert alert-danger">Something went wrong, Please try again.</div>';
                                header("Location:forget_password.php");
                            }
                        } catch (Exception $e) {
                            
                        }
                    }
                }
  
                $_SESSION['forget_msg'] = '<div class="text-center alert alert-success">Your new password is sent to your registered email id.</div>';
                header("Location:forget_password.php");
                exit();
            }else{
                $_SESSION['forget_msg'] = '<div class="text-center alert alert-danger">Your email id is not match with applied post.</div>';
                header("Location:forget_password.php");
            }
        }
    }else{
        $_SESSION['forget_msg'] = '<div class="text-center alert alert-danger">Based on your Application ID, Email and Post data not match.</div>';
        header("Location:forget_password.php");
    }
}
?>
<?php

function getBrowser() {
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version = "";
    // First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    } elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }
    // Next get the name of the useragent yes seperately and for good reason
    if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    } elseif (preg_match('/Firefox/i', $u_agent)) {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    } elseif (preg_match('/Chrome/i', $u_agent)) {
        $bname = 'Google Chrome';
        $ub = "Chrome";
    } elseif (preg_match('/Safari/i', $u_agent)) {
        $bname = 'Apple Safari';
        $ub = "Safari";
    } elseif (preg_match('/Opera/i', $u_agent)) {
        $bname = 'Opera';
        $ub = "Opera";
    } elseif (preg_match('/Netscape/i', $u_agent)) {
        $bname = 'Netscape';
        $ub = "Netscape";
    }
    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
            $version = $matches['version'][0];
        } else {
            $version = $matches['version'][1];
        }
    } else {
        $version = $matches['version'][0];
    }
    // check if we have a number
    if ($version == null || $version == "") {
        $version = "?";
    }
    return array(
        'name' => $bname,
        'version' => $version,
        'platform' => $platform
    );
}
?>
<?php

function my_error_handler($errno, $errstr, $errfile, $errline) {
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

function my_exception_handler($e) {

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
<html lang="en"><head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Candidate Login</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"></link>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <link href="css/custom.css" rel="stylesheet">
        <style type="text/css">
            .login-form {
                width: 400px;
                margin: 25px auto;
            }

            .bg-image {
                background-image: url(images/bg1.jpg);
                width: 100%;
                height: 100%;
                background-position: center;
                background-size: contain;
                background-repeat: no-repeat;
            }

            .login-form {
                width: 400px;
                margin: 50px auto;
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

            .btn {
                min-height: 38px;
            }

            .form-control {
                min-height: 38px;
                color: #000000;
                border: 0px;
                background: rgba(255, 255, 255);
                border-radius: 5px;
            }

            .btn {
                font-size: 15px;
                font-weight: bold;
            }

            a {
                color: #c6c5c5;
            }

            a:hover {
                color: #ffffff;
            }

            .login-btn {
                color: #fff;
                background-color: #f2660e;
                border-color: #bb4e0a;
            }

            .login-btn:hover {
                color: #fff;
                background-color: #191e5d;
                border-color: #191e5d;
            }

            .captcha-image {
                float: left;
                margin-right: 7px;
            }

            .captcha-refresh {
                float: left;
                margin-right: 7px;
            }

            .captcha-input {
                width: 60%;
            }

            .inf-logo {
                float: left;
                margin-left: 30px;
                margin-top: 0px;
                background: #fff;
                margin-right: 14px;
                padding: 10px;
                box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
                border-radius: 10px;
            }

            .inf-title {
                line-height: 30px;
                margin-top: 16px;
            }

            .white-text {
                color: #ffffff;
                text-align: left;
            }
        </style>
    </head>
    <body>

        <div class="bg-image">
            <?php include 'admin_header.php'; ?>
            <?php echo $notification; ?>
            <div class="container">
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
                            <input type="text" class="form-control" placeholder="Application Id" id="regid"  name="regid" required="required">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password" id="password" name="password" required="required">
                        </div>
                        <div class="form-group">  
                            <img id="captcha_img" src="captcha.php" alt="CAPTCHA" height="32" width="80" />
                            <a href='javascript: refresh_captcha();'><img id="" src="images/refresh.png" height="40" width="40" /></a>
                            <input type="text" id="captcha_code" name="captcha_code" class="form-control" placeholder="Enter captcha" autocomplete="off"   />
                        </div>
                        <div class="form-group">
                            <button type="submit" name="Submit" class="login-btn btn btn-block">Log in</button>
                        </div>
                        <div class="clearfix">
                            <p class="text-center pull-left"><a href="index.php">Go to Home</a></p>
                            <a href="forget_password.php" class="pull-right" >Forgot Password ?</a>
                        </div>        
                    </form>

                </div></div>
        </div>
    </body></html>
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
    function refresh_captcha()
    {

        $("#captcha_img").replaceWith('<img id="captcha_img" src="captcha.php" alt="CAPTCHA" height="40" width="100" />');
    }
</script>
