<?php
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
    $open_date_admin = $_SESSION['open_date_admin'];
    $closed_date_admin = $_SESSION['closed_date_admin'];
}

date_default_timezone_set('Asia/Kolkata');
$current_date = date("Y-m-d H:i:s");
$dateTimestamp1 = strtotime($current_date);

$submissionclosed_date = date("Y-m-d H:i:s", strtotime(strtr($closed_date, '/', '-')));
$dateTimestamp2 = strtotime($submissionclosed_date);

$admitcardclosed_date = date("Y-m-d H:i:s", strtotime(strtr($exam_date, '/', '-')));
$dateTimestamp3 = strtotime($admitcardclosed_date);
?>

<?php include 'header.php'; ?>
<style type="text/css">
    .br {
        border-right: 1px solid #fff;
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
<div class="container">
    <div class="login-form white-text">
        <div class="row">
            <div class="col-md-6">
                <?php
                if ($prefix != '' && $name != '') {
                    $welcome_message = 'Welcome ' . strtoupper($prefix) . ' ' . strtoupper($surname) . ' ' . strtoupper($name) . ' ' . strtoupper($fathername);
                }
                ?>
                <?php if ($welcome_message != '') { ?>
                    <span><?php echo $welcome_message; ?></span><br />
                <?php } ?>
            </div>
            <div class="col-md-6 text-right">
                Application ID: <b><?php echo $app_id; ?></b>
            </div>
        </div>
        <div class="preload" style="display: none;">
            <center><img src="images/25.gif" /></center>
        </div>
        <form name="form1" method="post" action="">
            <div class="row titleText">
                <div class="col-md-6 col-sm-6 col-xs-12 br">
                    <div class="col-md-12 col-sm-12 col-xs-12 buttonGroup pb30">
                        <h4 class="postTitle">Application Status:</h4>
                        <ul class="contactBox">
                            <?php if ($status == 'panding') { ?>
                                <li><i class="fa fa-hand-o-right"></i> Submission Pending
                                    <?php if ($status == 'panding') { ?>
                                        <i class="fa fa-check" style="color:green !important;"></i>
                                    <?php } else { ?>
                                        <i class="fa fa-close" style="color:red !important;"></i>
                                    <?php } ?>
                                </li>
                            <?php } else { ?>
                                <li><i class="fa fa-hand-o-right"></i> Application Submitted
                                    <?php if ($status == 'current') { ?>
                                        <i class="fa fa-check" style="color:green !important;"></i>
                                    <?php } else { ?>
                                        <i class="fa fa-close" style="color:red !important;"></i>
                                    <?php } ?>
                                </li>
                            <?php } ?>
                            <!--<li><i class="fa fa-hand-o-right"></i> Fees Paid->
/*<?php if ($transaction_ref_no != '' && $dd_amount != '') { ?>
                                        <i class="fa fa-check" style="color:green !important;"></i>
                            <?php } else { ?>
                                        <i class="fa fa-close" style="color:red !important;"></i>
                            <?php } ?>*/
</li>
<li><i class="fa fa-hand-o-right"></i> Hard Copy/Documents Received 
/*    <?php if ($hard_copy_received == 'Yes') { ?>
                                        <i class="fa fa-check" style="color:green !important;"></i> <br/>
                                <?php
                                if ($inward_no != '') {
                                    echo '<i class="fa fa-minus"></i> Inward No: ' . $inward_no . ', ';
                                }
                                ?> <?php
                                    if ($inward_date != '') {
                                        echo 'Inward Date: ' . $inward_date;
                                    }
                                    ?>
                            <?php } else { ?>
                                        <i class="fa fa-close" style="color:red !important;"></i>
                            <?php } ?>*/
</li>
<li><i class="fa fa-hand-o-right"></i> Documents Verified 
                            <?php if ($status_check != '') { ?>
                                        <i class="fa fa-check" style="color:green !important;"></i>
                            <?php } else { ?>
                                        <i class="fa fa-close" style="color:red !important;"></i>
                            <?php } ?>
</li>-->
                        </ul>
                        <!--<h4 class="postTitle">Final Application Status :</h4>-->
                        <?php /* if ($status_check != "") { ?>
                          <div class="btn btn-block <?php
                          if ($status_check == 'Eligible') {
                          echo "btn-success";
                          } else if ($status_check == 'NotEligible') {
                          echo "btn-danger";
                          } else if ($status_check == 'Provisionally') {
                          echo "btn-warning";
                          }
                          ?>"><?php echo $status_check; ?></div>
                          <?php } ?>
                          <?php
                          if ($remarks != '') {
                          echo '<h4 class="postTitle">Remarks :</h4>';
                          echo "<span  style='color: #F2660E;'>" . $remarks;
                          } */
                        ?>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="col-md-12 col-sm-12 col-xs-12 buttonGroup">
                        <?php
                        //  if ($status == 'current' && ($status_check == 'Eligible' || $status_check != 'Provisionally') && $exam_date != '' && ($post == 'SBLS-2-2024') && $year == '2024') {
                        ?>
                        <?php if ($status == 'current' && ($status_check == 'Eligible') && $exam_date != '' && ($post == 'SBLS-2-2024') && $year == '2024') { ?>
                            <?php if ($current_date <= "2025-01-28 10:00:00") { ?>
                                <!-- <a href="admit_card.php" class="borderWhite login-btn btn btn-block blueBtn download_admin_card"><i class="fa fa-download f30"></i> <br>Download Admit Card</a> -->
                                <a href="admit_card.php" class="borderWhite login-btn btn btn-block blueBtn download_admin_card" onclick="print_admit_card();">
                                    <i class="fa fa-download f30"></i> <br>Download Admit Card
                                </a>

                            <?php } ?>
                            <a href="print_application.php" class="borderWhite login-btn btn btn-block blueBtn print_application"><i class="fa fa-print f30"></i> <br>Print Application</a>
                        <?php } else if ($status == 'current' && ($status_check == '' || $status_check == null || $status_check == 'NotEligible')) { ?>
                            <a href="print_application.php" class="borderWhite login-btn btn btn-block blueBtn print_application"><i class="fa fa-print f30"></i> <br>Print Application</a>
                        <?php
                        } else if ($status == 'panding' && $open_date_admin <= $current_date && $current_date <= $closed_date_admin) {
                            //                            } else if ($status == 'panding' && $dateTimestamp2 >= $dateTimestamp1) {
                        ?>
                            <a href="javascript:void(0)" class="borderWhite login-btn btn btn-block blueBtn application_form"><i class="fa fa-address-card-o f30"></i> <br>Submit Application</a>


                        <?php } else if ($status == 'current' && ($status_check == 'Eligible' || $status_check == 'Provisionally') && ($post_category == 'CS' || $post_category == 'Admin' || $post_category == 'LS') && ($year == '2023' || $year == '2024')) { ?>
                            <a href="print_application.php" class="borderWhite login-btn btn btn-block blueBtn print_application"><i class="fa fa-print f30"></i> <br>Print Application</a>
                        <?php } else { ?>
                            <div class="btn-danger text-justify" style="padding:10px;">Since the application last date has been over therefore you can not proceed further.</div>
                        <?php } ?>
                        <!--<a href="question.php" class="borderWhite login-btn btn btn-block blueBtn"><i class="fa fa-pencil f30"></i> <br>Question</a>-->
                    </div>
                </div>
                <div style="clear: both;"></div>
                <div class="col-md-3 col-sm-3 hidden-xs"></div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <h4 class="inquiryTitle"><span>For Query</span></h4>
                    <ul class="contactBox">
                        <!--<li class="text-center"><i class="fa fa-user"></i> Administrative Officer (PA &amp; F)</li>
                        <li class="text-center"><i class="fa fa-map-marker" aria-hidden="true"></i> INFLIBNET Centre, Infocity, Gandhinagar - 382007</li>-->
                        <li class="text-center"><i class="fa fa-phone"></i> (+91) 79 2326 8000</li>
                        <li class="text-center"><i class="fa fa-envelope"></i> recruitment[at]inflibnet[dot]ac[dot]in </li>
                    </ul>
                </div>
            </div>

        </form>
    </div>
</div>
</div>
<?php include 'footer.php'; ?>
</body>

<script type="text/javascript">
    $(document).ready(function() {

        $(".application_form").click(function() {
            $.ajax({
                url: 'application_form_ajax.php',
                // data: {app_id: app_id},
                dataType: 'json',
                type: 'post',
                beforeSend: function() {
                    $(".preload").show();
                },
                success: function(data) {
                    if (data == 'Success') {
                        location.href = "application_form.php";
                    } else {
                        alert('Kindly logout your account and try again.!');
                    }
                },
                complete: function(data) {
                    $(".preload").hide();
                }
            });
        });

        $(".print_application").click(function() {
            $.ajax({
                url: 'application_track_ajax.php',
                data: {
                    type: 'Print Application'
                },
                dataType: 'json',
                type: 'post',
                success: function(data) {

                }
            });
        });

        $(".download_admin_card").click(function() {
            $.ajax({
                url: 'application_track_ajax.php',
                data: {
                    type: 'Download Admit Card'
                },
                dataType: 'json',
                type: 'post',
                success: function(data) {

                }
            });
        });
    });
</script>
<script type="text/javascript">
    function print_admit_card() {
        $.ajax({
            url: 'admit_card_status.php',
            dataType: 'json',
            type: 'post',
            success: function(data) {

            }
        });
    }
</script>

</html>