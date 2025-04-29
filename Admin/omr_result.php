<?php
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
<link rel="stylesheet" href="css/jquery-ui.css" />        
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
    <div class="row">
        <div class="col-md-4">
            <select class="form-control" id="post" name="post" required onchange="getApplicantData()">
                <option value="">Select Post</option>
                <?php
                if ($_SESSION['is_login'] == 'true' && $_SESSION['user'] == 'Dharmesh') {
                    $sql = "select * from req_experience where year in('2022') order by id desc";
                }
                $result = mysqli_query($link, $sql);
                if ($result) {
                    if (mysqli_num_rows($result) == 0) {
                        
                    } else {
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <?php if ($row['status'] == 'OPEN') { ?>
                                <option value="<?php echo $row['post']; ?>" data-location="<?php echo $row['job_location']; ?>" <?php echo ($row['post'] == $_POST['post']) ? 'selected' : ''; ?>><?php echo $row['Name'] . " (" . $row['post'] . ") - " . $row['year']; ?></option>                                    
                                <?php
                            }
                        }
                    }
                }
                ?>
            </select>
        </div>                
    </div>
    <br>
    <table id="example" class="table table-striped table-bordered" style="width:100%;" >
        <thead>
            <tr>
                <th class="text-center">Sr. No.</th>
                <th class="text-center">Candidate ID</th>
                <th class="text-center">Attendance</th>
                <th class="text-center">Upload OMR Sheet</th>
                <th class="text-center">View</th>                            
            </tr>
        </thead>
        <tbody id="fill_data">

        </tbody>
    </table>
</div>
<?php include '../footer.php'; ?>
</body>

<script>
    $(document).ready(function () {
        $('#fill_data').on('change', '.attendancee', function () {
            var candidate_id = $(this).attr('data-value');
            if ($(this).is(':checked')) {
                var chk_value = 'Yes';
            } else {
                var chk_value = 'No';
            }
            $.ajax({
                url: 'update_attendance.php',
                data: {
                    candidate_id: candidate_id,
                    chk_value: chk_value
                },
                dataType: 'html',
                type: 'post',
                success: function (data) {
                }
            });

            if ($(this).is(":checked")) {
                $("#isClicked").val("Yes");
                console.log($("#isClicked").val());
            } else if ($(this).is(":not(:checked)")) {
                $("#isClicked").val("");
                console.log($("#isClicked").val());
            }
        });
    });

    $(document).ready(function () {
        $('#fill_data').on('change', '.omrsheet', function () {
            var id = $(this).attr('id');
            var name = document.getElementById(id).files[0].name;
            var form_data = new FormData();
            var ext = name.split('.').pop().toLowerCase();
            if (jQuery.inArray(ext, ['pdf']) == -1)
            {
                alert("Please upload only PDF file.");
                $(".omrsheet").val("");
            }
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById(id).files[0]);
            var f = document.getElementById(id).files[0];
            var fsize = f.size || f.fileSize;

            if (fsize > 1048576)
            {
                alert("File size should be less than 1MB.");
            } else
            {
                form_data.append("file", document.getElementById(id).files[0]);
                $.ajax({
                    url: "upload_omr.php",
                    method: "POST",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function () {
                        $('#uploaded_image').html("<label class='text-success'>Image Uploading...</label>");
                    },
                    success: function (data)
                    {
                        $('#uploaded_image').html(data);
                    }
                });
            }

//                var file_name = $(this).val();                
//                var fileExtension = file_name.substr((file_name.lastIndexOf('.') + 1));
//                var extension_array = ['pdf'];
//                var err = 0;
//                if (extension_array.indexOf(fileExtension) == -1)
//                {
//                    alert("Please upload only PDF file.");
//                    $(".omrsheet").val("");
//                    err++;
//                } else {
//                    err;
//                }
//                if (Math.round(document.getElementById(id).files[0].size / 1024) > 1024)
//                {
//                    alert("File size should be less than 1MB.");
//                    $(".omrsheet").val("");
//                    err++;
//                } else {
//                    err;
//                }
//                if (err == 0) {
//                    var candidate_id = $(this).attr('data-value');
//
//                    $.ajax({
//                        url: 'upload_omr.php',
//                        data: {
//                            candidate_id: candidate_id,
//                            chk_value: chk_value
//                        },
//                        dataType: 'html',
//                        type: 'post',
//                        success: function (data) {
//                        }
//                    });
//                }
        });
    });
    function getApplicantData() {
        var post_id = $("#post").val();
        $.ajax({
            url: 'get_applicant_data.php',
            data: {
                post_id: post_id,
            },
            dataType: 'html',
            type: 'post',
            success: function (data) {
                $("#fill_data").html(data);
            }
        });
    }

</script>
</html>               