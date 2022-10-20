<?php
//include constant.php for SITEURL
include("../config/constants.php");
//Destory the session
session_destroy();

//Redirect to login page
header("location:".SITEURL.'index.php');

?>