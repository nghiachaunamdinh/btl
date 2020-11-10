<?php
include "storage/PHPMailer-master/src/PHPMailer.php";
include "storage/PHPMailer-master/src/Exception.php";
include "storage/PHPMailer-master/src/OAuth.php";
include "storage/PHPMailer-master/src/POP3.php";
include "storage/PHPMailer-master/src/SMTP.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer;

$mail->isSMTP();                            // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                     // Enable SMTP authentication
$mail->Username = 'trinhthihuongnamdinh@gmail.com';          // SMTP username
$mail->Password = 'trongdac.'; // SMTP password
$mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                          // TCP port to connect to

$mail->setFrom('it1k58utc@gmail.com.com', 'Hospital UTC');
$mail->addReplyTo('it1k58utc@example.com', 'Hospital UTC');
$mail->addAddress($_GET['email']);   // Add a recipient
$mail->addCC('it1k58utc@example.com');
$mail->addBCC('it1k58utc@example.com');

$mail->isHTML(true);  // Set email format to HTML

$bodyContent = '<h1>Email xác nhận lấy đặt lại mật khẩu trang web Quản lý thuốc UTC</h1>';
$bodyContent .= "<p>Hãy đăng nhập mã của bạn là <b style='color:red;'>".$_GET['value']."  </b></p>";

$mail->Subject = 'Hospital UTC';
$mail->Body    = $bodyContent;

if($mail->send()) {
    header("Location:nhap_maxn.php?manv=".$_GET['manv']);
}
?>