function signUpValidate()
{
var ck_fname = /^[A-Za-z0-9 ]{3,20}$/;
var ck_lname = /^[A-Za-z0-9 ]{1,20}$/;
var ck_email = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;
var ck_password =  /^[A-Za-z0-9!@#$%^&*()_]{6,20}$/;
var fn=document.forms["sign_up_form"]["f_name"].value;
var ln=document.forms["sign_up_form"]["l_name"].value;
var em=document.forms["sign_up_form"]["email_id"].value;
var pc=document.forms["sign_up_form"]["passcode"].value;
var mm=document.forms["sign_up_form"]["dob_month"].value;
var dd=document.forms["sign_up_form"]["dob_day"].value;
var yyyy=document.forms["sign_up_form"]["dob_year"].value;
var curr_date=new Date();
var curr_dd=curr_date.getDate();
var curr_mm=curr_date.getMonth()+1;
var curr_yyyy=curr_date.getFullYear();
var isleap = (yyyy % 4 == 0 && (yyyy % 100 != 0 || yyyy % 400 == 0));
if (fn==null || fn=="" || fn=="First Name")
  {
  alert("Invalid First name");
  return false;
  }
  
if (ln==null || ln=="" || ln=="Last Name")
  {
  alert("Invalid Last name");
  return false;
  }
  
if(!ck_fname.test(fn)){alert("Invalid First name, please enter First Name");return false;}
if(!ck_lname.test(ln)){alert("Invalid Last name, please enter Last Name");return false;}
if(!ck_email.test(em)){alert("Invalid Email, please enter Email");return false;}
if(!ck_password.test(pc)){alert("Password must be of min length 6 and max 20 characters");return false;}
if ( !(document.forms["sign_up_form"]["male"].checked) && (!(document.forms["sign_up_form"]["female"].checked) ) ) 
{alert ( "Please select Male or Female" ); return false;}
if(dd==0||mm==0||yyyy==0){alert("Please enter your proper birthday");return false;}
if(dd>curr_dd && mm==curr_mm && yyyy==curr_yyyy){alert("Please enter your proper birthday");return false;}
if(mm>curr_mm && yyyy==curr_yyyy){alert("Please enter your proper birthday");return false;}
if(dd >= 31 && (mm==4||mm==6||mm==9||mm==11)){alert("Please enter your proper birthday");return false;}
if (mm==2 && dd>29 && isleap) {alert("Please enter your proper birthday");return false;}
if (mm==2 && dd>28 && !isleap) {alert("Please enter your proper birthday");return false;}
}

function logInValidate()
{
	var ck_email = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;
	var ck_password =  /^[A-Za-z0-9!@#$%^&*()_]{6,20}$/;
	var em=document.forms["log_in_form"]["email"].value;
	var pd=document.forms["log_in_form"]["password"].value;
	if(!ck_email.test(em)){alert("Invalid Email, please enter Email");return false;}
	if(!ck_password.test(pd)){alert("Password must be of min length 6 and max 20 characters");return false;}
}