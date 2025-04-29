<?php

if (!isset($_SERVER['HTTP_REFERER'])) {
    header('location:./index.php');
    exit;
}
include "dbConfig.php";
$posts = mysqli_real_escape_string($link, $_GET['post_data']);

$sql = "SELECT prsnl.*, othrs.sign FROM prsnl LEFT JOIN othrs on othrs.id=prsnl.id where (prsnl.status_check='Eligible' or prsnl.status_check='Provisionally') and prsnl.post='" . $posts . "' order by prsnl.id";
$result = mysqli_query($link, $sql);

$sql1 = "SELECT Name as postname, year, category,sequence FROM req_experience where post='" . $posts . "'";
$result1 = mysqli_query($link, $sql1);
$row1 = mysqli_fetch_array($result1);
$postname = $row1['postname'];
$post_category = $row1['category'];
$year = $row1['year'];
$seq = $row1['sequence'];

if (mysqli_num_rows($result) != 0) {
    $i = 1;
    $data = '<table border="1" style="border-collapse: collapse; width:100%"><thead><tr><td align="center" colspan="5"><strong>Advt. No. ' . $seq . '/' . $year . ': Attendance Sheet of Eligible Candidate List for the post of ' . $postname . ' (' . $post_category . ')</strong></td></tr><tr><th width="5%">Srno</th><th width="20%">Candidate ID</th><th width="30%">Name</th><th width="15%">Photo/Sign</th><th width="40%">Signature</th></tr></thead><tbody>';
    while ($row = mysqli_fetch_array($result)) {
        $data .= '<tr><td>' . $i . '</td><td>' . $row['id'] . '<br>(' . $row['status_check'] . ')</td><td>' . $row['prefix'] . ' ' . $row['name'] . ' ' . $row['fathername'] . ' ' . $row['surname'] . '<br>(' . $row['category'] . ')</td><td><img height="100px" width="75px" src="' . $row['photo'] . '"><br><img height="30px" width="75px" src="' . $row['sign'] . '"></td><td></td></tr>';
        $i++;
    }
    $data .= '</tbody></table>';
    echo $data;
} else {
    echo '';
}
