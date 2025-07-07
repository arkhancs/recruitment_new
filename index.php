<?php include './header.php'; ?>
<div class="container">
  <div class="login-form">
    <form name="form1" method="post">
      <div class="row titleText">
        <?php
        date_default_timezone_set('Asia/Kolkata');
        $current_date = date("d/m/Y H:i:s");
        $current_date1 = date('Y-m-d H:i:s');

        //                            $sql = "select count(*) as open_cs, job_type from req_experience where STR_TO_DATE(closed_date,'%d/%m/%Y %H:%i:%s') >= STR_TO_DATE('$current_date','%d/%m/%Y %H:%i:%s') and category = 'CS' and job_location = 'INFLIBNET, Gandhinagar' and status='OPEN'";
        //                            $result = mysqli_query($link, $sql);
        //                            $row = mysqli_fetch_assoc($result);
        //                            $count_open_cs = $row['open_cs'];
        //                            $job_type = $row['job_type'];
        //
        //                            $sql = "select count(*) as open_ls, job_type from req_experience where STR_TO_DATE(closed_date,'%d/%m/%Y') >= STR_TO_DATE('$current_date','%d/%m/%Y') and category = 'LS' and job_location = 'INFLIBNET, Gandhinagar' and status='OPEN'";
        //                            $result = mysqli_query($link, $sql);
        //                            $row = mysqli_fetch_assoc($result);
        //                            $count_open_ls = $row['open_ls'];
        //                            $job_type = $row['job_type']; count(*) as permanent,  $count_permanent = $row_p['permanent'];


        // $sql_p = "select job_type, open_date_admin, closed_date_admin from req_experience where STR_TO_DATE(closed_date,'%d/%m/%Y %H:%i:%s') >= STR_TO_DATE('$current_date','%d/%m/%Y %H:%i:%s') and status='OPEN' and job_type='Permanent'";
        // $sql_p = "SELECT job_type, open_date_admin, closed_date_admin, advertisement_title, advertisement_url, status FROM req_experience WHERE STR_TO_DATE(closed_date, '%d/%m/%Y %H:%i:%s') >= STR_TO_DATE('$current_date', '%d/%m/%Y %H:%i:%s') AND status = 'OPEN' AND job_type = 'Permanent'";

        $sql_p = "SELECT job_type, open_date, open_date_admin, closed_date_admin, advertisement_title, advertisement_url, status FROM req_experience WHERE closed_date_admin >= '$current_date1' AND status = 'OPEN'
          AND job_type = 'Permanent'";

        $result_p = mysqli_query($link, $sql_p);

        $row_p = mysqli_fetch_array($result_p);
        $show_btn = false;
        $advertisements = [];
        if (mysqli_num_rows($result_p) > 0) {
          foreach ($result_p as $r) {
            $job_type_p = $r['job_type'];
            $open_date = $r['open_date_admin'];
            $close_date = $r['closed_date_admin'];
            $status = $r['status'];
            $advertisement_url = $r['advertisement_url'];
            //                        echo $r['open_date_admin'] . '<br>';
            //                        echo $r['closed_date_admin'] . '<br>';
            //                        echo $current_date1 . '<br>';

            if ($open_date <= $current_date1 && $current_date1 <= $close_date) {
              $show_btn = true;
            }
            if ($open_date <= $current_date1 && $status == 'OPEN' && !empty($advertisement_url)) {
              // Generate a unique key based on title and URL
              $ad_key = $r['advertisement_title'] . '|' . $r['advertisement_url']; // Use '|' as a delimiter

              // Check if the key is already in the array
              if (!isset($unique_ads[$ad_key])) {
                // Add to advertisements array
                $advertisements[] = [
                  'title' => $r['advertisement_title'],
                  'url' => $r['advertisement_url']
                ];
                // Mark as added
                $unique_ads[$ad_key] = true;
              }
            }
          }
        }

        ?>
        <center class="yellow-text blinking">

          <font class="alert-text blinking"><b>Important Note: Please use only latest Google Chrome/Mozilla Firefox browser to apply online. </b></font> <br /><br />

        </center>
        <br />
        <!--Advt. No. 03/2020: Online applications are invited from Indian nationals on direct recruitment basis for the post of Scientific Technical Officer - I (Computer Science) and Private Secretary at INFLIBNET Centre. <a href="https://www.inflibnet.ac.in/jobs/AdvtNo03_2020_STO_PS.pdf" style="color:skyblue;" target="_blank">(View Advertisement)</a> <br>-->
        <!-- <font style="color: red;"><strong>Advt Nos. 01/2021: "Due to surge in COVID-19 cases throughout the country, the interview for the post of Scientist-D(LS) reserved under OBC(NCL) which was scheduled on Saturday, 22nd January 2022 HAS BEEN POSTPONED TILL FURTHER ORDER. The fresh date will be intimated in due course.The inconvenience caused is regretted."</strong></font> <br/><br/> -->
        <!-- <h4 class="inquiryTitle" style="margin-bottom: 20px !important;"><a href="https://www.inflibnet.ac.in/jobs/Full_Advertisement_02-2024-Scientist-B_(LS).pdf" style="color:skyblue;" target="_blank"><span>Advt. No.02/2024: Advertisement</span></a></h4> -->

        <?php
        foreach ($advertisements as $ad) {
          echo '<h4 class="inquiryTitle" style="margin-bottom: 20px !important;">
            <a href="' . $ad['url'] . '" style="color:skyblue;" target="_blank">
                <span>' . 'Advertisement No.' . $ad['title'] . '</span>
            </a>
          </h4>';
        }

        if ($show_btn) {
          //if ($open_date <= $current_date1 && $current_date1 <= $close_date) {
        ?>

          <div class="col-md-6 col-sm-6 col-xs-12 col-sm-offset-2 buttonGroup br">
            <a href="application_form.php" class="borderWhite login-btn btn btn-block pull-right mb0"><i class="fa fa-user f30"></i> <br>Apply Now</a> <br />
          </div>

        <?php
        } else {
        ?>
          <!--<div class="col-md-12 text-center"><h2 class="red-text blinking">Online submission available shortly.</h2></div>-->
          <?php if (empty($advertisements)) {
          ?>
            <div class="col-md-12 text-center">
              <h2 class="red-text blinking">No current job openings available. Please check back later.</h2>
            </div>
          <?php
          } else {
          ?>
            <div class="col-md-12 text-center">
              <h2 class="red-text blinking">Online submission has been closed.</h2>
            </div>
          <?php
          } ?>
          <!--<div class="col-md-6 col-sm-6 col-xs-12 buttonGroup">
                            <a href="login.php" class="borderWhite login-btn btn btn-block pull-right"><i class="fa fa-user f30"></i> <br>Login</a>
                    </div>-->
        <?php } ?>

        <?php if ($current_date1 <= "2025-07-28 10:00:00") { ?>
          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <div class="buttonGroup text-center">

              <center><a href="login.php" class="borderWhite login-btn btn btn-block blueBtn"><i class="fa fa-address-card-o f30"></i> <br>Download Admit Card</a></center>
              <h4 class="postTitle">FOR POST:</h4>
              <ul class="contactBox">
                <li style="color:white !important"><i class="fa fa-hand-o-right"></i>Advt. No. 01/2025: Clerk-Cum-Typist (CCTAdmin-1-2025) </li>
                <!-- <li style="color:white !important"><i class="fa fa-hand-o-right"></i>Advt No. 02/2023: Clerk cum Typist </li> -->
              </ul>
            </div>
          </div>
        <?php } ?>
        <div style="clear: both;"></div>
        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
          <!--                    <h4>
                                            <span class="yellow-text">
                                                <ul class="contactBox">
                                                    <li><i class="fa fa-hand-o-right"></i>The last date of filling Online Application is 22.02.2023 upto 05.30 PM. </li>
                                                    <li><i class="fa fa-hand-o-right"></i>The last date to receive the hard copy of the application with all testimonials is 04.03.2023 upto 5:30 PM.</li>
                                                    <li>The last date of filling Online Application is 23.02.2023 upto 5:30 pm, and the last date of receiving Hard Copy of the Application with all testimonials is 05.03.2023 upto 5:30 pm</li>
                                                </ul>
                                            </span>
                                        </h4>-->
          <div style="clear: both;"></div>
          <br>
          <h4 class="inquiryTitle"><span>For Query</span></h4>
          <ul class="contactBox" style="color:white!important">
            <li class="text-center"><i class="fa fa-user"></i> Administrative Officer (P & A)</li>
            <li class="text-center"><i class="fa fa-map-marker" aria-hidden="true"></i> INFLIBNET Centre, Infocity, Gandhinagar - 382007</li>
            <li class="text-center"><i class="fa fa-phone"></i> (+91) 79 2326 8000</li>
            <li class="text-center"><i class="fa fa-envelope"></i> recruitment[at]inflibnet[dot]ac[dot]in </li>
          </ul>
        </div>
        <div style="clear: both;"></div>
      </div>
      <!--            <div style="clear:both;font-size: 14px;letter-spacing: 1px;">
                            <font class="white-text">Care : we expect heavy load on the website towards the last date for applying. please, therefore, apply well before the closing date to avoid network congestion / disconnection & inability to register your application.</font>
                        </div>-->
    </form>
  </div>
</div>
<?php include 'footer.php'; ?>
</body>

</html>