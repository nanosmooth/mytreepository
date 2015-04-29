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
<title>Hamarlok - Activation</title>
</head>
<body>


<style>
body
{
padding-top:161px;
}
</style>


	<nav class="navbar navbar-default navbar-fixed-top navbar-hamarlok">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header" id="brand_shrinkable">
      <a class="navbar-brand navbar-brand-hamarlok-shrink" href="#">
      <span style="color:blue">H </span>
      <span style="color:orange">A </span>
      <span style="color:blue">M </span>
      <span style="color:mediumseagreen">A </span>
      <span style="color:red">R </span>
      <span style="color:mediumseagreen">L </span>
      <span style="color:orange">O </span>
      <span style="color:red">K</span>
      </a>
    </div>
  </div><!-- /.container-fluid -->
</nav>
<div class="container-fluid"> 
    <div class="row">
    <div class="col-md-4 col-xs-12  col-centered ">
<?php
include("dbconfig.php");
$msg='';
if(!empty($_GET['code']) && isset($_GET['code']))
{
$code=mysqli_real_escape_string($con,$_GET['code']);
$result=mysqli_query($con,"SELECT activestate FROM login WHERE activation='$code'");
$row = mysqli_fetch_assoc($result);
if($row['activestate']=='1')
	$msg ="<div class='alert alert-info' role='alert'>Your account is already active. Please <a href='../index.php' class='alert-link'>Log In</a></div>";
else if($row['activestate']=='0')
{
	mysqli_query($con,"UPDATE login SET activestate='1' WHERE activation='$code'");
	$msg="<div class='alert alert-info' role='alert'>Your account is activated. Please <a href='../index.php' class='alert-link'>Log In</a></div>";
}
else
{
$msg ="<div class='alert alert-warning' role='alert'>Invalid activation code. Go back to <a href='../index.php' class='alert-link'>Sign Up / Log In</a></div>";
}
echo $msg;
}
else 
	header('Location: ../index.php');
?></div></div>
</div>
</body>