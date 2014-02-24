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
    <title>Home Page</title>

    
</head>
  <body>
<header><?php include "Header.php"; ?> </header>
<div class="container" id="sotto">
<div class="row">
	<div class="col-sm-2 col-md-2">
    </div>
    <div class="col-sm-8 col-md-8 blog-main">
    <?php
		$db=new MySQLi('localhost', 'Gianluca', 'prove', 'test');
		$sql="SELECT * FROM `post` ORDER BY `id_post` DESC LIMIT 0,10";
		if(!$result=$db->query($sql))
		{
			die('There was an error running the query [' . $db->error . ']');
		}	
		$number=0;		
		while($row=$result->fetch_assoc())
		{
			$number+=1;
			$post = '<table class="table-bordered" width="80%">';
			$post.='<thead><caption><h1>'.$row['titolo'].'</h1><caption></thead><tbody>';
			$post.='<tr><td align="right">'.$row['data'].'</td></tr>';
			$post.='<tr><td>'.$row['contenuto'].'</td></tr>';
			$info=getInfo($row['id_autore'], 'utente', 'ID');
			$autore=$info['Username'];
			$post.='<tr><td align="right">Written by '.$autore.'</td></tr>';
			$post.='<tr><td align="center"><a href="viewpost.php?id_post='.$row['id_post'].'">Link articolo</a></td></tr>';
			$post.='</tbody></table><br><br>';
			echo($post);
		}
		if($number==0)	
			echo('<div class="jumbotron"><h2>Al momento non sono disponibili post</h2></div>');
		$db->close();
		
	?>
    </div>
    <div class="col-sm-2 col-md-2">
    <?php include "rightbar.php" ?>
    </div>
</div>
</div>

</body>
<footer class="footerhome" role="contentinfo"><?php include "footer.php"?></footer>
</html>