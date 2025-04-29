<?php
if (!isset($_SERVER['HTTP_REFERER'])) {
    header('location:./index.php');
    exit;
}
//export.php  
include('dbConfig.php');

$type = $_GET["type"];

if ($type == 'ugc') {
    $sql = "SELECT prsnl.id, req_experience.Name as post_name, prsnl.job_location, prsnl.prefix, prsnl.surname, prsnl.name, prsnl.fathername, prsnl.lastname as middle_name_prefix, prsnl.dob,prsnl.age, prsnl.nation,prsnl.address, states.name as state, prsnl.city, prsnl.pincode, prsnl.paddress,states.name as pstate,prsnl.pcity,prsnl.ppincode, prsnl.same_address, prsnl.telephone, prsnl.mobile, prsnl.email,prsnl.mstatus,prsnl.aadhar_no, prsnl.category,prsnl.regdate,prsnl.status,prsnl.photo, edctn.*,exprn.*
    FROM prsnl 
    left join edctn on edctn.id=prsnl.id
    left join exprn on exprn.id=prsnl.id
    left join states on states.id=prsnl.state
    left JOIN req_experience on req_experience.post=prsnl.post and req_experience.job_location = prsnl.job_location
    where prsnl.status='current' and prsnl.job_location='UGC, New Delhi'";
} else if ($type == 'inflibnet_cs') {
    $sql = "SELECT prsnl.id, req_experience.Name as post_name, prsnl.job_location, prsnl.prefix, prsnl.surname, prsnl.name, prsnl.fathername, prsnl.lastname as middle_name_prefix, prsnl.dob,prsnl.age, prsnl.nation,prsnl.address, states.name as state, prsnl.city, prsnl.pincode, prsnl.paddress,states.name as pstate,prsnl.pcity,prsnl.ppincode, prsnl.same_address, prsnl.telephone, prsnl.mobile, prsnl.email,prsnl.mstatus,prsnl.aadhar_no, prsnl.category,prsnl.regdate,prsnl.status,prsnl.photo, edctn.*,exprn.*
    FROM prsnl 
    left join edctn on edctn.id=prsnl.id
    left join exprn on exprn.id=prsnl.id
    left join states on states.id=prsnl.state
    left JOIN req_experience on req_experience.post=prsnl.post
    where prsnl.status='current' and req_experience.category <> '' and req_experience.category != 'LS'";
} else if ($type == 'inflibnet_ls') {
    $sql = "SELECT prsnl.id, req_experience.Name as post_name, prsnl.job_location, prsnl.prefix, prsnl.surname, prsnl.name, prsnl.fathername, prsnl.lastname as middle_name_prefix, prsnl.dob,prsnl.age, prsnl.nation,prsnl.address, states.name as state, prsnl.city, prsnl.pincode, prsnl.paddress,states.name as pstate,prsnl.pcity,prsnl.ppincode, prsnl.same_address, prsnl.telephone, prsnl.mobile, prsnl.email,prsnl.mstatus,prsnl.aadhar_no, prsnl.category,prsnl.regdate,prsnl.status,prsnl.photo, edctn.*,exprn.*
    FROM prsnl 
    left join edctn on edctn.id=prsnl.id
    left join exprn on exprn.id=prsnl.id
    left join states on states.id=prsnl.state
    left JOIN req_experience on req_experience.post=prsnl.post
    where prsnl.status='current' and req_experience.category = 'LS'";
} else if ($type == 'inflibnet_administrative') {
    $sql = "SELECT prsnl.id, req_experience.Name as post_name, prsnl.job_location, prsnl.prefix, prsnl.surname, prsnl.name, prsnl.fathername, prsnl.lastname as middle_name_prefix, prsnl.dob,prsnl.age, prsnl.nation,prsnl.address, states.name as state, prsnl.city, prsnl.pincode, prsnl.paddress,states.name as pstate,prsnl.pcity,prsnl.ppincode, prsnl.same_address, prsnl.telephone, prsnl.mobile, prsnl.email,prsnl.mstatus,prsnl.aadhar_no, prsnl.category,prsnl.regdate,prsnl.status,prsnl.photo, edctn.*,exprn.*
    FROM prsnl 
    left join edctn on edctn.id=prsnl.id
    left join exprn on exprn.id=prsnl.id
    left join states on states.id=prsnl.state
    left JOIN req_experience on req_experience.post=prsnl.post
    where prsnl.status='current' and req_experience.category = ''";
}
//$sql = "select prsnl.*,edctn.*,exprn.* from prsnl join edctn on edctn.id=prsnl.id join exprn on exprn.id=prsnl.id where post ='$post' and prsnl.status='current'";

$result = mysqli_query($link, $sql);
$filename = $type . ".csv";
header("Content-Type: text/csv");
header('Content-Disposition: attachment; filename=' . $filename);
$flag = false;
$fp = fopen('php://output', 'w');

if (mysqli_num_rows($result) > 0) {


    while ($row = mysqli_fetch_assoc($result)) {
        $array[] = $row;
    }

    $array_key[] = array_keys($array[0]);
    $values = array_values($array);


    foreach ($array_key as $key => $value) {
        fputcsv($fp, $value);
        fputcsv($fp, "\n");
    }

    foreach ($values as $value) {
        fputcsv($fp, $value);
        fputcsv($fp, "\n");
    }
}

fclose($fp);
exit();
?>
