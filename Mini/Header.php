<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
<div class="container-fluid">
<div class="navbar-header">
<button class="navbar-toggle" data-target=".navbar-collapse" data-toggle="collapse" type="button">
<span class="sr-only">This Forum</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a class="navbar-brand" href="index.php">This forum</a>
</div>
<div class="navbar-collapse collapse">
<ul class="nav navbar-nav navbar-right">
<?php
	if(isset($_SESSION['active']))
		echo('<li><a href="#" disabled>Benvenuto, '.$_SESSION['username'].'</a></li>');
?>
<li>
<a href="index.php">Home</a>
</li>
<?php	
	if(isset($_SESSION['active']))
	{
		echo('			
			<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Pannello di controllo<b class="caret"></b></a>
			<ul class="dropdown-menu">	
   	 		<li class="dropdown-header">Utente</li>
    		<li><a href="cambiapsw.php">Cambia password</a></li>
			<li><a href="modinfo.php">Modifica informazioni</a></li>');
			$pos=trova_mysql($_SESSION['username'],'Username','utente');
			$row=getInfo($pos, 'utente', 'ID');
			$admin=$row['Admin'];
			if($admin==1)			
				echo(' 
    					<li class="divider"></li>
   					 	<li class="dropdown-header">Amministratore</li>						
						<li><a href="aggiungiutente.php">Aggingi Utente</a></li>
						<li><a href="gestoreut.php">Gestisci utenti</a></li>
						<li><a href="generale.php">Pannello utenti</a></li>
						<li><a href="publicpost.php">Pubblica post</a></li>
						<li><a href="gestorepost.php">Gestisci post</a></li>');
				echo("</ul>");
				echo("</li>");
			
	}
?>



<?php 		
		if(isset($_SESSION["active"]))
			echo("<li><a href='profilo.php'>Profilo</a></li><li><a href='logout.php'>Log out</a><li>");
		else
		{
			echo("<li><a href='login.php'>Log In</a></li>"); 
			echo("<li><a href='register.php'>Registrati</a></li>");
		}
?>

</ul>
</div>
</div>
</div>
