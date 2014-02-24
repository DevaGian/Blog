<div class="col-sm-8 col-md-8">
	<?php
		$db=new MySQLi('localhost', 'Gianluca', 'prove', 'test');
		$sql="SELECT * FROM `utente` WHERE `admin` = 1";
		if(!$result=$db->query($sql))
			die($db->error);
		$n=0;
		while($row=$result->fetch_assoc())
		{
			$ad[$n]=$row['Username'];
			$adid[$n]=$row['ID'];
			$n+=1;
		}
		$adlist='<form action="#" method="post"><select name="admin"><option value="_tutti">Tutti gli autori</option>';
		for($k=0;$k<$n;$k++)
			$adlist.='<option value="'.$adid[$k].'">'.$ad[$k].'</option>';
		$adlist.="</select><br><button class='btn btn-success' type='submit'>Vai</button></form>";
		echo($adlist);
					
		if(!isset($_POST['admin']) or $_POST['admin']=="_tutti")		
			$sql="SELECT * FROM `post`";		
		else
			$sql="SELECT * FROM `post` WHERE `id_autore` = ".$_POST['admin'];
		if(!$result=$db->query($sql))
			die($db->error);
		$table='<table class="table-bordered" align="center" width="100%"><thead><caption><h3>Gestore post</h3></caption>';
		$table.='<tr><th>Nome post</th><th>Data</th><th>Autore</th><th><p align="center">Modifica</p></th><th><p align="center">Cancella</p></th></thead><tbody>';
		$k=0;
		while($row=$result->fetch_assoc())
		{
			$nome="div".$k;
			$info=getInfo($row['id_autore'],'utente', 'ID');
			$table.='<tr><td>'.$row['titolo'].'</td><td>'.$row['data'].'<td>'.$info['Username'].'</td>';
			$table.='<td align="center"><form action="modpost.php" method="post"><input name="id" type="hidden" value="'.$row['id_post'].'"><button type="submit" class="btn btn-success">Modifica</button></form></td>';
			$table.='<td align="center"><form action="admin/ccpost.php" method="post"><input name="id" type="hidden" value="'.$row['id_post'].'"><button type="button" class="btn btn-danger" onClick="mostra(\''.$nome.'\')">Cancella</button><br><div id="'.$nome.'" style="display:none" >
			<button type="submit" class="btn btn-success">Conferma</button><button onClick="nascondi(\''.$nome.'\')" type="button" class="btn btn-warning">Annulla</button></div></form></td></tr>';
			$k+=1;
		}		
		$table.='</tbody></table>';
		if($k==0)
			$table='<div class="jumbotron"><h2>Nessun post trovato.</h2></div>';
		echo($table);
	?>
</div>
<script type="text/javascript">
	function mostra(id)
	{		
		document.getElementById(id).style.display="block";
	}
	function nascondi(id)
	{
		document.getElementById(id).style.display="none";
	}
</script>