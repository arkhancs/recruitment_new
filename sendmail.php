
<?php

ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer\src\Exception.php';
require 'PHPMailer\src\PHPMailer.php';
require 'PHPMailer\src\SMTP.php';
$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    $mail->SMTPDebug = 1;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'krutidanak96@gmail.com';                 // SMTP username
    $mail->Password = 'krutigmail';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to
    $reg_id = rand(11111111, 99999999);
    //Recipients
    $mail->setFrom('krutidanak96@gmail.com', 'recruitment');
    $mail->addAddress('danakkruti@inflibnet.ac.in');     // Add a recipient
    // Name is optional
    //$mail->addReplyTo('krutidanak96@gmail.com', 'Information');
    //Attachments
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Registration ID';
    $mail->Body = "Your Registration ID is $reg_id.";


    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    
}
?>