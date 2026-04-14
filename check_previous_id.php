<?php
if (!isset($_SERVER['HTTP_REFERER'])) {
    header('location:./index.php');
    exit;
}
error_reporting(0);
include('dbConfig.php');
$reg_id = $_POST['app_id_docs'];
$previous_id = $_POST['previous_id'];
if ($previous_id != "") {
//    $sql = "select id from prsnl where id = '$previous_id'";
//    $result_previous_id = mysqli_query($link, $sql);

    $sql = "SELECT prsnl.email, prsnl.id, prsnl.post, req_experience.Name from prsnl LEFT JOIN req_experience on req_experience.post=prsnl.post WHERE prsnl.id='$reg_id'";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
        
    $sql1 = "SELECT prsnl.email, prsnl.id, prsnl.post, req_experience.Name from prsnl LEFT JOIN req_experience on req_experience.post=prsnl.post WHERE prsnl.id='$previous_id' AND prsnl.id != '$reg_id'";
    $result1 = mysqli_query($link, $sql1);
    $row1 = mysqli_fetch_assoc($result1);
    
    if ($row1['id'] == 'PSAdmin-1-2020-12259' || $row1['id'] == 'PSAdmin-1-2020-12462' || $row1['id'] == 'PSAdmin-1-2020-13652' && $row['Name'] == $row1['Name']) {
        echo json_encode("true");
    } else {
        echo json_encode("false");
    }
//    if (mysqli_num_rows($result_previous_id) == 0) {
//        echo json_encode("true");
//    } else {
//        echo json_encode("false");
//    }
}
?>