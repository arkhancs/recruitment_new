<?php include './header.php'; ?>
<div class="container">
  <div class="login-form">
    <form name="form1" method="post">
      <div class="row titleText">
        <?php
        date_default_timezone_set('Asia/Kolkata');
        $current_date = date("d/m/Y H:i:s");
        $current_date1 = date('Y-m-d H:i:s');

        $stmt_p = $link->prepare("SELECT DISTINCT job_type, open_date, open_date_admin, closed_date_admin, advertisement_title, advertisement_url, status FROM req_experience WHERE closed_date_admin >= ? AND status = 'OPEN' AND job_type = 'Permanent'");

        $stmt_p->bind_param("s", $current_date1);
        $stmt_p->execute();
        $result_p = $stmt_p->get_result();
        $row_p = $result_p->fetch_array();

        $show_btn = false;
        $advertisements = [];
        $unique_ads = [];
        if (mysqli_num_rows($result_p) > 0) {
          foreach ($result_p as $r) {
            $job_type_p = $r['job_type'];
            $open_date = $r['open_date_admin'];
            $close_date = $r['closed_date_admin'];
            $status = $r['status'];
            $advertisement_url = $r['advertisement_url'];

            if ($open_date <= $current_date1 && $current_date1 <= $close_date) {
              $show_btn = true;
            }
            if ($open_date <= $current_date1 && $status == 'OPEN' && !empty($advertisement_url)) {
              $ad_key = $r['advertisement_title'] . '|' . $r['advertisement_url'];
              if (!isset($unique_ads[$ad_key])) {
                $advertisements[] = [
                  'title' => $r['advertisement_title'],
                  'url' => $r['advertisement_url']
                ];
                $unique_ads[$ad_key] = true;
              }
            }
          }
        }
        ?>
        <div class="col-xs-12 text-center">
          <font class="alert-text blinking"><b>Important Note: Please use only latest Google Chrome/Mozilla Firefox browser to apply online. </b></font>
          <br /><br />
        </div>

        <?php

        $stmt_p = $link->prepare("SELECT DISTINCT job_type, open_date_admin, closed_date_admin, advertisement_title, advertisement_url, status, post, Name FROM req_experience WHERE closed_date_admin >= ? AND status = 'OPEN' AND job_type = 'Permanent'");

        $stmt_p->bind_param("s", $current_date1);
        $stmt_p->execute();
        $result_p = $stmt_p->get_result();
        $row_p = $result_p->fetch_array();

        $show_btn = false;
        $advertisements = [];
        $unique_ads = [];
        $post_date_map = [];

        if (mysqli_num_rows($result_p) > 0) {
          foreach ($result_p as $r) {
            $job_type_p = $r['job_type'];
            $open_date = $r['open_date_admin'];
            $close_date = $r['closed_date_admin'];
            $status = $r['status'];
            $advertisement_url = $r['advertisement_url'];

            if ($open_date <= $current_date1 && $current_date1 <= $close_date) {
              $show_btn = true;
            }
            if ($open_date <= $current_date1 && $status == 'OPEN' && !empty($advertisement_url)) {
              $ad_key = $r['advertisement_title'] . '|' . $r['advertisement_url'];
              if (!isset($unique_ads[$ad_key])) {
                $advertisements[] = [
                  'title' => $r['advertisement_title'],
                  'url' => $r['advertisement_url']
                ];
                $unique_ads[$ad_key] = true;
              }
            }
            if ($status == 'OPEN') {
              $key = $open_date . '|' . $close_date;
              $post_date_map[$key][] = $r['Name'];
            }
          }
        }
        ?>

        <?php
        foreach ($advertisements as $ad) {
          echo '<div class="col-xs-12"><h4 class="inquiryTitle text-center" style="margin-bottom: 20px !important;">
            <a href="' . $ad['url'] . '" style="color:skyblue;" target="_blank">
            <span>' . $ad['title'] . '</span>
            </a>
          </h4></div>';
        }

        if ($show_btn) {
        ?>

          <div class="col-xs-12 text-center buttonGroup br">
            <a href="application_form.php" class="borderWhite login-btn btn btn-block mb0" style="max-width:300px; margin:0 auto;">
              <i class="fa fa-user f30"></i><br>Apply Now
            </a>
          </div>


        <?php
        } else {
        ?>
          <?php if (empty($advertisements)) {
          ?>
            <div class="col-xs-12 text-center">
              <h2 class="red-text blinking">No current job openings available. Please check back later.</h2>
            </div>
          <?php
          } else {
          ?>
            <div class="col-xs-12 text-center">
              <h2 class="red-text blinking">Online submission has been closed.</h2>
            </div>
          <?php } ?>
        <?php } ?>

        <?php if ($current_date1 <= "2025-07-03 10:00:00") { ?>
          <div class="col-xs-12 text-center">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 col-sm-offset-2">
              <div class="buttonGroup text-center">
                <a href="login.php" class="borderWhite login-btn btn btn-block blueBtn"><i class="fa fa-address-card-o f30"></i> <br>Download Admit Card</a>
                <h4 class="postTitle">FOR POST:</h4>
                <ul class="contactBox">
                  <li style="color:white !important"><i class="fa fa-hand-o-right"></i>Advt. No. 01/2025: Clerk-Cum-Typist (CCTAdmin-1-2025) </li>
                  $1
              </div>
            </div>
          </div>
        <?php } ?>

        <?php if (!empty($post_date_map)) {
          $has_open_posts = false;
          foreach ($post_date_map as $key => $posts) {
            list($open, $close) = explode('|', $key);
            if ($current_date1 >= $open) {
              $has_open_posts = true;
              break;
            }
          }
          if ($has_open_posts) { ?>
            <div class="col-xs-12 text-center">
              <h4>
                <span class="yellow-text">
                  <ul class="contactBox">
                    <?php
                    foreach ($post_date_map as $key => $posts) {
                      list($open, $close) = explode('|', $key);
                      if ($current_date1 < $open) continue;
                      $open_fmt = date('d.m.Y', strtotime($open));
                      $close_fmt = date('d.m.Y h:i A', strtotime($close));
                      $hardcopy_date_obj = new DateTime($open);
                      $hardcopy_date_obj->modify('+30 days');
                      $hardcopy_last_date = $hardcopy_date_obj->format('d.m.Y');
                      $hardcopy_time = '05:30 PM';
                      $post_list = implode(', ', $posts);
                    ?>
                      <!-- <li><i class="fa fa-hand-o-right"></i>Application for post(s): <strong><?php echo $post_list; ?></strong> is open from <strong><?php echo $open_fmt; ?></strong> to <strong><?php echo $close_fmt; ?></strong>.</li>

                      <li><i class="fa fa-hand-o-right"></i>The last date to receive the hard copy of the application for post(s): <strong><?php echo $post_list; ?></strong> is <strong><?php echo $hardcopy_last_date . ' upto ' . $hardcopy_time; ?></strong>.</li> -->

                      <li><i class="fa fa-hand-o-right"></i>Online application is open from <strong><?php echo $open_fmt; ?></strong> to <strong><?php echo $close_fmt; ?></strong>.</li>

                      <li><i class="fa fa-hand-o-right"></i>The last date to receive the hard copy of the application is <strong><?php echo $hardcopy_last_date . ' upto ' . $hardcopy_time; ?></strong>.</li>

                    <?php } ?>
                  </ul>
                </span>
              </h4>
            </div>
        <?php }
        } ?>

        <div class="col-xs-12 text-center">
          <h4 class="inquiryTitle"><span>For Query</span></h4>
          <ul class="contactBox" style="color:white!important">
            <li><i class="fa fa-user"></i> Administrative Officer (P & A)</li>
            <li><i class="fa fa-map-marker" aria-hidden="true"></i> INFLIBNET Centre, Infocity, Gandhinagar - 382007</li>
            <li><i class="fa fa-phone"></i> (+91) 79 2326 8000</li>
            <li><i class="fa fa-envelope"></i> recruitment[at]inflibnet[dot]ac[dot]in </li>
          </ul>
        </div>
      </div>
    </form>
  </div>
</div>
<?php include 'footer.php'; ?>
</body>

</html>