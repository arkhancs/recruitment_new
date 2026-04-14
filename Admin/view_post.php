<?php
error_reporting(0);

session_start();
if ($_SESSION['is_login'] != 'true') {
    header("Location: ../Admin_login.php");
    exit();
}

include_once '../dbConfig.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change_status'])) {
    $id = mysqli_real_escape_string($link, $_POST['id']);
    $new_status = mysqli_real_escape_string($link, $_POST['new_status']);

    $sql_update = "UPDATE req_experience SET status = '$new_status' WHERE id = $id";
    if (mysqli_query($link, $sql_update)) {
        $_SESSION['message'] = 'Status updated successfully.';
    } else {
        $_SESSION['message'] = 'Failed to update status.';
    }

    header("Location: " . $_SERVER['PHP_SELF']); // Redirect back to the same page
    exit();
}
?>
<?php include '../admin_header.php'; ?>
<script type="text/javascript" src="js/Ajaxfileupload-jquery-1.3.2.js"></script>
<script type="text/javascript" language="javascript" src="js/validate.js"></script>
<script type="text/javascript" language="javascript" src="js/script.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous" />
<link rel="stylesheet" href="css/jquery-ui.css">
</link>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="dtpicker/jquery-1.10.2.js"></script>
<script src="dtpicker/jquery-ui.js"></script>
<script src="js/jquery.dataTables.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</link>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
</link>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap.min.css" />
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
    <a href="../Admin_Home.php" class="btn btn-primary pull-right ml5">Back to Home</a>
    <a href="add_post.php" class="btn btn-primary pull-right">Add New Post</a>
</div>

<!-- Display the message if any -->
<?php if (isset($_SESSION['message'])) { ?>
    <div class="alert alert-info"><?php echo $_SESSION['message']; ?></div>
    <?php unset($_SESSION['message']); ?>
<?php } ?>

<div class="container mb-80">
    <table id="example" class="table table-striped table-bordered" style="width:100%;">
        <thead>
            <tr>
                <th>Sr. No.</th>
                <th>ID</th>
                <!--                <th>Job Type</th>-->
                <th>Name</th>
                <th>Location</th>
                <th>Project</th>
                <th>Job Category</th>
                <th>Year</th>
                <th>Caste Category</th>
                <th>Age Limit</th>
                <th>Closed Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($_SESSION['is_login'] == 'true' && $_SESSION['user'] == 'Dharmesh') {
                $sql = "SELECT * FROM req_experience ORDER BY id DESC";
            } else {
                $sql = "SELECT * FROM req_experience where year='2019' ORDER BY id DESC";
            }
            $result = mysqli_query($link, $sql);
            $key = 1;
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?php echo $key; ?></td>
                    <td><?php echo $row['post']; ?></td>
                    <td><?php echo $row['Name']; ?></td>
                    <td><?php echo $row['job_location']; ?></td>
                    <td><?php echo $row['project']; ?></td>
                    <td><?php echo $row['category']; ?></td>
                    <td><?php echo $row['year']; ?></td>
                    <td><?php echo $row['caste_category']; ?></td>
                    <td><?php echo $row['age_limit']; ?></td>
                    <td><?php echo $row['closed_date']; ?></td>
                    <td>
                        <?php if ($row['status'] == 'OPEN') { ?>
                            <button class="btn btn-success btn-sm">Open</button>
                            <form method="post" style="display:inline;" onsubmit="return confirm('Are you sure you want to close this job? This action cannot be reversed.')">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <input type="hidden" name="new_status" value="CLOSED">
                                <button type="submit" name="change_status" class="btn btn-warning btn-sm">Click to Close</button>
                            </form>
                        <?php } else { ?>
                            <button class="btn btn-danger btn-sm">Closed</button>
                        <?php } ?>
                    </td>
                    <td><a href="javascript:;" onclick="viewFun(<?php echo $row['id'] ?>)"><i class="fa fa-pen"></i></a></td>
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
<form id="frm" method="post" action="add_post.php"><input type="hidden" name="id" id="ids" value="" /><button type="submit" style="display: none;"></button></form>
<script>
    function viewFun(id) {
        $("#ids").val(id);
        $('#frm').submit();
    }
</script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>