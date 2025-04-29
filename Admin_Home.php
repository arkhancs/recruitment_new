<?php include 'admin_header.php'; ?>
<div class="container mb-80">
  <form action="export.php" method="post" id="form1">
    <?php
    if (isset($_POST['post']) && $_POST['post'] != '' && $_POST['hard_copy_received'] == '' && $_POST['status_check'] == '') {
      $post1 = $_POST['post'];
      $sql9 = "SELECT distinct a.id,CONCAT(surname,' ',a.name,' ',fathername) as name, re.Name as postname,a.category,a.caste_certino,a.caste_certi_issue_year,a.dob,a.age, b.grandtotal, a.email,a.mobile, a.status_check, a.status_remarks, c.edu3, c.edu4,c.edu5,c.edu7,c.board3,c.board4,c.board5,c.board7,c.spec3,c.spec4,c.spec5,c.spec7,c.per3,c.per4,c.per5,c.per7,c.year3,c.year4,c.year5,c.year7,c.div3,c.div4,c.div5,c.div7,"
        . "b.org1,b.org2,b.org3,b.org4,b.org5,b.org6,b.org7,b.org8,b.org9,b.org10,b.pos1,b.pos2,b.pos3,b.pos4,b.pos5,b.pos6,b.pos7,b.pos8,b.pos9,b.pos10,"
        . "b.from1,b.from2,b.from3,b.from4,b.from5,b.from6,b.from7,b.from8,b.from9,b.from10, b.to1,b.to2,b.to3,b.to4,b.to5,b.to6,b.to7,b.to8,b.to9,b.to10,"
        . "b.pay1,b.pay2,b.pay3,b.pay4,b.pay5,b.pay6,b.pay7,b.pay8,b.pay9,b.pay10, CONCAT(d.transaction_ref_no,'\n',', ',d.dd_date,'\n',', ',d.dd_amount) as transaction_ref_no,a.regdate, d.hard_copy_received FROM prsnl a LEFT JOIN exprn b ON b.id = a.id LEFT JOIN edctn c ON c.id = b.id LEFT JOIN othrs d ON d.id = b.id left join req_experience re on re.post = a.post where a.status = 'current' and a.post <>'' and a.post = '$post1' and a.post<>'NA' order by a.name";
      $result9 = mysqli_query($link, $sql9);
    } else if (isset($_POST['post']) && $_POST['post'] != '' && $_POST['hard_copy_received'] == 'Yes') {
      $post2 = $_POST['post'];
      $sql9 = "SELECT distinct a.id,CONCAT(surname,' ',a.name,' ',fathername) as name, re.Name as postname,a.category,a.caste_certino,a.caste_certi_issue_year,a.dob,a.age, b.grandtotal, a.email,a.mobile, a.status_check, a.status_remarks, c.edu3,c.edu4,c.edu5,c.edu7,c.board3,c.board4,c.board5,c.board7,c.spec3,c.spec4,c.spec5,c.spec7,c.per3,c.per4,c.per5,c.per7,c.year3,c.year4,c.year5,c.year7,c.div3,c.div4,c.div5,c.div7,b.org1,b.org2,b.org3,b.org4,b.org5,b.org6,b.org7,b.org8,b.org9,b.org10,b.pos1,b.pos2,b.pos3,b.pos4,b.pos5,b.pos6,b.pos7,b.pos8,b.pos9,b.pos10,b.from1,b.from2,b.from3,b.from4,b.from5,b.from6,b.from7,b.from8,b.from9,b.from10, b.to1,b.to2,b.to3,b.to4,b.to5,b.to6,b.to7,b.to8,b.to9,b.to10,b.pay1,b.pay2,b.pay3,b.pay4,b.pay5,b.pay6,b.pay7,b.pay8,b.pay9,b.pay10, CONCAT(d.transaction_ref_no,'\n',', ',d.dd_date,'\n',', ',d.dd_amount) as transaction_ref_no,a.regdate, d.hard_copy_received FROM prsnl a LEFT JOIN exprn b ON b.id = a.id LEFT JOIN edctn c ON c.id = b.id LEFT JOIN othrs d ON d.id = b.id left join req_experience re on re.post = a.post where a.status = 'current' and a.post <>'' and a.post = '$post2' and d.hard_copy_received = 'Yes' and a.post<>'NA' order by a.name";
      $result9 = mysqli_query($link, $sql9);
    } else if (isset($_POST['post']) && $_POST['post'] != '' && $_POST['status_check'] == 'Eligible') {
      $post3 = $_POST['post'];
      $sql9 = "SELECT distinct a.id,CONCAT(surname,' ',a.name,' ',fathername) as name, re.Name as postname,a.category,a.caste_certino,a.caste_certi_issue_year,a.dob,a.age, b.grandtotal, a.email,a.mobile, a.status_check, a.status_remarks, c.edu3,c.edu4,c.edu5,c.edu7,c.board3,c.board4,c.board5,c.board7,c.spec3,c.spec4,c.spec5,c.spec7,c.per3,c.per4,c.per5,c.per7,c.year3,c.year4,c.year5,c.year7,c.div3,c.div4,c.div5,c.div7,b.org1,b.org2,b.org3,b.org4,b.org5,b.org6,b.org7,b.org8,b.org9,b.org10,b.pos1,b.pos2,b.pos3,b.pos4,b.pos5,b.pos6,b.pos7,b.pos8,b.pos9,b.pos10,b.from1,b.from2,b.from3,b.from4,b.from5,b.from6,b.from7,b.from8,b.from9,b.from10, b.to1,b.to2,b.to3,b.to4,b.to5,b.to6,b.to7,b.to8,b.to9,b.to10,b.pay1,b.pay2,b.pay3,b.pay4,b.pay5,b.pay6,b.pay7,b.pay8,b.pay9,b.pay10, CONCAT(d.transaction_ref_no,'\n',', ',d.dd_date,'\n',', ',d.dd_amount) as transaction_ref_no,a.regdate, d.hard_copy_received FROM prsnl a LEFT JOIN exprn b ON b.id = a.id LEFT JOIN edctn c ON c.id = b.id LEFT JOIN othrs d ON d.id = b.id left join req_experience re on re.post = a.post where a.status = 'current' and a.post <>'' and a.post = '$post3' and a.status_check = 'Eligible' and a.post<>'NA' order by a.name";
      $result9 = mysqli_query($link, $sql9);
    } else if (isset($_POST['post']) && $_POST['post'] != '' && $_POST['status_check'] == 'NotEligible') {
      $post4 = $_POST['post'];
      $sql9 = "SELECT distinct a.id,CONCAT(surname,' ',a.name,' ',fathername) as name, re.Name as postname,a.category,a.caste_certino,a.caste_certi_issue_year,a.dob,a.age, b.grandtotal, a.email,a.mobile, a.status_check, a.status_remarks, c.edu3,c.edu4,c.edu5,c.edu7,c.board3,c.board4,c.board5,c.board7,c.spec3,c.spec4,c.spec5,c.spec7,c.per3,c.per4,c.per5,c.per7,c.year3,c.year4,c.year5,c.year7,c.div3,c.div4,c.div5,c.div7,b.org1,b.org2,b.org3,b.org4,b.org5,b.org6,b.org7,b.org8,b.org9,b.org10,b.pos1,b.pos2,b.pos3,b.pos4,b.pos5,b.pos6,b.pos7,b.pos8,b.pos9,b.pos10,b.from1,b.from2,b.from3,b.from4,b.from5,b.from6,b.from7,b.from8,b.from9,b.from10, b.to1,b.to2,b.to3,b.to4,b.to5,b.to6,b.to7,b.to8,b.to9,b.to10,b.pay1,b.pay2,b.pay3,b.pay4,b.pay5,b.pay6,b.pay7,b.pay8,b.pay9,b.pay10, CONCAT(d.transaction_ref_no,'\n',', ',d.dd_date,'\n',', ',d.dd_amount) as transaction_ref_no,a.regdate, d.hard_copy_received FROM prsnl a LEFT JOIN exprn b ON b.id = a.id LEFT JOIN edctn c ON c.id = b.id LEFT JOIN othrs d ON d.id = b.id left join req_experience re on re.post = a.post where a.status = 'current' and a.post <>'' and a.post = '$post4' and a.status_check = 'NotEligible' and a.post<>'NA' order by a.name";
      $result9 = mysqli_query($link, $sql9);
    } else if (isset($_POST['post']) && $_POST['post'] != '' && $_POST['status_check'] == 'Provisionally') {
      $post5 = $_POST['post'];
      $sql9 = "SELECT distinct a.id,CONCAT(surname,' ',a.name,' ',fathername) as name, re.Name as postname,a.category,a.caste_certino,a.caste_certi_issue_year,a.dob,a.age, b.grandtotal, a.email,a.mobile, a.status_check, a.status_remarks, c.edu3,c.edu4,c.edu5,c.edu7,c.board3,c.board4,c.board5,c.board7,c.spec3,c.spec4,c.spec5,c.spec7,c.per3,c.per4,c.per5,c.per7,c.year3,c.year4,c.year5,c.year7,c.div3,c.div4,c.div5,c.div7,b.org1,b.org2,b.org3,b.org4,b.org5,b.org6,b.org7,b.org8,b.org9,b.org10,b.pos1,b.pos2,b.pos3,b.pos4,b.pos5,b.pos6,b.pos7,b.pos8,b.pos9,b.pos10,b.from1,b.from2,b.from3,b.from4,b.from5,b.from6,b.from7,b.from8,b.from9,b.from10, b.to1,b.to2,b.to3,b.to4,b.to5,b.to6,b.to7,b.to8,b.to9,b.to10,b.pay1,b.pay2,b.pay3,b.pay4,b.pay5,b.pay6,b.pay7,b.pay8,b.pay9,b.pay10, CONCAT(d.transaction_ref_no,'\n',', ',d.dd_date,'\n',', ',d.dd_amount) as transaction_ref_no,a.regdate, d.hard_copy_received FROM prsnl a LEFT JOIN exprn b ON b.id = a.id LEFT JOIN edctn c ON c.id = b.id LEFT JOIN othrs d ON d.id = b.id left join req_experience re on re.post = a.post where a.status = 'current' and a.post <>'' and a.post = '$post5' and a.status_check = 'Provisionally' and a.post<>'NA' order by a.name";
      $result9 = mysqli_query($link, $sql9);
    }
    ?>
    <div class="row">
      <div class="col-md-12 mb20">
        <?php if ($_SESSION['is_login'] == 'true' && $_SESSION['user'] == 'Dharmesh') { ?>
          <a href="./Admin/add_post.php" class="btn btn-primary btn-sm pull-left">Add New Post</a>
          <a href="./Admin/view_post.php" class="btn btn-primary btn-sm pull-left ml5 mr5">View Post</a>
        <?php } ?>
        <a href="./Admin/applied_post.php" class="btn btn-info btn-sm pull-left mr5">View Applied Post</a>
        <a href="./Admin/admin_date_wise_data.php" class="btn btn-warning btn-sm pull-left mr5">Statistic</a>
        <!--                <a href="./Admin/admin_date_wise_data_2022.php" class="btn btn-warning btn-sm pull-left mr5">Statistic 2022</a>
                <a href="./Admin/admin_date_wise_data_2023.php" class="btn btn-warning btn-sm pull-left mr5">Statistic 2023</a>-->
        <input type="button" name="attendance" id="attendance" class="btn btn-success btn-sm mr5" value="Attendance Sheet" />
        <input type="button" name="full_export" id="full_export" class="btn btn-danger btn-sm mr5" value="Full Export" />
        <!--<a href="./Admin/omr_result.php" class="btn btn-primary btn-sm mr5">OMR Sheet</a>-->
      </div>

      <div class="col-md-4">
        <select class="form-control" id="post" name="post">
          <option value=""><b>Select Post</b></option>
          <?php
          if ($_SESSION['is_login'] == 'true' && $_SESSION['user'] == 'Dharmesh') {
            $sql = "select * from req_experience order by id desc";
          } else {
            //$sql = "select * from req_experience where year in('2024','2023','2022','2021','2020') order by id desc";
            $sql = "select * from req_experience order by id desc";
          }
          $result = mysqli_query($link, $sql);

          if ($result) {
            if (mysqli_num_rows($result) == 0) {
            } else {
              while ($row = mysqli_fetch_assoc($result)) {
          ?>
                <?php if ($row['status'] == 'OPEN') { ?>
                  <option value="<?php echo $row['post']; ?>" data-location="<?php echo $row['job_location']; ?>" <?php echo ($row['post'] == $_POST['post']) ? 'selected' : ''; ?>><?php echo $row['Name'] . " (" . $row['post'] . ") - " . $row['year']; ?></option>
                <?php } else { ?>
                  <option value="<?php echo $row['post']; ?>" data-location="<?php echo $row['job_location']; ?>" <?php echo ($row['post'] == $_POST['post']) ? 'selected' : ''; ?>><?php echo $row['Name'] . " (" . $row['post'] . ") - " . $row['year']; ?></option>
          <?php
                }
              }
            }
          }
          ?>
        </select>
      </div>
      <div class="col-md-4" align="center" id="print_status"></div>

    </div>
  </form>
  <div class="clearfix"></div>
  <?php
  //            include('dbConfig.php');
  //            $sql1 = "SELECT re.job_location, re.year, re.category, count(p.id) as count from prsnl p right join req_experience re on re.post = p.post and re.job_location = p.job_location and p.status = 'current' WHERE re.year='2019' and re.job_location='UGC, New Delhi'";
  //            $result1 = mysqli_query($link, $sql1);
  //            while ($row1 = mysqli_fetch_assoc($result1)) {
  //                $count1 = $row1['count'];
  //            }
  //            //$sql2 = "SELECT re.job_location, re.year, re.category, count(p.id) as count from prsnl p right join req_experience re on re.post = p.post and re.job_location = p.job_location and p.status = 'current' WHERE re.year='2019' and re.category <> '' and re.category != 'LS' and re.job_location='INFLIBNET, Gandhinagar'";
  //            $sql2 = "SELECT re.year, re.category, count(p.id) as count from prsnl p right join req_experience re on re.post = p.post and p.status = 'current' WHERE re.year='2019' and re.category <> '' and re.category != 'LS'";
  //            $result2 = mysqli_query($link, $sql2);
  //            while ($row2 = mysqli_fetch_assoc($result2)) {
  //                $count2 = $row2['count'];
  //            }
  //
  //            //$sql3 = "SELECT re.job_location, re.year, re.category, count(p.id) as count from prsnl p right join req_experience re on re.post = p.post and re.job_location = p.job_location and p.status = 'current' WHERE re.year='2019' and re.category = '' and re.job_location='INFLIBNET, Gandhinagar'";
  //            $sql3 = "SELECT re.year, re.category, count(p.id) as count from prsnl p right join req_experience re on re.post = p.post and p.status = 'current' WHERE re.year='2019' and re.category = ''";
  //            $result3 = mysqli_query($link, $sql3);
  //            while ($row3 = mysqli_fetch_assoc($result3)) {
  //                $count3 = $row3['count'];
  //            }
  //
  //            //$sql4 = "SELECT re.job_location, re.year, re.category, count(p.id) as count from prsnl p right join req_experience re on re.post = p.post and re.job_location = p.job_location and p.status = 'current' WHERE re.year='2019' and re.category = 'LS' and re.job_location='INFLIBNET, Gandhinagar'";
  //            $sql4 = "SELECT re.year, re.category, count(p.id) as count from prsnl p right join req_experience re on re.post = p.post and p.status = 'current' WHERE re.year='2019' and re.category = 'LS'";
  //            $result4 = mysqli_query($link, $sql4);
  //            while ($row4 = mysqli_fetch_assoc($result4)) {
  //                $count4 = $row4['count'];
  //            }
  ?>
  <!--            <div align="center" style="display:none">
                    <strong>UGC: <font style="color:blue;"><a href="export_all.php?type=ugc"><?php echo $count1; ?></a></font></strong>,
                    <strong>INFLIBNET (Technical): <font style="color:blue;"><a href="export_all.php?type=inflibnet_cs"><?php echo $count2; ?></a></font></strong>,
                    <strong>INFLIBNET (LS): <font style="color:blue;"><a href="export_all.php?type=inflibnet_ls"><?php echo $count4; ?></a></font></strong>,
                    <strong>INFLIBNET (Administrative): <font style="color:blue;"><a href="export_all.php?type=inflibnet_administrative"><?php echo $count3; ?></a></font></strong>
                </div></br>-->

  <div>
    <table id="example" class="table table-striped table-bordered table-responsive" style="width:100%;">
      <thead>
        <tr>
          <th>Print</th>
          <th>ID</th>
          <th>Name</th>
          <th>DOB</th>
          <th>Bachelor</th>
          <th>Master</th>
          <th>Ph.D/Other Degree</th>
          <th>Qualification</th>
          <th>Experience</th>
          <th>Contact</th>
          <th>Status</th>
          <th>Online Fees</th>
          <th>Submission Date</th>
          <th>Hard Copy Received</th>
        </tr>
      </thead>
      <?php if (isset($_POST['post']) && $_POST['post'] != '') { ?>
        <tbody>
          <?php while ($row9 = mysqli_fetch_assoc($result9)) { ?>
            <tr>
              <td><a href="candidate_application.php?id=<?php echo md5($row9['id']); ?>" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a></td>
              <td><?php echo $row9['id']; ?></td>
              <td><?php echo $row9['name'] . '<br/><b>Caste:</b> ' . $row9['category'] . '<br/><b>Certi No.:</b> ' . $row9['caste_certino'] . '<br/><b>Issue Year:</b> ' . $row9['caste_certi_issue_year']; ?></td>
              <td><?php echo $row9['dob'] . '<br/>(' . $row9['age'] . ')'; ?></td>
              <td>
                <?php
                if ($row9['spec3'] != "") {
                  echo 'Yes';
                } else {
                  echo 'No';
                }
                ?>
              </td>
              <td>
                <?php
                if ($row9['spec4'] != "") {
                  echo 'Yes';
                } else {
                  echo 'No';
                }
                ?>
              </td>
              <td>
                <?php
                if ($row9['spec5'] != "") {
                  echo 'Yes';
                } else {
                  echo 'No';
                }
                ?>
              </td>
              <td><?php
                  if ($row9['spec5'] != "") {
                    echo $row9['edu5'] . ':' . $row9['spec5'] . ',';
                    echo '<br/>Institute:' . $row9['board5'] . ',';
                    echo '<br/>(' . $row9['per5'] . '%) ' . $row9['div5'] . ',';
                    echo '<br/>' . $row9['year5'];
                    echo '<hr>';
                  }
                  if ($row9['spec4'] != "") {
                    echo $row9['edu4'] . ':' . $row9['spec4'] . ',';
                    echo '<br/>Institute:' . $row9['board4'], ',';
                    echo '<br/>(' . $row9['per4'] . '%) ' . $row9['div4'] . ',';
                    echo '<br/>' . $row9['year4'];
                    echo '<hr>';
                  }
                  if ($row9['spec3'] != "") {
                    echo $row9['edu3'] . ':' . $row9['spec3'] . ',';
                    echo '<br/>Institute:' . $row9['board3'], ',';
                    echo '<br/>(' . $row9['per3'] . '%) ' . $row9['div3'] . ',';
                    echo '<br/>' . $row9['year3'];
                    echo '<hr>';
                  }
                  if ($row9['edu7'] != "") {
                    echo $row9['edu7'] . ':' . $row9['spec7'] . ',';
                    echo '<br/>Institute:' . $row9['board7'], ',';
                    echo '<br/>(' . $row9['per7'] . '%) ' . $row9['div7'] . ',';
                    echo '<br/>' . $row9['year7'];
                  }
                  ?>
              </td>

              <td><?php echo $row9['grandtotal'];
                  ?>
                <hr>
                <?php
                if ($row9['org1'] != "") {
                  echo $row9['org1'] . ', ' . $row9['pos1'];
                  echo '<br/>' . $row9['from1'] . ' to ' . $row9['to1'];
                  echo '<br/>' . $row9['pay1'] . '(CTC)';
                  echo '<hr>';
                }
                if ($row9['org2'] != "") {
                  echo $row9['org2'] . ', ' . $row9['pos2'];
                  echo '<br/>' . $row9['from2'] . ' to ' . $row9['to2'];
                  echo '<br/>' . $row9['pay2'] . '(CTC)';
                  echo '<hr>';
                }
                if ($row9['org3'] != "") {
                  echo $row9['org3'] . ', ' . $row9['pos3'];
                  echo '<br/>' . $row9['from3'] . ' to ' . $row9['to3'];
                  echo '<br/>' . $row9['pay3'] . '(CTC)';
                  echo '<hr>';
                }
                if ($row9['org4'] != "") {
                  echo $row9['org4'] . ', ' . $row9['pos4'];
                  echo '<br/>' . $row9['from4'] . ' to ' . $row9['to4'];
                  echo '<br/>' . $row9['pay4'] . '(CTC)';
                  echo '<hr>';
                }
                if ($row9['org5'] != "") {
                  echo $row9['org5'] . ', ' . $row9['pos5'];
                  echo '<br/>' . $row9['from5'] . ' to ' . $row9['to5'];
                  echo '<br/>' . $row9['pay5'] . '(CTC)';
                  echo '<hr>';
                }
                if ($row9['org6'] != "") {
                  echo $row9['org6'] . ', ' . $row9['pos6'];
                  echo '<br/>' . $row9['from6'] . ' to ' . $row9['to6'];
                  echo '<br/>' . $row9['pay6'] . '(CTC)';
                  echo '<hr>';
                }
                if ($row9['org7'] != "") {
                  echo $row9['org7'] . ', ' . $row9['pos7'];
                  echo '<br/>' . $row9['from7'] . ' to ' . $row9['to7'];
                  echo '<br/>' . $row9['pay7'] . '(CTC)';
                  echo '<hr>';
                }
                if ($row9['org8'] != "") {
                  echo $row9['org8'] . ', ' . $row9['pos8'];
                  echo '<br/>' . $row9['from8'] . ' to ' . $row9['to8'];
                  echo '<br/>' . $row9['pay8'] . '(CTC)';
                  echo '<hr>';
                }
                if ($row9['org9'] != "") {
                  echo $row9['org9'] . ', ' . $row9['pos9'];
                  echo '<br/>' . $row9['from9'] . ' to ' . $row9['to9'];
                  echo '<br/>' . $row9['pay9'] . '(CTC)';
                  echo '<hr>';
                }
                if ($row9['org10'] != "") {
                  echo $row9['org10'] . ', ' . $row9['pos10'];
                  echo '<br/>' . $row9['from10'] . ' to ' . $row9['to10'];
                  echo '<br/>' . $row9['pay10'] . '(CTC)';
                  echo '<hr>';
                }
                ?>
              </td>
              <td><?php echo $row9['email'] . ',<br/>' . $row9['mobile']; ?></td>
              <td><?php echo $row9['status_check']; ?><br>
                <?php
                if ($row9['status_check'] != "eligible" && $row9['status_check'] != "") {
                  echo "<b>Remarks:</b> " . $row9['status_remarks'];
                }
                ?></td>
              <td><?php echo $row9['transaction_ref_no']; ?></td>
              <td><?php echo $row9['submission_date']; ?></td>
              <td><?php echo $row9['hard_copy_received']; ?></td>
            </tr>
          <?php } ?>
        </tbody>
      <?php } ?>

    </table>
  </div>
  <?php include 'footer.php'; ?>
  </body>

  </html>
  <script type="text/javascript">
    $("#full_export").click(function() {
      var post = $("#post").val();
      if (post == "") {
        alert("Select Post");
        Event.preventDefault();
      } else {
        $("#form1").submit();

      }

    });

    <?php if (isset($_POST['post']) && $_POST['post'] != '') { ?>
      $('#example').DataTable({
        dom: 'lifrtpB',
        buttons: [{
            extend: 'copyHtml5',
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
            }
          },
          {
            extend: 'excelHtml5',
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
            }
          },
          {
            extend: 'pdfHtml5',
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
            }
          }, {
            extend: 'print',
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
            }
          },
        ]
      });
    <?php } else { ?>
      $('#example').DataTable({
        "columns": [{
          "data": "printapplication",
          "orderable": false,
          "searchable": false,
          "className": "text-center",
          "render": function(data, type, row, meta) { // render event defines the markup of the cell text
            var md5Hash = CryptoJS.MD5(row.id);
            var a = '<a href="candidate_application.php?id=' + md5Hash.toString() + '" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>'; // row object contains the row data
            return a;
          }
        }, {
          "data": "id",
          "defaultContent": "<i>NULL</i>"
        }, {
          //   "data": "postname", "defaultContent": "<i>NULL</i>"
          //}, {
          "data": "name",
          "defaultContent": "<i>NULL</i>"
        }, {
          "data": "dob",
          "defaultContent": "<i>NULL</i>"
        }, {
          "data": "bachelor",
          "defaultContent": "<i>NULL</i>"
        }, {
          "data": "master",
          "defaultContent": "<i>NULL</i>"
        }, {
          "data": "phd",
          "defaultContent": "<i>NULL</i>"
        }, {
          "data": "qualification",
          "defaultContent": "<i>NULL</i>"
        }, {
          "data": "grandtotal",
          "defaultContent": "<i>NULL</i>"
        }, {
          "data": "email",
          "defaultContent": "<i>NULL</i>"
        }, {
          "data": "status_check",
          "defaultContent": "<i>NULL</i>"
        }, {
          "data": "transaction_ref_no",
          "defaultContent": "<i>NULL</i>"
        }, {
          "data": "regdate",
          "defaultContent": "<i>NULL</i>"
        }, {
          "data": "hard_copy_received",
          "defaultContent": "<i>NULL</i>"
        }]

      });
    <?php } ?>

    $('.dt-button').addClass('btn btn-default');
    $(".dt-button").css("margin-top", "10px");

    $('select').on('change', function() {
      $("#example").dataTable().fnDestroy();
      <?php if (isset($_POST['post']) && $_POST['post'] != '') { ?>
        $('#example').DataTable({
          dom: 'lifrtpB',
          buttons: [{
              extend: 'copyHtml5',
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
              }
            },
            {
              extend: 'excelHtml5',
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
              }
            },
            {
              extend: 'pdfHtml5',
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
              }
            }, {
              extend: 'print',
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
              }
            },
          ],
          //"processing": true,
          "ajax": {
            "url": "LoadCandidatesdetails.php",
            "dataSrc": "",
            "data": {
              "post": $(this).val(),
              "location": $('option:selected', this).attr('data-location')
            },
            "type": "POST",
          },
          "columns": [{
            "data": "printapplication",
            "orderable": false,
            "searchable": false,
            "className": "text-center",
            "render": function(data, type, row, meta) { // render event defines the markup of the cell text
              var md5Hash = CryptoJS.MD5(row.id);
              var a = '<a href="candidate_application.php?id=' + md5Hash.toString() + '" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>'; // row object contains the row data
              return a;
            }
          }, {
            "data": "id",
            "defaultContent": "<i>NULL</i>"
          }, {
            //  "data": "postname", "defaultContent": "<i>NULL</i>"
            //}, {
            "data": "name",
            "defaultContent": "<i>NULL</i>"
          }, {
            "data": "dob",
            "defaultContent": "<i>NULL</i>"
          }, {
            "data": "bachelor",
            "defaultContent": "<i>NULL</i>"
          }, {
            "data": "master",
            "defaultContent": "<i>NULL</i>"
          }, {
            "data": "phd",
            "defaultContent": "<i>NULL</i>"
          }, {
            "data": "qualification",
            "defaultContent": "<i>NULL</i>"
          }, {
            "data": "grandtotal",
            "defaultContent": "<i>NULL</i>"
          }, {
            "data": "email",
            "defaultContent": "<i>NULL</i>"
          }, {
            "data": "status_check",
            "defaultContent": "<i>NULL</i>"
          }, {
            "data": "transaction_ref_no",
            "defaultContent": "<i>NULL</i>"
          }, {
            "data": "regdate",
            "defaultContent": "<i>NULL</i>"
          }, {
            "data": "hard_copy_received",
            "defaultContent": "<i>NULL</i>"
          }]
        });
      <?php } else { ?>
        $('#example').DataTable({
          dom: 'lifrtpB',
          buttons: [{
              extend: 'copyHtml5',
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
              }
            },
            {
              extend: 'excelHtml5',
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
              }
            },
            {
              extend: 'pdfHtml5',
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
              }
            },
            {
              extend: 'print',
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
              }
            },
          ],
          //"processing": true,
          "ajax": {
            "url": "LoadCandidatesdetails.php",
            "dataSrc": "",
            "data": {
              "post": $(this).val(),
              "location": $('option:selected', this).attr('data-location')
            },
            "type": "POST",
          },
          "columns": [{
            "data": "printapplication",
            "orderable": false,
            "searchable": false,
            "className": "text-center",
            "render": function(data, type, row, meta) { // render event defines the markup of the cell text
              var md5Hash = CryptoJS.MD5(row.id);
              var a = '<a href="candidate_application.php?id=' + md5Hash.toString() + '" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>'; // row object contains the row data
              return a;
            }
          }, {
            "data": "id",
            "defaultContent": "<i>NULL</i>"
          }, {
            // "data": "postname", "defaultContent": "<i>NULL</i>"
            // }, {
            "data": "name",
            "defaultContent": "<i>NULL</i>"
          }, {
            "data": "dob",
            "defaultContent": "<i>NULL</i>"
          }, {
            "data": "bachelor",
            "defaultContent": "<i>NULL</i>"
          }, {
            "data": "master",
            "defaultContent": "<i>NULL</i>"
          }, {
            "data": "phd",
            "defaultContent": "<i>NULL</i>"
          }, {
            "data": "qualification",
            "defaultContent": "<i>NULL</i>"
          }, {
            "data": "grandtotal",
            "defaultContent": "<i>NULL</i>"
          }, {
            "data": "email",
            "defaultContent": "<i>NULL</i>"
          }, {
            "data": "status_check",
            "defaultContent": "<i>NULL</i>"
          }, {
            "data": "transaction_ref_no",
            "defaultContent": "<i>NULL</i>"
          }, {
            "data": "regdate",
            "defaultContent": "<i>NULL</i>"
          }, {
            "data": "hard_copy_received",
            "defaultContent": "<i>NULL</i>"
          }]

        });
      <?php } ?>
      $('.dt-button').addClass('btn btn-default');
      $(".dt-button").css("margin-top", "10px");
    });


    $(document).ready(function() {
      $('select').on('change', function() {
        $.ajax({
          url: 'count_check_status.php',
          type: 'post',
          data: {
            post: $(this).val(),
            job_location: $('option:selected', this).attr('data-location')
          },
          dataType: 'json',
          success: function(response) {
            if (response.totals_verify == null && response.totals_invalid == null && response.totals_hold == null) {
              response.totals_verify = 0;
              response.totals_invalid = 0;
              response.totals_hold = 0;
            }
            document.getElementById('print_status').innerHTML = '<strong> Eligible: <font style="color:blue;">' + response.totals_verify + '</font></strong>, ' +
              '<strong>Not Eligible: <font style="color:blue;">' + response.totals_invalid + '</font></strong>, ' +
              '<strong>Provisionally: <font style="color:blue;">' + response.totals_hold + '</font></strong>';
          }
        });
      });

      // $('#attendance').on('click', function() {
      //     var post_data = $("#post").val();
      //     if (post_data == "") {
      //         alert("Please Select Post");
      //         Event.preventDefault();
      //     } else {
      //         $.ajax({
      //             url: 'attendance.php',
      //             type: 'get',
      //             data: {
      //                 post_data: post_data,
      //             },
      //             success: function(response) {
      //                 console.log(response);
      //                 alert(response);

      //                 var divContents = response;
      //                 var printWindow = window.open('', '', 'height=768,width=1366');
      //                 printWindow.document.write('<html><head><title>Attendance Sheet</title>');
      //                 printWindow.document.write('</head><body >');
      //                 printWindow.document.write(divContents);
      //                 printWindow.document.write('</body></html>');
      //                 printWindow.document.close();

      //                 // Delay print by 1 second
      //                 setTimeout(function() {
      //                     printWindow.print();
      //                 }, 1000);

      //                 // printWindow.print();
      //             }
      //         });

      //     }
      // });

      $('#attendance').on('click', function() {
        var post_data = $("#post").val();
        if (post_data == "") {
          alert("Please Select Post");
          Event.preventDefault();
        } else {
          $.ajax({
            url: 'attendance.php',
            type: 'get',
            data: {
              post_data: post_data,
            },
            success: function(response) {
              var divContents = response;
              var printWindow = window.open('', '', 'height=768,width=1366');
              printWindow.document.write('<html><head><title>Attendance Sheet</title>');
              printWindow.document.write('</head><body>');
              printWindow.document.write(divContents);
              printWindow.document.write('</body></html>');
              printWindow.document.close();
              const checkImagesLoaded = () => {
                const images = printWindow.document.images;
                let loadedImagesCount = 0;
                for (let i = 0; i < images.length; i++) {
                  if (images[i].complete) {
                    loadedImagesCount++;
                  }
                }
                if (loadedImagesCount === images.length) {
                  printWindow.print();
                } else {
                  setTimeout(checkImagesLoaded, 100);
                }
              };
              checkImagesLoaded();
            }
          });
        }
      });
    });
  </script>