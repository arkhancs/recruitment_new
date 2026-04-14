<?php
if (!isset($_SERVER['HTTP_REFERER'])) {
    header('location:./Admin_login.php');
    exit;
}
//error_reporting(E_ALL ^ E_DEPRECATED);
error_reporting(0);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('dbConfig.php');

    $id = $_POST['id'];
    $status_check = $_POST['status_check'];
    $status_remark = $_POST['status_remarks'];
    $user_id = $_POST['user_id'];

    //date_default_timezone_set('Asia/Kolkata');
    //$date = date("d/m/Y");

    date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
    //$date = date('d-m-Y H:i:s');

    $sql = "update prsnl set status_check='$status_check',status_date='$date', status_remarks='$status_remark' where id='$id'";
    $result_update = mysqli_query($link, $sql);

    if ($result_update) {
        include "get_ip.php";

        $sql_ua = "insert into history_admin VALUES(0,'$ua_browser','$ua_version','$ua_platform','$ua_ip','$ua_date','$ua_time','$user_id','$id','Update Status to $status_check')";
        $result_ua = mysqli_query($link, $sql_ua);

        echo "true";
    } else {
        echo "false";
    }
}
?>