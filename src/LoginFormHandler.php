<?php
session_start();
require_once "UserHandler.php";

if(isUserLoggedIn()){
	header("location: index.php");
    exit;
}
  
$username = "";
$password = "";
$errors = array (
		'username' => "",
		'password' => ""
);
 
// HTTP method POST means that form was submitted. Only then we can process the data that was sent in it.
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is set
    if(empty(trim($_POST["username"]))){
        $errors['username'] = "Wprowadź swoją nazwę użytkownika.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is set
    if(empty(trim($_POST["password"]))){
    	$errors['password'] = "Wprowadź poprawne hasło";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty( $errors['username']) && empty( $errors['password'])){
    	
    	$loginCredentials = verifyLoginCredentials($username,$password);
    	if(empty($loginCredentials['errors']) && !empty($loginCredentials['result'])){
    		// Password is correct, so start a new session    		
    		session_start();
    		
    		// Store data in session variables
    		$_SESSION["loggedin"] = true;
    		$_SESSION["id"] = $loginCredentials['result'];
    		$_SESSION["username"] = $username;
    		
    		// Redirect user to welcome page
    		header("location: index.php");
    	} else{
    		// Display an error message if password is not valid
    		echo $loginCredentials['errors'];
    		echo "Podano niepoprawne hasło.";
    	}     	
    }  
}

require_once 'LoginFormView.php';

?>
 
