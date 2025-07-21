<?php

session_start();
if (isset($_POST['captcha_code_p'])) {

    if ($_POST['captcha_code_p'] != $_SESSION['code_p']) {

        echo "false_captcha";

        exit();
    }
}

if (!isset($_SERVER['HTTP_REFERER'])) {
    header('location:./index.php');
    exit;
}
//error_reporting(E_ALL ^ E_DEPRECATED);
//error_reporting(0);

include('dbConfig.php');
include "checker_input.php";

$reg_id   = clean_input($link, $_POST['app_id'] ?? '', 'Application ID');
$post     = clean_input($link, $_POST['post'] ?? '', 'Post');
$job_type = clean_input($link, $_POST['job_type'] ?? '', 'Job Type');

if (($job_type ?? '') == 'Contractual') {
    $job_location = clean_input($link, $_POST['job_location'] ?? '', 'Job Location');
} else {
    $job_location = '';
}

$surname       = clean_input($link, $_POST['surname'] ?? '', 'Surname');
$firstname     = clean_input($link, $_POST['fname'] ?? '', 'First Name');
$lastname      = clean_input($link, $_POST['lastname'] ?? '', 'Last Name');
$fathername    = clean_input($link, $_POST['fathername'] ?? '', 'Father Name');
$dob           = clean_input($link, $_POST['dob'] ?? '', 'Date of Birth');
$age           = clean_input($link, $_POST['agenew'] ?? '', 'Age');
$email         = clean_input($link, $_POST['email'] ?? '', 'Email');
$caste         = clean_input($link, $_POST['caste'] ?? '', 'Caste');
$issue_year    = clean_input($link, $_POST['issue_year'] ?? '', 'Issue Year');
$certi_no      = clean_input($link, $_POST['certi_no'] ?? '', 'Certificate Number');
$serving       = clean_input($link, $_POST['serving'] ?? '', 'Serving');
$sex           = clean_input($link, $_POST['sex'] ?? '', 'Sex');
$nation        = clean_input($link, $_POST['nation'] ?? '', 'Nationality');
$mstatus       = clean_input($link, $_POST['mstatus'] ?? '', 'Marital Status');
$address       = clean_input($link, $_POST['address'] ?? '', 'Address');
$paddress      = clean_input($link, $_POST['paddress'] ?? '', 'Permanent Address');
$state         = clean_input($link, $_POST['state'] ?? '', 'State');
$pstate        = clean_input($link, $_POST['pstate'] ?? '', 'Permanent State');
$city          = clean_input($link, $_POST['city'] ?? '', 'City');
$pcity         = clean_input($link, $_POST['pcity'] ?? '', 'Permanent City');
$pincode       = clean_input($link, $_POST['pincode'] ?? '', 'Pincode');
$ppincode      = clean_input($link, $_POST['ppincode'] ?? '', 'Permanent Pincode');
$telephone     = clean_input($link, $_POST['telephone'] ?? '', 'Telephone');
$mobile        = clean_input($link, $_POST['mobile'] ?? '', 'Mobile');
$aadhar_no     = clean_input($link, $_POST['aadhar_no'] ?? '', 'Aadhar Number');
$disability    = clean_input($link, $_POST['disability'] ?? '', 'Disability');


if (($disability ?? '') == "Yes") {
    // $disability_percentage = clean_input($link, $_POST['disability_percentage'] ?? '', 'Disability Percentage');
    $type_of_disability = clean_input($link, $_POST['type_of_disability'] ?? '', 'Type of Disability');
} else {
    // $disability_percentage = NULL;
    $type_of_disability = NULL;
}


$stenoGraphy_speed       = clean_input($link, $_POST["stenoGraphy_speed"] ?? '', 'Stenography Speed');
$stenography_certi_no    = clean_input($link, $_POST["stenography_certi_no"] ?? '', 'Stenography Certificate Number');
$stenography_certi_date  = clean_input($link, $_POST["stenography_certi_date"] ?? '', 'Stenography Certificate Date');
$typing_speed            = clean_input($link, $_POST["typing_speed"] ?? '', 'Typing Speed');
$typing_certi_no         = clean_input($link, $_POST["typing_certi_no"] ?? '', 'Typing Certificate Number');
$typing_certi_date       = clean_input($link, $_POST["typing_certi_date"] ?? '', 'Typing Certificate Date');
$typing_language         = clean_input($link, $_POST["typing_language"] ?? '', 'Typing Language');

$inf_employee            = clean_input($link, $_POST["inf_employee"] ?? '', 'INF Employee');
$payroll_no              = clean_input($link, $_POST["payroll_no"] ?? '', 'Payroll Number');


$certi_file_path = '';
$ua = getBrowser();
$brawser_h = implode(", ", $ua);

$sql = "select caste_certi, disability_certi,stenography_certi, typing_certi from prsnl where id='$reg_id'";
$result = mysqli_query($link, $sql);
if (mysqli_num_rows($result) == 0) {
} else {
    while ($row1 = mysqli_fetch_assoc($result)) {
        $certi_file_path = $row1['caste_certi'];
        $disability_certi_path = $row1['disability_certi'];
        $stenography_certi_path = $row1['stenography_certi'];
        $typing_certi_path = $row1['typing_certi'];
    }
}

date_default_timezone_set('Asia/Kolkata');
$current_date = date("Y-m-d H:i:s");
$enc_current_date = strtotime($current_date);

// if ($_FILES["caste_certi"]["name"]) {
//     $temp = explode(".", $_FILES["caste_certi"]["name"]);
//     $newfilename = md5($reg_id) . md5($enc_current_date) . md5('caste') . '.' . end($temp);
//     $certi_file_path = 'uploads/caste/' . $newfilename;
//     move_uploaded_file($_FILES["caste_certi"]["tmp_name"], $certi_file_path);
// }

// if ($_FILES["disability_certi"]["name"]) {
//     $temp = explode(".", $_FILES["disability_certi"]["name"]);
//     $newfilename = md5($reg_id) . md5('disability') . md5($enc_current_date) . '.' . end($temp);
//     $disability_certi_path = 'uploads/disability/' . $newfilename;
//     move_uploaded_file($_FILES["disability_certi"]["tmp_name"], $disability_certi_path);
// }

// if ($_FILES["stenography_certi"]["name"]) {
//     $temp = explode(".", $_FILES["stenography_certi"]["name"]);
//     $newfilename = md5('stenography') . md5($enc_current_date) . md5($reg_id) . '.' . end($temp);
//     $stenography_certi_path = 'uploads/steno/' . $newfilename;
//     move_uploaded_file($_FILES["stenography_certi"]["tmp_name"], $stenography_certi_path);
// }

if ($_FILES["caste_certi"]["name"]) {
    $allowed_types = [
        'jpg' => ['mime' => 'image/jpeg', 'signature' => "\xFF\xD8\xFF"],
        'jpeg' => ['mime' => 'image/jpeg', 'signature' => "\xFF\xD8\xFF"],
        'png' => ['mime' => 'image/png', 'signature' => "\x89\x50\x4E\x47\x0D\x0A\x1A\x0A"],
        'pdf' => ['mime' => 'application/pdf', 'signature' => "%PDF-"]
    ];

    $original_name = $_FILES["caste_certi"]["name"];
    $file_tmp = $_FILES["caste_certi"]["tmp_name"];
    $file_size = $_FILES["caste_certi"]["size"];
    $ext = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));

    if (!array_key_exists($ext, $allowed_types)) {
        echo "<script>alert('Invalid file extension.');</script>";
        exit;
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file_tmp);
    finfo_close($finfo);

    if ($mime !== $allowed_types[$ext]['mime']) {
        echo "<script>alert('Mismatch between extension and MIME type.');</script>";
        exit;
    }

    if ($file_size > 400 * 1024) {
        echo "<script>alert('File too large. Max 400 KB allowed.');</script>";
        exit;
    }

    $expected_signature = $allowed_types[$ext]['signature'];
    $expected_length = strlen($expected_signature);
    $handle = fopen($file_tmp, 'rb');
    if ($handle === false) {
        echo "<script>alert('Unable to read file for validation.');</script>";
        exit;
    }
    $file_signature = fread($handle, $expected_length);
    fclose($handle);

    if (strncmp($file_signature, $expected_signature, $expected_length) !== 0) {
        echo "<script>alert('File content does not match declared type.');</script>";
        exit;
    }

    $temp = explode(".", $original_name);
    $newfilename = md5($reg_id) . md5($enc_current_date) . md5('caste') . '.' . end($temp);
    $certi_file_path = 'uploads/caste/' . $newfilename;

    if (!move_uploaded_file($file_tmp, $certi_file_path)) {
        echo "<script>alert('File upload failed.');</script>";
        exit;
    }
}

if ($_FILES["disability_certi"]["name"]) {
    $allowed_types = [
        'jpg' => ['mime' => 'image/jpeg', 'signature' => "\xFF\xD8\xFF"],
        'jpeg' => ['mime' => 'image/jpeg', 'signature' => "\xFF\xD8\xFF"],
        'png' => ['mime' => 'image/png', 'signature' => "\x89\x50\x4E\x47\x0D\x0A\x1A\x0A"],
        'pdf' => ['mime' => 'application/pdf', 'signature' => "%PDF-"]
    ];

    $original_name = $_FILES["disability_certi"]["name"];
    $file_tmp = $_FILES["disability_certi"]["tmp_name"];
    $file_size = $_FILES["disability_certi"]["size"];
    $ext = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));

    if (!array_key_exists($ext, $allowed_types)) {
        echo "<script>alert('Invalid file extension.');</script>";
        exit;
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file_tmp);
    finfo_close($finfo);

    if ($mime !== $allowed_types[$ext]['mime']) {
        echo "<script>alert('Mismatch between extension and MIME type.');</script>";
        exit;
    }

    if ($file_size > 400 * 1024) {
        echo "<script>alert('File too large. Max 400 KB allowed.');</script>";
        exit;
    }

    $expected_signature = $allowed_types[$ext]['signature'];
    $expected_length = strlen($expected_signature);
    $handle = fopen($file_tmp, 'rb');
    if ($handle === false) {
        echo "<script>alert('Unable to read file for validation.');</script>";
        exit;
    }
    $file_signature = fread($handle, $expected_length);
    fclose($handle);

    if (strncmp($file_signature, $expected_signature, $expected_length) !== 0) {
        echo "<script>alert('File content does not match declared type.');</script>";
        exit;
    }

    $temp = explode(".", $original_name);
    $newfilename = md5($reg_id) . md5('disability') . md5($enc_current_date) . '.' . end($temp);
    $disability_certi_path = 'uploads/disability/' . $newfilename;

    if (!move_uploaded_file($file_tmp, $disability_certi_path)) {
        echo "<script>alert('File upload failed.');</script>";
        exit;
    }
}

if ($_FILES["stenography_certi"]["name"]) {
    $allowed_types = [
        'jpg' => ['mime' => 'image/jpeg', 'signature' => "\xFF\xD8\xFF"],
        'jpeg' => ['mime' => 'image/jpeg', 'signature' => "\xFF\xD8\xFF"],
        'png' => ['mime' => 'image/png', 'signature' => "\x89\x50\x4E\x47\x0D\x0A\x1A\x0A"],
        'pdf' => ['mime' => 'application/pdf', 'signature' => "%PDF-"]
    ];

    $original_name = $_FILES["stenography_certi"]["name"];
    $file_tmp = $_FILES["stenography_certi"]["tmp_name"];
    $file_size = $_FILES["stenography_certi"]["size"];
    $ext = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));

    if (!array_key_exists($ext, $allowed_types)) {
        echo "<script>alert('Invalid file extension.');</script>";
        exit;
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file_tmp);
    finfo_close($finfo);

    if ($mime !== $allowed_types[$ext]['mime']) {
        echo "<script>alert('Mismatch between extension and MIME type.');</script>";
        exit;
    }

    if ($file_size > 400 * 1024) {
        echo "<script>alert('File too large. Max 400 KB allowed.');</script>";
        exit;
    }

    $expected_signature = $allowed_types[$ext]['signature'];
    $expected_length = strlen($expected_signature);
    $handle = fopen($file_tmp, 'rb');
    if ($handle === false) {
        echo "<script>alert('Unable to read file for validation.');</script>";
        exit;
    }
    $file_signature = fread($handle, $expected_length);
    fclose($handle);

    if (strncmp($file_signature, $expected_signature, $expected_length) !== 0) {
        echo "<script>alert('File content does not match declared type.');</script>";
        exit;
    }

    $temp = explode(".", $original_name);
    $newfilename = md5('stenography') . md5($enc_current_date) . md5($reg_id) . '.' . end($temp);
    $stenography_certi_path = 'uploads/steno/' . $newfilename;

    if (!move_uploaded_file($file_tmp, $stenography_certi_path)) {
        echo "<script>alert('File upload failed.');</script>";
        exit;
    }
}


// if ($_FILES["typing_certi"]["name"]) {
//     $temp = explode(".", $_FILES["typing_certi"]["name"]);
//     $newfilename = md5($enc_current_date) . md5('typing') . md5($reg_id) . '.' . end($temp);
//     $typing_certi_path = 'uploads/typing/' . $newfilename;
//     move_uploaded_file($_FILES["typing_certi"]["tmp_name"], $typing_certi_path);
// }


if ($_FILES["typing_certi"]["name"]) {
    $allowed_types = [
        'jpg' => ['mime' => 'image/jpeg', 'signature' => "\xFF\xD8\xFF"],
        'jpeg' => ['mime' => 'image/jpeg', 'signature' => "\xFF\xD8\xFF"],
        'png' => ['mime' => 'image/png', 'signature' => "\x89\x50\x4E\x47\x0D\x0A\x1A\x0A"],
        'pdf' => ['mime' => 'application/pdf', 'signature' => "%PDF-"]
    ];

    $original_name = $_FILES["typing_certi"]["name"];
    $file_tmp = $_FILES["typing_certi"]["tmp_name"];
    $file_size = $_FILES["typing_certi"]["size"];
    $ext = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));

    if (!array_key_exists($ext, $allowed_types)) {
        echo "<script>alert('Invalid file extension.');</script>";
        exit;
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file_tmp);
    finfo_close($finfo);

    if ($mime !== $allowed_types[$ext]['mime']) {
        echo "<script>alert('Mismatch between extension and MIME type.');</script>";
        exit;
    }

    if ($file_size > 400 * 1024) {
        echo "<script>alert('File too large. Max 400 KB allowed.');</script>";
        exit;
    }

    $expected_signature = $allowed_types[$ext]['signature'];
    $expected_length = strlen($expected_signature);
    $handle = fopen($file_tmp, 'rb');
    if ($handle === false) {
        echo "<script>alert('Unable to read file for validation.');</script>";
        exit;
    }
    $file_signature = fread($handle, $expected_length);
    fclose($handle);

    if (strncmp($file_signature, $expected_signature, $expected_length) !== 0) {
        echo "<script>alert('File content does not match declared type.');</script>";
        exit;
    }

    $temp = explode(".", $original_name);
    $newfilename = md5($enc_current_date) . md5('typing') . md5($reg_id) . '.' . end($temp);
    $typing_certi_path = 'uploads/typing/' . $newfilename;

    if (!move_uploaded_file($file_tmp, $typing_certi_path)) {
        echo "<script>alert('File upload failed.');</script>";
        exit;
    }
}



//$sql = "update prsnl set post='$post',surname='$surname',name='$firstname',lastname='$lastname',fathername='$fathername',dob='$dob',age='$age',email='$email',category='$caste',caste_certi='$certi_file_path' ,caste_certino='$certi_no', caste_certi_issue_year='$issue_year', sex='$sex',nation='$nation',mstatus='$mstatus', job_location='$job_location',address='$address',paddress='$paddress',state='$state',pstate='$pstate',city='$city',pcity='$pcity',pincode='$pincode',ppincode='$ppincode',mobile='$mobile', aadhar_no='$aadhar_no', telephone='$telephone' where id='$reg_id'";

$sql = "update prsnl set surname='$surname',name='$firstname',lastname='$lastname',fathername='$fathername',category='$caste',caste_certi='$certi_file_path' ,caste_certino='$certi_no', caste_certi_issue_year='$issue_year', sex='$sex',nation='$nation',mstatus='$mstatus', job_location='$job_location',address='$address',paddress='$paddress',state='$state',pstate='$pstate',city='$city',pcity='$pcity',pincode='$pincode',ppincode='$ppincode',mobile='$mobile', aadhar_no='$aadhar_no', disability='$disability', type_of_disability='$type_of_disability', disability_certi='$disability_certi_path', telephone='$telephone',browser_history='$brawser_h', stenoGraphy_speed='$stenoGraphy_speed',stenography_certi_no='$stenography_certi_no',stenography_certi_date='$stenography_certi_date',stenography_certi='$stenography_certi_path',typing_speed='$typing_speed',typing_certi_no='$typing_certi_no',typing_certi_date='$typing_certi_date',typing_certi='$typing_certi_path',typing_language='$typing_language',inf_employee='$inf_employee',payroll_no='$payroll_no' where id='$reg_id'";
$result_update = mysqli_query($link, $sql);

$stmt = $link->prepare(
    "UPDATE prsnl
     SET surname=?, name=?, lastname=?, fathername=?, category=?, caste_certi=?, caste_certino=?, caste_certi_issue_year=?,
         sex=?, nation=?, mstatus=?, job_location=?, address=?, paddress=?, state=?, pstate=?, city=?, pcity=?,
         pincode=?, ppincode=?, mobile=?, aadhar_no=?, disability=?, type_of_disability=?, disability_certi=?,
         telephone=?, browser_history=?, stenoGraphy_speed=?, stenography_certi_no=?, stenography_certi_date=?,
         stenography_certi=?, typing_speed=?, typing_certi_no=?, typing_certi_date=?, typing_certi=?, typing_language=?,
         inf_employee=?, payroll_no=?
     WHERE id=?"
);
$stmt->bind_param(
    'sssssssssssssssssssssssssssssssssssss',
    $surname,
    $firstname,
    $lastname,
    $fathername,
    $caste,
    $certi_file_path,
    $certi_no,
    $issue_year,
    $sex,
    $nation,
    $mstatus,
    $job_location,
    $address,
    $paddress,
    $state,
    $pstate,
    $city,
    $pcity,
    $pincode,
    $ppincode,
    $mobile,
    $aadhar_no,
    $disability,
    $type_of_disability,
    $disability_certi_path,
    $telephone,
    $brawser_h,
    $stenoGraphy_speed,
    $stenography_certi_no,
    $stenography_certi_date,
    $stenography_certi_path,
    $typing_speed,
    $typing_certi_no,
    $typing_certi_date,
    $typing_certi_path,
    $typing_language,
    $inf_employee,
    $payroll_no,
    $reg_id
);
$result_update = $stmt->execute();

if ($result_update) {
    $stmt = $link->prepare("SELECT * FROM prsnl WHERE id = ?");
    $stmt->bind_param('i', $reg_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 0) {
        //echo json_encode("false");
    } else {
        while ($row = mysqli_fetch_assoc($result)) {
            session_start();
            $_SESSION['post'] = $row['post'];
            $_SESSION['job_location'] = $row['job_location'];
            $_SESSION['job_type'] = $row['job_type'];
            $_SESSION['surname'] = $row['surname'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['lastname'] = $row['lastname'];
            $_SESSION['fathername'] = $row['fathername'];
            $_SESSION['dob'] = $row['dob'];
            $_SESSION['age'] = $row['age'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['caste'] = $row['category'];
            $_SESSION['caste_certi'] = $row['caste_certi'];
            $_SESSION['caste_certi_issue_year'] = $row['caste_certi_issue_year'];
            $_SESSION['caste_certino'] = $row['caste_certino'];
            $_SESSION['serving'] = $row['serving'];
            $_SESSION['type_of_service'] = $row['type_of_service'];
            $_SESSION['sex'] = $row['sex'];
            $_SESSION['nation'] = $row['nation'];
            $_SESSION['mstatus'] = $row['mstatus'];
            $_SESSION['address'] = $row['address'];
            $_SESSION['paddress'] = $row['paddress'];
            $_SESSION['state'] = $row['state'];
            $_SESSION['pstate'] = $row['pstate'];
            $_SESSION['city'] = $row['city'];
            $_SESSION['pcity'] = $row['pcity'];
            $_SESSION['pincode'] = $row['pincode'];
            $_SESSION['ppincode'] = $row['ppincode'];
            $_SESSION['telephone'] = $row['telephone'];
            $_SESSION['reg_id'] = $row['id'];
            $_SESSION['mobile'] = $row['mobile'];
            $_SESSION['aadhar_no'] = $row['aadhar_no'];
            $_SESSION['disability'] = $row['disability'];
            $_SESSION['disability_percentage'] = $row['disability_percentage'];
            $_SESSION['disability_certi'] = $row['disability_certi'];
            $_SESSION['stenoGraphy_speed'] = $row['stenoGraphy_speed'];
            $_SESSION['stenography_certi_no'] = $row['stenography_certi_no'];
            $_SESSION['stenography_certi_date'] = $row['stenography_certi_date'];
            $_SESSION['stenography_certi'] = $row['stenography_certi'];
            $_SESSION['typing_speed'] = $row['typing_speed'];
            $_SESSION['typing_certi_no'] = $row['typing_certi_no'];
            $_SESSION['typing_certi_date'] = $row['typing_certi_date'];
            $_SESSION['typing_certi'] = $row['typing_certi'];
            $_SESSION['typing_language'] = $row['typing_language'];
            $_SESSION['inf_employee'] = $row['inf_employee'];
            $_SESSION['payroll_no'] = $row['payroll_no'];
            $_SESSION['type_of_job'] = $row['type_of_job'];
            $_SESSION['length_of_service'] = $row['length_of_service'];
            $_SESSION['service_from_date'] = $row['service_from_date'];
            $_SESSION['service_to_date'] = $row['service_to_date'];

            header("location:application_form.php");
        }
    }
    //echo json_encode("true");
} else {
    header("location:application_form.php");
    //echo json_encode("false");
}
?>
<?php

function getBrowser()
{
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version = "";
    // First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    } elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }
    // Next get the name of the useragent yes seperately and for good reason
    if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    } elseif (preg_match('/Firefox/i', $u_agent)) {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    } elseif (preg_match('/Chrome/i', $u_agent)) {
        $bname = 'Google Chrome';
        $ub = "Chrome";
    } elseif (preg_match('/Safari/i', $u_agent)) {
        $bname = 'Apple Safari';
        $ub = "Safari";
    } elseif (preg_match('/Opera/i', $u_agent)) {
        $bname = 'Opera';
        $ub = "Opera";
    } elseif (preg_match('/Netscape/i', $u_agent)) {
        $bname = 'Netscape';
        $ub = "Netscape";
    }
    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
            $version = $matches['version'][0];
        } else {
            $version = $matches['version'][1];
        }
    } else {
        $version = $matches['version'][0];
    }
    // check if we have a number
    if ($version == null || $version == "") {
        $version = "?";
    }
    return array(
        'name' => $bname,
        'version' => $version,
        'platform' => $platform
    );
}

?>