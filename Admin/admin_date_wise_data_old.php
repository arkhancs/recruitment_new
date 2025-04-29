<?php
error_reporting(0);
include "dbConfig.php";
session_start();
if ($_SESSION['is_login'] != 'true') {
    header("Location: Admin_login.php");
    exit();
}
?>

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"></meta>
        <title>HR Recruitment </title>
        <script type="text/javascript" src="js/Ajaxfileupload-jquery-1.3.2.js" ></script>
        <script type="text/javascript" language="javascript" src="js/validate.js"></script>
        <script type="text/javascript" language="javascript" src="js/script.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous"></link>
        <link rel="stylesheet" href="css/jquery-ui.css"></link>
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script src="dtpicker/jquery-1.10.2.js"></script>
        <script src="dtpicker/jquery-ui.js"></script>
        <script src="js/jquery.dataTables.js"></script>   
        <script src="js/jquery.dataTables.min.js"></script>

        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"></link>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"></link>
        <link rel="stylesheet" type="text/css"  href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap.min.css"></link>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <link href="../css/custom.css" rel="stylesheet"></link>
    </head>
    <body>
        <?php include '../admin_header.php'; ?>
        <div class="container" style="padding-top: 10px;">
            <div class="pull-right">
                <?php if ($_SESSION['is_login'] == 'true') { ?>
                    <b>     
                        <h4 style="color:#337ab7; display: inline-block;" >Welcome <?php echo $_SESSION['user'] . ","; ?></h4>
                        <a  href="Admin_logout.php" style="display:inline-block"><i class="fas fa-power-off"  style="color: red;font-size:20px;"></i></a>
                    </b>
                <?php } ?>
            </div>
            <a href="Admin_Home.php" class="btn btn-primary pull-left">Back to Home</a>          
            <br/></br><br/>
            <div class="container">
                <table id="example" class="table table-striped table-bordered" style="width:100%;" >
                    <thead>
                        <tr>
                            <th style="text-align: center;">Date</th>
                            <?php
                            $post_sql = 'SELECT * FROM `req_experience` WHERE `year` LIKE "2021"';
                            $post_result = mysqli_query($link, $post_sql);
                            while ($post_row = mysqli_fetch_assoc($post_result)) {
                                ?>
                                <th style="text-align: center;"><?php echo $post_row['post']; ?></th>
                                <?php } ?>
                            <th>Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $start_date = strtotime('2021-02-27 00:00:00');
                        $end_date = strtotime('2021-03-21 17:00:00');
                        $data_array = array();
                        $sdls = 0;
                        $scls = 0;
                        $sbls = 0;
                        $stocs = 0;
                        $saoaadmin = 0;
                        $psadmin = 0;
                        $total_cnt = 0;
                        for ($i = $start_date; $i <= $end_date; $i = $i + 86400) {
                            $j = 1;
                            $thisDate = date('d/m/Y', $i);
                            $post_sql = 'SELECT * FROM `req_experience` WHERE `year` LIKE "2021"';
                            $post_result = mysqli_query($link, $post_sql);
                            while ($post_row = mysqli_fetch_assoc($post_result)) {
                                $post = $post_row['post'];
                                $sql = "SELECT COUNT(prsnl.id) as cnt FROM prsnl JOIN othrs as o ON o.id=prsnl.id WHERE prsnl.post LIKE '$post' AND o.submit = 'Yes' AND prsnl.status = 'current' AND o.submission_date LIKE '%$thisDate%'";
                                // $sql = "select count(prsnl.id) as cnt from prsnl join othrs as o on o.id=prsnl.id where prsnl.post like '$post' and prsnl.status='current' and o.submit='Yes' and o.submission_date like '%$thisDate%'";
                                $res = mysqli_query($link, $sql);
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $cnt = $row['cnt'];
                                }
                                $data_array[$thisDate][$j] = $cnt;

                                // For post wise count
                                if ($post == 'SDLS-1-2021') {
                                    $sdls += $cnt;
                                } else if ($post == 'SCLS-1-2021') {
                                    $scls += $cnt;
                                } else if ($post == 'SBLS-1-2021') {
                                    $sbls += $cnt;
                                } else if ($post == 'STOICS-1-2021') {
                                    $stocs += $cnt;
                                } else if ($post == 'SAOAAdmin-1-2021') {
                                    $saoaadmin += $cnt;
                                } else if ($post == 'PSAdmin-1-2021') {
                                    $psadmin += $cnt;
                                }
                                $total_cnt += $cnt;
                                $j++;
                            }
                        }
                        foreach ($data_array as $key => $value) {
                            ?>
                            <tr>
                                <td><?php echo $key; ?></td>
                                <td><?php echo $value['1']; ?></td>
                                <td><?php echo $value['2']; ?></td>
                                <td><?php echo $value['3']; ?></td>
                                <td><?php echo $value['4']; ?></td>
                                <td><?php echo $value['5']; ?></td>
                                <td><?php echo $value['6']; ?></td>
                                <td><?php echo $value['1'] + $value['2'] + $value['3'] + $value['4'] + $value['5'] + $value['6'] ?></td>
                            </tr>
<?php } ?>
                        <tr>
                            <th>Count</th>
                            <td><?php echo $sdls; ?></td>
                            <td><?php echo $scls; ?></td>
                            <td><?php echo $sbls; ?></td>
                            <td><?php echo $stocs; ?></td>
                            <td><?php echo $saoaadmin; ?></td>
                            <td><?php echo $psadmin; ?></td>
                            <td><?php echo $total_cnt; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
<script>
    $(document).ready(function () {
        $('#example').DataTable({
            "ordering": false,
            "pageLength": 500
        });
    });
</script>