<?php 
include("dbconfig.php");
include 'sendvmail.php';
if($_POST)
{
$email=$_POST['email'];
$activation=md5($email.time());
$query="UPDATE LogIn set activation='$activation' where UserId='$email'";
mysqli_query($con,$query) or die(mysqli_error($con));
Send_Mail($email,$_POST['fname'],$_POST['lname'],$activation);
print "Mail Sent.";
}
?>