<?php
error_reporting(0);
include "dbConfig.php";

Session_start();

date_default_timezone_set('Asia/Kolkata');
include "get_ip.php";
$user_id = $_SESSION['user'];

$sql_ua = "insert into history_admin VALUES(0,'$ua_browser','$ua_version','$ua_platform','$ua_ip','$ua_date','$ua_time','$user_id',NULL,'Logout')";
$result_ua = mysqli_query($link, $sql_ua);


header('Location:Admin_login.php');
Session_destroy();

?>