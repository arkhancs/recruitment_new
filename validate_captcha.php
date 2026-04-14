<?php
// session_start();

// if ($_SESSION['code'] == $_POST['code']) {


//   echo json_encode("true");
// } else {
//   echo json_encode("false");
// }
// 
?>


<?php
echo 'Submitted code: ' . $_POST['code'];
echo 'Session code: ' . $_SESSION['code'];


session_start();
if ($_SESSION['code'] == $_POST['captcha_code']) {
  $_SESSION['captcha_validated'] = true;
} else {
  $_SESSION['captcha_validated'] = false;
}
header("Location: application_form.php");
exit();
?>

