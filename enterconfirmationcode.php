<?php
session_start();
$code = $_SESSION['code'];
$email = $_SESSION['email'];
$user_code = $_POST['code'];
if ($code==$user_code) {
  header("refresh:0; url=resetpassword.html");
}
else {
  echo '<script type="text/javascript"> alert("Invalid Confirmation Code. Please Enter The Correct Confirmation Code.");</script>';
  header("refresh:0; url=enterconfirmationcode.html");
}
?>
