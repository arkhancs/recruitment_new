<?php
error_reporting(0);
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("X-Frame-Options: SAMEORIGIN");
header("X-XSS-Protection: 1; mode=block");
setcookie("recrutmentcookie", "recrutment", 0, "/", "https://recruitment.inflibnet.ac.in/", true, true);
header("Content-Security-Policy: default-src 'self' https: data: 'unsafe-inline' 'unsafe-eval';");
header_remove("X-Powered-By");
ini_set("session.cookie_secure", 1);
include('dbConfig.php');
?>
<html lang="en">
    <head>	
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-M5BPW0EJYY"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-M5BPW0EJYY');
</script>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>INFLIBNET: Recruitment Portal</title>
        <link rel="shortcut icon" href="https://www.inflibnet.ac.in/images/favicon.ico">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"></link>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link href="css/custom.css" rel="stylesheet" type="text/css">
        <style type="text/css">
            .login-form {
                width: 100%;
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
                color: #f3de2a;
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
            .buttonGroup a {
                width: 64%;
                font-size: 17px;
                border-bottom: 6px solid #fff;
            }

            .buttonGroup a:hover {
                border-bottom: 6px solid #fff;
            }

            .f30 {
                font-size: 30px;
                margin-bottom: 6px;
            }

            .buttonGroup {
                padding-bottom: 15px;
                padding-top: 0px;
            }

            .contactBox {
                padding-left: 0px;
            }

            .contactBox li {
                list-style: none;
                line-height: 25px;
            }

            .contactBox li i {
                color: #F2660E;
                width: 20px;
                text-align: center;
                margin-right: 4px;
            }

            .inquiryTitle {
                text-transform: uppercase;
                text-align: center;
                margin-top: 5px;
            }

            .horizonPipe {
                border-bottom: 1px solid #4d4d4d;
                width: 66%;
                margin-bottom: 20px;
            }

            .mb0 {
                margin-bottom: 0px;
            }

            .postTitle {
                color: #fff;
                margin-top: 18px;
                line-height: 18px;
            }

            .inquiryTitle span {
                background: #F2660E;
                color: #fff;
                padding: 5px 13px;
                border: 1px solid;
            }

            .pb30 {
                padding-bottom: 30px;
            }

            .borderWhite {
                border-color: #fff !important;
            }

            .blueBtn {
                background-color: #191e5d !important;
            }

            .blueBtn:hover {
                background-color: #f2660e !important;
            }
        </style>
    </head>
    <body>
        <div class="bg-image">
            <!--<div class="header_main1">
                <div class="container">
                    <img src="images/logo.png" class="img-responsive inf-logo" />
                    <h3>
                        <b>Information and Library Network Centre</b><br>
                        <b>Gandhinagar</b>
                    </h3>
                </div>
            </div>-->
            <div class="header">
                <nav class="navbar navbar-inverse">
                    <div class="container container-fluid">
                        <div class="navbar-header main-logo">
                            <img src="images/logo.png" class="img-responsive inf-logo" />  
                            <a class="navbar-brand" href="#">
                                <h2 class="mt-5" style="letter-spacing: 2.7px;">Online Recruitment System</h2><h4><span class="white-text"> Information and Library Network Centre, Gandhinagar</span></h4>
                            </a>                             
                        </div>           
                        <ul class="nav navbar-nav navbar-right">
                            <?php if (isset($_SESSION) && $_SESSION['is_login'] == 'true') { ?>
                                <li class=""><a href="dashboard.php"><i class="fa fa-dashboard" aria-hidden="true"></i> Dashboard</a></li>
                                <li class="ml5"><a href="logout.php"><i class="fa fa-power-off" aria-hidden="true"></i> Logout</a></li>
                            <?php } else { ?>
                                <li class=""><a href="index.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                                <li class="ml5"><a href="login.php"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a></li>
                                <?php } ?>
                        </ul>
                    </div>
                </nav>        
            </div>