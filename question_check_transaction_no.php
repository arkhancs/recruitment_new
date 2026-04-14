<?php

if (!isset($_SERVER['HTTP_REFERER'])) {
    header('location:./index.php');
    exit;
}
error_reporting(0);
include('dbConfig.php');

$reg_id = $_POST['candidate_id'];
$ques_transaction_no = $_POST['ques_transaction_no'];

if ($ques_transaction_no != "" && $reg_id != "") {
    $sql_ref_no = "select que_transaction_id from question where que_transaction_id = '$ques_transaction_no' and candidate_id = '$reg_id'";
    $result_ref_no = mysqli_query($link, $sql_ref_no);

    if (mysqli_num_rows($result_ref_no) == 0) {
        echo json_encode("true");
    } else {
        echo json_encode("false");
    }
}
?>