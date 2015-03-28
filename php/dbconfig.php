<?php
$username = "hsys";
$password = "hsyspass1";
$hostname = "localhost";
$database = "hamarlok_local";
$con = mysqli_connect($hostname, $username, $password)
or die(mysql_error());
$db = mysqli_select_db($con,$database)
or die(mysql_error());
?>