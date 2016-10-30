<?php

$hostname = "mysql.jimkj.xyz";
$username = "jkjellan";
$password = "Pickspockets3";
$database = "jimkj_xyz_playground";

$link = mysqli_connect($hostname,$username,$password,$database);
if(mysqli_connect_errno()){
	die("Connect Failed: %s\n" + mysqli_connect_error());
	exit();
}


?>
