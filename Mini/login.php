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
	}
	
	
?>

<!DOCTYPE html>
<html>
<head>
<?php include "_header.php"; ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LogIn</title>

    
  </head>
  <body>
  <header><?php include "Header.php"; ?> </header>
  <div class="row" id="sotto">
  <div class="col-sm-3 col-md-3"></div>
  <?php
  	if(isset($_SESSION['active']))
		include "login/active.php";
	else
		include "login/login.php";
  ?>  
    <div class="col-sm-3 col-md-3"></div> 
    </div>    

</body>
<footer class="bs-docs-footer" role="contentinfo"><?php include "footer.php"?></footer>
</html>
