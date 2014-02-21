<?php
		function setadmin()
			{				
				if(isset($_POST['action']))
				{
					$pos=trova_mysql(strtolower($_POST['uzer']),"Username","utente");
					if($pos==-1)
						return "<span class='label label-danger'>Utente non trovato</span>";
					else
					{
						$action=$_POST['action'];
						if($action=='pro')
						{
							sostituisci_mysql($pos,1,"Admin", 'utente', 'ID');
							return "<span class='label label-success'>Promosso</span>";
						}
						else
						{
							sostituisci_mysql($pos,0,"Admin", 'utente', 'ID');
							return "<span class='label label-danger'>Retrocesso</span>";
						}
					}
				}
			}			
			
			$db=new mysqli ('localhost', 'Gianluca', 'prove', 'test');
			if(isset($_POST['cancella']))
			{				
				$sql="DELETE FROM `utente` WHERE `ID` = ".$_POST['cancella'];
				$db->query($sql);
				$delete="<h3><span class='label label-success'>Utente eliminato</span></h3>";							
			}
			else
				$delete="";	
			
			$table="<table class='table' align='center'><thead><caption><h2>Gestione utenti</h2></caption><tr><th>Username</th><th>Modifica</th><th>Cancella</th><th>Admin</th><th>Promuovi</th><th>Retrocedi</th></tr><tr><th></th><th id='redirect'></th><th>".$delete."</th><th></th><th style='vertical-align:middle' colspan='2'><p align='center'>".setadmin()."</p></th></tr></thead><tbody>";			
			$sql=("SELECT * FROM `utente`");			
			if(!$result=$db->query($sql))
			{
				die('There was an error running the query [' . $db->error . ']');
			}
			$user=array();
			$id=array();
			$ad=array();
			$n=0;
			
			while($row=$result->fetch_assoc())
			{				
				$n+=1;
				$user[$n]=htmlspecialchars($row['Username'],ENT_QUOTES);
				$id[$n]=$row['ID'];
				if($row['Admin']==1)
					$ad[$n]="Si";
				else
					$ad[$n]="No";
				$table.="<tr><td>".$user[$n]."</td><td><form action='gestoreut.php' method='post'><button class='btn btn-lg btn-primary btn-block' type='submit' onClick='redir()'>Modifica</button><input type='hidden' name='modifica' value='".$user[$n]."' /></form></td><td><form action='#' method='post'><button class='btn btn-lg btn-primary btn-block' type='submit'>Cancella</button><input type='hidden' name='cancella' value='".$id[$n]."' /></form></td><td>".$ad[$n]."</td><td><form action='#' method='post'><button type='submit' class='btn btn-success'>Promuovi</button><input type='hidden' value='pro' name='action' /><input type='hidden' value='".$user[$n]."' name='uzer' /></form></td><td><form action='#' method='post'><button type='submit' class='btn btn-danger'>Retrocedi</button><input type='hidden' value='ret' name='action' /><input type='hidden' value='".$user[$n]."' name='uzer' /></form></td></tr>";
			}
			$table.="</tbody></table>";			
			
?>
<script type="text/javascript">
	function redir()
	{
		document.getElementById('redirect').innerHTML="<span class='label label-warning'>Redirect...</span>";
	}
</script>

<div class="col-sm-6 col-md-6">
	<?php echo($table); ?>
</div>

<div class="col-sm-3 col-md-3">
</div>