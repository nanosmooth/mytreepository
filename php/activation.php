<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<meta content='width=device-width, initial-scale=1.0' name='viewport'/>
<link rel="stylesheet" href="../css_data/indexstyle.css" />
<link rel="shortcut icon" href="../img_data/favicon.ico" type="image/x-icon">
<title>Hamarlok - Activation</title>
</head>
<body>


<div id="hamarlokbranding">
	Hamarlok
</div>
<div class="container">
<?php
include("dbconfig.php");
$msg='';
if(!empty($_GET['code']) && isset($_GET['code']))
{
$code=mysqli_real_escape_string($con,$_GET['code']);
$result=mysqli_query($con,"SELECT activestate FROM login WHERE activation='$code'");
$row = mysqli_fetch_assoc($result);
if($row['activestate']=='1')
	$msg ="Your account is already active. Please <a href='../index.php'>Log In</a>";
else if($row['activestate']=='0')
{
	mysqli_query($con,"UPDATE login SET activestate='1' WHERE activation='$code'");
	$msg="Your account is activated. Please <a href='../index.php'>Log In</a>";
}
else
{
$msg ="Invalid activation code. Go back to <a href='../index.php'>Sign Up / Log In</a>";
}
echo $msg;
}
else 
	header('Location: ../index.php');
?>
</div>
</body>