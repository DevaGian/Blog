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
<?php
	$mesi=array("Gennaio","Febbraio","Marzo","Aprile","Maggio","Giugno","Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre");
	if( !isset($_GET['month']) or !isset($_GET['year']))
	{
		echo('<script type="text/javascript">alert("Link non valido, verrai reindirizzato alla pagina principale.")</script>');
		echo('<meta http-equiv="refresh" content="0,index.php">');
	}
?>
<?php include "_header.php"; ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Visualizza post</title>

    
</head>
 <body>
<header><?php include "Header.php"; ?> </header>
<div class="container">
<div class="row" id="sotto">
<div class="col-sm-2 col-md-2">
</div>
<div class="col-sm-8 col-md-8">
<div class="jumbotron" style="width:80%">
	<h3 align="center">Post di <?=$mesi[(int)($_GET['month'])-1]?></h3>
</div>
	<?php 
		if(isset($_GET['month']) && isset($_GET['year']))
		{
			$db=new MySQLi('localhost', 'Gianluca', 'prove', 'test');
			if(!$result=$db->query("SELECT * FROM `post`"))
				die("Errore query: ".$db->error);
			$k=0;
			while($row=$result->fetch_assoc())
			{								
				if(strtok($row['data'], "-") == $_GET['year'])
				{					
					if(strtok("-") == $_GET['month'])
					{
						$k+=1;
						$post='<table class="table-bordered" width="80%"><thead><caption><h1>'.$row['titolo'].'</h1></caption></thead><tbody>';
						$post.='<tr><td align="right">'.$row['data'].'</td></tr>';
						$post.='<tr><td>'.$row['contenuto'].'</td></tr>';
						$info=getInfo($row['id_autore'],'utente','ID');
						$autore=$info['Username'];
						$post.='<tr><td align="right">Written by '.$autore.'</td></tr>';
						$post.='<tr><td align="center"><a href="viewpost.php?id_post='.$row['id_post'].'">Link articolo</a></td></tr></tbody></table>';
						echo($post);
					}
				}			
			}
			if($k==0)
				echo('<div class="jumbotron"><h3>Non sono disponibili post per questo intervallo di date</h3></div>');			
			$db->close();
			
		}
		
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