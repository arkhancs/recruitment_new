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

    // ========== Custom Validation: checkFinal ==========
    // $checkFinal = "SELECT a.photo, a.serving, a.type_of_service, a.authority, a.category, a.caste_certi, a.caste_certino, a.caste_certi_issue_year, b.ref1, b.ref2, b.sign, b.dob_proof, b.apars_doc FROM prsnl a INNER JOIN othrs b ON a.id = b.id WHERE a.id = '$reg_id' LIMIT 1";

    // $result_checkFinal = mysqli_query($link, $checkFinal);
    // if (mysqli_num_rows($result_checkFinal) > 0) {
    //     $rowFinal = mysqli_fetch_assoc($result_checkFinal);

    //     // Photo check
    //     if (empty($rowFinal['photo'])) {
    //         echo json_encode(['status' => 'error', 'message' => 'Photo is required.']);
    //         exit;
    //     }

    //     // Serving checks
    //     if ($rowFinal['serving'] === 'Yes') {
    //         if (empty($rowFinal['type_of_service']) || empty($rowFinal['authority'])) {
    //             echo json_encode(['status' => 'error', 'message' => 'Type of service and Authority are required when Serving = Yes.']);
    //             exit;
    //         }
    //     } elseif ($rowFinal['serving'] === 'No') {
    //         if (!empty($rowFinal['type_of_service']) || !empty($rowFinal['authority'])) {
    //             echo json_encode(['status' => 'error', 'message' => 'Type of service and Authority must be empty when Serving = No.']);
    //             exit;
    //         }
    //     }

    //     // Ref1 and Ref2 check
    //     if (empty(trim($rowFinal['ref1'])) || empty(trim($rowFinal['ref2']))) {
    //         echo json_encode(['status' => 'error', 'message' => 'Reference 1 and 2 must not be empty.']);
    //         exit;
    //     }

    //     // Sign check
    //     if (empty($rowFinal['sign'])) {
    //         echo json_encode(['status' => 'error', 'message' => 'Signature document is required.']);
    //         exit;
    //     }

    //     // DOB proof check
    //     if (empty($rowFinal['dob_proof'])) {
    //         echo json_encode(['status' => 'error', 'message' => 'Date of Birth proof is required.']);
    //         exit;
    //     }

    //     // APARs check for SELS-2-2025
    //     if ($_SESSION['post'] === 'SELS-2-2025' && empty($rowFinal['apars_doc'])) {
    //         echo json_encode(['status' => 'error', 'message' => 'APARs document is required for SELS-2-2025 post.']);
    //         exit;
    //     }

    //     // Category-wise caste certificate check
    //     if (strtoupper(trim($rowFinal['category'])) !== 'GENERAL') {
    //         if (
    //             empty($rowFinal['caste_certi']) ||
    //             empty($rowFinal['caste_certino']) ||
    //             empty($rowFinal['caste_certi_issue_year'])
    //         ) {
    //             echo json_encode(['status' => 'error', 'message' => 'Caste certificate details are required for non-GENERAL category.']);
    //             exit;
    //         }
    //     }
    // } else {
    //     echo json_encode(['status' => 'error', 'message' => 'Unable to fetch final validation details.']);
    //     exit;
    // }
    // ========== End of checkFinal ==========





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
                $mail = new PHPMailer(true);
                try {
                    $mail->SMTPDebug = 0;
                    $mail->isSMTP();

                    // ========== ZEPTOMAIL CONFIGURATION ==========
                    $mail->Host = 'smtp.zeptomail.in';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'emailapikey';
                    $mail->Password = 'Zoho-enczapikey PHtE6r0EQuHrjzF98EQF7P+8HsGkMIp79eIyKgQWsIcRCqMHHU0Dqt4plWS/+Rp5BqYQF/Oewdps5+jJ4b+AIWfrN2ZPCWqyqK3sx/VYSPOZsbq6x00bsV4dfkbaXYHrc9Zo0iHRu9jSNA==';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;
                    $mail->setFrom('noreply@mail.inflibnet.ac.in', 'INFLIBNET Centre');
                    // ==============================================

                    $mail->addAddress($email);
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
                } catch (Exception $e) {
                    // Optionally log: error_log($e->getMessage());
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
