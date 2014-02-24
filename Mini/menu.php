<div class="col-sm-3 col-md-2 sidebar" style="margin-left:5px">
    <div class="list-group">
    	<a class="list-group-item active">Profilo</a>     	
        <a class="list-group-item" href="profilo.php">Panoramica</a>
        <a class="list-group-item" href="cambiapsw.php">Cambia Password</a>
        <a class="list-group-item" href="modinfo.php">Modifica Informazioni</a>
    </div>
        <br /><br />
        <?php
			if($admin==1)
				echo('
					<div class="list-group">	
					<a class="list-group-item active">Gestione post</a>				
					<a class="list-group-item" href="publicpost.php">Pubblica post</a>
					<a class="list-group-item" href="gestorepost.php">Gestisci post</a></li>
					</div>
					<br><br>
					<div class="list-group">
					<a class="list-group-item active">Gestione utenti</a>
					<a class="list-group-item" href="aggiungiutente.php">Aggiungi utente</a>					
					<a class="list-group-item" href="gestoreut.php">Gestore Utenti</a>
					<a class="list-group-item" href="generale.php">Pannello utenti</a>
					</div>');
		?>   
</div>