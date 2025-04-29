<?php session_start(); 

if ($_SESSION['code']==$_POST['code']) {
    
	
  echo json_encode("true");
}
else{
     echo json_encode("false");
}
?>