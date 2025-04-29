<?php

session_start();
if (isset($_POST['captcha_code_ex'])) {

  if ($_POST['captcha_code_ex'] != $_SESSION['code_ex']) {

    echo "false_captcha";

    exit();
  }
}

if (!isset($_SERVER['HTTP_REFERER'])) {
  header('location:./index.php');
  exit;
}
//error_reporting(E_ALL ^ E_DEPRECATED);
error_reporting(0);

include('dbConfig.php');

$reg_id = mysqli_real_escape_string($link, $_POST['app_id_expr']);
$police = mysqli_real_escape_string($link, $_POST['police']);
$grandtotal = mysqli_real_escape_string($link, $_POST['exp_count']);
$currently_working = mysqli_real_escape_string($link, $_POST['current_working'] != null ? 'Yes' : 'No');


// echo "<pre>";
// print_r($_SESSION); // Debug session data
// echo "</pre>";
// // exit;

$j = 0;
for ($i = 1; $i <= 10; $i++) {
  $org_data = 'org' . $i;
  date_default_timezone_set('Asia/Kolkata');
  $current_date = date("Y-m-d H:i:s");
  $enc_current_date = strtotime($current_date);

  if ($_POST[$org_data] != '') {
    $j++;
    $temp_filename = "exp_file" . $i;
    if ($_FILES["$temp_filename"]["name"]) {
      $expr_file_path = '';
      $form_file = $_FILES["$temp_filename"]["name"];
      $info = new SplFileInfo($form_file);
      $ext = $info->getExtension();

      $temp = explode(".", $form_file);
      $newfilename = md5($reg_id) . md5($enc_current_date) . md5($i) . '.' . $ext;

      $expr_file_path = 'uploads/expr/' . $newfilename;
      move_uploaded_file($_FILES[$temp_filename]["tmp_name"], $expr_file_path);

      $sql = "UPDATE exprn 
                       SET org" . $i . "='" . $_POST['org' . $i] . "',
                           pos" . $i . "='" . $_POST['pos' . $i] . "',
                           from" . $i . "='" . $_POST['from' . $i] . "', 
                           to" . $i . "='" . $_POST['to' . $i] . "', 
                           nature" . $i . "='" . $_POST['nature' . $i] . "',
                           pay" . $i . "='" . $_POST['pay' . $i] . "', 
                           otype" . $i . "='" . $_POST['otype' . $i] . "', 
                           exp" . $i . "='" . $_POST['exp' . $i] . "', 
                           exp_file" . $i . "='$expr_file_path',
                           total1 = '$total1', 
                           total2 = '$total2', 
                           total3 = '$total3', 
                           total4 = '$total4', 
                           total5 = '$total5', 
                           grandtotal = '$grandtotal', 
                           expr_certi = '', 
                           currently_working='$currently_working'
                     WHERE id = '$reg_id'";
    } else {
      $sql = "UPDATE exprn 
                       SET org" . $i . "='" . $_POST['org' . $i] . "',
                           pos" . $i . "='" . $_POST['pos' . $i] . "',
                           from" . $i . "='" . $_POST['from' . $i] . "', 
                           to" . $i . "='" . $_POST['to' . $i] . "', 
                           nature" . $i . "='" . $_POST['nature' . $i] . "',
                           pay" . $i . "='" . $_POST['pay' . $i] . "', 
                           otype" . $i . "='" . $_POST['otype' . $i] . "', 
                           exp" . $i . "='" . $_POST['exp' . $i] . "',
                           total1 = '$total1', 
                           total2 = '$total2', 
                           total3 = '$total3', 
                           total4 = '$total4', 
                           total5 = '$total5', 
                           grandtotal = '$grandtotal', 
                           expr_certi = '', 
                           currently_working='$currently_working'
                     WHERE id = '$reg_id'";
    }
    $result_update = mysqli_query($link, $sql);
  } else {
    break;
  }
}

$sql2 = "UPDATE othrs SET police = '$police' WHERE id = '$reg_id'";
$result_update2 = mysqli_query($link, $sql2);

// Perform age check
// $sql_age_check = "SELECT a.id, a.dob, TIMESTAMPDIFF(YEAR, STR_TO_DATE(a.dob, '%m/%d/%Y'), '2024-08-23') AS age 
//                   FROM prsnl a 
//                   WHERE STR_TO_DATE(a.dob, '%m/%d/%Y') IS NOT NULL 
//                   AND TIMESTAMPDIFF(YEAR, STR_TO_DATE(a.dob, '%m/%d/%Y'), '2024-08-23') <= 35 
//                   AND a.id = '$reg_id' 
//                   AND a.id LIKE '%2-2024%'";

// Perform age check
// $sql_age_check = "SELECT a.id, a.dob, TIMESTAMPDIFF(YEAR, STR_TO_DATE(a.dob, '%m/%d/%Y'), '2024-08-23') AS age, a.disability, a.disability_percentage FROM prsnl a WHERE STR_TO_DATE(a.dob, '%m/%d/%Y') IS NOT NULL AND ( (STR_TO_DATE(a.dob, '%m/%d/%Y') >= DATE_SUB('2024-08-23', INTERVAL 35 YEAR) AND a.disability = 'No') OR (STR_TO_DATE(a.dob, '%m/%d/%Y') >= DATE_SUB('2024-08-23', INTERVAL 45 YEAR) AND a.disability = 'Yes' AND a.disability_percentage >= 40) ) AND a.id = '$reg_id' AND a.id LIKE '%2-2024%'";

// $sql_age_check = "SELECT a.id, a.dob, TIMESTAMPDIFF(YEAR, STR_TO_DATE(a.dob, '%m/%d/%Y'), '2024-08-23') AS age, a.disability, a.disability_percentage FROM prsnl a WHERE STR_TO_DATE(a.dob, '%m/%d/%Y') IS NOT NULL AND ( a.inf_employee = 'Yes' OR ( (STR_TO_DATE(a.dob, '%m/%d/%Y') >= DATE_SUB('2024-08-23', INTERVAL 35 YEAR) AND a.disability = 'No') OR (STR_TO_DATE(a.dob, '%m/%d/%Y') >= DATE_SUB('2024-08-23', INTERVAL 45 YEAR) AND a.disability = 'Yes' AND a.disability_percentage >= 40) ) ) AND a.id = '$reg_id' AND a.id LIKE '%2-2024%'";

// Extract required values from session
$closed_date_admin = $_SESSION['closed_date_admin']; // Format: 2025-01-23 00:00:00
$post = $_SESSION['post']; // Post value from session
$job_type = $_SESSION['job_type'];

// Fetch the age limit dynamically from req_experience table
// $sql_age_check = "SELECT a.id, a.dob, TIMESTAMPDIFF(YEAR, STR_TO_DATE(a.dob, '%m/%d/%Y'), '$closed_date_admin') AS age, a.disability, a.disability_percentage FROM prsnl a WHERE STR_TO_DATE(a.dob, '%m/%d/%Y') IS NOT NULL AND (
//             a.inf_employee = 'Yes'
//             OR (
//                 (
//                     STR_TO_DATE(a.dob, '%m/%d/%Y') >= DATE_SUB('$closed_date_admin', INTERVAL (SELECT age_limit FROM req_experience WHERE post = '$post') YEAR)
//                     AND a.disability = 'No'
//                 )
//                 OR (
//                     STR_TO_DATE(a.dob, '%m/%d/%Y') >= DATE_SUB('$closed_date_admin', INTERVAL (SELECT age_limit FROM req_experience WHERE post = '$post') + 10 YEAR)
//                     AND a.disability = 'Yes'
//                     AND a.disability_percentage >= 40
//                 )
//             )
//         )
//         AND a.id = '{$_SESSION['reg_id']}'
//         AND a.post = '$post';
// ";

// $sql_age_check = "SELECT a.id, a.dob, TIMESTAMPDIFF(YEAR, STR_TO_DATE(a.dob, '%d/%m/%Y'), '$closed_date_admin') AS age, a.disability, a.disability_percentage FROM prsnl a WHERE STR_TO_DATE(a.dob, '%d/%m/%Y') IS NOT NULL AND ( a.inf_employee = 'Yes' OR ( ( STR_TO_DATE(a.dob, '%d/%m/%Y') >= DATE_SUB('$closed_date_admin', INTERVAL (SELECT age_limit FROM req_experience WHERE post = '$post') YEAR) AND a.disability = 'No' ) OR ( STR_TO_DATE(a.dob, '%d/%m/%Y') >= DATE_SUB('$closed_date_admin', INTERVAL (SELECT age_limit FROM req_experience WHERE post = '$post') + 10 YEAR) AND a.disability = 'Yes' AND a.disability_percentage >= 40 ) ) ) AND a.id = '{$_SESSION['reg_id']}' AND a.post = '$post';";

// $sql_age_check = "SELECT a.id, a.dob, TIMESTAMPDIFF(YEAR, STR_TO_DATE(a.dob, '%m/%d/%Y'), '$closed_date_admin') AS age, a.disability, a.disability_percentage FROM prsnl a WHERE STR_TO_DATE(a.dob, '%m/%d/%Y') IS NOT NULL AND ( a.inf_employee = 'Yes' OR ( ( STR_TO_DATE(a.dob, '%m/%d/%Y') >= DATE_SUB('$closed_date_admin', INTERVAL (SELECT age_limit FROM req_experience WHERE post = '$post') + CASE WHEN '$job_type' = 'Permanent' THEN 5 ELSE 0 END YEAR) AND a.disability = 'No' ) OR ( STR_TO_DATE(a.dob, '%m/%d/%Y') >= DATE_SUB('$closed_date_admin', INTERVAL (SELECT age_limit FROM req_experience WHERE post = '$post') + 10 YEAR) AND a.disability = 'Yes' AND a.disability_percentage >= 40 ) ) ) AND a.id = '{$_SESSION['reg_id']}' AND a.post = '$post';";

$sql_age_check = "
    SELECT
        a.id,
        a.dob,
        TIMESTAMPDIFF(YEAR, STR_TO_DATE(a.dob, '%m/%d/%Y'), '$closed_date_admin') AS age,
        a.disability,
        a.disability_percentage,
        a.type_of_job -- Ensures we're fetching this for the CASE condition
    FROM
        prsnl a
    WHERE
        STR_TO_DATE(a.dob, '%m/%d/%Y') IS NOT NULL
        AND (
            a.inf_employee = 'Yes'
            OR (
                ( STR_TO_DATE(a.dob, '%m/%d/%Y') >= DATE_SUB('$closed_date_admin', INTERVAL (SELECT age_limit FROM req_experience WHERE post = '$post') + CASE WHEN a.type_of_job = 'Permanent' THEN 5 ELSE 0 END YEAR)
                  AND a.disability = 'No'
                )
                OR ( STR_TO_DATE(a.dob, '%m/%d/%Y') >= DATE_SUB('$closed_date_admin', INTERVAL (SELECT age_limit FROM req_experience WHERE post = '$post') + 10 YEAR)
                     AND a.disability = 'Yes'
                     AND a.disability_percentage >= 40
                )
            )
        )
        AND a.id = '{$_SESSION['reg_id']}'
        AND a.post = '$post';
";


$result_age_check = mysqli_query($link, $sql_age_check);

if (mysqli_num_rows($result_age_check) > 0) {
  // Perform experience check
  // $sql_experience_check = "SELECT id,
  //                                  SUM( IF(from1 != '' AND to1 != '', TIMESTAMPDIFF(MONTH, STR_TO_DATE(from1, '%d/%m/%Y'), STR_TO_DATE(to1, '%d/%m/%Y')), 0) +
  //                                       IF(from2 != '' AND to2 != '', TIMESTAMPDIFF(MONTH, STR_TO_DATE(from2, '%d/%m/%Y'), STR_TO_DATE(to2, '%d/%m/%Y')), 0) +
  //                                       IF(from3 != '' AND to3 != '', TIMESTAMPDIFF(MONTH, STR_TO_DATE(from3, '%d/%m/%Y'), STR_TO_DATE(to3, '%d/%m/%Y')), 0) +
  //                                       IF(from4 != '' AND to4 != '', TIMESTAMPDIFF(MONTH, STR_TO_DATE(from4, '%d/%m/%Y'), STR_TO_DATE(to4, '%d/%m/%Y')), 0) +
  //                                       IF(from5 != '' AND to5 != '', TIMESTAMPDIFF(MONTH, STR_TO_DATE(from5, '%d/%m/%Y'), STR_TO_DATE(to5, '%d/%m/%Y')), 0) +
  //                                       IF(from6 != '' AND to6 != '', TIMESTAMPDIFF(MONTH, STR_TO_DATE(from6, '%d/%m/%Y'), STR_TO_DATE(to6, '%d/%m/%Y')), 0) +
  //                                       IF(from7 != '' AND to7 != '', TIMESTAMPDIFF(MONTH, STR_TO_DATE(from7, '%d/%m/%Y'), STR_TO_DATE(to7, '%d/%m/%Y')), 0) +
  //                                       IF(from8 != '' AND to8 != '', TIMESTAMPDIFF(MONTH, STR_TO_DATE(from8, '%d/%m/%Y'), STR_TO_DATE(to8, '%d/%m/%Y')), 0) +
  //                                       IF(from9 != '' AND to9 != '', TIMESTAMPDIFF(MONTH, STR_TO_DATE(from9, '%d/%m/%Y'), STR_TO_DATE(to9, '%d/%m/%Y')), 0) +
  //                                       IF(from10 != '' AND to10 != '', TIMESTAMPDIFF(MONTH, STR_TO_DATE(from10, '%d/%m/%Y'), STR_TO_DATE(to10, '%d/%m/%Y')), 0)
  //                                     ) / 12 AS total_years,
  //                                  exp1, exp_file1, exp2, exp_file2, exp3, exp_file3, exp4, exp_file4, exp5, exp_file5,
  //                                  exp6, exp_file6, exp7, exp_file7, exp8, exp_file8, exp9, exp_file9, exp10, exp_file10
  //                             FROM exprn
  //                            WHERE id = '$reg_id'
  //                            HAVING total_years >= 1
  //                               AND ((exp1 IS NOT NULL AND exp_file1 IS NOT NULL) OR
  //                                    (exp2 IS NOT NULL AND exp_file2 IS NOT NULL) OR
  //                                    (exp3 IS NOT NULL AND exp_file3 IS NOT NULL) OR
  //                                    (exp4 IS NOT NULL AND exp_file4 IS NOT NULL) OR
  //                                    (exp5 IS NOT NULL AND exp_file5 IS NOT NULL) OR
  //                                    (exp6 IS NOT NULL AND exp_file6 IS NOT NULL) OR
  //                                    (exp7 IS NOT NULL AND exp_file7 IS NOT NULL) OR
  //                                    (exp8 IS NOT NULL AND exp_file8 IS NOT NULL) OR
  //                                    (exp9 IS NOT NULL AND exp_file9 IS NOT NULL) OR
  //                                    (exp10 IS NOT NULL AND exp_file10 IS NOT NULL))";
  // $result_experience_check = mysqli_query($link, $sql_experience_check);

  $sql_experience_check = "
    SELECT
        e.id,
        SUM(
            IF(from1 != '' AND to1 != '', TIMESTAMPDIFF(MONTH, STR_TO_DATE(from1, '%d/%m/%Y'), STR_TO_DATE(to1, '%d/%m/%Y')), 0) +
            IF(from2 != '' AND to2 != '', TIMESTAMPDIFF(MONTH, STR_TO_DATE(from2, '%d/%m/%Y'), STR_TO_DATE(to2, '%d/%m/%Y')), 0) +
            IF(from3 != '' AND to3 != '', TIMESTAMPDIFF(MONTH, STR_TO_DATE(from3, '%d/%m/%Y'), STR_TO_DATE(to3, '%d/%m/%Y')), 0) +
            IF(from4 != '' AND to4 != '', TIMESTAMPDIFF(MONTH, STR_TO_DATE(from4, '%d/%m/%Y'), STR_TO_DATE(to4, '%d/%m/%Y')), 0) +
            IF(from5 != '' AND to5 != '', TIMESTAMPDIFF(MONTH, STR_TO_DATE(from5, '%d/%m/%Y'), STR_TO_DATE(to5, '%d/%m/%Y')), 0) +
            IF(from6 != '' AND to6 != '', TIMESTAMPDIFF(MONTH, STR_TO_DATE(from6, '%d/%m/%Y'), STR_TO_DATE(to6, '%d/%m/%Y')), 0) +
            IF(from7 != '' AND to7 != '', TIMESTAMPDIFF(MONTH, STR_TO_DATE(from7, '%d/%m/%Y'), STR_TO_DATE(to7, '%d/%m/%Y')), 0) +
            IF(from8 != '' AND to8 != '', TIMESTAMPDIFF(MONTH, STR_TO_DATE(from8, '%d/%m/%Y'), STR_TO_DATE(to8, '%d/%m/%Y')), 0) +
            IF(from9 != '' AND to9 != '', TIMESTAMPDIFF(MONTH, STR_TO_DATE(from9, '%d/%m/%Y'), STR_TO_DATE(to9, '%d/%m/%Y')), 0) +
            IF(from10 != '' AND to10 != '', TIMESTAMPDIFF(MONTH, STR_TO_DATE(from10, '%d/%m/%Y'), STR_TO_DATE(to10, '%d/%m/%Y')), 0)
        ) / 12 AS total_years,
        (SELECT total_expr FROM req_experience WHERE post = '{$_SESSION['post']}') AS required_expr,
        exp1, exp_file1, exp2, exp_file2, exp3, exp_file3, exp4, exp_file4, exp5, exp_file5,
        exp6, exp_file6, exp7, exp_file7, exp8, exp_file8, exp9, exp_file9, exp10, exp_file10
    FROM
        exprn e
    WHERE
        e.id = '$reg_id'
    HAVING
        total_years >= CAST(required_expr AS UNSIGNED)
        AND (
            (exp1 IS NOT NULL AND exp_file1 IS NOT NULL) OR
            (exp2 IS NOT NULL AND exp_file2 IS NOT NULL) OR
            (exp3 IS NOT NULL AND exp_file3 IS NOT NULL) OR
            (exp4 IS NOT NULL AND exp_file4 IS NOT NULL) OR
            (exp5 IS NOT NULL AND exp_file5 IS NOT NULL) OR
            (exp6 IS NOT NULL AND exp_file6 IS NOT NULL) OR
            (exp7 IS NOT NULL AND exp_file7 IS NOT NULL) OR
            (exp8 IS NOT NULL AND exp_file8 IS NOT NULL) OR
            (exp9 IS NOT NULL AND exp_file9 IS NOT NULL) OR
            (exp10 IS NOT NULL AND exp_file10 IS NOT NULL)
        )";
  $result_experience_check = mysqli_query($link, $sql_experience_check);

  if (mysqli_num_rows($result_experience_check) > 0) {
    // Set session variables and redirect only if both checks pass
    $sql = "SELECT * 
                  FROM exprn 
                  JOIN othrs ON exprn.id = othrs.id 
                 WHERE exprn.id = '$reg_id'";
    $result = mysqli_query($link, $sql);
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        session_start();
        $_SESSION['org1'] = $row['org1'];
        $_SESSION['org2'] = $row['org2'];
        $_SESSION['org3'] = $row['org3'];
        $_SESSION['org4'] = $row['org4'];
        $_SESSION['org5'] = $row['org5'];
        $_SESSION['org6'] = $row['org6'];
        $_SESSION['org7'] = $row['org7'];
        $_SESSION['org8'] = $row['org8'];
        $_SESSION['org9'] = $row['org9'];
        $_SESSION['org10'] = $row['org10'];

        $_SESSION['pos1'] = $row['pos1'];
        $_SESSION['pos2'] = $row['pos2'];
        $_SESSION['pos3'] = $row['pos3'];
        $_SESSION['pos4'] = $row['pos4'];
        $_SESSION['pos5'] = $row['pos5'];
        $_SESSION['pos6'] = $row['pos6'];
        $_SESSION['pos7'] = $row['pos7'];
        $_SESSION['pos8'] = $row['pos8'];
        $_SESSION['pos9'] = $row['pos9'];
        $_SESSION['pos10'] = $row['pos10'];

        $_SESSION['from1'] = $row['from1'];
        $_SESSION['from2'] = $row['from2'];
        $_SESSION['from3'] = $row['from3'];
        $_SESSION['from4'] = $row['from4'];
        $_SESSION['from5'] = $row['from5'];
        $_SESSION['from6'] = $row['from6'];
        $_SESSION['from7'] = $row['from7'];
        $_SESSION['from8'] = $row['from8'];
        $_SESSION['from9'] = $row['from9'];
        $_SESSION['from10'] = $row['from10'];

        $_SESSION['to1'] = $row['to1'];
        $_SESSION['to2'] = $row['to2'];
        $_SESSION['to3'] = $row['to3'];
        $_SESSION['to4'] = $row['to4'];
        $_SESSION['to5'] = $row['to5'];
        $_SESSION['to6'] = $row['to6'];
        $_SESSION['to7'] = $row['to7'];
        $_SESSION['to8'] = $row['to8'];
        $_SESSION['to9'] = $row['to9'];
        $_SESSION['to10'] = $row['to10'];

        $_SESSION['nature1'] = $row['nature1'];
        $_SESSION['nature2'] = $row['nature2'];
        $_SESSION['nature3'] = $row['nature3'];
        $_SESSION['nature4'] = $row['nature4'];
        $_SESSION['nature5'] = $row['nature5'];
        $_SESSION['nature6'] = $row['nature6'];
        $_SESSION['nature7'] = $row['nature7'];
        $_SESSION['nature8'] = $row['nature8'];
        $_SESSION['nature9'] = $row['nature9'];
        $_SESSION['nature10'] = $row['nature10'];

        $_SESSION['pay1'] = $row['pay1'];
        $_SESSION['pay2'] = $row['pay2'];
        $_SESSION['pay3'] = $row['pay3'];
        $_SESSION['pay4'] = $row['pay4'];
        $_SESSION['pay5'] = $row['pay5'];
        $_SESSION['pay6'] = $row['pay6'];
        $_SESSION['pay7'] = $row['pay7'];
        $_SESSION['pay8'] = $row['pay8'];
        $_SESSION['pay9'] = $row['pay9'];
        $_SESSION['pay10'] = $row['pay10'];

        $_SESSION['otype1'] = $row['otype1'];
        $_SESSION['otype2'] = $row['otype2'];
        $_SESSION['otype3'] = $row['otype3'];
        $_SESSION['otype4'] = $row['otype4'];
        $_SESSION['otype5'] = $row['otype5'];
        $_SESSION['otype6'] = $row['otype6'];
        $_SESSION['otype7'] = $row['otype7'];
        $_SESSION['otype8'] = $row['otype8'];
        $_SESSION['otype9'] = $row['otype9'];
        $_SESSION['otype10'] = $row['otype10'];

        $_SESSION['exp1'] = $row['exp1'];
        $_SESSION['exp2'] = $row['exp2'];
        $_SESSION['exp3'] = $row['exp3'];
        $_SESSION['exp4'] = $row['exp4'];
        $_SESSION['exp5'] = $row['exp5'];
        $_SESSION['exp6'] = $row['exp6'];
        $_SESSION['exp7'] = $row['exp7'];
        $_SESSION['exp8'] = $row['exp8'];
        $_SESSION['exp9'] = $row['exp9'];
        $_SESSION['exp10'] = $row['exp10'];

        $_SESSION['exp_file1'] = $row['exp_file1'];
        $_SESSION['exp_file2'] = $row['exp_file2'];
        $_SESSION['exp_file3'] = $row['exp_file3'];
        $_SESSION['exp_file4'] = $row['exp_file4'];
        $_SESSION['exp_file5'] = $row['exp_file5'];
        $_SESSION['exp_file6'] = $row['exp_file6'];
        $_SESSION['exp_file7'] = $row['exp_file7'];
        $_SESSION['exp_file8'] = $row['exp_file8'];
        $_SESSION['exp_file9'] = $row['exp_file9'];
        $_SESSION['exp_file10'] = $row['exp_file10'];

        $_SESSION['total1'] = $row['total1'];
        $_SESSION['total2'] = $row['total2'];
        $_SESSION['total3'] = $row['total3'];
        $_SESSION['total4'] = $row['total4'];
        $_SESSION['total5'] = $row['total5'];

        $_SESSION['expr_certi'] = $row['expr_certi'];
        $_SESSION['grandtotal'] = $row['grandtotal'];
        $_SESSION['police'] = $row['police'];
        $_SESSION['currently_working'] = $row['currently_working'];

        echo json_encode(['status' => 'success']);
      }
    }
  } else {
    echo json_encode(['status' => 'experience_fail']);
  }
} else {

  echo json_encode(['status' => 'age_fail']);
}
