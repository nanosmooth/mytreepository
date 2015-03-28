<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<meta content='width=device-width, initial-scale=1.0' name='viewport'/>
<link rel="stylesheet" href="../css_data/indexstyle.css" />
<link rel="shortcut icon" href="../img_data/favicon.ico" type="image/x-icon">
<title>Hamarlok - Sign Up</title>
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
	$email=$_POST['email_id'];
	$fname=$_POST['f_name'];
	$lname=$_POST['l_name'];
	$gender=$_POST['gender'];
	$dob_m=$_POST['dob_month'];
	$dob_d=$_POST['dob_day'];
	$dob_y=$_POST['dob_year'];
	$dob=$dob_d.'-'.$dob_m.'-'.$dob_y;
	$dob=date('Y-m-d', strtotime($dob));
	$date = date('Y-m-d H:i:s');
	$salt=$bytes = openssl_random_pseudo_bytes(20);
	$date = date('Y-m-d H:i:s');
	$password=mysqli_real_escape_string($con,sha1($_POST['passcode'].$salt));
	$activation=md5($email.time());
	
	$query="SELECT count(*) as count, ActiveState as activestate FROM LogIn WHERE userid='$email'";
	$result=mysqli_query($con,$query) or die(mysql_error());
	$row = mysqli_fetch_assoc($result);
	if($row['count']==1 && $row['activestate']=='1')
	{
	echo "<p class='hl_messages'>You already seem to be registered. Please try to Log In by going back to:<br /> <a href='../index.php'>Log In / Sign Up page</a>.</p>";
	
	}
	else if ($row['count']==1 && $row['activestate']=='0')
	{
		echo "<p class='hl_messages'>You already seem to be registered. Please complete Email Verification by clicking on the link we sent to $email<br/><br/>To re-send the verification link click here.</p>";
	}
	else
	{
		$query="INSERT INTO LogIn (UserId, password, salt,activation) VALUES ('$email','$password','$salt','$activation')";
		mysqli_query($con,$query) or die(mysql_error());
		$result=mysqli_query($con,"select count(*) as count from user where email='$email'");
		$row=mysqli_fetch_assoc($result);
		if($row['count']==1)//also fb user
		{
		 mysqli_query($con,"UPDATE user set BirthDate='$dob',lastmodifieddate=NOW() where userid='$email'");
		}
		else 
		mysqli_query($con,"INSERT INTO user (UserId, Email, FirstName,LastName,Gender,CreatedDate,registereddate,lastmodifieddate,Active,birthdate) VALUES ('$email','$email','$fname','$lname','$gender',NOW(),NOW(),NOW(),1,'$dob')");
		include 'sendvmail.php';
		$to=$email;
		$subject="Hamarlok Email verification";
		$base_url="http://localhost/workspace/hamarlok/php/";
		$body='Hi '.$fname.' '.$lname.', <br/> <br/>Please verify your email and get started with your Hamarlok account setup. Click on the following link for verification: <br/> <br/> <a href="'.$base_url.'activation.php?code='.$activation.'">'.$base_url.'activation.php?code='.$activation.'</a>';
		Send_Mail($to,$subject,$body);
		echo "<p class='hl_messages'>Sign Up almost done!<br /><br />Please complete Email Verification by clicking on the link we sent to $email</p>";
	}
}
else
header('Location: ../index.php');
?>
</div>
</body>
</html>