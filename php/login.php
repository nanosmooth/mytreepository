<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<meta content='width=device-width, initial-scale=1.0' name='viewport'/>
<link rel="stylesheet" href="../css_data/indexstyle.css" />
<link rel="shortcut icon" href="../img_data/favicon.ico" type="image/x-icon">
<title>Hamarlok - Logging In</title>
</head>
<body>


<div id="hamarlokbranding">
	Hamarlok
</div>
<div class="container">
<?php 
include("dbconfig.php");

if($_POST)
{
$channel=$_POST['channel'];
if($channel=="fb_login")
{
	$email=$_POST['email'];
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$fb_id=$_POST['fb_id'];
	if($_POST['gender']=="male")$gender='M';else $gender='F';
	$date = date('Y-m-d H:i:s');
	$query="select count(*) as count from user where email='$email'";
	$result=mysqli_query($con,$query) or die(mysql_error());
	$row = mysqli_fetch_assoc($result);
	if($row['count']==1)
	{
		$query="UPDATE user set fb_id='$fb_id' where email='$email'";
		$update=mysqli_query($con,$query);
		echo "<p class='hl_messages'>Welcome back $fname $lname <img src='http://graph.facebook.com/$fb_id/picture?redirect=1&height=200&width=200&type=large'</p>";
	}
	else 
	{	
	$query="INSERT INTO user (UserId, Email, FirstName,LastName,Gender,CreatedDate,registereddate,lastmodifieddate,Active,FB_ID) VALUES ('$email','$email','$fname','$lname','M',NOW(),NOW(),NOW(),1,'$fb_id')";
	$insert=mysqli_query($con,$query) or die(mysql_error());
	if($insert)echo "<p align='center'>Welcome $fname $lname <img src='http://graph.facebook.com/$fb_id/picture?redirect=1&height=200&width=200&type=large' /></p>";
		else die(mysql_error());
	}
}
if($channel=="hl_login")
{
	$email=mysqli_real_escape_string($con,$_POST['email']);
	$query="SELECT salt as salt FROM LogIn WHERE userid='$email'";
	$result=mysqli_query($con,$query) or die(mysql_error());
	$row=mysqli_fetch_assoc($result);
	$salt=$row['salt'];
    $password=mysqli_real_escape_string($con,sha1($_POST['password'].$salt));
    $query="SELECT count(*) as count, ActiveState as activestate FROM LogIn WHERE userid='$email' and password='$password'";
   $result=mysqli_query($con,$query) or die(mysql_error());
   $row = mysqli_fetch_assoc($result);
	if($row['count']==1 && $row['activestate']=="1")
    {
    	$query="select firstname,lastname,fb_id from user where userid='$email'";
		$result=mysqli_query($con,$query);
		$row = mysqli_fetch_assoc($result);
		$fname=$row['firstname'];
		$lname=$row['lastname'];
		$fb_id=$row['fb_id'];
    	echo "<p class='hl_messages'>Welcome back $fname $lname <img src='http://graph.facebook.com/$fb_id/picture?redirect=1&height=200&width=200&type=large' /></p>";
    }
    else if($row['count']==1 && $row['activestate']=="0")
    {
    	echo "<p class='hl_messages'>Email Verification is pending. Please complete Email Verification by clicking on the link we sent to $email<br/><br/>To resend the verification link click here.</p>";
    }
    else 
    {
    	echo "<p class='hl_messages'>You have entered an invalid email or password. <br/>New user?<br/> Please Log In with Facebook or Sign Up by going back to:<br /> <a href='../index.php'>Log In / Sign Up page</a>.</p>";
    	
    }
    
}

}
else 
header('Location: ../index.php');
?>
</div>
</body>
</html>