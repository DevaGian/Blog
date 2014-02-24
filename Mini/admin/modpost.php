<?php	
	if(isset($_POST['contenuto']) && isset($_POST['titolo']))
	{
		$id_post=$_POST['newid'];
		$titolo=$_POST['titolo'];
		$contenuto=$_POST['contenuto'];		
	}
	else
	{		
		$id_post=$_POST['id'];
		$info = getInfo($id_post,'post','id_post');
		$titolo = $info['titolo'];
		$contenuto = $info['contenuto'];
	}
	function modpost($id_post)
	{
		if(isset($_POST['contenuto']) && isset($_POST['titolo']))
		{
			if(!empty($_POST['contenuto']) && !empty($_POST['titolo']))
			{				
				sostituisci_mysql($id_post,$_POST['contenuto'],'contenuto','post','id_post');
				sostituisci_mysql($id_post,$_POST['titolo'],'titolo','post','id_post');
				return "<span class='label label-success'>Post editato con successo</span>";				
			}
			else
				return "<span class='label label-warning'>Compilare tutti i campi</span>";
		}
	}
?>

<div class="col-sm-6 col-md-6">
	<div class="jumbotron">    	
        <h2 align="center"><?=$titolo?></h2>
        <div class="btn-group">
        	<button type="button" class="btn btn-default" onClick="left()"><span class="glyphicon glyphicon-align-left"></span></button>
            <button type="button" class="btn btn-default" onClick="center()"><span class="glyphicon glyphicon-align-center"></span></button>
            <button type="button" class="btn btn-default" onClick="right()"><span class="glyphicon glyphicon-align-right"></span></button>
            <button type="button" class="btn btn-default" onClick="justify()"><span class="glyphicon glyphicon-align-justify"></span></button>
        </div>
        <div class="btn-group">
        	<button type="button" class="btn btn-default" onClick="bolded()"><span class="glyphicon glyphicon-bold"></span></button>
            <button type="button" class="btn btn-default" onClick="italic()"><span class="glyphicon glyphicon-italic"></span></button>
            <button type="button" class="btn btn-default" onClick="underline()"><span class="glyphicon glyphicon-text-width"></span></button>
            <button type="button" class="btn btn-default" onClick="down()"><span class="glyphicon glyphicon-arrow-down"></span></button>
        </div>
        <div class="btn-group">
        	<button type="button" class="btn btn-default" onClick="img()"><span class="glyphicon glyphicon-picture"></span></button>
            <button type="button" class="btn btn-default" onClick="a()"><span class="glyphicon glyphicon-magnet"></span></button>
            <button type="button" class="btn btn-default" onClick="ul()"><span class="glyphicon glyphicon-th"></span></button> 
            <button type="button" class="btn btn-default" onClick="li()"><span class="glyphicon glyphicon-list"></span></button>           
        </div>
        <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
              Tabella
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
              <li onClick="table()"><a href="#">Tabella</a></li>
              <li onClick="th()"><a href="#">Colonna marcata</a></li>
              <li onClick="tr()"><a href="#">Riga</a></li>
              <li onClick="td()"><a href="#">Colonna</a></li>
            </ul>
        </div>
        <br><br>
        <form class="form-signin" role="form" action="#" name="pubblica" class="form-control" method="post">
        <input type="hidden" value="<?=$id_post?>" name="newid"/>
        <input type="text" name="titolo" required="" placeholder="Titolo"  class="form-control" value="<?=$titolo?>"/>
        <br>
        <textarea name="contenuto" required="" placeholder="Inserisci il contenuto" class="form-control" rows="5"><?=$contenuto?></textarea>
        <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Modifica</button>
        <p align="center"><h3><?php echo(modpost($id_post))?></h3></p>
        </form>              
    </div>
</div>
<script type="text/javascript">
function insertAtCursor(myField, myValue) {
		//IE support
		if (document.selection) {
			myField.focus();
			sel = document.selection.createRange();
			sel.text = myValue;
		}
		//MOZILLA/NETSCAPE support
		else if (myField.selectionStart || myField.selectionStart == '0') {
			var startPos = myField.selectionStart;
			var endPos = myField.selectionEnd;
			myField.value = myField.value.substring(0, startPos)
			+ myValue
			+ myField.value.substring(endPos, myField.value.length);
			myField.value.focus();
		} else {
			myField.value += myValue;
		}		
		}

	function left()
	{
		insertAtCursor(document.pubblica.contenuto,"<p align='left'></p>");		
	}
	function center()
	{
		insertAtCursor(document.pubblica.contenuto,"<p align='center'></p>");		
	}
	function right()
	{
		insertAtCursor(document.pubblica.contenuto,"<p align='right'></p>");		
	}
	function justify()
	{
		insertAtCursor(document.pubblica.contenuto,"<p align='justify'></p>");		
	}
	function bolded()
	{
		insertAtCursor(document.pubblica.contenuto,"<b></b>");		
	}
	function italic()
	{
		insertAtCursor(document.pubblica.contenuto,"<i></i>");		
	}
	function underline()
	{
		insertAtCursor(document.pubblica.contenuto,"<p style='text-decoration:underline'></p>");		
	}
	function down()
	{
		insertAtCursor(document.pubblica.contenuto,"<br>");		
	}
	function img()
	{
		insertAtCursor(document.pubblica.contenuto,"<img src=''></img>");		
	}
	function ul()
	{
		insertAtCursor(document.pubblica.contenuto,"<ul></ul>");		
	}
	function li()
	{
		insertAtCursor(document.pubblica.contenuto,"<li></li>");		
	}
	function a()
	{
		insertAtCursor(document.pubblica.contenuto,"<a href=''></a>");		
	}
	function table()
	{
		insertAtCursor(document.pubblica.contenuto,"<table class='table'></table>");		
	}
	function th()
	{
		insertAtCursor(document.pubblica.contenuto,"<th></th>");		
	}
	function tr()
	{
		insertAtCursor(document.pubblica.contenuto,"<tr></tr>");		
	}
	function td()
	{
		insertAtCursor(document.pubblica.contenuto,"<td></td");		
	}
</script>