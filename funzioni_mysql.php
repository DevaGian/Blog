<?php	
	function trova_mysql($username,$colonna, $table)
	{		
		$db=new mysqli('localhost','Gianluca','prove','test');		
		$sql="SELECT *
			FROM `".$table."`
		ORDER BY `ID` ";
		if(!$result=$db->query($sql))
		{
			die('There was an error running the query [' . $db->error . ']');
		}		
		$pos=-1;			
		while(($row=$result->fetch_assoc()) && $pos==-1)
		{							
			if($row[$colonna]==$username)
				$pos=$row["ID"];			
		}
		$db->close();		
		return $pos;
	}
	function sostituisci_mysql($pos, $el, $colonna, $table, $selezione)
	{		
		$col="mysql:host=localhost;dbname:test";
		try{$db=new PDO($col,'Gianluca','prove');}
		catch(PDOException $pdoerror){echo("<script type='text/javascript'>alert('Errore nel connettersi al database, riprova.\n".$pdoerror);}
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdostat=$db->prepare("UPDATE `test`.`".$table."` SET `".$colonna."` = :el WHERE `".$table."`.`".$selezione."` =".$pos);
		$pdostat->bindParam(':el',$el,PDO::PARAM_STR,255);
		$pdostat->execute();		
	}
	function getInfo($el, $table, $column)
	{
		$db = new mySQLi('localhost', 'Gianluca' ,'prove', 'test');
		$sql = "SELECT *
				FROM `".$table."`
				WHERE `".$column."` = ".$el;
		if(!$result=$db->query($sql))
			die("Query error: ".$db->error);
		$row=$result->fetch_assoc();
		$db->close();		
		return $row;
	}
	function aggiungi($user, $psw, $mail, $admin)
	{		
		if(trova_mysql($user,"Username","utente")==-1)
		{
			if(trova_mysql($mail, "Mail", 'utente')==-1)
			{
				$col="mysql:host=localhost;dbname:test";
				try
				{$db=new PDO($col,'Gianluca','prove');}
				catch(PDOException $pdoerror)
				{die("<script type='text/javascript'>alert('Errore nel connettersi al database, riprova.\n".$pdoerror);}	
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				
				$sql=$db->prepare("INSERT INTO `test`.`utente` (
						`ID` ,
						`Username` ,
						`Password` ,
						`Mail` ,
						`Admin` ,
						`UltimoAccesso`
						)
						VALUES (
						NULL , :user, :psw, :mail, :ad,
						CURRENT_TIMESTAMP
						);");
				$sql->bindParam(':user',$user,PDO::PARAM_STR,255);
				$sql->bindParam(':psw', $psw,PDO::PARAM_STR,255);
				$sql->bindParam(':ad', $admin,PDO::PARAM_INT);
				$sql->bindParam(':mail', $mail, PDO::PARAM_STR,255);
				$sql->execute();
				return "ok";
			}
			else
				return "mail";
		}
		else
			return "user";		
	}
	function aggiunginfo($nome,$cognome,$born,$info,$imm,$ut)
	{
		if($imm=="")
			{
				$param="";
				$immagine="";
			}
		else
		{
			$param=":imm,";
			$immagine="`Immagine`,";
		}
		$col="mysql:host=localhost;dbname:test";
		try
			{$db=new PDO($col,'Gianluca','prove');}
		catch(PDOException $pdoerror)
			{die("<script type='text/javascript'>alert('Errore nel connettersi al database, riprova.\n".$pdoerror);}
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql=$db->prepare("INSERT INTO `test`.`informazioniu` (
					`Nome`,
					`Cognome`,
					`Nascita`,
					`Informazioni`,
					".$immagine."
					`Utente`,
					`registerdate`
					)
					VALUES(
					:nome, :cognome, :born, :info, ".$param." :ut, :reg);");
		$sql->bindParam(':nome',$nome,PDO::PARAM_STR,255);
		$sql->bindParam(':cognome',$cognome,PDO::PARAM_STR,255);
		$sql->bindParam(':born',$born);
		$sql->bindParam(':info',$info);
		if($imm!=NULL)
			$sql->bindParam(':imm',$imm,PDO::PARAM_STR,255);
		$sql->bindParam(':ut',$ut,PDO::PARAM_INT);
		$date=date('Y')."-".date('m')."-".date('d');
		$sql->bindParam(':reg',$date);
		$sql->execute();		
	}
?>