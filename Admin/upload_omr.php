<?php

error_reporting(0);
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("X-Frame-Options: SAMEORIGIN");
header("X-XSS-Protection: 1; mode=block");
setcookie("recrutmentcookie", "recrutment", 0, "/", "https://recruitment.inflibnet.ac.in/", true, true);
header("Content-Security-Policy: default-src 'self' https: data: 'unsafe-inline' 'unsafe-eval';");
header_remove("X-Powered-By");

include "dbConfig.php";
$candidate_id = $_POST['candidate_id'];

//if ($candidate_id != "" && isset($candidate_id)) {

if ($_FILES["omr_sheet1"]["name"] != '') {
    $test = explode('.', $_FILES["file"]["name"]);
    $ext = end($test);
    $name = rand(100, 999) . '.' . $ext;
    $location = '../uploads/omr/' . $name;
    print_r($location);exit;
    move_uploaded_file($_FILES["file"]["tmp_name"], $location);
}

//    $sql = "update prsnl set omr_sheet='$omr_sheet' where id='$candidate_id'";
//    $result_update = mysqli_query($link, $sql);
//    if ($result_update) {
//        
//    } else {
//        echo json_encode("false");
//    }
//}
?>
