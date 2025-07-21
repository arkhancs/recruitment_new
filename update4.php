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
include "checker_input.php";

$reg_id              = clean_input($link, $_POST['app_id_docs'] ?? '', 'Application ID (Documents)');
$transaction_ref_no  = clean_input($link, $_POST['transaction_ref_no'] ?? '', 'Transaction Reference Number');
$dd_date             = clean_input($link, $_POST['dd_date'] ?? '', 'DD Date');
$dd_amount           = clean_input($link, $_POST['dd_amount'] ?? '', 'DD Amount');

// $transaction_ref_no = $_POST['transaction_pref'] . $_POST['transaction_ref_no'];
//$bank_name = $_POST['bank_name'];
//$branch_name = $_POST['branch_name'];
//$applied_ps = $_POST['applied_ps'];
//$previous_app_id = $_POST['previous_id'];

// $file_1_path = $file_2_path = $file_3_path = $file_4_path = $file_5_path = $file_6_path = $file_7_path = '';
// $sql = "select prsnl.photo as photo,othrs.* from prsnl join othrs on prsnl.id=othrs.id  where othrs.id='$reg_id'";
// $result = mysqli_query($link, $sql);
// if (mysqli_num_rows($result) == 0) {
// } else {
//     while ($row = mysqli_fetch_assoc($result)) {
//         $file_1_path = $row['photo'];
//         $file_2_path = $row['sign'];
//         $file_3_path = $row['noc'];
//         $file_4_path = $row['othrdoc'];
//         $file_5_path = $row['dob_proof'];
//         $file_6_path = $row['fees_receipt'];
//         $file_7_path = $row['castecerti'];
//         $file_apars_path = $row['apars_doc'];
//     }
// }

$file_1_path = $file_2_path = $file_3_path = $file_4_path = $file_5_path = $file_6_path = $file_7_path = $file_apars_path = '';

$sql = "SELECT prsnl.photo AS photo, othrs.* FROM prsnl JOIN othrs ON prsnl.id = othrs.id WHERE othrs.id = ?";
$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($stmt, 's', $reg_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
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

// if ($_FILES["file_fees"]["name"]) {
//     $temp6 = explode(".", $_FILES["file_fees"]["name"]);
//     $newfilename = md5($reg_id) . md5($enc_current_date) . md5('fees_Receipt') . '.' . end($temp6);
//     $file_6_path = 'uploads/fees/' . $newfilename;
//     move_uploaded_file($_FILES["file_fees"]["tmp_name"], $file_6_path);
// }

if ($_FILES["file_fees"]["name"]) {
    $allowed_types = [
        'jpg' => ['mime' => 'image/jpeg', 'signature' => "\xFF\xD8\xFF"],
        'jpeg' => ['mime' => 'image/jpeg', 'signature' => "\xFF\xD8\xFF"],
        'png' => ['mime' => 'image/png', 'signature' => "\x89\x50\x4E\x47\x0D\x0A\x1A\x0A"],
        'pdf' => ['mime' => 'application/pdf', 'signature' => "%PDF-"]
    ];

    $original_name = $_FILES["file_fees"]["name"];
    $file_tmp = $_FILES["file_fees"]["tmp_name"];
    $file_size = $_FILES["file_fees"]["size"];
    $ext = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));

    if (!array_key_exists($ext, $allowed_types)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid file extension.']);
        exit;
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file_tmp);
    finfo_close($finfo);

    if ($mime !== $allowed_types[$ext]['mime']) {
        echo json_encode(['status' => 'error', 'message' => 'Mismatch between extension and MIME type.']);
        exit;
    }

    if ($file_size > 400 * 1024) {
        echo json_encode(['status' => 'error', 'message' => 'File too large. Max 400 KB allowed.']);
        exit;
    }

    $expected_signature = $allowed_types[$ext]['signature'];
    $expected_length = strlen($expected_signature);
    $handle = fopen($file_tmp, 'rb');
    if ($handle === false) {
        echo json_encode(['status' => 'error', 'message' => 'Unable to read file for validation.']);
        exit;
    }
    $file_signature = fread($handle, $expected_length);
    fclose($handle);

    if (strncmp($file_signature, $expected_signature, $expected_length) !== 0) {
        echo json_encode(['status' => 'error', 'message' => 'File content does not match declared type.']);
        exit;
    }

    $newfilename = md5($reg_id) . md5($enc_current_date) . md5('fees_Receipt') . '.' . $ext;
    $file_6_path = 'uploads/fees/' . $newfilename;

    if (!move_uploaded_file($file_tmp, $file_6_path)) {
        echo json_encode(['status' => 'error', 'message' => 'File upload failed.']);
        exit;
    }
}


// if ($_FILES["file_1"]["name"]) {
//     $temp1 = explode(".", $_FILES["file_1"]["name"]);
//     $newfilename = md5($enc_current_date) . md5($reg_id) . md5('pHt') . '.' . end($temp1);
//     $file_1_path = 'uploads/pht/' . $newfilename;
//     move_uploaded_file($_FILES["file_1"]["tmp_name"], $file_1_path);
// }

if ($_FILES["file_1"]["name"]) {
    $allowed_types = [
        'jpg' => ['mime' => 'image/jpeg', 'signature' => "\xFF\xD8\xFF"],
        'jpeg' => ['mime' => 'image/jpeg', 'signature' => "\xFF\xD8\xFF"],
        'png' => ['mime' => 'image/png', 'signature' => "\x89\x50\x4E\x47\x0D\x0A\x1A\x0A"]
    ];

    $original_name = $_FILES["file_1"]["name"];
    $file_tmp = $_FILES["file_1"]["tmp_name"];
    $file_size = $_FILES["file_1"]["size"];
    $ext = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));

    if (!array_key_exists($ext, $allowed_types)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid file extension.']);
        exit;
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file_tmp);
    finfo_close($finfo);

    if ($mime !== $allowed_types[$ext]['mime']) {
        echo json_encode(['status' => 'error', 'message' => 'Mismatch between extension and MIME type.']);
        exit;
    }

    if ($file_size > 400 * 1024) {
        echo json_encode(['status' => 'error', 'message' => 'File too large. Max 400 KB allowed.']);
        exit;
    }

    $expected_signature = $allowed_types[$ext]['signature'];
    $expected_length = strlen($expected_signature);
    $handle = fopen($file_tmp, 'rb');
    if ($handle === false) {
        echo json_encode(['status' => 'error', 'message' => 'Unable to read file for validation.']);
        exit;
    }
    $file_signature = fread($handle, $expected_length);
    fclose($handle);

    if (strncmp($file_signature, $expected_signature, $expected_length) !== 0) {
        echo json_encode(['status' => 'error', 'message' => 'File content does not match declared type.']);
        exit;
    }

    $newfilename = md5($enc_current_date) . md5($reg_id) . md5('pHt') . '.' . $ext;
    $file_1_path = 'uploads/pht/' . $newfilename;

    if (!move_uploaded_file($file_tmp, $file_1_path)) {
        echo json_encode(['status' => 'error', 'message' => 'File upload failed.']);
        exit;
    }
}


// if ($_FILES["file_2"]["name"]) {
//     $temp2 = explode(".", $_FILES["file_2"]["name"]);
//     $newfilename = md5($enc_current_date) . md5('s!gn') . md5($reg_id) . '.' . end($temp2);
//     $file_2_path = 'uploads/sign/' . $newfilename;
//     move_uploaded_file($_FILES["file_2"]["tmp_name"], $file_2_path);
// }
if ($_FILES["file_2"]["name"]) {
    $allowed_types = [
        'jpg' => ['mime' => 'image/jpeg', 'signature' => "\xFF\xD8\xFF"],
        'jpeg' => ['mime' => 'image/jpeg', 'signature' => "\xFF\xD8\xFF"],
        'png' => ['mime' => 'image/png', 'signature' => "\x89\x50\x4E\x47\x0D\x0A\x1A\x0A"]
    ];

    $original_name = $_FILES["file_2"]["name"];
    $file_tmp = $_FILES["file_2"]["tmp_name"];
    $file_size = $_FILES["file_2"]["size"];
    $ext = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));

    if (!array_key_exists($ext, $allowed_types)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid file extension.']);
        exit;
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file_tmp);
    finfo_close($finfo);

    if ($mime !== $allowed_types[$ext]['mime']) {
        echo json_encode(['status' => 'error', 'message' => 'Mismatch between extension and MIME type.']);
        exit;
    }

    if ($file_size > 400 * 1024) {
        echo json_encode(['status' => 'error', 'message' => 'File too large. Max 400 KB allowed.']);
        exit;
    }

    $expected_signature = $allowed_types[$ext]['signature'];
    $expected_length = strlen($expected_signature);
    $handle = fopen($file_tmp, 'rb');
    if ($handle === false) {
        echo json_encode(['status' => 'error', 'message' => 'Unable to read file for validation.']);
        exit;
    }
    $file_signature = fread($handle, $expected_length);
    fclose($handle);

    if (strncmp($file_signature, $expected_signature, $expected_length) !== 0) {
        echo json_encode(['status' => 'error', 'message' => 'File content does not match declared type.']);
        exit;
    }

    $newfilename = md5($enc_current_date) . md5('s!gn') . md5($reg_id) . '.' . $ext;
    $file_2_path = 'uploads/sign/' . $newfilename;

    if (!move_uploaded_file($file_tmp, $file_2_path)) {
        echo json_encode(['status' => 'error', 'message' => 'File upload failed.']);
        exit;
    }
}


// if ($_FILES["file_3"]["name"]) {

//     $temp3 = explode(".", $_FILES["file_3"]["name"]);
//     $newfilename = md5($reg_id) . md5('n0c') . md5($enc_current_date) . '.' . end($temp3);
//     $file_3_path = 'uploads/noc/' . $newfilename;
//     move_uploaded_file($_FILES["file_3"]["tmp_name"], $file_3_path);
// }

if ($_FILES["file_3"]["name"]) {
    $allowed_types = [
        'jpg' => ['mime' => 'image/jpeg', 'signature' => "\xFF\xD8\xFF"],
        'jpeg' => ['mime' => 'image/jpeg', 'signature' => "\xFF\xD8\xFF"],
        'png' => ['mime' => 'image/png', 'signature' => "\x89\x50\x4E\x47\x0D\x0A\x1A\x0A"],
        'pdf' => ['mime' => 'application/pdf', 'signature' => "%PDF-"]
    ];

    $original_name = $_FILES["file_3"]["name"];
    $file_tmp = $_FILES["file_3"]["tmp_name"];
    $file_size = $_FILES["file_3"]["size"];
    $ext = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));

    if (!array_key_exists($ext, $allowed_types)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid file extension.']);
        exit;
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file_tmp);
    finfo_close($finfo);

    if ($mime !== $allowed_types[$ext]['mime']) {
        echo json_encode(['status' => 'error', 'message' => 'Mismatch between extension and MIME type.']);
        exit;
    }

    if ($file_size > 400 * 1024) {
        echo json_encode(['status' => 'error', 'message' => 'File too large. Max 400 KB allowed.']);
        exit;
    }

    $expected_signature = $allowed_types[$ext]['signature'];
    $expected_length = strlen($expected_signature);
    $handle = fopen($file_tmp, 'rb');
    if ($handle === false) {
        echo json_encode(['status' => 'error', 'message' => 'Unable to read file for validation.']);
        exit;
    }
    $file_signature = fread($handle, $expected_length);
    fclose($handle);

    if (strncmp($file_signature, $expected_signature, $expected_length) !== 0) {
        echo json_encode(['status' => 'error', 'message' => 'File content does not match declared type.']);
        exit;
    }

    $newfilename = md5($reg_id) . md5('n0c') . md5($enc_current_date) . '.' . $ext;
    $file_3_path = 'uploads/noc/' . $newfilename;

    if (!move_uploaded_file($file_tmp, $file_3_path)) {
        echo json_encode(['status' => 'error', 'message' => 'File upload failed.']);
        exit;
    }
}


// if ($_FILES["file_4"]["name"]) {

//     $temp4 = explode(".", $_FILES["file_4"]["name"]);
//     $newfilename = md5('oTh') . md5($reg_id) . md5($enc_current_date) . '.' . end($temp4);
//     $file_4_path = 'uploads/othr/' . $newfilename;
//     move_uploaded_file($_FILES["file_4"]["tmp_name"], $file_4_path);
// }

if ($_FILES["file_4"]["name"]) {
    $allowed_types = [
        'jpg' => ['mime' => 'image/jpeg', 'signature' => "\xFF\xD8\xFF"],
        'jpeg' => ['mime' => 'image/jpeg', 'signature' => "\xFF\xD8\xFF"],
        'png' => ['mime' => 'image/png', 'signature' => "\x89\x50\x4E\x47\x0D\x0A\x1A\x0A"],
        'pdf' => ['mime' => 'application/pdf', 'signature' => "%PDF-"]
    ];

    $original_name = $_FILES["file_4"]["name"];
    $file_tmp = $_FILES["file_4"]["tmp_name"];
    $file_size = $_FILES["file_4"]["size"];
    $ext = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));

    if (!array_key_exists($ext, $allowed_types)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid file extension.']);
        exit;
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file_tmp);
    finfo_close($finfo);

    if ($mime !== $allowed_types[$ext]['mime']) {
        echo json_encode(['status' => 'error', 'message' => 'Mismatch between extension and MIME type.']);
        exit;
    }

    if ($file_size > 400 * 1024) {
        echo json_encode(['status' => 'error', 'message' => 'File too large. Max 400 KB allowed.']);
        exit;
    }

    $expected_signature = $allowed_types[$ext]['signature'];
    $expected_length = strlen($expected_signature);
    $handle = fopen($file_tmp, 'rb');
    if ($handle === false) {
        echo json_encode(['status' => 'error', 'message' => 'Unable to read file for validation.']);
        exit;
    }
    $file_signature = fread($handle, $expected_length);
    fclose($handle);

    if (strncmp($file_signature, $expected_signature, $expected_length) !== 0) {
        echo json_encode(['status' => 'error', 'message' => 'File content does not match declared type.']);
        exit;
    }

    $newfilename = md5('oTh') . md5($reg_id) . md5($enc_current_date) . '.' . $ext;
    $file_4_path = 'uploads/othr/' . $newfilename;

    if (!move_uploaded_file($file_tmp, $file_4_path)) {
        echo json_encode(['status' => 'error', 'message' => 'File upload failed.']);
        exit;
    }
}


// if ($_FILES["file_5"]["name"]) {
//     $temp5 = explode(".", $_FILES["file_5"]["name"]);
//     $newfilename = md5('d0B') . md5($enc_current_date) . md5($reg_id) . '.' . end($temp5);
//     $file_5_path = 'uploads/dob/' . $newfilename;
//     move_uploaded_file($_FILES["file_5"]["tmp_name"], $file_5_path);
// }

if ($_FILES["file_5"]["name"]) {
    $allowed_types = [
        'jpg' => ['mime' => 'image/jpeg', 'signature' => "\xFF\xD8\xFF"],
        'jpeg' => ['mime' => 'image/jpeg', 'signature' => "\xFF\xD8\xFF"],
        'png' => ['mime' => 'image/png', 'signature' => "\x89\x50\x4E\x47\x0D\x0A\x1A\x0A"],
        'pdf' => ['mime' => 'application/pdf', 'signature' => "%PDF-"]
    ];

    $original_name = $_FILES["file_5"]["name"];
    $file_tmp = $_FILES["file_5"]["tmp_name"];
    $file_size = $_FILES["file_5"]["size"];
    $ext = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));

    if (!array_key_exists($ext, $allowed_types)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid file extension.']);
        exit;
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file_tmp);
    finfo_close($finfo);

    if ($mime !== $allowed_types[$ext]['mime']) {
        echo json_encode(['status' => 'error', 'message' => 'Mismatch between extension and MIME type.']);
        exit;
    }

    if ($file_size > 400 * 1024) {
        echo json_encode(['status' => 'error', 'message' => 'File too large. Max 400 KB allowed.']);
        exit;
    }

    $expected_signature = $allowed_types[$ext]['signature'];
    $expected_length = strlen($expected_signature);
    $handle = fopen($file_tmp, 'rb');
    if ($handle === false) {
        echo json_encode(['status' => 'error', 'message' => 'Unable to read file for validation.']);
        exit;
    }
    $file_signature = fread($handle, $expected_length);
    fclose($handle);

    if (strncmp($file_signature, $expected_signature, $expected_length) !== 0) {
        echo json_encode(['status' => 'error', 'message' => 'File content does not match declared type.']);
        exit;
    }

    $newfilename = md5('d0B') . md5($enc_current_date) . md5($reg_id) . '.' . $ext;
    $file_5_path = 'uploads/dob/' . $newfilename;

    if (!move_uploaded_file($file_tmp, $file_5_path)) {
        echo json_encode(['status' => 'error', 'message' => 'File upload failed.']);
        exit;
    }
}


//if ($_FILES["file_7"]["name"]) {
//
//    $temp7 = explode(".", $_FILES["file_7"]["name"]);
//    $newfilename = $reg_id . '-caste.' . end($temp7);
//    $file_7_path = 'uploads/caste/' . $newfilename;
//    move_uploaded_file($_FILES["file_7"]["tmp_name"], $file_7_path);
//}

// if ($_FILES["file_apars"]["name"]) {
//     $temp_apar = explode(".", $_FILES["file_apars"]["name"]);
//     $newfilename = md5($reg_id) . md5('apars') . md5($enc_current_date) . '.' . end($temp_apar);
//     $file_apars_path = 'uploads/apars/' . $newfilename;
//     move_uploaded_file($_FILES["file_apars"]["tmp_name"], $file_apars_path);
// }

if ($_FILES["file_apars"]["name"]) {
    $allowed_types = [
        'pdf' => ['mime' => 'application/pdf', 'signature' => "%PDF-"]
    ];

    $original_name = $_FILES["file_apars"]["name"];
    $file_tmp = $_FILES["file_apars"]["tmp_name"];
    $file_size = $_FILES["file_apars"]["size"];
    $ext = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));

    if (!array_key_exists($ext, $allowed_types)) {
        echo json_encode(['status' => 'error', 'message' => 'Only PDF files are allowed.']);
        exit;
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file_tmp);
    finfo_close($finfo);

    if ($mime !== $allowed_types[$ext]['mime']) {
        echo json_encode(['status' => 'error', 'message' => 'Mismatch between extension and MIME type.']);
        exit;
    }

    if ($file_size > 2 * 1024 * 1024) {
        echo json_encode(['status' => 'error', 'message' => 'File too large. Max 2 MB allowed.']);
        exit;
    }

    $expected_signature = $allowed_types[$ext]['signature'];
    $expected_length = strlen($expected_signature);
    $handle = fopen($file_tmp, 'rb');
    if ($handle === false) {
        echo json_encode(['status' => 'error', 'message' => 'Unable to read file for validation.']);
        exit;
    }
    $file_signature = fread($handle, $expected_length);
    fclose($handle);

    if (strncmp($file_signature, $expected_signature, $expected_length) !== 0) {
        echo json_encode(['status' => 'error', 'message' => 'File content does not match declared type.']);
        exit;
    }

    $newfilename = md5($reg_id) . md5('apars') . md5($enc_current_date) . '.' . $ext;
    $file_apars_path = 'uploads/apars/' . $newfilename;

    if (!move_uploaded_file($file_tmp, $file_apars_path)) {
        echo json_encode(['status' => 'error', 'message' => 'File upload failed.']);
        exit;
    }
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
