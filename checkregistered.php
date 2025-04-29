
<?php
if (!isset($_SERVER['HTTP_REFERER'])) {
    header('location:./index.php');
    exit;
}
error_reporting(E_ALL ^ E_DEPRECATED);
require_once('dbConfig.php');

if (isset($_POST["email"])) {
  
    //$email=$_POST["email"];
    $email = mysql_real_escape_string($_POST['email']);
    // echo $email;
    $query = "select * from prsnl where email='$email'";
   // print($sql);
    $result = mysql_query($query, $link);   
   
   if(mysql_num_rows($result)){

       echo json_encode("true");

    } else {
        echo json_encode("false");
     
    }
   //   echo $res;
}
?>