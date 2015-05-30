<?php
function profile_image_32()
{
	if(isset($_SESSION['fb_id']))
	{
		$fb_id=$_SESSION['fb_id'];
		echo "<img src='http://graph.facebook.com/$fb_id/picture?redirect=1&height=64&width=64' class='nav-pic'/>";
	}
	else
	{
		echo "<span class='glyphicon glyphicon-user nav-pic' aria-hidden='true'></span>";
	}  	
}	

function profile_image_128()
{
	if(isset($_SESSION['fb_id']))
	{
		$fb_id=$_SESSION['fb_id'];
		echo "<img src='http://graph.facebook.com/$fb_id/picture?redirect=1&height=200&width=200' class='rs'/>";
	}
	else
	{
		echo "<span class='glyphicon glyphicon-user' aria-hidden='true'></span>";
	}
}
?>