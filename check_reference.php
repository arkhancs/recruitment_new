<?php
if (!isset($_SERVER['HTTP_REFERER'])) {
    header('location:./index.php');
    exit;
}
error_reporting(0);
include('dbConfig.php');
$reg_id = $_POST['app_id_docs'];
$transaction_ref_no = $_POST['transaction_pref'] . $_POST['transaction_ref_no'];
if ($transaction_ref_no != "") {
    $sql_ref_no = "select transaction_ref_no from othrs where transaction_ref_no = '$transaction_ref_no'";
    $result_ref_no = mysqli_query($link, $sql_ref_no);

    if (mysqli_num_rows($result_ref_no) == 0) {
        echo json_encode("true");
    } else {
        echo json_encode("false");
    }
}
