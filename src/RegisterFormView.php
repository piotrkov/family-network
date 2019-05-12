<?php ?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<title>Formularz Rejestracji</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
		<link rel="stylesheet" href="src/css/user.css">
	</head>
	<body>
		<div class="form-wrapper">
			<h2>Rejestracja</h2>
			<p>Wypełnij poniższy formularz w celu utworzenia konta</p>
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			
				<div class="form-group <?php echo (!empty($errors['username'])) ? 'has-error' : ''; ?>">
					<label>Nazwa użytkownika</label>
					<input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
					<span><?php echo $errors['username']; ?></span>
		        </div>
		            
	        	<div class="form-group <?php echo (!empty($errors['password1'])) ? 'has-error' : ''; ?>">
	                <label>Hasło</label>
	                <input type="password" name="password1" class="form-control" value="<?php echo $password1; ?>">
	                <span class="help-block"><?php echo $errors['password1']; ?></span>
	            </div>
	            
	            <div class="form-group <?php echo (!empty($errors['password2'])) ? 'has-error' : ''; ?>">
	                <label>Potwierdź Hasło</label>
	                <input type="password" name="password2" class="form-control" value="<?php echo $password2; ?>">
	                <span class="help-block"><?php echo $errors['password2']; ?></span>
	            </div>
	            
	            <div class="form-group">
	                <input type="submit" class="btn btn-primary" value="Wyslij">
	                <input type="reset" class="btn btn-default" value="Wyczysć">
	            </div>      
	                  
	        </form>
	    </div>    
	</body>
</html>