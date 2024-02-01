<?php
session_start();
$email = $_SESSION['email'];
$password = $_POST['pass'];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
//$password = password_hash($password, PASSWORD_DEFAULT);
$mysqli = mysqli_connect("host", "user", "pass", "db", "3306") or die ("Connection Error");
$mysqli->query("update users set password='$hashed_password' where email='$email'");
echo '<script type="text/javascript"> alert("Password Updated. Login Using Username And Password.");</script>';
header("refresh:0; url=index.html");
?>

