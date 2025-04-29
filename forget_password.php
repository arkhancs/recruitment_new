<?php include 'header.php'; ?>
<style type="text/css">
  .login-form {
    width: 400px;
    margin: 25px auto;
    float: left;
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
    border-color: #bb4e0a;
  }

  .login-btn:hover {
    color: #fff;
    background-color: #191e5d;
    border-color: #191e5d;
  }
</style>
<div class="container">
  <div class="login-form">
    <h4>
      <?php
      session_start();
      echo $_SESSION['forget_msg'];
      unset($_SESSION['forget_msg']);
      ?>
    </h4>
    <form name="form1" method="post" action="login.php">
      <h2 class="text-center">Forgot Password</h2>
      <div class="form-group">
        <span class="white-text"><b>Application ID :<font style="color:red;font-size: 15px;"> *</font> </b></span>
        <input type="text" class="form-control" placeholder="Application ID" id="app_id" name="app_id" required="required">
      </div>

      <div class="form-group">
        <span class="white-text"><b>Email :<font style="color:red;font-size: 15px;"> *</font> </b></span>
        <input type="email" class="form-control" placeholder="Email Address " id="email" name="email" required="required">
      </div>



      <div class="form-group">
        <input type="submit" name="reset_password" class="login-btn btn btn-block" value="Submit" />
      </div>
      <div class="clearfix">
        <p class="text-center pull-left"><a href="index.php">Go to Home</a></p>
      </div>

    </form>
  </div>
</div>
<?php include 'footer.php'; ?>
</body>

</html>