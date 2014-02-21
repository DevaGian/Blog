<?php		
	$pos = trova_mysql($_SESSION['username'], "Username", "utente");
	$_SESSION['id']=$pos;
	$row=getInfo($pos, 'utente', 'ID');
	$user=$row['Username'];	
	
	//verifica admin
	$admin=$row['Admin'];
		
	$info=getInfo($pos, 'informazioniu', 'Utente');	
	$nome=$info['Nome'];
	$cognome=$info['Cognome'];
	$informazioni=$info['Informazioni'];
	
	function changeinfo()
	{
		if(isset($_POST['name']) && isset($_POST['sur']) && isset($_POST['info']))
		{
			if(empty($_POST['name']) or empty($_POST['sur']))
				return "<span class='label label-warning'>Compilare i campi nome e cognome.</span>";
			else
			{
				sostituisci_mysql($_SESSION['id'], $_POST['name'], "Nome", 'informazioniu', 'Utente');
				sostituisci_mysql($_SESSION['id'], $_POST['sur'], "Cognome", 'informazioniu', 'Utente');
				sostituisci_mysql($_SESSION['id'], $_POST['info'], "Informazioni", 'informazioniu', 'Utente');
				header("location: profilo.php");
			}
		}
	}
	
	
	
?>
<div class="row" id="sotto">
    <?php include "menu.php" ?>
    <div class="col col-sm-6 col-md-6">
    	<form class="form-signin" role="form" action="#" method="post">
        	<div class="jumbotron">
            	<h2 align="center">Modifica informazioni</h2>
                <input type="text" placeholder="Nome" required="" value="<?=$nome?>" class="form-control" name="name">
                <input type="text" placeholder="Cognome" required="" value="<?=$cognome?>" class="form-control" name="sur">
                <textarea class="form-control" placeholder="Informazioni aggiuntive" rows="5" name="info"><?=$informazioni?></textarea>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Modifica</button>
                <h3 align="center"><?php echo(changeinfo()) ?></h3>
            </div>
            
        </form>
    </div>
</div>
    