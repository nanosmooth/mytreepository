<?php session_start()?>
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
	        scope: 'publish_stream,email'
	    });
	}

</script>
<title>Welcome to Hamarlok</title>
</head>

    <body>
<?php 
if(!($_SESSION))
{ 
?>
<script type="text/javascript" src="js_data/dob_picker.js"></script>
<script type="text/javascript" src="js_data/validator.js"></script>
     
	<div class="container-fluid navbar navbar-default hl-branding">
	<h1>H a m a r l o k</h1>
	
	</div>
	<div class="container-fluid"> 
    <div class="row">
    <div class="col-md-4 col-xs-12  col-centered ">
	<form><input type="submit" Value="Facebook Login" onclick="fb_login();" class="btn btn-default btn-lg btn-block fb-login-btn"/>
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
	Sign Up
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
	
	$fname=$_SESSION['fname'];
?>

	<div class="registered">
	<div id="hamarlokbranding">
	<div id="sitetitle">H a m a r l o k</div>
	 <div id="topdash">
 <?php 
	  if(isset($_SESSION['fb_id']))
	  {$fb_id=$_SESSION['fb_id'];
	   echo "<div id='mythumbnail'><img src='http://graph.facebook.com/$fb_id/picture?redirect=1&height=32&width=32' width=32px height=32px/></div>";
	  }
	  else if($_SESSION['gender']=='M')
	  {echo "<div id='mythumbnail'><img src='img_data/silhe.png' width=32px height=32px/></div>";}
	  	else if($_SESSION['gender']=='F')
	  	{echo "<div id='mythumbnail'><img src='img_data/silshe.png' width=32px height=32px/></div>";}
	 ?>	

	 
	  <form action="php/logout.php" name="logout_form" method="POST">
	 <input type="submit" value="Log Out"/>
	 </form> 
	 </div><!-- top dash ends here -->
	 </div><!-- hamarlokbranding ends here -->
	 
	 <div id="familyfield"></div>
     <script type="text/javascript" src="js_data/gen_fam.js"></script>
	 </div><!-- registered ends here -->
	 
	               	   
<?php    
}
?>



    </body>


</html>