<?php

error_reporting(0);
session_start();
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

include "dbConfig.php";
include "../get_ip.php";

$candidate_id = $_POST['candidate_id'];
$chk_value = $_POST['chk_value'];
$attendance_status = 'Change Attendance ' . $chk_value;
$username = $_SESSION['user'];
if ($candidate_id != "" && isset($candidate_id)) {
    $sql = "update prsnl set attendance='$chk_value' where id='$candidate_id'";
    $result_update = mysqli_query($link, $sql);
    if ($result_update) {
        $sql_ua = "insert into history_admin VALUES(0,'$ua_browser','$ua_version','$ua_platform','$ua_ip','$ua_date','$ua_time','$username','$candidate_id','$attendance_status')";
        $result_ua = mysqli_query($link, $sql_ua);
    } else {
        echo json_encode("false");
    }
}
?>
