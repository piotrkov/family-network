<?php 

function connectToDB(){
	// Database access information
	require_once "./dbconfig.php";
	
	$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
	 
	if($connection === false){
	    die("ERROR: Unable to connect to database. " . mysqli_connect_error());
	}else{
		return $connection;
	}	
}

function closeDBConnection($con){
	mysqli_close($con);
}


?>