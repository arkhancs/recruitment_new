<?php

session_start();
if (isset($_POST['captcha_code_e'])) {

    if ($_POST['captcha_code_e'] != $_SESSION['code_e']) {

        echo "false_captcha";

        exit();
    }
}

if (!isset($_SERVER['HTTP_REFERER'])) {
    header('location:./index.php');
    exit;
}
//error_reporting(E_ALL ^ E_DEPRECATED);
error_reporting(0);

include('dbConfig.php');
include "checker_input.php";

$reg_id = clean_input($link, $_POST['app_id_edu'] ?? '', 'Application ID (Education)');

$edu1 = clean_input($link, $_POST['edu1'] ?? '', 'Education 1');
$edu2 = clean_input($link, $_POST['edu2'] ?? '', 'Education 2');
$edu3 = clean_input($link, $_POST['edu3'] ?? '', 'Education 3');
$edu4 = clean_input($link, $_POST['edu4'] ?? '', 'Education 4');
$edu5 = clean_input($link, $_POST['edu5'] ?? '', 'Education 5');
$edu6 = clean_input($link, $_POST['edu6'] ?? '', 'Education 6');
$edu7 = clean_input($link, $_POST['edu7'] ?? '', 'Education 7');
$edu8 = clean_input($link, $_POST['edu8'] ?? '', 'Education 8');


$board1 = clean_input($link, $_POST['board1'] ?? '', 'Board 1');
$board2 = clean_input($link, $_POST['board2'] ?? '', 'Board 2');
$board3 = clean_input($link, $_POST['board3'] ?? '', 'Board 3');
$board4 = clean_input($link, $_POST['board4'] ?? '', 'Board 4');
$board5 = clean_input($link, $_POST['board5'] ?? '', 'Board 5');
$board6 = clean_input($link, $_POST['board6'] ?? '', 'Board 6');
$board7 = clean_input($link, $_POST['board7'] ?? '', 'Board 7');
$board8 = clean_input($link, $_POST['board8'] ?? '', 'Board 8');


$year1 = clean_input($link, $_POST['year1'] ?? '', 'Year 1');
$year2 = clean_input($link, $_POST['year2'] ?? '', 'Year 2');
$year3 = clean_input($link, $_POST['year3'] ?? '', 'Year 3');
$year4 = clean_input($link, $_POST['year4'] ?? '', 'Year 4');
$year5 = clean_input($link, $_POST['year5'] ?? '', 'Year 5');
$year6 = clean_input($link, $_POST['year6'] ?? '', 'Year 6');
$year7 = clean_input($link, $_POST['year7'] ?? '', 'Year 7');
$year8 = clean_input($link, $_POST['year8'] ?? '', 'Year 8');


$per1 = clean_input($link, $_POST['per1'] ?? '', 'Percentage 1');
$per2 = clean_input($link, $_POST['per2'] ?? '', 'Percentage 2');
$per3 = clean_input($link, $_POST['per3'] ?? '', 'Percentage 3');
$per4 = clean_input($link, $_POST['per4'] ?? '', 'Percentage 4');
$per5 = clean_input($link, $_POST['per5'] ?? '', 'Percentage 5');
$per6 = clean_input($link, $_POST['per6'] ?? '', 'Percentage 6');
$per7 = clean_input($link, $_POST['per7'] ?? '', 'Percentage 7');
$per8 = clean_input($link, $_POST['per8'] ?? '', 'Percentage 8');


$speci1 = clean_input($link, $_POST['speci1'] ?? '', 'Specialization 1');
$speci2 = clean_input($link, $_POST['speci2'] ?? '', 'Specialization 2');
$speci3 = clean_input($link, $_POST['speci3'] ?? '', 'Specialization 3');
$speci4 = clean_input($link, $_POST['speci4'] ?? '', 'Specialization 4');
$speci5 = clean_input($link, $_POST['speci5'] ?? '', 'Specialization 5');
$speci6 = clean_input($link, $_POST['speci6'] ?? '', 'Specialization 6');
$speci7 = clean_input($link, $_POST['speci7'] ?? '', 'Specialization 7');
$speci8 = clean_input($link, $_POST['speci8'] ?? '', 'Specialization 8');


$div1 = clean_input($link, $_POST['div1'] ?? '', 'Division 1');
$div2 = clean_input($link, $_POST['div2'] ?? '', 'Division 2');
$div3 = clean_input($link, $_POST['div3'] ?? '', 'Division 3');
$div4 = clean_input($link, $_POST['div4'] ?? '', 'Division 4');
$div5 = clean_input($link, $_POST['div5'] ?? '', 'Division 5');
$div6 = clean_input($link, $_POST['div6'] ?? '', 'Division 6');
$div7 = clean_input($link, $_POST['div7'] ?? '', 'Division 7');
$div8 = clean_input($link, $_POST['div8'] ?? '', 'Division 8');


$ssc_file_path = '';
$hsc_file_path = '';
$bach_file_path = '';
$master_file_path = '';
$phd_file_path = '';
$other_edu_certi = '';
$comp_certi = '';

$sql_file = "SELECT ssc_certi, hsc_certi, bachelor_certi, master_certi, phd_certi, other_edu_certi, comp_certi FROM edctn WHERE id = ?";
$stmt = $link->prepare($sql_file);
$stmt->bind_param("s", $reg_id);
$stmt->execute();
$result_file = $stmt->get_result();

if ($result_file->num_rows == 0) {
} else {
    while ($row = mysqli_fetch_assoc($result_file)) {
        $ssc_file_path = $row['ssc_certi'];
        $hsc_file_path = $row['hsc_certi'];
        $bach_file_path = $row['bachelor_certi'];
        $master_file_path = $row['master_certi'];
        $phd_file_path = $row['phd_certi'];
        $other_edu_certi_parth = $row['other_edu_certi'];
        $comp_certi_parth = $row['comp_certi'];
    }
}

// date_default_timezone_set('Asia/Kolkata');
// $current_date = date("Y-m-d H:i:s");
// $enc_current_date = strtotime($current_date);

// if ($_FILES["ssc_certi"]["name"]) {
//     $temp1 = explode(".", $_FILES["ssc_certi"]["name"]);
//     $newfilename1 = md5($reg_id) . md5($enc_current_date) . md5('ssc') . '.' . end($temp1);
//     $ssc_file_path = 'uploads/qual/' . $newfilename1;
//     move_uploaded_file($_FILES["ssc_certi"]["tmp_name"], $ssc_file_path);
// }

date_default_timezone_set('Asia/Kolkata');
$current_date = date("Y-m-d H:i:s");
$enc_current_date = strtotime($current_date);

if ($_FILES["ssc_certi"]["name"]) {
    $allowed_types = [
        'jpg' => ['mime' => 'image/jpeg', 'signature' => "\xFF\xD8\xFF"],
        'jpeg' => ['mime' => 'image/jpeg', 'signature' => "\xFF\xD8\xFF"],
        'png' => ['mime' => 'image/png', 'signature' => "\x89\x50\x4E\x47\x0D\x0A\x1A\x0A"],
        'pdf' => ['mime' => 'application/pdf', 'signature' => "%PDF-"]
    ];

    $original_name = $_FILES["ssc_certi"]["name"];
    $file_tmp = $_FILES["ssc_certi"]["tmp_name"];
    $file_size = $_FILES["ssc_certi"]["size"];
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

    $newfilename1 = md5($reg_id) . md5($enc_current_date) . md5('ssc') . '.' . $ext;
    $ssc_file_path = 'uploads/qual/' . $newfilename1;

    if (!move_uploaded_file($file_tmp, $ssc_file_path)) {
        echo json_encode(['status' => 'error', 'message' => 'File upload failed.']);
        exit;
    }
}


// if ($_FILES["hsc_certi"]["name"]) {
//     $temp2 = explode(".", $_FILES["hsc_certi"]["name"]);
//     $newfilename2 = md5($reg_id) . md5('hsc') . md5($enc_current_date) . '.' . end($temp2);
//     $hsc_file_path = 'uploads/qual/' . $newfilename2;
//     move_uploaded_file($_FILES["hsc_certi"]["tmp_name"], $hsc_file_path);
// }

if ($_FILES["hsc_certi"]["name"]) {
    $allowed_types = [
        'jpg' => ['mime' => 'image/jpeg', 'signature' => "\xFF\xD8\xFF"],
        'jpeg' => ['mime' => 'image/jpeg', 'signature' => "\xFF\xD8\xFF"],
        'png' => ['mime' => 'image/png', 'signature' => "\x89\x50\x4E\x47\x0D\x0A\x1A\x0A"],
        'pdf' => ['mime' => 'application/pdf', 'signature' => "%PDF-"]
    ];

    $original_name = $_FILES["hsc_certi"]["name"];
    $file_tmp = $_FILES["hsc_certi"]["tmp_name"];
    $file_size = $_FILES["hsc_certi"]["size"];
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

    $newfilename2 = md5($reg_id) . md5('hsc') . md5($enc_current_date) . '.' . $ext;
    $hsc_file_path = 'uploads/qual/' . $newfilename2;

    if (!move_uploaded_file($file_tmp, $hsc_file_path)) {
        echo json_encode(['status' => 'error', 'message' => 'File upload failed.']);
        exit;
    }
}


// if ($_FILES["bachelor_certi"]["name"]) {
//     $temp3 = explode(".", $_FILES["bachelor_certi"]["name"]);
//     $newfilename3 = md5($enc_current_date) . md5('bachelor') . md5($reg_id) . '.' . end($temp3);
//     $bach_file_path = 'uploads/qual/' . $newfilename3;
//     move_uploaded_file($_FILES["bachelor_certi"]["tmp_name"], $bach_file_path);
// }

if ($_FILES["bachelor_certi"]["name"]) {
    $allowed_types = [
        'jpg' => ['mime' => 'image/jpeg', 'signature' => "\xFF\xD8\xFF"],
        'jpeg' => ['mime' => 'image/jpeg', 'signature' => "\xFF\xD8\xFF"],
        'png' => ['mime' => 'image/png', 'signature' => "\x89\x50\x4E\x47\x0D\x0A\x1A\x0A"],
        'pdf' => ['mime' => 'application/pdf', 'signature' => "%PDF-"]
    ];

    $original_name = $_FILES["bachelor_certi"]["name"];
    $file_tmp = $_FILES["bachelor_certi"]["tmp_name"];
    $file_size = $_FILES["bachelor_certi"]["size"];
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

    $newfilename3 = md5($enc_current_date) . md5('bachelor') . md5($reg_id) . '.' . $ext;
    $bach_file_path = 'uploads/qual/' . $newfilename3;

    if (!move_uploaded_file($file_tmp, $bach_file_path)) {
        echo json_encode(['status' => 'error', 'message' => 'File upload failed.']);
        exit;
    }
}


// if ($_FILES["master_certi"]["name"]) {
//     $temp4 = explode(".", $_FILES["master_certi"]["name"]);
//     $newfilename4 = md5($enc_current_date) . md5($reg_id) . md5('master') . '.' . end($temp4);
//     $master_file_path = 'uploads/qual/' . $newfilename4;
//     move_uploaded_file($_FILES["master_certi"]["tmp_name"], $master_file_path);
// }

if ($_FILES["master_certi"]["name"]) {
    $allowed_types = [
        'jpg' => ['mime' => 'image/jpeg', 'signature' => "\xFF\xD8\xFF"],
        'jpeg' => ['mime' => 'image/jpeg', 'signature' => "\xFF\xD8\xFF"],
        'png' => ['mime' => 'image/png', 'signature' => "\x89\x50\x4E\x47\x0D\x0A\x1A\x0A"],
        'pdf' => ['mime' => 'application/pdf', 'signature' => "%PDF-"]
    ];

    $original_name = $_FILES["master_certi"]["name"];
    $file_tmp = $_FILES["master_certi"]["tmp_name"];
    $file_size = $_FILES["master_certi"]["size"];
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

    $newfilename4 = md5($enc_current_date) . md5($reg_id) . md5('master') . '.' . $ext;
    $master_file_path = 'uploads/qual/' . $newfilename4;

    if (!move_uploaded_file($file_tmp, $master_file_path)) {
        echo json_encode(['status' => 'error', 'message' => 'File upload failed.']);
        exit;
    }
}


// if ($_FILES["phd_certi"]["name"]) {
//     $temp5 = explode(".", $_FILES["phd_certi"]["name"]);
//     $newfilename5 = md5('phdmphil') . md5($reg_id) . md5($enc_current_date) . '.' . end($temp5);
//     $phd_file_path = 'uploads/qual/' . $newfilename5;
//     move_uploaded_file($_FILES["phd_certi"]["tmp_name"], $phd_file_path);
// }

if ($_FILES["phd_certi"]["name"]) {
    $allowed_types = [
        'jpg' => ['mime' => 'image/jpeg', 'signature' => "\xFF\xD8\xFF"],
        'jpeg' => ['mime' => 'image/jpeg', 'signature' => "\xFF\xD8\xFF"],
        'png' => ['mime' => 'image/png', 'signature' => "\x89\x50\x4E\x47\x0D\x0A\x1A\x0A"],
        'pdf' => ['mime' => 'application/pdf', 'signature' => "%PDF-"]
    ];

    $original_name = $_FILES["phd_certi"]["name"];
    $file_tmp = $_FILES["phd_certi"]["tmp_name"];
    $file_size = $_FILES["phd_certi"]["size"];
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

    $newfilename5 = md5('phdmphil') . md5($reg_id) . md5($enc_current_date) . '.' . $ext;
    $phd_file_path = 'uploads/qual/' . $newfilename5;

    if (!move_uploaded_file($file_tmp, $phd_file_path)) {
        echo json_encode(['status' => 'error', 'message' => 'File upload failed.']);
        exit;
    }
}


// if ($_FILES["other_edu_certi"]["name"]) {
//     $temp7 = explode(".", $_FILES["other_edu_certi"]["name"]);
//     $newfilename7 = md5('others') . md5($enc_current_date) . md5($reg_id) . '.' . end($temp7);
//     $other_edu_certi_parth = 'uploads/qual/' . $newfilename7;
//     move_uploaded_file($_FILES["other_edu_certi"]["tmp_name"], $other_edu_certi_parth);
// }

if ($_FILES["other_edu_certi"]["name"]) {
    $allowed_types = [
        'jpg' => ['mime' => 'image/jpeg', 'signature' => "\xFF\xD8\xFF"],
        'jpeg' => ['mime' => 'image/jpeg', 'signature' => "\xFF\xD8\xFF"],
        'png' => ['mime' => 'image/png', 'signature' => "\x89\x50\x4E\x47\x0D\x0A\x1A\x0A"],
        'pdf' => ['mime' => 'application/pdf', 'signature' => "%PDF-"]
    ];

    $original_name = $_FILES["other_edu_certi"]["name"];
    $file_tmp = $_FILES["other_edu_certi"]["tmp_name"];
    $file_size = $_FILES["other_edu_certi"]["size"];
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

    $newfilename7 = md5('others') . md5($enc_current_date) . md5($reg_id) . '.' . $ext;
    $other_edu_certi_parth = 'uploads/qual/' . $newfilename7;

    if (!move_uploaded_file($file_tmp, $other_edu_certi_parth)) {
        echo json_encode(['status' => 'error', 'message' => 'File upload failed.']);
        exit;
    }
}


// if ($_FILES["comp_certi"]["name"]) {
//     $temp7 = explode(".", $_FILES["comp_certi"]["name"]);
//     $newfilename7 = md5('others') . md5($enc_current_date) . md5($reg_id) . '.' . end($temp7);
//     $comp_certi_parth = 'uploads/qual/' . $newfilename7;
//     move_uploaded_file($_FILES["comp_certi"]["tmp_name"], $comp_certi_parth);
// }

if ($_FILES["comp_certi"]["name"]) {
    $allowed_types = [
        'jpg' => ['mime' => 'image/jpeg', 'signature' => "\xFF\xD8\xFF"],
        'jpeg' => ['mime' => 'image/jpeg', 'signature' => "\xFF\xD8\xFF"],
        'png' => ['mime' => 'image/png', 'signature' => "\x89\x50\x4E\x47\x0D\x0A\x1A\x0A"],
        'pdf' => ['mime' => 'application/pdf', 'signature' => "%PDF-"]
    ];

    $original_name = $_FILES["comp_certi"]["name"];
    $file_tmp = $_FILES["comp_certi"]["tmp_name"];
    $file_size = $_FILES["comp_certi"]["size"];
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

    $newfilename7 = md5('others') . md5($enc_current_date) . md5($reg_id) . '.' . $ext;
    $comp_certi_parth = 'uploads/qual/' . $newfilename7;

    if (!move_uploaded_file($file_tmp, $comp_certi_parth)) {
        echo json_encode(['status' => 'error', 'message' => 'File upload failed.']);
        exit;
    }
}


// $sql = "update edctn set edu1='$edu1',edu2='$edu2',edu3='$edu3',edu4='$edu4',edu5='$edu5',edu6='$edu6',edu7='$edu7',edu8='$edu8',board1='$board1',board2='$board2',board3='$board3',board4='$board4',board5='$board5',board6='$board6',board7='$board7',board8='$board8',"
//     . "year1='$year1',year2='$year2',year3='$year3',year4='$year4',year5='$year5',year6='$year6',year7='$year7',year8='$year8',per1='$per1',per2='$per2',per3='$per3',per4='$per4',per5='$per5',per6='$per6',per7='$per7',per8='$per8',"
//     . "spec1='$speci1',spec2='$speci2',spec3='$speci3',spec4='$speci4',spec5='$speci5',spec6='$speci6',spec7='$speci7',spec8='$speci8',div1='$div1',div2='$div2',div3='$div3',div4='$div4',div5='$div5',div6='$div6',div7='$div7',div8='$div8',"
//     . "ssc_certi='$ssc_file_path', hsc_certi='$hsc_file_path', bachelor_certi='$bach_file_path',master_certi='$master_file_path',phd_certi='$phd_file_path',other_edu_certi='$other_edu_certi_parth',comp_certi='$comp_certi_parth' where id='$reg_id'";

// $result_update = mysqli_query($link, $sql);

$sql = "UPDATE edctn SET
    edu1 = ?, edu2 = ?, edu3 = ?, edu4 = ?, edu5 = ?, edu6 = ?, edu7 = ?, edu8 = ?,
    board1 = ?, board2 = ?, board3 = ?, board4 = ?, board5 = ?, board6 = ?, board7 = ?, board8 = ?,
    year1 = ?, year2 = ?, year3 = ?, year4 = ?, year5 = ?, year6 = ?, year7 = ?, year8 = ?,
    per1 = ?, per2 = ?, per3 = ?, per4 = ?, per5 = ?, per6 = ?, per7 = ?, per8 = ?,
    spec1 = ?, spec2 = ?, spec3 = ?, spec4 = ?, spec5 = ?, spec6 = ?, spec7 = ?, spec8 = ?,
    div1 = ?, div2 = ?, div3 = ?, div4 = ?, div5 = ?, div6 = ?, div7 = ?, div8 = ?,
    ssc_certi = ?, hsc_certi = ?, bachelor_certi = ?, master_certi = ?, phd_certi = ?,
    other_edu_certi = ?, comp_certi = ?, is_upload = ?
    WHERE id = ?";

$stmt = mysqli_prepare($link, $sql);

mysqli_stmt_bind_param(
    $stmt,
    str_repeat('s', 57),
    $edu1,
    $edu2,
    $edu3,
    $edu4,
    $edu5,
    $edu6,
    $edu7,
    $edu8,
    $board1,
    $board2,
    $board3,
    $board4,
    $board5,
    $board6,
    $board7,
    $board8,
    $year1,
    $year2,
    $year3,
    $year4,
    $year5,
    $year6,
    $year7,
    $year8,
    $per1,
    $per2,
    $per3,
    $per4,
    $per5,
    $per6,
    $per7,
    $per8,
    $speci1,
    $speci2,
    $speci3,
    $speci4,
    $speci5,
    $speci6,
    $speci7,
    $speci8,
    $div1,
    $div2,
    $div3,
    $div4,
    $div5,
    $div6,
    $div7,
    $div8,
    $ssc_file_path,
    $hsc_file_path,
    $bach_file_path,
    $master_file_path,
    $phd_file_path,
    $other_edu_certi_parth,
    $comp_certi_parth,
    $is_upload,
    $reg_id
);

$result_update = mysqli_stmt_execute($stmt);

if ($result_update) {
    $sql = "SELECT * FROM edctn WHERE id = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, 's', $reg_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 0) {
    } else {
        while ($row = mysqli_fetch_assoc($result)) {
            session_start();

            $_SESSION['edu1'] = $row['edu1'];
            $_SESSION['edu2'] = $row['edu2'];
            $_SESSION['edu3'] = $row['edu3'];
            $_SESSION['edu4'] = $row['edu4'];
            $_SESSION['edu5'] = $row['edu5'];
            $_SESSION['edu6'] = $row['edu6'];
            $_SESSION['edu7'] = $row['edu7'];
            $_SESSION['edu8'] = $row['edu8'];

            $_SESSION['board1'] = $row['board1'];
            $_SESSION['board2'] = $row['board2'];
            $_SESSION['board3'] = $row['board3'];
            $_SESSION['board4'] = $row['board4'];
            $_SESSION['board5'] = $row['board5'];
            $_SESSION['board6'] = $row['board6'];
            $_SESSION['board7'] = $row['board7'];
            $_SESSION['board8'] = $row['board8'];

            $_SESSION['year1'] = $row['year1'];
            $_SESSION['year2'] = $row['year2'];
            $_SESSION['year3'] = $row['year3'];
            $_SESSION['year4'] = $row['year4'];
            $_SESSION['year5'] = $row['year5'];
            $_SESSION['year6'] = $row['year6'];
            $_SESSION['year7'] = $row['year7'];
            $_SESSION['year8'] = $row['year8'];

            $_SESSION['per1'] = $row['per1'];
            $_SESSION['per2'] = $row['per2'];
            $_SESSION['per3'] = $row['per3'];
            $_SESSION['per4'] = $row['per4'];
            $_SESSION['per5'] = $row['per5'];
            $_SESSION['per6'] = $row['per6'];
            $_SESSION['per7'] = $row['per7'];
            $_SESSION['per8'] = $row['per8'];

            $_SESSION['speci1'] = $row['spec1'];
            $_SESSION['speci2'] = $row['spec2'];
            $_SESSION['speci3'] = $row['spec3'];
            $_SESSION['speci4'] = $row['spec4'];
            $_SESSION['speci5'] = $row['spec5'];
            $_SESSION['speci6'] = $row['spec6'];
            $_SESSION['speci7'] = $row['spec7'];
            $_SESSION['speci8'] = $row['spec8'];

            $_SESSION['div1'] = $row['div1'];
            $_SESSION['div2'] = $row['div2'];
            $_SESSION['div3'] = $row['div3'];
            $_SESSION['div4'] = $row['div4'];
            $_SESSION['div5'] = $row['div5'];
            $_SESSION['div6'] = $row['div6'];
            $_SESSION['div7'] = $row['div7'];
            $_SESSION['div8'] = $row['div8'];

            $_SESSION['ssc_certi'] = $row['ssc_certi'];
            $_SESSION['hsc_certi'] = $row['hsc_certi'];
            $_SESSION['bachelor_certi'] = $row['bachelor_certi'];
            $_SESSION['master_certi'] = $row['master_certi'];
            $_SESSION['phd_certi'] = $row['phd_certi'];
            $_SESSION['other_edu_certi'] = $row['other_edu_certi'];
            $_SESSION['comp_certi'] = $row['comp_certi'];

            header("location:application_form.php");
        }
    }
} else {
    header("location:application_form.php");
}
