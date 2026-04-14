<?php

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
session_start();
if (!isset($_SERVER['HTTP_REFERER'])) {
    header('location:./index.php');
    exit;
}

include "dbConfig.php";
include "get_ip.php";

if (isset($_POST['btn_submit'])) {
    $post = mysqli_real_escape_string($link, $_POST['post']);
    $candidate_id = mysqli_real_escape_string($link, $_POST['candidate_id']);
    $question_no = mysqli_real_escape_string($link, $_POST['question_no']);
    $question_option = mysqli_real_escape_string($link, $_POST['question_option']);
    $question_remarks = mysqli_real_escape_string($link, $_POST['question_remarks']);
    $ques_transaction_no = mysqli_real_escape_string($link, $_POST["ques_transaction_no"]);

    date_default_timezone_set('Asia/Kolkata');
    $current_date = date("Y-m-d H:i:s");

    $remarks_file_path = '';
    $ques_transaction_receipt_path = '';

    if ($_FILES["remarks_file"]["name"]) {
        $temp = explode(".", $_FILES["remarks_file"]["name"]);
        $newfilename = md5($current_date) . '.' . end($temp);
        $remarks_file_path = 'uploads/question/' . $newfilename;
        move_uploaded_file($_FILES["remarks_file"]["tmp_name"], $remarks_file_path);
    }

    if ($_FILES["ques_transaction_receipt"]["name"]) {
        $temp = explode(".", $_FILES["ques_transaction_receipt"]["name"]);
        $newfilename = md5($current_date) . '.' . end($temp);
        $ques_transaction_receipt_path = 'uploads/question_transaction_receipt/' . $newfilename;
        move_uploaded_file($_FILES["ques_transaction_receipt"]["tmp_name"], $ques_transaction_receipt_path);
    }

    $sql = "insert into question VALUES(0,'$post','$candidate_id',$question_no,'$question_option','$question_remarks','$remarks_file_path','$ques_transaction_no','$ques_transaction_receipt_path','$current_date')";
    $result = mysqli_query($link, $sql);

    if ($result) {
        $sql_ua = "insert into history_admitcard VALUES(0,'$ua_browser','$ua_version','$ua_platform','$ua_ip','$ua_date','$ua_time','$candidate_id','Submit Question')";
        $result_ua = mysqli_query($link, $sql_ua);

        $_SESSION['que_notification'] = '<div class="text-center alert alert-success">Question submitted successfully.</div>';
        header("Location: question.php");
    } else {
        $_SESSION['que_notification'] = '<div class="text-center alert alert-danger">Something went to wrong please try again..</div>';
        header("Location: question.php");
    }
}
