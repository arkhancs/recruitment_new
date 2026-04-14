<?php error_reporting(0);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Print Application</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" language="javascript" src="js/validate.js"></script>
    <link rel="stylesheet" type="text/css" href="css/custom.css" />

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
    <form>
        <?php
        include "dbConfig.php";
        session_start();


        $regid = mysqli_real_escape_string($link, $_SESSION['app_id']);
        $sql = "select prsnl.id as app_id,prsnl.*,edctn.*,exprn.*,othrs.* from prsnl,edctn,exprn,othrs where othrs.id ='$regid' and edctn.id ='$regid' and exprn.id ='$regid' and prsnl.id ='$regid'";


        $result = mysqli_query($link, $sql);

        while ($row = mysqli_fetch_assoc($result)) {

            $query2 = "select * from req_experience where status='OPEN'";
            $result2 = mysqli_query($link, $query2);
            if (mysqli_num_rows($result2) > 0) {
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    if ($row2['category'] == '') {
                        $val = $row2['post_id'] . '-' . $row2['sequence'] . '-' . $row2['year'];
                        if ($row['post'] == $val) {
                            $post_name = $row2['Name'];
                            $closing_date = $row2['closed_date'];
                        }
                    } else {
                        $val = $row2['post_id'] . $row2['category'] . '-' . $row2['sequence'] . '-' . $row2['year'];
                        if ($row['post'] == $val) {

                            $post_name = $row2['Name'] . '(' . $row2['category'] . ')';
                            $closing_date = $row2['closed_date'];
                        }
                    }
                }
            }
        ?>

            <div class="container" style="padding-top:10px;padding-bottom: 23px; border-radius: 5px;">
                <div class="header_main1">
                    <h3>
                        <b>Information and Library Network (INFLIBNET) Centre</b>
                        <p><small>through</small></p>
                        <b>M/s. Viswambi Security Agency Pvt. Ltd.</b> <small>(Purely Contractual Basis)</small>
                        <p style="padding-top:10px;"><small><strong>Online Application Form</strong></small></p>
                    </h3>
                </div>

                <br />
                <div class="row">
                    <div class="col-md-4">
                        <span class=""><b>Application ID : </b><?php echo $row['app_id']; ?></span>
                    </div>
                    <div class="col-md-4">
                        <span class=""><b>Post Applied for : </b><?php echo $post_name; ?></span>
                    </div>
                    <div class="col-md-4">
                        <span class=""><b>Job Location : </b><?php
                                                                echo $row['job_location'];
                                                                ?></span>
                    </div>
                </div>
                <br />
                <div style="overflow:auto">
                    <table class="form" border="1" width="100%">
                        <tr height="20%">
                            <td align="left" colspan="4"><strong>
                                    <font size="2" color="#000080">1. Personal/Contact Information</font>
                                </strong>
                            </td>

                        </tr>
                        <tr>
                            <td width="20%" style="position:relative;">Name:</td>
                            <td border-right="0px" style="position:relative;border:0"><?php echo strtoupper($row['surname']) . " " . strtoupper($row['name']) . " " . strtoupper($row['fathername']); ?> </td>

                            <td rowspan="3" colspan="2" width="8%" style="position:relative;border:0;border-right: 1px lightgray solid">
                                <?php
                                $photo = $row['photo'];
                                ?>
                                <img src='<?php echo $photo ?> ' height="150" width="140" align="right" />
                            </td>
                        </tr>
                        <tr>
                            <td width="20%" style="position:relative;">Date of Birth:</td>
                            <td width="30%" style="position:relative;border:0"><?php echo date('F j, Y', strtotime($row['dob'])); ?></td>

                        </tr>
                        <tr>
                            <td width="20%" style="position:relative;">Category:</td>
                            <td width="30%" style="position:relative;border:0;border-right:1px"><?php echo $row['category']; ?></td>
                        </tr>
                        <tr>
                            <!--<td width="20%"  style="position:relative;">Region applied for:</td>
                                <td width="30%" style="position:relative;"> <?php echo $row['region']; ?></td>      -->
                            <td width="20%" style="border-right:1px">Nationality:</td>
                            <td colspan="2" width="30%" style="border-right:0px"><?php echo $row['nation']; ?> </td>
                            <td style="border-left:0px"></td>

                        </tr>
                        <tr>
                            <td width="20%" style="position:relative">Gender:</td>
                            <td width="30%" style="position:relative"><?php echo $row['sex']; ?></td>
                            <td width="20%">Marital Status:</td>
                            <td width="30%"><?php echo $row['mstatus']; ?></td>
                        </tr>
                        <tr>
                            <td width="20%" style="position:relative">Mailing Address:</td>
                            <td colspan="3" width="80%" style="position:relative"><?php echo $row['address']; ?>, <?php echo $row['city']; ?>- <?php echo $row['pincode']; ?>, <?php echo $row['state']; ?></td>

                        </tr>

                        <tr>
                            <td width="20%" style="position:relative">Permanent Address:</td>
                            <td colspan="3" width="80%" style="position:relative"><?php echo $row['paddress']; ?>, <?php echo $row['pcity']; ?>- <?php echo $row['ppincode']; ?>, <?php echo $row['pstate']; ?></td>

                        </tr>
                        <tr>
                            <td width="20%" style="position:relative;">Telephone:</td>
                            <td width="30%" style="position:relative;"><?php echo ($row['telephone'] != '') ? $row['telephone'] : "-"; ?></td>
                            <td width="20%">Mobile:</td>
                            <td width="30%"><?php echo $row['mobile']; ?></td>
                        </tr>
                        <tr>
                            <td width="20%" style="position:relative;">Email:</td>
                            <td width="30%" style="position:relative;" colspan="1"><?php echo $row['email']; ?> </td>
                            <td width="20%">Aadhaar Number:</td>
                            <td width="30%"><?php echo ($row['aadhar_no'] != '') ? $row['aadhar_no'] : "-"; ?></td>
                        </tr>
                    </table>
                </div>

                <br />

                <table class="form" width="100%" border="1">
                    <tr align="center">
                        <td colspan="7">
                            <p><strong>
                                    <font size="2" color="#000080">2. Educational/Professional Qualification Starting from Graduation: </font>
                                </strong></p>
                        </td>
                    </tr>

                    <tr>
                        <td width="3%" align="center"><strong>Sr.no</strong></td>
                        <td width="18%" valign="middle"><strong>Degree</strong></td>
                        <td width="24%" valign="middle"><strong>Specialization</strong></td>
                        <td width="24%" valign="middle"><strong>
                                <p>College/University/Institution</p>
                            </strong></td>
                        <td width="10%" valign="middle">
                            <p><strong>Passing Year</strong></p>
                            <p>&nbsp;</p>
                        </td>
                        <td width="9%" valign="middle">
                            <p><strong>Percentage</strong></p>
                            <p><strong> of marks</strong><strong>(%)</strong> </p>
                        </td>
                        <td width="12%" valign="middle"><strong>
                                <p>Division/</p>
                                <p>Grade</p>
                            </strong></td>
                    </tr>
                    <tr>
                        <td align="center">1.</td>
                        <td><?php echo $row['edu1']; ?> </td>
                        <td><?php echo $row['spec1']; ?></td>
                        <td><?php echo $row['board1']; ?> </td>
                        <td><?php echo $row['year1']; ?> </td>
                        <td><?php echo $row['per1']; ?> </td>
                        <td><?php echo $row['div1']; ?> </td>
                    </tr>
                    <?php if ($row['board2'] <> "") { ?>
                        <tr>
                            <td align="center">2.</td>
                            <td><?php echo $row['edu2']; ?> </td>
                            <td><?php echo $row['spec2']; ?></td>
                            <td><?php echo $row['board2']; ?> </td>
                            <td><?php echo $row['year2']; ?> </td>
                            <td><?php echo $row['per2']; ?> </td>
                            <td><?php echo $row['div2']; ?> </td>
                        </tr>
                    <?php } ?>
                    <?php if ($row['board3'] <> "") { ?>
                        <tr>
                            <td align="center">3.</td>
                            <td><?php echo $row['edu3']; ?> </td>
                            <td><?php echo $row['spec3']; ?></td>
                            <td><?php echo $row['board3']; ?> </td>
                            <td><?php echo $row['year3']; ?> </td>
                            <td><?php echo $row['per3']; ?> </td>
                            <td><?php echo $row['div3']; ?> </td>
                        </tr>
                    <?php } ?>
                    <?php if ($row['board4'] <> "") { ?>
                        <tr>
                            <td align="center">4.</td>
                            <td><?php echo $row['edu4']; ?> </td>
                            <td><?php echo $row['spec4']; ?></td>
                            <td><?php echo $row['board4']; ?> </td>
                            <td><?php echo $row['year4']; ?> </td>
                            <td><?php echo $row['per4']; ?> </td>
                            <td><?php echo $row['div4']; ?> </td>
                        </tr>
                    <?php } ?>

                </table>

                <br />

                <table class="form" width="100%" border="1">
                    <tr></tr>
                </table>


                <table class="form" width="100%" border="1">
                    <tr align="center">
                        <td colspan="8">
                            <p><strong>
                                    <font size="2" color="#000080">3. Experience
                                        (Details of previous and present employment held, if any, in chronological order starting from present position)</font>
                                </strong></p>
                        </td>
                    </tr>

                    <tr>
                        <td width="3%" align="center"><strong>Sr.no</strong></td>
                        <td width="27%"><strong>Name of the Organization </strong> </td>
                        <td width="14%"><strong>
                                <p>Position Held </p>
                            </strong></td>
                        <td width="10%">
                            <p><strong>From</strong></p>
                            <p>(DD/MM/YYYY)</p>
                        </td>
                        <td width="9%">
                            <p><strong>To</strong></p>
                            <p>(DD/MM/YYYY)</p>
                        </td>
                        <td width="25%"><strong>Nature of Duties </strong></td>
                        <td width="12%">
                            <p><strong>
                                    Pay Scale/
                                </strong></p>
                            <p><strong>Gross Salary Rs </strong></p>
                        </td>
                        <td width="25%"><strong>Organization Type </strong></td>
                    </tr>
                    <?php if ($row['org1'] <> "") { ?>
                        <tr>
                            <td align="center">1.</td>
                            <td><?php echo $row['org1']; ?> </td>
                            <td><?php echo $row['pos1']; ?> </td>
                            <td><?php echo $row['from1']; ?> </td>
                            <td><?php echo $row['to1']; ?> </td>
                            <td><?php echo $row['nature1']; ?> </td>
                            <td><?php echo $row['pay1']; ?> </td>
                            <td><?php echo $row['otype1']; ?> </td>
                        </tr>
                    <?php } ?>

                    <?php if ($row['org2'] <> "") { ?>
                        <tr>
                            <td align="center">2.</td>
                            <td><?php echo $row['org2']; ?> </td>
                            <td><?php echo $row['pos2']; ?> </td>
                            <td><?php echo $row['from2']; ?> </td>
                            <td><?php echo $row['to2']; ?> </td>
                            <td><?php echo $row['nature2']; ?> </td>
                            <td><?php echo $row['pay2']; ?> </td>
                            <td><?php echo $row['otype2']; ?> </td>
                        </tr>
                    <?php } ?>
                    <?php if ($row['org3'] <> "") { ?>
                        <tr>
                            <td align="center">3.</td>
                            <td><?php echo $row['org3']; ?> </td>
                            <td><?php echo $row['pos3']; ?> </td>
                            <td><?php echo $row['from3']; ?> </td>
                            <td><?php echo $row['to3']; ?> </td>
                            <td><?php echo $row['nature3']; ?> </td>
                            <td><?php echo $row['pay3']; ?> </td>
                            <td><?php echo $row['otype3']; ?> </td>

                        </tr>
                    <?php } ?>
                    <?php if ($row['org4'] <> "") { ?>
                        <tr>
                            <td align="center">4.</td>
                            <td><?php echo $row['org4']; ?> </td>
                            <td><?php echo $row['pos4']; ?> </td>
                            <td><?php echo $row['from4']; ?> </td>
                            <td><?php echo $row['to4']; ?> </td>
                            <td><?php echo $row['nature4']; ?> </td>
                            <td><?php echo $row['pay4']; ?> </td>
                            <td><?php echo $row['otype4']; ?> </td>

                        </tr>
                    <?php } ?>
                    <?php if ($row['org5'] <> "") { ?>
                        <tr>
                            <td align="center">5.</td>
                            <td><?php echo $row['org5']; ?> </td>
                            <td><?php echo $row['pos5']; ?> </td>
                            <td><?php echo $row['from5']; ?> </td>
                            <td><?php echo $row['to5']; ?> </td>
                            <td><?php echo $row['nature5']; ?> </td>
                            <td><?php echo $row['pay5']; ?> </td>
                            <td><?php echo $row['otype5']; ?> </td>
                        </tr>
                    <?php } ?>
                    <?php if ($row['org6'] <> "") { ?>
                        <tr>
                            <td align="center">6.</td>
                            <td><?php echo $row['org6']; ?> </td>
                            <td><?php echo $row['pos6']; ?> </td>
                            <td><?php echo $row['from6']; ?> </td>
                            <td><?php echo $row['to6']; ?> </td>
                            <td><?php echo $row['nature6']; ?> </td>
                            <td><?php echo $row['pay6']; ?> </td>
                            <td><?php echo $row['otype6']; ?> </td>
                        </tr>
                    <?php } ?>
                    <?php if ($row['org7'] <> "") { ?>
                        <tr>
                            <td align="center">7.</td>
                            <td><?php echo $row['org7']; ?> </td>
                            <td><?php echo $row['pos7']; ?> </td>
                            <td><?php echo $row['from7']; ?> </td>
                            <td><?php echo $row['to7']; ?> </td>
                            <td><?php echo $row['nature7']; ?> </td>
                            <td><?php echo $row['pay7']; ?> </td>
                            <td><?php echo $row['otype7']; ?> </td>
                        </tr>
                    <?php } ?>
                    <?php if ($row['org8'] <> "") { ?>
                        <tr>
                            <td align="center">8.</td>
                            <td><?php echo $row['org8']; ?> </td>
                            <td><?php echo $row['pos8']; ?> </td>
                            <td><?php echo $row['from8']; ?> </td>
                            <td><?php echo $row['to8']; ?> </td>
                            <td><?php echo $row['nature8']; ?> </td>
                            <td><?php echo $row['pay8']; ?> </td>
                            <td><?php echo $row['otype8']; ?> </td>
                        </tr>
                    <?php } ?>
                    <?php if ($row['org9'] <> "") { ?>
                        <tr>
                            <td align="center">9.</td>
                            <td><?php echo $row['org9']; ?> </td>
                            <td><?php echo $row['pos9']; ?> </td>
                            <td><?php echo $row['from9']; ?> </td>
                            <td><?php echo $row['to9']; ?> </td>
                            <td><?php echo $row['nature9']; ?> </td>
                            <td><?php echo $row['pay9']; ?> </td>
                            <td><?php echo $row['otype9']; ?> </td>
                        </tr>
                    <?php } ?>
                    <?php if ($row['org10'] <> "") { ?>
                        <tr>
                            <td align="center">10.</td>
                            <td><?php echo $row['org10']; ?> </td>
                            <td><?php echo $row['pos10']; ?> </td>
                            <td><?php echo $row['from10']; ?> </td>
                            <td><?php echo $row['to10']; ?> </td>
                            <td><?php echo $row['nature10']; ?> </td>
                            <td><?php echo $row['pay10']; ?> </td>
                            <td><?php echo $row['otype10']; ?> </td>
                        </tr>
                    <?php } ?>

                </table>

                <br />


                <table class="form" width="100%" border="1">

                    <tr>
                        <td width="3%" align="center">
                            <font color="#000080"> <b>4.</b></font>
                        </td>
                        <td colspan="4">Wheather you worked on any Government Project? : <?php echo $row['police']; ?></td>
                    </tr>

                    <tr>
                        <td align="center">
                            <font color="#000080"> <b>5.</b></font>
                        </td>
                        <td colspan="4">Two References (Not related to you) (Give Name, Contact address, Contact No. and Email id) :</td>
                    </tr>
                    <tr>
                        <td align="center"></td>
                        <td colspan="4">Reference 1 : <?php echo $row['ref1']; ?></td>
                    </tr>
                    <tr>
                        <td align="center"></td>
                        <td colspan="4">Reference 2 : <?php echo $row['ref2']; ?></td>
                    </tr>
                    <tr>
                        <td align="center">
                            <font color="#000080"> <b>6.</b></font>
                        </td>
                        <td colspan="4">
                            <p><strong>List of Attachments: </strong> (Please tick mark against attached documents) Self attested photo copies of certificates/testimonials in proof of</p>
                        </td>
                    </tr>

                    <tr>
                        <td align="center"></td>
                        <td width="70%">(1) Qualification</td>
                        <td width="10%">Yes</td>
                        <td width="10%">No</td>
                        <td width="10%">
                            <?php if ($row['qual'] != '') { ?>
                                <a target="_blank" href="<?php echo $row['qual']; ?>">View</a>
                            <?php } ?>
                        </td>
                    </tr>

                    <tr>
                        <td align="center"></td>
                        <td width="80%">(2) Experience</td>
                        <td width="10%">Yes</td>
                        <td width="10%">No</td>
                        <td width="10%">
                            <?php if ($row['expr'] != '') { ?>
                                <a target="_blank" href="<?php echo $row['expr']; ?>">View</a>
                            <?php } ?>
                        </td>
                    </tr>

                    <tr>
                        <td align="center"></td>
                        <td width="80%">(3) Caste Certificate</td>
                        <td width="10%">Yes</td>
                        <td width="10%">No</td>
                        <td width="10%">
                            <?php if ($row['castecerti'] != '') { ?>
                                <a target="_blank" href="<?php echo $row['castecerti']; ?>">View</a>
                            <?php } ?>
                        </td>
                    </tr>

                    <tr>
                        <td align="center"></td>
                        <td width="80%">(4) NOC from current Organization</td>
                        <td width="10%">Yes</td>
                        <td width="10%">No</td>
                        <td width="10%">
                            <?php if ($row['noc'] != '') { ?>
                                <a target="_blank" href="<?php echo $row['noc']; ?>">View</a>
                            <?php } ?>
                        </td>
                    </tr>

                    <tr>
                        <td align="center"></td>
                        <td>(5) Any other document[s]</td>
                        <td>Yes</td>
                        <td>No</td>
                        <td width="10%">
                            <?php if ($row['othrdoc'] != '') { ?>
                                <a target="_blank" href="<?php echo $row['othrdoc']; ?>">View</a>
                            <?php } ?>
                        </td>
                    </tr>


                    <tr>
                        <td align="center"></td>
                        <td>(5) Any other document[s]</td>
                        <td>Yes</td>
                        <td>No</td>
                        <td width="10%">
                            <?php if ($row['othrdoc'] != '') { ?>
                                <a target="_blank" href="<?php echo $row['othrdoc']; ?>">View</a>
                            <?php } ?>
                        </td>
                    </tr>

                    <tr>
                        <td align="center"></td>
                        <td colspan="4"><strong>Note:</strong> Incomplete and/or errorneous application are likely to be summarily rejected. If any query is not applicable to you, please write NA against it.</td>
                    </tr>

                    <tr>
                        <td align="center" valign="top">
                            <font color="#000080"> <b>7.</b></font>
                        </td>
                        <td colspan="4">
                            <p align="justify"><strong>Declaration:</strong> I hereby certify that the foregoing information is correct to the best of my knowledge and belief. I have not suppressed any material fact or factual information in the
                                above statement. In case I have given wrong information or suppressed
                                any material fact or factual information, then my services are liable to be terminated without giving any notice or reasons thereof.
                                I am not aware of any circumstances which might impair my fitness for employment under M/s. Viswambi Security Agency Pvt. Ltd.
                        </td>
                    </tr>
                    <tr>

                        <td align="left"></td>
                        <td colspan="5">Date : <?php echo $row['regdate']; ?></td>

                    </tr>
                    <tr align="right">
                        <td align="right"></td>
                        <td align="right" colspan="4">
                            <div align="right"> Signature of Applicant : <img src='<?php echo $row['sign']; ?> ' height="59" width="155" /></div>
                        </td>
                    </tr>


                    <!-- <tr>
                                                                                                    <td align="left" colspan="5">The candidate should send their application in an envelope super scribing clearly "APPLICATION FOR THE POST OF <strong><U><?php echo $post_name; ?></U></strong>" with all above relevant enclosures and this must reach the following address on or before <strong><u><?php echo $closing_date; ?>.</u></strong>"</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td align="left" colspan="5"><p><strong>Administrative Officer (PA&F) <br/>
                                                                                                                INFLIBNET Centre, <br/>
                                                                                                                POST BOX NO. 4, Infocity Area, Gandhinagar - 382007, <br/>Gujarat, INDIA.        
                                                                                                            </strong></p></td>
                                                                                                </tr>-->

                </table>
                </br></br>
                <center>
                    <a href="#" style="width:10%" id="print_btn" class="btn btn-primary" onclick="window.print()">Print</a>
                </center>
    </form>


<?php } ?>


</body>

</html>

<?php //session_destroy(); 
?>