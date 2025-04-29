<?php
include('dbConfig.php');
?>
<html lang="en"><head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>INFLIBNET: Recruitment</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"></link>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="css/custom.css" rel="stylesheet" type="text/css">
        <style type="text/css">


            .bg-image {
                background-image: url(images/bg1.jpg);
                width: 100%;
                height: 100%;
                background-position: center;
                background-size: contain;
                background-repeat: no-repeat;
            }

            .login-form {
            width: 90%;
            margin: 0px auto;
            margin-top: 30px;
            font-size: 15px;
            letter-spacing: 1px;
        }
       
        .login-form form {
            margin-bottom: 15px;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            background: rgba(0, 0, 0, 0.7);
            border: 1px solid rgba(255, 255, 255, .2);
            border-top-color: rgba(255, 255, 255, 0.2);
            border-top-style: solid;
            border-top-width: 1px;
            border-top: 4px solid #ffffff;
            padding: 30px 15px;
        }
       
        .yellow-text {
            color: #fff9c4;
        }
       
        .red-text {
            color: #ff9a71;
        }
       
        .red-text:hover {
            color: #ff7944;
        }
       
        .mb5 {
            margin-bottom: 5px;
        }
       
        .mt5 {
            margin-top: 5px;
        }

            .login-form h2 {
                margin: 0 0 15px;
                text-transform: uppercase;
                color: #ffffff;
            }

            .btn {
                min-height: 38px;
            }

            .form-control {
                min-height: 38px;
                color: #000000;
                border: 0px;
                background: rgba(255, 255, 255);
                border-radius: 5px;
            }

            .btn {
                font-size: 15px;
                font-weight: bold;
            }

            a {
                color: #c6c5c5;
            }

            a:hover {
                color: #ffffff;
            }

			.login-btn {
				color: #fff;
				background-color: #f2660e;
				margin-bottom: 12px;
				border-radius: 100px;
				border: 1px solid #f5b085;
				margin-top: 12px;
			}

			.login-btn:hover {
				color: #fff;
				background-color: #191e5d;
				border-color: #6161f7;
			}


            

            .captcha-image {
                float: left;
                margin-right: 7px;
            }

            .captcha-refresh {
                float: left;
                margin-right: 7px;
            }

            .captcha-input {
                width: 60%;
            }

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

            .inf-title {
                line-height: 30px;
                margin-top: 16px;
            }

            .white-text {
                color: #ffffff;
                text-align: left;
            }
			.alert-text {
                color: tomato;
                text-align: left;
            }
			
			.blinking{
			text-align:center;
			font-weight:bold;
			color:red;      
			animation:blinkingText 2s infinite;
			}

			@keyframes blinkingText{
			0%{     color: #ffffff;    }
			49%{    color: yellow; }
			50%{    color: #ffffff; }
			99%{    color: tomato;  }
			100%{   color: #ffffff;    }
			}

        </style>
    </head>
    <body>
        <div class="bg-image">
            <?php include './admin_header.php'; ?>
            <div class="container">
                <div class="login-form">

                    <form name="form1" method="post">
					<center><h3 style="color:red">Download Admit Card for written test / screening test / interview of various posts advertised vide Advt. 01/2020 in Computer Science</h3>
									<a href="login.php" class="login-btn btn"><i class="fa fa-user"></i> Login</a>		  </center>
                        <div class="col-md-12 titleText">
                            <?php
                            date_default_timezone_set('Asia/Kolkata');
                            $current_date = date("d/m/Y H:i:s");
							
							

//                            $sql = "select count(*) as open_cs, job_type from req_experience where STR_TO_DATE(closed_date,'%d/%m/%Y %H:%i:%s') >= STR_TO_DATE('$current_date','%d/%m/%Y %H:%i:%s') and category = 'CS' and job_location = 'INFLIBNET, Gandhinagar' and status='OPEN'";
//                            $result = mysqli_query($link, $sql);
//                            $row = mysqli_fetch_assoc($result);
//                            $count_open_cs = $row['open_cs'];
//                            $job_type = $row['job_type'];
//
//                            $sql = "select count(*) as open_ls, job_type from req_experience where STR_TO_DATE(closed_date,'%d/%m/%Y') >= STR_TO_DATE('$current_date','%d/%m/%Y') and category = 'LS' and job_location = 'INFLIBNET, Gandhinagar' and status='OPEN'";
//                            $result = mysqli_query($link, $sql);
//                            $row = mysqli_fetch_assoc($result);
//                            $count_open_ls = $row['open_ls'];
//                            $job_type = $row['job_type'];


                            $sql_p = "select count(*) as permanent, job_type from req_experience where STR_TO_DATE(closed_date,'%d/%m/%Y %H:%i:%s') >= STR_TO_DATE('$current_date','%d/%m/%Y %H:%i:%s') and status='OPEN' and job_type='Permanent'";
                            $result_p = mysqli_query($link, $sql_p);
                            $row_p = mysqli_fetch_assoc($result_p);
                            $count_permanent = $row_p['permanent'];
                            $job_type_p = $row_p['job_type'];
                            ?>
                            <!--<center class="yellow-text blinking"><strong>The candidate who need to apply for multiple post should apply separately.</strong></font> <br/>						
						<font class="alert-text blinking"><b>Important Note: Please use only latest Google Chrome/Mozilla Firefox browser to apply online. </b>
                       <br/>                       
                      </font>
					  <br/>-->
                            <ul>
                               <!-- <li class="white-text">Online applications are invited from Indian nationals on direct recruitment basis for the post of Private Secretary at INFLIBNET Centre.<br/><a href="https://inflibnet.ac.in/jobs/advt_no_02-2020_25062020.pdf" style="color:skyblue;" target="_blank">(View Advertisement)</a> <br/>
								 <?php if ($count_permanent > 0) { ?>
								<div class="homeloginbutton">
								<a href="application_form.php?job_type=<?php echo $job_type_p ?>" class="login-btn btn btn-block"><i class="fa fa-user"></i> Apply Now</a>
          
		   <?php } else { ?>
                                    <a class="btn" style="color: red;">Online Submission Closed.</a>
                                    <?php } ?> <br/>-->
									
       </div>
								<br/>
                                    <!--<span class="yellow-text">
  =&gt; The last date for applying online is 20.07.2020 upto 06.00 PM.<br>
  =&gt; The last date to send Hardcopy of application is 27.07.2020 upto 06.00 PM.
</span>-->
                                   
                                    
                                </li>
								<!--<br/>
								<a href="https://www.onlinesbi.com/sbicollect" style="color:skyblue" target="_blank">Click here to re-print of Online SBI Collect Payment Fees</a>-->
								

                                <!--                                <li>Advertisement of Job Opening for Various Project for Computer Science at INFLIBNET Centre, Gandhinagar 
                                                                    <a href="CS_Advertisement_0519.pdf" target="_blank">(View Advertisement)</a>
                                <?php if ($count_open_cs > 0) { ?>
                                                                            <a href="application_form.php?job_location=INFLIBNET, Gandhinagar&cat=CS&job_type=<?php echo $job_type ?>" class="btn">Apply Now</a>
                                <?php } else { ?>
                                                                            <a class="btn" style="color: red;">Application Closed</a>
                                <?php } ?>
                                                                </li>
                                
                                                                <li>Advertisement of Job Opening for Various Project for Library Science at INFLIBNET Centre, Gandhinagar 
                                                                    <a href="LS_Advertisement_0519.pdf" target="_blank">(View Advertisement)</a>
                                <?php if ($count_open_ls > 0) { ?>
                                                                            <a href="application_form.php?job_location=INFLIBNET, Gandhinagar&cat=LS" class="btn">Apply Now</a>
                                <?php } else { ?>
                                                                            <a class="btn" style="color: red;">Application Closed</a>
                                <?php } ?>
                                                                </li>-->

                            </ul>
                            <hr>
                        </div>
						
						
					   
                        <div style="clear:both;font-size: 14px;letter-spacing: 1px;">
						
    <center><font class="white-text">Care : we expect heavy load on the website towards the last date for applying. please, therefore, apply well before the closing date to avoid network congestion / disconnection &amp; inability to register your application.</font></center>
    <div style="clear: both;" class="mt5 mb5"></div>
    <!--<center class="yellow-text">
       For any administrative query you may please contact: adminofficer[at]inflibnet[dot]ac[dot]in, Phone: 079 2326 8000
       <br> For any technical query you may please contact: dashah[at]inflibnet[dot]ac[dot]in, Phone: 079 2326 8284</br>
       
    </center>-->
</div> </div> 
                </form>
            </div></div></div> 
</body></html>