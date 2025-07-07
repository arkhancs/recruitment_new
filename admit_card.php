<?php
error_reporting(0);
if (!isset($_SERVER['HTTP_REFERER'])) {
    header('location:./login.php');
    exit;
}
session_start();

if (isset($_SESSION)) {
    $regid = $_SESSION['app_id'];
    $post = $_SESSION['post'];
    $post_category = $_SESSION['post_category'];
    $post_name = $_SESSION['post_name'];
    $prefix = $_SESSION['prefix'];
    $surname = $_SESSION['surname'];
    $name = $_SESSION['name'];
    $fathername = $_SESSION['fathername'];
    $lastname = $_SESSION['lastname'];
    $dob = $_SESSION['dob'];
    $photo = $_SESSION['photo'];
    $exam_date = $_SESSION['exam_date'];
    $exam_time = $_SESSION['exam_time'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>INFLIBNET: Admit Card</title>
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
        .inf-logo {
            float: left;
            margin-left: 30px;
            margin-top: 0px;
            background: #fff;
            margin-right: 14px;
            padding: 10px;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
        }

        .text_h3 {
            font-size: 1.8em;
            font-weight: 600;

        }

        .text_style {
            line-height: 1.5;
            text-align: justify;
        }

        .p10 {
            padding: 10px;
        }

        .p20 {
            padding: 20px;
        }

        .mb20 {
            margin-bottom: 20px;
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
    <div class="container">
        <div class="header_main1 mb30">
            <img src="images/logo.png" class="img-responsive inf-logo" />
            <h3 class="text_h3">
                Information and Library Network (INFLIBNET) Centre, Gandhinagar
            </h3>
        </div>
    </div>
    <div class="container">
        <div style="border:1px solid #eeeeee;" class="p10">
            <table class="form" border="1" width="100%">
                <tr>
                    <td colspan="4">
                        <strong>
                            <center>
                                <font size="4">Admit Card</font>
                            </center>
                        </strong>
                    </td>
                </tr>
                <tr>
                    <td width="20%"><strong>Full Name:</strong></td>
                    <td><?php echo $prefix . ' ' . $name . ' ' . $fathername . ' ' . $surname ?></td>
                    <td rowspan="3" width="20%">
                        <center><img src='<?php echo $photo; ?>' height="160" width="140" /></center>
                    </td>
                    <td rowspan="3" width="20%">
                        <h4 class="text-center"><strong>AFFIX RECENT PASSPORT SIZE SELF ATTESTED PHOTOGRAPH HERE</strong></h4>
                    </td>
                </tr>
                <!--<tr>
                        <td><strong>Date of Birth:</strong></td>
                        <td><?php echo $dob; ?></td>
                    </tr>-->
                <tr>
                    <td><strong>Name of Post and Application ID:</strong></td>
                    <td><?php
                        if ($post == 'PSAdmin-2-2023') {
                            echo $post_name . ' <br>(' . $regid . ')';
                        } else {
                            echo $post_name . ' (' . $post_category . ')<br>(' . $regid . ')';
                        }
                        ?></td>
                </tr>
                <tr>
                    <td><strong>Date & Reporting Time :</strong></td>
                    <td><?php echo $exam_date . ' / ' . $exam_time; ?></td>
                </tr>
                <!--<tr>
                        <td><strong>Time of Exam:</strong></td>
                        <td><?php echo $exam_time; ?></td>
                    </tr>-->
                <tr>
                    <td><strong>Venue:</strong></td>
                    <td colspan="3">Information and Library Network (INFLIBNET) Centre,<br>
                        Opp. DAIICT, NIFT & TCS Garima Park, Infocity Area, Gandhinagar-382007
                    </td>
                </tr>
            </table>

            <strong>
                <center><u>
                        <font size="4"><br>INSTRUCTIONS FOR THE CANDIDATES</font>
                    </u></center>
            </strong>
            <ol start="1" class="text_style p20">
                <li>Candidates are required to paste latest passport size self attested color photograph in the space provided above.</li>

                <?php if ($post == 'SBLS-2-2024') { ?>
                    <li>Candidate must bring any of their original Photo Identity Card & Admit Card failing which candidates will not be allowed to appear for the screening test.</li>
                <?php } else if ($post == 'PSAdmin-2-2023') { ?>
                    <li>Candidates must bring any of their original Photo Identity Card & Admit Card failing which candidates will not be allowed to appear for the test/interview.</li>
                <?php } else if ($post == 'CCTAdmin-2-2023') { ?>
                    <li>Candidates must bring any of their original Photo Identity Card & Admit Card failing which candidates will not be allowed to appear for the written/trade test.</li>
                <?php } else if ($post == 'AOFAdmin-1-2023') { ?>
                    <li>Candidates must bring any of their original Photo Identity Card & Admit Card failing which candidates will not be allowed to appear for the interview.</li>
                <?php } else { ?>
                    <li>Candidates must bring any of their original Photo Identity Card & Admit Card failing which candidates will not be allowed to appear for the personal interview.</li>
                <?php } ?>

                <?php if ($post == 'SBLS-2-2024') { ?>
                    <li>Candidates will be permitted to carry ONLY Admit Card, Photo Identity Proof and Black Ball Pen. NOTHING ELSE will be allowed inside the examination hall.</li>
                    <li>Candidates should listen carefully to the instructions given by the invigilator(s),
                        <!-- as well as read the instructions displayed on the board -->
                        prior to the commencement of the examination.
                    </li>
                    <li>The date of screening test is liable to change, if circumstances so warrant.</li>
                    <li><b>Candidates are shortlisted and called for screening test subject to production of all original testimonials in respect of Date of Birth proof, Caste Certificate (if applicable), Academic (marksheets of qualifying exam and degree certificates), Experience certificates and <u>NOC</u> etc. mentioned in their application, failing which candidate will not be permitted for screening test.</b></li>
                    <!-- <li>Provisionally eligible candidates are required to submit their missing/required documents/certificate shown against their application id before appearing in the screening test failing which they will not be allowed to appear in the screening test.</li> -->
                <?php } else if ($post == 'PSAdmin-2-2023') { ?>
                    <li>The date of test/interview is liable to change, if circumstances so warrant.</li>
                    <li><b>Candidates are required to carry all original testimonials in respect of Date of Birth proof, Academic (marksheets of qualifying exam and degree certificates), Experience certificates and <u>NOC</u> etc. mentioned in their application, failing which candidates will not be permitted to appear in test/interview.</b></li>
                    <li>Candidates will have to appear in Trade Test (Shorthand dictation at minimum speed of 120 WPM & typing of the same on computer and typing test on computer with 40 WPM) only qualify for interview. Selection will be based on Performance in Personal interview.</li>
                <?php } else if ($post == 'CCTAdmin-1-2025') { ?>
                    <li>The date of written/trade test is liable to change, if circumstances so warrant.</li>
                    <li><b>Candidates are required to carry all original testimonials in respect of Date of Birth proof, Academic (marksheets of qualifying exam and degree certificates), Experience certificates and <u>NOC</u> etc. mentioned in their application, failing which candidates will not be permitted to appear in written/trade test.</b></li>
                    <li>Candidates will have to appear in written/trade Test (minimum 50% in written test will qualify for typing test) followed by typing test on computer with 35 WPM in English/30 WPM in Hindi). Selection will be based on Performance in written test.</li>
                <?php } else if ($post == 'AOFAdmin-1-2023') { ?>
                    <li>The date of interview is liable to change, if circumstances so warrant.</li>
                    <li><b>Candidates are required to carry all original testimonials in respect of Date of Birth proof, Academic (marksheets of qualifying exam and degree certificates), Experience certificates and <u>NOC</u> etc. mentioned in their application, failing which candidates will not be permitted to appear in interview.</b></li>
                <?php } else { ?>
                    <li>The date of interview is liable to change, if circumstances so warrant.</li>
                    <li><b>Candidates are required to carry all original testimonials in respect of Date of Birth proof, OBC(NCL)Caste Certificate of current validity, Academic (marksheets of qualifying exam and degree certificates), Experience certificates and <u>NOC</u> etc. mentioned in their application, failing which candidates will not be permitted to appear in interview.</b></li>
                    <li>Provisionally eligible candidates are required to submit their missing/required documents/certificate shown against their application id in the list uploaded on the website of the Centre, on or before <strong>09.06.2022 upto 06.00 pm</strong> through email only at <strong>recruitment@inflibnet.ac.in</strong> failing which candidate will not be permitted to appear in the Interview, It will be entirely at their risk and cost.</li>
                <?php } ?>

                <!-- <li>The INFLIBNET Centre will follow all the SOPs issued by the Ministry of Health & Family Welfare Govt. of India to prevent COVID19. In this regard you are also advised to follow SOPs of wearing masks and maintaining social distance etc.</li> -->

                <?php if ($post == 'SAOAAdmin-1-2019' || $post == 'OAIIAdmin-1-2020') { ?>
                    <!--<li>Candidates are required to produce a caste certificate of OBC (NCL) of current year validity (issued based on income of last financial year, In original, mentioning OBC (Non-creamy layer) valid for employment in Govt. of India. In case you fail to produce this OBC (NCL) certificate you will not be permitted to appear in a written test/trade test.</li>-->
                <?php } ?>

            </ol>
        </div>
        </br></br>
        <center>
            <a href="#" style="width:10%" id="print_btn" class="btn btn-primary mb20 print_admit_card" onclick="window.print();">Print</a>
            <!-- <a href="#" style="width:10%" id="print_btn" class="btn btn-primary mb20 print_admit_card" onclick="print_admit_card();window.print();">Print</a> -->
            <a href="dashboard.php" style="width:15%" id="print_btn" class="btn btn-danger mb20"> Back to Dashboard</a>
        </center>
    </div>
</body>

<script type="text/javascript">
    function print_admit_card() {
        $.ajax({
            url: 'admit_card_status.php',
            dataType: 'json',
            type: 'post',
            success: function(data) {

            }
        });
    }
</script>

</html>