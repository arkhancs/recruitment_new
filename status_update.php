<?php
if (!isset($_SERVER['HTTP_REFERER'])) {
    header('location:./Admin_login.php');
    exit;
}
error_reporting(E_ALL ^ E_DEPRECATED);
include('dbConfig.php');

if (isset($_POST)) {

    $status = $_POST['status'];
    $reg_id = $_POST['app_id'];
    $user_id = $_POST['user_id'];

    $sql = "update prsnl set status='$status' where id='$reg_id'";
    $result_update = mysql_query($sql, $link);

    if ($result_update) {

        include "get_ip.php";

        $sql_ua = "insert into history_admin VALUES(0,'$ua_browser','$ua_version','$ua_platform','$ua_ip','$ua_date','$ua_time','$user_id','$reg_id','Update Status to $status')";
        $result_ua = mysqli_query($link, $sql_ua);

        echo json_encode("true");
    } else {
        echo json_encode("false");
    }
}
?>