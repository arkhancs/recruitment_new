<?php

session_start();
if (isset($_POST['captcha_code_ud'])) {

    if ($_POST['captcha_code_ud'] != $_SESSION['code_ud']) {

        echo "false_captcha";

        exit();
    }
}

if (!isset($_SERVER['HTTP_REFERER'])) {
    header('location:./index.php');
    exit;
}
error_reporting(0);
include('dbConfig.php');

$reg_id = $_POST['app_id_docs'];
$transaction_ref_no = $_POST['transaction_pref'] . $_POST['transaction_ref_no'];
$dd_date = $_POST['dd_date'];
$dd_amount = $_POST['dd_amount'];
//$bank_name = $_POST['bank_name'];
//$branch_name = $_POST['branch_name'];
//$applied_ps = $_POST['applied_ps'];
//$previous_app_id = $_POST['previous_id'];

$file_1_path = $file_2_path = $file_3_path = $file_4_path = $file_5_path = $file_6_path = $file_7_path = '';
$sql = "select prsnl.photo as photo,othrs.* from prsnl join othrs on prsnl.id=othrs.id  where othrs.id='$reg_id'";
$result = mysqli_query($link, $sql);
if (mysqli_num_rows($result) == 0) {
} else {
    while ($row = mysqli_fetch_assoc($result)) {
        $file_1_path = $row['photo'];
        $file_2_path = $row['sign'];
        $file_3_path = $row['noc'];
        $file_4_path = $row['othrdoc'];
        $file_5_path = $row['dob_proof'];
        $file_6_path = $row['fees_receipt'];
        $file_7_path = $row['castecerti'];
        $file_apars_path = $row['apars_doc'];
    }
}

date_default_timezone_set('Asia/Kolkata');
$current_date = date("Y-m-d H:i:s");
$enc_current_date = strtotime($current_date);

if ($_FILES["file_fees"]["name"]) {
    $temp6 = explode(".", $_FILES["file_fees"]["name"]);
    $newfilename = md5($reg_id) . md5($enc_current_date) . md5('fees_Receipt') . '.' . end($temp6);
    $file_6_path = 'uploads/fees/' . $newfilename;
    move_uploaded_file($_FILES["file_fees"]["tmp_name"], $file_6_path);
}

if ($_FILES["file_1"]["name"]) {
    $temp1 = explode(".", $_FILES["file_1"]["name"]);
    $newfilename = md5($enc_current_date) . md5($reg_id) . md5('pHt') . '.' . end($temp1);
    $file_1_path = 'uploads/pht/' . $newfilename;
    move_uploaded_file($_FILES["file_1"]["tmp_name"], $file_1_path);
}

if ($_FILES["file_2"]["name"]) {
    $temp2 = explode(".", $_FILES["file_2"]["name"]);
    $newfilename = md5($enc_current_date) . md5('s!gn') . md5($reg_id) . '.' . end($temp2);
    $file_2_path = 'uploads/sign/' . $newfilename;
    move_uploaded_file($_FILES["file_2"]["tmp_name"], $file_2_path);
}

if ($_FILES["file_3"]["name"]) {

    $temp3 = explode(".", $_FILES["file_3"]["name"]);
    $newfilename = md5($reg_id) . md5('n0c') . md5($enc_current_date) . '.' . end($temp3);
    $file_3_path = 'uploads/noc/' . $newfilename;
    move_uploaded_file($_FILES["file_3"]["tmp_name"], $file_3_path);
}

if ($_FILES["file_4"]["name"]) {

    $temp4 = explode(".", $_FILES["file_4"]["name"]);
    $newfilename = md5('oTh') . md5($reg_id) . md5($enc_current_date) . '.' . end($temp4);
    $file_4_path = 'uploads/othr/' . $newfilename;
    move_uploaded_file($_FILES["file_4"]["tmp_name"], $file_4_path);
}

if ($_FILES["file_5"]["name"]) {
    $temp5 = explode(".", $_FILES["file_5"]["name"]);
    $newfilename = md5('d0B') . md5($enc_current_date) . md5($reg_id) . '.' . end($temp5);
    $file_5_path = 'uploads/dob/' . $newfilename;
    move_uploaded_file($_FILES["file_5"]["tmp_name"], $file_5_path);
}


//if ($_FILES["file_7"]["name"]) {
//
//    $temp7 = explode(".", $_FILES["file_7"]["name"]);
//    $newfilename = $reg_id . '-caste.' . end($temp7);
//    $file_7_path = 'uploads/caste/' . $newfilename;
//    move_uploaded_file($_FILES["file_7"]["tmp_name"], $file_7_path);
//}

if ($_FILES["file_apars"]["name"]) {
    $temp_apar = explode(".", $_FILES["file_apars"]["name"]);
    $newfilename = md5($reg_id) . md5('apars') . md5($enc_current_date) . '.' . end($temp_apar);
    $file_apars_path = 'uploads/apars/' . $newfilename;
    move_uploaded_file($_FILES["file_apars"]["tmp_name"], $file_apars_path);
} else {
    // If no new upload, retain existing value (optional)
    $file_apars_path = '';
}


// $sql = "update othrs set sign='$file_2_path', dob_proof ='$file_5_path', noc='$file_3_path',othrdoc='$file_4_path', transaction_ref_no='$transaction_ref_no', dd_date='$dd_date', dd_amount='$dd_amount', fees_receipt='$file_6_path' where id='$reg_id'";

$sql = "UPDATE othrs SET
            sign='$file_2_path',
            dob_proof='$file_5_path',
            noc='$file_3_path',
            othrdoc='$file_4_path',
            transaction_ref_no='$transaction_ref_no',
            dd_date='$dd_date',
            dd_amount='$dd_amount',
            fees_receipt='$file_6_path'";

if (!empty($file_apars_path)) {
    $sql .= ", apars_doc='$file_apars_path'";
}

$sql .= " WHERE id='$reg_id'";


$result_update = mysqli_query($link, $sql);

$sql = "update prsnl set photo='$file_1_path' where id='$reg_id'";
$result_update = mysqli_query($link, $sql);

//  echo json_encode("true");

if ($result_update) {
    $sql = "select prsnl.photo as photo,othrs.* from prsnl join othrs on prsnl.id=othrs.id  where othrs.id='$reg_id'";
    $result = mysqli_query($link, $sql);
    if (mysqli_num_rows($result) == 0) {
    } else {
        while ($row = mysqli_fetch_assoc($result)) {
            session_start();
            $_SESSION['photo'] = $row['photo'];
            $_SESSION['sign'] = $row['sign'];
            $_SESSION['dob_proof'] = $row['dob_proof'];
            $_SESSION['noc'] = $row['noc'];
            $_SESSION['otherdoc'] = $row['othrdoc'];
            $_SESSION['dd_date'] = $row['dd_date'];
            $_SESSION['dd_amount'] = $row['dd_amount'];
            //            $_SESSION['bank_name'] = $row['bank_name'];
            $_SESSION['transaction_ref_no'] = $row['transaction_ref_no'];
            //            $_SESSION['branch_name'] = $row['branch_name'];
            //$_SESSION['previous_applied'] = $row['previous_applied'];
            //$_SESSION['previous_app_id'] = $row['previous_app_id'];
            $_SESSION['fees_receipt'] = $row['fees_receipt'];
            $_SESSION['apars_doc'] = $row['apars_doc'];
            //$_SESSION['castecerti'] = $row['castecerti'];
            header("location:application_form.php");
        }
    }
} else {
    header("location:application_form.php");
}
