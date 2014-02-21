<?php 
	session_start();	
	include "../funzioni_mysql.php";
	include "../login_function.php";
	$ricordato=0;		
	if(remembered()!=-1 && !isset($_SESSION['ricordato']))
	{		
		$row=getInfo(trova_mysql(remembered(),"ID","utente"),'utente','Username');		
		$pos=remembered();
		$_SESSION['username']=$row['Username'];
		$_SESSION['active']=true;
		$_SESSION['ricordato']=true;
		$ricordato=1;	
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
<title>Cambia la tua password</title>
</head>

<body>
<header><?php include "Header.php"; ?></header>
<div class="row" style="margin-top:5%">
	<?php	
			if(isset($_SESSION['active']))
			{
				include "menu.php";
				include "funzioniut/changepsw.php";
			}
			else
				include "noaut.php";
	?>
    
</div>
<footer class="bs-docs-footer" role="contentinfo"><?php include "footer.php"?></footer>
</body>
</html>