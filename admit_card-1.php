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
    $post_name = $_SESSION['Name'];
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
        <link href="css/style.css" rel="stylesheet" type="text/css"></link>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"></link>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" language="javascript" src="js/validate.js"></script>
        <link href="css/custom.css" rel="stylesheet"></link>
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
            .text_h3{
                font-size:1.8em;
                font-weight:600;
                
            }
            .text_style{               
                line-height: 1.5;
                text-align: justify;
            }
            .p10{
                padding:10px;
            }
            .p20{
                padding:20px;
            }
            .mb20{
                margin-bottom:20px;
            }
        </style>
    </head>
    <style type='text/css' media='print'>
        #print_btn{display : none}
        #exit_btn{display : none}
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
                                <center><font size="4">Admit Card</font></center>
                            </strong>
                        </td>
                    </tr>
                    <tr>
                        <td width="20%"><strong>Full Name:</strong></td>
                        <td><?php echo $prefix .' '. $name . ' '. $fathername .' '. $surname?></td>
                        <td rowspan="3" width="20%">
                            <center><img src='<?php echo $photo; ?>' height="160" width="140"/></center>
                        </td>
                        <td rowspan="3" width="20%"><h4 class="text-center"><strong>AFFIX RECENT PASSPORT SIZE SELF ATTESTED PHOTOGRAPH HERE</strong></h4></td>
                    </tr>
                    <!--<tr>
                        <td><strong>Date of Birth:</strong></td>
                        <td><?php echo $dob; ?></td>
                    </tr>-->
                    <tr>
                        <td><strong>Name of Post and Application ID:</strong></td>
                        <td><?php echo $post_name.' ('.$post_category .')<br>('.$regid.')'; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Date & Reporting Time :</strong></td>
                        <td><?php echo $exam_date. ' / ' .$exam_time; ?></td>
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
                    <center><u><font size="4"><br>INSTRUCTIONS FOR THE CANDIDATES</font></u></center>
                </strong>
                <ol start="1" class="text_style p20">
                                <li>You are required to paste latest passport size self attested photograph in the space provided above, preferably with white background.</li>
                                
				<!--<li>You are short-listed and called for screening test/interview <strong>PROVISIONALLY</strong> subject to <strong>verification of all certificate/testimonials etc. (in original) in support of your educational/professional qualifications, experience, age etc., mentioned in your application.</strong></li>
                                <li>Age relaxation is given based on applicable rule and caste mentioned in application. In support candidates of reserved categories, handicap, ex-serviceman etc. are required to produce caste certificate in original <strong><u>in case OBC(NCL) should be of current year validity (issued based on income of last financial year, in original, mentioning OBC (non-creamy layer) for employment in Govt. of India, failing which you will not be permitted to appear in the screening test/interview, failing which you will not be permitted to appear in the screening test/interview.</u></strong></li>
                                <li><strong>If you are employed in Govt./Govt. undertaking/autonomous or statutory body/university, you will also required to produce a No Objection Certificate and Vigilance Clearance Certificate from your employer, failing which you will not be permitted to appear in the screening test/interview.</strong></li>-->

                                <li>The INFLIBNET Centre will follow all the guidelines issued by the Ministry of Health & Family Welfare Govt. of India to prevent COVID19. In this regard you are also advised to follow those guidelines of wearing masks and maintaining social distance etc.</li>                    
            
                                <?php if($post == 'SECS-1-2020'){ ?>
								<li>Candidate must bring any of their original Photo Identity Card & Admit Card failing which candidates will not be allowed to appear for the interview.</li>
								<?php } else {?>
								<li>Candidate must bring any of their original Photo Identity Card & Admit Card failing which candidates will not be allowed to appear for the written test.</li>
								<?php }?>
                               
 <!--<li>At the entrance of the Centre of Examination premises, candidate will go through a security check where the security guard will check for the admit card and valid original photo identity.</li>
                                <li>After entering the Centre of Examination premise, candidate should look out for the message / notice board to get the details of the directions to the Test Lab from where the candidate will be appearing for the examination.</li>-->
								<?php if($post != 'SECS-1-2020'){ ?>
                                <li>Candidate will be permitted to carry ONLY Admit Card, Photo Identity Proof and Pen. NOTHING ELSE will be allowed inside the examination hall.</li>
                                <!--<li>Candidate will not be allowed to carry any textual material, printed or written, bits of paper, slide rules, log tables, electronic watches with facilities or calculator, mobile phone, electronic device, bags, books, food packets or belongings or any other material etc inside the examination Centre.</li>
                                <li>Candidates have to sign on the attendance sheet after they are seated in the examination Centre.</li>-->
                                <li>Candidates should listen carefully to the instructions given by the invigilator(s) as well as read the instructions displayed on the board, prior to the commencement of the examination.</li>
								<?php }?>
								<?php if($post == 'SECS-1-2020'){ ?>
                                <li>The date of interview is liable to change, if circumstances so warrant.</li>
								<?php } else {?>
								<li>The date of written test is liable to change, if circumstances so warrant.</li>
								<?php }?>
				<?php if($post == 'SECS-1-2020'){ ?>
				<li><b>Candidates are required to carry all original testimonials in respect of Date of Birth proof, Caste Certificate (if applicable), Academic (marksheet of qualifying exam and degree certificate), Experience certificates and <u>NOC</u> etc. mentioned in their application, failing which candidate will not be permitted for interview.</b></li>
				<?php } else {?>
								<li><b>Candidates are required to carry all original testimonials in respect of Date of Birth proof, Caste Certificate (if applicable), Academic (marksheet of qualifying exam and degree certificate), Experience certificates and <u>NOC</u> etc. mentioned in their application, failing which candidate will not be permitted for written test.</b></li>
								<?php }?>
								
								<?php if($post == 'SAOAAdmin-1-2019' || $post == 'OAIIAdmin-1-2020'){ ?>
								<li>Candidates are required to produce a caste certificate of OBC (NCL) of current year validity (issued based on income of last financial year, In original, mentioning OBC (Non-creamy layer) valid for employment in Govt. of India. In case you fail to produce this OBC (NCL) certificate you will not be permitted to appear in a written test/trade test.</li>
								<?php } ?>
							
                </ol>                   
            </div>
            </br></br>
            <center>     
                <a href="#" style="width:10%"  id="print_btn" class="btn btn-primary mb20" onclick="window.print()"  >Print</a> 
                <a href="logout.php" style="width:10%"  id="print_btn" class="btn btn-danger mb20" >Close</a> 
            </center>
        </div>
    </body>
</html>
