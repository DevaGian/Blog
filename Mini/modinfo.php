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
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include "_header.php"; ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Modifica informazioni</title>
</head>

<body>
<header><?php include "Header.php" ?></header>
<?php			
		if(isset($_SESSION['active']))
			include "funzioniut/informazioni.php";
		else
			include "noaut.php";
?>
<footer class="bs-docs-footer" role="contentinfo"><?php include "footer.php"?></footer>
</body>
</html>