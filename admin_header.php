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
include "dbConfig.php";

session_start();
if ($_SESSION['is_login'] != 'true') {
    header("Location: Admin_login.php");
    exit();
}
$url = $_SERVER['REQUEST_URI'];
?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"></meta>
        <title>INFLIBNET Recruitment Portal</title>
        <script type="text/javascript" src="js/Ajaxfileupload-jquery-1.3.2.js" ></script>
        <script type="text/javascript" language="javascript" src="js/validate.js"></script>
        <script type="text/javascript" language="javascript" src="js/script.js"></script>        
        <!--<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous"></link>-->
        <link rel="stylesheet" href="css/jquery-ui.css"></link>
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script src="dtpicker/jquery-1.10.2.js"></script>
        <script src="dtpicker/jquery-ui.js"></script>
        <script src="js/jquery.dataTables.js"></script>   
        <script src="js/jquery.dataTables.min.js"></script>

        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"></link>
        <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css"></link>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"></link>
        <link rel="stylesheet" type="text/css"  href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap.min.css"></link>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <script type="text/javascript" language="javascript" src="js/crypto-js.min.js"></script>
        <link href="css/custom.css" rel="stylesheet"></link>

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

            @media print{
                body{
                    width:100%;
                }
            }
        </style>
    </head>
    <body>
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
                        <?php
                        if (isset($_SESSION) && $_SESSION['is_login'] == 'true') {
                            if (strpos($url, '/Admin/') !== FALSE) {
                                ?>
                                <h4 style="color:#ffffff; display: inline-block; float: left">Welcome <?php echo $_SESSION['user']; ?></h4>
                                <li class="ml5"><a href="../Admin_logout.php"><i class="fa fa-power-off" aria-hidden="true"></i> Logout</a></li>
                            <?php } else {
                                ?>
                                <h4 style="color:#ffffff; display: inline-block; float: left">Welcome <?php echo $_SESSION['user']; ?></h4>
                                <li class="ml5"><a href="Admin_logout.php"><i class="fa fa-power-off" aria-hidden="true"></i> Logout</a></li>
                                <?php
                            }
                        } else {
                            ?>
                            <li class=""><a href="login.php"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a></li>
                        <?php } ?>
                    </ul>                    
                </div>
            </nav>        
        </div>