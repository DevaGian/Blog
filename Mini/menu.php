<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-sidebar">        	
        <li class="active"><a href="profilo.php">Panoramica</a></li>
        <li><a href="cambiapsw.php">Cambia Password</a></li>
        <li><a href="modinfo.php">Modifica Informazioni</a></li>
        <?php 
			if($admin==1)
				echo('
					<li><a href="aggiungiutente.php">Aggiungi utente</a></li>					
					<li><a href="gestoreut.php">Gestore Utenti</a></li>
					<li><a href="generale.php">Pannello utenti</a></li>');
		?>
   </ul>
</div>