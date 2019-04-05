<?php
Session_start();
include_once 'connection.php';
$uemail = $_SESSION['useremail'];
$q = "UPDATE `usersinfo` SET `isonline`='false' WHERE email='$uemail'";
mysqli_query($conn,$q);
Session_destroy();
header('Location: ' . $_SERVER['HTTP_REFERER']);

?>