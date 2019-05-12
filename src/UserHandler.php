<?php
	require_once "DbConnector.php";
	
	
	function registerUser($usernameToSave, $passwordToSave){	
		
		$result = array (
				"result"  => "",
				"errors" => ""
		);
		$connection = connectToDB();
		// Prepare an insert statement
		$sql = "INSERT INTO users (user_name, user_pw) VALUES (?, ?)";
		$stmt = mysqli_prepare($connection, $sql);
			
		if($stmt){
			// Bind variables to the prepared statement as parameters
			mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
			
			// Set parameters
			$param_username = $usernameToSave;
			$param_password = password_hash($passwordToSave, PASSWORD_DEFAULT); // Creates a password hash
			
			// Attempt to execute the prepared statement
			if(mysqli_stmt_execute($stmt)){
				// Redirect to login page				
				$result['result'] = 'success';				
			} else{
				$result['errors'] = "Cos poszło nie tak.";				
			}
			mysqli_stmt_close($stmt);
		}	
		
		//Close connection
		closeDBConnection($connection);
		
		return $result;
	}
	
	function removeUser(){
		//TODO: removing user from database
	}
	
	function updateUser(){
		//TODO: editing user data
	}
	
	function  verifyLoginCredentials($username,$password){
		
		$connection = connectToDB();
		
		$result = array (
				"result"  => "",
				"errors" => ""
		);
		
		// Prepare a select statement		
		$sql = "SELECT user_id, user_name, user_pw FROM users WHERE user_name = ?";		
		$stmt = mysqli_prepare($connection, $sql);		
		
		if($stmt){				
			mysqli_stmt_bind_param($stmt, "s", $param_username);
			
			$param_username = trim($username);
			
			// Attempt to execute the prepared statement
			if(mysqli_stmt_execute($stmt)){	
				mysqli_stmt_store_result($stmt);	
				if(mysqli_stmt_num_rows($stmt) == 1 and !empty($password)){		
					mysqli_stmt_bind_result($stmt, $res_id, $res_name, $res_pw);
					//password in database is hashed so we need special function to compare it with password from the form
					if(mysqli_stmt_fetch($stmt)  &&  password_verify($password, $res_pw)){
						$result["result"] = $res_id;	
					}else{
						$result["errors"] = "Niepoprawne dane logowania";
					}					
				}elseif(mysqli_stmt_num_rows($stmt) == 1 && empty($password)){
					$result["errors"] = "Użytkownik już istnieje";
					$result["result"] = trim($username);
				}
			} else{
				array_push($result["errors"] , "Połączenie z bazą danych nie było możliwe");
			}
			mysqli_stmt_close($stmt);
		}
		//Close connection
		closeDBConnection($connection);
		
		return $result;
	}
	
	
	function isUserLoggedIn(){
		if(!isset($_SESSION)){
			session_start();
		}
		return isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true;
	}
	
	function logOffUser(){
		$_SESSION["loggedin"] = false;
		$_SESSION["id"] = "";
		$_SESSION["username"] = "";		
	}
	
?>