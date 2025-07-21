<?php

//error_reporting(E_ALL ^ E_DEPRECATED);
error_reporting(0);


include('dbConfig.php');
include "checker_input.php";

$reg_id           = clean_input($link, $_POST['app_id'] ?? '', 'Application ID');
if (!isset($_POST['ref1']) || trim($_POST['ref1']) === '') {
    echo json_encode(['status' => 'error', 'message' => 'Reference 1 is required.']);
    exit;
}
$ref1 = clean_input($link, $_POST['ref1'], 'Reference 1');

if (!isset($_POST['ref2']) || trim($_POST['ref2']) === '') {
    echo json_encode(['status' => 'error', 'message' => 'Reference 2 is required.']);
    exit;
}
$ref2 = clean_input($link, $_POST['ref2'], 'Reference 2');

$detained         = clean_input($link, $_POST['detained'] ?? '', 'Detained');
$detained_details = clean_input($link, $_POST['detained_details'] ?? '', 'Detained Details');
$other_info       = clean_input($link, $_POST['other_info'] ?? '', 'Other Information');
$declaration      = isset($_POST['declaration']) ? 'Yes' : 'No';


$sql = "UPDATE othrs SET
    ref1 = ?,
    ref2 = ?,
    detained = ?,
    detained_details = ?,
    other_info = ?,
    declaration = ?
    WHERE id = ?";

$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param(
    $stmt,
    'sssssss',
    $ref1,
    $ref2,
    $detained,
    $detained_details,
    $other_info,
    $declaration,
    $reg_id
);

$result_update = mysqli_stmt_execute($stmt);

if ($result_update) {
    $sql = "SELECT ref1, ref2, detained, detained_details, other_info FROM othrs WHERE id = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, 's', $reg_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 0) {
    } else {
        while ($row = mysqli_fetch_assoc($result)) {
            session_start();

            $_SESSION['ref1'] = $row['ref1'];
            $_SESSION['ref2'] = $row['ref2'];
            $_SESSION['detained'] = $row['detained'];
            $_SESSION['detained_details'] = $row['detained_details'];
            $_SESSION['other_info'] = $row['other_info'];
            $_SESSION['declaration'] = $row['declaration'];
        }
        echo json_encode("true");
    }
} else {
    echo json_encode("false");
}
