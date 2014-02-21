<div class="col-sm-6 col-md-6">
    	<form action="#" method="post" class="form-signin" role="form">
        	<h2 class="form-signin-heading">Cambia password</h2>
        	<input class="form-control" type="password" placeholder="Vecchia Password" name="vecchia" />
            <input class="form-control" type="password" placeholder="Nuova Password" name="nuova" />
            <input class="form-control" type="password" placeholder="Conferma Password" name="conferma" />
            <button class="btn btn-lg btn-primary btn-block" type="submit">Cambia Password</button>
        </form>
        <?php
			if(isset($_POST['vecchia']) && isset($_POST['nuova']) && isset($_POST['conferma']))
			{
				if(empty($_POST['nuova']) || empty($_POST['conferma']) || empty($_POST['vecchia']))
						echo("<br><span class='label label-danger'>Prima compilare tutti i campi!</span>");
				elseif($row['Password']!=$_POST['vecchia'])
					echo("<br><span class='label label-danger'>La password vecchia non è valida.</span>");
				else
				{					
					if($_POST['nuova']!=$_POST['conferma'])
						echo("<br><span class='label label-danger'>Le due password non coincidono<span>");
					else
					{					
						sostituisci_mysql($pos,$_POST['nuova'],"Password", 'utente', 'ID');
						echo("<br><span class='label label-success'>Cambiamento avvenuto con successo</span>");
					}
						
					
				}
			}
		?>
</div>
<div class="col-sm-6 col-md-6"></div>