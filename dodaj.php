<?php
require_once 'src/UserHandler.php';

if(!isUserLoggedIn()){
	header("location: login.php");
	exit;
}else{
	include_once 'src/NodeFormHandler.php';
}
?>