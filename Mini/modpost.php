<?php
	session_start();	
	if(!isset($_COOKIE['utente']))	
		setcookie("utente", "none");			
	include "../funzioni_mysql.php";
	include "../login_function.php";	
	if(trova_mysql($_COOKIE['utente'], 'Username', 'utente')!=-1)
	{
		$_SESSION['username']=$_COOKIE['utente'];
		$_SESSION['active']=true;
		$pos = trova_mysql($_SESSION['username'], "Username", "utente");	
		$row=getInfo($pos, 'utente', 'ID');		
		$admin=$row['Admin'];
	}	
?>

<!DOCTYPE html>
<html>
<head>
<?php include "_header.php"; ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pubblica</title>

    
</head>
  <body>
<header><?php include "Header.php"; ?> </header>

<div class="row" id="sotto">
<?php 
		if(isset($_SESSION['active']) && (isset($admin) && $admin==1))
		{			
				include "menu.php";
				include "admin/modpost.php";
							
		}
		else
			include "noaut.php";
?>

</div>
</body>
<footer class="bs-docs-footer" role="contentinfo"><?php include "footer.php"?></footer>
</html>