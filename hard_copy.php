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
    $hard_copy_received = $_POST['hard_copy_received'];
    $inward_no = $_POST['inward_no'];
    $inward_date = $_POST['inward_date'];
    $user_id = $_POST['user_id'];

    $sql = "update othrs set hard_copy_received='$hard_copy_received', inward_no='$inward_no', inward_date='$inward_date' where id='$id'";
    $result_update = mysqli_query($link, $sql);

    if ($result_update) {
       include "get_ip.php";

        $sql_ua = "insert into history_admin VALUES(0,'$ua_browser','$ua_version','$ua_platform','$ua_ip','$ua_date','$ua_time','$user_id','$id','Update Status of hard Copy Received with Inward no. and Date')";
        $result_ua = mysqli_query($link, $sql_ua);

        echo "true";
    } else {
        echo "false";
    }

}

?>