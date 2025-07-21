<?php
session_start();
error_reporting(0);
if ($_SESSION['is_login'] != 'true') {
  header("Location: ../Admin_login.php");
  exit();
}
$edit_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$edit_row = [];

if ($edit_id > 0) {
  include '../dbConfig.php';
  $q = "SELECT * FROM payment_links WHERE id = $edit_id LIMIT 1";
  $r = mysqli_query($link, $q);
  if ($r && mysqli_num_rows($r) > 0) {
    $edit_row = mysqli_fetch_assoc($r);
  }
}

include '../admin_header.php'; ?>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../css/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.js"></script>
<link href="../css/custom.css" rel="stylesheet">
</head>

<body>
  <div class="container" style="padding-top: 15px;">
    <a href="../Admin_Home.php" class="btn btn-primary pull-right">Back to Home</a>
    <h3 class="page-header">Manage Payment Links</h3>

    <?php
    if (isset($_SESSION['errors'][0])) {
      echo '<div class="alert alert-danger">' . $_SESSION['errors'][0] . '</div>';
      unset($_SESSION['errors']);
    }

    if (isset($_SESSION['success'])) {
      echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
      unset($_SESSION['success']);
    }
    ?>

    <div class="panel panel-default">
      <div class="panel-heading"><strong><?php echo $edit_id > 0 ? 'Edit Payment Link' : 'Add New Payment Link'; ?></strong></div>
      <div class="panel-body">
        <form data-toggle="validator" role="form" method="post" action="add_payment_link_action.php" id="payment_form">
          <input type="hidden" name="id" value="<?php echo $edit_id; ?>">

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="payment_url">Payment URL:</label>
                <input type="text" class="form-control" name="payment_url" id="payment_url"
                  value="<?php echo isset($edit_row['payment_url']) ? htmlspecialchars($edit_row['payment_url']) : ''; ?>"
                  placeholder="https://www.onlinesbi.sbi/sbicollect/...">
                <span id='payment_url_err' style="color: red" class="err_msg"></span>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="valid_from">Valid From:</label>
                <input type="text" class="form-control" name="valid_from" id="valid_from"
                  value="<?php echo isset($edit_row['valid_from']) ? date('d/m/Y H:i:s', strtotime($edit_row['valid_from'])) : ''; ?>">
                <span id='valid_from_err' style="color: red" class="err_msg"></span>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="valid_to">Valid To:</label>
                <input type="text" class="form-control" name="valid_to" id="valid_to"
                  value="<?php echo isset($edit_row['valid_to']) ? date('d/m/Y H:i:s', strtotime($edit_row['valid_to'])) : ''; ?>">
                <span id='valid_to_err' style="color: red" class="err_msg"></span>
              </div>
            </div>
          </div>

          <div class="text-center">
            <button type="submit" name="submit" id="submit" class="btn btn-success">Submit</button>
            <button type="button" id="clearFormBtn" class="btn btn-default" style="margin-left:10px;">Clear</button>
          </div>

        </form>
      </div>
    </div>

    <div class="panel panel-primary">
      <div class="panel-heading"><strong>Existing Payment Links</strong></div>
      <div class="panel-body">
        <div class="table-responsive">
          <table id="paymentTable" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Sr. No.</th>
                <th>Payment URL</th>
                <th>Valid From</th>
                <th>Valid To</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              include '../dbConfig.php';
              $sql = "SELECT * FROM payment_links ORDER BY id DESC";
              $result = mysqli_query($link, $sql);
              $i = 1;
              while ($row = mysqli_fetch_assoc($result)) {
              ?>
                <tr>
                  <td><?php echo $i++; ?></td>
                  <td><a href="<?php echo htmlspecialchars($row['payment_url']); ?>" target="_blank"><?php echo htmlspecialchars($row['payment_url']); ?></a></td>
                  <td><?php echo date('d/m/Y', strtotime($row['valid_from'])); ?></td>
                  <td><?php echo date('d/m/Y', strtotime($row['valid_to'])); ?></td>
                  <td>
                    <a href="add_payment_link_action.php?toggle_id=<?php echo $row['id']; ?>&status=<?php echo $row['status']; ?>"
                      onclick="return confirm('Are you sure you want to change the status?');"
                      class="btn btn-<?php echo $row['status'] === 'active' ? 'success' : 'danger'; ?> btn-sm">
                      <?php echo ucfirst($row['status']); ?>
                    </a>
                  </td>
                  <td>
                    <a href="payment_link.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i> Edit</a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <?php include '../footer.php'; ?>
</body>


</html>
<script type="text/javascript">
  $('#valid_from').datetimepicker({
    dateFormat: "dd/mm/yy",
    timeFormat: "HH:mm:ss"
  });

  $('#valid_to').datetimepicker({
    dateFormat: "dd/mm/yy",
    timeFormat: "HH:mm:ss"
  });
  $(document).ready(function() {
    $('#paymentTable').DataTable();
  });
  $(document).on('submit', '#payment_form', function(event) {
    var err = false;
    var payment_url = $("#payment_url").val();
    var valid_from = $("#valid_from").val();
    var valid_to = $("#valid_to").val();

    if (payment_url == '') {
      $('#payment_url_err').html('Please enter payment URL.');
      err = true;
    } else if (!payment_url.startsWith("https://")) {
      $('#payment_url_err').html('URL must start with https://');
      err = true;
    } else {
      $('#payment_url_err').html('');
    }

    if (payment_url != '' && valid_from == '') {
      $('#valid_from_err').html('Please select the start date.');
      err = true;
    } else {
      $('#valid_from_err').html('');
    }

    if (payment_url != '' && valid_to == '') {
      $('#valid_to_err').html('Please select the end date.');
      err = true;
    } else {
      $('#valid_to_err').html('');
    }

    if (err == true) {
      event.preventDefault();
    }



  });

  // Clear form and redirect
  $('#clearFormBtn').click(function() {
    window.location.href = 'payment_link.php';
  });
</script>