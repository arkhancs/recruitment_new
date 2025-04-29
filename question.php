<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
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
include "dbConfig.php";
if (!isset($_SERVER['HTTP_REFERER'])) {
    header('location:./index.php');
    exit;
}
session_start();
if (isset($_SESSION)) {
    $post = $_SESSION['post'];
    $job_location = $_SESSION['job_location'];
    $job_type = $_SESSION['job_type'];
    $prefix = $_SESSION['prefix'];
    $surname = $_SESSION['surname'];
    $name = $_SESSION['name'];
    $fathername = $_SESSION['fathername'];
    $lastname = $_SESSION['lastname'];
    $app_id = $_SESSION['app_id'];
    $photo = $_SESSION['photo'];
    $post_name = $_SESSION['post_name'];
    $status = $_SESSION['status'];
    $status_check = $_SESSION['status_check'];
    $exam_date = $_SESSION['exam_date'];
    $post_category = $_SESSION['post_category'];
    $year = $_SESSION['year'];
    $closed_date = $_SESSION['closed_date'];
    $hard_copy_received = $_SESSION['hard_copy_received'];
    $remarks = $_SESSION['remarks'];
    $inward_no = $_SESSION['inward_no'];
    $inward_date = $_SESSION['inward_date'];
    $transaction_ref_no = $_SESSION['transaction_ref_no'];
    $dd_amount = $_SESSION['dd_amount'];
}
?>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Question Form</title>
    <link rel="shortcut icon" href="https://www.inflibnet.ac.in/images/favicon.ico">
    </link>
    <!--<link href="css/style.css" rel="stylesheet" type="text/css"></link>-->
    <script type="text/javascript" src="js/Ajaxfileupload-jquery-1.3.2.js"></script>
    <script type="text/javascript" language="javascript" src="js/validate.js"></script>
    <script type="text/javascript" language="javascript" src="js/script.js"></script>
    <script type="text/javascript" src="js/ajaxupload.3.5.js"></script>
    <script type="text/javascript" src="js/exp_calculation.js"></script>
    <script type="text/javascript" src="js/seperate_exp_calculation.js"></script>
    <link rel="stylesheet" href="css/jquery-ui.css">
    </link>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    </link>
    <script src="js/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script src="dtpicker/jquery-1.10.2.js"></script>
    <script src="dtpicker/jquery-ui.js"></script>
    <link rel="stylesheet" type="text/css" href="css/Ajaxfile-upload.css" />
    </link>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    </meta>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    </link>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    </link>
    <link rel="stylesheet" type="text/css" href="css/custom.css">
    </link>.
    <script src="js/parsley.min.js"></script>
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
    </style>
</head>

<body>
    <div class="container" style="padding-top:5px;padding-bottom: 20px; border-radius: 5px; ">
        <div class="header_main1 mb30">
            <img src="images/logo.png" class="img-responsive inf-logo" />
            <h3 class="inf-title pull-left">
                <b>Information and Library Network Centre, Gandhinagar</b><br />
                <p style="padding-top:10px;"><small><strong>Question Submission Form</strong></small></p>
            </h3>
        </div>
        <?php
        echo $_SESSION['que_notification'];
        unset($_SESSION['que_notification']);
        ?>
        <div class="row">
            <div class="col-md-12">
                <?php
                if ($prefix != '' && $name != '') {
                    $welcome_message = 'Welcome ' . strtoupper($prefix) . ' ' . strtoupper($surname) . ' ' . strtoupper($name) . ' ' . strtoupper($fathername) . ',<br/>Your Application ID: <b>' . $app_id . '</b>';
                }
                ?>
                <?php if ($welcome_message != '') { ?>
                    <span><?php echo $welcome_message; ?></span><br />
                <?php } ?>
                <?php if ($_SESSION['is_login'] == 'true') { ?><a href="logout.php" style="margin-top:-25px; margin-bottom:10px;" class="pull-right"><i class="fa fa-power-off" style="font-size:25px"></i></a><?php } ?>
            </div>
        </div>
        <center>
            <a href="dashboard.php" id="exit_btn" class="btn btn-danger mb30">Back to Dashboard</a>
        </center>
        <form id="question_frm" action="question_action.php" method="post" enctype="multipart/form-data" class="form_design">
            <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
            <p class="text-center" style="color:red"><strong>Note: Every per question you need to paid fee 100/- Rs. for question.</strong></p>
            <hr class="mb20">
            </hr>
            <input type="hidden" name="candidate_id" id="candidate_id" value="<?php echo $app_id; ?>"></input>
            <input type="hidden" name="post" id="post" value="<?php echo $post; ?>"></input>
            <div class="row">
                <div class="col-md-3 mb20">
                    <label for="question_no" style="text-align:left"> <b>Question Number:<font style="color:red">*</font></b></label>
                    <select name="question_no" id="question_no" class="form-control" required>
                        <option value="">Select Question Number</option>
                        <?php
                        for ($i = 1; $i <= 100; $i++) {
                        ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-3 mb20">
                    <label for="question_option" style="text-align:left"> <b>Question Option:<font style="color:red">*</font></b></label>
                    <select name="question_option" id="question_option" class="form-control" required>
                        <option value="">Select Question Option</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                    </select>
                </div>
                <div class="col-md-6 mb20">
                    <label for="remarks_file" style="text-align:left"> <b>Upload file:</b></label>
                    <input type="file" name="remarks_file" id="remarks_file" class="form-control"></input>
                </div>
                <div class="col-md-12 mb20">
                    <label for="question_remarks" style="text-align:left"> <b>Question Remarks:</b></label>
                    <textarea name="question_remarks" id="question_remarks" class="form-control"></textarea>
                </div>
                <div class="col-md-4 mb20">
                    <label for="question_remarks" style="text-align:left"> <b>SBI Collect Link:</b></label>
                    <a href="https://www.onlinesbi.com/sbicollect/icollecthome.htm?corpID=1734565" target="_blank" class="btn btn-warning" onclick="return confirm('Fees for every one question is 100/- Rs.')">Click here to pay fees online</a>
                </div>
                <div class="col-md-4 mb20">
                    <label for="question_remarks" style="text-align:left"> <b>Transaction Number:<font style="color:red">*</font></b></label>
                    <input type="text" id="ques_transaction_no" name="ques_transaction_no" class="form-control" required placeholder="For Example: DUC1234567"></input>
                    <label id="msg_ref_no" style="width: 100%; color: red; text-align: left;"></label>
                </div>
                <div class="col-md-4 mb20">
                    <label for="question_remarks" style="text-align:left"> <b>Transaction Receipt:<font style="color:red">*</font></b></label>
                    <input type="file" id="ques_transaction_receipt" name="ques_transaction_receipt" class="form-control" required></input>
                </div>
                <div class="col-md-12">
                    <input type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary"></input>
                </div>
            </div>
        </form>


        <table class="table table-bordered table-striped mt20" id="example">
            <thead>
                <tr>
                    <th class="text-center">Sr. No.</th>
                    <th class="text-center">Question Number</th>
                    <th class="text-center">Question Option</th>
                    <th class="text-center">Remarks</th>
                    <th class="text-center">Remarks File</th>
                    <th class="text-center">Transaction Number</th>
                    <th class="text-center">Transaction Receipt</th>
                    <th class="text-center">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('../dbConfig.php');
                $sql = "select * from question where candidate_id = '$app_id'";
                $result = mysqli_query($link, $sql);

                if ($result->num_rows > 0) {
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <tr>
                            <td align="center"><?php echo $i; ?></td>
                            <td><?php echo $row['que_no']; ?></td>
                            <td><?php echo $row['que_option']; ?></td>
                            <td><?php echo $row['que_remarks']; ?></td>
                            <td align="center"><?php if ($row['que_file'] != "") { ?><a href="<?php echo $row['que_file']; ?>" target="_blank">View</a><?php } ?></td>
                            <td><?php echo $row['que_transaction_id']; ?></td>
                            <td align="center"><a href="<?php echo $row['ques_transaction_receipt']; ?>" target="_blank">View</a></td>
                            <td><?php echo $row['ques_insert_date']; ?></td>
                        </tr>
                    <?php
                        $i++;
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="7" class="text-center">No record found</td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
<script>
    $(document).ready(function() {
        $('#btn_submit').on("click", function() {
            var frm = $('#question_frm');
            var frmParsley = frm.parsley();
            frmParsley.validate();
            if (!frm.parsley().isValid()) {
                return false;
            }

            if (document.question_frm.question_no.value == "") {
                alert("Please Select Question Number");
                document.frmregister.question_no.focus();
                return false;
            } else if (document.question_frm.question_option.value == "") {
                alert("Please Select Question Option");
                document.frmregister.question_option.focus();
                return false;
            } else if (document.question_frm.ques_transaction_no.value == "") {
                alert("Please Enter Transaction Number.");
                document.frmregister.ques_transaction_no.focus();
                return false;
            } else if (document.question_frm.ques_transaction_receipt.files.length == 0) {
                alert("Please Upload Transaction Receipt.");
                document.frmregister.ques_transaction_receipt.focus();
                return false;
            }
        });

        $('#remarks_file').change(function() {
            var file_name = $(this).val();
            var fileExtension = file_name.substr((file_name.lastIndexOf('.') + 1));
            var extension_array = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'pdf', 'PDF'];
            if (extension_array.indexOf(fileExtension) == -1) {
                alert("Please upload only JPG/PNG/PDF file for Question Remarks.");
                document.getElementById("remarks_file").value = null;
            }
            if (Math.round(document.getElementById('remarks_file').files[0].size / 1024) > 1024) {
                alert("Question Remarks should be less than 1MB.");
                document.getElementById("remarks_file").value = null;
            }
        });

        $('#ques_transaction_receipt').change(function() {
            var file_name = $(this).val();
            var fileExtension = file_name.substr((file_name.lastIndexOf('.') + 1));
            var extension_array = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'pdf', 'PDF'];
            if (extension_array.indexOf(fileExtension) == -1) {
                alert("Please upload only JPG/PNG/PDF file for Transaction Receipt.");
                document.getElementById("ques_transaction_receipt").value = null;
            }
            if (Math.round(document.getElementById('ques_transaction_receipt').files[0].size / 1024) > 200) {
                alert("Transaction Receipt should be less than 200 KB.");
                document.getElementById("ques_transaction_receipt").value = null;
            }
        });

        $('#ques_transaction_no').focusout(function() {
            var ques_transaction_no = $("#ques_transaction_no").val();
            var candidate_id = $("#candidate_id").val();
            $.ajax({
                url: 'question_check_transaction_no.php',
                data: {
                    ques_transaction_no: ques_transaction_no,
                    candidate_id: candidate_id
                },
                dataType: 'json',
                type: 'post',
                success: function(response) {

                    if (response == "false") {
                        $("#msg_ref_no").html('Transaction referance number must be unique.');
                        document.getElementById("transaction_ref_no").focus();
                        return false;
                    } else {
                        $("#msg_ref_no").html('');
                        return true;
                    }
                }
            });
        })
    });
</script>

</html>