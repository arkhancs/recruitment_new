<?php
session_start();
$filename = $_GET['file'];//'sign/SBLS-1-2022-16222-sign.jpg';
if (isset($_SESSION)) {
	 $app_id = $_SESSION['app_id'];
	 //if($filename.contains($app_id)){
	if(strpos($filename,$app_id)) {
		$filepath = '/uploads/'.$filename;
		$url = "https://recruitment.inflibnet.ac.in/uploads/".$filename;
		$file_basename = basename($url);
		header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
		header("Cache-Control: public"); // needed for internet explorer
		header("Content-Type: application/octet-stream");
		header("Content-Transfer-Encoding: Binary");
		header("Content-Length:".filesize($filepath));
		header("Content-Disposition: attachment; filename=".$file_basename);
		readfile($filepath);
		die(); 
		//header('location:'.$url);
		//file_put_contents($file_basename, file_get_contents($url));
	 } else {
		 header('location: https://recruitment.inflibnet.ac.in/index.php');
	 }
}else{
	header('location: https://recruitment.inflibnet.ac.in/index.php');
}
?>