<?php	
	function newname()
	{
		if(isset($_POST['old']) && isset($_POST['new']))
		{
			$pos=trova_mysql(strtolower($_POST['old']),"Username","utente");
			if($pos==-1)
				return "<span class='label label-danger'>Utente non trovato</span>";
			else
			{
				if(trova_mysql(strtolower($_POST['new']),"Username","utente")!=-1)
					return "<span class='label label-warning'>Esiste già un utente con lo stesso nome</span>";
				else
				{
					sostituisci_mysql($pos,strtolower($_POST['new']),"Username",'utente');
					$_SESSION['utnt']=strtolower($_POST['new']);
					header('Location: gestoreut.php');
					return "<span class='label label-success'>Cambiamento avvenuto con successo</span>";
					
				}
			}
		}
	}
	if(!isset($_SESSION['utnt']) || isset($_POST['modifica']))
	{
		if(isset($_POST['modifica']))
		{
			$utnt=$_POST['modifica'];		
			$type="hidden";
			$_SESSION['utnt']=$utnt;
			$cambiautn='<a href="gestoreut.php"<button type="button" onclick="destroy()" class="btn btn-danger" href="gestoreut.php">Cambia utente</button></a>';
		}
		else
		{
			$utnt="";
			$type="text";
			$cambiautn="";
		}
	}
	else
	{
		$utnt=$_SESSION['utnt'];
		$type="hidden";
		$cambiautn='<a href="gestoreut.php"><button type="button" onclick="destroy()" class="btn btn-danger" href="gestoreut.php">Cambia utente</button></a>';
	}
		
?>
<script type="text/javascript">function destroy(){<?php unset($_SESSION['utnt']) ?>}</script>
<div class="col-sm-6 col-md-6">
<p align="center"><h1 align="center"><span class="label label-info"><?=$utnt?></span><?=$cambiautn?> </h1></p>
<form action="#" method="post" class="form-signin" role="form">
<table border="0" align="center" cellspacing="10" width="50%">
	
        	<caption><h2 class="form-signin-heading">Cambia username</h2></caption>
        	<tr><td><input class="form-control" type="<?=$type?>" placeholder="Vecchio nome utente" name="old" value="<?=$utnt?>"/></td></tr>
            <tr><td><input class="form-control" type="text" placeholder="Nuovo nome utente" name="new" /></td></tr>          
            <tr><td><button class="btn btn-lg btn-primary btn-block" type="submit">Cambia username</button></td></tr>     
     		<tr><td align="center"><br><?php echo(newname()) ?></td></tr></table>
</table>
</form>
<?php include "admin/gestorepsw.php" ?>

</div>

<div class="col-sm-3 col-md-3">
</div>