<?php
error_reporting(0);
session_start();
if ($_SESSION['is_login'] != 'true') {
    header("Location: ./Admin_login.php");
    exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Print Application</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
    </link>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    </link>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" language="javascript" src="js/validate.js"></script>
    <link href="css/custom.css" rel="stylesheet">
    </link>
    <style type="text/css">
        .form-control {
            min-height: 38px;
            color: #000000;
            background: rgba(255, 255, 255);
            border-radius: 5px;
        }

        a {
            color: #0060c6;
        }

        a:hover {
            color: #ff7171;
        }

        @media print {
            a[href]:after {
                display: none;
                visibility: hidden;
            }
        }
    </style>
</head>
<style type='text/css' media='print'>
    #print_btn {
        display: none
    }

    #exit_btn {
        display: none
    }
</style>

<body>

    <form>
        <?php
        include "dbConfig.php";
        // session_start();

        $regid = $_GET['id'];
        //            $sql = "select prsnl.id as app_id,prsnl.*,edctn.*,exprn.*,othrs.* from prsnl,edctn,exprn,othrs where othrs.id ='$regid' and edctn.id ='$regid' and exprn.id ='$regid' and prsnl.id ='$regid'";
        // $sql = "SELECT prsnl.id as app_id, prsnl.*, edctn.*, exprn.*, othrs.*, s.name as state_name, s1.name as pstate_name from prsnl LEFT JOIN edctn on edctn.id=prsnl.id LEFT JOIN exprn on exprn.id=prsnl.id LEFT JOIN othrs on othrs.id=prsnl.id LEFT JOIN states s on s.id=prsnl.state LEFT JOIN states s1 on s1.id=prsnl.pstate WHERE MD5(prsnl.id)='$regid'";

        $sql = "SELECT p.id AS app_id, p.id, p.password, p.job_type, p.prefix, p.surname, p.name, p.fathername, p.lastname, p.dob, p.sex, p.nation, p.address, p.state, p.telephone, p.city, p.pincode, p.paddress, p.pstate, p.pcity, p.ppincode, p.same_address, p.mobile, decrypt_aadhar_no(p.aadhar_no) AS aadhar_no, p.email, p.mstatus, p.post, p.job_location, p.regdate, p.status, p.photo, p.category, p.caste_certi, p.caste_certino, p.caste_certi_issue_year, p.serving, p.type_of_service, p.authority, p.age, p.status_check, p.browser_history, p.is_upload, p.status_remarks, p.disability, p.type_of_disability, p.disability_percentage, p.disability_certi, p.stenoGraphy_speed, p.stenography_certi_no, p.stenography_certi_date, p.stenography_certi, p.typing_speed, p.typing_certi_no, p.typing_certi_date, p.typing_certi, p.typing_language, p.inf_employee, p.payroll_no, p.type_of_job, p.length_of_service, p.service_from_date, p.service_to_date, p.status_date, e.*, ep.*, o.*, s.name AS state_name, s1.name AS pstate_name, re.category AS post_category, re.Name, re.closed_date, re.year, re.exam_date, re.exam_time FROM prsnl p LEFT JOIN edctn e ON p.id = e.id LEFT JOIN exprn ep ON p.id = ep.id LEFT JOIN othrs o ON p.id = o.id LEFT JOIN states s ON s.id = p.state LEFT JOIN states s1 ON s1.id = p.pstate LEFT JOIN req_experience re ON re.post = p.post WHERE MD5(p.id) = '$regid'";

        $result = mysqli_query($link, $sql);

        while ($row = mysqli_fetch_assoc($result)) {

            $query2 = "select * from req_experience";
            $result2 = mysqli_query($link, $query2);
            if (mysqli_num_rows($result2) > 0) {
                while ($row2 = mysqli_fetch_assoc($result2)) {

                    if ($row2['category'] == "Finance") {
                        $post_category = "Admin";
                    } else {
                        $post_category = $row2['category'];
                    }

                    if ($row2['category'] == '') {
                        $val = $row2['post_id'] . '-' . $row2['sequence'] . '-' . $row2['year'];
                        if ($row['post'] == $val) {
                            $post_name = $row2['Name'];
                            $closing_date = $row2['closed_date'];
                        }
                    } else {
                        $val = $row2['post_id'] . $post_category . '-' . $row2['sequence'] . '-' . $row2['year'];
                        if ($row['post'] == $val) {
                            $post_name = $row2['Name'] . '(' . $row2['category'] . ')';
                            $closing_date = $row2['closed_date'];
                        }
                    }
                }
            }
        ?>
            <div class="container" style="padding-top:10px;
                        padding-bottom: 23px;
                        border-radius: 5px;">
                <div class="header_main1 mb30">
                    <img src="images/logo.png" class="img-responsive inf-logo" />
                    <h3 class="inf-title pull-left">
                        <b>Information and Library Network Centre, Gandhinagar</b><br />
                        <p style="padding-top:10px;"><small><strong>Online Application Form</strong></small></p>
                    </h3>

                </div>
                <br />

                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-primary check_status" value="<?php echo $row['app_id']; ?>" data-encid="<?php echo md5($row['app_id']); ?>" data-value="Eligible" user-id="<?php echo $_SESSION['user']; ?>" <?php echo ($row['status_check'] == 'Eligible') ? 'disabled' : '' ?>>Eligible</button>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal1" <?php echo ($row['status_check'] == 'NotEligible') ? 'disabled' : '' ?>>Not Eligible</button>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" <?php echo ($row['status_check'] == 'Provisionally') ? 'disabled' : '' ?>>Provisionally Eligible</button>
                        <?php
                        if ($row['status_check'] <> 'Eligible') {
                            echo "<b>Remarks:</b>" . $row['status_remarks'];
                        }
                        ?>
                        <button type="button" class="btn btn-primary" <?php if ($row['testimonials'] != '') { ?> data-toggle="tooltip" data-placement="bottom" <?php } else { ?> data-toggle="modal" data-target="#ModalTestimonials" <?php } ?> style="float:right;
                                        margin-left:10px;" <?php
                                                            if ($row['hard_copy_received'] != 'Yes' || $row['testimonials'] != '') {
                                                                echo 'disabled';
                                                            }
                                                            ?> title="<?php echo $row['testimonials']; ?>">Testimonials</button>

                        <button type="button" class="btn btn-primary" <?php if ($row['hard_copy_received'] == 'Yes') { ?> data-toggle="tooltip" data-placement="bottom" <?php } else { ?> data-toggle="modal" data-target="#ModalHardcopy" <?php } ?> style="float:right;" <?php echo ($row['hard_copy_received'] == 'Yes') ? 'disabled' : '' ?> title="Inward No.: <?php echo $row['inward_no']; ?> || Date : <?php echo date('d-m-Y', strtotime($row['inward_date'])); ?>">Hard Copy Received</button>
                        <!--<button type="button" class="btn btn-primary hardcopy" data-toggle="modal" data-target="#ModalHardcopy" style="float:right;" value="<?php echo $row['app_id']; ?>" data-value="Yes" <?php echo ($row['hard_copy_received'] == 'Yes') ? 'disabled' : '' ?>>Hard Copy Received</button>-->
                        <br />
                        <br />
                        <!-- Modal -->
                        <div class="modal fade" id="myModal1" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Remarks for Not-Eligible</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form id="remarks_form1" action="" method="post">
                                            <input type="hidden" name="candidate_id1" id="candidate_id1" value="<?php echo $row['app_id']; ?>"></input>
                                            <input type="hidden" name="status_values1" id="status_values1" value="NotEligible"></input>
                                            <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['user']; ?>"></input>
                                            <input type="hidden" name="enc_id" id="enc_id" value="<?php echo md5($row['app_id']); ?>"></input>
                                            <textarea name="provisionally_remarks1" class="form-control" id="provisionally_remarks1" rows="2" style="width: 100%" required="required"></textarea>
                                            <br />
                                            <button type="button" class="btn btn-primary" onclick="s_sub1()">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Remarks for Provisionally Eligible</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form id="remarks_form" action="" method="post">
                                            <input type="hidden" name="candidate_id" id="candidate_id" value="<?php echo $row['app_id']; ?>"></input>
                                            <input type="hidden" name="status_values" id="status_values" value="Provisionally"></input>
                                            <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['user']; ?>"></input>
                                            <input type="hidden" name="enc_id" id="enc_id" value="<?php echo md5($row['app_id']); ?>"></input>
                                            <textarea name="provisionally_remarks" class="form-control" id="provisionally_remarks" rows="2" style="width: 100%" required="required"></textarea>
                                            <br />
                                            <button type="button" class="btn btn-primary" onclick="s_sub()">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="ModalHardcopy" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Hard Copy Received</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form id="hardcopy_form" action="" method="post">
                                            <div class="row">
                                                <input type="hidden" name="candidate_id" id="candidate_id" value="<?php echo $row['app_id']; ?>"></input>
                                                <input type="hidden" name="hard_copy_received" id="hard_copy_received" value="Yes"></input>
                                                <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['user']; ?>"></input>
                                                <input type="hidden" name="enc_id" id="enc_id" value="<?php echo md5($row['app_id']); ?>"></input>
                                                <div class="col-md-6">
                                                    <lable>Inward Number</lable>
                                                    <input type="text" name="inward_no" id="inward_no" class="form-control" required></input>
                                                </div>
                                                <div class="col-md-6">
                                                    <lable>Inward Date</lable>
                                                    <input type="date" name="inward_date" id="inward_date" class="form-control" required></input>
                                                </div>
                                                <div class="col-md-12">
                                                    <br />
                                                    <button type="button" class="btn btn-primary hardcopy_submit">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="ModalTestimonials" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Testimonials</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form id="remarks_form" action="" method="post">
                                            <input type="hidden" name="candidate_id" id="candidate_id" value="<?php echo $row['app_id']; ?>"></input>
                                            <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['user']; ?>"></input>
                                            <input type="hidden" name="enc_id" id="enc_id" value="<?php echo md5($row['app_id']); ?>"></input>
                                            <textarea name="testimonials" class="form-control" id="testimonials" rows="2" style="width: 100%" required="required"></textarea>
                                            <br />
                                            <button type="button" class="btn btn-primary testimonials_submit">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <b>Application ID : </b><?php echo $row['app_id']; ?>
                    </div>
                    <div class="col-md-4">
                        <b>Post Applied for : </b><?php echo $post_name; ?>
                    </div>
                    <?php if (strpos($row['app_id'], '2019') == false) { ?>
                        <div class="col-md-4">
                            <b>Transaction Number : </b><?php echo $row['transaction_ref_no']; ?><br />
                            <!--<a href="<?php echo $row['fees_receipt']; ?>" target="_blank">View Receipt</a>-->
                        </div>
                        <div class="col-md-4">
                            <!-- <b>Transaction Date (MM/DD/YYYY): </b><?php echo date("d/m/Y", strtotime($row['dd_date'])); ?> -->


                            <b>Transaction Date (MM/DD/YYYY): </b>
                            <?php
                            echo ($row['dd_date'] == "NA") ? "NA" : date("d/m/Y", strtotime($row['dd_date']));
                            ?>



                        </div>
                        <div class="col-md-4">
                            <b>Transaction Amount : </b><?php echo $row['dd_amount']; ?> Rs/-
                        </div>
                        <!--                            <div class="col-md-4">
                                                                <b>Bank Name : </b><?php //echo $row['bank_name'] . ', ' . $row['branch_name'];
                                                                                    ?>
                                                            </div>-->
                    <?php } ?>
                    <?php if ($row['job_type'] == 'Contractual') { ?>
                        <div class="col-md-4">
                            <span class=""><b>Job Location : </b><?php
                                                                    echo $row['job_location'];
                                                                    ?></span>
                        </div>
                    <?php } ?>
                </div>
                <br />
                <div style="overflow:auto">
                    <table class="form" border="1" width="100%">
                        <tr height="20%">
                            <td align="left" colspan="4"><strong>1. Personal/Contact Information</strong>
                            </td>

                        </tr>
                        <tr>
                            <td width="20%" style="position:relative;">Name:</td>
                            <td border-right="0px" style="position:relative;
                                    border:0"><?php echo strtoupper($row['prefix']) . "  " . strtoupper($row['name']) . " " . strtoupper($row['fathername']) . " " . strtoupper($row['surname']); ?> </td>

                            <td rowspan="3" colspan="2" width="8%" style="position:relative;
                                        border:0;
                                        border-right: 1px lightgray solid">
                                <?php
                                $photo = $row['photo'];
                                ?>
                                <img src='<?php echo $photo ?> ' height="150" width="140" align="right" />
                            </td>
                        </tr>
                        <tr>
                            <td width="20%" style="position:relative;">Date of Birth (MM/DD/YYYY):</td>
                            <!--<td width="30%" style="position:relative;border:0"><?php echo date('F j, Y', strtotime($row['dob'])); ?></td>  -->
                            <td width="30%" style="position:relative;
                                    border:0"><?php echo date("d/m/Y", strtotime($row['dob'])) . "<br/><b>Age: </b>" . $row['age']; ?></td>

                        </tr>
                        <tr>
                            <td width="20%" style="position:relative;">Category:</td>
                            <td width="30%" style="position:relative;
                                        border:0;
                                        border-right:1px"><?php echo $row['category']; ?>
                                <?php
                                if ($row['category'] == "Ex-servicemen") {
                                    echo '<br/>(From: ' . $row['service_from_date'] . ' - To: ' . $row['service_to_date'] . ')';
                                    echo '<br/>(' . $row['length_of_service'] . ')';
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                        if ($row['category'] != 'GENERAL') {
                            if ($row['category'] != 'Ex-servicemen') {
                        ?>
                                <tr>
                                    <td width="20%" style="position:relative">Caste Certificate Issue Year :</td>
                                    <td width="30%" style="position:relative">
                                        <?php
                                        if ($row['caste_certi_issue_year'] != '') {
                                            echo $row['caste_certi_issue_year'];
                                        }
                                        ?>
                                    </td>
                                    <td width="20%">Caste Certificate Number:</td>
                                    <td width="30%">
                                        <?php
                                        if ($row['caste_certino'] != '') {
                                            echo $row['caste_certino'];
                                        }
                                        ?>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                        <?php if (strpos($row['app_id'], '2019') == false) { ?>
                            <tr>
                                <td width="20%" style="position:relative">Do you belongs to Person with Benchmark Disability(PwBD)?</td>
                                <td width="30%" style="position:relative">
                                    <?php
                                    if ($row['disability'] != '') {
                                        echo $row['disability'];
                                    }
                                    ?>
                                </td>
                                <td width="20%" style="position:relative">Percentage of Disability</td>
                                <td width="30%" style="position:relative">
                                    <?php
                                    if ($row['disability_percentage'] != '') {
                                        echo $row['disability_percentage'];
                                    } else {
                                        echo "-";
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td>Are you Serving?</td>
                            <td colspan="3"><?php echo $row['serving']; ?></td>
                        </tr>
                        <?php if ($row['serving'] == 'Yes') { ?>
                            <tr>
                                <td width="20%" style="position:relative">Type of Service</td>
                                <td width="30%" style="position:relative" <?php if ($row['type_of_service'] == 'Not Applicable') { ?>colspan="3" <?php } ?>><?php echo $row['type_of_service']; ?></td>
                                <?php if ($row['type_of_service'] != 'Not Applicable' && $row['type_of_service'] != '') { ?>
                                    <td width="20%" style="position:relative">Type of Job</td>
                                    <td width="30%" style="position:relative"><?php echo $row['type_of_job']; ?></td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td width="20%" style="position:relative">Gender</td>
                            <td width="30%" style="position:relative"><?php echo $row['sex']; ?></td>
                            <td width="20%">Marital Status:</td>
                            <td width="30%"><?php echo $row['mstatus']; ?></td>
                        </tr>
                        <?php if ($row['post'] == "AOAdmin-1-2023" || $row['post'] == "AOFAdmin-1-2023") { ?>
                            <tr>
                                <td width="20%" style="position:relative;">Type of Service (Regular Payroll):</td>
                                <td width="30%" style="position:relative;"> <?php echo $row['type_of_service']; ?></td>
                                <td width="20%">Nationality:</td>
                                <td width="30%"><?php echo $row['nation']; ?> </td>
                            </tr>
                        <?php } else { ?>
                            <td width="20%">Nationality:</td>
                            <td colspan="3" width="30%"><?php echo $row['nation']; ?> </td>
                        <?php } ?>
                        <tr>
                            <td width="20%" style="position:relative">Mailing Address:</td>
                            <td colspan="3" width="80%" style="position:relative"><?php echo $row['address']; ?>, <?php echo $row['city']; ?>, <?php echo $row['state_name']; ?> - <?php echo $row['pincode']; ?> </td>

                        </tr>

                        <tr>
                            <td width="20%" style="position:relative">Permanent Address:</td>
                            <td colspan="3" width="80%" style="position:relative"><?php echo $row['paddress']; ?>, <?php echo $row['pcity']; ?>, <?php echo $row['pstate_name']; ?> - <?php echo $row['ppincode']; ?></td>

                        </tr>
                        <tr>
                            <td width="20%" style="position:relative;">Email:</td>
                            <td width="30%" style="position:relative;" colspan="1"><?php echo $row['email']; ?> </td>
                            <td width="20%">Mobile:</td>
                            <td width="30%"><?php echo $row['mobile']; ?></td>
                        </tr>
                        <tr>
                            <td width="20%" style="position:relative;">Telephone:</td>
                            <td width="30%" style="position:relative;"><?php echo ($row['telephone'] != '') ? $row['telephone'] : "-"; ?></td>
                            <td width="20%">Aadhaar Number:</td>
                            <td width="30%"><?php echo ($row['aadhar_no'] != '') ? $row['aadhar_no'] : "-"; ?></td>
                        </tr>
                        <?php if ($row['post'] == "PSAdmin-2-2023") { ?>
                            <tr>
                                <td width="20%" style="position:relative;">StenoGraphy Speed:</td>
                                <td width="30%" style="position:relative;"><?php echo ($row['stenoGraphy_speed'] != '') ? $row['stenoGraphy_speed'] : "-"; ?></td>
                                <td width="20%">Typing Speed:</td>
                                <td width="30%"><?php echo ($row['typing_speed'] != '') ? $row['typing_speed'] : "-"; ?></td>
                            </tr>
                            <tr>
                                <td width="20%" style="position:relative;">StenoGraphy Certificate Number:</td>
                                <td width="30%" style="position:relative;"><?php echo ($row['stenography_certi_no'] != '') ? $row['stenography_certi_no'] : "-"; ?></td>
                                <td width="20%">Typing Certificate Number:</td>
                                <td width="30%"><?php echo ($row['typing_certi_no'] != '') ? $row['typing_certi_no'] : "-"; ?></td>
                            </tr>
                            <tr>
                                <td width="20%" style="position:relative;">StenoGraphy Certificate Date:</td>
                                <td width="30%" style="position:relative;"><?php echo ($row['stenography_certi_date'] != '') ? $row['stenography_certi_date'] : "-"; ?></td>
                                <td width="20%">Typing Certificate Date:</td>
                                <td width="30%"><?php echo ($row['typing_certi_date'] != '') ? $row['typing_certi_date'] : "-"; ?></td>
                            </tr>
                        <?php } else if ($row['post'] == "TestCCTAdmin-2-2025") { ?>
                            <tr>
                                <td width="20%">Typing Speed:</td>
                                <td width="30%"><?php echo ($row['typing_speed'] != '') ? $row['typing_speed'] . '(' . $row['typing_language'] . ')' : "-"; ?></td>
                                <td width="20%">Typing Certificate Number:</td>
                                <td width="30%"><?php echo ($row['typing_certi_no'] != '') ? $row['typing_certi_no'] : "-"; ?></td>
                            </tr>
                            <tr>
                                <td width="20%">Typing Certificate Date:</td>
                                <td width="30%"><?php echo ($row['typing_certi_date'] != '') ? $row['typing_certi_date'] : "-"; ?></td>
                                <td width="20%"></td>
                                <td width="30%"></td>
                            </tr>
                        <?php } ?>
                        <?php if (strpos($row['app_id'], '2019') == false) { ?>
                            <tr>
                                <td width="20%" style="position:relative;">Are you Regular Employee of INFLIBNET Centre?:</td>
                                <td width="30%" style="position:relative;"><?php echo $row['inf_employee']; ?></td>
                                <td width="20%">Payroll Number:</td>
                                <td width="30%"><?php echo ($row['payroll_no'] != '') ? $row['payroll_no'] : "-"; ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
                <br />

                <table class="form" width="100%" border="1">
                    <tr align="center">
                        <td colspan="8">
                            <p><strong>2. Educational/Professional Qualification: </strong></p>
                        </td>
                    </tr>

                    <tr>
                        <td width="3%" align="center"><strong>Sr.no</strong></td>
                        <td width="18%" valign="middle"><strong>Degree</strong></td>
                        <td width="24%" valign="middle"><strong>Specialization</strong></td>
                        <td width="24%" valign="middle"><strong>
                                <p>College/University/Institution</p>
                            </strong></td>
                        <td width="10%" valign="middle">
                            <p><strong>Passing Year (Month,Year)</strong></p>
                        </td>
                        <td width="9%" valign="middle">
                            <p><strong>Percentage</strong></p>
                            <p><strong> of Marks</strong><strong>(%)</strong> </p>
                        </td>
                        <td width="12%" valign="middle"><strong>
                                <p>Division/</p>
                                <p>Grade</p>
                            </strong></td>

                        <td></td>
                    </tr>
                    <?php if ($row['board6'] <> "") { ?>
                        <tr>
                            <td align="center">1.</td>
                            <td><?php echo $row['edu6']; ?> </td>
                            <td><?php echo $row['spec6']; ?></td>
                            <td><?php echo $row['board6']; ?> </td>
                            <td><?php echo $row['year6']; ?> </td>
                            <td><?php echo $row['per6']; ?> </td>
                            <td><?php echo $row['div6']; ?> </td>
                        </tr>
                    <?php } ?>
                    <?php if ($row['board1'] <> "") { ?>
                        <tr>
                            <td align="center">1.</td>
                            <td><?php echo $row['edu1']; ?> </td>
                            <td><?php echo $row['spec1']; ?></td>
                            <td><?php echo $row['board1']; ?> </td>
                            <td><?php echo $row['year1']; ?> </td>
                            <td><?php echo $row['per1']; ?> </td>
                            <td><?php echo $row['div1']; ?> </td>
                            <td>
                                <?php if ($row['ssc_certi'] != '') { ?>
                                    <a target="_blank" href="<?php echo $row['ssc_certi']; ?>">View</a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($row['spec2'] <> "") { ?>
                        <tr>
                            <td align="center">2.</td>
                            <td><?php echo $row['edu2']; ?> </td>
                            <td><?php echo $row['spec2']; ?></td>
                            <td><?php echo $row['board2']; ?> </td>
                            <td><?php echo $row['year2']; ?> </td>
                            <td><?php echo $row['per2']; ?> </td>
                            <td><?php echo $row['div2']; ?> </td>
                            <td>
                                <?php if ($row['hsc_certi'] != '') { ?>
                                    <a target="_blank" href="<?php echo $row['hsc_certi']; ?>">View</a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($row['spec7'] != "" && $row['post'] == "STACS-1-2023") { ?>
                        <tr>
                            <td align="center"><?php echo ($row['spec2'] <> "") ? '3.' : '2.' ?></td>
                            <td><?php echo $row['edu7']; ?> </td>
                            <td><?php echo $row['spec7']; ?></td>
                            <td><?php echo $row['board7']; ?> </td>
                            <td><?php echo $row['year7']; ?> </td>
                            <td><?php echo $row['per7']; ?> </td>
                            <td><?php echo $row['div7']; ?> </td>
                            <td>
                                <?php if ($row['other_edu_certi'] != '') { ?>
                                    <a target="_blank" href="<?php echo $row['other_edu_certi']; ?>">View</a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>

                    <?php if ($row['spec8'] != "" && $row['post'] == "MTSAdmin-1-2025") { ?>
                        <tr>
                            <td align="center"><?php echo ($row['spec2'] <> "") ? '3.' : '2.' ?></td>
                            <td><?php echo $row['edu8']; ?> </td>
                            <td><?php echo $row['spec8']; ?></td>
                            <td><?php echo $row['board8']; ?> </td>
                            <td><?php echo $row['year8']; ?> </td>
                            <td><?php echo $row['per8']; ?> </td>
                            <td><?php echo $row['div8']; ?> </td>
                            <td>
                                <?php if ($row['comp_certi'] != '') { ?>
                                    <a target="_blank" href="<?php echo $row['comp_certi']; ?>">View</a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>


                    <?php if ($row['board3'] <> "") { ?>
                        <tr>
                            <td align="center"><?php echo ($row['spec7'] <> "") ? '4.' : '3.' ?></td>
                            <td><?php echo $row['edu3']; ?> </td>
                            <td><?php echo $row['spec3']; ?></td>
                            <td><?php echo $row['board3']; ?> </td>
                            <td><?php echo $row['year3']; ?> </td>
                            <td><?php echo $row['per3']; ?> </td>
                            <td><?php echo $row['div3']; ?> </td>
                            <td>
                                <?php if ($row['bachelor_certi'] != '') { ?>
                                    <a target="_blank" href="<?php echo $row['bachelor_certi']; ?>">View</a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($row['board4'] <> "") { ?>
                        <tr>
                            <td align="center"><?php echo ($row['spec7'] <> "") ? '5.' : '4.' ?></td>
                            <td><?php echo $row['edu4']; ?> </td>
                            <td><?php echo $row['spec4']; ?></td>
                            <td><?php echo $row['board4']; ?> </td>
                            <td><?php echo $row['year4']; ?> </td>
                            <td><?php echo $row['per4']; ?> </td>
                            <td><?php echo $row['div4']; ?> </td>
                            <td>
                                <?php if ($row['master_certi'] != '') { ?>
                                    <a target="_blank" href="<?php echo $row['master_certi']; ?>">View</a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($row['board5'] <> "") { ?>
                        <tr>
                            <td align="center"><?php
                                                if ($row['spec7'] <> "") {
                                                    echo '6.';
                                                } else {
                                                    echo '5.';
                                                }
                                                ?></td>
                            <td><?php echo $row['edu5']; ?> </td>
                            <td><?php echo $row['spec5']; ?></td>
                            <td><?php echo $row['board5']; ?> </td>
                            <td><?php echo $row['year5']; ?> </td>
                            <td><?php echo $row['per5']; ?> </td>
                            <td><?php echo $row['div5']; ?> </td>
                            <td>
                                <?php if ($row['phd_certi'] != '') { ?>
                                    <a target="_blank" href="<?php echo $row['phd_certi']; ?>">View</a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </table>

                <br />

                <table class="form" width="100%" border="1">
                    <tr></tr>
                </table>


                <table class="form" width="100%" border="1">
                    <tr align="center">
                        <td colspan="10">
                            <p><strong>3. Experience (Details of previous and present employment held, if any, in chronological order starting from present position)<br />
                                    <font style="color:red"> Total Experience: <?php echo ($row['grandtotal'] != '') ? $row['grandtotal'] : '0 Year'; ?></font>
                                </strong></p>
                        </td>
                    </tr>

                    <tr>
                        <td width="3%" align="center"><strong>Sr.no</strong></td>
                        <td width="27%"><strong>Name of the Organization </strong> </td>
                        <td width="14%"><strong>
                                <p>Position Held </p>
                            </strong></td>
                        <td width="10%">
                            <p><strong>From</strong></p>
                            <p>(DD/MM/YYYY)</p>
                        </td>
                        <td width="9%">
                            <p><strong>To</strong></p>
                            <p>(DD/MM/YYYY)</p>
                        </td>
                        <?php if (strpos($row['app_id'], '2019') == false) { ?>
                            <td><strong>Experience</strong></td>
                        <?php } ?>
                        <td width="20%"><strong>Nature of Duties </strong></td>
                        <td width="12%">
                            <p><strong>
                                    Pay Scale/
                                </strong></p>
                            <p><strong>Gross Salary Rs </strong></p>
                        </td>
                        <td width="20%"><strong>Organization Type </strong></td>
                        <?php if (strpos($row['app_id'], '2019') == false) { ?>
                            <td></td>
                        <?php } ?>
                    </tr>
                    <?php if ($row['org1'] <> "") { ?>
                        <tr>
                            <td align="center">1.</td>
                            <td><?php echo $row['org1']; ?> </td>
                            <td><?php echo $row['pos1']; ?> </td>
                            <td><?php echo $row['from1']; ?> </td>
                            <td><?php echo 'Currently Working :' . $row['currently_working'] . ' - ' . $row['to1']; ?> </td>
                            <?php if (strpos($row['app_id'], '2019') == false) { ?>
                                <td><?php echo $row['exp1']; ?></td>
                            <?php } ?>
                            <td><?php echo $row['nature1']; ?> </td>
                            <td><?php echo $row['pay1']; ?> </td>
                            <td><?php echo $row['otype1']; ?> </td>
                            <?php if (strpos($row['app_id'], '2019') == false) { ?>
                                <td><a target="_blank" href="<?php echo $row['exp_file1']; ?>">View</a></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>

                    <?php if ($row['org2'] <> "") { ?>
                        <tr>
                            <td align="center">2.</td>
                            <td><?php echo $row['org2']; ?> </td>
                            <td><?php echo $row['pos2']; ?> </td>
                            <td><?php echo $row['from2']; ?> </td>
                            <td><?php echo $row['to2']; ?> </td>
                            <?php if (strpos($row['app_id'], '2019') == false) { ?>
                                <td><?php echo $row['exp2']; ?></td>
                            <?php } ?>
                            <td><?php echo $row['nature2']; ?> </td>
                            <td><?php echo $row['pay2']; ?> </td>
                            <td><?php echo $row['otype2']; ?> </td>
                            <?php if (strpos($row['app_id'], '2019') == false) { ?>
                                <td><a target="_blank" href="<?php echo $row['exp_file2']; ?>">View</a></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                    <?php if ($row['org3'] <> "") { ?>
                        <tr>
                            <td align="center">3.</td>
                            <td><?php echo $row['org3']; ?> </td>
                            <td><?php echo $row['pos3']; ?> </td>
                            <td><?php echo $row['from3']; ?> </td>
                            <td><?php echo $row['to3']; ?> </td>
                            <?php if (strpos($row['app_id'], '2019') == false) { ?>
                                <td><?php echo $row['exp3']; ?></td>
                            <?php } ?>
                            <td><?php echo $row['nature3']; ?> </td>
                            <td><?php echo $row['pay3']; ?> </td>
                            <td><?php echo $row['otype3']; ?> </td>
                            <?php if (strpos($row['app_id'], '2019') == false) { ?>
                                <td><a target="_blank" href="<?php echo $row['exp_file3']; ?>">View</a></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                    <?php if ($row['org4'] <> "") { ?>
                        <tr>
                            <td align="center">4.</td>
                            <td><?php echo $row['org4']; ?> </td>
                            <td><?php echo $row['pos4']; ?> </td>
                            <td><?php echo $row['from4']; ?> </td>
                            <td><?php echo $row['to4']; ?> </td>
                            <?php if (strpos($row['app_id'], '2019') == false) { ?>
                                <td><?php echo $row['exp4']; ?></td>
                            <?php } ?>
                            <td><?php echo $row['nature4']; ?> </td>
                            <td><?php echo $row['pay4']; ?> </td>
                            <td><?php echo $row['otype4']; ?> </td>
                            <?php if (strpos($row['app_id'], '2019') == false) { ?>
                                <td><a target="_blank" href="<?php echo $row['exp_file4']; ?>">View</a></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                    <?php if ($row['org5'] <> "") { ?>
                        <tr>
                            <td align="center">5.</td>
                            <td><?php echo $row['org5']; ?> </td>
                            <td><?php echo $row['pos5']; ?> </td>
                            <td><?php echo $row['from5']; ?> </td>
                            <td><?php echo $row['to5']; ?> </td>
                            <?php if (strpos($row['app_id'], '2019') == false) { ?>
                                <td><?php echo $row['exp5']; ?></td>
                            <?php } ?>
                            <td><?php echo $row['nature5']; ?> </td>
                            <td><?php echo $row['pay5']; ?> </td>
                            <td><?php echo $row['otype5']; ?> </td>
                            <?php if (strpos($row['app_id'], '2019') == false) { ?>
                                <td><a target="_blank" href="<?php echo $row['exp_file5']; ?>">View</a></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                    <?php if ($row['org6'] <> "") { ?>
                        <tr>
                            <td align="center">6.</td>
                            <td><?php echo $row['org6']; ?> </td>
                            <td><?php echo $row['pos6']; ?> </td>
                            <td><?php echo $row['from6']; ?> </td>
                            <td><?php echo $row['to6']; ?> </td>
                            <?php if (strpos($row['app_id'], '2019') == false) { ?>
                                <td><?php echo $row['exp6']; ?></td>
                            <?php } ?>
                            <td><?php echo $row['nature6']; ?> </td>
                            <td><?php echo $row['pay6']; ?> </td>
                            <td><?php echo $row['otype6']; ?> </td>
                            <?php if (strpos($row['app_id'], '2019') == false) { ?>
                                <td><a target="_blank" href="<?php echo $row['exp_file6']; ?>">View</a></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                    <?php if ($row['org7'] <> "") { ?>
                        <tr>
                            <td align="center">7.</td>
                            <td><?php echo $row['org7']; ?> </td>
                            <td><?php echo $row['pos7']; ?> </td>
                            <td><?php echo $row['from7']; ?> </td>
                            <td><?php echo $row['to7']; ?> </td>
                            <?php if (strpos($row['app_id'], '2019') == false) { ?>
                                <td><?php echo $row['exp7']; ?></td>
                            <?php } ?>
                            <td><?php echo $row['nature7']; ?> </td>
                            <td><?php echo $row['pay7']; ?> </td>
                            <td><?php echo $row['otype7']; ?> </td>
                            <?php if (strpos($row['app_id'], '2019') == false) { ?>
                                <td><a target="_blank" href="<?php echo $row['exp_file7']; ?>">View</a></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                    <?php if ($row['org8'] <> "") { ?>
                        <tr>
                            <td align="center">8.</td>
                            <td><?php echo $row['org8']; ?> </td>
                            <td><?php echo $row['pos8']; ?> </td>
                            <td><?php echo $row['from8']; ?> </td>
                            <td><?php echo $row['to8']; ?> </td>
                            <?php if (strpos($row['app_id'], '2019') == false) { ?>
                                <td><?php echo $row['exp8']; ?></td>
                            <?php } ?>
                            <td><?php echo $row['nature8']; ?> </td>
                            <td><?php echo $row['pay8']; ?> </td>
                            <td><?php echo $row['otype8']; ?> </td>
                            <?php if (strpos($row['app_id'], '2019') == false) { ?>
                                <td><a target="_blank" href="<?php echo $row['exp_file8']; ?>">View</a></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                    <?php if ($row['org9'] <> "") { ?>
                        <tr>
                            <td align="center">9.</td>
                            <td><?php echo $row['org9']; ?> </td>
                            <td><?php echo $row['pos9']; ?> </td>
                            <td><?php echo $row['from9']; ?> </td>
                            <td><?php echo $row['to9']; ?> </td>
                            <?php if (strpos($row['app_id'], '2019') == false) { ?>
                                <td><?php echo $row['exp9']; ?></td>
                            <?php } ?>
                            <td><?php echo $row['nature9']; ?> </td>
                            <td><?php echo $row['pay9']; ?> </td>
                            <td><?php echo $row['otype9']; ?> </td>
                            <?php if (strpos($row['app_id'], '2019') == false) { ?>
                                <td><a target="_blank" href="<?php echo $row['exp_file9']; ?>">View</a></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                    <?php if ($row['org10'] <> "") { ?>
                        <tr>
                            <td align="center">10.</td>
                            <td><?php echo $row['org10']; ?> </td>
                            <td><?php echo $row['pos10']; ?> </td>
                            <td><?php echo $row['from10']; ?> </td>
                            <td><?php echo $row['to10']; ?> </td>
                            <?php if (strpos($row['app_id'], '2019') == false) { ?>
                                <td><?php echo $row['exp10']; ?></td>
                            <?php } ?>
                            <td><?php echo $row['nature10']; ?> </td>
                            <td><?php echo $row['pay10']; ?> </td>
                            <td><?php echo $row['otype10']; ?> </td>
                            <?php if (strpos($row['app_id'], '2019') == false) { ?>
                                <td><a target="_blank" href="<?php echo $row['exp_file10']; ?>">View</a></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="9">Whether you have worked on any Government Project? </td>
                        <td><?php echo $row['police']; ?></td>
                    </tr>
                </table>
                <br />
                <table class="form" width="100%" border="1">
                    <tr>
                        <td align="center"><b>4.</b></td>
                        <td colspan="4"><strong>Two References (Not related to you) (Give Name, Contact address, Contact No. and Email id) :</strong></td>
                    </tr>
                    <tr>
                        <td align="center"></td>
                        <td colspan="4">Reference 1 : <?php echo $row['ref1']; ?></td>
                    </tr>
                    <tr>
                        <td align="center"></td>
                        <td colspan="4">Reference 2 : <?php echo $row['ref2']; ?></td>
                    </tr>
                    <tr>
                        <td align="center"><b>5.</b></td>
                        <td colspan="4">
                            <p><strong>List of Attachments: </strong> (Please tick mark against attached documents) Self attested photo copies of certificates/testimonials in proof of</p>
                        </td>
                    </tr>

                    <tr>
                        <td align="center"></td>
                        <td width="80%">(1) Date of Birth Proof (Pancard / Aadharcard / Leaving Certi. / SSC Certi.)</td>
                        <td width="10%">Yes</td>
                        <td width="10%">No</td>
                        <td width="10%">
                            <?php if ($row['dob_proof'] != '') { ?>
                                <a target="_blank" href="<?php echo $row['dob_proof']; ?>">View</a>
                            <?php } ?>
                        </td>
                    </tr>

                    <tr>
                        <td align="center"></td>
                        <td width="80%">(2) Caste Certificate, If required.</td>
                        <td width="10%">Yes</td>
                        <td width="10%">No</td>
                        <td width="10%">
                            <?php if ($row['caste_certi'] != '') { ?>
                                <a target="_blank" href="<?php echo $row['caste_certi']; ?>">View</a>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="center"></td>
                        <td width="80%">(3) Disability Certificate, If required.</td>
                        <td width="10%">Yes</td>
                        <td width="10%">No</td>
                        <td width="10%">
                            <?php if ($row['disability_certi'] != '') { ?>
                                <a target="_blank" href="<?php echo $row['disability_certi']; ?>">View</a>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="center"></td>
                        <td width="80%">(4) NOC from current Organization, If required.</td>
                        <td width="10%">Yes</td>
                        <td width="10%">No</td>
                        <td width="10%">
                            <?php if ($row['noc'] != '') { ?>
                                <a target="_blank" href="<?php echo $row['noc']; ?>">View</a>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="center"></td>
                        <td>(5) Experience Certificate[s]</td>
                        <td>Yes</td>
                        <td>No</td>
                        <td width="10%">
                            <?php if ($row['expr_certi'] != '') { ?>
                                <a target="_blank" href="<?php echo $row['expr_certi']; ?>">View</a>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="center"></td>
                        <td>(6) Qualification Certificate[s]</td>
                        <td>Yes</td>
                        <td>No</td>
                        <td width="10%">
                        </td>
                    </tr>
                    <?php if (strpos($row['app_id'], '2019') == false) { ?>
                        <tr>
                            <td align="center"></td>
                            <td>(7) SBI Collect Fee Receipt</td>
                            <td>Yes</td>
                            <td>No</td>
                            <td width="10%">
                                <?php if ($row['fees_receipt'] != '') { ?>
                                    <a target="_blank" href="<?php echo $row['fees_receipt']; ?>">View</a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td align="center"></td>
                        <td>(8) Typing Speed Certificate, If required.</td>
                        <td>Yes</td>
                        <td>No</td>
                        <td width="10%">
                            <?php if ($row['typing_certi'] != '') { ?>
                                <a target="_blank" href="<?php echo $row['typing_certi']; ?>">View</a>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="center"></td>
                        <td>(9) StenoGraphy Speed Certificate, If required.</td>
                        <td>Yes</td>
                        <td>No</td>
                        <td width="10%">
                            <?php if ($row['stenography_certi'] != '') { ?>
                                <a target="_blank" href="<?php echo $row['stenography_certi']; ?>">View</a>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="center"></td>
                        <td>(10) Any other document[s], If required.</td>
                        <td>Yes</td>
                        <td>No</td>
                        <td width="10%">
                            <?php if ($row['othrdoc'] != '') { ?>
                                <a target="_blank" href="<?php echo $row['othrdoc']; ?>">View</a>
                            <?php } ?>
                        </td>
                    </tr>

                    <tr>
                        <td align="center"></td>
                        <td colspan="4"><strong>Note:</strong> Incomplete and/or errorneous application are likely to be summarily rejected. If any query is not applicable to you, please write NA against it.</td>
                    </tr>
                    <tr>
                        <td align="center" valign="top"><b>6.</b></td>
                        <td colspan="4">
                            <p align="justify"><strong>Other Information: </strong><?php echo $row['other_info']; ?>
                        </td>
                    </tr>
                    <?php if (strpos($row['app_id'], '2019') == false) { ?>
                        <tr>
                            <td align="center" valign="top"><b>7.</b></td>
                            <td colspan="2">Have you ever been detained/convicted by police authority or court of law?</td>
                            <td colspan="2">

                                <?php
                                if ($row['detained'] != '') {
                                    echo $row['detained'];
                                }
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($row['detained_details'] != '') { ?>
                        <tr>
                            <td></td>
                            <td colspan="7"><strong>Give details thereof : </strong>
                                <?php
                                if ($row['detained_details'] != '') {
                                    echo $row['detained_details'];
                                }
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td align="center" valign="top"><b>8.</b></td>
                        <td colspan="3">
                            <p align="justify"><strong>Declaration:</strong> I hereby certify that the foregoing information is correct to the best of my knowledge and belief. I have not suppressed any material fact or factual information in the
                                above statement. In case I have given wrong information or suppressed
                                any material fact or factual information, then my services are liable to be terminated without giving any notice or reasons thereof.
                                I am not aware of any circumstances which might impair my fitness for employment under
                                <?php
                                if ($row['job_type'] == 'Contractual') {
                                    echo 'M/s. Viswambi Security Agency Pvt. Ltd.';
                                } else {
                                    echo 'Information and Library Network (INFLIBNET) Centre.';
                                }
                                ?>
                        </td>
                        <td colspan="2">
                            <?php
                            echo $row['declaration'];
                            ?>
                        </td>
                    </tr>
                    <tr>

                        <td align="left"></td>
                        <td colspan="5">Date : <?php echo $row['submission_date']; ?></td>

                    </tr>
                    <tr align="right">
                        <td align="right" colspan="5">
                            <div align="right"> Signature of Applicant : <img src='<?php echo $row['sign']; ?> ' height="59" width="155" /></div>
                        </td>
                    </tr>


                    <!-- <tr>
                                                                                                                                                                                                                                                                                                                                <td align="left" colspan="5">The candidate should send their application in an envelope super scribing clearly "APPLICATION FOR THE POST OF <strong><U><?php echo $post_name; ?></U></strong>" with all above relevant enclosures and this must reach the following address on or before <strong><u><?php echo $closing_date; ?>.</u></strong>"</td>
                                                                                                                                                                                                                                                                                                                            </tr>
                                                                                                                                                                                                                                                                                                                            <tr>
                                                                                                                                                                                                                                                                                                                                <td align="left" colspan="5"><p><strong>Administrative Officer (PA&F) <br/>
                                                                                                                                                                                                                                                                                                                                            INFLIBNET Centre, <br/>
                                                                                                                                                                                                                                                                                                                                            POST BOX NO. 4, Infocity Area, Gandhinagar - 382007, <br/>Gujarat, INDIA.
                                                                                                                                                                                                                                                                                                                                        </strong></p></td>
                                                                                                                                                                                                                                                                                                                            </tr>-->

                </table>
                </br></br>
                <center>
                    <a href="#" style="width:10%" id="print_btn" class="btn btn-primary" onclick="window.print()">Print</a>
                </center>

            </div>
    </form>
<?php } ?>
</body>

</html>
<script>
    $(document).ready(function() {
        $(".check_status").on('click', function() {
            var id = $(this).val();
            var dvalue = $(this).attr('data-value');
            var user_id = $(this).attr('user-id');
            var encid = $(this).attr('data-encid');
            $.ajax({
                url: 'change_status.php',
                type: 'post',
                data: {
                    id: id,
                    status_check: dvalue,
                    user_id: user_id
                },
                dataType: 'json',

                success: function(data) {
                    if (data == true) {
                        alert("Status updated: " + dvalue);
                        window.location.href = "candidate_application.php?id=" + encid;
                    }
                }
            });
        });

        /*$(".hardcopy").on('click', function () {
         var id = $(this).val();
         var hcopy_value = $(this).attr('data-value');
         var user_id = document.getElementById("user_id").value;

         $.ajax({
         url: 'hard_copy.php',
         type: 'post',
         data: {
         id: id,
         status_check: hcopy_value,
         user_id : user_id
         },
         dataType: 'json',

         success: function (data) {
         if (data == true) {
         alert("Status updated: Hard Copy Received " + hcopy_value);
         window.location.href = "candidate_application.php?id=" + id;
         }
         }
         });
         });*/


        $(".hardcopy_submit").on('click', function() {
            var err = 0;
            if (document.getElementById("inward_no").value == "") {
                alert("Please Enter Inward Number.");
                document.getElementById("inward_no").focus();
                err++;
            } else if (document.getElementById("inward_date").value == "") {
                alert("Please Select Inward Date.");
                document.getElementById("inward_date").focus();
                err++;
            }
            if (err == 0) {
                var id = document.getElementById("candidate_id").value;
                var hard_copy_received = document.getElementById("hard_copy_received").value;
                var inward_no = document.getElementById("inward_no").value;
                var inward_date = document.getElementById("inward_date").value;
                var user_id = document.getElementById("user_id").value;
                var enc_id = document.getElementById("enc_id").value;
                $.ajax({
                    url: 'hard_copy.php',
                    type: 'post',
                    data: {
                        id: id,
                        hard_copy_received: hard_copy_received,
                        inward_no: inward_no,
                        inward_date: inward_date,
                        user_id: user_id
                    },
                    dataType: 'json',

                    success: function(data) {
                        if (data == true) {
                            alert("Status updated: Hard Copy Received with Inward Number And Date.");
                            window.location.href = "candidate_application.php?id=" + enc_id;
                        }
                    }
                });
            }
        });

        $(".testimonials_submit").on('click', function() {
            var id = document.getElementById("candidate_id").value;
            var testimonials = document.getElementById("testimonials").value;
            var user_id = document.getElementById("user_id").value;
            var enc_id = document.getElementById("enc_id").value;

            $.ajax({
                url: 'testimonial.php',
                type: 'post',
                data: {
                    id: id,
                    testimonials: testimonials,
                    user_id: user_id
                },
                dataType: 'json',

                success: function(data) {
                    if (data == true) {
                        alert("Status updated for Testimonials.");
                        window.location.href = "candidate_application.php?id=" + enc_id;
                    }
                }
            });
        });
    });

    function s_sub() {
        var id = document.getElementById("candidate_id").value;
        var status_values = document.getElementById("status_values").value;
        var provisionally_remarks = document.getElementById("provisionally_remarks").value;
        var user_id = document.getElementById("user_id").value;
        var enc_id = document.getElementById("enc_id").value;

        $.ajax({
            url: 'statusremarks.php',
            type: 'post',
            data: {
                id: id,
                status_check: status_values,
                status_remarks: provisionally_remarks,
                user_id: user_id
            },
            dataType: 'json',

            success: function(data) {

                if (data == true) {
                    alert("Remarks has been saved for provisionally eligible of candidate ID: " + id);
                    window.location.href = "candidate_application.php?id=" + enc_id;
                }
            }
        });
    }

    function s_sub1() {
        var id = document.getElementById("candidate_id1").value;
        var status_values = document.getElementById("status_values1").value;
        var provisionally_remarks = document.getElementById("provisionally_remarks1").value;
        var user_id = document.getElementById("user_id").value;
        var enc_id = document.getElementById("enc_id").value;

        $.ajax({
            url: 'statusremarks.php',
            type: 'post',
            data: {
                id: id,
                status_check: status_values,
                status_remarks: provisionally_remarks,
                user_id: user_id
            },
            dataType: 'json',
            success: function(data) {
                if (data == true) {
                    alert("Remarks has been saved for not eligible of candidate ID: " + id);
                    window.location.href = "candidate_application.php?id=" + enc_id;
                }
            }
        });
    }
</script>
<?php //session_destroy();
?>