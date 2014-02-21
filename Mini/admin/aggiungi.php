<?php
	$mex="";	
	if(isset($_POST['user']) && isset($_POST['psw']))
	{
		if(empty($_POST['user']) || empty ($_POST['psw']))
			$mex="<br><span class='label label-warning'>Compilare tutti i campi.</span>";
		else
		{
			if(strpos($_POST['user'], "\"")===false && strpos($_POST['user'],"'")===false)
			{
				if(isset($_POST['isad']))
					$isad=1;
				else
					$isad=0;
				$mex=aggiungi(strtolower($_POST['user']),$_POST['psw'],$isad);
			}
			else
				$mex="<br><span class='label label-warning'>I caratteri (\") e (') non sono supportati.</span>";
		}
				
	}
?>

<div class="col-sm-6 col-md-6">
	<form action="#" method="post" class="form-signin" role="form">
        	<h2 class="form-signin-heading">Aggiungi utente</h2>
        	<input class="form-control" type="text" placeholder="Nome utente" name="user" />
            <input class="form-control" type="password" placeholder="Password" name="psw" />
            <label class="checkbox">
            <input type="checkbox" name="isad" />
            	Admin
            </label>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Aggiungi</button>
     </form>
     <?php echo("<p align='center'>".$mex."</p>") ?>
</div>
