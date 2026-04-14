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
$post_id = $_POST['post_id'];
if ($post_id != "" && isset($post_id)) {
    $sql = "SELECT prsnl.id, prsnl.attendance, question.* FROM prsnl LEFT JOIN question ON question.candidate_id = prsnl.id WHERE prsnl.status_check IN ('Eligible','Provisionally') AND prsnl.status = 'current' AND prsnl.post = '$post_id' GROUP BY prsnl.id";
    $result = mysqli_query($link, $sql);
    $i = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $atd = ($row['attendance'] == 'Yes') ? 'checked' : '';
        if ($row['candidate_id'] != "") {
            $view = "<a href='view_question.php' target='_blank'>View</a>";
        } else {
            $view = "";
        }
        echo "<tr><td align='center'>" . $i . "</td>"
        . "<td>" . $row['id'] . "</td>"
        . "<td align='center'><input type='checkbox' class='attendancee' name='attendance' data-value='" . $row['id'] . "' id='attendancee" . $i . "' $atd></td>"
        . "<td><input type='file' class='omrsheet' name='omr_sheet" . $i . "' id='omr_sheet" . $i . "' data-value='" . $row['id'] . "'><br> <span id='uploaded_image'></span></td>"
        . "<td align='center'>" . $view . "</td></tr>";
        $i++;
    }
}
?>
