<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
error_reporting(0);
include "dbConfig.php";
error_reporting(0);
include "dbConfig.php";
if (!isset($_SERVER['HTTP_REFERER'])) {
    header('location:./login.php');
   exit;
}

session_start();
?>

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Upload Form</title>
        <link href="css/style.css" rel="stylesheet" type="text/css"></link>
        <script type="text/javascript" src="js/Ajaxfileupload-jquery-1.3.2.js" ></script>
        <script type="text/javascript" language="javascript" src="js/validate.js"></script>
        <script type="text/javascript" language="javascript" src="js/script.js"></script>
        <script type="text/javascript" src="js/ajaxupload.3.5.js" ></script>
        <script type="text/javascript" src="js/exp_calculation.js" ></script>
        <link rel="stylesheet" href="css/jquery-ui.css"></link>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"></link>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <!--<link rel="stylesheet" href="dtpicker/jquery-ui.css"></link>-->
        <script src="dtpicker/jquery-1.10.2.js"></script>
        <script src="dtpicker/jquery-ui.js"></script>
        <link rel="stylesheet" type="text/css" href="css/Ajaxfile-upload.css" /></link>
        <meta name="viewport" content="width=device-width, initial-scale=1"></meta>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous"></link>
        <link rel="stylesheet" type="text/css" href="css/custom.css"></link>

        <style type="text/css">
            .login-form {
                width: 400px;
                margin: 25px auto;
            }

            .bg-image {
                background-image: url(images/bg1.jpg);
                width: 100%;
                height: 100%;
                background-position: center;
                background-size: contain;
                background-repeat: no-repeat;
            }

            .login-form {
                width: 400px;
                margin: 50px auto;
                float: left;
            }

            .login-form form {
                margin-bottom: 15px;
                box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
                background: rgba(217, 215, 215, 0.21);
                border: 1px solid rgba(255, 255, 255, .2);
                border-top: 4px solid #191e5d;
                padding: 30px;
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
                border-color: #bb4e0a;
            }

            .login-btn:hover {
                color: #fff;
                background-color: #191e5d;
                border-color: #191e5d;
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
        </style>
    </head>
    <body>
        <div class="container" style="padding-top:10px;padding-bottom: 23px; border-radius: 5px; ">
            <div class="header_main1">
                <img src="images/logo.png" class="img-responsive inf-logo" />
                <h3>
                    <b>Information and Library Network (INFLIBNET) Centre</b>
                    <p style="padding-top:10px;"><small><strong>Upload Document Form</strong></small></p>
                </h3>
            </div>
            <br/><br/>
            <div class="row">
                <div class="col-md-12">
                    <?php
                    echo $_SESSION['msg'];
					//echo $_SESSION['is_login'];
                    unset($_SESSION['msg']);
                    ?>
                </div>
            </div>
            <ul class="nav nav-pills">
                <li class="active" id="li1"><a href="#personal"   data-toggle="tab" STYLE="#000080"><b>Upload Document (All documents (max 250kb) must be in readable format)</b></a></li>

                <?php if ($_SESSION['is_login'] == 'true') { ?><li class="pull-right" ><h4 style="color:#337ab7; display: inline-block;" >Welcome <?php echo $_SESSION['user']; ?></h4><a href="logout.php" ><i class="fas fa-power-off"  style="font-size:20px;color: red;"></i></a></li><?php } ?>
            </ul>
            <div class="tab-pane fade in active" style="border: 1px gray solid; border-radius: 5px; padding: 20px 10px;">
                <form name="frmregister" id="frmregister" action="saveupload.php" method="post"   enctype="multipart/form-data">
                    <input type="hidden" name="app_id" id="app_id" value="<?php echo $_SESSION['app_id']; ?>"></input>
                    <div class="row">
                        <div class="col-md-2">1. NOC
                        </div>
                        <div class="col-md-8">
                            <input type="file" name="noc" id="noc" class="form-control"></input>
                        </div>
                        <div class="clearfix"></div><br/>
                        <div class="col-md-2">2. OBC (Non-Creamy layer)
                        </div>
                        <div class="col-md-8">
                            <input type="file" name="caste_certi" id="caste_certi" class="form-control"></input>
                        </div>
                        <div class="clearfix"></div><br/>
                        <div class="col-md-2">3. Experience Certificate
                        </div>
                        <div class="col-md-8">
                            <input type="file" name="expr_certi" id="expr_certi" class="form-control"></input>
                        </div>
                        <div class="clearfix"></div><br/>
                        <div class="col-md-2">4. Qualifying Degree Certificate
                        </div>
                        <div class="col-md-8">
                            <input type="file" name="master_degree_certi" id="master_degree_certi" class="form-control"></input>
                        </div>
                        <div class="clearfix"></div><br/>
                        <div class="col-md-2">5. Other
                        </div>
                        <div class="col-md-8">
                            <input type="file" name="other_file" id="other_file" class="form-control"></input>
                        </div>	 
                        <div class="clearfix"></div><br/>
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <input type="submit" name="btn_submit" class="btn btn-primary"></input>
				
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
    <script type="text/javascript">
        $('#noc').change(function () {
            var file_name = $(this).val();
            var fileExtension = file_name.substr((file_name.lastIndexOf('.') + 1));
            var extension_array = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'PDF', 'pdf'];
            if (extension_array.indexOf(fileExtension) == -1)
            {
                alert("Please upload only JPG/PNG/PDF file for NOC Document.");
                document.getElementById("noc").value = null;
            }
            if (Math.round(document.frmregister.noc.files[0].size / 1024) > 250)
            {
                alert("NOC Document size should be less than 250 KB.");
                document.getElementById("noc").value = null;
            }
        });
        $('#caste_certi').change(function () {
            var file_name = $(this).val();
            var fileExtension = file_name.substr((file_name.lastIndexOf('.') + 1));
            var extension_array = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'PDF', 'pdf'];
            if (extension_array.indexOf(fileExtension) == -1)
            {
                alert("Please upload only JPG/PNG/PDF file for Caste Certificate Document.");
                document.getElementById("caste_certi").value = null;
            }
            if (Math.round(document.frmregister.caste_certi.files[0].size / 1024) > 250)
            {
                alert("Caste Certificate Document size should be less than 250 KB.");
                document.getElementById("caste_certi").value = null;
            }
        });
        $('#expr_certi').change(function () {
            var file_name = $(this).val();
            var fileExtension = file_name.substr((file_name.lastIndexOf('.') + 1));
            var extension_array = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'PDF', 'pdf'];
            if (extension_array.indexOf(fileExtension) == -1)
            {
                alert("Please upload only JPG/PNG/PDF file for Experience Certificate Document.");
                document.getElementById("expr_certi").value = null;
            }
            if (Math.round(document.frmregister.expr_certi.files[0].size / 1024) > 250)
            {
                alert("Experience Certificate Document size should be less than 250 KB.");
                document.getElementById("expr_certi").value = null;
            }
        });
        $('#master_degree_certi').change(function () {
            var file_name = $(this).val();
            var fileExtension = file_name.substr((file_name.lastIndexOf('.') + 1));
            var extension_array = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'PDF', 'pdf'];
            if (extension_array.indexOf(fileExtension) == -1)
            {
                alert("Please upload only JPG/PNG/PDF file for Master Degree Certificate Document.");
                document.getElementById("master_degree_certi").value = null;
            }
            if (Math.round(document.frmregister.master_degree_certi.files[0].size / 1024) > 250)
            {
                alert("Master Degree Certificate Document size should be less than 250 KB.");
                document.getElementById("master_degree_certi").value = null;
            }
        });
        $('#other_file').change(function () {
            var file_name = $(this).val();
            var fileExtension = file_name.substr((file_name.lastIndexOf('.') + 1));
            var extension_array = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'PDF', 'pdf'];
            if (extension_array.indexOf(fileExtension) == -1)
            {
                alert("Please upload only JPG/PNG/PDF file for Other Document.");
                document.getElementById("other_file").value = null;
            }
            if (Math.round(document.frmregister.other_file.files[0].size / 1024) > 250)
            {
                alert("Other Document size should be less than 250 KB.");
                document.getElementById("other_file").value = null;
            }
        });
    </script>
</html>