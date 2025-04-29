
<?php

if (!isset($_SERVER['HTTP_REFERER'])) {
    header('location:./index.php');
    exit;
}
error_reporting(0);
require_once('dbConfig.php'); //$post="PALS-1-2018";
if (isset($_POST['post'])) {
    $post = mysqli_real_escape_string($link, $_POST['post']);
    $reg_id = mysqli_real_escape_string($link, $_POST['app_id']);
    $edu4 = mysqli_real_escape_string($link, $_POST['edu4']);

    $query_edu = "select prsnl.post ,edctn.edu3, edctn.edu4, edctn.edu5 from prsnl left join edctn on edctn.id=prsnl.id where prsnl.id ='$reg_id' and prsnl.post='$post'";
    $result_edu = mysqli_query($link, $query_edu);

    if (mysqli_num_rows($result_edu) > 0) {
        while ($row_edu = mysqli_fetch_assoc($result_edu)) {
            //   Check Bachelor/UG Experience 
            if ($row_edu['edu3'] != '' && $row_edu['edu4'] == '' && $row_edu['edu5'] == '') {
                if ($row_edu['post'] == 'STALS-1-2023' || $row_edu['post'] == 'STACS-1-2023' || $row_edu['post'] == 'PSAdmin-2-2023') {
                    $query = "select Name,post_id,category,sequence,year,total_expr, experience_for_bachelor as experience from req_experience where post='" . $post . "'";
                } else {
                    $query = "select Name,post_id,category,sequence,year,total_expr as experience  from req_experience where post='" . $post . "'";
                }
                //   Check Master/PG Experience 
                // } else if ($row_edu['edu3'] != '' && $row_edu['edu4'] != '' && $row_edu['edu5'] == '') {
            } else if ($row_edu['edu3'] != '' && $row_edu['edu4'] != '') {
                if ($row_edu['post'] == 'AOAdmin-1-2023' || $row_edu['post'] == 'AOFAdmin-1-2023' || $row_edu['post'] == 'SCLS-1-2024' || $row_edu['post'] == 'SBLS-2-2024') {
                    $query = "select Name,post_id,category,sequence,year,total_expr, experience_for_master as experience from req_experience where post='" . $post . "'";
                    //                    if ($row_edu['post'] == 'SCCS-1-2022' && $edu4 == "MCA") {
                    //                        $query = "select Name,post_id,category,sequence,year,total_expr, experience_for_bachelor as experience from req_experience where post='" . $post . "'";
                    //                    } else {
                    //                        $query = "select Name,post_id,category,sequence,year,total_expr, experience_for_master as experience from req_experience where post='" . $post . "'";
                    //                    }
                } else {
                    $query = "select Name,post_id,category,sequence,year,total_expr as experience  from req_experience where post='" . $post . "'";
                }
                // Check Ph.D Experience
            } else if ($row_edu['edu3'] != '' && $row_edu['edu4'] != '' && $row_edu['edu5'] != '') {
                if ($row_edu['post'] == 'SCCS-1-2022' || $row_edu['post'] == 'SCLS-1-2024') {
                    $query = "select Name,post_id,category,sequence,year,total_expr, experience_for_phd as experience from req_experience where post='" . $post . "'";
                } else {
                    $query = "select Name,post_id,category,sequence,year,total_expr as experience from req_experience where post='" . $post . "'";
                }
                // Check Diploma Experience
            } else if ($row_edu['edu7'] != '' && $row_edu['edu3'] == '' && $row_edu['edu4'] == '' && $row_edu['edu5'] == '') {
                $query = "select Name,post_id,category,sequence,year,total_expr, experience_for_bachelor as experience from req_experience where post='" . $post . "'";
            } else {
                $query = "select Name,post_id,category,sequence,year,total_expr as experience from req_experience where post='" . $post . "'";
            }
            $result = mysqli_query($link, $query);
            $data = array();
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row['category'] == "Finance") {
                        $post_category = "Admin";
                    } else {
                        $post_category = $row['category'];
                    }
                    $string = $row['post_id'] . $post_category . '-' . $row['sequence'] . '-' . $row['year'];
                    if ($string == $post) {
                        //$data=array('total_expr'=>$row['total_expr'],'post_Name'=>$row['Name']);
                        $data['total_expr'] = $row['total_expr'];
                        $data['post'] = $row['Name'];
                        $data['category'] = $row['category'];
                        $data['experience'] = $row['experience'];
                    } else {
                        // echo json_encode($row['total_expr']);
                    }
                }
            }
            echo json_encode($data);
        }
    }
}
?>