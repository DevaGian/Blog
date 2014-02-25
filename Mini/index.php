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
	
	function commenta($idpost, $idautore, $k)
	{
		if(isset($_POST['contenuto'.$k]))
		{
			if(!empty($_POST['contenuto'.$k]))
			{
				postcomment($_POST['titolo'.$k],$_POST['contenuto'.$k],$idpost,$idautore);
				return "<span class='label label-success'>Commento in attesa di moderazione</span>";
			}
			else
				return "<span class='label label-warning'>Scrivere qualcosa nel commento</span>";
		}
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
			
			$post[$number]['post'] = '<table class="table-bordered" width="80%">';
			$post[$number]['post'].='<thead><caption><h1>'.$row['titolo'].'</h1><caption></thead><tbody>';
			$post[$number]['post'].='<tr><td align="right">'.$row['data'].'</td></tr>';
			$post[$number]['post'].='<tr><td>'.$row['contenuto'].'</td></tr>';
			$info=getInfo($row['id_autore'], 'utente', 'ID');
			$autore=$info['Username'];
			$post[$number]['post'].='<tr><td align="right">Written by '.$autore.'</td></tr>';
			$post[$number]['post'].='<tr><td align="center"><a href="viewpost.php?id_post='.$row['id_post'].'">Link articolo</a></td></tr>';
			$post[$number]['post'].='</tbody></table><br><br>';
			//echo($post);
			
			
			if(!$commentr=$db->query("SELECT * FROM `commenti` WHERE `id_post` = ".$row['id_post']." AND `approved` = '1' ORDER BY `data`"))
				die("Errore della query: ".$db->error);
			$commentn[$number]=0;
			$commento=array();
			while($commentrow=$commentr->fetch_assoc())
			{
				$autinfo=getInfo($commentrow['id_autore'],'utente','ID');
				$utente=$autinfo['Username'];				
				$commento[$commentn[$number]]='<table class="table-bordered" width="60%">';
				$commento[$commentn[$number]].='<tr><td><h4 align="center">'.$utente.'</h4></td></tr>';
				$commento[$commentn[$number]].='<tr><td>'.$commentrow['titolo'].'</td></tr>';
				$commento[$commentn[$number]].='<tr><td>'.$commentrow['contenuto'].'</td></tr>';
				$commento[$commentn[$number]].='<tr><td align="right">'.$commentrow['data'].'</td></tr></table>';				
				$commentn[$number]+=1;
				
			}
			$post[$number]['id_post']=$row['id_post'];					
			$post[$number]['commenti']=$commento;
			$number+=1;
			
		}		
		if($number==0)	
			echo('<div class="jumbotron"><h2>Al momento non sono disponibili post</h2></div>');
		$db->close();
		
		for($k=0;$k<$number;$k++)
		{
			$visualizzati="";
			for($i=0;$i<$commentn[$k];$i++)				
				$visualizzati.=$post[$k]['commenti'][$i];
			
			if(isset($_SESSION['active'])){
				$visualizzati.='<br><br><button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#postcomment'.$k.'">
							Posta un commento</button><br><br>'.commenta($post[$k]['id_post'],$_SESSION['username'],$k);
							$visualizzati.='<div class="modal fade" id="postcomment'.$k.'" tabindex="-1" role="dialog" aria-labelledby="Posta un commento" aria-hidden="true">
						  <div class="modal-dialog">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="myModalLabel">Posta un commento</h4>
							  </div>
							  <div class="modal-body">
								<form role="form" class="form-signin" action="#commenti'.$k.'" method="post">
								<input type="text" name="titolo'.$k.'" placeholder="Titolo" class="form-control">
								<textarea name="contenuto'.$k.'" required="" class="form-control" placeholder="Contenuto"></textarea>
								<button type="submit" class="btn btn-primary">Public</button>
								</form>
							  </div>
							  <div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								
							  </div>
							</div>
						  </div>
						</div>';}			
			else
				$visualizzati.="<br><br><span class='label label-warning'>Bisogna essere loggati per lasciare un commento.</span><br>
								<a href='login.php'><button class='btn-block'>Log In</button></a>";
			
			if($i==0)
				$visualizzati.='<h3>Non ci sono commenti per questo post</h3>';
			echo('<table class="table-hover" width="100%" height="150px"><tr valign="top"><td><ul class="nav nav-tabs">
					<li class="active"><a href="#post'.$k.'" data-toggle="tab">Post</a></li>
					<li><a href="#commenti'.$k.'" data-toggle="tab">Commenti</a></li>
				</ul></td></tr>');
			echo('<tr valign="top"><td align="center"><div class="tab-content">
					<div class="tab-pane active" id="post'.$k.'">'.$post[$k]['post'].'</div>
					<div class="tab-pane" id="commenti'.$k.'">'.$visualizzati.'</div>
				</div></td></tr></table><br><br>');
		}
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