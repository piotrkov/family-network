<?php
require_once 'src/UserHandler.php';

if(!isUserLoggedIn()){
	//TODO: set node id that is taken from node in the graph
	header("location: login.php");
	exit;
}else{
	include_once 'src/NodeFormHandler.php';
}
?>