<?php		
	function getIp()
	{
		if (!empty($_SERVER['HTTP_CLIENT_IP']))
		{
		  $ip=$_SERVER['HTTP_CLIENT_IP'];
		}
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		{
		  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else
		{
		  $ip=$_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}	
	function login($user, $psw)
	{							
			$pos=trova_mysql($user,"Username", "utente");
			if($pos==-1)
			{
				print("Non ho trovato l'utente.<br>");				
				print("Clicca <a href='login.php'>qui</a> per tornare alla pagina principale.");
			}
			else
			{
				$db=new MySQLi('localhost','Gianluca', 'prove', 'test');
				$sql="SELECT *
				FROM `utente`
				WHERE ID= ".$pos;
				if(!$result=$db->query($sql))
				{
					die('There was an error running the query [' . $db->error . ']');
				}
				$row=$result->fetch_assoc();
				if($row['Password']!=$psw)
				{
					print("Password Errata.<br>");
					print("Clicca <a href='login.php'>qui</a> per tornare alla pagina principale.");					
				}
				else
				{										
					$_SESSION['username']=$user;
					$_SESSION['password']=$psw;
					$_SESSION['active']=true;
					if(isset($_POST['ricorda']))
					{
						setcookie('utente', $user,time()+60*60*24*30*12*5);
					}
					else
					{
						setcookie("utente", "none", time()-1);
					}
					$timestamp = date("Y")."-".date("m")."-".date("d")." ".date("H").":".date("i").":".date("s");
					$sql="UPDATE `test`.`utente` SET `UltimoAccesso` = '".$timestamp."' WHERE `utente`.`ID` =".$pos.";";
					$db->query($sql);
					header("location: profilo.php");					
				}
			}					
	 }
?>