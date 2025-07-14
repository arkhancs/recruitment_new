<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
if (!isset($_SERVER['HTTP_REFERER'])) {
  header('location:./index.php');
  exit;
}
session_start();

// if (!empty($_SESSION)) {
//   echo "<h2>Session Data:</h2>";
//   echo "<ul>";
//   foreach ($_SESSION as $key => $value) {
//     echo "<li><strong>$key:</strong> $value</li>";
//   }
//   echo "</ul>";
//   var_dump($_SESSION['is_login']);
// } else {
//   echo "No session data available.";
// }


function my_error_handler($errno, $errstr, $errfile, $errline)
{
  throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

function my_exception_handler($e)
{
  header('Location: application_form.php');
}

include 'header.php';

$photo = "";
$sign = "";
$dob_proof = "";
$noc = "";
$otherdoc = "";
$caste_certi = "";
$ssc_certi = "";
$hsc_certi = "";
$bachelor_certi = "";
$master_certi = "";
$phd_certi = "";
$expr_certi = "";
$file_fees = "";
$apars_doc = "";

if (isset($_SESSION)) {
  $post = $_SESSION['post'];
  $job_location = $_SESSION['job_location'];
  $job_type = $_SESSION['job_type'];
  $prefix = $_SESSION['prefix'];
  $surname = $_SESSION['surname'];
  $name = $_SESSION['name'];
  $fathername = $_SESSION['fathername'];
  $lastname = $_SESSION['lastname'];
  $dob = $_SESSION['dob'];
  $age = $_SESSION['age'];
  $caste = $_SESSION['caste'];
  $caste_certi = $_SESSION['caste_certi'];
  $issue_year = $_SESSION['caste_certi_issue_year'];
  $certi_no = $_SESSION['caste_certino'];
  $serving = $_SESSION['serving'];
  $type_of_service = $_SESSION['type_of_service'];
  $sex = $_SESSION['sex'];
  $nation = $_SESSION['nation'];
  $mstatus = $_SESSION['mstatus'];
  $address = $_SESSION['address'];
  $paddress = $_SESSION['paddress'];
  $state = $_SESSION['state'];
  $pstate = $_SESSION['pstate'];
  $city = $_SESSION['city'];
  $pcity = $_SESSION['pcity'];
  $pincode = $_SESSION['pincode'];
  $ppincode = $_SESSION['ppincode'];
  $same_address = $_SESSION['same_address'];
  $telephone = $_SESSION['telephone'];
  $mobile = $_SESSION['mobile'];
  $aadhar_no = $_SESSION['aadhar_no'];
  $email = $_SESSION['email'];
  $disability = $_SESSION['disability'];
  $disability_percentage = $_SESSION['disability_percentage'];
  $type_of_disability = $_SESSION['type_of_disability'];
  $disability_certi = $_SESSION['disability_certi'];
  $type_of_job = $_SESSION['type_of_job'];
  $length_of_service = $_SESSION['length_of_service'];
  $service_from_date = $_SESSION['service_from_date'];
  $service_to_date = $_SESSION['service_to_date'];

  $stenoGraphy_speed = $_SESSION['stenoGraphy_speed'];
  $stenography_certi_no = $_SESSION['stenography_certi_no'];
  $stenography_certi_date = $_SESSION['stenography_certi_date'];
  $stenography_certi = $_SESSION['stenography_certi'];

  $typing_speed = $_SESSION['typing_speed'];
  $typing_certi_no = $_SESSION['typing_certi_no'];
  $typing_certi_date = $_SESSION['typing_certi_date'];
  $typing_certi = $_SESSION['typing_certi'];

  $typing_language = $_SESSION['typing_language'];
  $inf_employee = $_SESSION['inf_employee'];
  $payroll_no = $_SESSION['payroll_no'];

  $edu1 = $_SESSION['edu1'];
  $edu2 = $_SESSION['edu2'];
  $edu3 = $_SESSION['edu3'];
  $edu4 = $_SESSION['edu4'];
  $edu5 = $_SESSION['edu5'];
  $edu6 = $_SESSION['edu6'];
  $edu7 = $_SESSION['edu7'];
  $edu8 = $_SESSION['edu8'];

  $board1 = $_SESSION['board1'];
  $board2 = $_SESSION['board2'];
  $board3 = $_SESSION['board3'];
  $board4 = $_SESSION['board4'];
  $board5 = $_SESSION['board5'];
  $board6 = $_SESSION['board6'];
  $board7 = $_SESSION['board7'];
  $board8 = $_SESSION['board8'];

  $year1 = $_SESSION['year1'];
  $year2 = $_SESSION['year2'];
  $year3 = $_SESSION['year3'];
  $year4 = $_SESSION['year4'];
  $year5 = $_SESSION['year5'];
  $year6 = $_SESSION['year6'];
  $year7 = $_SESSION['year7'];
  $year8 = $_SESSION['year8'];

  $per1 = $_SESSION['per1'];
  $per2 = $_SESSION['per2'];
  $per3 = $_SESSION['per3'];
  $per4 = $_SESSION['per4'];
  $per5 = $_SESSION['per5'];
  $per6 = $_SESSION['per6'];
  $per7 = $_SESSION['per7'];
  $per8 = $_SESSION['per8'];

  $speci1 = $_SESSION['speci1'];
  $speci2 = $_SESSION['speci2'];
  $speci3 = $_SESSION['speci3'];
  $speci4 = $_SESSION['speci4'];
  $speci5 = $_SESSION['speci5'];
  $speci6 = $_SESSION['speci6'];
  $speci7 = $_SESSION['speci7'];
  $speci8 = $_SESSION['speci8'];

  $div1 = $_SESSION['div1'];
  $div2 = $_SESSION['div2'];
  $div3 = $_SESSION['div3'];
  $div4 = $_SESSION['div4'];
  $div5 = $_SESSION['div5'];
  $div6 = $_SESSION['div6'];
  $div7 = $_SESSION['div7'];
  $div8 = $_SESSION['div8'];

  $ssc_certi = $_SESSION['ssc_certi'];
  $hsc_certi = $_SESSION['hsc_certi'];
  $bachelor_certi = $_SESSION['bachelor_certi'];
  $master_certi = $_SESSION['master_certi'];
  $phd_certi = $_SESSION['phd_certi'];
  $other_edu_certi = $_SESSION['other_edu_certi'];
  $comp_certi = $_SESSION['comp_certi'];

  $org1 = $_SESSION['org1'];
  $pos1 = $_SESSION['pos1'];
  $from1 = $_SESSION['from1'];
  $to1 = $_SESSION['to1'];
  $nature1 = $_SESSION['nature1'];
  $pay1 = $_SESSION['pay1'];
  $total1 = $_SESSION['total1'];
  $otype1 = $_SESSION['otype1'];
  $exp1 = $_SESSION['exp1'];
  $exp_file1 = $_SESSION['exp_file1'];

  $org2 = $_SESSION['org2'];
  $pos2 = $_SESSION['pos2'];
  $from2 = $_SESSION['from2'];
  $to2 = $_SESSION['to2'];
  $nature2 = $_SESSION['nature2'];
  $pay2 = $_SESSION['pay2'];
  $total2 = $_SESSION['total2'];
  $otype2 = $_SESSION['otype2'];
  $exp2 = $_SESSION['exp2'];
  $exp_file2 = $_SESSION['exp_file2'];

  $org3 = $_SESSION['org3'];
  $pos3 = $_SESSION['pos3'];
  $from3 = $_SESSION['from3'];
  $to3 = $_SESSION['to3'];
  $nature3 = $_SESSION['nature3'];
  $pay3 = $_SESSION['pay3'];
  $total3 = $_SESSION['total3'];
  $otype3 = $_SESSION['otype3'];
  $exp3 = $_SESSION['exp3'];
  $exp_file3 = $_SESSION['exp_file3'];

  $org4 = $_SESSION['org4'];
  $pos4 = $_SESSION['pos4'];
  $from4 = $_SESSION['from4'];
  $to4 = $_SESSION['to4'];
  $nature4 = $_SESSION['nature4'];
  $pay4 = $_SESSION['pay4'];
  $total4 = $_SESSION['total4'];
  $otype4 = $_SESSION['otype4'];
  $exp4 = $_SESSION['exp4'];
  $exp_file4 = $_SESSION['exp_file4'];

  $org5 = $_SESSION['org5'];
  $pos5 = $_SESSION['pos5'];
  $from5 = $_SESSION['from5'];
  $to5 = $_SESSION['to5'];
  $nature5 = $_SESSION['nature5'];
  $pay5 = $_SESSION['pay5'];
  $total5 = $_SESSION['total5'];
  $otype5 = $_SESSION['otype5'];
  $exp5 = $_SESSION['exp5'];
  $exp_file5 = $_SESSION['exp_file5'];

  $org6 = $_SESSION['org6'];
  $pos6 = $_SESSION['pos6'];
  $from6 = $_SESSION['from6'];
  $to6 = $_SESSION['to6'];
  $nature6 = $_SESSION['nature6'];
  $pay6 = $_SESSION['pay6'];
  $otype6 = $_SESSION['otype6'];
  $exp6 = $_SESSION['exp6'];
  $exp_file6 = $_SESSION['exp_file6'];

  $org7 = $_SESSION['org7'];
  $pos7 = $_SESSION['pos7'];
  $from7 = $_SESSION['from7'];
  $to7 = $_SESSION['to7'];
  $nature7 = $_SESSION['nature7'];
  $pay7 = $_SESSION['pay7'];
  $otype7 = $_SESSION['otype7'];
  $exp7 = $_SESSION['exp7'];
  $exp_file7 = $_SESSION['exp_file7'];

  $org8 = $_SESSION['org8'];
  $pos8 = $_SESSION['pos8'];
  $from8 = $_SESSION['from8'];
  $to8 = $_SESSION['to8'];
  $nature8 = $_SESSION['nature8'];
  $pay8 = $_SESSION['pay8'];
  $otype8 = $_SESSION['otype8'];
  $exp8 = $_SESSION['exp8'];
  $exp_file8 = $_SESSION['exp_file8'];

  $org9 = $_SESSION['org9'];
  $pos9 = $_SESSION['pos9'];
  $from9 = $_SESSION['from9'];
  $to9 = $_SESSION['to9'];
  $nature9 = $_SESSION['nature9'];
  $pay9 = $_SESSION['pay9'];
  $otype9 = $_SESSION['otype9'];
  $exp9 = $_SESSION['exp9'];
  $exp_file9 = $_SESSION['exp_file9'];

  $org10 = $_SESSION['org10'];
  $pos10 = $_SESSION['pos10'];
  $from10 = $_SESSION['from10'];
  $to10 = $_SESSION['to10'];
  $nature10 = $_SESSION['nature10'];
  $pay10 = $_SESSION['pay10'];
  $otype10 = $_SESSION['otype10'];
  $exp10 = $_SESSION['exp10'];
  $exp_file10 = $_SESSION['exp_file10'];
  $currently_working = $_SESSION['currently_working'];

  $ref1 = $_SESSION['ref1'];
  $ref2 = $_SESSION['ref2'];
  $detained = $_SESSION['detained'];
  $detained_details = $_SESSION['detained_details'];
  $other_info = $_SESSION['other_info'];
  $photo = $_SESSION['photo'];
  $sign = $_SESSION['sign'];
  $dob_proof = $_SESSION['dob_proof'];
  $noc = $_SESSION['noc'];
  $otherdoc = $_SESSION['otherdoc'];
  $transaction_ref_no = $_SESSION['transaction_ref_no'];
  $dd_date = $_SESSION['dd_date'];
  $dd_amount = $_SESSION['dd_amount'];
  $apars_doc = $_SESSION['apars_doc'];
  //            $bank_name = $_SESSION['bank_name'];
  //            $branch_name = $_SESSION['branch_name'];
  //$previous_applied = $_SESSION['previous_applied'];
  //$previous_app_id = $_SESSION['previous_app_id'];
  $fees_receipt = $_SESSION['fees_receipt'];
  $declaration = $_SESSION['declaration'];
  $police = $_SESSION['police'];
  $app_id = $_SESSION['app_id'];
  $aadhar_no = $_SESSION['aadhar_no'];
  $grandtotal = $_SESSION['grandtotal'];
  $expr_certi = $_SESSION['expr_certi'];
}

if ($prefix != '' && $name != '') {
  $welcome_message = 'Welcome <b>' . strtoupper($prefix) . ' ' . strtoupper($surname) . ' ' . strtoupper($name) . ' ' . strtoupper($fathername) . '</b><br/>Your Application ID: <b>' . $app_id . '</b>';
}

if ($_SESSION['is_login'] == 'true') {
  $joblocation = $job_location;
  $cat = $_SESSION['category_job'];
  $j_type = $_SESSION['job_type'];
} else {
  $joblocation = $_GET['job_location'];
  $cat = $_GET['cat'];
  $j_type = "Permanent";
  //$j_type = $_GET['job_type'];
}
?>

<!--<link href="css/style.css" rel="stylesheet" type="text/css"></link>-->
<script type="text/javascript" src="js/Ajaxfileupload-jquery-1.3.2.js"></script>
<script type="text/javascript" language="javascript" src="js/validate.js"></script>
<script type="text/javascript" language="javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/ajaxupload.3.5.js"></script>
<script type="text/javascript" src="js/exp_calculation.js"></script>
<script type="text/javascript" src="js/seperate_exp_calculation.js"></script>
<link rel="stylesheet" href="css/jquery-ui.css">
</link>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</link>
<script src="js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script src="dtpicker/jquery-1.10.2.js"></script>
<script src="dtpicker/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="css/Ajaxfile-upload.css" />
</link>
<link rel="stylesheet" type="text/css" href="css/style.css">
</link>
<link rel="stylesheet" type="text/css" href="css/custom.css">
</link>
<script src="js/parsley.min.js"></script>
<style type="text/css">
  .form-control {
    min-height: 38px;
    color: #000000;
    background: rgba(255, 255, 255);
    border-radius: 5px;
  }

  .bg-image {
    background-image: none;
  }
</style>
<div class="container" style="padding-top:5px;padding-bottom: 100px; border-radius: 5px; ">
  <?php
  if (isset($_SESSION['registration_notification'])) {
    echo $_SESSION['registration_notification'];
    unset($_SESSION['registration_notification']);
  }
  ?>
  <br />
  <div class="col-md-12 mb30">
    <strong>Note : Fields having <font style="color:red">*</font> Symbol are Mandatory Fields.</strong>
    <?php if ($welcome_message != '') { ?>
      <span class="pull-right"><?php echo $welcome_message; ?></span><br />
    <?php } ?>
  </div>
  <div class="preload" style="display: none;">
    <center><img src="images/25.gif" /></center>
  </div>

  <ul class="nav nav-pills">
    <li class="active" id="li1"><a href="#personal" data-toggle="tab"><b>Personal Details</b></a></li>
    <li id="li2"><a href="#" data-toggle="tab"><b>Educational Details</b></a></li>
    <li id="li3"><a href="#" data-toggle="tab"><b>Experience Details</b></a></li>
    <li id="li4"><a href="#" data-toggle="tab"><b>Upload Documents</b></a></li>
    <li id="li5"><a href="#" data-toggle="tab"><b>Others</b></a></li>
  </ul>


  <div class="tab-content">
    <div id="personal" class="tab-pane fade in active" style="border: 1px solid #23297a;">
      <form name="frmregister" id="frmregister" action="login.php" method="post" enctype="multipart/form-data">

        <?php if ($j_type != 'Permanent') { ?>
          <input type=" hidden" name="redirect_url" value="application_form.php?job_location=<?php echo $_GET['job_location'] ?>&cat=<?php echo $_GET['cat'] ?>"></input>
        <?php } else { ?>
          <input type="hidden" name="redirect_url" value="application_form.php?job_type=<?php echo $j_type ?>"></input>
        <?php } ?>
        <input type="hidden" name="job_type" value="<?php echo $j_type ?>"></input>
        <div class="row">
          <div class="col-lg-12">
            <br />
            <?php
            if ($_SESSION['is_login'] == 'true') {
              $joblocation = $job_location;
              $cat = $_SESSION['category_job'];
              $j_type = $_SESSION['job_type'];
            } else {
              $joblocation = $_GET['job_location'];
              $cat = $_GET['cat'];
              $j_type = "Permanent";
            }

            date_default_timezone_set('Asia/Kolkata');
            $current_date = date("d/m/Y");

            //                                if ($j_type != 'Permanent') {
            //                                    if ($joblocation == 'UGC, New Delhi') {
            //                                        $query = "select * from req_experience where STR_TO_DATE(closed_date,'%d/%m/%Y') >= STR_TO_DATE('$current_date','%d/%m/%Y') and status='OPEN' AND  job_location='" . $joblocation . "' AND job_type='" . $j_type . "'";
            //                                    } elseif ($joblocation == 'INFLIBNET, Gandhinagar' && ($cat == 'CS' || $cat == 'LS' || (isset($cat) && $cat != ""))) {
            //                                        $query = "select * from req_experience where STR_TO_DATE(closed_date,'%d/%m/%Y') >= STR_TO_DATE('$current_date','%d/%m/%Y') and status='OPEN' AND category = '" . $cat . "' AND  job_location='" . $joblocation . "' AND job_type='" . $j_type . "'";
            //                                    } elseif ($joblocation == 'INFLIBNET, Gandhinagar') {
            //                                        $query = "select * from req_experience where STR_TO_DATE(closed_date,'%d/%m/%Y') >= STR_TO_DATE('$current_date','%d/%m/%Y') and status='OPEN' AND category ='' AND job_location='" . $joblocation . "' AND job_type='" . $j_type . "'";
            //                                    }
            //                                } else {
            // $query = "select * from req_experience where STR_TO_DATE(closed_date,'%d/%m/%Y') >= STR_TO_DATE('$current_date','%d/%m/%Y') and status='OPEN' and job_type='" . $j_type . "'";
            $query = "SELECT * FROM req_experience
          WHERE STR_TO_DATE(closed_date,'%d/%m/%Y') >= STR_TO_DATE(?,'%d/%m/%Y')
          AND status = 'OPEN'
          AND job_type = ?";

            $stmt = $link->prepare($query);
            $stmt->bind_param("ss", $current_date, $j_type);
            $stmt->execute();
            //                                }
            // $result = mysqli_query($link, $query);
            $result = $stmt->get_result();
            ?>
            <div class="col-md-2">
              <label for="post" style="text-align:left"> <b>Post applied for:<font style="color:red">*</font></b></label>
            </div>
            <div class="col-md-4">
              <select name="post" id="post" class="form-control" required <?php if ($_SESSION['is_login'] == 'true') {
                                                                            echo 'disabled';
                                                                          } ?> onchange="categoryByPost();">
                <option value="">Please Select</option>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                  if ($row['category'] == '') {
                    $str = $row['post_id'] . '-' . $row['sequence'] . '-' . $row['year'];
                    if ($post == $str) {
                      $post_name2 = $row['Name'];
                    }
                ?>
                    <option value="<?php echo $row['post']; ?>" <?php echo ($row['post'] == $post) ? 'selected' : ' '; ?>> <?php echo $row['Name']; ?></option>
                  <?php
                  } else {
                    $str = $row['post_id'] . $row['category'] . '-' . $row['sequence'] . '-' . $row['year'];
                    if ($post == $str) {
                      $post_name2 = $row['Name'];
                    }
                  ?>
                    <option value="<?php echo $row['post']; ?>" <?php echo ($row['post'] == $post) ? 'selected' : ' '; ?>><?php echo $row['Name'] . " (" . $row['category'] . ")" ?></option>
                  <?php } ?>
                <?php } ?>
              </select>

            </div>


            <div class="col-md-2" style="display:none;">
              <label for="location" style="text-align:left"> <b>Job Location:<font style="color:red">*</font></b></label>
            </div>
            <div class="col-md-4" style="display:none;">
              <input type="text" name="job_location" id="job_location" value="<?php
                                                                              if ($_SESSION['is_login'] == 'true') {
                                                                                echo $job_location;
                                                                              } else {
                                                                                echo $_GET['job_location'];
                                                                              }
                                                                              ?>" class="form-control" readonly></input>
            </div>

            <div class="col-md-2">
              <input name="app_id" id="app_id" type="hidden" class="form-control" value="<?php echo (isset($app_id)) ? $app_id : ''; ?>" />
              <label for="sex" style="text-align:left"><b> Nationality:<font style="color:red">*</font></b></label>
            </div>
            <div class="col-md-4">
              <input class="fullname" required name="nation" maxlength="10" size="15" type="text" value="<?php echo (isset($nation)) ? "$nation" : "Indian"; ?>" readonly />
            </div>
            <div style="clear:both;"></div>
            <br />
            <div class="col-md-12">
              <center>
                <p style="color:red;"><strong>Full Name (Preferably exactly same as printed on degree certificate)</strong></p>
              </center>
            </div>
            <div class="col-md-2">
              <label for="" style="text-align:left"> <b>Prefix:<font style="color:red">*</font></b></label>
            </div>
            <div class="col-md-4">
              <select name="prefix" class="fullname" required>
                <option value="">Please Select</option>
                <option value="Mr." <?php echo ($prefix == "Mr.") ? 'selected' : ''; ?>>Mr.</option>
                <option value="Ms." <?php echo ($prefix == "Ms.") ? 'selected' : ''; ?>>Ms.</option>
                <option value="Mrs." <?php echo ($prefix == "Mrs.") ? 'selected' : ''; ?>>Mrs.</option>
                <option value="Dr." <?php echo ($prefix == "Dr.") ? 'selected' : ''; ?>>Dr.</option>
              </select>
            </div>
            <div class="col-md-2">
              <label for="" style="text-align:left"> <b>First Name:<font style="color:red">*</font></b></label>
            </div>
            <div class="col-md-4">
              <input name="fname" class="fullname" required maxlength="45" value="<?php echo (isset($name)) ? $name : ''; ?>" size="40" type="text" placeholder='Firstname' />
            </div>
            <div style="clear:both;"></div>
            <br />
            <div class="col-md-2">
              <label for="" style="text-align:left"> <b>Middle Name:</b></label>
            </div>
            <div class="col-md-1">
              <select class="fullname" name="lastname">
                <option value="">Please Select</option>
                <option value="Father Name" <?php echo ($lastname == "Father Name") ? 'selected' : ''; ?>>Father's Name</option>
                <option value="Husband Name" <?php echo ($lastname == "Husband Name") ? 'selected' : ''; ?>>Husband's Name</option>
              </select>
            </div>
            <div class="col-md-3">
              <input name="fathername" class="fullname" maxlength="45" value="<?php echo (isset($fathername)) ? $fathername : ''; ?>" size="40" type="text" placeholder='Middlename' />
            </div>
            <div class="col-md-2">
              <label for="" style="text-align:left"> <b>Last Name:</b></label>
            </div>
            <div class="col-md-4">
              <input name="surname" class="fullname" maxlength="45" value="<?php echo (isset($surname)) ? $surname : ''; ?>" size="40" type="text" placeholder='Lastname' />
            </div>
            <div style="clear:both;"></div>
            <br />
            <div class="col-md-2">
              <label for="prefix" style="text-align:left"><b>Category:<font style="color:red">*</font></b></label>
            </div>
            <div class="col-md-4">
              <div id="caste_type">
                <input type="hidden" name="session_caste" id="session_caste" value="<?php echo $caste; ?>">
                <?php if ($caste != '' && isset($caste)) { ?>
                  <select class="form-control" required name="caste" id="caste" style="background-color: #eee;" readonly onchange="showDiv(this.value, '<?php echo $j_type ?>')">
                    <?php if ($caste == 'GENERAL') { ?>
                      <option value="GENERAL" <?php echo ($caste == "GENERAL") ? 'selected' : ''; ?>>GENERAL</option>
                    <?php } else if ($caste == 'SC') { ?>
                      <option value="SC" <?php echo ($caste == "SC") ? 'selected' : ''; ?>>SC</option>
                    <?php } else if ($caste == 'ST') { ?>
                      <option value="ST" <?php echo ($caste == "ST") ? 'selected' : ''; ?>>ST</option>
                    <?php } else if ($caste == 'EWS') { ?>
                      <option value="EWS" <?php echo ($caste == "EWS") ? 'selected' : ''; ?>>EWS</option>
                    <?php } else if ($caste == 'OBC') { ?>
                      <option value="OBC" <?php echo ($caste == "OBC") ? 'selected' : ''; ?>>OBC(Non-Creamy Layer)</option>
                    <?php } else if ($caste == 'Ex-servicemen') { ?>
                      <option value="Ex-servicemen" <?php echo ($caste == "Ex-servicemen") ? 'selected' : ''; ?>>Ex-servicemen</option>
                    <?php } ?>
                  </select>
                <?php } else { ?>
                  <select class="form-control" required name="caste" id="caste" onchange="showDiv(this.value, '<?php echo $j_type ?>')">
                    <option value="">Please Select</option>
                    <option value="GENERAL">GENERAL</option>
                    <option value="SC">SC</option>
                    <option value="ST">ST</option>
                    <option value="EWS">EWS</option>
                    <option value="OBC">OBC(Non-Creamy Layer)</option>
                    <!--<option value="Ex-servicemen">Ex-servicemen</option>-->
                  </select>
                <?php } ?>
              </div>
            </div>
            <?php
            if ($caste_certi != '') {
              $style_caste = "visibility: visible;";
            } else {
              $style_caste = "visibility: hidden;";
            }
            ?>
            <div id="hidden_div" style="display: <?php
                                                  if ($caste == 'SC' || $caste == 'ST' || $caste == 'EWS' || $caste == 'OBC') {
                                                    echo "block";
                                                  } else {
                                                    echo "none";
                                                  }
                                                  ?>">
              <div class="col-md-2">
                <label for="obccerti" style="text-align:left"><b>Caste Certificate:<font style="color:red">*</font></b></label>
              </div>
              <div class="col-md-4">
                <input type="file" name="caste_certi" id="caste_certi"></input>
                <?php if (!isset($caste) && $caste == "") { ?>
                  <a href="files/Format for SCST Certificate of GOI.pdf" id="scst" target="_blank">View SCST Sample Format</a>
                  <a href="files/OBC-certificate.pdf" id="obc" target="_blank">View OBC Sample Format</a>
                  <p>Certificate should be in the format for job under goverment of india cervice.</p>
                <?php } ?>
                <?php if (isset($caste_certi) && $caste_certi != '') { ?>
                  <a href="<?php echo $caste_certi; ?>" id="caste_certi_view" style="<?php echo $style_caste; ?>" target="_blank"><b><u>View</u></b></a>
                  <input type="hidden" id="caste_certi1" name="caste_certi1" value="<?php echo isset($val9) ? "$val9" : ""; ?>" />
                <?php } ?>
              </div>
              <div style="clear: both;"></div><br />
              <div class="col-md-2">
                <label for="issue" style="text-align:left"><b>Year of Issue (dd/mm/yyyy):<font style="color:red">*</font></b></label>
              </div>
              <div class="col-md-4">
                <input type="text" maxlength="10" name="issue_year" id="issue_year" placeholder="DD/MM/YYYY" value="<?php echo (isset($issue_year)) ? $issue_year : ''; ?>" class="fullname"></input>
              </div>
              <div class="col-md-2">
                <label for="issue" style="text-align:left"><b>Caste Certi. No.:<font style="color:red">*</font></b></label>
              </div>
              <div class="col-md-4">
                <input type="text" maxlength="21" name="certi_no" id="certi_no" value="<?php echo (isset($certi_no)) ? $certi_no : ''; ?>" class="fullname"></input>
              </div>
              <div style="clear:both;"></div><br />
            </div>
            <br /><br />
            <div id="exserviceman_div" style="display:<?php
                                                      if ($caste == 'Ex-servicemen') {
                                                        echo "block";
                                                      } else {
                                                        echo "none";
                                                      }
                                                      ?>;">
              <div class="col-md-2">
                <label for="Length of service" style="text-align:left"><b>Service in Military From-To Date:<font style="color:red">*</font></b></label>
              </div>
              <div class="col-md-2">
                <input type="text" id="service_from_date" name="service_from_date" placeholder="MM/DD/YYYY" readonly class="fullname" maxlength="10" size="15" value="<?php echo (isset($service_from_date)) ? $service_from_date : ''; ?>" <?php echo (isset($service_from_date)) ? "disabled style='background:#eee;'" : "style='background: #FFFFFF;'"; ?> />
              </div>
              <div class="col-md-2">
                <input type="text" name="service_to_date" id="service_to_date" placeholder="MM/DD/YYYY" readonly class="fullname" value="<?php echo (isset($service_to_date)) ? $service_to_date : ''; ?>" <?php echo (isset($service_to_date)) ? "disabled style='background:#eee;'" : "style='background: #FFFFFF;'"; ?> />
              </div>
              <div class="col-md-2">
                <label for="Length of service" style="text-align:left"><b>Length of Service in Military:<font style="color:red">*</font></b></label>
              </div>
              <div class="col-md-4">
                <input type="text" name="length_of_service" id="length_of_service" class="form-control" readonly value="<?php echo (isset($length_of_service)) ? $length_of_service : ''; ?>"></input>
              </div>
            </div>
            <div class="clearfix"></div><br />
            <div class="col-md-2">
              <label for="serving" style="text-align:left"><b>Are you Serving?:<font style="color:red">*</font></b></label>
            </div>
            <div class="col-md-4">
              <select name="serving" id="serving" class="form-control" required <?php
                                                                                if (isset($serving) && $serving != "" && $post != "") {
                                                                                  echo 'disabled';
                                                                                }
                                                                                ?>>
                <option value="">Select Option</option>
                <option value="Yes" <?php echo ($serving == "Yes") ? 'selected' : ''; ?>>Yes</option>
                <option value="No" <?php echo ($serving == "No") ? 'selected' : ''; ?>>No</option>
              </select>
            </div>
            <div id="service_div" style="display:<?php
                                                  if (isset($serving) && $serving == 'Yes') {
                                                    echo "block";
                                                  } else {
                                                    echo "none";
                                                  }
                                                  //                        if (isset($post) && ($post == 'AOAdmin-1-2023' || $post == 'AOFAdmin-1-2023' || $post == 'PSAdmin-2-2023' || $post == 'CCTAdmin-2-2023')) {
                                                  //                            echo "block";
                                                  //                        } else {
                                                  //                            echo "none";
                                                  //                        }
                                                  ?>;">
              <div class="col-md-2">
                <label for="Types of Service" style="text-align:left"><b>Types of Service:<font style="color:red">*</font></b></label>
              </div>
              <div class="col-md-4">
                <select name="type_of_service" id="type_of_service" class="form-control" <?php
                                                                                          if (isset($type_of_service) && $type_of_service != "" && $post != "") {
                                                                                            echo 'disabled';
                                                                                          }
                                                                                          ?>>
                  <option value="">Select Types of Service</option>
                  <option value="Central Government" <?php echo ($type_of_service == "Central Government") ? 'selected' : ''; ?>>Central Government</option>
                  <option value="State Government" <?php echo ($type_of_service == "State Government") ? 'selected' : ''; ?>>State Government</option>
                  <option value="Autonomous Body" <?php echo ($type_of_service == "Autonomous Body") ? 'selected' : ''; ?>>Autonomous Body</option>
                  <option value="University/Colleges" <?php echo ($type_of_service == "University/Colleges") ? 'selected' : ''; ?>>University</option>
                  <option value="Not Applicable" <?php echo ($type_of_service == "Not Applicable") ? 'selected' : ''; ?>>Not Applicable</option>
                </select>
              </div>
            </div>
            <div style="clear:both;"></div><br />
            <div id="job_type_div" style="display: <?php
                                                    if (isset($type_of_service) && $type_of_service != 'Not Applicable' && $type_of_service != "") {
                                                      echo "block";
                                                    } else {
                                                      echo "none";
                                                    }
                                                    ?>">
              <div class="col-md-2">
                <label for="type_of_job" style="text-align:left"><b>Types of Job:<font style="color:red">*</font></b></label>
              </div>
              <div class="col-md-4">
                <select name="type_of_job" id="type_of_job" class="form-control" <?php
                                                                                  if (isset($type_of_service) && $type_of_service != "" && $post != "") {
                                                                                    echo 'disabled';
                                                                                  }
                                                                                  ?>>
                  <option value="">Select Types of Job</option>
                  <option value="Permanent" <?php echo ($type_of_job == "Permanent") ? 'selected' : ''; ?>>Permanent</option>
                  <option value="On Contract (On the roll of Institute/Department)" <?php echo ($type_of_job == "On Contract (On the roll of Institute/Department)") ? 'selected' : ''; ?>>On Contract (On the roll of Institute/Department)</option>
                  <option value="On Contract (Through Outsource Agency)" <?php echo ($type_of_job == "On Contract (Through Outsource Agency)") ? 'selected' : ''; ?>>On Contract (Through Outsource Agency)</option>
                  <!--                                    <option value="Contractual" <?php echo ($type_of_job == "Contractual") ? 'selected' : ''; ?>>Contractual</option>
                                    <option value="Adhoc" <?php echo ($type_of_job == "Adhoc") ? 'selected' : ''; ?>>Adhoc</option>-->
                </select>
              </div>
            </div>
            <div style="clear:both;"></div><br />
            <div class="col-md-2">
              <label for="dob" style="text-align:left"><b>Date of Birth (MM/DD/YYYY):<font style="color:red">*</font></b></label>
            </div>
            <div class="col-md-2">
              <input type="text" id="dob" name="dob" placeholder="MM/DD/YYYY" class="fullname" required maxlength="10" size="15" readonly value="<?php echo (isset($dob)) ? $dob : ''; ?>" <?php echo (isset($dob)) ? "disabled style='background:#eee;'" : "style='background: #FFFFFF;'"; ?> />
            </div>
            <div class="col-md-2">
              <input name="agenew" id="agenew" type="text" class="fullname" value="<?php echo (isset($age)) ? "$age" : "0 years"; ?>" readonly />
            </div>
            <div class="col-md-2">
              <label for="sex" style="text-align:left"><b>Gender:<font style="color:red">*</font></b></label>
            </div>
            <div class="col-md-4">
              <select class="form-control" required name="sex">
                <option value="">Please select</option>
                <option value="Male" <?php echo ($sex == "Male") ? 'selected' : ''; ?>>Male</option>
                <option value="Female" <?php echo ($sex == "Female") ? 'selected' : ''; ?>>Female</option>
              </select>
            </div>
            <div style="clear:both;"></div><br />
            <div class="col-md-2">
              <label for="sex" style="text-align:left"><b>Marital Status:<font style="color:red">*</font></b></label>
            </div>
            <div class="col-md-4">
              <select class="form-control" required name="mstatus">
                <option value="">Please select</option>
                <option value="Single" <?php echo ($mstatus == "Single") ? 'selected' : ''; ?>>Single</option>
                <option value="Married" <?php echo ($mstatus == "Married") ? 'selected' : ''; ?>>Married</option>
              </select>
            </div>
            <div class="col-md-2">
              <label for="sex" style="text-align:left"><b>Email: <font style="color:red">*</font></b></label>
            </div>
            <div class="col-md-4">
              <input name="email" id="email" class="form-control" required maxlength="45" size="15" type="email" value="<?php echo (isset($email)) ? "$email" : ""; ?>" <?php echo (isset($email)) ? "disabled" : ""; ?> />
              <font style="color:red;">(Please enter active email only)</font>
            </div>
            <div style="clear:both;"></div><br />
            <div class="col-md-2">
              <label for="sex" style="text-align:left"><b>Telephone:</b></label>
            </div>
            <div class="col-md-4">
              <input name="telephone" maxlength="15" default='-' class="form-control" type="text" value="<?php echo (isset($telephone)) ? "$telephone" : ""; ?>" />
            </div>
            <div class="col-md-2">
              <label for="sex" style="text-align:left"><b>Mobile:<font style="color:red">*</font></b></label>
            </div>
            <div class="col-md-4">
              <input name="mobile" class="form-control" required minlength="10" maxlength="10" type="number" placeholder="Enter only 10 digit number" value="<?php echo (isset($mobile)) ? "$mobile" : ""; ?>" />
            </div>
            <div style="clear:both;"></div><br />
            <div class="col-md-2">
              <label for="sex" style="text-align:left"><b>Aadhaar Number:</b></label>
            </div>
            <div class="col-md-4">
              <input name="aadhar_no" id="aadhar_no" class="form-control" type="number" minlength="12" maxlength="12" placeholder="Enter no. without space or special character" value="<?php echo (isset($aadhar_no)) ? "$aadhar_no" : ""; ?>" />
            </div>
            <div style="clear:both;"></div><br />
            <div class="col-md-2">
              <label for="Disability" style="text-align:left"><b>Do you belongs to Person with Benchmark Disability(PwBD)?:<font style="color:red">*</font></b></label>
            </div>
            <div class="col-md-4">
              <select name="disability" id="disability" class="form-control" required onchange="showDiv2(this.value)">
                <option value="">Select Option</option>
                <option value="Yes" <?php echo ($disability == "Yes") ? 'selected' : ''; ?>>Yes</option>
                <option value="No" <?php echo ($disability == "No") ? 'selected' : ''; ?>>No</option>
              </select>
            </div>
            <div id="hidden_div2" style="<?php echo ($disability == "Yes") ? 'display: block' : 'display: none'; ?>">
              <div class="col-md-2">
                <label for="Disability_percentage" style="text-align:left"><b>Percentage of Disability:<font style="color:red">*</font></b></label>
              </div>
              <div class="col-md-4">
                <input type="number" name="disability_percentage" id="disability_percentage" maxlength="2" placeholder="Enter digit without % sign" class="form-control" value="<?php echo isset($disability_percentage) ? "$disability_percentage" : ''; ?>" <?php echo (isset($disability_percentage)) ? "disabled" : ""; ?>></input>
              </div>
              <div style="clear:both"></div>
              <div class="col-md-2">
                <label for="type_of_disability" style="text-align:left"><b>Type of Disability:<font style="color:red">*</font></b></label>
              </div>
              <div class="col-md-4">
                <select name="type_of_disability" id="type_of_disability" class="form-control">
                  <option value="">Select Type of Disability</option>
                  <option value="Blindness or Low vision" <?php echo ($type_of_disability == "Blindness or Low vision") ? 'selected' : ''; ?>>Blindness or Low vision</option>
                  <option value="Hearding impairment" <?php echo ($type_of_disability == "Hearding impairment") ? 'selected' : ''; ?>>Hearding impairment</option>
                  <option value="Locomotor disability or Cerebral palsy" <?php echo ($type_of_disability == "Locomotor disability or Cerebral palsy") ? 'selected' : ''; ?>>Locomotor disability or Cerebral palsy</option>
                </select>
              </div>
              <div class="col-md-2"><b>Disability Certificate<font style="color:red">*</font></b></div>
              <div class="col-md-4">
                <?php if ($disability_certi != '') {
                  $style_disability_certi = "visibility: visible;";
                } else {
                  $style_disability_certi = "visibility: hidden;";
                } ?>
                <input type="file" name="disability_certi" id="disability_certi"></input>
                <a href="<?php echo $disability_certi; ?>" id="disability_certi_view" style="<?php echo $style_disability_certi; ?>" target="_blank"><b><u>View</u></b></a>
                <input type="hidden" id="disability_certi1" name="disability_certi1" value="<?php echo isset($vald) ? "$vald" : ""; ?>" />
              </div>
            </div>
            <div class="clearfix"></div>
            <div id="typing_div" style="display:<?php if (isset($post) && ($post == "PSAdmin-2-2023")) {
                                                  echo 'block';
                                                  $required = "required";
                                                } else {
                                                  echo 'none';
                                                  $required = "";
                                                } ?>">
              <div class="col-md-2">
                <label for="steno" style="text-align:left"><b>StenoGraphy Speed(w.p.m.):<font style="color:red">*</font></b></label>
              </div>
              <div class="col-md-4">
                <input type="text" name="stenoGraphy_speed" id="stenoGraphy_speed" minlength="3" maxlength="3" value="<?php echo (isset($stenoGraphy_speed)) ? "$stenoGraphy_speed" : ""; ?>" class="form-control" <?php echo $required; ?>></input>
              </div>
              <div class="col-md-2">
                <label for="steno_certi_no" style="text-align:left"><b>StenoGraphy Certificate Number:<font style="color:red">*</font></b></label>
              </div>
              <div class="col-md-4">
                <input type="text" name="stenography_certi_no" id="stenography_certi_no" value="<?php echo (isset($stenography_certi_no)) ? "$stenography_certi_no" : ""; ?>" class="form-control" <?php echo $required; ?>></input>
              </div>
              <div class="clearfix"></div><br />
              <div class="col-md-2">
                <label for="steno_certi_date" style="text-align:left"><b>StenoGraphy Certificate Date:<font style="color:red">*</font></b></label>
              </div>
              <div class="col-md-4">
                <input type="text" name="stenography_certi_date" id="stenography_certi_date" value="<?php echo (isset($stenography_certi_date)) ? "$stenography_certi_date" : ""; ?>" class="form-control" <?php echo $required; ?>></input>
              </div>
              <div class="col-md-2">
                <label for="steno_certi" style="text-align:left"><b>StenoGraphy Certificate:<font style="color:red">*</font></b></label>
              </div>
              <div class="col-md-4">
                <?php
                if ($stenography_certi != '') {
                  $style_stenography_certi = "visibility: visible;";
                } else {
                  $style_stenography_certi = "visibility: hidden;";
                }
                ?>
                <input type="file" name="stenography_certi" id="stenography_certi" <?php echo isset($stenography_certi) ? "" : "required"; ?>></input>
                <a href="<?php echo $stenography_certi; ?>" id="stenography_certi_view" style="<?php echo $style_stenography_certi; ?>" target="_blank"><b><u>View</u></b></a>
                <input type="hidden" id="stenography_certi1" name="stenography_certi1" value="<?php echo isset($stenography_certi) ? "$stenography_certi" : ""; ?>" />
              </div>
            </div>
            <div class="clearfix"></div><br />
            <div id="typing_div1" style="display:<?php
                                                  if (isset($post) && ($post == "TestCCTAdmin-2-2025" || $post == "PSAdmin-2-2023")) {
                                                    echo 'block';
                                                    $required1 = "required";
                                                  } else {
                                                    echo 'none';
                                                    $required1 = "";
                                                  }
                                                  ?>">
              <div class="col-md-2">
                <label for="sspeed" style="text-align:left"><b>Typing Speed(w.p.m.):<font style="color:red">*</font></b></label>
              </div>
              <div class="col-md-4">
                <input type="text" name="typing_speed" id="typing_speed" value="<?php echo (isset($typing_speed)) ? "$typing_speed" : ""; ?>" class="form-control" <?php echo $required1; ?>></input>
              </div>
              <div class="col-md-2">
                <label for="sspeed" style="text-align:left"><b>Typing Speed Certificate Number:<font style="color:red">*</font></b></label>
              </div>
              <div class="col-md-4">
                <input type="text" name="typing_certi_no" id="typing_certi_no" value="<?php echo (isset($typing_certi_no)) ? "$typing_certi_no" : ""; ?>" class="form-control" <?php echo $required1; ?>></input>
              </div>
              <div class="clearfix"></div><br />
              <div class="col-md-2">
                <label for="tcdate" style="text-align:left"><b>Typing Speed Certificate Date:<font style="color:red">*</font></b></label>
              </div>
              <div class="col-md-4">
                <input type="text" name="typing_certi_date" id="typing_certi_date" value="<?php echo (isset($typing_certi_date)) ? "$typing_certi_date" : ""; ?>" class="form-control" <?php echo $required1; ?>></input>
              </div>
              <div class="col-md-2">
                <label for="speed" style="text-align:left"><b>Typing Certificate:<font style="color:red">*</font></b></label>
              </div>
              <div class="col-md-4">
                <?php
                if ($typing_certi != '') {
                  $style_typing_certi = "visibility: visible;";
                } else {
                  $style_typing_certi = "visibility: hidden;";
                }
                ?>
                <input type="file" name="typing_certi" id="typing_certi" <?php echo isset($typing_certi) ? "" : "required"; ?>></input>
                <a href="<?php echo $typing_certi; ?>" id="typing_certi_view" style="<?php echo $style_typing_certi; ?>" target="_blank"><b><u>View</u></b></a>
                <input type="hidden" id="typing_certi1" name="typing_certi1" value="<?php echo isset($typing_certi) ? "$typing_certi" : ""; ?>" />
              </div>
              <div id="typing_type">
                <div style="clear:both;"><br /></div>
                <div class="col-md-2">
                  <label for="sspeed" style="text-align:left"><b>Typing Type:<font style="color:red">*</font></b></label>
                </div>
                <div class="col-md-4">
                  <select name="typing_language" id="typing_language" class="form-control" <?php echo $required; ?>>
                    <option value="English" <?php echo ($typing_language == "English") ? 'selected' : ''; ?>>English</option>
                    <option value="Hindi" <?php echo ($typing_language == "Hindi") ? 'selected' : ''; ?>>Hindi</option>
                  </select>
                </div>
              </div>
            </div>
            <div style="clear:both;"><br /></div>
            <div class="col-md-2">
              <label for="inf_emp" style="text-align:left"><b>Are you Regular Employee of INFLIBNET Centre?:</b></label>
            </div>
            <div class="col-md-4">
              <select name="inf_employee" id="inf_employee" class="form-control" required>
                <option value="No" <?php echo ($inf_employee == "No") ? 'selected' : ''; ?>>No</option>
                <option value="Yes" <?php echo ($inf_employee == "Yes") ? 'selected' : ''; ?>>Yes</option>

              </select>
            </div>
            <div id="inf_emp_div" style="display: <?php
                                                  if (isset($payroll_no) && $payroll_no != "") {
                                                    echo 'block';
                                                  } else {
                                                    echo 'none';
                                                  };
                                                  ?>">
              <div class="col-md-2">
                <label for="payroll" style="text-align:left"><b>Enter Payroll Number:<font style="color:red">*</font></b></label>
              </div>
              <div class="col-md-4">
                <input type="number" name="payroll_no" id="payroll_no" value="<?php echo isset($payroll_no) ? "$payroll_no" : ""; ?>" class="form-control" maxlength="4"></input>
              </div>
            </div>
            <div style="clear:both;"><br /></div>
            <hr />
            <div class="col-md-6">
              <span style="text-align:left;color:#337ab7;font-size:16px"><b>Residence details: </b></span>
            </div>
            <div class="col-md-6">
              <input id="copy_address" name="copy_address" type="checkbox" <?php echo ($same_address == 'Yes') ? 'checked' : ''; ?> /> <span style="text-align:left" class="custom-control-label">Same As Mailing address
            </div>
            <div style="clear:both;"></div><br />
            <div class="col-md-2">
              <label for="address" style="text-align:left"><b>Mailing Address:<font style="color:red">*</font></b></label>
            </div>
            <div class="col-md-4">
              <textarea name="address" id="address" maxlength="300" required class="form-control" rows="5" size="30"><?php echo (isset($address)) ? "$address" : ""; ?> </textarea>
            </div>
            <div class="col-md-2">
              <label for="sex" style="text-align:left"><b>Permanent Address:<font style="color:red">*</font></b></label>
            </div>
            <div class="col-md-4">
              <textarea name="paddress" id="paddress" required maxlength="300" class="form-control" size="30" rows="5"><?php echo (isset($paddress)) ? "$paddress" : ""; ?> </textarea>
            </div>
            <div style="clear: both"></div><br />
            <?php
            $sql = "Select * from states";
            $res = mysqli_query($link, $sql);
            ?>
            <div class="col-md-2">
              <label for="state" style="text-align:left"><b>State:<font style="color:red">*</font></b></label>
            </div>
            <div class="col-md-4">
              <select class="form-control" name="state" required id="state">
                <option value="">Please Select</option>
                <?php while ($row = mysqli_fetch_assoc($res)) { ?>

                  <option value="<?php echo $row['id'] ?>" <?php echo ($state == $row['id']) ? "selected" : ""; ?>><?php echo $row['name'] ?></option>
                <?php } ?>
              </select>
            </div>
            <?php
            $sql = "Select * from states";
            $res = mysqli_query($link, $sql);
            ?>
            <div class="col-md-2">
              <label for="sex" style="text-align:left"><b>State:<font style="color:red">*</font></b></label>
            </div>
            <div class="col-md-4">
              <select class="form-control" name="pstate" required id="pstate">
                <option value="">Please Select</option>
                <?php while ($row = mysqli_fetch_assoc($res)) { ?>
                  <option value="<?php echo $row['id'] ?>" <?php echo ($pstate == $row['id']) ? "selected" : ""; ?>><?php echo $row['name'] ?></option>
                <?php } ?>
              </select>
            </div>
            <div style="clear: both"></div><br />
            <div class="col-md-2">
              <label for="city" style="text-align:left"><b>City:<font style="color:red">*</font></b></label>
            </div>
            <div class="col-md-4">
              <input name="city" id="city" maxlength="15" class="form-control" required size="15" type="text" value="<?php echo (isset($city)) ? "$city" : ""; ?>" />
            </div>
            <div class="col-md-2">
              <label for="city" style="text-align:left"><b>City:<font style="color:red">*</font></b></label>
            </div>
            <div class="col-md-4">
              <input name="pcity" id="pcity" maxlength="15" class="form-control" required size="15" type="text" value="<?php echo (isset($pcity)) ? "$pcity" : ""; ?>" />
            </div>
            <div style="clear: both"></div><br />
            <div class="col-md-2">
              <label for="sex" style="text-align:left"><b>Pincode:<font style="color:red">*</font></b></label>
            </div>
            <div class="col-md-4">
              <input type="number" name="pincode" id="pincode" class="form-control" required maxlength="6" value="<?php echo (isset($pincode)) ? "$pincode" : ""; ?>" />
            </div>
            <div class="col-md-2">
              <label for="sex" style="text-align:left"><b>Pincode:<font style="color:red">*</font></b></label>
            </div>
            <div class="col-md-4">
              <input type="number" name="ppincode" id="ppincode" class="form-control" required maxlength="6" value="<?php echo (isset($ppincode)) ? "$ppincode" : ""; ?>" />
            </div>
          </div>
        </div>

        <!-- Captcha  frmregister start-->

        <div class="clearfix"></div>
        <div class="col-xs-6">
          <br />
          <label for="captcha_code_p" style="text-align:left">Enter Captcha :</label>
          <img id="captcha_img_p" src="captcha_p.php" alt="CAPTCHA" height="40" width="100" />
          <a href='javascript: refresh_captcha_p();'>
            <img src="images/refresh.png" height="40" width="40" alt="Refresh Captcha" />
          </a>
          <input type="text" id="captcha_code_p" name="captcha_code_p" class="fullname" placeholder="Enter captcha here" autocomplete="off" style="width:30%" required />
        </div>



        <!-- Captcha  frmregister end-->
        <div class="clear:both"></div>
        <br /><br />

        <div style="clear: both"></div><br />
        <div style="padding-bottom: 10px">
          <center>
            <?php if ($_SESSION['is_login'] == 'true') { ?>
              <a href='#' class="btn login-btn" pull-rightid="a1" data-toggle="tab" onclick="return a1();" role="button">Save & Next</a>
            <?php } else { ?>
              <input type="submit" id="save_temp" name="save_temp" class="btn login-btn" onclick="return save1();" value="Save"></input> <?php } ?>
          </center>
        </div>

      </form>
    </div>
    <div id="educational" class="tab-pane fade" style="border: 1px solid #23297a;">
      <form id="educationalform" action="update2.php" method="post" enctype="multipart/form-data">
        <input name="app_id_edu" id="app_id_edu" type="hidden" class="form-control" value="<?php echo (isset($app_id)) ? $app_id : ''; ?>" />
        <table class="table table-hover">
          <thead>
            <th>No.</th>
            <th>Degree</th>
            <th>Specialization</th>
            <th>College/University/Institution</th>
            <th>Month and Year of Passing</th>
            <th>Percentage of marks obtained(%)</th>
            <th>Division/Grade</th>
            <th>Degree Certificate</th>
            <th></th>
          </thead>
          <?php
          if ($j_type == 'Permanent') {
            $query_edu1 = "select * from req_experience where status='OPEN' AND post='" . $post . "'";
          } else {
            $query_edu1 = "select * from req_experience where status='OPEN' AND post='" . $post . "' AND job_location='" . $joblocation . "'";
          }
          $result_edu1 = mysqli_query($link, $query_edu1);
          while ($row_edu1 = mysqli_fetch_array($result_edu1)) {
            $not_required1 = $row_edu1['Name'];
            $not_required2 = $row_edu1['post'];
            $bachelor_req = $row_edu1['bachelor_req'];
            $master_req = $row_edu1['master_req'];
            $phd_req = $row_edu1['phd_req'];
            $b_expr = $row_edu1['experience_for_bachelor'];
            $m_expr = $row_edu1['experience_for_master'];
            $p_expr = $row_edu1['experience_for_phd'];
          }
          ?>
          <input type="hidden" name="b_expr" value="<?php echo $b_expr; ?>"></input>
          <input type="hidden" name="m_expr" value="<?php echo $m_expr; ?>"></input>
          <input type="hidden" name="p_expr" value="<?php echo $p_expr; ?>"></input>
          <tbody>
            <tr style="display: none;">
              <td align="left">0.<font style='color:red'>*</font>
              </td>
              <td><input name="edu6" class="form-control" value="8th std" readonly="readonly" maxlength="45" size="30" type="text" /></td>
              <td><input name="speci6" class="form-control" maxlength="75" size="30" type="text" value="NA" readonly /></td>
              <td><input name="board6" class="form-control" maxlength="200" size="30" type="text" value="<?php echo isset($board6) ? "$board6" : ''; ?>" /></td>
              <td><input name="year6" class="form-control" maxlength="20" size="20" min="1982" max="2018" type="number" value="<?php echo isset($year6) ? "$year6" : ''; ?>" /></td>
              <td><input name="per6" class="form-control" maxlength="6" size="10" type="text" min="0" max="100" placeholder="00.00" value="<?php echo isset($per6) ? "$per6" : ''; ?>" /></td>
              <td>
                <select class="form-control" name="div6">
                  <option value="">Select Option</option>
                  <option value="First" <?php echo ($div6 == "First") ? 'selected' : ''; ?>>First</option>
                  <option value="Second" <?php echo ($div6 == "Second") ? 'selected' : ''; ?>>Second</option>
                  <option value="Pass" <?php echo ($div6 == "Pass") ? 'selected' : ''; ?>>Pass</option>
                </select>
              </td>
            </tr>

            <tr>
              <td align="left">1.<font style='color:red'>*</font>
              </td>
              <td><input name="edu1" class="form-control" required value="SSC" readonly="readonly" maxlength="45" size="30" type="text" /></td>
              <td><input name="speci1" class="form-control" required maxlength="75" size="30" type="text" value="NA" readonly /></td>
              <td><input name="board1" class="form-control" required maxlength="200" size="30" type="text" value="<?php echo isset($board1) ? "$board1" : ''; ?>" /></td>
              <td><input name="year1" id="year1" class="form-control" required maxlength="20" size="20" type="text" value="<?php echo isset($year1) ? "$year1" : ''; ?>" /></td>
              <td><input name="per1" class="form-control" required maxlength="6" size="10" type="text" min="0" max="100" placeholder="00.00" value="<?php echo isset($per1) ? "$per1" : ''; ?>" /></td>
              <td>
                <select class="form-control" required name="div1">
                  <option value="">Select Option</option>
                  <option value="Distinction" <?php echo ($div1 == "Distinction") ? 'selected' : ''; ?>>Distinction</option>
                  <option value="First" <?php echo ($div1 == "First") ? 'selected' : ''; ?>>First</option>
                  <option value="Second" <?php echo ($div1 == "Second") ? 'selected' : ''; ?>>Second</option>
                  <option value="Pass" <?php echo ($div1 == "Pass") ? 'selected' : ''; ?>>Pass</option>
                </select>
              </td>
              <?php
              if ($ssc_certi != '') {
                $style_ssc = "visibility: visible;";
              } else {
                $style_ssc = "visibility: hidden;";
              }
              ?>
              <td>
                <input type="file" name="ssc_certi" id="ssc_certi" <?php
                                                                    if ($ssc_certi == "") {
                                                                      echo "required";
                                                                    }
                                                                    ?>></input>
              </td>
              <td>
                <a href="<?php echo $ssc_certi; ?>" id="ssc_certi_view" style="<?php echo $style_ssc; ?>" target="_blank"><b><u>View</u> </b></a>
                <input type="hidden" id="ssc_certi1" name="ssc_certi1" value="<?php echo isset($val8) ? "$val8" : ""; ?>" />
              </td>
            </tr>



            <?php if ($post == "MTSAdmin-1-2025") { ?>
              <tr>
                <td align="left">1.1 <font style='color:red'><?php echo ($post == 'MTSAdmin-1-2025') ? '*' : ''; ?></font>
                </td>
                <td><input name="edu8" class="form-control" value="Comp. Certificate" readonly="readonly" maxlength="45" size="30" type="text" /></td>
                <td><input type="text" name="speci8" id="speci8" class="form-control" value="<?php echo isset($speci8) ? "$speci8" : ''; ?>" required></input></td>
                <!--<input name="speci2" class="form-control"  maxlength="75"  size="30" type="text" value="NA" readonly/>--></td>
                <td><input name="board8" class="form-control" maxlength="200" size="30" type="text" value="<?php echo isset($board8) ? "$board8" : ''; ?>" required /></td>
                <td width="20%"><input name="year8" id="year8" class="form-control" maxlength="20" type="text" size="20" value="<?php echo isset($year8) ? "$year8" : ''; ?>" required /></td>
                <td><input name="per8" class="form-control" maxlength="6" size="10" type="text" min="0" max="100" placeholder="00.00" value="<?php echo isset($per8) ? "$per8" : ''; ?>" required /></td>
                <td>
                  <select class="form-control" name="div8" required>
                    <option value="">Select Option</option>
                    <option value="Distinction" <?php echo ($div8 == "Distinction") ? 'selected' : ''; ?>>Distinction</option>
                    <option value="First" <?php echo ($div8 == "First") ? 'selected' : ''; ?>>First</option>
                    <option value="Second" <?php echo ($div8 == "Second") ? 'selected' : ''; ?>>Second</option>
                    <option value="Pass" <?php echo ($div8 == "Pass") ? 'selected' : ''; ?>>Pass</option>
                  </select>
                </td>
                <?php
                if ($comp_certi != '') {
                  $style_other_edu_certi = "visibility: visible;";
                } else {
                  $style_other_edu_certi = "visibility: hidden;";
                }
                ?>
                <td>
                  <input type="file" name="comp_certi" id="comp_certi" style="display:inline-block" <?php
                                                                                                    if ($comp_certi == "") {
                                                                                                      echo "required";
                                                                                                    } else {
                                                                                                      echo "";
                                                                                                    }
                                                                                                    ?>></input>
                </td>
                <td>
                  <a href="<?php echo $comp_certi; ?>" id="other_edu_certi_view" style="<?php echo $style_other_edu_certi; ?>" target="_blank"><b><u>View</u> </b></a>
                  <input type="hidden" id="other_edu_certi1" name="other_edu_certi1" value="<?php echo isset($comp_certi) ? "$comp_certi" : ""; ?>" />
                </td>
              </tr>
            <?php } ?>




            <tr>
              <td align="left">2.<font style='color:red'><?php echo ($post != 'STACS-1-2023' && $post != 'MTSAdmin-1-2025') ? '*' : ''; ?></font>
              </td>
              <td>
                <select class="form-control" name="edu2" <?php echo ($post != 'STACS-1-2023' && $post != 'MTSAdmin-1-2025') ? 'required' : ''; ?>>
                  <option value="">Select Degree</option>
                  <option value="HSC" <?php echo ($edu2 == 'HSC') ? "selected" : ""; ?>>HSC</option>
                  <option value="Diploma" <?php echo ($edu2 == 'Diploma') ? "selected" : ""; ?>>Diploma</option>
                </select>
              </td>
              <td>
                <select name="speci2" id="speci2" class="form-control" <?php echo ($post != 'STACS-1-2023' && $post != 'MTSAdmin-1-2025') ? 'required' : ''; ?>>
                  <option value="">Select Specialization</option>
                  <option value="Science" <?php echo ($speci2 == "Science") ? 'selected' : ''; ?>>Science</option>
                  <option value="Commerce" <?php echo ($speci2 == "Commerce") ? 'selected' : ''; ?>>Commerce</option>
                  <option value="Arts" <?php echo ($speci2 == "Arts") ? 'selected' : ''; ?>>Arts</option>
                  <option value="Diploma in CS/IT" <?php echo ($speci2 == "Diploma in CS/IT") ? 'selected' : ''; ?>>Diploma in CS/IT</option>
                </select>
              </td>
              <td><input name="board2" class="form-control" <?php echo ($post != 'STACS-1-2023' && $post != 'MTSAdmin-1-2025') ? 'required' : ''; ?> maxlength="200" size="30" type="text" value="<?php echo isset($board2) ? "$board2" : ''; ?>" /></td>
              <td width="20%"><input name="year2" id="year2" <?php echo ($post != 'STACS-1-2023' && $post != 'MTSAdmin-1-2025') ? 'required' : ''; ?> class="form-control" maxlength="20" type="text" size="20" value="<?php echo isset($year2) ? "$year2" : ''; ?>" onchange="check_hsc_date()" /></td>
              <td><input name="per2" class="form-control" <?php echo ($post != 'STACS-1-2023' && $post != 'MTSAdmin-1-2025') ? 'required' : ''; ?> maxlength="6" size="10" type="text" min="0" max="100" placeholder="00.00" value="<?php echo isset($per2) ? "$per2" : ''; ?>" /></td>
              <td>
                <select class="form-control" name="div2" <?php echo ($post != 'STACS-1-2023' && $post != 'MTSAdmin-1-2025') ? 'required' : ''; ?>>
                  <option value="">Select Option</option>
                  <option value="Distinction" <?php echo ($div2 == "Distinction") ? 'selected' : ''; ?>>Distinction</option>
                  <option value="First" <?php echo ($div2 == "First") ? 'selected' : ''; ?>>First</option>
                  <option value="Second" <?php echo ($div2 == "Second") ? 'selected' : ''; ?>>Second</option>
                  <option value="Pass" <?php echo ($div2 == "Pass") ? 'selected' : ''; ?>>Pass</option>
                </select>
              </td>
              <?php
              if ($hsc_certi != '') {
                $style_hsc = "visibility: visible;";
              } else {
                $style_hsc = "visibility: hidden;";
              }
              ?>
              <td>
                <input type="file" name="hsc_certi" id="hsc_certi" style="display:inline-block" <?php
                                                                                                if ($hsc_certi == "" && $post != "STACS-1-2023" && $post != "MTSAdmin-1-2025") {
                                                                                                  echo "required";
                                                                                                }
                                                                                                ?>></input>
              </td>
              <td>
                <a href="<?php echo $hsc_certi; ?>" id="hsc_certi_view" style="<?php echo $style_hsc; ?>" target="_blank"><b><u>View</u> </b></a>
                <input type="hidden" id="hsc_certi1" name="hsc_certi1" value="<?php echo isset($hsc_certi) ? "$hsc_certi" : ""; ?>" />
              </td>
            </tr>



            <?php if ($post == "STACS-1-2023") { ?>
              <tr>
                <td align="left">2.1 <font style='color:red'><?php echo ($post == 'STACS-1-2023') ? '*' : ''; ?></font>
                </td>
                <td><input name="edu7" class="form-control" value="DCA/Equivalent" readonly="readonly" maxlength="45" size="30" type="text" /></td>
                <td><input type="text" name="speci7" id="speci7" class="form-control" value="<?php echo isset($speci7) ? "$speci7" : ''; ?>" required></input></td>
                <!--<input name="speci2" class="form-control"  maxlength="75"  size="30" type="text" value="NA" readonly/>--></td>
                <td><input name="board7" class="form-control" maxlength="200" size="30" type="text" value="<?php echo isset($board7) ? "$board7" : ''; ?>" required /></td>
                <td width="20%"><input name="year7" id="year7" class="form-control" maxlength="20" type="text" size="20" value="<?php echo isset($year7) ? "$year7" : ''; ?>" required /></td>
                <td><input name="per7" class="form-control" maxlength="6" size="10" type="text" min="0" max="100" placeholder="00.00" value="<?php echo isset($per7) ? "$per7" : ''; ?>" required /></td>
                <td>
                  <select class="form-control" name="div7" required>
                    <option value="">Select Option</option>
                    <option value="Distinction" <?php echo ($div7 == "Distinction") ? 'selected' : ''; ?>>Distinction</option>
                    <option value="First" <?php echo ($div7 == "First") ? 'selected' : ''; ?>>First</option>
                    <option value="Second" <?php echo ($div7 == "Second") ? 'selected' : ''; ?>>Second</option>
                    <option value="Pass" <?php echo ($div7 == "Pass") ? 'selected' : ''; ?>>Pass</option>
                  </select>
                </td>
                <?php
                if ($other_edu_certi != '') {
                  $style_other_edu_certi = "visibility: visible;";
                } else {
                  $style_other_edu_certi = "visibility: hidden;";
                }
                ?>
                <td>
                  <input type="file" name="other_edu_certi" id="other_edu_certi" style="display:inline-block" <?php
                                                                                                              if ($other_edu_certi == "") {
                                                                                                                echo "required";
                                                                                                              } else {
                                                                                                                echo "";
                                                                                                              }
                                                                                                              ?>></input>
                </td>
                <td>
                  <a href="<?php echo $other_edu_certi; ?>" id="other_edu_certi_view" style="<?php echo $style_other_edu_certi; ?>" target="_blank"><b><u>View</u> </b></a>
                  <input type="hidden" id="other_edu_certi1" name="other_edu_certi1" value="<?php echo isset($other_edu_certi) ? "$other_edu_certi" : ""; ?>" />
                </td>
              </tr>
            <?php } ?>



            <tr>
              <td align="left">3.
                <?php if ($bachelor_req == 'Y') { ?>
                  <font style='color:red'>*</font>
                <?php } ?>
              </td>
              <td>
                <select class="form-control" name="edu3" <?php
                                                          if ($bachelor_req == 'Y') {
                                                            echo "required";
                                                          }
                                                          ?>>
                  <option value="">Select Degree </option>
                  <!--                                            <option value="Bachelors in Civil" <?php //echo ($edu3 == 'Bachelors in Civil') ? "selected" : "";
                                                                                                      ?>>Bachelors in Civil</option>
                                            <option value="Diploma in Civil" <?php //echo ($edu3 == 'Diploma in Civil') ? "selected" : "";
                                                                              ?>>Diploma in Civil</option>-->
                  <option value="Diploma in Computer Application" <?php echo ($edu3 == 'Diploma in Computer Application') ? "selected" : ""; ?>>Diploma in Computer Application</option>
                  <option value="Bachelors in CS/IT" <?php echo ($edu3 == 'Bachelors in CS/IT') ? "selected" : ""; ?>>Bachelors in CS/IT</option>
                  <option value="B.E. (CS/IT)" <?php echo ($edu3 == 'B.E. (CS/IT)') ? "selected" : ""; ?>>B.E. (CS/IT)</option>
                  <option value="B.Tech. (CS/IT)" <?php echo ($edu3 == 'B.Tech. (CS/IT)') ? "selected" : ""; ?>>B.Tech. (CS/IT) </option>
                  <option value="B.A./B.com/B.Sc." <?php echo ($edu3 == 'B.A./B.com/B.Sc.') ? "selected" : ""; ?>>B.A./B.Com/B.Sc.</option>
                  <option value="B.Lib./B.LISc." <?php echo ($edu3 == 'B.Lib./B.LISc.') ? "selected" : ""; ?>>B.Lib./B.LISc.</option>
                  <option value="Bachelors in Others" <?php echo ($edu3 == 'Bachelors in Others') ? "selected" : ""; ?>>Bachelors in Others</option>
                </select>
              </td>
              <td><input name="speci3" class="form-control" <?php
                                                            if ($bachelor_req == 'Y') {
                                                              echo "required";
                                                            }
                                                            ?> maxlength="75" size="30" type="text" value="<?php echo isset($speci3) ? "$speci3" : ''; ?>" /></td>
              <td><input name="board3" class="form-control" <?php
                                                            if ($bachelor_req == 'Y') {
                                                              echo "required";
                                                            }
                                                            ?> maxlength="200" size="30" type="text" value="<?php echo isset($board3) ? "$board3" : ''; ?>" /></td>
              <td><input name="year3" id="year3" class="form-control" <?php
                                                                      if ($bachelor_req == 'Y') {
                                                                        echo "required";
                                                                      }
                                                                      ?> maxlength="20" type="text" size="20" value="<?php echo isset($year3) ? "$year3" : ''; ?>" onchange="check_bachelor_date()" /></td>
              <td><input name="per3" class="form-control" <?php
                                                          if ($bachelor_req == 'Y') {
                                                            echo "required";
                                                          }
                                                          ?> maxlength="6" size="10" type="text" min="0" max="100" placeholder="00.00" value="<?php echo isset($per3) ? "$per3" : ''; ?>" /></td>
              <td>
                <select class="form-control" name="div3" <?php
                                                          if ($bachelor_req == 'Y') {
                                                            echo "required";
                                                          }
                                                          ?>>
                  <option value="">Select</option>
                  <option value="Distinction" <?php echo ($div3 == "Distinction") ? 'selected' : ''; ?>>Distinction</option>
                  <option value="First" <?php echo ($div3 == "First") ? 'selected' : ''; ?>>First</option>
                  <option value="Second" <?php echo ($div3 == "Second") ? 'selected' : ''; ?>>Second</option>
                  <option value="Pass" <?php echo ($div3 == "Pass") ? 'selected' : ''; ?>>Pass</option>
                </select>
              </td>
              <?php
              if ($bachelor_certi != '') {
                $style_bachelor_certi = "visibility: visible;";
              } else {
                $style_bachelor_certi = "visibility: hidden;";
              }
              ?>
              <td>
                <input type="file" name="bachelor_certi" id="bachelor_certi" <?php
                                                                              if ($bachelor_req == 'Y' && $bachelor_certi == "") {
                                                                                echo "required";
                                                                              }
                                                                              ?>></input>
              </td>
              <td>
                <a href="<?php echo $bachelor_certi; ?>" id="bachelor_certi_view" style="<?php echo $style_bachelor_certi; ?>" target="_blank"><b><u>View</u></b></a>
                <input type="hidden" id="bachelor_certi1" name="bachelor_certi1" value="<?php echo isset($bachelor_certi) ? "$bachelor_certi" : ""; ?>" />
              </td>
            </tr>

            <tr>
              <td align="left">4.
                <?php if ($master_req == 'Y') { ?>
                  <font style='color:red'>*</font>
                <?php } ?>
              </td>
              <td>
                <select class="form-control" name="edu4" id="edu4" <?php
                                                                    if ($master_req == 'Y') {
                                                                      echo "required";
                                                                    }
                                                                    ?>>
                  <option value="">Select Degree</option>
                  <!--<option value="Masters in Civil" <?php //echo ($edu4 == 'Masters in Civil') ? "selected" : "";
                                                        ?>>Masters in Civil</option>-->
                  <option value="MBA" <?php echo ($edu4 == 'MBA') ? "selected" : ""; ?>>MBA</option>
                  <option value="Masters in CS/IT" <?php echo ($edu4 == 'Masters in CS/IT') ? "selected" : ""; ?>>Masters in CS/IT</option>
                  <option value="M.Tech. (CS/IT)" <?php echo ($edu4 == 'M.Tech. (CS/IT)') ? "selected" : ""; ?>>M.Tech. (CS/IT)</option>
                  <option value="M.Sc. (CS/IT)" <?php echo ($edu4 == 'M.Sc. (CS/IT)') ? "selected" : ""; ?>>M.Sc. (CS/IT)</option>
                  <option value="M.Lib./M.LISc." <?php echo ($edu4 == 'M.Lib./M.LISc.') ? "selected" : ""; ?>>M.Lib./M.LISc.</option>
                  <option value="MCA" <?php echo ($edu4 == 'MCA') ? "selected" : ""; ?>>MCA</option>
                  <option value="Masters in Others" <?php echo ($edu4 == 'Masters in Others') ? "selected" : ""; ?>>Masters in Others</option>
                </select>
              </td>
              <td><input name="speci4" class="form-control" <?php
                                                            if ($master_req == 'Y') {
                                                              echo "required";
                                                            }
                                                            ?> maxlength="75" size="30" type="text" value="<?php echo isset($speci4) ? "$speci4" : ''; ?>" /></td>
              <td><input name="board4" class="form-control" <?php
                                                            if ($master_req == 'Y') {
                                                              echo "required";
                                                            }
                                                            ?> maxlength="200" size="30" type="text" value="<?php echo isset($board4) ? "$board4" : ''; ?>" /></td>
              <td><input name="year4" id="year4" class="form-control" <?php
                                                                      if ($master_req == 'Y') {
                                                                        echo "required";
                                                                      }
                                                                      ?> maxlength="20" type="text" size="20" value="<?php echo isset($year4) ? "$year4" : ''; ?>" onchange="check_master_date()" /></td>
              <td><input name="per4" class="form-control" <?php
                                                          if ($master_req == 'Y') {
                                                            echo "required";
                                                          }
                                                          ?> maxlength="6" size="10" type="text" min="0" max="100" placeholder="00.00" value="<?php echo isset($per4) ? "$per4" : ''; ?>" /></td>
              <td>
                <select class="form-control" name="div4" <?php
                                                          if ($master_req == 'Y') {
                                                            echo "required";
                                                          }
                                                          ?>>
                  <option value="">Select</option>
                  <option value="Distinction" <?php echo ($div4 == "Distinction") ? 'selected' : ''; ?>>Distinction</option>
                  <option value="First" <?php echo ($div4 == "First") ? 'selected' : ''; ?>>First</option>
                  <option value="Second" <?php echo ($div4 == "Second") ? 'selected' : ''; ?>>Second</option>
                  <option value="Pass" <?php echo ($div4 == "Pass") ? 'selected' : ''; ?>>Pass</option>
                </select>
              </td>
              <?php
              if ($master_certi != '') {
                $style_master_certi = "visibility: visible;";
              } else {
                $style_master_certi = "visibility: hidden;";
              }
              ?>
              <td>
                <input type="file" name="master_certi" id="master_certi" <?php
                                                                          if ($master_req == 'Y' && $master_certi == "") {
                                                                            echo "required";
                                                                          }
                                                                          ?>></input>
              </td>
              <td>
                <a href="<?php echo $master_certi; ?>" id="master_certi_view" style="<?php echo $style_master_certi; ?>" target="_blank"><b><u>View</u> </b></a>
                <input type="hidden" id="master_certi1" name="master_certi1" value="<?php echo isset($master_certi) ? "$master_certi" : ""; ?>" />
              </td>
            </tr>

            <tr>
              <td align="left">5.
                <?php if ($phd_req == 'Y') { ?>
                  <font style='color:red'>*</font>
                <?php } ?>
              </td>
              <td>
                <select class="form-control" name="edu5" <?php
                                                          if ($phd_req == 'Y') {
                                                            echo "required";
                                                          }
                                                          ?>>
                  <option value="">Select Qualifying Degree</option>
                  <option value="Ph.D." <?php echo ($edu5 == 'Ph.D.') ? "selected" : ""; ?>>Ph.D.</option>
                  <option value="M.Phil" <?php echo ($edu5 == 'M.Phil') ? "selected" : ""; ?>>M.Phil</option>
                  <option value="Other" <?php echo ($edu5 == 'Other') ? "selected" : ""; ?>>Other</option>
                </select>
              </td>
              <td><input name="speci5" class="form-control" <?php
                                                            if ($phd_req == 'Y') {
                                                              echo "required";
                                                            }
                                                            ?> maxlength="75" size="30" type="text" value="<?php echo isset($speci5) ? "$speci5" : ''; ?>" /></td>
              <td><input name="board5" class="form-control" <?php
                                                            if ($phd_req == 'Y') {
                                                              echo "required";
                                                            }
                                                            ?> maxlength="200" size="30" type="text" value="<?php echo isset($board5) ? "$board5" : ''; ?>" /></td>
              <td><input name="year5" id="year5" class="form-control" <?php
                                                                      if ($phd_req == 'Y') {
                                                                        echo "required";
                                                                      }
                                                                      ?> maxlength="20" size="20" type="text" value="<?php echo isset($year5) ? "$year5" : ''; ?>" /></td>
              <td><input name="per5" class="form-control" <?php
                                                          if ($phd_req == 'Y') {
                                                            echo "required";
                                                          }
                                                          ?> maxlength="6" size="10" type="text" placeholder="NA" value="<?php echo isset($per5) ? "$per5" : ''; ?>" /></td>
              <td>
                <select class="form-control" name="div5" <?php
                                                          if ($phd_req == 'Y') {
                                                            echo "required";
                                                          }
                                                          ?>>
                  <option value="">Select</option>
                  <option value="Distinction" <?php echo ($div5 == "Distinction") ? 'selected' : ''; ?>>Distinction</option>
                  <option value="First" <?php echo ($div5 == "First") ? 'selected' : ''; ?>>First</option>
                  <option value="Second" <?php echo ($div5 == "Second") ? 'selected' : ''; ?>>Second</option>
                  <option value="Pass" <?php echo ($div5 == "Pass") ? 'selected' : ''; ?>>Pass</option>
                </select>
              </td>
              <?php
              if ($phd_certi != '') {
                $style_phd_certi = "visibility: visible;";
              } else {
                $style_phd_certi = "visibility: hidden;";
              }
              ?>
              <td>
                <input type="file" name="phd_certi" id="phd_certi" <?php
                                                                    if ($phd_req == 'Y') {
                                                                      echo "required";
                                                                    }
                                                                    ?>></input>
              </td>
              <td>
                <a href="<?php echo $phd_certi; ?>" id="phd_certi_view" style="<?php echo $style_phd_certi; ?>" target="_blank"><b><u>View</u> </b></a>
                <input type="hidden" id="phd_certi1" name="phd_certi1" value="<?php echo isset($phd_certi) ? "$phd_certi" : ""; ?>" />
              </td>
            </tr>

            <tr>
              <td colspan="2">
                <a href='#' id="prev1" data-toggle="tab" onclick="return prev_to1();" role="button" class="btn login-btn">
                  << Previous</a>
              </td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td>

              </td>
              <td colspan="2">
                <!-- <div class="clearfix"></div> -->



                <div class=" btn-toolbar">
                  <a href="#" id="a2" data-toggle="tab" onclick="return a2();" role="button" class="btn login-btn pull-right">Save & Next</a>
                </div>
              </td>
              <td></td>
            </tr>

          </tbody>
        </table>
        <div class="col-xs-6">
          <br />
          <label for="captcha_code_e" style="text-align:left">Enter Captcha :</label>
          <img id="captcha_img_e" src="captcha_e.php" alt="CAPTCHA" height="40" width="100" />
          <a href='javascript: refresh_captcha_e();'>
            <img src="images/refresh.png" height="40" width="40" alt="Refresh Captcha" />
          </a>
          <input type="text" id="captcha_code_e" name="captcha_code_e" class="fullname" placeholder="Enter captcha here" autocomplete="off" style="width:30%" required />
        </div>
      </form>
    </div>

    <div id="experience" class="tab-pane fade" style="border: 1px solid #23297a;">
      <form id="expform" action="update3.php" method="post" enctype="multipart/form-data">
        <input name="app_id_expr" id="app_id_expr" type="hidden" class="form-control" value="<?php echo (isset($app_id)) ? $app_id : ''; ?>" />
        <span><strong style="padding:10px; color:#ff7171;">Note:(Details of previous and present employment held, if any, in chronological order starting from present position)</strong></span>
        </br><b><span id="message" style="padding:10px;color:red"></span></b>
        <table class="table table-hover" id="expr_table">
          <thead>
            <th>Sr.no</th>
            <th>Name of the Organisation </th>
            <th>Position Held</th>
            <th>From (DD/MM/YYYY)</th>
            <th>To (DD/MM/YYYY)</th>
            <th>Experience</th>
            <th>Nature of Duties</th>
            <th>Pay Scale/Gross Salary Rs</th>
            <th>Type of Organisation</th>
            <th>Experience Certificate</th>
          </thead>
          <tbody id="add_more_rows">
            <tr>
              <td>1.</td>
              <td><input name="org1" id="org1" class="form-control org" maxlength="200" size="30" type="text" value="<?php echo isset($org1) ? "$org1" : ''; ?>" /></td>
              <td><input name="pos1" id="pos1" class="form-control" maxlength="100" size="30" type="text" value="<?php echo isset($pos1) ? "$pos1" : ''; ?>" /></td>
              <td><input data-myID="diff1" name="from1" id="from1" class="form-control fromdt" type="text" readonly style="background: #FFFFFF;" value="<?php echo isset($from1) ? $from1 : ''; ?>" /></td>
              <td><input type="checkbox" name="current_working" id="current_working" <?php echo $currently_working == 'Yes' ? "checked" : "" ?>> Currently Working</input>
                <input data-myID="diff1" name="to1" id="to1" class="form-control todt" maxlength="10" size="10" type="text" readonly style="background: #FFFFFF;" value="<?php echo isset($to1) ? "$to1" : ''; ?>" />
              </td>
              <td><input type="text" readonly id="diff1" name="exp1" class="form-control" value="<?php echo isset($exp1) ? "$exp1" : ''; ?>" /></td>
              <td><input id="nature1" name="nature1" class="form-control" maxlength="200" size="30" type="text" value="<?php echo isset($nature1) ? "$nature1" : ''; ?>" /></td>
              <td><input name="pay1" id="pay1" class="form-control" maxlength="50" size="50" type="text" value="<?php echo isset($pay1) ? "$pay1" : ''; ?>" /></td>
              <td>
                <select class="form-control" name="otype1" id="otype1">
                  <option value="">Select</option>
                  <option value="Central Government" <?php echo ($otype1 == "Central Government") ? 'selected' : ''; ?>>Central Government</option>
                  <option value="State Government" <?php echo ($otype1 == "State Government") ? 'selected' : ''; ?>>State Government</option>
                  <option value="Autonomous Body" <?php echo ($otype1 == "Autonomous Body") ? 'selected' : ''; ?>>Autonomous Body</option>
                  <option value="University/Colleges" <?php echo ($otype1 == "University/Colleges") ? 'selected' : ''; ?>>University/Colleges</option>
                  <option value="Private" <?php echo ($otype1 == "Private") ? 'selected' : ''; ?>>Private</option>
                  <option value="Other" <?php echo ($otype1 == "Other") ? 'selected' : ''; ?>>Other</option>
                </select>
              </td>
              <td><input type="file" name="exp_file1" id="exp_file1"></input>
                <?php
                if ($exp_file1 != '') {
                  $style_exp_file1 = "visibility: visible;";
                } else {
                  $style_exp_file1 = "visibility: hidden;";
                }
                ?>
                <a href="<?php echo $exp_file1; ?>" id="exp_file1_view" style="<?php echo $style_exp_file1; ?>" target="_blank"><b><u>View File</u> </b></a>
                <input type="hidden" id="exp_file1_1" name="exp_file1_1" value="<?php echo isset($exp_file1) ? "$exp_file1" : ""; ?>" />
              </td>
            </tr>
            <tr>
              <td>2.</td>
              <td><input name="org2" id="org2" class="form-control org" maxlength="200" size="30" type="text" value="<?php echo isset($org2) ? "$org2" : ''; ?>" /></td>
              <td><input name="pos2" id="pos2" class="form-control" maxlength="100" size="30" type="text" value="<?php echo isset($pos2) ? "$pos2" : ''; ?>" /></td>
              <td><input data-myID="diff2" name="from2" id="from2" class="form-control fromdt" maxlength="10" readonly size="10" type="text" style="background: #FFFFFF;" value="<?php echo isset($from2) ? "$from2" : ''; ?>" /></td>
              <td><input data-myID="diff2" name="to2" id="to2" class="form-control todt" maxlength="10" readonly size="10" type="text" style="background: #FFFFFF;" value="<?php echo isset($to2) ? "$to2" : ''; ?>" /></td>
              <td><input type="text" readonly id="diff2" name="exp2" class="form-control" value="<?php echo isset($exp2) ? "$exp2" : ''; ?>" /></td>
              <td><input id="nature2" name="nature2" class="form-control" maxlength="200" size="30" type="text" value="<?php echo isset($nature2) ? "$nature2" : ''; ?>" /></td>
              <td><input name="pay2" id="pay2" class="form-control" maxlength="50" size="50" type="text" value="<?php echo isset($pay2) ? "$pay2" : ''; ?>" /></td>
              <td>
                <select class="form-control" name="otype2" id="otype2">
                  <option value="">Select</option>
                  <option value="Central Government" <?php echo ($otype2 == "Central Government") ? 'selected' : ''; ?>>Central Government</option>
                  <option value="State Government" <?php echo ($otype2 == "State Government") ? 'selected' : ''; ?>>State Government</option>
                  <option value="Autonomous Body" <?php echo ($otype2 == "Autonomous Body") ? 'selected' : ''; ?>>Autonomous Body</option>
                  <option value="University/Colleges" <?php echo ($otype2 == "University/Colleges") ? 'selected' : ''; ?>>University/Colleges</option>
                  <option value="Private" <?php echo ($otype2 == "Private") ? 'selected' : ''; ?>>Private</option>
                  <option value="Other" <?php echo ($otype2 == "Other") ? 'selected' : ''; ?>>Other</option>
                </select>
              </td>
              <td><input type="file" name="exp_file2" id="exp_file2" style="display:inline-block"></input>
                <?php
                if ($exp_file2 != '') {
                  $style_exp_file2 = "visibility: visible;";
                } else {
                  $style_exp_file2 = "visibility: hidden;";
                }
                ?>
                <a href="<?php echo $exp_file2; ?>" id="exp_file2_view" style="<?php echo $style_exp_file2; ?>" target="_blank"><b><u>View File</u> </b></a>
                <input type="hidden" id="exp_file2_1" name="exp_file2_1" value="<?php echo isset($exp_file2) ? "$exp_file2" : ""; ?>" />
              </td>
            </tr>
            <tr>
              <td>3.</td>
              <td><input name="org3" id="org3" class="form-control org" maxlength="200" size="30" type="text" value="<?php echo isset($org3) ? "$org3" : ''; ?>" /></td>
              <td><input name="pos3" id="pos3" class="form-control" maxlength="100" size="30" type="text" value="<?php echo isset($pos3) ? "$pos3" : ''; ?>" /></td>
              <td><input data-myID="diff3" name="from3" id="from3" class="form-control fromdt" maxlength="10" size="10" type="text" readonly style="background: #FFFFFF;" value="<?php echo isset($from3) ? "$from3" : ''; ?>" /></td>
              <td><input data-myID="diff3" name="to3" id="to3" class="form-control todt" maxlength="10" size="10" type="text" readonly style="background: #FFFFFF;" value="<?php echo isset($to3) ? "$to3" : ''; ?>" /></td>
              <td><input type="text" readonly id="diff3" name="exp3" class="form-control" value="<?php echo isset($exp3) ? "$exp3" : ''; ?>" /></td>
              <td><input id="nature3" name="nature3" class="form-control" maxlength="200" size="30" type="text" value="<?php echo isset($nature3) ? "$nature3" : ''; ?>" /></td>
              <td><input name="pay3" id="pay3" class="form-control" maxlength="50" size="50" type="text" value="<?php echo isset($pay3) ? "$pay3" : ''; ?>" /></td>
              <td>
                <select class="form-control" name="otype3" id="otype3">
                  <option value="">Select</option>
                  <option value="Central Government" <?php echo ($otype3 == "Central Government") ? 'selected' : ''; ?>>Central Government</option>
                  <option value="State Government" <?php echo ($otype3 == "State Government") ? 'selected' : ''; ?>>State Government</option>
                  <option value="Autonomous Body" <?php echo ($otype3 == "Autonomous Body") ? 'selected' : ''; ?>>Autonomous Body</option>
                  <option value="University/Colleges" <?php echo ($otype3 == "University/Colleges") ? 'selected' : ''; ?>>University/Colleges</option>
                  <option value="Private" <?php echo ($otype3 == "Private") ? 'selected' : ''; ?>>Private</option>
                  <option value="Other" <?php echo ($otype3 == "Other") ? 'selected' : ''; ?>>Other</option>
                </select>
              </td>
              <td><input type="file" name="exp_file3" id="exp_file3"></input>
                <?php
                if ($exp_file3 != '') {
                  $style_exp_file3 = "visibility: visible;";
                } else {
                  $style_exp_file3 = "visibility: hidden;";
                }
                ?>
                <a href="<?php echo $exp_file3; ?>" id="exp_file3_view" style="<?php echo $style_exp_file3; ?>" target="_blank"><b><u>View File</u> </b></a>
                <input type="hidden" id="exp_file3_1" name="exp_file3_1" value="<?php echo isset($exp_file) ? "$exp_file" : ""; ?>" />
              </td>
            </tr>
            <tr>
              <td>4.</td>
              <td><input name="org4" id="org4" class="form-control org" maxlength="200" size="30" type="text" value="<?php echo isset($org4) ? "$org4" : ''; ?>" /></td>
              <td><input name="pos4" id="pos4" class="form-control" maxlength="100" size="30" type="text" value="<?php echo isset($pos4) ? "$pos4" : ''; ?>" /></td>
              <td><input data-myID="diff4" name="from4" id="from4" class="form-control fromdt" maxlength="10" size="10" type="text" readonly style="background: #FFFFFF;" value="<?php echo isset($from4) ? "$from4" : ''; ?>" /></td>
              <td><input data-myID="diff4" name="to4" id="to4" class="form-control todt" maxlength="10" size="10" type="text" readonly style="background: #FFFFFF;" value="<?php echo isset($to4) ? "$to4" : ''; ?>" /></td>
              <td><input type="text" readonly id="diff4" name="exp4" class="form-control" value="<?php echo isset($exp4) ? "$exp4" : ''; ?>" /></td>
              <td><input id="nature4" name="nature4" class="form-control" maxlength="200" size="30" type="text" value="<?php echo isset($nature4) ? "$nature4" : ''; ?>" /></td>
              <td><input name="pay4" id="pay4" class="form-control" maxlength="50" size="50" type="text" value="<?php echo isset($pay4) ? "$pay4" : ''; ?>" /></td>
              <td>
                <select class="form-control" name="otype4" id="otype4">
                  <option value="">Select</option>
                  <option value="Central Government" <?php echo ($otype4 == "Central Government") ? 'selected' : ''; ?>>Central Government</option>
                  <option value="State Government" <?php echo ($otype4 == "State Government") ? 'selected' : ''; ?>>State Government</option>
                  <option value="Autonomous Body" <?php echo ($otype4 == "Autonomous Body") ? 'selected' : ''; ?>>Autonomous Body</option>
                  <option value="University/Colleges" <?php echo ($otype4 == "University/Colleges") ? 'selected' : ''; ?>>University/Colleges</option>
                  <option value="Private" <?php echo ($otype4 == "Private") ? 'selected' : ''; ?>>Private</option>
                  <option value="Other" <?php echo ($otype4 == "Other") ? 'selected' : ''; ?>>Other</option>
                </select>
              </td>
              <td><input type="file" name="exp_file4" id="exp_file4"></input>
                <?php
                if ($exp_file4 != '') {
                  $style_exp_file4 = "visibility: visible;";
                } else {
                  $style_exp_file4 = "visibility: hidden;";
                }
                ?>
                <a href="<?php echo $exp_file4; ?>" id="exp_file4_view" style="<?php echo $style_exp_file4; ?>" target="_blank"><b><u>View File</u> </b></a>
                <input type="hidden" id="exp_file4_1" name="exp_file4_1" value="<?php echo isset($exp_file4) ? "$exp_file4" : ""; ?>" />
              </td>
            </tr>
            <tr>
              <td>5.</td>
              <td><input name="org5" id="org5" class="form-control org" maxlength="200" size="30" type="text" value="<?php echo isset($org5) ? "$org5" : ''; ?>" /></td>
              <td><input name="pos5" id="pos5" class="form-control" maxlength="100" size="30" type="text" value="<?php echo isset($pos5) ? "$pos5" : ''; ?>" /></td>
              <td><input data-myID="diff5" name="from5" id="from5" class="form-control fromdt" maxlength="10" size="10" type="text" readonly style="background: #FFFFFF;" value="<?php echo isset($from5) ? "$from5" : ''; ?>" /></td>
              <td><input data-myID="diff5" name="to5" id="to5" class="form-control todt" maxlength="10" size="10" type="text" readonly style="background: #FFFFFF;" value="<?php echo isset($to5) ? "$to5" : ''; ?>" /></td>
              <td><input type="text" readonly id="diff5" name="exp5" class="form-control" value="<?php echo isset($exp5) ? "$exp5" : ''; ?>" /></td>
              <td><input id="nature5" name="nature5" class="form-control" maxlength="200" size="30" type="text" value="<?php echo isset($nature5) ? "$nature5" : ''; ?>" /></td>
              <td><input name="pay5" id="pay5" class="form-control" maxlength="50" size="50" type="text" value="<?php echo isset($pay5) ? "$pay5" : ''; ?>" /></td>
              <td>
                <select class="form-control" name="otype5" id="otype5">
                  <option value="">Select</option>
                  <option value="Central Government" <?php echo ($otype5 == "Central Government") ? 'selected' : ''; ?>>Central Government</option>
                  <option value="State Government" <?php echo ($otype5 == "State Government") ? 'selected' : ''; ?>>State Government</option>
                  <option value="Autonomous Body" <?php echo ($otype5 == "Autonomous Body") ? 'selected' : ''; ?>>Autonomous Body</option>
                  <option value="University/Colleges" <?php echo ($otype5 == "University/Colleges") ? 'selected' : ''; ?>>University/Colleges</option>
                  <option value="Private" <?php echo ($otype5 == "Private") ? 'selected' : ''; ?>>Private</option>
                  <option value="Other" <?php echo ($otype5 == "Other") ? 'selected' : ''; ?>>Other</option>
                </select>
              </td>
              <td><input type="file" name="exp_file5" id="exp_file5"></input>
                <?php
                if ($exp_file5 != '') {
                  $style_exp_file5 = "visibility: visible;";
                } else {
                  $style_exp_file5 = "visibility: hidden;";
                }
                ?>
                <a href="<?php echo $exp_file5; ?>" id="exp_file5_view" style="<?php echo $style_exp_file5; ?>" target="_blank"><b><u>View File</u> </b></a>
                <input type="hidden" id="exp_file5_1" name="exp_file5_1" value="<?php echo isset($exp_file5) ? "$exp_file5" : ""; ?>" />
              </td>
            </tr>
            <?php if (isset($org6) && $org6 != '') {
            ?>
              <tr>
                <td>6.</td>
                <td><input name="org6" id="org6" class="form-control org" maxlength="200" size="30" type="text" value="<?php echo isset($org6) ? "$org6" : ''; ?>" /></td>
                <td><input name="pos6" id="pos6" class="form-control" maxlength="100" size="30" type="text" value="<?php echo isset($pos6) ? "$pos6" : ''; ?>" /></td>
                <td><input data-myID="diff6" name="from6" id="from6" class="form-control fromdt" maxlength="10" size="10" type="text" readonly style="background: #FFFFFF;" value="<?php echo isset($from6) ? $from6 : ''; ?>" /></td>
                <td><input data-myID="diff6" name="to6" id="to6" class="form-control todt" maxlength="10" size="10" type="text" readonly style="background: #FFFFFF;" value="<?php echo isset($to6) ? "$to6" : ''; ?>" /></td>
                <td><input type="text" readonly id="diff6" name="exp6" class="form-control" value="<?php echo isset($exp6) ? "$exp6" : ''; ?>" /></td>
                <td><input id="nature6" name="nature6" class="form-control" maxlength="200" size="30" type="text" value="<?php echo isset($nature6) ? "$nature6" : ''; ?>" /></td>
                <td><input name="pay6" id="pay6" class="form-control" maxlength="50" size="50" type="text" value="<?php echo isset($pay6) ? "$pay6" : ''; ?>" /></td>
                <td>
                  <select class="form-control" name="otype6" id="otype6">
                    <option value="">Select</option>
                    <option value="Central Government" <?php echo ($otype6 == "Central Government") ? 'selected' : ''; ?>>Central Government</option>
                    <option value="State Government" <?php echo ($otype6 == "State Government") ? 'selected' : ''; ?>>State Government</option>
                    <option value="Autonomous Body" <?php echo ($otype6 == "Autonomous Body") ? 'selected' : ''; ?>>Autonomous Body</option>
                    <option value="University/Colleges" <?php echo ($otype6 == "University/Colleges") ? 'selected' : ''; ?>>University/Colleges</option>
                    <option value="Private" <?php echo ($otype6 == "Private") ? 'selected' : ''; ?>>Private</option>
                    <option value="Other" <?php echo ($otype6 == "Other") ? 'selected' : ''; ?>>Other</option>
                  </select>
                </td>
                <td><input type="file" name="exp_file6" id="exp_file6"></input>
                  <?php
                  if ($exp_file6 != '') {
                    $style_exp_file6 = "visibility: visible;";
                  } else {
                    $style_exp_file6 = "visibility: hidden;";
                  }
                  ?>
                  <a href="<?php echo $exp_file6; ?>" id="exp_file6_view" style="<?php echo $style_exp_file6; ?>" target="_blank"><b><u>View File</u> </b></a>
                  <input type="hidden" id="exp_file6" name="exp_file6" value="<?php echo isset($exp_file6) ? "$exp_file6" : ""; ?>" />
                </td>
              </tr>
            <?php } ?>
            <?php if (isset($org7) && $org7 != '') {
            ?>
              <tr>
                <td>7.</td>
                <td><input name="org7" id="org7" class="form-control org" maxlength="200" size="30" type="text" value="<?php echo isset($org7) ? "$org7" : ''; ?>" /></td>
                <td><input name="pos7" id="pos7" class="form-control" maxlength="100" size="30" type="text" value="<?php echo isset($pos7) ? "$pos7" : ''; ?>" /></td>
                <td><input data-myID="diff7" name="from7" id="from7" class="form-control fromdt" maxlength="10" size="10" type="text" readonly style="background: #FFFFFF;" value="<?php echo isset($from7) ? $from7 : ''; ?>" /></td>
                <td><input data-myID="diff7" name="to7" id="to7" class="form-control todt" maxlength="10" size="10" type="text" readonly style="background: #FFFFFF;" value="<?php echo isset($to7) ? "$to7" : ''; ?>" /></td>
                <td><input type="text" readonly id="diff7" name="exp7" class="form-control" value="<?php echo isset($exp7) ? "$exp7" : ''; ?>" /></td>
                <td><input id="nature7" name="nature7" class="form-control" maxlength="200" size="30" type="text" value="<?php echo isset($nature7) ? "$nature7" : ''; ?>" /></td>
                <td><input name="pay7" id="pay7" class="form-control" maxlength="50" size="50" type="text" value="<?php echo isset($pay7) ? "$pay7" : ''; ?>" /></td>
                <td>
                  <select class="form-control" name="otype7" id="otype7">
                    <option value="">Select</option>
                    <option value="Central Government" <?php echo ($otype7 == "Central Government") ? 'selected' : ''; ?>>Central Government</option>
                    <option value="State Government" <?php echo ($otype7 == "State Government") ? 'selected' : ''; ?>>State Government</option>
                    <option value="Autonomous Body" <?php echo ($otype7 == "Autonomous Body") ? 'selected' : ''; ?>>Autonomous Body</option>
                    <option value="University/Colleges" <?php echo ($otype7 == "University/Colleges") ? 'selected' : ''; ?>>University/Colleges</option>
                    <option value="Private" <?php echo ($otype7 == "Private") ? 'selected' : ''; ?>>Private</option>
                    <option value="Other" <?php echo ($otype7 == "Other") ? 'selected' : ''; ?>>Other</option>
                  </select>
                </td>
                <td><input type="file" name="exp_file7" id="exp_file7"></input>
                  <?php
                  if ($exp_file7 != '') {
                    $style_exp_file7 = "visibility: visible;";
                  } else {
                    $style_exp_file7 = "visibility: hidden;";
                  }
                  ?>
                  <a href="<?php echo $exp_file7; ?>" id="exp_file7_view" style="<?php echo $style_exp_file7; ?>" target="_blank"><b><u>View File</u> </b></a>
                  <input type="hidden" id="exp_file7" name="exp_file7" value="<?php echo isset($exp_file7) ? "$exp_file7" : ""; ?>" />
                </td>
              </tr>
            <?php } ?>
            <?php if (isset($org8) && $org8 != '') {
            ?>
              <tr>
                <td>8.</td>
                <td><input name="org8" id="org8" class="form-control org" maxlength="200" size="30" type="text" value="<?php echo isset($org8) ? "$org8" : ''; ?>" /></td>
                <td><input name="pos8" id="pos8" class="form-control" maxlength="100" size="30" type="text" value="<?php echo isset($pos8) ? "$pos8" : ''; ?>" /></td>
                <td><input data-myID="diff8" name="from8" id="from8" class="form-control fromdt" maxlength="10" size="10" type="text" readonly style="background: #FFFFFF;" value="<?php echo isset($from8) ? $from8 : ''; ?>" /></td>
                <td><input data-myID="diff8" name="to8" id="to8" class="form-control todt" maxlength="10" size="10" type="text" readonly style="background: #FFFFFF;" value="<?php echo isset($to8) ? "$to8" : ''; ?>" /></td>
                <td><input type="text" readonly id="diff8" name="exp8" class="form-control" value="<?php echo isset($exp8) ? "$exp8" : ''; ?>" /></td>
                <td><input id="nature8" name="nature8" class="form-control" maxlength="200" size="30" type="text" value="<?php echo isset($nature8) ? "$nature8" : ''; ?>" /></td>
                <td><input name="pay8" id="pay8" class="form-control" maxlength="50" size="50" type="text" value="<?php echo isset($pay8) ? "$pay8" : ''; ?>" /></td>
                <td>
                  <select class="form-control" name="otype8" id="otype8">
                    <option value="">Select</option>
                    <option value="Central Government" <?php echo ($otype8 == "Central Government") ? 'selected' : ''; ?>>Central Government</option>
                    <option value="State Government" <?php echo ($otype8 == "State Government") ? 'selected' : ''; ?>>State Government</option>
                    <option value="Autonomous Body" <?php echo ($otype8 == "Autonomous Body") ? 'selected' : ''; ?>>Autonomous Body</option>
                    <option value="University/Colleges" <?php echo ($otype8 == "University/Colleges") ? 'selected' : ''; ?>>University/Colleges</option>
                    <option value="Private" <?php echo ($otype8 == "Private") ? 'selected' : ''; ?>>Private</option>
                    <option value="Other" <?php echo ($otype8 == "Other") ? 'selected' : ''; ?>>Other</option>
                  </select>
                </td>
                <td><input type="file" name="exp_file8" id="exp_file8"></input>
                  <?php
                  if ($exp_file8 != '') {
                    $style_exp_file8 = "visibility: visible;";
                  } else {
                    $style_exp_file8 = "visibility: hidden;";
                  }
                  ?>
                  <a href="<?php echo $exp_file8; ?>" id="exp_file8_view" style="<?php echo $style_exp_file8; ?>" target="_blank"><b><u>View File</u> </b></a>
                  <input type="hidden" id="exp_file8" name="exp_file8" value="<?php echo isset($exp_file8) ? "$exp_file8" : ""; ?>" />
                </td>
              </tr>
            <?php } ?>
            <?php if (isset($org9) && $org9 != '') {
            ?>
              <tr>
                <td>9.</td>
                <td><input name="org9" id="org9" class="form-control org" maxlength="200" size="30" type="text" value="<?php echo isset($org9) ? "$org9" : ''; ?>" /></td>
                <td><input name="pos9" id="pos9" class="form-control" maxlength="100" size="30" type="text" value="<?php echo isset($pos9) ? "$pos9" : ''; ?>" /></td>
                <td><input data-myID="diff9" name="from9" id="from9" class="form-control fromdt" type="text" maxlength="10" size="10" type="text" readonly style="background: #FFFFFF;" value="<?php echo isset($from9) ? $from9 : ''; ?>" /></td>
                <td><input data-myID="diff9" name="to9" id="to9" class="form-control todt" maxlength="10" size="10" type="text" readonly style="background: #FFFFFF;" value="<?php echo isset($to9) ? "$to9" : ''; ?>" /></td>
                <td><input type="text" readonly id="diff9" name="exp9" class="form-control" value="<?php echo isset($exp9) ? "$exp9" : ''; ?>" /></td>
                <td><input id="nature9" name="nature9" class="form-control" maxlength="200" size="30" type="text" value="<?php echo isset($nature9) ? "$nature9" : ''; ?>" /></td>
                <td><input name="pay9" id="pay9" class="form-control" maxlength="50" size="50" type="text" value="<?php echo isset($pay9) ? "$pay9" : ''; ?>" /></td>
                <td>
                  <select class="form-control" name="otype9" id="otype9">
                    <option value="">Select</option>
                    <option value="Central Government" <?php echo ($otype9 == "Central Government") ? 'selected' : ''; ?>>Central Government</option>
                    <option value="State Government" <?php echo ($otype9 == "State Government") ? 'selected' : ''; ?>>State Government</option>
                    <option value="Autonomous Body" <?php echo ($otype9 == "Autonomous Body") ? 'selected' : ''; ?>>Autonomous Body</option>
                    <option value="University/Colleges" <?php echo ($otype9 == "University/Colleges") ? 'selected' : ''; ?>>University/Colleges</option>
                    <option value="Private" <?php echo ($otype9 == "Private") ? 'selected' : ''; ?>>Private</option>
                    <option value="Other" <?php echo ($otype9 == "Other") ? 'selected' : ''; ?>>Other</option>
                  </select>
                </td>
                <td><input type="file" name="exp_file9" id="exp_file9"></input>
                  <?php
                  if ($exp_file9 != '') {
                    $style_exp_file9 = "visibility: visible;";
                  } else {
                    $style_exp_file9 = "visibility: hidden;";
                  }
                  ?>
                  <a href="<?php echo $exp_file9; ?>" id="exp_file9_view" style="<?php echo $style_exp_file9; ?>" target="_blank"><b><u>View File</u> </b></a>
                  <input type="hidden" id="exp_file9" name="exp_file9" value="<?php echo isset($exp_file9) ? "$exp_file9" : ""; ?>" />
                </td>
              </tr>
            <?php } ?>
            <?php if (isset($org10) && $org10 != '') {
            ?>
              <tr>
                <td>10.</td>
                <td><input name="org10" id="org10" class="form-control org" maxlength="200" size="30" type="text" value="<?php echo isset($org10) ? "$org10" : ''; ?>" /></td>
                <td><input name="pos10" id="pos10" class="form-control" maxlength="100" size="30" type="text" value="<?php echo isset($pos10) ? "$pos10" : ''; ?>" /></td>
                <td><input data-myID="diff10" name="from10" id="from10" class="form-control fromdt" maxlength="10" size="10" type="text" readonly style="background: #FFFFFF;" value="<?php echo isset($from10) ? $from10 : ''; ?>" /></td>
                <td><input data-myID="diff10" name="to10" id="to10" class="form-control todt" maxlength="10" size="10" type="text" readonly style="background: #FFFFFF;" value="<?php echo isset($to10) ? "$to10" : ''; ?>" /></td>
                <td><input type="text" readonly id="diff10" name="exp10" class="form-control" value="<?php echo isset($exp10) ? "$exp10" : ''; ?>" /></td>
                <td><input id="nature10" name="nature10" class="form-control" maxlength="200" size="30" type="text" value="<?php echo isset($nature10) ? "$nature10" : ''; ?>" /></td>
                <td><input name="pay10" id="pay10" class="form-control" maxlength="50" size="50" type="text" value="<?php echo isset($pay10) ? "$pay10" : ''; ?>" /></td>
                <td>
                  <select class="form-control" name="otype10" id="otype10">
                    <option value="">Select</option>
                    <option value="Central Government" <?php echo ($otype10 == "Central Government") ? 'selected' : ''; ?>>Central Government</option>
                    <option value="State Government" <?php echo ($otype10 == "State Government") ? 'selected' : ''; ?>>State Government</option>
                    <option value="Autonomous Body" <?php echo ($otype10 == "Autonomous Body") ? 'selected' : ''; ?>>Autonomous Body</option>
                    <option value="University/Colleges" <?php echo ($otype10 == "University/Colleges") ? 'selected' : ''; ?>>University/Colleges</option>
                    <option value="Private" <?php echo ($otype10 == "Private") ? 'selected' : ''; ?>>Private</option>
                    <option value="Other" <?php echo ($otype10 == "Other") ? 'selected' : ''; ?>>Other</option>
                  </select>
                </td>
                <td><input type="file" name="exp_file10" id="exp_file10"></input>
                  <?php
                  if ($exp_file10 != '') {
                    $style_exp_file10 = "visibility: visible;";
                  } else {
                    $style_exp_file10 = "visibility: hidden;";
                  }
                  ?>
                  <a href="<?php echo $exp_file10; ?>" id="exp_file10_view" style="<?php echo $style_exp_file10; ?>" target="_blank"><b><u>View File</u> </b></a>
                  <input type="hidden" id="exp_file10" name="exp_file10" value="<?php echo isset($exp_file10) ? "$exp_file10" : ""; ?>" />
                </td>
              </tr>
            <?php } ?>
          </tbody>
          <tbody>
            <tr>
              <td colspan="9">
                <strong>
                  <font size="2" color="blue">Total Experience: </font>
                </strong><span id="total_exp" name="total_exp"><?php echo isset($grandtotal) ? $grandtotal : ''; ?></span>
                <input type="hidden" id="exp_count" name="exp_count" readonly value="<?php echo isset($grandtotal) ? $grandtotal : ''; ?>" />
              </td>
              <!--                                    <td colspan="4">
                                <strong><font size="2" color="blue">Upload Experience Certificate: </font></strong>
                                <input type="file" name="expr_certi" id="expr_certi" style="display:inline-block"></input>
                            <?php
                            //                                        if ($expr_certi != '') {
                            //                                            $style_expr_certi = "visibility: visible;";
                            //                                        } else {
                            //                                            $style_expr_certi = "visibility: hidden;";
                            //                                        }
                            ?>
                                <a href="<?php echo $expr_certi; ?>"  id="expr_certi_view" style="<?php echo $style_expr_certi; ?>" target= "_blank" ><b><u>View File</u> </b></a>
                                <input type="hidden" id="expr_certi1" name="expr_certi1" value="<?php echo isset($expr_certi) ? "$expr_certi" : ""; ?>"/>
                            </td>-->
              <td id="div_guest_btn">
                <button type="button" id="delete_more_btn" class="btn btn-danger">Remove</button>
                <button type="button" id="add_more_btn" class="btn btn-success">Add More</button>
              </td>
            </tr>
            <tr>
              <td colspan="7">
                <a href='#' id="prev2" data-toggle="tab" onclick="return prev_to2();" role="button" class="btn login-btn">
                  << Previous</a>

                    <?php //if ($j_type != 'Permanent') {

                    ?>
                    Whether you have worked on any Government Project? :<font style="color:red">*</font>
                    <select class="fullname" style="width:20%" name="police" required>
                      <option value="">Select Option</option>
                      <option value="Yes" <?php echo ($police == "Yes") ? 'selected' : ''; ?>>Yes</option>
                      <option value="No" <?php echo ($police == "No") ? 'selected' : ''; ?>>No</option>
                    </select>
                    <?php //}
                    ?>

              </td>



              <td colspan="4">
                <div class=" btn-toolbar">
                  <a href="#" id="a3" data-toggle="tab" onclick="return a3();" role="button" class="btn login-btn pull-right">Save & Next</a>
                  <?php if ($_SESSION['is_login'] == 'true') { ?>
                    <!--<input type="button" id="update3" name="update3" class="btn btn-primary pull-right"  onclick="return update_3();" value="save"/>-->
                  <?php } ?>
                </div>

              </td>
            </tr>
          </tbody>

        </table>
        <div class="col-xs-6">
          <br />
          <label for="captcha_code_ex" style="text-align:left">Enter Captcha :</label>
          <img id="captcha_img_ex" src="captcha_ex.php" alt="CAPTCHA" height="40" width="100" />
          <a href='javascript: refresh_captcha_ex();'>
            <img src="images/refresh.png" height="40" width="40" alt="Refresh Captcha" />
          </a>
          <input type="text" id="captcha_code_ex" name="captcha_code_ex" class="fullname" placeholder="Enter captcha here" autocomplete="off" style="width:30%" required />
        </div>
      </form>
    </div>
    <div id="upload_docs" class="tab-pane fade" style="border: 1px solid #23297a;">
      <form id="documentform" action="update4.php" method="post" enctype="multipart/form-data">
        <input name="app_id_docs" id="app_id_docs" type="hidden" class="form-control" value="<?php echo (isset($app_id)) ? $app_id : ''; ?>" />
        <table class="table">
          <thead>
            <th>No.</th>
            <th colspan="2">Documents</th>
            <th>Document Upload</th>
          </thead>
          <tbody>
            <?php
            // Condition to check if the user is fee-exempt
            $is_fee_waived = ($sex == 'Female' || $caste == "SC" || $caste == "ST" || ($disability == "Yes" && $disability_percentage >= 40));
            ?>

            <tr>
              <td colspan="4" class="text-center">
                <a href="https://www.onlinesbi.sbi/sbicollect/icollecthome.htm?corpID=1734565"
                  target="_blank"
                  class="btn btn-success"
                  onclick="return confirm('FEES FOR SC, ST, EX-SERVICEMAN, Female & PwBD (more than 40% permanent disability) Rs. 0 AND FEES FOR ALL OTHERS INCLUDING UNRESERVED (GENERAL), OBC,  ETC. RS. 1000')"
                  <?php echo $is_fee_waived ? 'style="pointer-events: none; opacity: 0.5; cursor: not-allowed;" disabled' : ''; ?>>
                  Click here to pay fees online
                </a>

                <div class="bg-info" style="padding: 10px 20px; margin-top: 8px;">
                  <strong>
                    <p class="blinking">
                      FEES FOR SC, ST, Female, EX-SERVICEMAN & PwBD (more than 40% permanent disability):
                      <span style="color:green; font-weight:bold;">Rs. 0</span>
                    </p>
                    <p class="blinking">
                      FEES FOR ALL OTHERS INCLUDING UNRESERVED (GENERAL), OBC, ETC.:
                      <span style="color:red; font-weight:bold;">Rs. 1000</span>
                    </p>
                  </strong>
                </div>
              </td>
            </tr>


            <?php
            // session_start();
            // echo "<pre>";
            // var_dump($_SESSION);
            // echo "</pre>";
            // exit;
            ?>
            <tr id="dd_div">
              <td align="center">1.<?php echo !$is_fee_waived ? '<font style="color:red">*</font>' : ''; ?></td>
              <td colspan="2">
                <?php
                $transaction_ref_no_new = substr($transaction_ref_no, 3);
                $transaction_ref_no_pref = substr($transaction_ref_no, 0, 3);
                $is_fee_waived = ($sex == 'Female' || $caste == "SC" || $caste == "ST" || ($disability == "Yes" && $disability_percentage >= 40));
                ?>
                Transaction Number <span style="color:red">(Please enter unique number only. For Example: DUL1234567) </span><br />
                <input type="text" name="transaction_pref" id="transaction_pref" maxlength="3" placeholder="DUC/DUK/DUL" class="form-control"
                  value="<?php echo $is_fee_waived ? "NA" : ($transaction_ref_no_pref != "" && $transaction_ref_no != "" ? $transaction_ref_no_pref : "DUL"); ?>"
                  <?php echo $is_fee_waived ? 'readonly' : 'required'; ?>></input>
                <input type="text" name="transaction_ref_no" maxlength="10" id="transaction_ref_no" placeholder="Transaction number only Example, 123456"
                  class="form-control"
                  value="<?php echo $is_fee_waived ? "NA" : (isset($transaction_ref_no) ? $transaction_ref_no_new : ""); ?>"
                  <?php echo $is_fee_waived ? 'readonly' : 'required'; ?>></input>
                <label id="msg_ref_no" style="width: 100%; color: red; text-align: left;"></label>
              </td>
              <td <?php echo $is_fee_waived ? 'style="display:none;"' : ''; ?>>
                Transaction Date (MM/DD/YYYY)
                <input type="text" name="dd_date" placeholder="Transaction Date" id="dd_date" class="form-control"
                  value="<?php echo $is_fee_waived ? "NA" : (isset($dd_date) ? $dd_date : ""); ?>"
                  <?php echo $is_fee_waived ? 'readonly' : 'required'; ?>></input>
              </td>
            </tr>
            <tr id="dd_div1">
              <td></td>
              <td>
                Transaction Amount
                <select name="dd_amount" id="dd_amount" class="form-control" <?php echo $is_fee_waived ? 'disabled' : 'required'; ?>>
                  <option value="">Select Transaction Amount</option>
                  <?php if ($is_fee_waived) { ?>
                    <option value="0" selected>0 Rs/-</option>
                  <?php } else { ?>
                    <!-- <option value="500" <?php echo ($dd_amount == "500") ? 'selected' : ''; ?>>500 Rs/-</option> -->
                    <option value="1000" <?php echo ($dd_amount == "1000") ? 'selected' : ''; ?>>1000 Rs/-</option>
                  <?php } ?>
                </select>

                <?php if ($is_fee_waived) { ?>
                  <!-- Hidden field to send value when dropdown is disabled -->
                  <input type="hidden" name="dd_amount" value="0">
                <?php } ?>



              </td>
              <td colspan="2" <?php echo $is_fee_waived ? 'style="display:none;"' : ''; ?>>
                <?php
                $stylef = ($fees_receipt != '') ? "visibility: visible;" : "visibility: hidden;";
                ?>
                Copy of the Fee Receipt (SBI Collect)
                <input type="file" name="file_fees" id="file_fees" class="form-control" <?php echo $is_fee_waived ? 'disabled' : (($fees_receipt == "") ? "required" : ""); ?>></input>
                <a href="<?php echo $fees_receipt; ?>" id="file_anchorf" style="<?php echo $stylef; ?>" target="_blank"><b><u>View</u></b></a>
              </td>
            </tr>



            <tr>
              <td align="center">2.<font style="color:red">*</font>
              </td>
              <td colspan="2">
                Passport Size Photo (JPG/PNG) (Max 400 KB size) :
              </td>
              <td>
                <?php
                if ($photo != '') {
                  $style1 = "visibility: visible;";
                } else {
                  $style1 = "visibility: hidden;";
                }
                ?>
                <input type="file" name="file_1" id="file_1" class="form-control" <?php
                                                                                  if ($photo == "") {
                                                                                    echo "required";
                                                                                  }
                                                                                  ?> />
                <a href="<?php echo $photo; ?>" id="file_anchor1" style="<?php echo $style1; ?>" target="_blank"><b><u>View</u> </b></a>
                <input type="hidden" id="file_hidden1" name="file_hidden1" value="<?php echo isset($val1) ? "$val1" : ""; ?>" />
              </td>

            </tr>
            <tr>
              <td align="center">3.<font style="color:red">*</font>
              </td>
              <td colspan="2">
                Current Sign (JPG/PNG) (Max 400 KB size) :
              </td>
              <td>
                <?php
                if ($sign != '') {
                  $style2 = "visibility: visible;";
                } else {
                  $style2 = "visibility: hidden;";
                }
                ?>
                <input type="file" name="file_2" id="file_2" class="form-control" <?php
                                                                                  if ($sign == "") {
                                                                                    echo "required";
                                                                                  }
                                                                                  ?> />
                <a href="<?php echo $sign; ?>" style="<?php echo $style2; ?>" id="file_anchor2" target="_blank"><b><u>View </u> </b></a>
                <input type="hidden" id="file_hidden2" name="file_hidden2" value="<?php echo isset($val2) ? "$val2" : "" ?>" />
                <!-- <a href="" style="display:inline-block"><b>Delete</b></a>-->
                <?php // }
                ?>
              </td>

            </tr>
            <tr>
              <td align="center">4.<font style="color:red">*</font>
              </td>
              <td colspan="2">
                Date of Birth Proof (Pancard/Aadharcard/Leaving Certi./SSC Certi.) (JPG/PNG) (Max 400 KB size) :
              </td>
              <td>
                <?php
                if ($dob_proof != '') {
                  $style5 = "visibility: visible;";
                } else {
                  $style5 = "visibility: hidden;";
                }
                ?>
                <input type="file" name="file_5" id="file_5" class="form-control" <?php
                                                                                  if ($dob_proof == "") {
                                                                                    echo "required";
                                                                                  }
                                                                                  ?> />
                <a href="<?php echo $dob_proof; ?>" style="<?php echo $style5; ?>" id="file_anchor5" target="_blank"><b><u>View </u> </b></a>
                <input type="hidden" id="file_hidden5" name="file_hidden5" value="<?php echo isset($val5) ? "$val5" : "" ?>" />
              </td>

            </tr>
            <?php
            $query_noc = "select grandtotal from exprn where id='" . $app_id . "'";
            $result_noc = mysqli_query($link, $query_noc);
            while ($row_noc = mysqli_fetch_array($result_noc)) {
              $noc_req = $row_noc['grandtotal'];
            }
            ?>
            <tr>
              <td align="center">5.<?php
                                    //                                        if ($b_expr != 0 || $m_expr != 0 || $p_expr != 0) {
                                    //                                            echo '<font style="color:red">*</font>';
                                    //                                        }
                                    ?>
              </td>
              <td colspan="2">
                NOC from current organization (if applicable)(JPG/PNG/PDF) (Max 400 KB size) :
              </td>
              <td>
                <?php
                if ($noc != '') {
                  $style6 = "visibility: visible;";
                } else {
                  $style6 = "visibility: hidden;";
                }
                ?>
                <input type="file" name="file_3" id="file_3" class="form-control" style="display:inline-block" />

                <a href="<?php echo $noc; ?>" style="<?php echo $style6; ?>" id="file_anchor3" target="_blank"><b><u>View </u> </b></a>
                <input type="hidden" id="file_hidden6" name="file_hidden6" value="<?php echo isset($val6) ? "$val6" : ""; ?>" />
              </td>
            </tr>
            <tr>
              <td align="center">6.</td>
              <td colspan="2">
                Other relevant document[s](if applicable)(JPG/PNG/PDF) (Max 400 KB size) :
              </td>
              <?php
              if ($otherdoc != '') {
                $style7 = "visibility: visible;";
              } else {
                $style7 = "visibility: hidden;";
              }
              ?>
              <td><input type="file" name="file_4" id="file_4" class="form-control" style="display:inline-block" />
                <a href="<?php echo $otherdoc; ?>" style="<?php echo $style7; ?>" id="file_anchor4" target="_blank"><b>View </b></a>
                <input type="hidden" id="file_hidden7" name="file_hidden7" value="<?php echo isset($val7) ? "$val7" : ""; ?>" />
              </td>
            </tr>
            <?php if ($post == 'SELS-2-2025') { ?>
              <tr>
                <td align="center">7.<font style="color:red">*</font>
                </td>
                <td colspan="2">
                  APARs for last 5 years (PDF only, Max 2 MB size)
                </td>
                <td>
                  <?php
                  if ($apars_doc != '') {
                    $style_apar = "visibility: visible;";
                  } else {
                    $style_apar = "visibility: hidden;";
                  }
                  ?>
                  <input type="file" name="file_apars" id="file_apars" class="form-control" accept="application/pdf"
                    <?php echo ($apars_doc == "") ? "required" : ""; ?> />
                  <a href="<?php echo $apars_doc; ?>" style="<?php echo $style_apar; ?>" id="file_anchor_apar" target="_blank">
                    <b><u>View</u></b>
                  </a>
                  <input type="hidden" id="file_hidden_apar" name="file_hidden_apar" value="<?php echo isset($apars_doc) ? "$apars_doc" : ""; ?>" />
                </td>
              </tr>
            <?php } ?>

            <tr>

              <td colspan="4">
                <div class=" btn-toolbar">
                  <a href='#' id="prev3" data-toggle="tab" onclick="return prev_to3();" role="button" class="btn login-btn">
                    << Previous</a>
                      <a href="#" id="a4" data-toggle="tab" onclick="return a4();" target="_blank" role="button" class="btn login-btn pull-right">Save & Next</a>
                      <?php if ($_SESSION['is_login'] == 'true') { ?> <!--<input type="button" id="update4" onclick="return update_4();" name="update4" class="btn btn-primary pull-right"   value="save"/>--><?php } ?>
                </div>
              </td>

            </tr>
          </tbody>
        </table>
        <div class="col-xs-6">
          <br />
          <label for="captcha_code_ud" style="text-align:left">Enter Captcha :</label>
          <img id="captcha_img_ud" src="captcha_ud.php" alt="CAPTCHA" height="40" width="100" />
          <a href='javascript: refresh_captcha_ud();'>
            <img src="images/refresh.png" height="40" width="40" alt="Refresh Captcha" />
          </a>
          <input type="text" id="captcha_code_ud" name="captcha_code_ud" class="fullname" placeholder="Enter captcha here" autocomplete="off" style="width:30%" required />
        </div>
      </form>
    </div>
    <div id="others" class="tab-pane fade" style="border: 1px solid #23297a;">
      <form id="otherform" action="update5.php" method="post" enctype="multipart/form-data">
        <input name="app_id_other" id="app_id_other" type="hidden" class="form-control" value="<?php echo (isset($app_id)) ? $app_id : ''; ?>" />
        <div class="row">
          <div class="col-xs-12">
            <br />
            <span> <b>&nbsp;Two References (Not related to you) (Give Name, Contact address, Contact No. and Email id) :<font style="color:red">*</font></b></span>
            <div class="col-xs-6"><br />
              Reference 1:
              <textarea name="txtref1" id="txtref1" class="form-control" required rows="5" cols="20" maxlength="800"><?php echo isset($ref1) ? "$ref1" : ''; ?></textarea><br />
            </div>
            <div class="col-xs-6"><br />
              Reference 2:
              <textarea name="txtref2" id="txtref2" class="form-control" required rows="5" cols="20" maxlength="800"><?php echo isset($ref2) ? "$ref2" : ''; ?></textarea><br />
            </div>
            <div class="clearfix"></div>
            <div class="col-xs-6">
              Have you ever been detained/convicted by police authority or court of law? <font style="color:red">*</font>
            </div>
            <div class="col-xs-2">
              <select name="detained" id="detained" onchange="showDiv1(this.value)" class="form-control">
                <option value="No" <?php echo ($detained == "No") ? 'selected' : ''; ?>>No</option>
                <option value="Yes" <?php echo ($detained == "Yes") ? 'selected' : ''; ?>>Yes</option>
              </select>
            </div>
            <div id="hidden_div1" style="display: <?php
                                                  if ($detained == "Yes") {
                                                    echo "block";
                                                  } else {
                                                    echo "none";
                                                  }
                                                  ?>">
              <div class="col-xs-12">
                <lable>Give details thereof</lable>
                <textarea name="detained_details" id="detained_details" class="form-control" rows="3" cols="100" maxlength="500"><?php echo isset($detained_details) ? "$detained_details" : ''; ?></textarea>
              </div>
            </div>
            <div class="col-xs-12"></br>
              Other Information:
              <textarea name="txtinfo" id="txtinfo" class="form-control" rows="5" cols="100" maxlength="1000"><?php echo isset($other_info) ? "$other_info" : ''; ?></textarea><br />
            </div>
            <div class="col-xs-12"></br>
              <input id="declaration" name="declaration" type="checkbox" <?php echo ($declaration == 'Yes') ? 'checked' : ''; ?> />
              <span style="text-align:left" class="custom-control-label text-justify"> I hereby certify that the foregoing information is correct to the best of my knowledge and belief. I have not suppressed any material fact or factual information in the above statement. In case I have given wrong information or suppressed any material fact or factual information, then my services are liable to be terminated without giving any notice or reasons thereof. I am not aware of any circumstances which might impair my fitness for employment under Information and Library Network (INFLIBNET) Centre.</span>
            </div>
            <div class="clearfix"></div>
            <div class="col-xs-6"> <br></br>
              <label for="captacha_img" style="text-align:left">Enter Captcha : </label>
              <img id="captcha_img" src="captcha.php" alt="CAPTCHA" height="40" width="100" />
              <a href='javascript: refresh_captcha();'><img id="" src="images/refresh.png" height="40" width="40" /></a>
              <input type="text" id="captcha_code" name="captcha_code" class="fullname" placeholder="Enter captcha here" autocomplete="off" style="width:30%" />
            </div>
            <div class="clear:both"></div>
            <br /><br />

            <center>
              <a href='#' id="prev4" data-toggle="tab" onclick="return prev_to4();" role="button" class="btn btn-warning">
                << Previous</a>
                  <?php if ($_SESSION['is_login'] == 'true') { ?>
                    <input type="button" name="Submit_btn" id="submit_btn" onclick="submit_form();" class="btn btn-danger" value="Submit" />
                  <?php } ?>
                  <input type="button" id="update5" name="update5" class="btn btn-success" onclick="return update_5();" value="Save" />
                  <!-- <input class="fullname" type="button" name="reset" onclick="reset()" value="Reset" style="width:10%;background-color: #337ab7;color:white" />-->

            </center>
            <br />

          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!--        <div class="modal fade" id="dialog" tabindex="-1" role="dialog" style="display: none;" align = "center" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <strong style="color:green; margin-bottom:30px;">Your application has been submitted successfully, You are now being redirect to view/print page.</strong>
                        <strong style="color:red">The hardcopy of the online Application along with legible/readable copies of all self-attested testimonials, certificates and all supporting documents to "Recruitment Cell, INFLIBNET Centre, OPP.NIFT, Infocity, Gandhinagar, Gujarat-382007" on or before 29/04/2022 upto 05.30 pm, failing which the application will be rejected. <br/>Application not made online and print out of online Application along with all testimonials not received will be summarily rejected.</strong>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="btnHide" data-dismiss="modal">Ok</button>
                    </div>
                </div>
            </div>
        </div>-->
<div id="dialog" style="display: none;" align="center">
  <strong style="color:green">Your application has been submitted successfully, You are now being redirect to view/print page.</strong> <br><br>
  <strong style="color:red">The hardcopy of the online Application along with legible/readable copies of all self-attested testimonials, certificates and all supporting documents should reach to "Recruitment Cell, INFLIBNET Centre, OPP.NIFT, Infocity, Gandhinagar, Gujarat-382007" on or before 23/02/2025 upto 06.00 PM, failing which the application will be rejected. <br />Application not made online and print out of online Application along with all testimonials not received will be summarily rejected.</strong>
  </br></br>
  <input type="button" id="btnHide" value="Ok" class="btn btn-sm btn-primary" />
</div>
<?php include 'footer.php'; ?>
</body>

</html>

<!-- Added on 04/02/2025  -->
<?php
$is_logged_in = isset($_SESSION['is_login']) && ($_SESSION['is_login'] === true || $_SESSION['is_login'] === "true");
?>


<script type="text/javascript">
  function showDiv($_id, $_ty) {
    if ($_id == "OBC" || $_id == "ST" || $_id == "SC" || $_id == "EWS" && $_ty != 'Contractual') {
      $("#hidden_div").show();
      $("#exserviceman_div").hide();
    } else if ($_id == "Ex-servicemen") {
      $("#exserviceman_div").show();
      $("#hidden_div").hide();
    } else {
      $("#hidden_div").hide();
      $("#exserviceman_div").hide();
    }
  }

  function showDiv1($val) {
    if ($val == "Yes") {
      $("#hidden_div1").show();
    } else {
      $("#hidden_div1").hide();
    }
  }

  function showDiv2($val) {
    if ($val == "Yes") {
      $('#disability_percentage').attr('required', true);
      $('#disability_certi').attr('required', true);
      $('#type_of_disability').attr('required', true);
      $("#hidden_div2").show();
    } else {
      $('#disability_percentage').attr('required', false);
      $('#disability_certi').attr('required', false);
      $('#type_of_disability').attr('required', false);
      $("#hidden_div2").hide('');
    }
  }

  function save1() {
    if (validate1()) {
      return true;
    } else {
      return false;
    }
  }

  var app_id = document.frmregister.app_id.value;

  function validate1() {
    var frmregister = $('#frmregister');
    var frmParsley = frmregister.parsley();
    frmParsley.validate();
    if (!frmregister.parsley().isValid()) {
      return false;
    }


    var captchaInput = document.getElementById("captcha_code_p").value;
    var isValidCaptcha = false;

    // Synchronously check the captcha
    $.ajax({
      type: 'POST',
      url: 'captcha_verify_login.php',
      data: {
        captcha_code_p: captchaInput
      },
      async: false, // Make the AJAX call synchronous
      success: function(response) {
        if (response === "false_captcha") {
          alert("Captcha is incorrect.");
          isValidCaptcha = false;
        } else {
          isValidCaptcha = true;
        }
      }
    });

    if (!isValidCaptcha) {
      return false;
    }

    var isUserLoggedIn = <?php echo json_encode($is_logged_in); ?>;
    // console.log("User Logged In Status:", isUserLoggedIn);
    var caste_certi = $("#caste_certi_view").css("visibility");
    var disability_certi = $("#disability_certi_view").css("visibility");
    var stenography_certi_view = $("#stenography_certi_view").css("visibility");
    var typing_certi_view = $("#typing_certi_view").css("visibility");
    if (document.frmregister.mobile.value.length != 10) {
      alert("Mobile Number must have 10 Digits.");
      document.frmregister.mobile.focus();
      return false;
    } else if (document.frmregister.aadhar_no.value != "") {
      if (document.frmregister.aadhar_no.value.length != 12) {
        alert("Enter Valid 12 Digit Aadhar Number.");
        document.frmregister.aadhar_no.focus();
        return false;
      } else {
        return true;
      }
    } else if (document.frmregister.disability.value == "Yes") {
      if (document.frmregister.disability_percentage.value == "") {
        alert("Please Enter Percentage of Disability.");
        document.frmregister.disability_percentage.focus();
        return false;
      } else if (document.frmregister.disability_percentage.value.length >= 3) {
        alert("Percentage of Disability valid only two digit.");
        document.frmregister.disability_percentage.focus();
        return false;
      } else if (document.frmregister.disability_certi.files.length == 0 && disability_certi == "hidden") {
        alert("Please Select Disability Certificate.");
        document.frmregister.disability_certi.focus();
        return false;
      } else {
        return true;
      }
    } else if (document.frmregister.pincode.value.length != 6) {
      alert("Pincode must have 6 Digits.");
      document.frmregister.pincode.focus();
      return false;
    } else if (document.frmregister.ppincode.value.length != 6) {
      alert("Pincode must have 6 Digits.");
      document.frmregister.ppincode.focus();
      return false;
      //        } else if (document.frmregister.caste.value != "GENERAL") {
      //            if (document.frmregister.caste.value != "Ex-servicemen") {
      //                if (document.frmregister.issue_year.value == "" || document.frmregister.issue_year.value == null) {
      //                    alert("Please enter caste certificate issue year.");
      //                    document.frmregister.issue_year.focus();
      //                    return false;
      //                } else if (document.frmregister.certi_no.value == "") {
      //                    alert("please enter caste certificate number.");
      //                    document.frmregister.certi_no.focus();
      //                    return false;
      //                } else if (document.frmregister.caste_certi.files.length == 0 && caste_certi == 'hidden') {
      //                    alert("Please Select Caste Certificate.");
      //                    document.frmregister.caste_certi.focus();
      //                    return false;
      //                } else {
      //                    return true;
      //                }
      //            } else {
      //                return true;
      //            }
      // } else if (document.frmregister.post.value == "TestCCTAdmin-2-2025") {
    } else if (document.frmregister.post.value == "TestCCTAdmin-2-2025" && isUserLoggedIn) {
      if (document.frmregister.typing_speed.value == "") {
        alert("Please Enter Typing Speed.");
        document.frmregister.typing_speed.focus();
        return true;
      } else if (document.frmregister.typing_certi.files.length == 0 && typing_certi_view == 'hidden') {
        alert("Please Upload Typing Speed Certificate.");
        document.frmregister.typing_certi.focus();
        return false;
      } else if (document.frmregister.typing_language.value == "English" && document.frmregister.typing_speed.value < 35) {
        alert("Minimum 35 Typing Speed Required in English.");
        document.getElementById("typing_speed").value = "";
        document.frmregister.typing_speed.focus();
        return false;
      } else if (document.frmregister.typing_language.value == "Hindi" && document.frmregister.typing_speed.value < 30) {
        alert("Minimum 30 Typing Speed Required in Hindi.");
        document.getElementById("typing_speed").value = "";
        document.frmregister.typing_speed.focus();
        return false;
      } else {
        return true;
      }
    } else if (document.frmregister.post.value == "PSAdmin-2-2023") {
      if (document.frmregister.stenoGraphy_speed.value == "") {
        alert("Please Enter StenoGraphy Speed.");
        document.frmregister.stenoGraphy_speed.focus();
        return false;
      } else if (document.frmregister.stenoGraphy_speed.value < 120) {
        alert("Minimum 120 StenoGraphy Speed Required.");
        document.frmregister.stenoGraphy_speed.focus();
        return false;
      } else if (document.frmregister.stenography_certi_no.value == "") {
        alert("Please Enter StenoGraphy Certificate Number.");
        document.frmregister.stenography_certi_no.focus();
        return false;
      } else if (document.frmregister.stenography_certi.files.length == 0 && stenography_certi_view == 'hidden') {
        alert("Please Upload StenoGraphy Certificate.");
        document.frmregister.stenography_certi.focus();
        return false;
      } else if (document.frmregister.typing_speed.value == "") {
        alert("Please Enter Typing Speed.");
        document.frmregister.typing_speed.focus();
        return false;
      } else if (document.frmregister.typing_speed.value < 40) {
        alert("Minimum 40 Typing Speed Required.");
        document.frmregister.typing_speed.focus();
        return false;
      } else if (document.frmregister.typing_certi_no.value == "") {
        alert("Please Enter Styping Speed Certificate Number.");
        document.frmregister.typing_certi_no.focus();
        return false;
      } else if (document.frmregister.typing_certi.files.length == 0 && typing_certi_view == 'hidden') {
        alert("Please Upload Typing Speed Certificate.");
        document.frmregister.typing_certi.focus();
        return false;
      } else {
        return true;
      }
    } else if (document.frmregister.serving.value == "") {
      alert("Please Select arre you serving option");
      document.frmregister.serving.focus();
      return false;
    } else if (document.frmregister.serving.value == "Yes") {
      if (document.frmregister.type_of_service.value == "") {
        alert("Please Select Types of Service.");
        document.frmregister.type_of_service.focus();
        return false;
      } else {
        return true;
      }
    } else {
      return true;
    }
  }

  // function a1() {
  //   if (validate1()) {
  //     var issue_year = document.frmregister.issue_year.value;
  //     var certi_no = document.frmregister.certi_no.value;
  //     var myform3 = document.getElementById("frmregister");
  //     var fd3 = new FormData(myform3);
  //     $.ajax({
  //       type: 'POST',
  //       url: 'update1.php',
  //       data: fd3,
  //       processData: false,
  //       contentType: false,
  //       cache: false,
  //       issue_year: issue_year,
  //       certi_no: certi_no,
  //       success: function(response) {
  //         //if (response == "true"){
  //         //alert("Data saved successfully.");
  //         $("#li2").addClass("active");
  //         $("#li1").removeClass("active");
  //         $("#li3").removeClass("active");
  //         $("#li4").removeClass("active");
  //         $("#li5").removeClass("active");
  //         $("#educational").addClass("in active");
  //         $("#personal").removeClass("in active");
  //         $("#experience").removeClass("in active");
  //         $("#upload_docs").removeClass("in active");
  //         $("#others").removeClass("in active");
  //         $(this).attr("href", "#educational");
  //         return false;
  //       }
  //     });
  //   }
  // }

  function a1() {
    if (validate1()) {
      var issue_year = document.frmregister.issue_year.value;
      var certi_no = document.frmregister.certi_no.value;
      var myform3 = document.getElementById("frmregister");
      var fd3 = new FormData(myform3);
      $.ajax({
        type: 'POST',
        url: 'update1.php',
        data: fd3,
        processData: false,
        contentType: false,
        cache: false,
        success: function(response) {
          if (response == "false_captcha") {
            alert("Captcha is incorrect.");
            refresh_captcha_p()
            return false;
          } else {
            $("#li2").addClass("active");
            $("#li1").removeClass("active");
            $("#li3").removeClass("active");
            $("#li4").removeClass("active");
            $("#li5").removeClass("active");
            $("#educational").addClass("in active");
            $("#personal").removeClass("in active");
            $("#experience").removeClass("in active");
            $("#upload_docs").removeClass("in active");
            $("#others").removeClass("in active");
            $(this).attr("href", "#educational");
            return false;
          }
        }
      });
    }
  }


  function validate2() {
    //var post = $("#post").val();
    var frm1 = $('#educationalform');
    var frmParsley1 = frm1.parsley();
    frmParsley1.validate();
    if (!frm1.parsley().isValid()) {
      return false;
    } else {
      return true;
    }
    //        alert(document.getElementById("per4").value);
    //        if (post == 'AOAdmin-1-2023' || post == 'AOFAdmin-1-2023') {
    //            if (document.getElementById("per4").value < 55) {
    //                alert('test4');
    //                alert("Please enter details of have you ever been detained/convicted by police authority or court of law.");
    //                document.getElementById("detained_details").focus();
    //                return false;
    //            } else {
    //                return true;
    //            }
    //        } else {
    //            return true;
    //        }
  }

  function a2() {
    if (validate2()) {
      var myform1 = document.getElementById("educationalform");
      var fd1 = new FormData(myform1);
      $.ajax({
        type: 'post',
        url: 'update2.php',
        data: fd1,
        processData: false,
        contentType: false,
        cache: false,
        success: function(data) {
          if (data == "false_captcha") {
            alert("Captcha is incorrect.");
            refresh_captcha_e();
            return false;
          } else {
            //var post_val = $('#post option:selected').val();
            var post_val = document.getElementById("post").value;
            var app_id = document.getElementById("app_id_edu").value;
            var edu4 = document.getElementById("edu4").value;
            var bool = false;
            $.ajax({
              url: 'checkexperience.php',
              type: 'POST',
              async: false,
              data: {
                post: post_val,
                app_id: app_id,
                edu4: edu4
              },
              dataType: 'json',
              success: function(response) {
                message = "Minimum Required Experience : " + response.experience + " Years.";
                document.getElementById("message").innerHTML = message;
              },
            });

            $("#li3").addClass("active");
            $("#li1").removeClass("active");
            $("#li2").removeClass("active");
            $("#li4").removeClass("active");
            $("#li5").removeClass("active");
            $(this).attr("href", "#experience");
            $("#experience").addClass("in active");
            $("#personal").removeClass("in active");
            $("#educational").removeClass("in active");
            $("#upload_docs").removeClass("in active");
            $("#others").removeClass("in active");
          }
        }
      });
    }
  }


  function validate5() {
    var frm = $('#otherform');
    var frmParsley = frm.parsley();
    frmParsley.validate();
    if (!frm.parsley().isValid()) {
      return false;
    }

    if (document.getElementById("detained").value == "Yes") {
      if (document.getElementById("detained_details").value == "") {
        alert("Please enter details of have you ever been detained/convicted by police authority or court of law.");
        document.getElementById("detained_details").focus();
        return false;
      } else {
        return true;
      }
    } else if (document.getElementById("txtref1").value == "") {
      alert("Please Enter First Reference Details.");
      document.getElementById("txtref1").focus();
      return false;
    } else if (document.getElementById("txtref2").value == "") {
      alert("Please Enter Second Reference Details.");
      document.getElementById("txtref2").focus();
      return false;
    } else {
      return true;
    }
  }

  function update_5() {
    if (validate5()) {
      var ref1 = document.getElementById("txtref1").value;
      var ref2 = document.getElementById("txtref2").value;
      var detained = document.getElementById("detained").value;
      if (detained == "Yes") {
        var detained_details = document.getElementById("detained_details").value;
      } else {
        var detained_details = "";
      }
      var other_info = document.getElementById("txtinfo").value;
      var declaration = document.getElementById("declaration").value;
      var app_id = document.getElementById("app_id_docs").value;
      $.ajax({
        type: 'post',
        url: 'update5.php',
        dataType: 'json',
        data: {
          app_id: app_id,
          ref1: ref1,
          ref2: ref2,
          detained: detained,
          detained_details: detained_details,
          declaration: declaration,
          other_info: other_info
        },
        success: function(response) {
          if (response == "true") {
            alert("Data Saved successfully.");
            return true;
          } else {

            alert("Data could not be saved.");
            return false;
          }
        }
      });
    }
  }

  function validate3() {

    var frm = $('#expform');
    var frmParsley = frm.parsley();
    frmParsley.validate();
    if (!frm.parsley().isValid()) {
      return false;
    }
    //var_expr_certi = $("#expr_certi_view").css("visibility");

    //        var post_val = $('#post option:selected').val();
    var post_val = document.getElementById("post").value;
    var app_id = document.getElementById("app_id_expr").value;
    //        var edu3 = document.educationalform.edu3.value;
    //        var edu4 = document.educationalform.edu4.value;
    //        var edu5 = document.educationalform.edu5.value;
    //        var b_expr = document.educationalform.b_expr.value;
    //        var m_expr = document.educationalform.m_expr.value;
    //        var p_expr = document.educationalform.p_expr.value;
    var bool = false;
    $.ajax({
      url: 'checkexperience.php',
      type: 'POST',
      async: false,
      data: {
        post: post_val,
        app_id: app_id
      },
      dataType: 'json',
      success: function(response) {
        var expr = '';
        expr = response.experience;
        expr = ('0' + expr).slice(-2);
        cat = response.category;
        var exp1 = Number(expr);
        var span_val = document.getElementById("total_exp").innerText;
        var exp_years = span_val.substring(0, 2);
        var exp2 = Number(exp_years);
        if (exp1 <= exp2) {
          bool = true;
        } else {
          alert("Sorry.You don't have enough experience for the post you have applied for.");
          bool = false;
        }
        //            if (b_expr != 0 || m_expr != 0 || p_expr != 0) {
        //                if (document.frmregister.expr_certi.files.length == 0 && var_expr_certi == 'hidden') {
        //                    alert("Please upload experience letter from Organisation.");
        //                    document.frmregister.expr_certi.focus();
        //                    bool = false;
        //                } else {
        //                    bool = true;
        //                }
        //            } else{
        //                bool = true;
        //            }


      },
    });
    return bool;
  }

  // function a3() {
  //   if (validate3()) {
  //     var myform6 = document.getElementById("expform");
  //     var fd6 = new FormData(myform6);
  //     $.ajax({
  //       type: 'post',
  //       url: 'update3.php',
  //       data: fd6,
  //       processData: false,
  //       contentType: false,
  //       cache: false,
  //       success: function(response) {
  //         $("#li4").addClass("active");
  //         $("#li3").removeClass("active");
  //         $("#li2").removeClass("active");
  //         $("#li1").removeClass("active");
  //         $("#li5").removeClass("active");
  //         $(this).attr("href", "#upload_docs");
  //         $("#upload_docs").addClass("in active");
  //         $("#personal").removeClass("in active");
  //         $("#educational").removeClass("in active");
  //         $("#experience").removeClass("in active");
  //         $("#others").removeClass("in active");
  //       },
  //     });
  //   }
  // }

  function a3() {
    event.preventDefault();
    if (validate3()) {
      var myform6 = document.getElementById("expform");
      var fd6 = new FormData(myform6);
      $.ajax({
        type: 'post',
        url: 'update3.php',
        data: fd6,
        processData: false,
        contentType: false,
        cache: false,
        success: function(response) {

          if (response == "false_captcha") {
            alert("Captcha is incorrect.");
            refresh_captcha_ex();
            return false;
          } else {
            var res = JSON.parse(response);
            if (res.status === 'success') {
              $("#li4").addClass("active");
              $("#li3").removeClass("active");
              $("#li2").removeClass("active");
              $("#li1").removeClass("active");
              $("#li5").removeClass("active");
              $(this).attr("href", "#upload_docs");
              $("#upload_docs").addClass("in active");
              $("#personal").removeClass("in active");
              $("#educational").removeClass("in active");
              $("#experience").removeClass("in active");
              $("#others").removeClass("in active");
            } else if (res.status === 'age_fail') {
              alert("Age is above the eligible limit, cannot proceed.");
            } else if (res.status === 'experience_fail') {
              alert("Please check experience docs or logout and fill again.");
            }
          }
        },
      });
    }
  }


  function prev_to1() {
    $("#li1").addClass("active");
    $("#li3").removeClass("active");
    $("#li2").removeClass("active");
    $("#li4").removeClass("active");
    $("#li5").removeClass("active");
    $("#prev1").attr("href", "#personal");
  }

  function prev_to2() {
    $("#li2").addClass("active");
    $("#li3").removeClass("active");
    $("#li1").removeClass("active");
    $("#li4").removeClass("active");
    $("#li5").removeClass("active");
    $("#prev2").attr("href", "#educational");
  }

  function prev_to3() {
    $("#li3").addClass("active");
    $("#li2").removeClass("active");
    $("#li1").removeClass("active");
    $("#li4").removeClass("active");
    $("#li5").removeClass("active");
    $("#prev3").attr("href", "#experience");
  }

  function prev_to4() {
    $("#li4").addClass("active");
    $("#li2").removeClass("active");
    $("#li1").removeClass("active");
    $("#li3").removeClass("active");
    $("#li5").removeClass("active");
    $("#prev4").attr("href", "#upload_docs");
  }

  function submit_form() {
    if (validate5()) {
      if (!document.getElementById('declaration').checked) {
        alert('You must agree to the declaration first.');
        document.getElementById("declaration").focus();
        return false;
      }
      if (document.getElementById("captcha_code").value == "") {
        alert("Please Enter CAPTCHA.");
        return false;
      }
      if (confirm("Note: You can not make any changes after final submission.\nAre you sure to submit your application?")) {
        var myform = document.getElementById("otherform");
        var fd = new FormData(myform);
        $.ajax({
          type: 'POST',
          url: 'update_status.php',
          data: fd,
          processData: false,
          contentType: false,
          cache: false,
          beforeSend: function() {
            $(".preload").show();
          },
          success: function(data) {
            if (data == "true") {
              $('#dialog').dialog('open');
              $("#btnHide").click(function() {
                $('#dialog').dialog('close');
                window.location.href = "print_application.php";
              });
            } else {
              alert('Some data of your application is not saved. Please re-login and try again. If does not works, Please send us an email at recruitment@inflibnet.ac.in along with your Registration ID.');
            }
          },
          complete: function(data) {
            $(".preload").hide();
          }

        });
      } else {
        event.preventDefault();
      }
    } else {
      return false;
    }
  }
  $('#file_fees').change(function() {
    var file_name = $(this).val();
    var fileExtension = file_name.substr((file_name.lastIndexOf('.') + 1));
    var extension_array = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'pdf', 'PDF'];
    if (extension_array.indexOf(fileExtension) == -1) {
      alert("Please upload only JPG/PNG/PDF file for Transaction Receipt.");
      document.getElementById("file_fees").value = null;
    }
    if (Math.round(document.getElementById("file_fees").files[0].size / 1024) > 400) {
      alert("Transaction Receipt should be less than 400 KB.");
      document.getElementById("file_fees").value = null;
    }
  });
  $('#disability_certi').change(function() {
    var file_name = $(this).val();
    var fileExtension = file_name.substr((file_name.lastIndexOf('.') + 1));
    var extension_array = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'pdf', 'PDF'];
    if (extension_array.indexOf(fileExtension) == -1) {
      alert("Please upload only JPG/PNG/PDF file for Disability Certificate.");
      document.getElementById("disability_certi").value = null;
    }
    if (Math.round(document.getElementById("disability_certi").files[0].size / 1024) > 400) {
      alert("Disability Certificate should be less than 400 KB.");
      document.getElementById("disability_certi").value = null;
    }
  });
  $('#stenography_certi').change(function() {
    var file_name = $(this).val();
    var fileExtension = file_name.substr((file_name.lastIndexOf('.') + 1));
    var extension_array = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'pdf', 'PDF'];
    if (extension_array.indexOf(fileExtension) == -1) {
      alert("Please upload only JPG/PNG/PDF file for Stenography Certificate.");
      document.getElementById("stenography_certi").value = null;
    }
    if (Math.round(document.getElementById("stenography_certi").files[0].size / 1024) > 400) {
      alert("Stenography Certificate should be less than 400 KB.");
      document.getElementById("stenography_certi").value = null;
    }
  });
  $('#typing_certi').change(function() {
    var file_name = $(this).val();
    var fileExtension = file_name.substr((file_name.lastIndexOf('.') + 1));
    var extension_array = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'pdf', 'PDF'];
    if (extension_array.indexOf(fileExtension) == -1) {
      alert("Please upload only JPG/PNG/PDF file for Typing Certificate.");
      document.getElementById("typing_certi").value = null;
    }
    if (Math.round(document.getElementById("typing_certi").files[0].size / 1024) > 400) {
      alert("Typing Certificate should be less than 400 KB.");
      document.getElementById("typing_certi").value = null;
    }
  });
  $('#file_1').change(function() {
    var file_name = $(this).val();
    var fileExtension = file_name.substr((file_name.lastIndexOf('.') + 1));
    var extension_array = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG'];
    if (extension_array.indexOf(fileExtension) == -1) {
      alert("Please upload only JPG/PNG file for Passport Size Photo.");
      document.getElementById("file_1").value = null;
    }
    if (Math.round(document.getElementById("file_1").files[0].size / 1024) > 400) {
      alert("Photo should be less than 400 KB.");
      document.getElementById("file_1").value = null;
    }
  });
  $('#file_2').change(function() {
    var file_name = $(this).val();
    var fileExtension = file_name.substr((file_name.lastIndexOf('.') + 1));
    var extension_array = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG'];
    if (extension_array.indexOf(fileExtension) == -1) {
      alert("Please upload only JPG/PNG file for Signature.");
      document.getElementById("file_2").value = null;
    }
    if (Math.round(document.getElementById("file_2").files[0].size / 1024) > 400) {
      alert("Signature file size should be less than 400 KB.");
      document.getElementById("file_2").value = null;
    }
  });
  $('#file_5').change(function() {
    var file_name = $(this).val();
    var fileExtension = file_name.substr((file_name.lastIndexOf('.') + 1));
    var extension_array = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'PDF', 'pdf'];
    if (extension_array.indexOf(fileExtension) == -1) {
      alert("Please upload only JPG/PNG/PDF file for DOB Proof.");
      document.getElementById("file_5").value = null;
    }
    if (Math.round(document.getElementById("file_5").files[0].size / 1024) > 400) {
      alert("DOB Proof file size should be less than 400 KB.");
      document.getElementById("file_5").value = null;
    }
  });
  $('#file_3').change(function() {
    var file_name = $(this).val();
    var fileExtension = file_name.substr((file_name.lastIndexOf('.') + 1));
    var extension_array = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'PDF', 'pdf'];
    if (extension_array.indexOf(fileExtension) == -1) {
      alert("Please upload only JPG/PNG/PDF file for NOC Document.");
      document.getElementById("file_3").value = null;
    }
    if (Math.round(document.getElementById("file_3").files[0].size / 1024) > 400) {
      alert("NOC Document size should be less than 400 KB.");
      document.getElementById("file_3").value = null;
    }
  });
  $('#file_4').change(function() {
    var file_name = $(this).val();
    var fileExtension = file_name.substr((file_name.lastIndexOf('.') + 1));
    var extension_array = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'PDF', 'pdf'];
    if (extension_array.indexOf(fileExtension) == -1) {
      alert("Please upload only JPG/PNG/PDF file for Other Document.");
      document.getElementById("file_4").value = null;
    }
    if (Math.round(document.getElementById("file_4").files[0].size / 1024) > 400) {
      alert("Other Document size should be less than 400 KB.");
      document.getElementById("file_4").value = null;
    }
  });
  $('#caste_certi').change(function() {
    var file_name = $(this).val();
    var fileExtension = file_name.substr((file_name.lastIndexOf('.') + 1));
    var extension_array = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'pdf', 'PDF'];
    if (extension_array.indexOf(fileExtension) == -1) {
      alert("Please upload only JPG/PNG/PDF file for Caste Certificate");
      document.getElementById("caste_certi").value = null;
    }
    if (Math.round(document.getElementById('caste_certi').files[0].size / 1024) > 400) {
      alert("Caste Certificate should be less than 400 KB.");
      document.getElementById("caste_certi").value = null;
    }
  });
  $('#ssc_certi').change(function() {
    var file_name = $(this).val();
    var fileExtension = file_name.substr((file_name.lastIndexOf('.') + 1));
    var extension_array = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'pdf', 'PDF'];
    if (extension_array.indexOf(fileExtension) == -1) {
      alert("Please upload only JPG/PNG/PDF file for SSC Certificate.");
      document.getElementById("ssc_certi").value = null;
    }
    if (Math.round(document.getElementById('ssc_certi').files[0].size / 1024) > 400) {
      alert("SSC Certificate should be less than 400 KB.");
      document.getElementById("ssc_certi").value = null;
    }
  });
  $('#hsc_certi').change(function() {
    var file_name = $(this).val();
    var fileExtension = file_name.substr((file_name.lastIndexOf('.') + 1));
    var extension_array = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'pdf', 'PDF'];
    if (extension_array.indexOf(fileExtension) == -1) {
      alert("Please upload only JPG/PNG/PDF file for HSC Certificate.");
      document.getElementById("hsc_certi").value = null;
    }
    if (Math.round(document.getElementById('hsc_certi').files[0].size / 1024) > 400) {
      alert("HSC Certificate should be less than 400 KB.");
      document.getElementById("hsc_certi").value = null;
    }
  });
  $('#bachelor_certi').change(function() {
    var file_name = $(this).val();
    var fileExtension = file_name.substr((file_name.lastIndexOf('.') + 1));
    var extension_array = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'pdf', 'PDF'];
    if (extension_array.indexOf(fileExtension) == -1) {
      alert("Please upload only JPG/PNG/PDF file for Bachelor Degree Certificate.");
      document.getElementById("bachelor_certi").value = null;
    }
    if (Math.round(document.getElementById('bachelor_certi').files[0].size / 1024) > 400) {
      alert("Bachelor Degree Certificate should be less than 400 KB.");
      document.getElementById("bachelor_certi").value = null;
    }
  });
  $('#master_certi').change(function() {
    var file_name = $(this).val();
    var fileExtension = file_name.substr((file_name.lastIndexOf('.') + 1));
    var extension_array = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'pdf', 'PDF'];
    if (extension_array.indexOf(fileExtension) == -1) {
      alert("Please upload only JPG/PNG/PDF file for Master Degree Certificate.");
      document.getElementById("master_certi").value = null;
    }
    if (Math.round(document.getElementById('master_certi').files[0].size / 1024) > 400) {
      alert("Master Degree Certificate should be less than 400 KB.");
      document.getElementById("master_certi").value = null;
    }
  });
  $('#phd_certi').change(function() {
    var file_name = $(this).val();
    var fileExtension = file_name.substr((file_name.lastIndexOf('.') + 1));
    var extension_array = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'pdf', 'PDF'];
    if (extension_array.indexOf(fileExtension) == -1) {
      alert("Please upload only JPG/PNG/PDF file for Ph.D/Other Certificate.");
      document.getElementById("phd_certi").value = null;
    }
    if (Math.round(document.getElementById('phd_certi').files[0].size / 1024) > 400) {
      alert("PHD/Other Certificate should be less than 400 KB.");
      document.getElementById("phd_certi").value = null;
    }
  });
  $('#other_edu_certi').change(function() {
    var file_name = $(this).val();
    var fileExtension = file_name.substr((file_name.lastIndexOf('.') + 1));
    var extension_array = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'pdf', 'PDF'];
    if (extension_array.indexOf(fileExtension) == -1) {
      alert("Please upload only JPG/PNG/PDF file for DCA/Equivalent Certificate.");
      document.getElementById("other_edu_certi").value = null;
    }
    if (Math.round(document.getElementById('other_edu_certi').files[0].size / 1024) > 400) {
      alert("DCA Certificate should be less than 400 KB.");
      document.getElementById("other_edu_certi").value = null;
    }
  });
  $('#exp_file1').change(function() {
    var file_name = $(this).val();
    var fileExtension = file_name.substr((file_name.lastIndexOf('.') + 1));
    var extension_array = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'pdf', 'PDF'];
    if (extension_array.indexOf(fileExtension) == -1) {
      alert("Please upload only JPG/PNG/PDF file for First Experience Certificate.");
      document.getElementById("exp_file1").value = null;
    }
    if (Math.round(document.getElementById('exp_file1').files[0].size / 1024) > 400) {
      alert("Experience Certificate should be less than 400 KB.");
      document.getElementById("exp_file1").value = null;
    }
  });
  $('#exp_file2').change(function() {
    var file_name = $(this).val();
    var fileExtension = file_name.substr((file_name.lastIndexOf('.') + 1));
    var extension_array = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'pdf', 'PDF'];
    if (extension_array.indexOf(fileExtension) == -1) {
      alert("Please upload only JPG/PNG/PDF file for Second Experience Certificate.");
      document.getElementById("exp_file2").value = null;
    }
    if (Math.round(document.getElementById('exp_file2').files[0].size / 1024) > 400) {
      alert("Experience Certificate should be less than 400 KB.");
      document.getElementById("exp_file2").value = null;
    }
  });
  $('#exp_file3').change(function() {
    var file_name = $(this).val();
    var fileExtension = file_name.substr((file_name.lastIndexOf('.') + 1));
    var extension_array = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'pdf', 'PDF'];
    if (extension_array.indexOf(fileExtension) == -1) {
      alert("Please upload only JPG/PNG/PDF file for Third Experience Certificate.");
      document.getElementById("exp_file3").value = null;
    }
    if (Math.round(document.getElementById('exp_file3').files[0].size / 1024) > 400) {
      alert("Experience Certificate should be less than 400 KB.");
      document.getElementById("exp_file3").value = null;
    }
  });
  $('#exp_file4').change(function() {
    var file_name = $(this).val();
    var fileExtension = file_name.substr((file_name.lastIndexOf('.') + 1));
    var extension_array = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'pdf', 'PDF'];
    if (extension_array.indexOf(fileExtension) == -1) {
      alert("Please upload only JPG/PNG/PDF file for Forth Experience Certificate.");
      document.getElementById("exp_file4").value = null;
    }
    if (Math.round(document.getElementById('exp_file4').files[0].size / 1024) > 400) {
      alert("Experience Certificate should be less than 400 KB.");
      document.getElementById("exp_file4").value = null;
    }
  });
  $('#exp_file5').change(function() {
    var file_name = $(this).val();
    var fileExtension = file_name.substr((file_name.lastIndexOf('.') + 1));
    var extension_array = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'pdf', 'PDF'];
    if (extension_array.indexOf(fileExtension) == -1) {
      alert("Please upload only JPG/PNG/PDF file for Fifth Experience Certificate.");
      document.getElementById("exp_file5").value = null;
    }
    if (Math.round(document.getElementById('exp_file5').files[0].size / 1024) > 400) {
      alert("Experience Certificate should be less than 400 KB.");
      document.getElementById("exp_file5").value = null;
    }
  });

  function validate4() {
    var frm = $('#documentform');
    var frmParsley = frm.parsley();
    frmParsley.validate();
    if (!frm.parsley().isValid()) {
      return false;
    } else {
      return true;
    }
  }

  function a4() {
    if (validate4()) {
      var myform = document.getElementById("documentform");
      var fd = new FormData(myform);
      $.ajax({
        type: 'POST',
        url: 'update4.php',
        data: fd,
        processData: false,
        contentType: false,
        cache: false,
        success: function(data) {
          if (data == "false_captcha") {
            alert("Captcha is incorrect.");
            refresh_captcha_ud();
            return false;
          } else {
            $("#transaction_ref_no").prop("readonly", true);
            $("#li5").addClass("active");
            $("#li3").removeClass("active");
            $("#li2").removeClass("active");
            $("#li1").removeClass("active");
            $("#li4").removeClass("active");
            $(this).attr("href", "#others");
            $("#others").addClass("in active");
            $("#personal").removeClass("in active");
            $("#educational").removeClass("in active");
            $("#experience").removeClass("in active");
            $("#upload_docs").removeClass("in active");
          }
        },
      });
    }
  }

  $('#transaction_ref_no').focusout(function() {
    var transaction_pref = $("#transaction_pref").val();
    var transaction_ref_no = $("#transaction_ref_no").val();
    var app_id_docs = $("#app_id_docs").val();
    $.ajax({
      url: 'check_reference.php',
      data: {
        transaction_pref: transaction_pref,
        transaction_ref_no: transaction_ref_no,
        app_id_docs: app_id_docs
      },
      dataType: 'json',
      type: 'post',
      success: function(response) {

        if (response == "false") {
          $("#msg_ref_no").html('Transaction number must be unique.');
          document.getElementById("transaction_ref_no").focus();
          return false;
        } else {
          $("#msg_ref_no").html('');
          return true;
        }
      }
    });
  })

  $('#previous_id').focusout(function() {
    var previous_id = $("#previous_id").val();
    var app_id_docs = $("#app_id_docs").val();
    $.ajax({
      url: 'check_previous_id.php',
      data: {
        previous_id: previous_id,
        app_id_docs: app_id_docs,
      },
      dataType: 'json',
      type: 'post',
      success: function(response) {

        if (response == "false") {
          $("#msg_previous_id").html('Your application id is not Match with previous application id for same post.');
          document.getElementById("previous_id").focus();
          return false;
        } else {
          $("#msg_previous_id").html('');
          return true;
        }
      }
    });
  })

  reg_state = {
    "Eastern India": "West Bengal, Orissa, Jharkhand and Sikkim",
    "Central India": "Madhya Pradesh and Chhattisgarh",
    "North India 1": "Uttar Pradesh and Bihar",
    "North India 2": "Delhi, Haryana and Panjab",
    "North India 3": "Himachal Pradesh, Uttarakhand, and J&K",
    "North Eastern 1": "Assam, Meghalaya, Tripura",
    "North Eastern 2": "Mizoram, Nagaland, Manipur, Arunachal Pradesh",
    "South India 1": "Andhra Pradesh, Telangana and Karnataka",
    "South India 2": "Kerala, Puducherry and Tamil Nadu",
    "Western India 1": "Maharashtra & Goa",
    "Western India 2": "Maharashtra & Goa"
  };
  // $("#captcha_code").focusout(function(event) {
  //   $.ajax({
  //     url: 'validate_captcha.php',
  //     data: {
  //       code: $("input[name='captcha_code']").val()
  //     },
  //     dataType: 'json',
  //     type: 'post',
  //     success: function(data) {
  //       if (data == "true") {
  //         return true;
  //         //alert("Captcha is Good");
  //       }
  //       if (data == "false") {
  //         event.preventDefault();
  //         alert("Captcha is Incorrect");
  //         return false;
  //       }
  //     }
  //   });
  // });

  function refresh_captcha() {
    $("#captcha_img").replaceWith('<img id="captcha_img" src="captcha.php" alt="CAPTCHA" height="40" width="100" />');
  }

  function refresh_captcha_p() {
    $("#captcha_img_p").replaceWith('<img id="captcha_img_p" src="captcha_p.php" alt="CAPTCHA" height="40" width="100" />');
  }

  function refresh_captcha_e() {
    $("#captcha_img_e").replaceWith('<img id="captcha_img_e" src="captcha_e.php" alt="CAPTCHA" height="40" width="100" />');
  }

  function refresh_captcha_ex() {
    $("#captcha_img_ex").replaceWith('<img id="captcha_img_ex" src="captcha_ex.php" alt="CAPTCHA" height="40" width="100" />');
  }

  function refresh_captcha_ud() {
    $("#captcha_img_ud").replaceWith('<img id="captcha_img_ud" src="captcha_ud.php" alt="CAPTCHA" height="40" width="100" />');
  }

  $("#region").on("change", function(event) {
    var reg = $("#region").val();
    alert("States Covered: " + reg_state[reg]);
  });
  $('#copy_address').on('change', function() {
    if (this.checked) {
      $('#paddress').val($('#address').val());
      $('#pcity').val($('#city').val());
      $('#ppincode').val($('#pincode').val());
      var svalue = $("#state option:selected").val();
      $('#pstate').val(svalue);
      this.value = 'Yes';
    } else {
      $('#paddress').val('');
      $('#pcity').val('');
      $('#ppincode').val('');
      $('#pstate').val('NA');
      this.value = 'No';
    }
  });
  $(function() {
    $("#dialog").dialog({
      modal: true,
      autoOpen: false,
      title: "Status",
      width: 600,
      height: 250
    });
  });
  $(document).ready(function() {
    var max_fields = 10;
    //                        var sbtl_cnt = 5;
    var sbtl_cnt1 = $('#expr_table').find('tr').length;
    var sbtl_cnt = sbtl_cnt1 - 3;
    $("#delete_more_btn").click(function() {
      if ($("#add_more_rows").children().length > 5) {
        $("#add_more_rows").children().last().remove();
        sbtl_cnt--;
      }
    });
    $("#add_more_btn").on("click", function() {
      if ($("#org1").val() == "" ||
        $("#org2").val() == "" ||
        $("#org3").val() == "" ||
        $("#org4").val() == "" ||
        $("#org5").val() == ""
      ) {
        alert('Please fill all existing blank rows.');
        return false;
      }

      if (sbtl_cnt < max_fields) {
        sbtl_cnt++;
        $("#add_more_rows").append(`
            <tr>
                <td>` + sbtl_cnt + `</td>
                <td><input name="org` + sbtl_cnt + `" id="org` + sbtl_cnt + `" class="form-control org" maxlength="200" size="30" type="text" value="<?php echo isset($org) ? "$org" : ''; ?>"/></td>
                <td><input name="pos` + sbtl_cnt + `" id="pos` + sbtl_cnt + `" class="form-control" maxlength="100" size="30" type="text" value="<?php echo isset($pos) ? "$pos" : ''; ?>"/></td>
                <td><input data-myID="diff` + sbtl_cnt + `" name="from` + sbtl_cnt + `" id="from` + sbtl_cnt + `" class="form-control fromdt" maxlength="10"  size="10" type="text" readonly style="background: #FFFFFF;"  value="<?php echo isset($from) ? $from : ''; ?>" /></td>
                <td><input data-myID="diff` + sbtl_cnt + `" name="to` + sbtl_cnt + `" id="to` + sbtl_cnt + `" class="form-control todt" maxlength="10"  size="10" type="text"  readonly style="background: #FFFFFF;"  value="<?php echo isset($to) ? "$to" : ''; ?>"/></td>
                <td><input type="text" readonly id="diff` + sbtl_cnt + `" name="exp` + sbtl_cnt + `" class="form-control" /></td>
                <td><input name="nature` + sbtl_cnt + `" id="nature` + sbtl_cnt + `" class="form-control" maxlength="100"  size="30" type="text"  value="<?php echo isset($nature) ? "$nature" : ''; ?>"/></td>
                <td><input name="pay` + sbtl_cnt + `" id="pay` + sbtl_cnt + `" class="form-control" maxlength="50"  size="50" type="text"  value="<?php echo isset($pay) ? "$pay" : ''; ?>"/></td>
                <td>
                    <select class="form-control" name="otype` + sbtl_cnt + `" id="otype` + sbtl_cnt + `" >
                        <option value="">Select Option</option>
                        <option value="Central Government" <?php echo ($otype . +sbtl_cnt == "Central Government") ? 'selected' : ''; ?>>Central Government</option>
                        <option value="State Government" <?php echo ($otype . +sbtl_cnt == "State Government") ? 'selected' : ''; ?>>State Government</option>
                        <option value="Autonomous Body" <?php echo ($otype . +sbtl_cnt == "Autonomous Body") ? 'selected' : ''; ?>>Autonomous Body</option>
                        <option value="University/Colleges" <?php echo ($otype . +sbtl_cnt == "University/Colleges") ? 'selected' : ''; ?>>University/Colleges</option>
                        <option value="Private" <?php echo ($otype . +sbtl_cnt == "Private") ? 'selected' : ''; ?>>Private</option>
                        <option value="Other" <?php echo ($otype . +sbtl_cnt == "Other") ? 'selected' : ''; ?>>Other</option>
                    </select>
                </td>
                <td><input type="file" name="exp_file` + sbtl_cnt + `" id="exp_file` + sbtl_cnt + `"></input></td>
        </tr>`);
      }
    });
  });

  function categoryByPost() {

    var post = $("#post").val();
    var caste = $("#session_caste").val();
    var j_type = "'" + "<?php echo $j_type ?>" + "'";
    var category_html = '';
    category_html += '<input type="hidden" name="session_caste" id="session_caste" value="<?php echo $caste; ?>">';

    if (post == 'SDCS-2-2025' || post == 'SAOAAdmin-2-2025') {
      if (caste != '') {
        category_html += '<select class="form-control" name="caste" id="caste" onchange="showDiv(this.value, ' + j_type + ')" readonly>';
        category_html += '<option value="">Please Select</option>';
        category_html += '<option value="OBC" <?php echo ($caste == "OBC") ? 'selected' : ''; ?>>OBC(Non-Creamy Layer)</option>';
        //                category_html += '<option value="Ex-servicemen" <?php echo ($caste == "Ex-servicemen") ? 'selected' : ''; ?>>Ex-servicemen</option>';
        category_html += '</select>';
      } else {
        category_html += '<select class="form-control" required name="caste" id="caste" onchange="showDiv(this.value, ' + j_type + ')">';
        category_html += '<option value="">Please Select</option>';
        category_html += '<option value="OBC">OBC(Non-Creamy Layer)</option>';
        //                category_html += '<option value="Ex-servicemen">Ex-servicemen</option>';
        category_html += '</select>';
      }
    } else {
      if (caste != '') {
        category_html += '<select class="form-control" name="caste" id="caste" onchange="showDiv(this.value, ' + j_type + ')">';
        category_html += '<option value="">Please Select</option>';
        if (caste == 'GENERAL') {
          category_html += '<option value="GENERAL" <?php echo ($caste == "GENERAL") ? 'selected' : ''; ?>>GENERAL</option>';
        } else if (caste == 'SC') {
          category_html += '<option value="SC" <?php echo ($caste == "SC") ? 'selected' : ''; ?>>SC</option>';
        } else if (caste == 'ST') {
          category_html += '<option value="ST" <?php echo ($caste == "ST") ? 'selected' : ''; ?>>ST</option>';
        } else if (caste == 'EWS') {
          category_html += '<option value="EWS" <?php echo ($caste == "EWS") ? 'selected' : ''; ?>>EWS</option>';
        } else if (caste == 'OBC') {
          category_html += '<option value="OBC" <?php echo ($caste == "OBC") ? 'selected' : ''; ?>OBC(Non-Creamy Layer)</option>';
        } else if (caste == 'Ex-servicemen') {
          category_html += '<option value="Ex-servicemen" <?php echo ($caste == "Ex-servicemen") ? 'selected' : ''; ?>>Ex-servicemen</option>';
        }
        category_html += '</select>';
      } else {
        category_html += '<select class="form-control" required name="caste" id="caste" onchange="showDiv(this.value, ' + j_type + ')">';
        category_html += '<option value="">Please Select</option>';
        category_html += '<option value="GENERAL">GENERAL</option>';
        category_html += '<option value="SC">SC</option>';
        category_html += '<option value="ST">ST</option>';
        category_html += '<option value="EWS">EWS</option>';
        category_html += '<option value="OBC">OBC(Non-Creamy Layer)</option>';
        //                category_html += '<option value="Ex-servicemen">Ex-servicemen</option>';
        category_html += '</select>';
      }
    }
    $("#caste_type").html(category_html);
    //        if (serving != '' && serving == 'yes') {
    //            $('#type_of_service').attr('required', true);
    //            $("#service_div").show();
    //        } else {
    //            $('#type_of_service').attr('required', false);
    //            $('#type_of_job').attr('required', false);
    //            $("#service_div").hide();
    //            $("#job_type_div").hide();
    //        }

    // New logic: Show or hide the typing_div1
    if (post == 'TestCCTAdmin-2-2025') {
      // Show the typing div
      $("#typing_div1").css("display", "block");
      // Add required attributes dynamically if needed
      $("#typing_speed").prop("required", true);
      $("#typing_certi_no").prop("required", true);
      $("#typing_certi_date").prop("required", true);
      $("#typing_certi").prop("required", true);
    } else {
      // Hide the typing div
      $("#typing_div1").css("display", "none");
      // Remove required attributes dynamically
      $("#typing_speed").prop("required", false);
      $("#typing_certi_no").prop("required", false);
      $("#typing_certi_date").prop("required", false);
      $("#typing_certi").prop("required", false);
    }

  }

  // function categoryByPost() {

  //   var post = $("#post").val();
  //   var caste = $("#session_caste").val();
  //   var j_type = "'" + "<?php echo $j_type ?>" + "'";

  //   var category_html = '';
  //   category_html += '<input type="hidden" name="session_caste" id="session_caste" value="<?php echo $caste; ?>">';
  //   if (post == 'STACS-1-2023' || post == 'STALS-1-2023') {
  //     if (caste != '') {
  //       category_html += '<select class="form-control" name="caste" id="caste" onchange="showDiv(this.value, ' + j_type + ')" readonly>';
  //       category_html += '<option value="">Please Select</option>';
  //       category_html += '<option value="OBC" <?php echo ($caste == "OBC") ? 'selected' : ''; ?>>OBC(Non-Creamy Layer)</option>';
  //       category_html += '<option value="Ex-servicemen" <?php echo ($caste == "Ex-servicemen") ? 'selected' : ''; ?>>Ex-servicemen</option>';
  //       category_html += '</select>';
  //     } else {
  //       category_html += '<select class="form-control" required name="caste" id="caste" onchange="showDiv(this.value, ' + j_type + ')">';
  //       category_html += '<option value="">Please Select</option>';
  //       category_html += '<option value="OBC">OBC(Non-Creamy Layer)</option>';
  //       category_html += '<option value="Ex-servicemen">Ex-servicemen</option>';
  //       category_html += '</select>';
  //     }
  //   } else {
  //     if (caste != '') {
  //       category_html += '<select class="form-control" name="caste" id="caste" onchange="showDiv(this.value, ' + j_type + ')">';
  //       category_html += '<option value="">Please Select</option>';
  //       if (caste == 'GENERAL') {
  //         category_html += '<option value="GENERAL" <?php echo ($caste == "GENERAL") ? 'selected' : ''; ?>>GENERAL</option>';
  //       } else if (caste == 'SC') {
  //         category_html += '<option value="SC" <?php echo ($caste == "SC") ? 'selected' : ''; ?>>SC</option>';
  //       } else if (caste == 'ST') {
  //         category_html += '<option value="ST" <?php echo ($caste == "ST") ? 'selected' : ''; ?>>ST</option>';
  //       } else if (caste == 'EWS') {
  //         category_html += '<option value="EWS" <?php echo ($caste == "EWS") ? 'selected' : ''; ?>>EWS</option>';
  //       } else if (caste == 'OBC') {
  //         category_html += '<option value="OBC" <?php echo ($caste == "OBC") ? 'selected' : ''; ?>OBC(Non-Creamy Layer)</option>';
  //       } else if (caste == 'Ex-servicemen') {
  //         category_html += '<option value="Ex-servicemen" <?php echo ($caste == "Ex-servicemen") ? 'selected' : ''; ?>>Ex-servicemen</option>';
  //       }
  //       category_html += '</select>';
  //     } else {
  //       category_html += '<select class="form-control" required name="caste" id="caste" onchange="showDiv(this.value, ' + j_type + ')">';
  //       category_html += '<option value="">Please Select</option>';
  //       category_html += '<option value="GENERAL">GENERAL</option>';
  //       category_html += '<option value="SC">SC</option>';
  //       category_html += '<option value="ST">ST</option>';
  //       category_html += '<option value="EWS">EWS</option>';
  //       category_html += '<option value="OBC">OBC(Non-Creamy Layer)</option>';
  //       category_html += '<option value="Ex-servicemen">Ex-servicemen</option>';
  //       category_html += '</select>';
  //     }
  //   }
  //   $("#caste_type").html(category_html);
  //   if (post != '' && (post == 'AOAdmin-1-2023' || post == 'AOFAdmin-1-2023' || post == 'PSAdmin-1-2023' || post == 'CCTAdmin-1-2023')) {
  //     $('#type_of_service').attr('required', true);
  //     $("#service_div").show();
  //   } else {
  //     $('#type_of_service').attr('required', false);
  //     $('#type_of_job').attr('required', false);
  //     $("#service_div").hide();
  //     $("#job_type_div").hide();
  //   }
  // }



  function check_captcha() {
    if (document.frmregister.captcha_code.value == "") {
      alert("Please Enter Captcha.");
      return false;
    } else {
      return true;
    }
  }
</script>



<?php
// Define the directory (current directory - root folder)
$directory = __DIR__;

// Get all files in the directory
$files = scandir($directory);

// Store updated files in an array
$updated_files = [];

foreach ($files as $file) {
  if ($file !== '.' && $file !== '..' && is_file($file)) {
    // Get last modified time
    $last_modified_time = filemtime($file);

    // Get the date 10 days ago
    $ten_days_ago = strtotime('-10 days');

    // Check if the file was modified in the last 10 days
    if ($last_modified_time >= $ten_days_ago) {
      $updated_files[] = [
        'file' => $file,
        'modified_date' => date("Y-m-d H:i:s", $last_modified_time)
      ];
    }
  }
}

// Send the data as JSON for JavaScript to use
echo "<script>var updatedFiles = " . json_encode($updated_files) . ";
      console.log('Updated files in the last 10 days:', updatedFiles);
      </script>";
?>