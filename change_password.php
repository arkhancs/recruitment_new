<?php
session_start();
if (!isset($_SESSION['is_login']) || $_SESSION['is_login'] !== 'true') {
  header('Location: index.php');
  exit;
}

include "dbConfig.php";
include "checker_input.php";

$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $old  = clean_input($link, $_POST['oldpass']  ?? '', 'Old Password');
  $new  = clean_input($link, $_POST['newpass']  ?? '', 'New Password');
  $conf = clean_input($link, $_POST['confpass'] ?? '', 'Confirm Password');
  $uid  = $_SESSION['app_id'];

  if ($new !== $conf) {
    $msg = '<div class="alert alert-danger">New & Confirm passwords do not match.</div>';
  } elseif (strlen($new) < 6) {
    $msg = '<div class="alert alert-danger">Minimum 6 characters required.</div>';
  } elseif ($_POST['captcha_code'] !== $_SESSION['code']) {
    $msg = '<div class="alert alert-danger">Incorrect Captcha.</div>';
  } else {
    $stmt = $link->prepare("SELECT password FROM prsnl WHERE id = ?");
    $stmt->bind_param('s', $uid);
    $stmt->execute();
    $stmt->bind_result($dbHash);
    $stmt->fetch();
    $stmt->close();

    if (md5($old) !== $dbHash) {
      $msg = '<div class="alert alert-danger">Old password is incorrect.</div>';
    } else {
      $stmt = $link->prepare("UPDATE prsnl SET password = ? WHERE id = ?");
      $newHash = md5($new);
      $stmt->bind_param('ss', $newHash, $uid);
      $stmt->execute();
      $msg = '<div class="alert alert-success">Password changed successfully.</div>';
    }
  }
}

/* Re-use dashboard variables for the same look */
$prefix     = $_SESSION['prefix'];
$surname    = $_SESSION['surname'];
$name       = $_SESSION['name'];
$fathername = $_SESSION['fathername'];
$app_id     = $_SESSION['app_id'];

include 'header.php';
?>
<style type="text/css">
  .login-form {
    width: 1000px;
    margin: 25px auto;
    float: none;
  }

  .login-form form {
    margin-bottom: 15px;
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    background: rgba(217, 215, 215, 0.21);
    border: 1px solid rgba(255, 255, 255, .2);
    border-top: 4px solid #191e5d;
    padding: 30px;
  }

  .login-form h2 {
    margin: 0 0 15px;
    text-transform: uppercase;
    color: #ffffff;
  }

  .login-btn {
    color: #fff;
    background-color: #f2660e;
    border-color: #f2660e;
  }

  .login-btn:hover {
    color: #fff;
    background-color: #191e5d;
    border-color: #191e5d;
  }

  .password-field {
    position: relative;
  }

  .password-field .toggle-pwd {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    color: #555;
  }
</style>

<div class="container">
  <div class="login-form white-text">
    <!-- SAME NAME & APP-ID BAR AS DASHBOARD -->
    <div class="row">
      <div class="col-md-6">
        <span>
          Welcome <?= htmlspecialchars(strtoupper($prefix . ' ' . $surname . ' ' . $name . ' ' . $fathername)) ?>
        </span><br />
      </div>
      <div class="col-md-6 text-right">
        Application ID: <b><?= $app_id ?></b>
        &nbsp;&nbsp;|&nbsp;&nbsp;<a href="dashboard.php">Back to Dashboard</a>
      </div>
    </div>

    <?= $msg ?>

    <form method="post" onsubmit="return check_cp_captcha();">
      <h2 class="text-center">Change Password</h2>

      <!-- OLD PASSWORD -->
      <div class="form-group password-field">
        <input type="password" class="form-control" placeholder="Old Password"
          name="oldpass" id="oldpass" minlength="8" required>
        <i class="fa fa-eye toggle-pwd" onclick="togglePwd('oldpass')"></i>
      </div>

      <!-- NEW PASSWORD -->
      <div class="form-group password-field">
        <input type="password" class="form-control" placeholder="New Password"
          name="newpass" id="newpass" minlength="8" required>
        <i class="fa fa-eye toggle-pwd" onclick="togglePwd('newpass')"></i>
      </div>

      <!-- CONFIRM PASSWORD -->
      <div class="form-group password-field">
        <input type="password" class="form-control" placeholder="Confirm Password"
          name="confpass" id="confpass" minlength="8" required>
        <i class="fa fa-eye toggle-pwd" onclick="togglePwd('confpass')"></i>
      </div>

      <script>
        function togglePwd(id) {
          var x = document.getElementById(id);
          var icon = x.nextElementSibling;
          if (x.type === "password") {
            x.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
          } else {
            x.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
          }
        }
      </script>

      <div class="form-group">
        <img id="captcha_img" src="captcha.php" alt="CAPTCHA" height="32" width="80" />
        <a href="javascript:refresh_cp();">
          <img src="images/refresh.png" height="40" width="40" />
        </a>
        <input type="text" name="captcha_code" class="form-control" placeholder="Enter captcha" autocomplete="off" required>
      </div>

      <button type="submit" class="login-btn btn btn-block">Submit</button>
    </form>
  </div>
</div>

<?php include 'footer.php'; ?>
<script>
  function refresh_cp() {
    document.getElementById('captcha_img').src = 'captcha.php?' + Math.random();
  }

  function check_cp_captcha() {
    return (document.querySelector('input[name="captcha_code"]').value.trim() !== '');
  }
</script>
<script>
  function validate8Digit(el) {
    const val = el.value.trim();
    if (val.length && !/^\d{8}$/.test(val)) {
      alert('Password must be exactly 8 digits (numbers only).');
      el.value = '';
      el.focus();
      return false;
    }
    return true;
  }

  /* attach to every password input */
  document.querySelectorAll('input[name="oldpass"], input[name="newpass"], input[name="confpass"]').forEach(
    inp => inp.addEventListener('blur', () => validate8Digit(inp))
  );
</script>
</body>

</html>