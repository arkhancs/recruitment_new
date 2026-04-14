<?php
error_reporting(0);

session_start();
if ($_SESSION['is_login'] != 'true') {
    header("Location: ../Admin_login.php");
    exit();
}
?>

<?php include '../admin_header.php'; ?>
<script type="text/javascript" src="js/Ajaxfileupload-jquery-1.3.2.js" ></script>
<script type="text/javascript" language="javascript" src="js/validate.js"></script>
<script type="text/javascript" language="javascript" src="js/script.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous" />
<link rel="stylesheet" href="css/jquery-ui.css"></link>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="dtpicker/jquery-1.10.2.js"></script>
<script src="dtpicker/jquery-ui.js"></script>
<script src="js/jquery.dataTables.js"></script>   
<script src="js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"></link>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"></link>
<link rel="stylesheet"    type = "text/css"  href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap.min.css" />
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<link href="../css/custom.css" rel="stylesheet"></link>
<div class="container mb30" style="padding-top: 10px;">   
    <a href="../Admin_Home.php" class="btn btn-primary pull-right">Back to Home</a>
</div>
<div class="container mb-80">
    <table id="example" class="table table-striped table-bordered" style="width:100%;" >
        <thead>
            <tr>
                <th>Sr. No.</th>
                <th>Post Name</th>
                <th>Year</th>
                <th>Total Application</th>
                <th>Hard Copy Received</th>
                <th>Eligible</th>
                <th>Not Eligible</th>
                <th>Pro Eligible</th>
                <th>Admit Card</th>
            </tr>
        </thead>
        <tbody>
            <?php
          
            if ($_SESSION['is_login'] == 'true' && $_SESSION['user'] == 'dharmesh') {
                //$sql = "SELECT re.name, re.category, re.job_location, re.project, re.post,re.year, count(p.id) as count from prsnl p right join req_experience re on re.post = p.post and re.job_location = p.job_location and p.status = 'current' group by re.id order by re.id desc";
                $sql = "SELECT re.name, re.category, re.project, re.post,re.year, count(p.id) as total_post, count(o.id) as h_copy, count(ot.download_admitcard) as d_count
                                            FROM req_experience re  
                                            LEFT JOIN prsnl p on re.post = p.post and p.status = 'current' 
                                            LEFT JOIN othrs  o ON o.id = p.id  and  hard_copy_received = 'Yes'  
                                            LEFT JOIN othrs ot ON ot.id = p.id  
                                            GROUP BY re.name, re.category, re.project, re.post,re.year
                                            ORDER BY re.id desc";
            } else {
                //$sql = "SELECT re.name, re.category, re.job_location, re.project, re.post,re.year, count(p.id) as count from prsnl p right join req_experience re on re.post = p.post and re.job_location = p.job_location and p.status = 'current' WHERE re.year='2019' group by re.id order by re.id desc";
                //$sql = "SELECT re.name, re.category, re.project, re.post,re.year, count(p.id) as count from prsnl p right join req_experience re on re.post = p.post and p.status = 'current' WHERE re.year in ('2020','2019') group by re.id order by re.id desc";
                $sql = "SELECT re.name, re.category, re.project, re.post,re.year, count(p.id) as total_post, count(o.id) as h_copy, count(ot.download_admitcard) as d_count
                                            FROM req_experience re  
                                            LEFT JOIN prsnl p on re.post = p.post and p.status = 'current' 
                                            LEFT JOIN othrs o ON o.id = p.id and hard_copy_received = 'Yes'
                                            LEFT JOIN othrs ot ON ot.id = p.id                                            
                                            GROUP BY re.name, re.category, re.project, re.post,re.year
                                            ORDER BY re.id desc";
            }

            $result = mysqli_query($link, $sql);
            $key = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                $p = $row['post'];
                $sql_el = "select count(status_check) as el_count from prsnl where status_check='Eligible' and status='current' and post='$p'";
                $result_el = mysqli_query($link, $sql_el);
                while ($row_el = mysqli_fetch_assoc($result_el)) {
                    $el = $row_el['el_count'];
                }

                $sql_nel = "select count(status_check) as nel_count from prsnl where status_check='NotEligible' and status='current' and post='$p'";
                $result_nel = mysqli_query($link, $sql_nel);
                while ($row_nel = mysqli_fetch_assoc($result_nel)) {
                    $nel = $row_nel['nel_count'];
                }

                $sql_pel = "select count(status_check) as pel_count from prsnl where status_check='Provisionally' and status='current' and post='$p'";
                $result_pel = mysqli_query($link, $sql_pel);
                while ($row_pel = mysqli_fetch_assoc($result_pel)) {
                    $pel = $row_pel['pel_count'];
                }
                ?>                                  
                <tr>
                    <td><?php echo $key; ?></td>
                    <td><?php echo $row['name'] . ' (' . $row['category'] . ') (' . $row['post'] . ')'; ?></td>
                    <td><?php echo $row['year']; ?></td>
                    <td><a href="javascript:;" onclick="viewFun('<?php echo $row['post'] ?>')"><?php echo $row['total_post']; ?></a></td>
                    <td><a href="javascript:;" onclick="viewFun1('<?php echo $row['post'] ?>')"><?php echo $row['h_copy']; ?></a></td>
                    <td><a href="javascript:;" onclick="viewFun2('<?php echo $row['post'] ?>')"><?php echo $el; ?></a></td>
                    <td><a href="javascript:;" onclick="viewFun3('<?php echo $row['post'] ?>')"><?php echo $nel; ?></a></td>
                    <td><a href="javascript:;" onclick="viewFun4('<?php echo $row['post'] ?>')"><?php echo $pel; ?></a></td>
                    <td><?php echo $row['d_count']; ?></td>
                </tr>
                <?php
                $key++;
            }
            ?>
        </tbody>
    </table>
</div>
<?php include '../footer.php'; ?>
</body> 
</html>
<form id="frm" method="post" action="../Admin_Home.php"><input type="hidden" name="post" id="ids" value="" /><button type="submit" style="display: none;"></button></form>
<form id="frm1" method="post" action="../Admin_Home.php"><input type="hidden" name="post" id="ids1" value="" /><input type="hidden" name="hard_copy_received" value="Yes" /><button type="submit" style="display: none;"></button></form>
<form id="frm2" method="post" action="../Admin_Home.php"><input type="hidden" name="post" id="ids2" value="" /><input type="hidden" name="status_check" value="Eligible" /><button type="submit" style="display: none;"></button></form>
<form id="frm3" method="post" action="../Admin_Home.php"><input type="hidden" name="post" id="ids3" value="" /><input type="hidden" name="status_check" value="NotEligible" /><button type="submit" style="display: none;"></button></form>
<form id="frm4" method="post" action="../Admin_Home.php"><input type="hidden" name="post" id="ids4" value="" /><input type="hidden" name="status_check" value="Provisionally" /><button type="submit" style="display: none;"></button></form>
<script>
    function viewFun(post) {
        $("#ids").val(post);
        $('#frm').submit();
    }
    function viewFun1(post) {
        $("#ids1").val(post);
        $('#frm1').submit();
    }
    function viewFun2(post) {
        $("#ids2").val(post);
        $('#frm2').submit();
    }
    function viewFun3(post) {
        $("#ids3").val(post);
        $('#frm3').submit();
    }
    function viewFun4(post) {
        $("#ids4").val(post);
        $('#frm4').submit();
    }
</script>
<script>
    $(document).ready(function () {
        $('#example').DataTable();
    });
</script>