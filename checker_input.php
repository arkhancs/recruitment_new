<?php
function is_malicious($value)
{
  return preg_match('/<[^>]*script|on\w+=|<[^>]*>|javascript:/i', $value);
}

// function clean_and_validate($link, $value, $field_name)
// {
//   $value = trim($value);
//   if (is_malicious($value)) {
//     echo "<script>alert('Invalid input in \"$field_name\". HTML/JS code is not allowed.'); history.back();</script>";
//     exit;
//   }
//   return htmlspecialchars(mysqli_real_escape_string($link, $value), ENT_QUOTES, 'UTF-8');
// }

function clean_input($link, $value, $field_name)
{
  $value = trim($value);
  if (is_malicious($value)) {
    echo "<script>alert('Invalid input in \"$field_name\". HTML/JS code is not allowed.'); window.location.href = 'application.php';</script>";

    exit;
  }
  return htmlspecialchars(mysqli_real_escape_string($link, $value), ENT_QUOTES, 'UTF-8');
}
