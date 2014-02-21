<?php		
	/*$pos = trova_mysql($_SESSION['username'], "Username", "utente");	
	$row=getInfo($pos, 'utente', 'ID');
	$user=$row['Username'];	
	$access=$row['UltimoAccesso'];*/
	
	//verifica admin
	//$admin=$row['Admin'];
		
	$info=getInfo($pos, 'informazioniu', 'Utente');	
	$nome=$info['Nome'];
	$cognome=$info['Cognome'];
	$informazioni=$info['Informazioni'];
	$imm=$info['Immagine'];
	$born=$info['Nascita'];
	$reg=$info['registerdate'];
	//var_dump($info);exit;
?>
<div class="row" id="sotto">
	<?php include "menu.php"; ?>
       <div class="col-sm-6 col-md-6">
       <table align="center" class="table">
       <tr><td colspan="2" align="center"><img src="<?=$imm?>" alt="Avatar di <?=$user?>" width="200" height="200" /></td></tr>
       <tr><th>Username</th><td><?php echo($user); ?></td></tr>
       <tr><th>Nome</th><td><?php echo($nome); ?></td></tr>
       <tr><th>Cognome</th><td><?php echo($cognome); ?></td></tr>
       <tr><th>Informazioni</th><td><?php echo($informazioni); ?></td></tr>
       <tr><th>Data di nascita</th><td><?php echo($born); ?></td></tr>
       <tr><th>Ultima visita</th><td><?php echo($access); ?></td></tr>
       <tr><th>Data di registrazione</th><td><?php echo($reg); ?></td></tr>    	
       </table>
       </div>
</div>