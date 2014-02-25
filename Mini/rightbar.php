<?php
	
	function stampanav()
	{
		$mesi=array("Gennaio","Febbraio","Marzo","Aprile","Maggio","Giugno","Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre");
		$man=array("01" , "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
		$db=new MySQLi('localhost', 'Gianluca', 'prove', 'test');		
		$sql="SELECT * FROM `post`";
		$result=$db->query($sql);
		$count = array(0,0,0,0,0,0,0,0,0,0,0,0);
		while($row=$result->fetch_assoc())
		{
			strtok($row['data'],"-");
			$month=strtok("-");
			switch ($month)
			{
				case "01":
					$count[0]++;
					break;
				case "02":
					$count[1]++;
					break;
				case "03":
					$count[2]++;
					break;
				case "04":
					$count[3]++;
					break;
				case "05":
					$count[4]++;
					break;
				case "06":
					$count[5]++;
					break;
				case "07":
					$count[6]++;
					break;
				case "08":
					$count[7]++;
					break;
				case "09":
					$count[8]++;
					break;
				case "10":
					$count[9]++;
					break;
				case "11":
					$count[10]++;
					break;
				case "12":
					$count[1]++;
					break;
			}		 
		}
		$db->close();
		for($k=0;$k<12;$k++)
			echo('<li class="list-group-item"><a href="monthyear.php?month='.$man[$k].'&year=2014">'.$mesi[$k].' 2014 <span class="badge pull-right">'.$count[$k].'</span></a> </li>');
	}	
	
?>
<div>
    <ul class="list-group">
        <?php stampanav()?>
    </ul>
</div>