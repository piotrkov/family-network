<?php
?>
<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>Dodaj osobę</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
	<link rel="stylesheet" href="src/css/node.css">
</head>
<body>
    <div class="form-wrapper">
        <h2>Dane Osoby</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($errors['firstname'])) ? 'has-error' : ''; ?>">
                <label>Imię</label>
                <input type="text" name="firstname" class="form-control" value="<?php echo $node['firstname']; ?>">
                <span class="help-block"><?php echo $errors['firstname']; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($errors['secondnames'])) ? 'has-error' : ''; ?>">
                <label>Drugie Imię/Imiona</label>
                <input type="text" name="secondnames" class="form-control" value="<?php echo $node['secondnames'];?>">
                <span class="help-block"><?php $errors['secondnames']; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($errors['surname'])) ? 'has-error' : ''; ?>">
                <label>Nazwisko</label>
                <input type="text" name="surname" class="form-control" value="<?php echo $node['surname'];?>">
                <span class="help-block"><?php $errors['surname']; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($errors['maidenname'])) ? 'has-error' : ''; ?>">
                <label>Nazwisko Panieńskie</label>
                <input type="text" name="maidenname" class="form-control" value="<?php echo $node['maidenname'];?>">
                <span class="help-block"><?php $errors['maidenname']; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($errors['description'])) ? 'has-error' : ''; ?>">
                <label>Historia</label>
                <input type="text" name="description" class="form-control" value="<?php echo $node['description'];?>">
                <span class="help-block"><?php $errors['description']; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($errors['datebirth'])) ? 'has-error' : ''; ?>">
                <div><label>Data Urodzenia</label></div>
                <div class="form-date">rok<input type="text" name="datebirthyear" class="form-control" value="<?php echo $datebirthyear;?>" maxlength="4" size="4"></div>
                <div class="form-date">miesiąc<input type="text" name="datebirthmonth" class="form-control" value="<?php echo $datebirthmonth;?>" maxlength="2" size="2"></div>
                <div class="form-date">dzień<input type="text" name="datebirthday" class="form-control" value="<?php echo $datebirthday;?>" maxlength="2" size="2" > </div>
                <span class="help-block"><?php $errors['datebirth']; ?></span>
                <br/><br/><br/>
            </div>
            <div class="form-group <?php echo (!empty($errors['datedeath'])) ? 'has-error' : ''; ?>">
                <div><label>Data Śmierci</label></div>
                <div class="form-date">rok<input type="text" name="datedeathyear" class="form-control" value="<?php echo $datedeathyear;?>" maxlength="4" size="4" ></div>
                <div class="form-date">miesiąc<input type="text" name="datedeathmonth" class="form-control" value="<?php echo $datedeathmonth;?>" maxlength="2" size="2" ></div>
                <div class="form-date">dzień<input type="text" name="datedeathday" class="form-control" value="<?php echo $datedeathday;?>" maxlength="2" size="2" > </div>
                <span class="help-block"><?php $errors['datedeath']; ?></span>
                <br/><br/><br/>
            </div> 
            <input type="hidden" id="nodeId" name="nodeId" value="<?php echo $node['id'];?>">                       
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Zapisz">
            </div>            
        </form>
    </div>    
</body>
</html>