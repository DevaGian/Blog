<?php 
	session_start();	
	include "../funzioni_mysql.php";
	include "../login_function.php";
	if(!isset($_COOKIE['utente']))	
		setcookie("utente", "none");
	if(trova_mysql($_COOKIE['utente'], 'Username', 'utente')!=-1)
	{
		$_SESSION['username']=$_COOKIE['utente'];
		$_SESSION['active']=true;
	}
	$pos=trova_mysql($_SESSION['username'], 'Username', 'utente');
	$row=getInfo($pos, 'utente', 'Username');
	$admin=$row['Admin'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include "_header.php"; ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Aggiungi utente</title>
</head>

<body>
<header><?php include "Header.php" ?></header>
<div class="row" id="sotto">
<?php
	if(isset($_SESSION['active']) && $admin==1)	
	{
		include "menu.php";
		include "admin/aggiungi.php";
	}
	else
		include "noaut.php";
	
?>
</div>
<footer class="bs-docs-footer" role="contentinfo"><?php include "footer.php"?></footer>
</body>
</html>