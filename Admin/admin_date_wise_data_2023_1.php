<?php
error_reporting(0);

session_start();
if ($_SESSION['is_login'] != 'true') {
    header("Location: Admin_login.php");
    exit();
}
?>
<?php include '../admin_header.php'; ?>
<script type="text/javascript" src="../js/Ajaxfileupload-jquery-1.3.2.js"></script>
<script type="text/javascript" language="javascript" src="../js/validate.js"></script>
<script type="text/javascript" language="javascript" src="../js/script.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</link>
<link rel="stylesheet" href="../css/jquery-ui.css">
</link>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script src="../dtpicker/jquery-1.10.2.js"></script>
<script src="../dtpicker/jquery-ui.js"></script>
<script src="../js/jquery.dataTables.js"></script>
<script src="../js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
</link>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
</link>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap.min.css">
</link>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<link href="../css/custom.css" rel="stylesheet">
</link>
<div class="container mb30" style="padding-top: 10px;">
    <h3>Statistics 2-2023 Post <span><a href="../Admin_Home.php" class="btn btn-primary pull-right">Back to Home</a><a href="admin_date_wise_data_2023.php" class="btn btn-primary pull-right mr5">Statistics 1-2023</a></span></h3>

</div>
<div class="container mb-80">
    <table id="example" class="table table-striped table-bordered" style="width:100%;">
        <thead>
            <tr>
                <th style="text-align: center;">Date</th>
                <?php
                $post_sql = 'SELECT post FROM `req_experience` WHERE `year` LIKE "2023" and `post` LIKE "%2-2023"';
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
            $start_date = strtotime('2023-09-30 00:00:00');
            $end_date = strtotime('2023-10-20 18:00:00');
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

                $post_sql = 'SELECT post FROM `req_experience` WHERE `year` LIKE "2023" and `post` LIKE "%2-2023"';
                $post_result = mysqli_query($link, $post_sql);

                while ($post_row = mysqli_fetch_assoc($post_result)) {
                    $post = $post_row['post'];

                    $sql = "SELECT COUNT(prsnl.id) as cnt FROM prsnl JOIN othrs as o ON o.id=prsnl.id WHERE prsnl.post LIKE '$post' AND o.submit = 'Yes' AND prsnl.status = 'current' AND o.submission_date LIKE '%$thisDate%'";
                    $res = mysqli_query($link, $sql);
                    while ($row = mysqli_fetch_assoc($res)) {
                        $cnt = $row['cnt'];
                    }
                    $data_array[$thisDate][$j] = $cnt;

                    // For post wise count
                    if ($post == 'PSAdmin-2-2023') {
                        $psadmin += $cnt;
                    } else if ($post == 'CCTAdmin-1-2025') {
                        $ccta += $cnt;
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
                    <td><?php echo $value['1'] + $value['2'] ?></td>
                </tr>
            <?php } ?>
            <tr>
                <th>Count</th>
                <td><?php echo $psadmin; ?></td>
                <td><?php echo $ccta; ?></td>
                <td><?php echo $total_cnt; ?></td>
            </tr>
        </tbody>
    </table>
</div>

<?php include '../footer.php'; ?>
</body>

</html>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "ordering": false,
            "pageLength": 500
        });
    });
</script>