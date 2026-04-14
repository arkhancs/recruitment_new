<?php
error_reporting(0);
include "dbConfig.php";

if (isset($_POST['Submit'])) {

    $result = "";
    $regid = trim(mysqli_real_escape_string($link, $_POST['regid']));
    $password = trim(mysqli_real_escape_string($link, $_POST['password']));
    $password = md5($password);
    $sql="select * From login where username ='$regid' and password = '$password' and status = 'current'";
    $result = mysqli_query($link, $sql);
    if ($result) {

        if (mysqli_num_rows($result) == 0) {
            $msg = " Incorrect Username or Password.";
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
             session_start();

                 $_SESSION['user'] = $regid;
                 $_SESSION['is_login'] = 'true';

                 header("location:Home.php");
                 
                        exit;
            }
        }
    }
}
?>
<html lang="en"><head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin Login</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
        <style type="text/css">
            .login-form {
                width: 400px;
                margin: 50px auto;
            }
            .login-form form {
                margin-bottom: 15px;
                background: #f7f7f7;
                box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
                padding: 30px;
            }
            .login-form h2 {
                margin: 0 0 15px;
            }
            .form-control, .btn {
                min-height: 38px;
                border-radius: 2px;
            }
            .btn {        
                font-size: 15px;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <div class="login-form">
            <form name="form1" method="post" onSubmit="return check_captcha();">
               <div class="form-group">
                    <h3 style="color:#000080" class="text-center">
                         <b>  M/s. Viswambi Security Agency Pvt. Ltd.</b>                    </h3>
                  
                </div> 
                <h2 class="text-center">Admin Log In</h2>   
                <div class="form-group">
                    <span style="color:red"><?php echo $msg; ?></span> 
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Username" id="regid"  name="regid" required="required">
                </div>


                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" id="password" name="password" required="required">
                </div>

                <div class="form-group">  
                    <img id="captcha_img" src="captcha.php" alt="CAPTCHA" height="32" width="80" />
                    <a href='javascript: refresh_captcha();'><img id="" src="images/refresh.png" height="40" width="40" /></a>
                    <input type="text" id="captcha_code" name="captcha_code" class="form-control" placeholder="Enter captcha" autocomplete="off"   />
                </div>

                <div class="form-group">
                    <button type="submit" name="Submit" class="btn btn-primary btn-block">Log in</button>
                </div>

            </form>

        </div>

    </body></html>
<script>
    function check_captcha() {
        if (document.form1.captcha_code.value == "") {
            alert("Please Enter Captcha.");
            return false;
        } else {
            return true;
        }
    }
    $("#captcha_code").focusout(function (event) {

        $.ajax({
            url: 'validate_captcha.php',
            data: {code: $("input[name='captcha_code']").val()},
            dataType: 'json',
            type: 'post',
            success: function (data) {
                if (data == "true") {
                    return true;
                    //alert("Captcha is Good");
                }
                if (data == "false") {
                    event.preventDefault();
                    alert("Captcha is Incorrect.");

                    return false;
                }
            }
        });
    });
    function refresh_captcha()
    {

        $("#captcha_img").replaceWith('<img id="captcha_img" src="captcha.php" alt="CAPTCHA" height="40" width="100" />');
    }
</script>