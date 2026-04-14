<?php
error_reporting(0);
session_start();
if ($_SESSION['is_login'] != 'true') {
    header("Location: Admin_login.php");
    exit();
}
?>
<?php include '../admin_header.php'; ?>
<script type="text/javascript" src="../js/Ajaxfileupload-jquery-1.3.2.js" ></script>
<script type="text/javascript" language="javascript" src="../js/validate.js"></script>
<script type="text/javascript" language="javascript" src="../js/script.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous"></link>
<link rel="stylesheet" href="../css/jquery-ui.css"></link>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script src="../dtpicker/jquery-1.10.2.js"></script>
<script src="../dtpicker/jquery-ui.js"></script>
<script src="../js/jquery.dataTables.js"></script>   
<script src="../js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"></link>
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
<div class="container mb-80" style="padding-top: 10px;">   
    <a href="../Admin_Home.php" class="btn btn-primary pull-right mb30">Back to Home</a>          
    <form id="" action="" method="post">
        <div class="row">
            <div class="col-md-3">
                <label for="year"> Year</label>
                <select name="year" id="year" class="form-control" required>
                    <option value=""></option>
                    <?php
                    $latest_year = date('Y');
                    $earliest_year = 2021;
                    foreach (range($latest_year, $earliest_year) as $i) {
                        ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="year"> Sequence</label>
                <select name="sequence" id="sequence" class="form-control" required>
                    <option value=""></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>
            <div class="col-md-3" style="margin-top: 25px">
                <input type="submit" name="brn_submit" id="btn-submit" class="btn btn-primary" />
            </div>
        </div>
    </form>
    <table id="example" class="table table-striped table-bordered" style="width:100%;" >
        <thead>
            <tr>
                <th style="text-align: center;">Date</th>
                <?php
                $year = $_POST['year'];
                $seq = $_POST['sequence'];
                $td_cnt = 0;
                $post_sql = "SELECT post,date(open_date_admin) as open_date_admin,date(closed_date_admin) as closed_date_admin FROM `req_experience` WHERE `year`='$year' and `sequence`='$seq'";
                $post_result = mysqli_query($link, $post_sql);
                while ($post_row = mysqli_fetch_assoc($post_result)) {
                    $start_date = $post_row['open_date_admin'];
                    $end_date = $post_row['closed_date_admin'];
                    $td_cnt = $td_cnt + 1;
                    ?>
                    <th style="text-align: center;"><?php echo $post_row['post']; ?></th>
                    <?php } ?>
                <th>Count</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <td>Totals</td>
                <?php
                for ($i = 0; $i < $td_cnt; $i++) {
                    ?>
                    <td></td>
                <?php } ?>


                <td></td>
            </tr>
        </tfoot>
        <tbody>
            <?php
            //$start_date = strtotime('2021-02-27 00:00:00');
            //$end_date = strtotime('2021-03-21 17:30:00');
            $data_array = array();
            $sdls = 0;
            $scls = 0;
            $sbls = 0;
            $stocs = 0;
            $saoaadmin = 0;
            $psadmin = 0;
            $total_cnt = 0;
            for ($i = $start_date; $i <= $end_date; $i = date('Y-m-d', strtotime($i . ' +1 day'))) {
                //$thisDate = date('d/m/Y', $i);
                //$thisDate = date('Y-m-d', trim($i));
                $thisDate = date("d/m/Y", strtotime($i));

                //echo $i .'----';
                //echo $newDate; exit;
                $post_sql = "SELECT post FROM `req_experience` WHERE `year`='$year' and `sequence`='$seq'";
                $post_result = mysqli_query($link, $post_sql);
                $day_total = 0;
                ?><tr><td><?php echo $i; ?></td><?php
                    while ($post_row = mysqli_fetch_assoc($post_result)) {
                        $post = $post_row['post'];
                        $sql = "SELECT COUNT(prsnl.id) as cnt FROM prsnl JOIN othrs as o ON o.id=prsnl.id WHERE prsnl.post LIKE '$post' AND o.submit = 'Yes' AND prsnl.status = 'current' AND o.submission_date Like '%$thisDate%'";

                        $res = mysqli_query($link, $sql);
                        while ($row = mysqli_fetch_assoc($res)) {
                            $cnt = $row['cnt'];
                            $day_total = $day_total + $cnt;
                        }
                        ?>
                        <td><?php echo $cnt; ?></td>
                    <?php }
                    ?><td><?php echo $day_total; ?></td></tr> 



            <?php } ?>

        </tbody>
    </table>
</div>
<?php include '../footer.php'; ?>
</body>
</html>
<script>
    $(document).ready(function () {
        $('#example').DataTable({
            "ordering": false,
            "pageLength": 500,
            "footerCallback": function (row, data, start, end, display) {
                var api = this.api();
                nb_cols = api.columns().nodes().length;
                var j = 1;
                while (j < nb_cols) {
                    var pageTotal = api
                            .column(j, {page: 'current'})
                            .data()
                            .reduce(function (a, b) {
                                return Number(a) + Number(b);
                            }, 0);
                    // Update footer
                    $(api.column(j).footer()).html(pageTotal);
                    j++;
                }
            }

        });
    });
</script>