<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<meta content='width=device-width, initial-scale=1.0' name='viewport'/>
<link rel="stylesheet" href="css_data/indexstyle.css" />
<link rel="shortcut icon" href="img_data/favicon.ico" type="image/x-icon">
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
session_start();
if(!($_SESSION))
{ 
?>
<script type="text/javascript" src="js_data/dob_picker.js"></script>
<script type="text/javascript" src="js_data/validator.js"></script>
     <div id="hamarlokbranding">
	<div id="sitetitle">H a m a r l o k</div> 
     </div>
    <div class="container">
	
	<div id="fblogin" class="fbloginbtn"><input type="submit" Value="Facebook Login" onclick="fb_login();"/></div>
	<div class="infowords">
	Sign In
	</div>
	<div id="loginform">
	<form name="log_in_form" method="post" onsubmit="return logInValidate()" action="php/login.php">
	<input type="email" name="email" placeholder="Email" />
	<input type="password" name="password" placeholder="Password" />
	<input type="submit" value="Log In" />
	<input type="text" name="channel" value="hl_login" style="display:none;" />
	</form>
	</div>
	
	<div class="infowords">
	Sign Up
	</div>
	
	<div id="signupform">
	<form name="sign_up_form" method="post" onsubmit="return signUpValidate()" action="php/signup.php">
	<input type="text" name="f_name" placeholder="First Name" />
	<input type="text" name="l_name" placeholder="Last Name" />
	<input type="email" name="email_id" placeholder="Email" />
	<input type="password" name="passcode" placeholder="New Password" />
	<div id="gender"><label><input type="radio" name="gender" id="female" value='F' />Female</label>
	<label><input type="radio" name="gender" id="male" value='M'/>Male</label></div>
	<div id="birthday">Birthday: <select id="dob_month" name="dob_month">
	<option value='0'>Month</option>
	</select>
	<select id="dob_day" name="dob_day">
	<option value='0'>Day</option>
	</select>
	<select id="dob_year" name="dob_year">
	<option value='0'>Year</option>
	</select></div>
	<input type="submit" value="Sign Up" />
	</form>
	</div>
    </div>

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