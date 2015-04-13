<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<meta content='width=device-width, initial-scale=1.0' name='viewport'/>

<link rel="shortcut icon" href="../img_data/favicon.ico" type="image/x-icon">
<!-- botstrap headers -->
 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- Bootstrap -->
    <link href="../css_data/btsp/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<!-- bootstrap headers end -->
<link rel="stylesheet" href="../css_data/indexstyle.css" />    
<title>Hamarlok - Sign Up</title>
</head>
<body>


<div class="container-fluid navbar navbar-default hl-branding">
	
	<h1>H a m a r l o k</h1>
	</div>
<div class="container-fluid"> 
    <div class="row">
    <div class="col-md-4 col-xs-12  col-centered">
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
	echo "<div class='alert alert-info' role='alert'>You already seem to be registered. Please try to Log In by going back to:<br /> <a href='../index.php' class='alert-link'>Log In / Sign Up page</a>.</div>";
	
	}
	else if ($row['count']==1 && $row['activestate']=='0')
	{
		echo "<div class='alert alert-info' role='alert'>You already seem to be registered. Please complete Email Verification by clicking on the link we sent to $email<br/><br/>To re-send the verification link click here.</div>";
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
		Send_Mail($email,$fname,$lname,$activation);
		echo "<div class='alert alert-info' role='alert'>Sign Up almost done!<br /><br />Please complete Email Verification by clicking on the link we sent to $email</div>";
	}
}
else
header('Location: ../index.php');
?>
</div></div></div>
</body>
</html>