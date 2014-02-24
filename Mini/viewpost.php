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
	$row=getInfo($_GET['id_post'], 'post', 'id_post');
?>

<!DOCTYPE html>
<html>
<head>
<?php
	if( (!isset($_GET['id_post'])) || (!is_numeric($_GET['id_post'])) )
	{
		echo('<script type="text/javascript">alert("Link non valido, verrai reindirizzato alla pagina principale.")</script>');
		echo('<meta http-equiv="refresh" content="0,index.php">');
	}
?>
<?php include "_header.php"; ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$row['titolo']?></title>

    
</head>
 <body>
<header><?php include "Header.php"; ?> </header>
<div class="container">
<div class="row" id="sotto">
<div class="col-sm-2 col-md-2">
</div>
<div class="col-sm-8 col-md-8">
	<?php 
		$row=getInfo($_GET['id_post'], 'post', 'id_post');
		if(isset($row['id_post']))
		{
			$post='<table class="table-bordered" width="80%"><thead><caption>'.$row['titolo'].'</caption></thead><tbody>';
			$post.='<tr><td align="right">'.$row['data'].'</td></tr>';
			$post.='<tr><td>'.$row['contenuto'].'</td></tr>';
			$info=getInfo($row['id_autore'],'utente','ID');
			$autore=$info['Username'];
			$post.='<tr><td align="right">Written by '.$autore.'</td></tr></tbody></table>';
			echo($post);
		}
		else
			echo("<div class='jumbotron'><h1>Non esiste alcun post per questo id</h1></div>");
		
		
	?>
</div>
<div class="col-sm-2 col-md-2">
<?php include "rightbar.php" ?>
</div>
</div>
</div>

</body>
<footer class="bs-docs-footer" role="contentinfo"><?php include "footer.php"?></footer>
</html>