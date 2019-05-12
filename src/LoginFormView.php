<?php
?>
<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>Logowanie</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
	<link rel="stylesheet" href="src/css/user.css">
</head>
<body>
    <div class="form-wrapper">
        <h2>Logowanie</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($errors['username'])) ? 'has-error' : ''; ?>">
                <label>Nazwa użytkownika</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $errors['username']; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($errors['password'])) ? 'has-error' : ''; ?>">
                <label>Hasło</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php $errors['password']; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Zaloguj">
            </div>
            <a href="register.php">Rejestracja</a>
        </form>
    </div>    
</body>
</html>