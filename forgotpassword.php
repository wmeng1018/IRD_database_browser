<?php
session_start();
$to = $_POST['emails'];
$subject = "Password Recovery Confirmation Code | Inherited Retina Disease Genetic Variant Database";
$headers = "From: meng.wang4@bcm.edu"."\r\n";

$code = rand(100000, 999999);
$_SESSION['code'] = $code;
$_SESSION['email'] = $to;
$message = "To reset your password, enter the below confirmation code carefully:".$code;

if (mail($to, $subject, $message, $headers)) {
  echo '<script type="text/javascript"> alert("Code Successfully Sent To Yout Email ID. Please Check Your Inbox");</script>';
  header("refresh:0; url=enterconfirmationcode.html");
}
else {
  echo '<script type="text/javascript"> alert("Code Could Not Be Sent. Please Check Your Email ID For Mistakes.");</script>';
  header("refresh:0; url=forgotpassword.html");
}
?>
