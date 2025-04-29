<?php
if (!isset($_SERVER['HTTP_REFERER'])) {
    header('location:./index.php');
    exit;
}
include "dbConfig.php";

$post = mysqli_real_escape_string($link, $_POST['post_id']);

$sql = "select * from req_experience where post='" . $post . "'";
$result = mysqli_query($link, $sql);
if (mysqli_num_rows($result) != 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['caste_category'] == 'All') {
            $dropdown = 'All';
        } else if ($row['caste_category'] == 'OBC') {
            $dropdown = 'OBC';
        } else if ($row['caste_category'] == 'ST') {
            $dropdown = 'ST';
        } else if ($row['caste_category'] == 'SC') {
            $dropdown = 'SC';
        } else if ($row['caste_category'] == 'EWS') {
            $dropdown = 'EWS';
        } else if ($row['caste_category'] == 'Ex-servicemen') {
            $dropdown = 'Ex-servicemen';
        }
    }
    echo $dropdown;
}
?>