<?php
session_start();
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

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
include "checker_input.php";

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
  $regid    = clean_input($link, $_POST['regid'] ?? '', 'Registration ID');
  $password = clean_input($link, $_POST['password'] ?? '', 'Password');
  $password1 = md5($password);


  error_log("Received Application ID: $regid, Password Hash: $password1");

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


  $job_location = clean_input($link, $_POST['job_location'] ?? '', 'Job Location');
  $job_type     = clean_input($link, $_POST['job_type'] ?? '', 'Job Type');


  $post = clean_input($link, $_POST['post'] ?? '', 'Post');
  $nation = clean_input($link, $_POST["nation"] ?? '', 'Nation');
  $prefix = clean_input($link, $_POST['prefix'] ?? '', 'Prefix');
  $surname = clean_input($link, $_POST["surname"] ?? '', 'Surname');
  $firstname = clean_input($link, $_POST['fname'] ?? '', 'First Name');
  $fatherorhusband = clean_input($link, $_POST['lastname'] ?? '', 'Husband/Father Name');
  $fathername = clean_input($link, $_POST["fathername"] ?? '', 'Father Name');
  $caste = clean_input($link, $_POST["caste"] ?? '', 'Caste');
  $issue_year = clean_input($link, $_POST["issue_year"] ?? '', 'Issue Year');
  $certi_no = clean_input($link, $_POST["certi_no"] ?? '', 'Certificate Number');
  $serving = clean_input($link, $_POST["serving"] ?? '', 'Serving');
  $type_of_service = clean_input($link, $_POST["type_of_service"] ?? '', 'Type of Service');
  $dob = clean_input($link, $_POST["dob"] ?? '', 'Date of Birth');
  $agenew = clean_input($link, $_POST['agenew'] ?? '', 'Age');
  $sex = clean_input($link, $_POST["sex"] ?? '', 'Sex');
  $mstatus = clean_input($link, $_POST["mstatus"] ?? '', 'Marital Status');
  $email = clean_input($link, $_POST["email"] ?? '', 'Email');
  $mobile = clean_input($link, $_POST["mobile"] ?? '', 'Mobile');
  $telephone = clean_input($link, $_POST["telephone"] ?? '', 'Telephone');
  $aadhar_no = clean_input($link, $_POST["aadhar_no"] ?? '', 'Aadhar Number');
  $disability = clean_input($link, $_POST['disability'] ?? '', 'Disability');
  $disability_percentage = clean_input($link, $_POST['disability_percentage'] ?? '', 'Disability Percentage');
  $type_of_disability = clean_input($link, $_POST['type_of_disability'] ?? '', 'Type of Disability');
  $address = clean_input($link, $_POST["address"] ?? '', 'Address');
  $state = clean_input($link, $_POST["state"] ?? '', 'State');
  $city = clean_input($link, $_POST["city"] ?? '', 'City');
  $pincode = clean_input($link, $_POST["pincode"] ?? '', 'Pincode');
  $same_address = clean_input($link, $_POST["copy_address"] ?? '', 'Same Address');
  $paddress = clean_input($link, $_POST["paddress"] ?? '', 'Permanent Address');
  $pstate = clean_input($link, $_POST["pstate"] ?? '', 'Permanent State');
  $pcity = clean_input($link, $_POST["pcity"] ?? '', 'Permanent City');
  $ppincode = clean_input($link, $_POST["ppincode"] ?? '', 'Permanent Pincode');
  $type_of_job = clean_input($link, $_POST["type_of_job"] ?? '', 'Type of Job');
  $length_of_service = clean_input($link, $_POST["length_of_service"] ?? '', 'Length of Service');
  $service_from_date = clean_input($link, $_POST["service_from_date"] ?? '', 'Service From Date');
  $service_to_date = clean_input($link, $_POST["service_to_date"] ?? '', 'Service To Date');

  $stenoGraphy_speed        = clean_input($link, $_POST["stenoGraphy_speed"] ?? '', 'Stenography Speed');
  $stenography_certi_no     = clean_input($link, $_POST["stenography_certi_no"] ?? '', 'Stenography Certificate Number');
  $stenography_certi_date   = clean_input($link, $_POST["stenography_certi_date"] ?? '', 'Stenography Certificate Date');
  $typing_speed             = clean_input($link, $_POST["typing_speed"] ?? '', 'Typing Speed');
  $typing_certi_no          = clean_input($link, $_POST["typing_certi_no"] ?? '', 'Typing Certificate Number');
  $typing_certi_date        = clean_input($link, $_POST["typing_certi_date"] ?? '', 'Typing Certificate Date');
  $typing_language          = clean_input($link, $_POST["typing_language"] ?? '', 'Typing Language');

  $inf_employee             = clean_input($link, $_POST["inf_employee"] ?? '', 'INF Employee');
  $payroll_no               = clean_input($link, $_POST["payroll_no"] ?? '', 'Payroll Number');


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
      } else if ($post == "AAdmin-2-2025") {
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
      $db_age_new = 56;
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


    // Final Page Check
    if ($agenew1 > 56 && $disability == "Yes") {
      $_SESSION['registration_notification'] = '<div class="text-center alert alert-danger">Your age is greater than compare to required age limit 56, therefore you are not eligible for this post.</div>';
      header("Location:" . $_POST['redirect_url']);
    } else {


      if ($agenew1 < 18) {
        $_SESSION['registration_notification'] = '<div class="text-center alert alert-danger">Your age is below 18, which is the minimum required age. Therefore, you are not eligible for this post.</div>';
        header("Location:" . $_POST['redirect_url']);
        exit;
      }

      if ($agenew1 == $db_age_new && strpos($agenew, 'and') !== false) {
        $_SESSION['registration_notification'] = '<div class="text-center alert alert-danger">Your age exceeds the required age limit of ' . $db_age_new . '. Therefore, you are not eligible for this post.</div>';
        header("Location:" . $_POST['redirect_url']);
        exit;
      }

      if ($agenew1 > $db_age_new) {
        $_SESSION['registration_notification'] = '<div class="text-center alert alert-danger">Your age exceeds the required age limit of ' . $db_age_new . '. Therefore, you are not eligible for this post.</div>';
        header("Location:" . $_POST['redirect_url']);
        exit;
      }

      // header("Location:" . $_POST['redirect_url']);

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
        $allowed_types = [
          'jpg' => ['mime' => 'image/jpeg', 'signature' => "\xFF\xD8\xFF"],
          'jpeg' => ['mime' => 'image/jpeg', 'signature' => "\xFF\xD8\xFF"],
          'png' => ['mime' => 'image/png', 'signature' => "\x89\x50\x4E\x47\x0D\x0A\x1A\x0A"], // 8 bytes
          'pdf' => ['mime' => 'application/pdf', 'signature' => "%PDF-"] // 5 bytes
        ];

        $original_name = $_FILES["caste_certi"]["name"];
        $file_tmp = $_FILES["caste_certi"]["tmp_name"];
        $file_size = $_FILES["caste_certi"]["size"];
        $ext = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));

        if (!array_key_exists($ext, $allowed_types)) {
          echo "<script>alert('Invalid file extension.');</script>";
          exit;
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $file_tmp);
        finfo_close($finfo);

        if ($mime !== $allowed_types[$ext]['mime']) {
          echo "<script>alert('Mismatch between extension and MIME type.');</script>";
          exit;
        }

        if ($file_size > 400 * 1024) {
          echo "<script>alert('File too large. Max 400 KB allowed.');</script>";
          exit;
        }

        $expected_signature = $allowed_types[$ext]['signature'];
        $expected_length = strlen($expected_signature);

        $handle = fopen($file_tmp, 'rb');
        if ($handle === false) {
          echo "<script>alert('Unable to read file for validation.');</script>";
          exit;
        }
        $file_signature = fread($handle, $expected_length);
        fclose($handle);

        if (strncmp($file_signature, $expected_signature, $expected_length) !== 0) {
          echo "<script>alert('File content does not match declared type.');</script>";
          exit;
        }

        $newfilename = md5($unid) . md5($enc_current_date) . md5('caste') . '.' . $ext;
        $certi_file_path = 'uploads/caste/' . $newfilename;

        if (!move_uploaded_file($file_tmp, $certi_file_path)) {
          echo "<script>alert('File upload failed.');</script>";
          exit;
        }
      }

      $disability_certi_path = '';
      if ($_FILES["disability_certi"]["name"]) {
        $allowed_types = [
          'jpg' => ['mime' => 'image/jpeg', 'signature' => "\xFF\xD8\xFF"],
          'jpeg' => ['mime' => 'image/jpeg', 'signature' => "\xFF\xD8\xFF"],
          'png' => ['mime' => 'image/png', 'signature' => "\x89\x50\x4E\x47\x0D\x0A\x1A\x0A"],
          'pdf' => ['mime' => 'application/pdf', 'signature' => "%PDF-"]
        ];

        $original_name = $_FILES["disability_certi"]["name"];
        $file_tmp = $_FILES["disability_certi"]["tmp_name"];
        $file_size = $_FILES["disability_certi"]["size"];
        $ext = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));

        if (!array_key_exists($ext, $allowed_types)) {
          echo "<script>alert('Invalid file extension.');</script>";
          exit;
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $file_tmp);
        finfo_close($finfo);

        if ($mime !== $allowed_types[$ext]['mime']) {
          echo "<script>alert('Mismatch between extension and MIME type.');</script>";
          exit;
        }

        if ($file_size > 400 * 1024) {
          echo "<script>alert('File too large. Max 400 KB allowed.');</script>";
          exit;
        }

        $expected_signature = $allowed_types[$ext]['signature'];
        $expected_length = strlen($expected_signature);
        $handle = fopen($file_tmp, 'rb');
        if ($handle === false) {
          echo "<script>alert('Unable to read file for validation.');</script>";
          exit;
        }
        $file_signature = fread($handle, $expected_length);
        fclose($handle);

        if (strncmp($file_signature, $expected_signature, $expected_length) !== 0) {
          echo "<script>alert('File content does not match declared type.');</script>";
          exit;
        }

        $temp = explode(".", $original_name);
        $newfilename = md5($unid) . md5($enc_current_date) . md5('disability') . '.' . end($temp);
        $disability_certi_path = 'uploads/disability/' . $newfilename;

        if (!move_uploaded_file($file_tmp, $disability_certi_path)) {
          echo "<script>alert('File upload failed.');</script>";
          exit;
        }
      }

      $stenography_certi_path = '';
      if ($_FILES["stenography_certi"]["name"]) {
        $allowed_types = [
          'jpg' => ['mime' => 'image/jpeg', 'signature' => "\xFF\xD8\xFF"],
          'jpeg' => ['mime' => 'image/jpeg', 'signature' => "\xFF\xD8\xFF"],
          'png' => ['mime' => 'image/png', 'signature' => "\x89\x50\x4E\x47\x0D\x0A\x1A\x0A"],
          'pdf' => ['mime' => 'application/pdf', 'signature' => "%PDF-"]
        ];

        $original_name = $_FILES["stenography_certi"]["name"];
        $file_tmp = $_FILES["stenography_certi"]["tmp_name"];
        $file_size = $_FILES["stenography_certi"]["size"];
        $ext = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));

        if (!array_key_exists($ext, $allowed_types)) {
          echo "<script>alert('Invalid file extension.');</script>";
          exit;
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $file_tmp);
        finfo_close($finfo);

        if ($mime !== $allowed_types[$ext]['mime']) {
          echo "<script>alert('Mismatch between extension and MIME type.');</script>";
          exit;
        }

        if ($file_size > 400 * 1024) {
          echo "<script>alert('File too large. Max 400 KB allowed.');</script>";
          exit;
        }

        $expected_signature = $allowed_types[$ext]['signature'];
        $expected_length = strlen($expected_signature);
        $handle = fopen($file_tmp, 'rb');
        if ($handle === false) {
          echo "<script>alert('Unable to read file for validation.');</script>";
          exit;
        }
        $file_signature = fread($handle, $expected_length);
        fclose($handle);

        if (strncmp($file_signature, $expected_signature, $expected_length) !== 0) {
          echo "<script>alert('File content does not match declared type.');</script>";
          exit;
        }

        $temp3 = explode(".", $original_name);
        $newfilename3 = md5('stenography') . md5($enc_current_date) . md5($unid) . '.' . end($temp3);
        $stenography_certi_path = 'uploads/steno/' . $newfilename3;

        if (!move_uploaded_file($file_tmp, $stenography_certi_path)) {
          echo "<script>alert('File upload failed.');</script>";
          exit;
        }
      }


      // $typing_certi_path = '';
      // if ($_FILES["typing_certi"]["name"]) {
      //   $temp2 = explode(".", $_FILES["typing_certi"]["name"]);
      //   $newfilename2 = md5($unid) . md5($enc_current_date) . md5('typing') . '.' . end($temp2);
      //   $typing_certi_path = 'uploads/typing/' . $newfilename2;
      //   move_uploaded_file($_FILES["typing_certi"]["tmp_name"], $typing_certi_path);
      // }

      $typing_certi_path = '';
      if ($_FILES["typing_certi"]["name"]) {
        $allowed_types = [
          'jpg' => ['mime' => 'image/jpeg', 'signature' => "\xFF\xD8\xFF"],
          'jpeg' => ['mime' => 'image/jpeg', 'signature' => "\xFF\xD8\xFF"],
          'png' => ['mime' => 'image/png', 'signature' => "\x89\x50\x4E\x47\x0D\x0A\x1A\x0A"],
          'pdf' => ['mime' => 'application/pdf', 'signature' => "%PDF-"]
        ];

        $original_name = $_FILES["typing_certi"]["name"];
        $file_tmp = $_FILES["typing_certi"]["tmp_name"];
        $file_size = $_FILES["typing_certi"]["size"];
        $ext = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));

        if (!array_key_exists($ext, $allowed_types)) {
          echo "<script>alert('Invalid file extension.');</script>";
          exit;
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $file_tmp);
        finfo_close($finfo);

        if ($mime !== $allowed_types[$ext]['mime']) {
          echo "<script>alert('Mismatch between extension and MIME type.');</script>";
          exit;
        }

        if ($file_size > 400 * 1024) {
          echo "<script>alert('File too large. Max 400 KB allowed.');</script>";
          exit;
        }

        $expected_signature = $allowed_types[$ext]['signature'];
        $expected_length = strlen($expected_signature);
        $handle = fopen($file_tmp, 'rb');
        if ($handle === false) {
          echo "<script>alert('Unable to read file for validation.');</script>";
          exit;
        }
        $file_signature = fread($handle, $expected_length);
        fclose($handle);

        if (strncmp($file_signature, $expected_signature, $expected_length) !== 0) {
          echo "<script>alert('File content does not match declared type.');</script>";
          exit;
        }

        $temp2 = explode(".", $original_name);
        $newfilename2 = md5($unid) . md5($enc_current_date) . md5('typing') . '.' . end($temp2);
        $typing_certi_path = 'uploads/typing/' . $newfilename2;

        if (!move_uploaded_file($file_tmp, $typing_certi_path)) {
          echo "<script>alert('File upload failed.');</script>";
          exit;
        }
      }


      // $sql1 = "insert into prsnl VALUES(0,'$unid','$enc_password','$job_type','$prefix','$surname','$firstname','$fathername','$fatherorhusband','$dob','$sex','$nation','$address','$state','$telephone','$city','$pincode','$paddress','$pstate','$pcity','$ppincode','$same_address','$mobile','$aadhar_no','$email','$mstatus','$post','$job_location','$regdate','$status','$file_1_path','$caste','$certi_file_path','$certi_no','$issue_year','$serving','$type_of_service','$authority','$agenew','$app_status','$brawser_h','$is_upload','$status_remarks','$disability','$type_of_disability','$disability_percentage','$disability_certi_path','$stenoGraphy_speed','$stenography_certi_no','$stenography_certi_date','$stenography_certi_path','$typing_speed','$typing_certi_no','$typing_certi_date','$typing_certi_path','$typing_language','$inf_employee','$payroll_no','$type_of_job','$length_of_service','$service_from_date','$service_to_date','$status_date')";
      // $result1 = mysqli_query($link, $sql1);

      $stmt = $link->prepare(
        "INSERT INTO prsnl VALUES (0,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"
      );
      $stmt->bind_param(
        'ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss',
        $unid,
        $enc_password,
        $job_type,
        $prefix,
        $surname,
        $firstname,
        $fathername,
        $fatherorhusband,
        $dob,
        $sex,
        $nation,
        $address,
        $state,
        $telephone,
        $city,
        $pincode,
        $paddress,
        $pstate,
        $pcity,
        $ppincode,
        $same_address,
        $mobile,
        $aadhar_no,
        $email,
        $mstatus,
        $post,
        $job_location,
        $regdate,
        $status,
        $file_1_path,
        $caste,
        $certi_file_path,
        $certi_no,
        $issue_year,
        $serving,
        $type_of_service,
        $authority,
        $agenew,
        $app_status,
        $brawser_h,
        $is_upload,
        $status_remarks,
        $disability,
        $type_of_disability,
        $disability_percentage,
        $disability_certi_path,
        $stenoGraphy_speed,
        $stenography_certi_no,
        $stenography_certi_date,
        $stenography_certi_path,
        $typing_speed,
        $typing_certi_no,
        $typing_certi_date,
        $typing_certi_path,
        $typing_language,
        $inf_employee,
        $payroll_no,
        $type_of_job,
        $length_of_service,
        $service_from_date,
        $service_to_date,
        $status_date
      );
      $result1 = $stmt->execute();

      // $sql2 = "INSERT INTO edctn (id) VALUES (?)";
      // $stmt2 = mysqli_prepare($link, $sql2);
      // mysqli_stmt_bind_param($stmt2, "s", $unid);
      // $result2 = mysqli_stmt_execute($stmt2);

      try {
        $sql2 = "INSERT INTO edctn (id) VALUES (?)";
        $stmt2 = mysqli_prepare($link, $sql2);
        mysqli_stmt_bind_param($stmt2, "s", $unid);
        $result2 = mysqli_stmt_execute($stmt2);
        if ($result2) {
          error_log("✅ edctn inserted for unid: $unid");
        }
      } catch (Throwable $e) {
        error_log("❌ Error inserting into edctn: " . $e->getMessage());
      }


      $sql3 = "INSERT INTO exprn (id) VALUES (?)";
      $stmt3 = mysqli_prepare($link, $sql3);
      mysqli_stmt_bind_param($stmt3, "s", $unid);
      $result3 = mysqli_stmt_execute($stmt3);

      $sql4 = "INSERT INTO othrs (id) VALUES (?)";
      $stmt4 = mysqli_prepare($link, $sql4);
      mysqli_stmt_bind_param($stmt4, "s", $unid);
      $result4 = mysqli_stmt_execute($stmt4);

      $stmt5 = $link->prepare("SELECT prefix, surname, name, fathername, post FROM prsnl WHERE id = ?");
      $stmt5->bind_param("s", $unid);
      $stmt5->execute();
      $result5 = $stmt5->get_result();

      // $sql_ua = "insert into history_admitcard VALUES(0,'$ua_browser','$ua_version','$ua_platform','$ua_ip','$ua_date','$ua_time','$unid','Register for Application')";
      // $result_ua = mysqli_query($link, $sql_ua);
      $stmt_ua = $link->prepare("INSERT INTO history_admitcard VALUES (0, ?, ?, ?, ?, ?, ?, ?, ?)");
      $action = 'Register for Application';
      $stmt_ua->bind_param("ssssssss", $ua_browser, $ua_version, $ua_platform, $ua_ip, $ua_date, $ua_time, $unid, $action);
      $stmt_ua->execute();
      $result_ua = $stmt_ua->affected_rows > 0;

      //                        $activity = "Register for Application";
      //                        $sql_ua = $link->prepare("INSERT INTO history_admitcard(browser, version, platform, ip, date, time, user_id, activity) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
      //                        $sql_ua->bind_param("ssssssss", $ua_browser, $ua_version, $ua_platform, $ua_ip, $ua_date, $ua_time, $unid, $activity);
      //                        $sql_ua->execute();
      //                        }

      if ($result5) {
        $row5 = mysqli_fetch_row($result5);
      }

      // $sql6 = "select * from req_experience where status='OPEN' and post='$post'";
      // $result6 = mysqli_query($link, $sql6);
      $stmt6 = $link->prepare("SELECT * FROM req_experience WHERE status = 'OPEN' AND post = ?");
      $stmt6->bind_param("s", $post);
      $stmt6->execute();
      $result6 = $stmt6->get_result();


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
        $mail->Password = 'uQC44cw@PvGGW!q3g';                           // SMTP password
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
    $_SESSION['registration_notification'] = '<div class="text-center alert alert-danger">Email id already registered for this Post.</div>';
    header("Location:" . $_POST['redirect_url']);
  }
} else if (isset($_POST['reset_password'])) {
  // $appli_id = trim($_POST["app_id"]);
  // $email = trim($_POST["email"]);

  $appli_id = clean_input($link, $_POST["app_id"] ?? '', 'Application ID');
  $email    = clean_input($link, $_POST["email"] ?? '', 'Email');

  $new_password = rand(11111111, 99999999);
  $enc_password = md5($new_password);

  // $check_data = "select email, post, id from prsnl where email='$email' and id='$appli_id'";
  // $result_check = mysqli_query($link, $check_data);

  $stmt_check = $link->prepare("SELECT email, post, id FROM prsnl WHERE email = ? AND id = ?");
  $stmt_check->bind_param("ss", $email, $appli_id);
  $stmt_check->execute();
  $result_check = $stmt_check->get_result();


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
              $mail->Password = 'uQC44cw@PvGGW!q3g';                           // SMTP password
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