
<?php
//error_reporting(E_ALL ^ E_DEPRECATED);
error_reporting(0);
include "dbConfig.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:\wamp64\www\recruitment\PHPMailer\src\Exception.php';
require 'C:\wamp64\www\recruitment\PHPMailer\src\PHPMailer.php';
require 'C:\wamp64\www\recruitment\PHPMailer\src\SMTP.php';
$srno = 0;
$unid = "";


if (isset($_POST["Save"])) {
    $post = $_POST['post'];
    if ($post != "") {
        $prefix = mysql_real_escape_string($_POST['prefix']);
        $surname = mysql_real_escape_string($_POST["surname"]);
        $name = '';
        $fname = mysql_real_escape_string($_POST['fname']);
        $lname = mysql_real_escape_string($_POST['lastname']);
        //for father/husband
        // $lname = mysql_real_escape_string($_POST["lastname"]);


        $certino = "";
        $certidate = "";
        $authority = "";

        $dob = mysql_real_escape_string($_POST["dob"]);
        $dob = date('Y-m-d', strtotime($dob));
        // if (isItValidDate($dob)) {
        //valid dob
        // } else {
        //invalid dob
        // };
        $sex = mysql_real_escape_string($_POST["sex"]);
        $category = mysql_real_escape_string($_POST["caste"]);

        $nation = mysql_real_escape_string($_POST["nation"]);
        $mstatus = mysql_real_escape_string($_POST["mstatus"]);
        $address = mysql_real_escape_string($_POST["address"]);
        $city = mysql_real_escape_string($_POST["city"]);
        $state = mysql_real_escape_string($_POST["state"]);
        $pincode = mysql_real_escape_string($_POST["pincode"]);
        $paddress = mysql_real_escape_string($_POST["paddress"]);
        $pcity = mysql_real_escape_string($_POST["pcity"]);
        $pstate = mysql_real_escape_string($_POST["pstate"]);
        $ppincode = mysql_real_escape_string($_POST["ppincode"]);
        $telephone = mysql_real_escape_string($_POST["telephone"]);
        $mobile = mysql_real_escape_string($_POST["mobile"]);
        $email = mysql_real_escape_string($_POST["email"]);
        $date = date("d/m/Y");

        $speci1 = mysql_real_escape_string($_POST['speci1']);
        $speci2 = mysql_real_escape_string($_POST['speci2']);
        $speci3 = mysql_real_escape_string($_POST['speci3']);
        $speci4 = mysql_real_escape_string($_POST['speci4']);
        $speci5 = mysql_real_escape_string($_POST['speci5']);


        $total1 = mysql_real_escape_string($_POST['total1']);
        $total2 = mysql_real_escape_string($_POST['total2']);
        $total3 = mysql_real_escape_string($_POST['total3']);
        $total4 = mysql_real_escape_string($_POST['total4']);
        $total5 = mysql_real_escape_string($_POST['total5']);

//$grandtotal= mysql_real_escape_string($_POST['finaltotal']);
        $grandtotal = "NA";

        $edu4 = mysql_real_escape_string($_POST['edu4']);
        $board4 = mysql_real_escape_string($_POST['board4']);
        $year4 = mysql_real_escape_string($_POST['year4']);
        $per4 = mysql_real_escape_string($_POST['per4']);
        $div4 = mysql_real_escape_string($_POST['div4']);
        //$cate4 = mysql_real_escape_string($_POST['cate4']);

        $edu5 = mysql_real_escape_string($_POST['edu5']);
        $board5 = mysql_real_escape_string($_POST['board5']);
        $year5 = mysql_real_escape_string($_POST['year5']);
        $per5 = mysql_real_escape_string($_POST['per5']);
        $div5 = mysql_real_escape_string($_POST['div5']);
        // $cate5 = mysql_real_escape_string($_POST['cate5']);

        $edu3 = mysql_real_escape_string($_POST['edu3']);
        $board3 = mysql_real_escape_string($_POST['board3']);
        $year3 = mysql_real_escape_string($_POST['year3']);
        $per3 = mysql_real_escape_string($_POST['per3']);
        $div3 = mysql_real_escape_string($_POST['div3']);
        // $cate3 = mysql_real_escape_string($_POST['cate3']);

        $edu1 = mysql_real_escape_string($_POST['edu1']);
        $board1 = mysql_real_escape_string($_POST['board1']);
        $year1 = mysql_real_escape_string($_POST['year1']);
        $per1 = mysql_real_escape_string($_POST['per1']);
        $div1 = mysql_real_escape_string($_POST['div1']);
        //$cate1 = mysql_real_escape_string($_POST['cate1']);

        $edu2 = mysql_real_escape_string($_POST['edu2']);
        $board2 = mysql_real_escape_string($_POST['board2']);
        $year2 = mysql_real_escape_string($_POST['year2']);
        $per2 = mysql_real_escape_string($_POST['per2']);
        $div2 = mysql_real_escape_string($_POST['div2']);

        $org1 = mysql_real_escape_string($_POST['org1']);
        $pos1 = mysql_real_escape_string($_POST['pos1']);
        $from1 = mysql_real_escape_string($_POST['from1']);
        $to1 = mysql_real_escape_string($_POST['to1']);
        $nature1 = mysql_real_escape_string($_POST['nature1']);
        $pay1 = mysql_real_escape_string($_POST['pay1']);

        $org2 = mysql_real_escape_string($_POST['org2']);
        $pos2 = mysql_real_escape_string($_POST['pos2']);
        $from2 = mysql_real_escape_string($_POST['from2']);
        $to2 = mysql_real_escape_string($_POST['to2']);
        $nature2 = mysql_real_escape_string($_POST['nature2']);
        $pay2 = mysql_real_escape_string($_POST['pay2']);

        $org3 = mysql_real_escape_string($_POST['org3']);
        $pos3 = mysql_real_escape_string($_POST['pos3']);
        $from3 = mysql_real_escape_string($_POST['from3']);
        $to3 = mysql_real_escape_string($_POST['to3']);
        $nature3 = mysql_real_escape_string($_POST['nature3']);
        $pay3 = mysql_real_escape_string($_POST['pay3']);

        $org4 = mysql_real_escape_string($_POST['org4']);
        $pos4 = mysql_real_escape_string($_POST['pos4']);
        $from4 = mysql_real_escape_string($_POST['from4']);
        $to4 = mysql_real_escape_string($_POST['to4']);
        $nature4 = mysql_real_escape_string($_POST['nature4']);
        $pay4 = mysql_real_escape_string($_POST['pay4']);

        $org5 = mysql_real_escape_string($_POST['org5']);
        $pos5 = mysql_real_escape_string($_POST['pos5']);
        $from5 = mysql_real_escape_string($_POST['from5']);
        $to5 = mysql_real_escape_string($_POST['to5']);
        $nature5 = mysql_real_escape_string($_POST['nature5']);
        $pay5 = mysql_real_escape_string($_POST['pay5']);


        $otype5 = mysql_real_escape_string($_POST['otype5']);
        $otype4 = mysql_real_escape_string($_POST['otype4']);
        $otype3 = mysql_real_escape_string($_POST['otype3']);
        $otype2 = mysql_real_escape_string($_POST['otype2']);
        $otype1 = mysql_real_escape_string($_POST['otype1']);

        $agenew = mysql_real_escape_string($_POST['agenew']);
        $region = mysql_real_escape_string($_POST['region']);


        $police = mysql_real_escape_string($_POST['police']);
        $ref1 = mysql_real_escape_string($_POST['txtref1']);
        $ref2 = mysql_real_escape_string($_POST['txtref2']);

        //$region = "NA";
        //$unid = $_POST['unid'];
        $sql = "select max(srno) as sr from prsnl";

        $result = mysql_query($sql, $link);

        while ($row = mysql_fetch_array($result)) {
            $srno = $row['sr'];
            $srno = $srno + 1;
        }
        if ($post == "SOUL Co-ordinator-2-2018") {
            $unid = "SOCO" . "-2018-" . $srno;
        } else if ($post == "PA-CS-2018") {
            $unid = "PACS" . "-1-2018-" . $srno;
        } else if ($post == "PA-LS-2018") {
            $unid = "PALS" . "-1-2018-" . $srno;
        }

        $temp = explode(".", $_FILES["file-2"]["name"]);
        $newfilename = $unid . '-sign.' . end($temp);
        $file_1_path = 'uploads/sign/' . $newfilename;
        move_uploaded_file($_FILES["file-2"]["tmp_name"], $file_1_path);



        $temp = explode(".", $_FILES["file-1"]["name"]);
        $newfilename = $unid . '-pht.' . end($temp);
        $file_2_path = 'uploads/pht/' . $newfilename;
        move_uploaded_file($_FILES["file-1"]["tmp_name"], $file_2_path);


        $temp = explode(".", $_FILES["file-3"]["name"]);
        $newfilename = $unid . '-noc.' . end($temp);
        $file_3_path = 'uploads/noc/' . $newfilename;
        move_uploaded_file($_FILES["file-3"]["tmp_name"], $file_3_path);



        $temp = explode(".", $_FILES["file-4"]["name"]);
        $newfilename = $unid . '-othr.' . end($temp);
        $file_4_path = 'uploads/othr/' . $newfilename;
        move_uploaded_file($_FILES["file-4"]["tmp_name"], $file_4_path);

        $temp = explode(".", $_FILES["file-5"]["name"]);
        $newfilename = $unid . '-qual.' . end($temp);
        $file_5_path = 'uploads/qual/' . $newfilename;
        move_uploaded_file($_FILES["file-5"]["tmp_name"], $file_5_path);

        $temp = explode(".", $_FILES["file-6"]["name"]);
        $newfilename = $unid . '-expr.' . end($temp);
        $file_6_path = 'uploads/expr/' . $newfilename;
        move_uploaded_file($_FILES["file-6"]["tmp_name"], $file_6_path);

        $temp = explode(".", $_FILES["file-7"]["name"]);
        $newfilename = $unid . '-caste.' . end($temp);
        $file_7_path = 'uploads/caste/' . $newfilename;
        move_uploaded_file($_FILES["file-7"]["tmp_name"], $file_7_path);

        $criminal = '';
        $court = '';
        $pdetails = '';
        $ctdetails = '';
        $crdetails = '';
        $cate1 = '';
        $caste = $category;
        //echo $_SESSION['photopath']; 
        //$_SESSION['photopath'] = "./photos/". $unid
        //$estr = str_replace("'./photos/".$unid, $unid, $_SESSION['photopath']);
        //$photo = $_SESSION['photopath']; 
        // echo $srno;
        //echo $post;


        $sql = "insert into prsnl VALUES(0,'$unid','$prefix','$surname','$name','$fname','$lname','$dob','$sex','$nation','$address','$state','$telephone','$city','$pincode','$paddress','$pstate','$pcity','$ppincode','$mobile','$email','$mstatus','$post','$date','current','$file_2_path','$category','$certino','$certidate','$authority','$region','$agenew')";
//echo $sql;
        $sql = mysql_query($sql, $link);

        $sql = "insert into edctn VALUES('$unid','$edu1', '$board1','$year1','$per1','$div1','$edu2', '$board2','$year2','$per2','$div2','$edu3', '$board3','$year3','$per3','$div3','$edu4', '$board4','$year4','$per4','$div4','$edu5', '$board5','$year5','$per5','$div5','$speci1','$speci2','$speci3','$speci4','$speci5')";
//echo $sql;
        $sql = mysql_query($sql, $link);

        $sql = "insert into exprn VALUES('$unid','$org1', '$pos1','$from1','$to1','$nature1','$pay1','$org2', '$pos2','$from2','$to2','$nature2','$pay2','$org3', '$pos3','$from3','$to3','$nature3','$pay3','$org4', '$pos4','$from4','$to4','$nature4','$pay4','$org5', '$pos5','$from5','$to5','$nature5','$pay5','$total1','$total2','$total3','$total4','$total5','$grandtotal','$cate1','$otype1','$otype2','$otype3','$otype4','$otype5')";
//echo $sql;
        $sql = mysql_query($sql, $link);

        $sql = "insert into othrs VALUES('$unid','$caste', '$police','$pdetails','$court','$ctdetails','$criminal','$crdetails','$ref1','$ref2','Yes','','$file_1_path','$file_3_path','$file_4_path','$file_5_path','$file_6_path','$file_7_path')";
//echo $sql;
        $sql = mysql_query($sql, $link);

        echo "<br/><center><h2 style=color:green>Registartion Successful !  </h3>";
        echo "Please Check Your";
        // echo "Your Registration ID is : "."<font style=color:blue><b>".$unid."</b></font></center><br/>";


        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'krutidanak96@gmail.com';                 // SMTP username
            $mail->Password = 'krutigmail';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to
            // $reg_id = rand(11111111, 99999999);
            //Recipients
            $mail->setFrom('krutidanak96@gmail.com', 'recruitment');
            $mail->addAddress('danakkruti@inflibnet.ac.in');     // Add a recipient
            // Name is optional
            //$mail->addReplyTo('krutidanak96@gmail.com', 'Information');
            //Attachments
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Registration ID';
            $mail->Body = "Your Registration ID is $unid.";


            $mail->send();
            //echo 'Message has been sent';
        } catch (Exception $e) {
            //  echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    } else {
        $msg = '<p class = "tanx">Registration fail. please Go Back!';
    }
    ?>
    <?php
    $result = "";
    session_start();
    if (isset($_POST['Submit'])) {
        //exit;

        $regid = mysql_real_escape_string($_POST['regid']);

        $dob = mysql_real_escape_string($_POST['dob']);


        //echo  $username ;
        //echo $dob;

        $sql = "Select * From prsnl where id ='$regid' and dob = '$dob' and status ='Current' ";

        //echo $sql;
        // exit;
        $result = mysql_query($sql, $link);

        if (mysql_num_rows($result) == 0) {
            $msg = "Incorrect Authentication.";
        } else {
            while ($row = mysql_fetch_assoc($result)) {
                $udob = $row['dob'];
                $post = $row['post'];

                // echo $post;
                if ($dob != $udob) {
                    $msg = "Incorrect DOB.";
                } else {

                    $_SESSION['regid'] = $regid;

                    //if (strpos($post, 'Project') !== false) {					
                    //	header("location:report_project.php");
                    //}
                    //else if (strpos($post, 'Consultant') !== false) {					
                    //	header("location:report_project.php");
                    //}
                    //else
                    //{
                    header("location:print_application.php");
                    //}
                    //exit(0);
                    $msg = "";
                }
            }
        }
    }
    ?>
    <?php

    function my_error_handler($errno, $errstr, $errfile, $errline) {
        throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
    }

    function my_exception_handler($e) {

        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        session_register_shutdown();

        $_SESSION['error'] = $e;

        header('Location: viewstatus.php');
        exit();
    }

    set_error_handler('my_error_handler');
    set_exception_handler('my_exception_handler');
    ?>
    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
    <html>
        <head>
            <title>Candidate Login</title>
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
            <link href="css/style.css" rel="stylesheet" type="text/css">

        </head>

        <body>
            <div align="center">
                <form name="form1" method="post">
                    <table align="center" class="form" action ="viewstatus.php">
                        <tr>
                            <td>
                                <table align="center" class="form" width="100%" border="0">

                                    <tr>
                                        <td align="right"><div align="right" ><img src="images/inflibnetlogo.gif" height="80" width="80" /></div></td>
                                        <td align="left" colspan="3"><div align="left">
                                                <p><strong><font size="4" color="#6666CC">



                                                            Information and Library Network Centre</font></strong></p>
                                                <p><strong><font size="2" color="#6666CC">(An IUC of University Grants Commission)</font></strong></p>
                                                <p><strong><font size="2" color="#6666CC">Post Box No. 4, Infocity Area</font> </strong></p>
                                                <p><strong><font size="2" color="#6666CC">Gandhinagar-382007, Gujarat </font> </strong></p>
                                            </div></td>
                                    </tr>
                                </table>
                            </td></tr>

                        <tr>
                            <td>

                                <table align="center" class="form" width="100%" border="0">

                                    <tr>
                                        <td width="256"><font color="red"><?php
                                                if ($result) {
                                                    echo $msg;
                                                }
                                                ?></font></td>
                                </tr>
                                <TR>
                                    <TD class="tblhead" align="middle" colSpan="2"><div align="center" class="style15"> Candidate Login </div></TD>
                                </TR>
                                <TR>
                                    <TD class="firstalt" align="middle" width="33%"><span class="style16">Registration ID :</span></TD>
                                    <TD width="67%" align=left class=firstalt><input name="regid" type="text"  id="regid"  maxlength="20" size="20" tabindex="1">
                                    </TD>
                                </TR>
                                <TR>
                                    <TD class="secondalt" align="middle"><span class="style16">DOB(yyyy-mm-dd) :</span><BR>
                                    </TD>
                                    <TD class="secondalt" align=left><input name="dob" type="text"  id="dob"  maxlength="11" size="20" AUTOCOMPLETE="OFF" tabindex="2" ></TD>
                                </TR>
                                <TR>
                                    <TD class="sectionhead" align="middle">
                                    </TD>
                                    <TD class="sectionhead" align="middle">  <input name="Submit" type="submit" class="admin_add_items" value="Submit"></TD>

                                </TR>
                            </table>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>
