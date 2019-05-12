<?php
 
$username = "";
$password1 = "";
$password2 = "";
$errors = array (
		'username' => "",
		'password1' => "",
		'password2' => ""
);
 
// HTTP method POST means that form was submitted. Only then we can process the data that was sent in it.
if($_SERVER["REQUEST_METHOD"] == "POST"){
	
require_once "UserHandler.php";      

    // Check input errors before inserting in database
    if(validateForm()){ 
       	$registrationResult = registerUser($_POST["username"],$_POST["password1"]);
    	
    	if(!empty($registrationResult['result'])){    		
     		header("location: login.php");
    	}
    }  
}

function validateForm(){
	
	// Validate username
	if(empty(trim($_POST["username"]))){
		$errors['username'] = "Wpisz poprawną nazwę.";
	} else{
		$username = $_POST["username"];		
	}
	
	// Validate password
	$password1 = trim($_POST["password1"]);
	if(empty($password1) || strlen($password1) < 8){
		$errors['password1'] = "Wpisz poprawne hasło mające przynajmniej 8 znaków.";	
	}
		
	
	// Validate confirm password
	if(empty(trim($_POST["password2"]))){
		$errors['password2'] = "Potwierdź hasło.";
	} else{
		$password2 = trim($_POST["password2"]);
		if($password1 != $password2){
			$password2 = "Hasła nie pasują do siebie.";
		}
	}	
	
	if(empty($errors['username']) && empty($errors['password1']) && empty($errors['password2'])){
		$existinguser = verifyLoginCredentials($username,"");		
		if(empty($existinguser['errors']) && $existinguser['result'] != $username){
			return true;
		}else{
			$errors['username'] = "Podany użytkownik już istnieje. - ".$existinguser['errors'];
		}
	} 
	echo $errors['password1']." | ".$errors['password2']." | ".$errors['username'];
	return false;
	
}

require_once "RegisterFormView.php";
?>
 
