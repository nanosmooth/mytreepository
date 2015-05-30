<?php session_start();?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<meta content='width=device-width, initial-scale=1.0' name='viewport'/>
<!-- botstrap headers -->
 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- Bootstrap -->
    <link href="css_data/btsp/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<!-- bootstrap headers end -->
<link rel="shortcut icon" href="img_data/favicon.ico" type="image/x-icon">
<link href="css_data/indexstyle.css" rel="stylesheet">
<script type="text/javascript" src="js_data/jquery.min.js"></script>

<script type="text/javascript">
  
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log(response);
   
  }


  window.fbAsyncInit = function() {

  FB.init({
    appId      : '1494255580814371',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.1' // use version 2.1
  		 });
  };

  // Load the SDK asynchronously
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=1494255580814371&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

  
  function fb_login(){
           FB.login(function(response) {
	    	statusChangeCallback(response);
	        if (response.authResponse) {
	            console.log('Welcome!  Fetching your information.... ');
	            console.log(response); // dump complete info
	            access_token = response.authResponse.accessToken; //get access token
	            user_id = response.authResponse.userID; //get FB UID

	            FB.api('/me', function(response) {
	                user_email = response.email; 
	                user_fname = response.first_name;
	                user_lname = response.last_name;
	                user_gender = response.gender;
	                user_fb_id = response.id;
	          // you can store this data into your database. Ant this is where I do
	                var form=$('<form action="php/login.php" name="register" method="post" style="display:none;"><input type="text" name="email" value="' + user_email  + '" /><input type="text" name="fb_id" value="' + user_fb_id  + '" /><input type="text" name="fname" value="' + user_fname  + '" /><input type="text" name="lname" value="' + user_lname  + '" /><input type="text" name="gender" value="' + user_gender + '" /><input type="text" name="channel" value="fb_login" /></form>')
	                $('body').append(form);
	                form.submit();	                
	            });	

	            FB.api(
	            	    "/me/picture",
	            	    {
	            	    	"redirect": false
	            	    },
	            	    function (response) {
	            	      if (response && !response.error) {
	            	        /* handle the result */
		            	        console.log(response);
	            	      }
	            	    }
	            	);
            	          
	        } else {
	            //user hit cancel button
	            console.log('User cancelled login or did not fully authorize.');

	        }
	    }, {
	        scope: 'email'
	    });
	}

  function logOut() {
  var form=$('<form action="php/logout.php"></form>');
		  $('body').append(form);
          form.submit();
  }	

</script>
<title>Welcome to Hamarlok</title>
</head>

    <body>
<?php 
if(!($_SESSION))
{ 
?>
<style>
body
{
padding-top:161px;
}
</style>
<script type="text/javascript" src="js_data/dob_picker.js"></script>
<script type="text/javascript" src="js_data/validator.js"></script>
<script>
$(window).scroll(function() {
	  if ($(document).scrollTop() > 50) {
		  
	    $('#brand_shrinkable a').addClass('navbar-brand-hamarlok-shrink');
	  } else {
	    $('#brand_shrinkable a').removeClass('navbar-brand-hamarlok-shrink');
	  }
	});
</script>     
<nav class="navbar navbar-default navbar-fixed-top navbar-hamarlok">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header" id="brand_shrinkable">
      <a class="navbar-brand navbar-brand-hamarlok" href="#">
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
	<form><input type="submit" Value="Facebook Login" onclick="fb_login();return false;" class="btn btn-default btn-lg btn-block fb-login-btn"/>
	</form>
	<form name="log_in_form" method="post" onsubmit="return logInValidate()" action="php/login.php">
	<p class="b-border font-18">
	Sign In
	</p>
	<input type="email" name="email" placeholder="Email" class="form-control form-group col-b-lessmar"/>
	<input type="password" name="password" placeholder="Password" class="form-control form-group" />
	
	<input type="submit" value="Log In" class="btn btn-default btn-lg btn-block hl-login-btn" />
	<input type="text" name="channel" value="hl_login" style="display:none;" />
	</form>
	
	<form name="sign_up_form" method="post" onsubmit="return signUpValidate()" action="php/signup.php">
	<p class="b-border font-18">
	Create new account
	</p>
	<input type="text" name="f_name" placeholder="First Name" class="form-control form-group col-b-lessmar"/>
	<input type="text" name="l_name" placeholder="Last Name" class="form-control form-group col-b-lessmar"/>
	<input type="email" name="email_id" placeholder="Email" class="form-control form-group col-b-lessmar"/>
	<input type="password" name="passcode" placeholder="New Password" class="form-control form-group col-b-lessmar"/>
	<div class="form-group col-b-lessmar">
	<label class="radio-inline">
	<input type="radio" name="gender" id="female" value='F' />Female
	</label>
	<label class="radio-inline">
	<input type="radio" name="gender" id="male" value='M' />Male
	</label>
	</div>
	<div class="col-lg-3 col-lr-lesspad form-group">
	<p class="font-18">Birthday:</p>
	</div> 
	<div class="col-lg-3 col-sm-4 col-xs-4 col-lr-lesspad"><select id="dob_month" name="dob_month" class="form-control">
	<option value='0'>Month</option>
	</select>
	</div>
	<div class="col-lg-3 col-sm-4 col-xs-4 col-lr-lesspad"><select id="dob_day" name="dob_day" class="form-control">
	<option value='0'>Day</option>
	</select>
	</div>
	<div class="col-lg-3 col-sm-4 col-xs-4 col-lr-lesspad form-group"><select id="dob_year" name="dob_year" class="form-control">
	<option value='0'>Year</option>
	</select>
	</div>
	
	<input type="submit" value="Sign Up" class="btn btn-default btn-lg btn-block hl-signup-btn" />
	</form>
	</div>
    </div>
    </div>

</div><!-- container ends -->
<?php 
} 
else 
{
	require 'php/hamarlok_api.php';
	$fname=$_SESSION['fname'];
?>
<style>
body
{
padding-top:51px;
}
</style>
 <script src="js_data/btsp/bootstrap.min.js"></script>

	<nav class="navbar navbar-default navbar-fixed-top navbar-hamarlok">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header" id="brand_shrinkable">
     <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
      </button>
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
    <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
          <li><?php profile_image_32();?></li>
             <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php print ucfirst($fname).' ';?><span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                 <li><a href='javascript:void(0)' onclick='logOut()'>Log Out</a></li>
              </ul>
            </li>
            </ul>
     </div><!--/.nav-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="container-fluid">
<div class="col-md-6 col-md-offset-3 col-xs-12 family-field">
<div class="row">
<div class="tile person"></div>
<div class="tile connector"><div class="content"><img src="img_data/tconnect.png" class='bg'/></div></div>
<div class="tile person"></div>
</div>

<div class="row">
<div class="tile pad"></div>
<div class="tile connector"></div>
</div>

<div class="row">
<div class="tile pad"></div>
<div class="tile connector"></div>
<div class="tile person"><div class="content"><div class="table"><div class="table-cell"><?php profile_image_128();?></div></div></div><div class="name">Tejus</div></div>
<div class="tile connector"></div>
<div class="tile person"></div>
</div>

<div class="row">
<div class="tile pad"></div>
<div class="tile connector"></div>
</div>

<div class="row">
<div class="tile pad"></div>
<div class="tile connector"></div>
<div class="tile person"></div>
</div>
</div>
</div>
               	   
<?php    
}
?>



    </body>


</html>