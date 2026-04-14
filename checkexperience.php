
<?php

// if (!isset($_SERVER['HTTP_REFERER'])) {
//     header('location:./index.php');
//     exit;
// }
// error_reporting(0);
// require_once('dbConfig.php'); //$post="PALS-1-2018";
// if (isset($_POST['post'])) {
//     $post = mysqli_real_escape_string($link, $_POST['post']);
//     $reg_id = mysqli_real_escape_string($link, $_POST['app_id']);
//     $edu4 = mysqli_real_escape_string($link, $_POST['edu4']);

//     $query_edu = "select prsnl.post ,edctn.edu3, edctn.edu4, edctn.edu5 from prsnl left join edctn on edctn.id=prsnl.id where prsnl.id ='$reg_id' and prsnl.post='$post'";
//     $result_edu = mysqli_query($link, $query_edu);

//     if (mysqli_num_rows($result_edu) > 0) {
//         while ($row_edu = mysqli_fetch_assoc($result_edu)) {
//             //   Check Bachelor/UG Experience
//             if ($row_edu['edu3'] != '' && $row_edu['edu4'] == '' && $row_edu['edu5'] == '') {
//                 if ($row_edu['post'] == 'STALS-1-2023' || $row_edu['post'] == 'STACS-1-2023' || $row_edu['post'] == 'PSAdmin-2-2023') {
//                     $query = "select Name,post_id,category,sequence,year,total_expr, experience_for_bachelor as experience from req_experience where post='" . $post . "'";
//                 } else {
//                     $query = "select Name,post_id,category,sequence,year,total_expr as experience  from req_experience where post='" . $post . "'";
//                 }
//                 //   Check Master/PG Experience
//                 // } else if ($row_edu['edu3'] != '' && $row_edu['edu4'] != '' && $row_edu['edu5'] == '') {
//             } else if ($row_edu['edu3'] != '' && $row_edu['edu4'] != '') {
//                 if ($row_edu['post'] == 'AOAdmin-1-2023' || $row_edu['post'] == 'AOFAdmin-1-2023' || $row_edu['post'] == 'SCLS-1-2024' || $row_edu['post'] == 'SBLS-2-2024') {
//                     $query = "select Name,post_id,category,sequence,year,total_expr, experience_for_master as experience from req_experience where post='" . $post . "'";
//                     if ($row_edu['post'] == 'SCCS-1-2022' && $edu4 == "MCA") {
//                         $query = "select Name,post_id,category,sequence,year,total_expr, experience_for_bachelor as experience from req_experience where post='" . $post . "'";
//                     } else {
//                         $query = "select Name,post_id,category,sequence,year,total_expr, experience_for_master as experience from req_experience where post='" . $post . "'";
//                     }
//                 } else {
//                     $query = "select Name,post_id,category,sequence,year,total_expr as experience  from req_experience where post='" . $post . "'";
//                 }
//                 // Check Ph.D Experience
//             } else if ($row_edu['edu3'] != '' && $row_edu['edu4'] != '' && $row_edu['edu5'] != '') {
//                 if ($row_edu['post'] == 'SCCS-1-2022' || $row_edu['post'] == 'SCLS-1-2024') {
//                     $query = "select Name,post_id,category,sequence,year,total_expr, experience_for_phd as experience from req_experience where post='" . $post . "'";
//                 } else {
//                     $query = "select Name,post_id,category,sequence,year,total_expr as experience from req_experience where post='" . $post . "'";
//                 }
//                 // Check Diploma Experience
//             } else if ($row_edu['edu7'] != '' && $row_edu['edu3'] == '' && $row_edu['edu4'] == '' && $row_edu['edu5'] == '') {
//                 $query = "select Name,post_id,category,sequence,year,total_expr, experience_for_bachelor as experience from req_experience where post='" . $post . "'";
//             } else {
//                 $query = "select Name,post_id,category,sequence,year,total_expr as experience from req_experience where post='" . $post . "'";
//             }
//             $result = mysqli_query($link, $query);
//             $data = array();
//             if (mysqli_num_rows($result) > 0) {
//                 while ($row = mysqli_fetch_assoc($result)) {
//                     if ($row['category'] == "Finance") {
//                         $post_category = "Admin";
//                     } else {
//                         $post_category = $row['category'];
//                     }
//                     $string = $row['post_id'] . $post_category . '-' . $row['sequence'] . '-' . $row['year'];
//                     if ($string == $post) {
//                         //$data=array('total_expr'=>$row['total_expr'],'post_Name'=>$row['Name']);
//                         $data['total_expr'] = $row['total_expr'];
//                         $data['post'] = $row['Name'];
//                         $data['category'] = $row['category'];
//                         $data['experience'] = $row['experience'];
//                     } else {
//                         // echo json_encode($row['total_expr']);
//                     }
//                 }
//             }
//             echo json_encode($data);
//         }
//     }
// }
?>

<?php

// if (!isset($_SERVER['HTTP_REFERER'])) {
//     header('location:./index.php');
//     exit;
// }
// error_reporting(0);
// require_once('dbConfig.php');

// if (isset($_POST['post'])) {
//     $post = mysqli_real_escape_string($link, $_POST['post']);
//     $reg_id = mysqli_real_escape_string($link, $_POST['app_id']);
//     $edu4 = mysqli_real_escape_string($link, $_POST['edu4']);

//     // Fetch applicant's education and post info
//     $query_edu = "SELECT prsnl.post, edctn.edu3, edctn.edu4, edctn.edu5, edctn.edu7
//                   FROM prsnl
//                   LEFT JOIN edctn ON edctn.id = prsnl.id
//                   WHERE prsnl.id = '$reg_id' AND prsnl.post = '$post'";
//     $result_edu = mysqli_query($link, $query_edu);

//     if (mysqli_num_rows($result_edu) > 0) {
//         while ($row_edu = mysqli_fetch_assoc($result_edu)) {

//             // Map of special posts and their required experience field
//             $experienceFieldMap = [
//                 'STALS-1-2023' => 'experience_for_bachelor',
//                 'STACS-1-2023' => 'experience_for_bachelor',
//                 'PSAdmin-2-2023' => 'experience_for_bachelor',
//                 'AOAdmin-1-2023' => 'experience_for_master',
//                 'AOFAdmin-1-2023' => 'experience_for_master',
//                 'SCLS-1-2024' => 'experience_for_master',
//                 'SBLS-2-2024' => 'experience_for_master',
//                 'SCCS-1-2022' => 'experience_for_phd',
//                 'SELS-2-2025' => 'experience_for_phd',
//                 'SDCS-2-2025' => 'experience_for_phd', // Will adjust dynamically based on qualification below
//                 'SBLS-2-2025' => 'experience_for_master',
//                 'SAOAAdmin-2-2025' => 'experience_for_bachelor',
//                 'AAdmin-2-2025' => 'experience_for_bachelor'
//             ];

//             // Default experience field
//             $experienceField = 'total_expr';

//             // Handle dynamic cases for SELS, SDCS etc
//             if ($post === 'SELS-2-2025') {
//                 if ($row_edu['edu5'] != '') {
//                     $experienceField = 'experience_for_phd';
//                 } elseif ($row_edu['edu4'] == 'M.Lib./M.LISc.') {
//                     $experienceField = 'experience_for_master';
//                 }
//             } elseif ($post === 'SDCS-2-2025') {
//                 if ($row_edu['edu5'] != '') {
//                     $experienceField = 'experience_for_phd';
//                 } elseif (in_array($row_edu['edu4'], ['M.Tech. (CS/IT)', 'Masters in CS/IT'])) {
//                     $experienceField = 'experience_for_master';
//                 } elseif (in_array($row_edu['edu3'], ['B.E. (CS/IT)', 'B.Tech. (CS/IT)', 'MCA'])) {
//                     $experienceField = 'experience_for_bachelor';
//                 }
//             } elseif (isset($experienceFieldMap[$post])) {
//                 $experienceField = $experienceFieldMap[$post];
//             }

//             // Final query using selected experience field
//             $query = "SELECT Name, post_id, category, sequence, year, total_expr,
//                       $experienceField AS experience
//                       FROM req_experience WHERE post = '$post'";

//             $result = mysqli_query($link, $query);
//             $data = array();

//             if (mysqli_num_rows($result) > 0) {
//                 while ($row = mysqli_fetch_assoc($result)) {
//                     $post_category = ($row['category'] == "Finance") ? "Admin" : $row['category'];
//                     $string = $row['post_id'] . $post_category . '-' . $row['sequence'] . '-' . $row['year'];

//                     if ($string == $post) {
//                         $data['total_expr'] = $row['total_expr'];
//                         $data['post'] = $row['Name'];
//                         $data['category'] = $row['category'];
//                         $data['experience'] = $row['experience'];
//                     }
//                 }
//             }
//             echo json_encode($data);
//         }
//     }
// }

?>
<?php

if (!isset($_SERVER['HTTP_REFERER'])) {
    header('location:./index.php');
    exit;
}

error_reporting(0);
require_once('dbConfig.php');

if (isset($_POST['post'])) {
    $post    = mysqli_real_escape_string($link, $_POST['post']);
    $reg_id  = mysqli_real_escape_string($link, $_POST['app_id']);

    $query_edu = "SELECT prsnl.post, edctn.edu3, edctn.edu4, edctn.edu5, edctn.edu7
                  FROM prsnl
                  LEFT JOIN edctn ON edctn.id = prsnl.id
                  WHERE prsnl.id = '$reg_id' AND prsnl.post = '$post'";
    $result_edu = mysqli_query($link, $query_edu);

    if (mysqli_num_rows($result_edu) > 0) {
        while ($row_edu = mysqli_fetch_assoc($result_edu)) {

            $query = "SELECT *
                      FROM req_experience
                      WHERE post = '$post'
                        AND status = 'OPEN'
                        AND (open_date_admin IS NULL OR open_date_admin <= NOW())
                        AND (closed_date_admin IS NULL OR closed_date_admin >= NOW())
                      LIMIT 1";
            $result = mysqli_query($link, $query);

            if (mysqli_num_rows($result) > 0) {
                $reqRow = mysqli_fetch_assoc($result);

                // Decide experience field based on qualification and available value
                if ($row_edu['edu5'] != '' && !empty($reqRow['experience_for_phd']) && $reqRow['experience_for_phd'] != '0') {
                    $experienceField = 'experience_for_phd';
                } elseif ($row_edu['edu4'] != '' && !empty($reqRow['experience_for_master']) && $reqRow['experience_for_master'] != '0') {
                    $experienceField = 'experience_for_master';
                }
                // elseif ($row_edu['edu3'] != '' && !empty($reqRow['experience_for_bachelor']) && $reqRow['experience_for_bachelor'] != '0') {
                //     $experienceField = 'experience_for_bachelor';
                // }

                elseif (
                    (
                        $row_edu['edu3'] != ''
                        || in_array($row_edu['edu3'], ['B.E. (CS/IT)', 'B.Tech. (CS/IT)'])
                        || $row_edu['edu4'] == 'MCA'
                    )
                    && !empty($reqRow['experience_for_bachelor'])
                    && $reqRow['experience_for_bachelor'] != '0'
                ) {
                    $experienceField = 'experience_for_bachelor';
                } else {
                    $experienceField = 'total_expr';
                }

                $finalQuery = "SELECT Name, post_id, category, sequence, year, total_expr,
                                      $experienceField AS experience
                               FROM req_experience
                               WHERE post = '$post'
                                 AND status = 'OPEN'
                                 AND (open_date_admin IS NULL OR open_date_admin <= NOW())
                                 AND (closed_date_admin IS NULL OR closed_date_admin >= NOW())";
                $resultFinal = mysqli_query($link, $finalQuery);
                $data = array();

                if (mysqli_num_rows($resultFinal) > 0) {
                    while ($row = mysqli_fetch_assoc($resultFinal)) {
                        $post_category = ($row['category'] == "Finance") ? "Admin" : $row['category'];
                        $string = $row['post_id'] . $post_category . '-' . $row['sequence'] . '-' . $row['year'];

                        if ($string == $post) {
                            $data['total_expr'] = $row['total_expr'];
                            $data['post']       = $row['Name'];
                            $data['category']   = $row['category'];
                            $data['experience'] = $row['experience'];
                        }
                    }
                }

                echo json_encode($data);
            }
        }
    }
}

?>

