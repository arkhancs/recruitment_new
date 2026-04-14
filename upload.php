<?php

print_r('hii');
exit();
error_reporting(0);
include('dbConfig.php');

$reg_id = $_POST['app_id'];


$file_1_path = $file_2_path = $file_3_path = $file_4_path = $file_5_path = '';
if ($_FILES["noc"]["name"] != '' || $_FILES["caste_certi"]["name"] != '' || $_FILES["expr_certi"]["name"] != '' || $_FILES["other_file"]["name"] != '') {

    if ($_FILES["noc"]["name"] != '') {
        $temp1 = explode(".", $_FILES["noc"]["name"]);
        $newfilename = $reg_id . '-noc.' . end($temp1);
        $file_1_path = 'uploads/noc/' . $newfilename;
        move_uploaded_file($_FILES["noc"]["tmp_name"], $file_1_path);

        $sql = "update othrs set noc='$file_1_path' where id='$reg_id'";
        $result_update = mysqli_query($link, $sql);

        $sql1 = "update othrs set is_upload='y' where id='$reg_id'";
        $result_update1 = mysqli_query($link, $sql1);
    }

    if ($_FILES["caste_certi"]["name"] != '') {
        $temp2 = explode(".", $_FILES["caste_certi"]["name"]);
        $newfilename = $reg_id . '-caste.' . end($temp2);
        $file_2_path = 'uploads/caste/' . $newfilename;
        move_uploaded_file($_FILES["caste_certi"]["tmp_name"], $file_2_path);

        $sql = "update prsnl set caste_certi='$file_2_path' where id='$reg_id'";
        $result_update = mysqli_query($link, $sql);

        $sql1 = "update prsnl set is_upload='y' where id='$reg_id'";
        $result_update1 = mysqli_query($link, $sql1);
    }

    if ($_FILES["expr_certi"]["name"] != '') {
        $temp3 = explode(".", $_FILES["expr_certi"]["name"]);
        $newfilename = $reg_id . '-expr_certi.' . end($temp3);
        $file_3_path = 'uploads/expr/' . $newfilename;
        move_uploaded_file($_FILES["expr_certi"]["tmp_name"], $file_3_path);

        $sql = "update exprn exprn expr_certi='$file_3_path' where id='$reg_id'";
        $result_update = mysqli_query($link, $sql);

        $sql1 = "update exprn set is_upload='y' where id='$reg_id'";
        $result_update1 = mysqli_query($link, $sql1);
    }

    if ($_FILES["other_file"]["name"] != '') {
        $temp4 = explode(".", $_FILES["other_file"]["name"]);
        $newfilename = $reg_id . '-othr.' . end($temp4);
        $file_4_path = 'uploads/othr/' . $newfilename;
        move_uploaded_file($_FILES["other_file"]["tmp_name"], $file_4_path);

        $sql = "update othrs set othrdoc='$file_4_path' where id='$reg_id'";
        $result_update = mysqli_query($link, $sql);

        $sql1 = "update othrs set is_upload='y' where id='$reg_id'";
        $result_update1 = mysqli_query($link, $sql1);
    }

    if ($_FILES["master_degree_certi"]["name"] != '') {
        $temp2 = explode(".", $_FILES["master_degree_certi"]["name"]);
        $newfilename = $reg_id . '-master_certi.' . end($temp2);
        $file_5_path = 'uploads/qual/' . $newfilename;
        move_uploaded_file($_FILES["master_degree_certi"]["tmp_name"], $file_5_path);

        $sql = "update edctn set master_certi='$file_5_path' where id='$reg_id'";
        $result_update = mysqli_query($link, $sql);

        $sql1 = "update edctn set is_upload='y' where id='$reg_id'";
        $result_update1 = mysqli_query($link, $sql1);
    }

    $msg = "<div class='bg-success' style='padding: 10px;'>Document Uploaded Successfully.</div>";
    session_start();
    $_SESSION['msg'] = $msg;
    header("location:login.php");
} else {
    $msg = "<div class='bg-danger' style='padding: 10px;'>Document upload fail, Please select atleast one file to continue.</div>";
    session_start();
    $_SESSION['msg'] = $msg;
    //header("location:upload_documents.php");
}
?>