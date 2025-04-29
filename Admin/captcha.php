<?php
session_start();
//$captcha_num=rand(1000,9999);
  $captcha_num = '0123456789';
  $captcha_num = substr(str_shuffle($captcha_num), 0, 6);
$_SESSION['code']=$captcha_num;

$font_size=30;
$img_width=70;
$img_height=30;


        $image = imagecreate($img_width, $img_height);
        $black = imagecolorallocate($image, 0, 0, 0);
        $white = imagecolorallocate($image, 255, 255, 255);
        $font_size = 14;

        imagestring($image, $font_size, 5, 5, $captcha_num, $white);
        header('Content-type: image/jpeg');
        imagejpeg($image, null, 80);
        
        
        
    
?>