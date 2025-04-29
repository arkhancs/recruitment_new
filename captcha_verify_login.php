<?php
session_start();

if (isset($_POST['captcha_code_p'])) {
  if ($_POST['captcha_code_p'] !== $_SESSION['code_p']) {
    echo "false_captcha";
  } else {
    echo "true_captcha";
  }
}
