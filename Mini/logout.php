<?php session_start()?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>


<body>
<?php 
	include "../funzioni_mysql.php";
	include "../login_function.php";
	$timestamp = date("Y")."-".date("m")."-".date("d")." ".date("H").":".date("i").":".date("s");
	$pos=trova_mysql($_SESSION['username'],"Username","Utente");
	$db=new mysqli('localhost', 'Gianluca', 'prove', 'test');
	$sql="UPDATE `test`.`utente` SET `UltimoAccesso` = '".$timestamp."' WHERE `utente`.`ID` =".$pos.";";
	/*if(!$result=$db->query($sql))
		die("Error: ".$db->error);
	if(remembered()!=-1)			
		forget(remembered());*/
	setcookie('utente', 'none', time()-1);
	
	session_unset(); session_destroy(); header("location: login.php");
	
?>
</body>
</html>