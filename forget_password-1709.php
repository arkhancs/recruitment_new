<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
error_reporting(0);
include "dbConfig.php";
?>
<html lang="en">
    <head>
        <meta charset="utf-8"></meta>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1"></meta>
        <title>Forgot Password</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"></link>
        <script type="text/javascript" src="js/jquery.min.js"></script>
		<link href="css/custom.css" rel="stylesheet">
        <script type="text/javascript" src="js/bootstrap.min.js"></script> 
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
	<div class="bg-image">
	 <?php include 'admin_header.php'; ?>
	   <div class="container">
        <div class="login-form">
            <form name="form1" method="post" action="login.php" >
                <h2 class="text-center">Forgot Password</h2>
                <div class="form-group">
                    <h4>
         <?php
                 echo $_SESSION['forget_msg'];
                  unset($_SESSION['forget_msg']);
          ?>
 </h4>
                </div>
                <div class="form-group">
                    <span class="white-text" ><b>Email :<font style="color:red;font-size: 15px;"> *</font> </b></span>
                    <input type="email" class="form-control" placeholder="Email Address " id="email"  name="email" required="required">
                </div>


                <div class="form-group">

                    <?php
                    $query = "select * from req_experience where status='OPEN' and year = '2020'";
                    $result = mysqli_query($link, $query);
                    ?>
                    <label for="post" class="white-text"> <b>Post applied for :<font style="color:red"> *</font></b></label>
                    <select class="form-control" name="post" id="post"   <?php
                    if ($_SESSION['is_login'] == 'true') {
                        echo 'disabled';
                    }
                    ?>>
                        <option value="NA">Select</option>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            if ($row['category'] == '') {
                                $str = $row['post_id'] . $row['category'] . '-' . $row['sequence'] . '-' . $row['year'];
                                if ($post == $str) {
                                    $post_name2 = $row['Name'];
                                }
                                ?>
                                <option  value="<?php echo $str; ?>" <?php echo ($post == $str) ? 'selected' : ' '; ?>><?php echo $row['Name']; ?></option>

                                <?php
                            } else {
                                $str = $row['post_id'] . $row['category'] . '-' . $row['sequence'] . '-' . $row['year'];
                                if ($post == $str) {
                                    $post_name2 = $row['Name'];
                                }
                                ?>
                                <option value="<?php echo $str; ?>"  <?php echo ($post == $str) ? 'selected' : ' '; ?> ><?php echo $row['Name'] . "(" . $row['category'] . ")" ?></option>

                            <?php } ?>
                        <?php } ?>

                    </select>
                </div>

                <div class="form-group">
                    <input type="submit" name="reset_password" class="login-btn btn btn-block" value="Submit"/>
                </div>
				 <div class="clearfix">
                    <p class="text-center pull-left"><a href="index.php">Go to Home</a></p>                    
                </div>  

            </form>

        </div></div>
</div>
    </body></html>