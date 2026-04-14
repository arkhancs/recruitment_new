<?php
session_start();
error_reporting(0);
if ($_SESSION['is_login'] != 'true') {
  header("Location: ../Admin_login.php");
  exit();
}
?>
<?php include '../admin_header.php'; ?>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" language="javascript" src="js/validate.js"></script>
<link rel="stylesheet" href="../css/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.js"></script>
<link href="../css/custom.css" rel="stylesheet">
</head>

<body>

  <div class="container mb30" style="padding-top: 10px;">
    <a href="../Admin_Home.php" class="btn btn-primary pull-right ml5">Back to Home</a>
    <a href="view_post.php" class="btn btn-primary pull-right">View Post</a>
  </div>
  <div class="container">
    <div class="row mb-80">
      <div class="col-sm-12 col-md-12">
        <?php
        session_start();
        error_reporting(0);
        if ($_SESSION['is_login'] != 'true') {
          header("Location: ../Admin_login.php");
          exit();
        }
        print_r($_SESSION['errors'][0]);
        unset($_SESSION['errors']);
        ?>
        <?php
        $id = $_POST['id'];
        $sql = "SELECT * FROM req_experience where id=$id";
        $result = mysqli_query($link, $sql);
        while ($row = mysqli_fetch_array($result)) {
          $id = $row['id'];
          $job_type = $row['job_type'];
          $Name = $row['Name'];
          $job_location = $row['job_location'];
          $project = $row['project'];
          $post_id = $row['post_id'];
          $category = $row['category'];
          $year = $row['year'];
          $sequence = $row['sequence'];
          $status = $row['status'];
          $post = $row['post'];
          $caste_category = $row['caste_category'];
          $bachelor_req = $row['bachelor_req'];
          $experience_for_bachelor = $row['experience_for_bachelor'];
          $experience_for_master = $row['experience_for_master'];
          $experience_for_phd = $row['experience_for_phd'];
          $master_req = $row['master_req'];
          $phd_req = $row['phd_req'];
          $closed_date = $row['closed_date'];
          $open_date = $row['open_date'];  // Add this line to fetch open_date from database
          $age_limit = $row['age_limit'];
          $advertisement_title = $row['advertisement_title'];
          $advertisement_url = $row['advertisement_url'];
        }
        ?>
        <form data-toggle="validator" role="form" method="post" action="add_post_action.php" id="post_form">
          <input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>"></input>
          <div class="col-md-4">
            <div class="form-group">
              <label for="inputtype" class="control-label">Job Type: <span class="red-text">*</span></label>
              <select name="job_type" id="job_type" class="form-control">
                <option value="NA">Select Job Location</option>
                <option value="Permanent" <?php echo ($job_type == "Permanent") ? 'selected' : ''; ?>>Permanent</option>
                <option value="Contractual" <?php echo ($job_type == "Contractual") ? 'selected' : ''; ?>>Contractual</option>
              </select>
              <span id='job_type_err' style="color: red" class="err_msg"></span>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="inputName" class="control-label">Post name: <span class="red-text">*</span></label>
              <input type="text" class="form-control" name="post_name" id="post_name" value="<?php echo isset($Name) ? $Name : ''; ?>"></input>
              <span id='name_err' style="color: red" class="err_msg"></span>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="location" class="control-label">Job Location:</label>
              <select name="job_location" id="job_location" class="form-control">
                <option value="NA">Select Job Location</option>
                <option value="UGC, New Delhi" <?php echo ($job_location == "UGC, New Delhi") ? 'selected' : ''; ?>>UGC, New Delhi</option>
                <option value="INFLIBNET, Gandhinagar" <?php echo ($job_location == "INFLIBNET, Gandhinagar") ? 'selected' : ''; ?>>INFLIBNET, Gandhinagar</option>
              </select>
              <span id='location_err' style="color: red" class="err_msg"></span>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="project" class="control-label">Project Name: </label>
              <input type="text" class="form-control" name="project" id="project" value="<?php echo isset($project) ? $project : ''; ?>"></input>
              <span id='project_err' style="color: red" class="err_msg"></span>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label for="postid" class="control-label">Post ID: <span class="red-text">*</span></label>
              <input type="text" class="form-control" name="postid" id="postid" value="<?php echo isset($post_id) ? $post_id : ''; ?>"></input>
              <span id='postid_err' style="color: red" class="err_msg"></span>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="category" class="control-label">Category:</label>
              <select name="category" id="category" class="form-control">
                <option value="NA">Select Category</option>
                <option value="CS" <?php echo ($category == "CS") ? 'selected' : ''; ?>>CS</option>
                <option value="LS" <?php echo ($category == "LS") ? 'selected' : ''; ?>>LS</option>
                <option value="Admin" <?php echo ($category == "Admin") ? 'selected' : ''; ?>>Admin</option>
                <option value="" <?php
                                  if (isset($category)) {
                                    echo ($category == "") ? 'selected' : '';
                                  }
                                  ?>>Non</option>
              </select>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="year" class="control-label">Year: <span class="red-text">*</span></label>
              <input type="text" class="form-control" name="year" id="year" value="<?php echo isset($year) ? $year : ''; ?>"></input>
              <span id='year_err' style="color: red" class="err_msg"></span>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label for="sequance" class="control-label">Sequence: <span class="red-text">*</span></label>
              <input type="text" class="form-control" name="sequence" id="sequence" value="<?php echo isset($sequence) ? $sequence : ''; ?>"></input>
              <span id='sequence_err' style="color: red" class="err_msg"></span>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="category" class="control-label">Status: <span class="red-text">*</span></label>
              <select name="status" id="status" class="form-control">
                <option value="NA">Select Status</option>
                <option value="OPEN" <?php echo ($status == "OPEN") ? 'selected' : ''; ?>>Open</option>
                <option value="CLOSED" <?php echo ($status == "CLOSED") ? 'selected' : ''; ?>>Closed</option>
              </select>
              <span id='status_err' style="color: red" class="err_msg"></span>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="post" class="control-label">Post:</label>
              <input type="text" class="form-control" name="post" id="post" readonly value="<?php echo isset($post) ? $post : ''; ?>"></input>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="agelimit" class="control-label">Age Limit:</label>
              <input type="text" class="form-control" name="age_limit" id="age_limit" value="<?php echo isset($age_limit) ? $age_limit : ''; ?>"></input>
              <span id='age_err' style="color: red" class="err_msg"></span>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label for="open_date" class="control-label">Open Date: <span class="red-text">*</span></label>
              <input type="text" class="form-control" name="open_date" id="open_date" value="<?php echo isset($open_date) ? $open_date : ''; ?>">
              <span id='odate_err' style="color: red" class="err_msg"></span>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label for="closed_date" class="control-label">Closed Date: <span class="red-text">*</span></label>
              <input type="text" class="form-control" name="closed_date" id="closed_date" value="<?php echo isset($closed_date) ? $closed_date : ''; ?>">
              <span id='cdate_err' style="color: red" class="err_msg"></span>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="advertisement_title" class="control-label">Advertisement Title: <span class="red-text">*</span></label>
              <input type="text" class="form-control" name="advertisement_title" id="advertisement_title" value="<?php echo isset($advertisement_title) ? $advertisement_title : ''; ?>">
              <span id='advertisement_title_err' style="color: red" class="err_msg"></span>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="advertisement_url" class="control-label">Advertisement URL: <span class="red-text">*</span></label>
              <input type="text" class="form-control" name="advertisement_url" id="advertisement_url" value="<?php echo isset($advertisement_url) ? $advertisement_url : ''; ?>">
              <span id='advertisement_url_err' style="color: red" class="err_msg"></span>
            </div>
          </div>


          <div class="clearfix"></div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="caste" class="control-label">Caste: <span class="red-text">*</span></label>
              <select name="caste" id="caste" class="form-control">
                <option value="NA">Select Caste</option>
                <option value="All" <?php echo ($caste_category == "All") ? 'selected' : ''; ?>>General(All)</option>
                <option value="OBC" <?php echo ($caste_category == "OBC") ? 'selected' : ''; ?>>OBC</option>
              </select>
              <span id='caste_err' style="color: red" class="err_msg"></span>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="brequired" class="control-label">Bachelor Degree Required: <span class="red-text">*</span></label>
              <select name="brequired" id="brequired" class="form-control">
                <option value="NA">Select Option</option>
                <option value="Y" <?php echo ($bachelor_req == "Y") ? 'selected' : ''; ?>>Yes</option>
                <option value="N" <?php echo ($bachelor_req == "N") ? 'selected' : ''; ?>>No</option>
              </select>
              <span id='bd_err' style="color: red" class="err_msg"></span>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="mrequired" class="control-label">Master Degree Required:</label>
              <select name="mrequired" id="mrequired" class="form-control">
                <option value="NA">Select Option</option>
                <option value="Y" <?php echo ($master_req == "Y") ? 'selected' : ''; ?>>Yes</option>
                <option value="N" <?php echo ($master_req == "N") ? 'selected' : ''; ?>>No</option>
              </select>
              <span id='md_err' style="color: red" class="err_msg"></span>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="prequired" class="control-label">Ph.D. Degree Required:</label>
              <select name="prequired" id="prequired" class="form-control">
                <option value="NA">Select Option</option>
                <option value="Y" <?php echo ($phd_req == "Y") ? 'selected' : ''; ?>>Yes</option>
                <option value="N" <?php echo ($phd_req == "N") ? 'selected' : ''; ?>>No</option>
              </select>
              <span id='phd_err' style="color: red" class="err_msg"></span>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="experience_for_bachelor" class="control-label">Total Experiance For Bachelor:</label>
              <input type="text" class="form-control" name="experience_for_bachelor" id="experience_for_bachelor" value="<?php echo isset($experience_for_bachelor) ? $experience_for_bachelor : ''; ?>"></input>
              <span id='experience_for_bachelor_err' style="color: red" class="err_msg"></span>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="experience_for_master" class="control-label">Total Experiance For Master:</label>
              <input type="text" class="form-control" name="experience_for_master" id="experience_for_master" value="<?php echo isset($experience_for_master) ? $experience_for_master : ''; ?>"></input>
              <span id='experience_for_master_err' style="color: red" class="err_msg"></span>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="experience_for_phd" class="control-label">Total Experiance For PHD/Other:</label>
              <input type="text" class="form-control" name="experience_for_phd" id="experience_for_phd" value="<?php echo isset($experience_for_phd) ? $experience_for_phd : ''; ?>"></input>
              <span id='experience_for_phd_err' style="color: red" class="err_msg"></span>
            </div>
          </div>
          <!--   <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="total_exp" class="control-label">Total Experiance:</label>
                                                                <input type="text" class="form-control" name="experiance" id="experiance" value="<?php echo isset($total_expr) ? $total_expr : ''; ?>"></input>
                                                                <span id='expr_err' style="color: red" class="err_msg"></span>
                                                            </div>
                                                        </div>-->
          <div class="col-md-4"></div>
          <div class="col-md-4">
            <div class="form-group">
              <button type="submit" name="submit" id="submit" class="btn btn-block login-btn">Submit</button>
            </div>
          </div>
          <div class="col-md-4"></div>
        </form>
      </div>
    </div>
  </div>
  <?php include '../footer.php'; ?>
</body>

</html>
<script type="text/javascript">
  $('#open_date').datetimepicker({
    dateFormat: "dd/mm/yy",
    timeFormat: "HH:mm:ss"
  });

  $('#closed_date').datetimepicker({
    dateFormat: "dd/mm/yy",
    timeFormat: "HH:mm:ss"
  });

  $(document).on('submit', '#post_form', function(event) {

    var err = false;
    var job_type = $("#job_type").val();
    var post_name = $("#post_name").val();
    var job_location = $("#job_location").val();
    var postid = $("#postid").val();
    var year = $("#year").val();
    var sequence = $("#sequence").val();
    var status = $("#status").val();
    var brequired = $("#brequired").val();
    var mrequired = $("#mrequired").val();
    var prequired = $("#prequired").val();
    var closed_date = $("#closed_date").val();
    var open_date = $("#open_date").val();
    var advertisement_title = $("#advertisement_title").val();
    var advertisement_url = $("#advertisement_url").val();
    var expr = $("#experiance").val();
    var age = $("#age_limit").val();
    var caste = $("#caste").val();

    if (job_type == 'NA') {
      $('#job_type_err').html('Please Select Job Type.');
      err = true;
    } else {
      $('#job_type_err').html('');
    }

    if (post_name == '') {
      $('#name_err').html('Please Enter Post Name.');
      err = true;
    } else {
      $('#name_err').html('');
    }

    if (job_location == 'NA') {
      $('#location_err').html('Please Select Job Location.');
      err = true;
    } else {
      $('#location_err').html('');
    }

    if (postid == '') {
      $('#postid_err').html('Please Enter Post ID.');
      err = true;
    } else {
      $('#postid_err').html('');
    }

    if (year == '') {
      $('#year_err').html('Please Enter Year.');
      err = true;
    } else {
      $('#year_err').html('');
    }

    if (sequence == '') {
      $('#sequence_err').html('Please Enter Sequence.');
      err = true;
    } else {
      $('#sequence_err').html('');
    }

    if (status == 'NA') {
      $('#status_err').html('Please Select Job Status.');
      err = true;
    } else {
      $('#status_err').html('');
    }

    if (brequired == 'NA') {
      $('#bd_err').html('Please Select Bachelor Degree Required or Not.');
      err = true;
    } else {
      $('#bd_err').html('');
    }

    if (mrequired == 'NA') {
      $('#md_err').html('Please Select Master Degree Required or Not.');
      err = true;
    } else {
      $('#md_err').html('');
    }

    if (prequired == 'NA') {
      $('#phd_err').html('Please Select PHD/Other Degree Required or Not.');
      err = true;
    } else {
      $('#phd_err').html('');
    }

    if (closed_date == '') {
      $('#cdate_err').html('Please Enter Job Closed Date.');
      err = true;
    } else {
      $('#cdate_err').html('');
    }

    if (open_date == '') {
      $('#odate_err').html('Please Enter Job Open Date.');
      err = true;
    } else {
      $('#odate_err').html('');
    }
    if (advertisement_title == '') {
      $('#advertisement_title_err').html('Please Enter Advertisement Title.');
      err = true;
    } else {
      $('#advertisement_title_err').html('');
    }

    if (advertisement_url == '') {
      $('#advertisement_url_err').html('Please Enter Advertisement URL.');
      err = true;
    } else {
      $('#advertisement_url_err').html('');
    }
    if (expr == '') {
      $('#expr_err').html('Please Enter Total Experience.');
      err = true;
    } else {
      $('#expr_err').html('');
    }

    if (age == '') {
      $('#age_err').html('Please Enter Age Limit Required.');
      err = true;
    } else {
      $('#age_err').html('');
    }

    if (caste == 'NA') {
      $('#caste_err').html('Please Select Caste Required for Post.');
      err = true;
    } else {
      $('#caste_err').html('');
    }

    if (err == true) {
      event.preventDefault();
    }
  });
</script>
<script>
  var post = $("#post");

  function updatePost() {
    post.val($("#postid").val() + $("#category").val() + "-" + $("#sequence").val() + "-" + $("#year").val());
  }

  $("#postid").change(function() {
    updatePost();
  });
  $("#category").change(function() {
    updatePost();
  });
  $("#sequence").change(function() {
    updatePost();
  });
  $("#year").change(function() {
    updatePost();
  });
</script>