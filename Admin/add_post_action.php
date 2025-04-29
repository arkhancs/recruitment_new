<?php
session_start();
//error_reporting(E_ALL ^ E_NOTICE);
if (isset($_POST['submit'])) {
    include_once '../dbConfig.php';
    include "../get_ip.php";

    $user_id = $_SESSION['user'];

    $id = mysqli_real_escape_string($link, $_POST["id"]);
    $job_type = mysqli_real_escape_string($link, $_POST["job_type"]);
    $post_name = mysqli_real_escape_string($link, $_POST["post_name"]);
    $job_location = mysqli_real_escape_string($link, $_POST["job_location"]);
    $project = mysqli_real_escape_string($link, $_POST["project"]);
    $post_id = mysqli_real_escape_string($link, $_POST["postid"]);
    $category = mysqli_real_escape_string($link, $_POST["category"]);
    $year = mysqli_real_escape_string($link, $_POST["year"]);
    $sequence = mysqli_real_escape_string($link, $_POST["sequence"]);
    $status = mysqli_real_escape_string($link, $_POST["status"]);
    $post = mysqli_real_escape_string($link, $_POST["post"]);
    $experience_for_bachelor = mysqli_real_escape_string($link, $_POST["experience_for_bachelor"]);
    $experience_for_master = mysqli_real_escape_string($link, $_POST["experience_for_master"]);
    $experience_for_phd = mysqli_real_escape_string($link, $_POST["experience_for_phd"]);
    //$total_expr = mysqli_real_escape_string($link, $_POST["experiance"]);
    $total_expr = '';
    $bachelor_req = mysqli_real_escape_string($link, $_POST["brequired"]);
    $master_req = mysqli_real_escape_string($link, $_POST["mrequired"]);
    $phd_req = mysqli_real_escape_string($link, $_POST["prequired"]);
    $open_date = mysqli_real_escape_string($link, $_POST["open_date"]);
    $closed_date = mysqli_real_escape_string($link, $_POST["closed_date"]);
    $age_limit = mysqli_real_escape_string($link, $_POST["age_limit"]);
    $caste = mysqli_real_escape_string($link, $_POST["caste"]);
    $advertisement_title = mysqli_real_escape_string($link, $_POST["advertisement_title"]);
    $advertisement_url = mysqli_real_escape_string($link, $_POST["advertisement_url"]);

    // Convert date format from dd/mm/yyyy hh:mm:ss to yyyy-mm-dd hh:mm:ss for admin columns
    $open_date_admin = date("Y-m-d H:i:s", strtotime(str_replace('/', '-', $open_date)));
    $closed_date_admin = date("Y-m-d H:i:s", strtotime(str_replace('/', '-', $closed_date)));

    if ($open_date_admin == '1970-01-01 00:00:00' || $closed_date_admin == '1970-01-01 00:00:00') {
        // Handle invalid date format
        $errors[] = '<div class="text-center alert alert-danger">Invalid date format. Please use dd/mm/yyyy hh:mm:ss format.</div>';
        $_SESSION['errors'] = $errors;
        header("Location: add_post.php");
        exit();
    }

    $sql_check = "SELECT post FROM req_experience where post='$post' and job_location='$job_location'";
    $result_check = mysqli_query($link, $sql_check);

    if (mysqli_num_rows($result_check) == 0) {
        if ($id == '') {
            $sql = "INSERT INTO req_experience (job_type, name, job_location, project, post_id, category, year, sequence, status, post, experience_for_bachelor, experience_for_master, experience_for_phd, total_expr, bachelor_req, master_req, phd_req, open_date, closed_date, age_limit, caste_category, open_date_admin, closed_date_admin, advertisement_title, advertisement_url)"
                . "VALUES ('$job_type', '$post_name', '$job_location', '$project', '$post_id', '$category', '$year','$sequence', '$status', '$post','$experience_for_bachelor','$experience_for_master','$experience_for_phd', '$total_expr', '$bachelor_req', '$master_req', '$phd_req', '$open_date', '$closed_date', '$age_limit','$caste', '$open_date_admin', '$closed_date_admin', '$advertisement_title', '$advertisement_url')";

            $sql_ua = "insert into history_admin VALUES(0,'$ua_browser','$ua_version','$ua_platform','$ua_ip','$ua_date','$ua_time','$user_id','$id','Insert new Post')";
            $result_ua = mysqli_query($link, $sql_ua);

            if ($result = mysqli_query($link, $sql) !== TRUE) {
                $errors[] = '<div class="text-center alert alert-danger">Something went wrong while inserting records, Please try again later.</div>';
            } else {
                $errors[] = '<div class="text-center alert alert-success">Post inserted successfully.</div>';
            }
        }
    } else if (mysqli_num_rows($result_check) != 0) {
        if ($id != '') {
            $sql = "update req_experience set job_type='$job_type', name='$post_name', job_location='$job_location', project='$project', post_id='$post_id', category='$category', year='$year', sequence='$sequence', status='$status', post='$post', total_expr='$total_expr', experience_for_bachelor='$experience_for_bachelor', experience_for_master='$experience_for_master', experience_for_phd='$experience_for_phd', bachelor_req='$bachelor_req', master_req='$master_req', phd_req='$phd_req', open_date='$open_date', closed_date='$closed_date', age_limit='$age_limit', caste_category='$caste', open_date_admin='$open_date_admin', closed_date_admin='$closed_date_admin', advertisement_title='$advertisement_title', advertisement_url='$advertisement_url' where id='$id'";

            $sql_ua = "insert into history_admin VALUES(0,'$ua_browser','$ua_version','$ua_platform','$ua_ip','$ua_date','$ua_time','$user_id','$id','Update Existing Post')";
            $result_ua = mysqli_query($link, $sql_ua);

            if ($result = mysqli_query($link, $sql) !== TRUE) {
                $errors[] = '<div class="text-center alert alert-danger">Something went wrong while updating records, Please try again later.</div>';
            } else {
                $errors[] = '<div class="text-center alert alert-success">Post Updated successfully.</div>';
            }
        }
    } else {
        $errors[] = '<div class="text-center alert alert-danger">This Post already inserted.</div>';
    }

    $_SESSION['errors'] = $errors;
    header("Location: add_post.php");
}
