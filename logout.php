<?php

error_reporting(0);
include "dbConfig.php";

Session_start();

date_default_timezone_set('Asia/Kolkata');
include "get_ip.php";
$regid = $_SESSION['app_id'];

//$sql_ua = "insert into history_admitcard VALUES(0,'$ua_browser','$ua_version','$ua_platform','$ua_ip','$ua_date','$ua_time','$regid','Logout')";
//$result_ua = mysqli_query($link, $sql_ua);
$activity = "Logout";
$sql_ua = $link->prepare("INSERT INTO history_admitcard(browser, version, platform, ip, date, time, user_id, activity) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$sql_ua->bind_param("ssssssss", $ua_browser, $ua_version, $ua_platform, $ua_ip, $ua_date, $ua_time, $regid, $activity);
$sql_ua->execute();

header('Location:login.php');
Session_destroy();
?>