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
<script type="text/javascript" src="../js_data/jquery.min.js"></script>
<title>Hamarlok - Logging In</title>
</head>
<body>
<div class="container-fluid navbar navbar-default hl-branding">
	
	<h1>H a m a r l o k</h1>
	</div>
<div class="container-fluid"> 
    <div class="row">
    <div class="col-md-4 col-xs-12  col-centered ">
<?php 
include("dbconfig.php");
session_start();
if($_POST)
{
$channel=$_POST['channel'];
if($channel=="fb_login")
{
	$email=$_POST['email'];
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$fb_id=$_POST['fb_id'];
	$_SESSION['fname']=$fname;
	$_SESSION['fb_id']=$fb_id;
	$_SESSION['gender']=$gender;
	if($_POST['gender']=="male")$gender='M';else $gender='F';
	$date = date('Y-m-d H:i:s');
	$query="select count(*) as count from user where email='$email'";
	$result=mysqli_query($con,$query) or die(mysql_error());
	$row = mysqli_fetch_assoc($result);
	if($row['count']==1)
	{
		$query="UPDATE user set fb_id='$fb_id' where email='$email' and fb_id IS NULL";
		$update=mysqli_query($con,$query);
		header('Location: ../index.php');
	}
	else 
	{	
	$query="INSERT INTO user (UserId, Email, FirstName,LastName,Gender,CreatedDate,registereddate,lastmodifieddate,Active,FB_ID) VALUES ('$email','$email','$fname','$lname','M',NOW(),NOW(),NOW(),1,'$fb_id')";
	$insert=mysqli_query($con,$query) or die(mysql_error());
	if($insert) header('Location: ../index.php'); else die(mysql_error());
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
   $query="select firstname,lastname,fb_id,gender from user where userid='$email'";
   $result2=mysqli_query($con,$query);
   $row2 = mysqli_fetch_assoc($result2);
   $fname=$row2['firstname'];
   $lname=$row2['lastname'];
   $fb_id=$row2['fb_id'];
   $gender=$row2['gender'];
	if($row['count']==1 && $row['activestate']=="1")
    {
    
		$_SESSION['fname']=$fname;
		$_SESSION['fb_id']=$fb_id;
		$_SESSION['gender']=$gender;
		header('Location: ../index.php');
    }
    else if($row['count']==1 && $row['activestate']=="0")
    {
    	?><script>
    	    	    	function sendVerificationMail() {
    	    	    		$("#mail-status").html("<img src='../img_data/ajax-loader.gif' />");	
    	    		jQuery.ajax({
    	    			url: "resendvmail.php",
    	    			data:{"email":"<?php  print $email; ?>",
    	    			"fname":"<?php  print $fname; ?>",
    	    			"lname":"<?php  print $lname; ?>"
    	    			},
    	    			type: "POST",
    	    			success:function(data){
    	    				$("#mail-status").html(data);
    	    			},
    	    			error:function (){alert("Email was not sent");}
    	    		});
    	    	}</script>
    	    	<?php 
    	echo "<div class='alert alert-warning' role='alert'>Email Verification is pending. Please complete Email Verification by clicking on the link we sent to $email<br/><br/>To resend the verification link <a href='javascript:void(0)' onclick='sendVerificationMail()' class='alert-link'>click here</a>.<br /><br /><div align='center' id='mail-status'></div></div>";
    }
    else 
    {
    	
    	echo "<div class='alert alert-warning' role='alert'>You have entered an invalid email or password.</div><div class='alert alert-info' role='alert'>Please try to <a href='../index.php' class='alert-link'>Log In</a> again or <a href='../index.php' class='alert-link'>Sign Up</a> for Hamarlok if you are a new user.</div>";
    	
    }
    
}

}
else 
header('Location: ../index.php');
?>
</div></div></div>
</body>
</html>