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
$reg_id = mysqli_real_escape_string($link, $_POST['app_id']);
$post = mysqli_real_escape_string($link, $_POST['post']);
$job_type = mysqli_real_escape_string($link, $_POST['job_type']);
if ($job_type == 'Contractual') {
    $job_location = mysqli_real_escape_string($link, $_POST['job_location']);
} else {
    $job_location = '';
}
$surname = mysqli_real_escape_string($link, $_POST['surname']);
$firstname = mysqli_real_escape_string($link, $_POST['fname']);
$lastname = mysqli_real_escape_string($link, $_POST['lastname']);
$fathername = mysqli_real_escape_string($link, $_POST['fathername']);
$dob = mysqli_real_escape_string($link, $_POST['dob']);
$age = mysqli_real_escape_string($link, $_POST['agenew']);
$email = mysqli_real_escape_string($link, $_POST['email']);
$caste = mysqli_real_escape_string($link, $_POST['caste']);
$issue_year = mysqli_real_escape_string($link, $_POST['issue_year']);
$certi_no = mysqli_real_escape_string($link, $_POST['certi_no']);
$serving = mysqli_real_escape_string($link, $_POST['serving']);
$sex = mysqli_real_escape_string($link, $_POST['sex']);
$nation = mysqli_real_escape_string($link, $_POST['nation']);
$mstatus = mysqli_real_escape_string($link, $_POST['mstatus']);
$address = mysqli_real_escape_string($link, $_POST['address']);
$paddress = mysqli_real_escape_string($link, $_POST['paddress']);
$state = mysqli_real_escape_string($link, $_POST['state']);
$pstate = mysqli_real_escape_string($link, $_POST['pstate']);
$city = mysqli_real_escape_string($link, $_POST['city']);
$pcity = mysqli_real_escape_string($link, $_POST['pcity']);
$pincode = mysqli_real_escape_string($link, $_POST['pincode']);
$ppincode = mysqli_real_escape_string($link, $_POST['ppincode']);
$telephone = mysqli_real_escape_string($link, $_POST['telephone']);
$mobile = mysqli_real_escape_string($link, $_POST['mobile']);
$aadhar_no = mysqli_real_escape_string($link, $_POST['aadhar_no']);
$disability = mysqli_real_escape_string($link, $_POST['disability']);

if ($disability == "Yes") {
    //    $disability_percentage = mysqli_real_escape_string($link, $_POST['disability_percentage']);
    $type_of_disability = mysqli_real_escape_string($link, $_POST['type_of_disability']);
} else {
    //    $disability_percentage = Null;
    $type_of_disability = NULL;
}

$stenoGraphy_speed = mysqli_real_escape_string($link, $_POST["stenoGraphy_speed"]);
$stenography_certi_no = mysqli_real_escape_string($link, $_POST["stenography_certi_no"]);
$stenography_certi_date = mysqli_real_escape_string($link, $_POST["stenography_certi_date"]);
$typing_speed = mysqli_real_escape_string($link, $_POST["typing_speed"]);
$typing_certi_no = mysqli_real_escape_string($link, $_POST["typing_certi_no"]);
$typing_certi_date = mysqli_real_escape_string($link, $_POST["typing_certi_date"]);
$typing_language = mysqli_real_escape_string($link, $_POST["typing_language"]);

$inf_employee = mysqli_real_escape_string($link, $_POST["inf_employee"]);
$payroll_no = mysqli_real_escape_string($link, $_POST["payroll_no"]);

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

if ($_FILES["caste_certi"]["name"]) {
    $temp = explode(".", $_FILES["caste_certi"]["name"]);
    $newfilename = md5($reg_id) . md5($enc_current_date) . md5('caste') . '.' . end($temp);
    $certi_file_path = 'uploads/caste/' . $newfilename;
    move_uploaded_file($_FILES["caste_certi"]["tmp_name"], $certi_file_path);
}

if ($_FILES["disability_certi"]["name"]) {
    $temp = explode(".", $_FILES["disability_certi"]["name"]);
    $newfilename = md5($reg_id) . md5('disability') . md5($enc_current_date) . '.' . end($temp);
    $disability_certi_path = 'uploads/disability/' . $newfilename;
    move_uploaded_file($_FILES["disability_certi"]["tmp_name"], $disability_certi_path);
}

if ($_FILES["stenography_certi"]["name"]) {
    $temp = explode(".", $_FILES["stenography_certi"]["name"]);
    $newfilename = md5('stenography') . md5($enc_current_date) . md5($reg_id) . '.' . end($temp);
    $stenography_certi_path = 'uploads/steno/' . $newfilename;
    move_uploaded_file($_FILES["stenography_certi"]["tmp_name"], $stenography_certi_path);
}

if ($_FILES["typing_certi"]["name"]) {
    $temp = explode(".", $_FILES["typing_certi"]["name"]);
    $newfilename = md5($enc_current_date) . md5('typing') . md5($reg_id) . '.' . end($temp);
    $typing_certi_path = 'uploads/typing/' . $newfilename;
    move_uploaded_file($_FILES["typing_certi"]["tmp_name"], $typing_certi_path);
}

//$sql = "update prsnl set post='$post',surname='$surname',name='$firstname',lastname='$lastname',fathername='$fathername',dob='$dob',age='$age',email='$email',category='$caste',caste_certi='$certi_file_path' ,caste_certino='$certi_no', caste_certi_issue_year='$issue_year', sex='$sex',nation='$nation',mstatus='$mstatus', job_location='$job_location',address='$address',paddress='$paddress',state='$state',pstate='$pstate',city='$city',pcity='$pcity',pincode='$pincode',ppincode='$ppincode',mobile='$mobile', aadhar_no='$aadhar_no', telephone='$telephone' where id='$reg_id'";

$sql = "update prsnl set surname='$surname',name='$firstname',lastname='$lastname',fathername='$fathername',category='$caste',caste_certi='$certi_file_path' ,caste_certino='$certi_no', caste_certi_issue_year='$issue_year', sex='$sex',nation='$nation',mstatus='$mstatus', job_location='$job_location',address='$address',paddress='$paddress',state='$state',pstate='$pstate',city='$city',pcity='$pcity',pincode='$pincode',ppincode='$ppincode',mobile='$mobile', aadhar_no='$aadhar_no', disability='$disability', type_of_disability='$type_of_disability', disability_certi='$disability_certi_path', telephone='$telephone',browser_history='$brawser_h', stenoGraphy_speed='$stenoGraphy_speed',stenography_certi_no='$stenography_certi_no',stenography_certi_date='$stenography_certi_date',stenography_certi='$stenography_certi_path',typing_speed='$typing_speed',typing_certi_no='$typing_certi_no',typing_certi_date='$typing_certi_date',typing_certi='$typing_certi_path',typing_language='$typing_language',inf_employee='$inf_employee',payroll_no='$payroll_no' where id='$reg_id'";
$result_update = mysqli_query($link, $sql);

if ($result_update) {
    $sql = "select * from prsnl where id='$reg_id'";
    $result = mysqli_query($link, $sql);
    if (mysqli_num_rows($result) == 0) {
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