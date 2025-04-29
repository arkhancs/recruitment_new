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

date_default_timezone_set('Asia/Kolkata');
include "get_ip.php";

if (isset($_POST['Submit'])) {
    //$result = "";
    $regid = trim(mysqli_real_escape_string($link, $_POST['regid']));
    $password = trim(mysqli_real_escape_string($link, $_POST['password']));
    $password1 = md5($password);

    $sql = "select * From login where username ='$regid' and password = '$password1' and status = 'Current'";
    $result = mysqli_query($link, $sql);
    if (mysqli_num_rows($result) == 1) {
        session_start();
        if ($_POST["captcha_code"] != $_SESSION["code"]) {
            $msg = " Incorrect Captcha.";
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                $user_id = $row['username'];
                $sql_ua = "insert into history_admin VALUES(0,'$ua_browser','$ua_version','$ua_platform','$ua_ip','$ua_date','$ua_time','$user_id',NULL,'Login')";
                $result_ua = mysqli_query($link, $sql_ua);

                session_start();
                $_SESSION['user'] = $row['username'];
                $_SESSION['is_login'] = 'true';
                header("location: Admin_Home.php");
                exit;
            }
        }
    } else {
        $msg = "Incorrect Username or Password.";
    }
}

$client_ip = $_SERVER['SERVER_ADDR'];
//print_r($client_ip);
$allowed_ip = array("14.139.116.2");
$allowip = false;

foreach ($allowed_ip as $ip) {
    if ($client_ip == $ip) {
        $allowip = true;
        break;
    }
}
if ($allowip == true) {
    header("location:index.php");
    exit;
}
?>

<?php include './header.php'; ?>
<style type="text/css">
    .login-form {
        width: 400px;
        margin: 25px auto;
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
</style>
<div class="container">
    <div class="login-form">
        <form name="form1" method="post" onSubmit="return check_captcha();">
            <h2 class="text-center">Admin Panel</h2>   
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
                <button type="submit" name="Submit" class="login-btn btn btn-block">Log in</button>
            </div>
            <div class="clearfix">
                <p class="text-center pull-left"><a href="index.php">Go to Home</a></p>

            </div>   

        </form>

    </div>
</div>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
<script>
    function check_captcha() {
        if (document.form1.captcha_code.value == "") {
            alert("Please Enter Captcha.");
            return false;
        } else {
            return true;
        }
    }
//    $("#captcha_code").focusout(function (event) {
//
//        $.ajax({
//            url: 'validate_captcha.php',
//            data: {code: $("input[name='captcha_code']").val()},
//            dataType: 'json',
//            type: 'post',
//            success: function (data) {
//                if (data == "true") {
//                    return true;
//                    //alert("Captcha is Good");
//                }
//                if (data == "false") {
//                    event.preventDefault();
//                    alert("Captcha is Incorrect.");
//
//                    return false;
//                }
//            }
//        });
//    });
    function refresh_captcha()
    {

        $("#captcha_img").replaceWith('<img id="captcha_img" src="captcha.php" alt="CAPTCHA" height="40" width="100" />');
    }
</script>