<?php
	$mex="";
	if(isset($_POST['userpsw']) && isset($_POST['psw']))
	{
		$pos=trova_mysql(strtolower($_POST['userpsw']),"Username","utente");
		if($pos==-1)
			$mex="<br><span class='label label-danger'>Non ho trovato l'utente</span>";
		else
			{
				if(!empty($_POST['psw']))
				{
					if($_POST['psw']==$_POST['confirm'])
					{
						if(strpos($_POST['psw'],'"')===false && strpos($_POST['psw'],"'")===false)
						{
							sostituisci_mysql($pos,$_POST['psw'],"Password", 'utente', 'ID');
							$mex="<br><span class='label label-success'>Cambiamento avvenuto con successo</span>";
						}
						else
							$mex="<br><span class='label label-warning'>I caratteri (\") e (') non sono supportati.</span>";
					}
					else
						$mex="<br><span class='label label-warning'>Le due password non coincidono</span>";
				}
				else
					$mex="<br><span class='label label-danger'>Compilare il campo password.</span>";
			}		
	}
	
	
?>
	<form action="#" method="post" class="form-signin" role="form">
    <table align="center" border="0" width="50%">
        	<tr><td align="center"><h2 class="form-signin-heading">Cambia Password</h2></td></tr>
        	<tr><td><input class="form-control" type="<?=$type?>" placeholder="Nome utente" name="userpsw" value="<?=$utnt?>" /></td></tr>
            <tr><td><input class="form-control" type="password" placeholder="Nuova Password" name="psw" /></td></tr> 
            <tr><td><input class="form-control" type="password" placeholder="Conferma Password" name="confirm" /></td></tr>         
            <tr><td><button class="btn btn-lg btn-primary btn-block" type="submit">Cambia PSW</button></tr></td>
     
     		<tr><td><?php echo($mex) ?></td></tr>
     </table>
	</form>