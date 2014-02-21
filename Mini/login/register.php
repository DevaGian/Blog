<?php
function add()
{	
	if(isset($_POST['mail']))
	{		
		if(empty($_POST['mail']) or empty($_POST['username']) or empty($_POST['psw']) or empty($_POST['nome']) or empty($_POST['cognome']) or empty($_POST['g']) or empty($_POST['m']) or empty($_POST['a']))
			return "<span class='label label-danger'>Compilare i campi obbligatori</label>";	
			
		elseif($_POST['psw']!=$_POST['cpsw'])
			return "<span class='label label-danger'>Le due password non coincidono</span>";	
		elseif(!checkdate($_POST['m'],$_POST['g'],$_POST['a']))
		{
			return "<span class='label label-warning'>Inserire una data valida</span>";
		}
		else
		{
			if($_POST['a']<(date('Y')-100) or $_POST['a']>date('Y'))
				$_POST['a']=date('Y')-100;				
			$mex=aggiungi(strtolower($_POST['username']),$_POST['psw'],$_POST['mail'],0);
			if($mex=="ok")			
			{
				$pos=trova_mysql(strtolower($_POST['mail']),'Mail','utente');
				if(isset($_FILES['img']))
				{
					$file=$_FILES['img'];
					if($file['error'] == UPLOAD_ERR_OK and is_uploaded_file($file['tmp_name']))
					{
						strtok($file['name'],".");
						$path="imm/".strtolower($_POST['username']).".".strtok(".");
						move_uploaded_file($file['tmp_name'],$path);						
					}
					elseif($file['error'] == UPLOAD_ERR_INI_SIZE)
						return "<span class='label label-warning'>Il file è troppo grande (max 5MB)</span>";				
				}
				else
					$path="";
				if(empty($_POST['informazioni']))
					$informazioni=NULL;
				else
					$informazioni=$_POST['informazioni'];
				$born=$_POST['a']."-".$_POST['m']."-".$_POST['g'];
				aggiunginfo($_POST['nome'],$_POST['cognome'],$born,$informazioni,$path,$pos);
				return "<span class='label label-success'>Congratulazioni, sei ora utente di this forum</span>";
			}
			elseif($mex=="mail")
				return "<span class='label label-warning'>Indirizzo e-mail già presente nel nostro archivio</span>";
			else
				return "<span class='label label-warning'>Il nome utente non è disponibile</span>";
			
		}

	}
}
?>

<div class="col-sm-6 col-md-6">
    <form class="form-signin" role="form" action="#mex" method="post" enctype="multipart/form-data" name="regi">
        <h2 class="form-signin-heading">Registrati</h2>
        
         <input class="form-control" type="email" autofocus="" required="" placeholder="E-Mail" name="mail">
        <input class="form-control" type="text" autofocus="" required="" placeholder="Username" name="username">
        <input class="form-control" type="password" required="" placeholder="Password" name="psw">
        <input class="form-control" type="password" required="" placeholder="Conferma password" name="cpsw">
        <br>
      	<br>
        <div class="jumbotron"><h3 align="center">Informazioni personali</h3><br><br>
        <input class="form-control" type="text" placeholder="Nome" name="nome" required="">
        <input class="form-control" type="text" placeholder="Cognome" name="cognome" required="">
        <br>
       
        <!--Data-->
        <div class="form-group">    
        Data di nascita:<br>       
        <input type="text" placeholder="Giorno" name="g" maxlength="2" size="2" required="">
        <input type="text" placeholder="Mese" name="m" size="2" maxlength="2"  required="">
        <input type="text" placeholder="Anno" name="a" size="4" maxlength="4" required="">
        <br><br><br>
        </div>
        <!--Fine data-->
        <textarea name="informazioni" class="form-control" placeholder="Informazioni aggiuntive (opzionali)" rows="5" ></textarea>
        <br><br>
        Immagine personale (Opzionale):<br>
        <input type="file" name="img">
        </div>
		

        
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>        
    </form>
    	<p align="center" id="mex"><br><?=add()?></p>    
</div>
