<?php

//error_reporting(E_ALL ^ E_DEPRECATED);
error_reporting(0);


include('dbConfig.php');

$reg_id = $_POST['app_id'];
$ref1 = $_POST['ref1'];
$ref2 = $_POST['ref2'];
$detained = $_POST['detained'];
$detained_details = $_POST['detained_details'];
$other_info = $_POST['other_info'];
$declaration = $_POST['declaration'] != null ? 'Yes' : 'No';

$sql = "update othrs set ref1='$ref1',ref2='$ref2', detained='$detained',detained_details='$detained_details',other_info='$other_info', declaration='$declaration' where id='$reg_id'";

$result_update = mysqli_query($link, $sql);
if ($result_update) {
    $sql = "select ref1,ref2,detained,detained_details,other_info from othrs  where id='$reg_id'";
    $result = mysqli_query($link, $sql);
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
?>