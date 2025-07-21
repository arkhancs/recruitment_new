<?php

if (!isset($_SERVER['HTTP_REFERER'])) {
    header('location:./index.php');
    exit;
}
error_reporting(0);
include('dbConfig.php');
include "checker_input.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

session_start();

if (isset($_POST)) {
    date_default_timezone_set('Asia/Kolkata');
    $date = date("d/m/Y H:i:s");

    $reg_id = clean_input($link, $_POST['app_id_other'] ?? '', 'Application ID');

    if (!isset($_POST['txtref1']) || trim($_POST['txtref1']) === '') {
        echo json_encode(['status' => 'error', 'message' => 'Reference 1 is required.']);
        exit;
    }
    $ref1 = clean_input($link, $_POST['txtref1'], 'Reference 1');

    if (!isset($_POST['txtref2']) || trim($_POST['txtref2']) === '') {
        echo json_encode(['status' => 'error', 'message' => 'Reference 2 is required.']);
        exit;
    }
    $ref2 = clean_input($link, $_POST['txtref2'], 'Reference 2');

    $other_info       = clean_input($link, $_POST['txtinfo'] ?? '', 'Other Information');
    $detained         = clean_input($link, $_POST['detained'] ?? '', 'Detained');
    $detained_details = clean_input($link, $_POST['detained_details'] ?? '', 'Detained Details');
    $declaration      = isset($_POST['declaration']) ? 'Yes' : 'No';

    // $sql = "UPDATE othrs SET ref1='$ref1', ref2='$ref2', detained='$detained', detained_details='$detained_details', other_info='$other_info', declaration='$declaration' WHERE id='$reg_id'";
    // $result_update1 = mysqli_query($link, $sql);
    $sql = "UPDATE othrs SET ref1 = ?, ref2 = ?, detained = ?, detained_details = ?, other_info = ?, declaration = ? WHERE id = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, 'sssssss', $ref1, $ref2, $detained, $detained_details, $other_info, $declaration, $reg_id);
    $result_update1 = mysqli_stmt_execute($stmt);


    $check1 = "SELECT a.id,b.id,c.id,d.id FROM prsnl a INNER JOIN exprn b ON b.id = a.id INNER JOIN edctn c ON c.id = a.id INNER JOIN othrs d ON d.id = a.id WHERE a.id='$reg_id' AND b.id='$reg_id' AND c.id='$reg_id' AND d.id='$reg_id' AND a.id LIKE '{$_SESSION['post']}%'";
    // $post_like = $_SESSION['post'] . '%';
    // $check1 = "SELECT a.id, b.id, c.id, d.id FROM prsnl a INNER JOIN exprn b ON b.id = a.id INNER JOIN edctn c ON c.id = a.id INNER JOIN othrs d ON d.id = a.id WHERE a.id = ? AND b.id = ? AND c.id = ? AND d.id = ? AND a.id LIKE ?";
    // $stmt = mysqli_prepare($link, $check1);
    // mysqli_stmt_bind_param($stmt, 'sssss', $reg_id, $reg_id, $reg_id, $reg_id, $post_like);
    // mysqli_stmt_execute($stmt);
    // $result_check1 = mysqli_stmt_get_result($stmt);
    // $check2 = " SELECT a.id, a.dob, TIMESTAMPDIFF(YEAR, STR_TO_DATE(a.dob, '%d/%m/%Y'), '2024-08-23') AS age FROM prsnl a WHERE STR_TO_DATE(a.dob, '%d/%m/%Y') IS NOT NULL AND TIMESTAMPDIFF(YEAR, STR_TO_DATE(a.dob, '%d/%m/%Y'), '2024-08-23') <= 35 AND a.id = '" . $reg_id . "' AND a.id LIKE '{$_SESSION['post']}%'";

    $post = mysqli_real_escape_string($link, $_SESSION['post']);
    $query_post_details = "SELECT age_limit, closed_date_admin FROM req_experience WHERE post = '$post' LIMIT 1";
    $result_post_details = mysqli_query($link, $query_post_details);
    $row_post_details = mysqli_fetch_assoc($result_post_details);
    $age_limit = (int)$row_post_details['age_limit'];
    $closed_date_admin = $row_post_details['closed_date_admin'];

    $check2 = "SELECT a.id, a.dob, TIMESTAMPDIFF(YEAR, STR_TO_DATE(a.dob, '%d/%m/%Y'), '$closed_date_admin') AS age FROM prsnl a WHERE STR_TO_DATE(a.dob, '%d/%m/%Y') IS NOT NULL AND TIMESTAMPDIFF(YEAR, STR_TO_DATE(a.dob, '%d/%m/%Y'), '$closed_date_admin') <= $age_limit AND a.id = '$reg_id' AND a.id LIKE '{$post}%'; ";
    // $post_like = $post . '%';
    // $check2 = "SELECT a.id, a.dob, TIMESTAMPDIFF(YEAR, STR_TO_DATE(a.dob, '%d/%m/%Y'), ?) AS age FROM prsnl a WHERE STR_TO_DATE(a.dob, '%d/%m/%Y') IS NOT NULL AND TIMESTAMPDIFF(YEAR, STR_TO_DATE(a.dob, '%d/%m/%Y'), ?) <= ? AND a.id = ? AND a.id LIKE ?";
    // $stmt2 = mysqli_prepare($link, $check2);
    // mysqli_stmt_bind_param($stmt2, 'ssiss', $closed_date_admin, $closed_date_admin, $age_limit, $reg_id, $post_like);
    // mysqli_stmt_execute($stmt2);
    // $result_check2 = mysqli_stmt_get_result($stmt2);
    // $check3 = " SELECT a.id, SUM(TIMESTAMPDIFF(MONTH, STR_TO_DATE(b.from1, '%d/%m/%Y'), STR_TO_DATE(b.to1, '%d/%m/%Y')) + TIMESTAMPDIFF(MONTH, STR_TO_DATE(b.from2, '%d/%m/%Y'), STR_TO_DATE(b.to2, '%d/%m/%Y')) + TIMESTAMPDIFF(MONTH, STR_TO_DATE(b.from3, '%d/%m/%Y'), STR_TO_DATE(b.to3, '%d/%m/%Y')) + TIMESTAMPDIFF(MONTH, STR_TO_DATE(b.from4, '%d/%m/%Y'), STR_TO_DATE(b.to4, '%d/%m/%Y')) + TIMESTAMPDIFF(MONTH, STR_TO_DATE(b.from5, '%d/%m/%Y'), STR_TO_DATE(b.to5, '%d/%m/%Y')) + TIMESTAMPDIFF(MONTH, STR_TO_DATE(b.from6, '%d/%m/%Y'), STR_TO_DATE(b.to6, '%d/%m/%Y')) + TIMESTAMPDIFF(MONTH, STR_TO_DATE(b.from7, '%d/%m/%Y'), STR_TO_DATE(b.to7, '%d/%m/%Y')) + TIMESTAMPDIFF(MONTH, STR_TO_DATE(b.from8, '%d/%m/%Y'), STR_TO_DATE(b.to8, '%d/%m/%Y')) + TIMESTAMPDIFF(MONTH, STR_TO_DATE(b.from9, '%d/%m/%Y'), STR_TO_DATE(b.to9, '%d/%m/%Y')) + TIMESTAMPDIFF(MONTH, STR_TO_DATE(b.from10, '%d/%m/%Y'), STR_TO_DATE(b.to10, '%d/%m/%Y'))) / 12 AS total_years FROM prsnl a INNER JOIN exprn b ON a.id = b.id WHERE a.id = '" . $reg_id . "' GROUP BY a.id HAVING total_years >= 1 ";

    $query_total_expr = "SELECT total_expr FROM req_experience WHERE post = '$post' LIMIT 1";
    $result_total_expr = mysqli_query($link, $query_total_expr);
    $row_total_expr = mysqli_fetch_assoc($result_total_expr);
    $required_experience = (float)$row_total_expr['total_expr'];

    $check3 = "SELECT a.id, SUM( TIMESTAMPDIFF(MONTH, STR_TO_DATE(b.from1, '%d/%m/%Y'), STR_TO_DATE(b.to1, '%d/%m/%Y')) + TIMESTAMPDIFF(MONTH, STR_TO_DATE(b.from2, '%d/%m/%Y'), STR_TO_DATE(b.to2, '%d/%m/%Y')) + TIMESTAMPDIFF(MONTH, STR_TO_DATE(b.from3, '%d/%m/%Y'), STR_TO_DATE(b.to3, '%d/%m/%Y')) + TIMESTAMPDIFF(MONTH, STR_TO_DATE(b.from4, '%d/%m/%Y'), STR_TO_DATE(b.to4, '%d/%m/%Y')) + TIMESTAMPDIFF(MONTH, STR_TO_DATE(b.from5, '%d/%m/%Y'), STR_TO_DATE(b.to5, '%d/%m/%Y')) + TIMESTAMPDIFF(MONTH, STR_TO_DATE(b.from6, '%d/%m/%Y'), STR_TO_DATE(b.to6, '%d/%m/%Y')) + TIMESTAMPDIFF(MONTH, STR_TO_DATE(b.from7, '%d/%m/%Y'), STR_TO_DATE(b.to7, '%d/%m/%Y')) + TIMESTAMPDIFF(MONTH, STR_TO_DATE(b.from8, '%d/%m/%Y'), STR_TO_DATE(b.to8, '%d/%m/%Y')) + TIMESTAMPDIFF(MONTH, STR_TO_DATE(b.from9, '%d/%m/%Y'), STR_TO_DATE(b.to9, '%d/%m/%Y')) + TIMESTAMPDIFF(MONTH, STR_TO_DATE(b.from10, '%d/%m/%Y'), STR_TO_DATE(b.to10, '%d/%m/%Y')) ) / 12 AS total_years FROM prsnl a INNER JOIN exprn b ON a.id = b.id WHERE a.id = '$reg_id' GROUP BY a.id HAVING total_years >= $required_experience";

    $result_check1 = mysqli_query($link, $check1);
    $result_check3 = mysqli_query($link, $check3);
    $result_check2 = mysqli_query($link, $check2);

    if (mysqli_num_rows($result_check1) == 0) {
        echo "false";
    } else {
        $sql = "UPDATE prsnl SET status='current' WHERE id='$reg_id'";
        $result_update2 = mysqli_query($link, $sql);

        $sql = "UPDATE othrs SET submit='Yes', submission_date = '$date' WHERE id='$reg_id'";
        $result_update3 = mysqli_query($link, $sql);

        include "get_ip.php";

        $sql_ua = "INSERT INTO history_admitcard VALUES(0,'$ua_browser','$ua_version','$ua_platform','$ua_ip','$ua_date','$ua_time','$reg_id','Submit Final Application')";
        $result_ua = mysqli_query($link, $sql_ua);

        $user = "SELECT prsnl.id, prsnl.prefix, prsnl.surname, prsnl.name, prsnl.fathername, prsnl.email, req_experience.Name, req_experience.category FROM prsnl LEFT JOIN req_experience ON req_experience.post=prsnl.post WHERE prsnl.status='current' AND prsnl.id='$reg_id'";
        $result_user = mysqli_query($link, $user);

        $_SESSION['status'] = 'current';

        if (mysqli_num_rows($result_user) == 0) {
        } else {
            while ($row = mysqli_fetch_assoc($result_user)) {
                $post_name = $row['Name'] . '(' . $row['category'] . ')';
                $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
                try {
                    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'smtp.office365.com';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = 'no-reply@mail.inflibnet.ac.in';                 // SMTP username
                    $mail->Password = 'No@gK21C!R#lyTpm';                           // SMTP password
                    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 587;                                    // TCP port to connect to
                    $mail->setFrom('no-reply@mail.inflibnet.ac.in', '');
                    $mail->addAddress($email);     // Add a recipient
                    $mail->isHTML(true);
                    $mail->Subject = "Final submission of online application for the post of $post_name";

                    $message = '<table cellpadding="10" width="100%" border="1">
                <tr>
                <td style="border:none;">
                Dear ' . $row['prefix'] . ' ' . $row['surname'] . ' ' . $row['name'] . ' ' . $row['fathername'] . ',<br/><br/>
                Your application (' . $reg_id . ') has been submitted successfully for the post of ' . $post_name . '.<br/>
                </td>
                </tr>
                <tr> <td style="border:none;"> </td> </tr>
                    <tr> <td style="border:none;"> <b>Note:</b> This is an auto generated email. In case of any technical queries please contact: recruitment[at]inflibnet[dot]ac[dot]in</td> </tr>
                 <tr>
                <td style="border:none;padding-top:25px">
                With regards,<br/>
                INFLIBNET Centre, Gandhinagar

                </td>
                </tr>
                </table>';
                    $mail->Body = $message;
                    $mail->send();
                    //$_SESSION['notification'] = "<br/><h4 style=color:green><center>Yout Application Submitted Successfully for the post of $post_name</center></h4>";
                    //header("Location: print_application.php");
                } catch (Exception $e) {
                }
            }
        }
        if ($result_update2 && $result_update3) {
            echo "true";
        } else {
            echo 'false';
        }
    }
}
