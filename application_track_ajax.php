<?php
include('dbConfig.php');
include "get_ip.php";

if (!isset($_SERVER['HTTP_REFERER'])) {
    header('location:./index.php');
    exit;
}
session_start();
$regid = $_SESSION['app_id'];
$type = $_POST['type'];
$sql_ua = "insert into history_admitcard VALUES(0,'$ua_browser','$ua_version','$ua_platform','$ua_ip','$ua_date','$ua_time','$regid','$type')";
$result_ua = mysqli_query($link, $sql_ua);