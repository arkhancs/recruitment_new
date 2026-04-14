<?php
if (!isset($_SERVER['HTTP_REFERER'])) {
    header('location:./index.php');
    exit;
}
include('dbConfig.php');

$post = $_POST['post'];
$location = $_POST['job_location'];

//$sql = "SELECT status_check, count(status_check) as totals from prsnl
//where post='$post' and status = 'current' group BY status_check";
$sql = "SELECT sum(status_check = 'Eligible') as totals_verify, sum(status_check = 'NotEligible') as totals_invalid, sum(status_check = 'Provisionally') as totals_hold
from prsnl where post='$post' and status = 'current'";
$result = mysqli_query($link, $sql);


while ($row = mysqli_fetch_assoc($result)) {
    $data['totals_verify'] = $row['totals_verify'];
    $data['totals_invalid'] = $row['totals_invalid'];
    $data['totals_hold'] = $row['totals_hold'];
}
echo json_encode($data);
?>
