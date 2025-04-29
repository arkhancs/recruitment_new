<?php
error_reporting(0);

include "dbConfig.php";

// $sql = "select p.id as app_id, p.*, re.category as post_category, re.Name, re.closed_date, re.year, re.exam_date, re.exam_time from prsnl p left join req_experience re on re.post = p.post where p.status='current' and  (p.status_check='Provisionally' || p.status_check='Eligible') and (re.post ='SAOAAdmin-1-2019' || re.post = 'OAIIAdmin-1-2020')";

$sql = "SELECT p.id AS app_id, p.*, re.category AS post_category, re.Name, re.closed_date, re.year, re.exam_date, re.exam_time FROM prsnl p LEFT JOIN req_experience re ON re.post = p.post WHERE p.status = 'current' AND (p.status_check = 'Provisionally' OR p.status_check = 'Eligible') AND (re.post = 'SBLS-2-2024')";



$result = mysqli_query($link, $sql);
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

    <?php
    if (mysqli_num_rows($result) == 0) {
        $msg = "Data not Found";
    } else {

        while ($row = mysqli_fetch_assoc($result)) {

            if ($i == 1) {
    ?>

                <div class="container">
                    <div class="header_main1">
                        <img src="images/logo.png" class="img-responsive inf-logo" />
                        <h3 class="text_h3">
                            Information and Library Network (INFLIBNET) Centre, Gandhinagar
                        </h3>
                    </div>
                </div>
            <?php } ?>
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
                            <td><?php echo $row['prefix'] . ' ' . $row['name'] . ' ' . $row['fathername'] . ' ' . $row['surname']; ?></td>
                            <td rowspan="3" width="20%">
                                <center><img src='<?php echo $row['photo']; ?>' height="160" width="140" /></center>
                            </td>
                            <td rowspan="3" width="20%">
                                <h4 class="text-center"><strong>AFFIX RECENT PASSPORT SIZE SELF ATTESTED PHOTOGRAPH HERE</strong></h4>
                            </td>
                        </tr>
                        <!--<tr>
                        <td><strong>Date of Birth:</strong></td>
                        <td><?php echo $row['dob']; ?></td>
                    </tr>-->
                        <tr>
                            <td><strong>Name of Post and Application ID:</strong></td>
                            <td><?php echo $row['Name'] . ' (' . $row['post_category'] . ')<br>(' . $row['app_id'] . ')'; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Date & Reporting Time :</strong></td>
                            <td><?php echo $row['exam_date'] . ' / ' . $row['exam_time']; ?></td>
                        </tr>
                        <!--<tr>
                        <td><strong>Time of Exam:</strong></td>
                        <td><?php echo $row['exam_time']; ?></td>
                    </tr>-->
                        <tr>
                            <td><strong>Venue:</strong></td>
                            <td colspan="3">Information and Library Network (INFLIBNET) Centre,<br>
                                Opp. DAIICT, NIFT & TCS Garima Park, Infocity Area, Gandhinagar-382007
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        <?php

        }
    }
    if (mysqli_num_rows($result) > 0) {
        ?>

        <center>
            <a href="#" id="print_btn" class="btn btn-primary mb20" onclick="window.print()">Print</a>
        </center>

    <?php } ?>
</body>

</html>