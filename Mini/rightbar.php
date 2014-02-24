<?php
	
	function stampanav()
	{
		$mesi=array("Gennaio","Febbraio","Marzo","Aprile","Maggio","Giugno","Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre");
		$man=array("01" , "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
		for($k=0;$k<12;$k++)
			echo('<li class="list-group-item"><a href="monthyear.php?month='.$man[$k].'&year=2014">'.$mesi[$k].' 2014</a> </li>');
	}
?>
<div id="mesi">
    <ul class="list-group">
        <?php stampanav()?>
    </ul>
</div>