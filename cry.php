<?php
function str2bin($str, $mode=0) {
   $out = false;
   for($a=0; $a < strlen($str); $a++) {
       $dec = ord(substr($str,$a,1));
       $bin = '';
       for($i=7; $i>=0; $i--) {
           if ( $dec >= pow(2, $i) ) {
               $bin .= "1";
               $dec -= pow(2, $i);
           } else {
               $bin .= "0";
           }
       }
       /* Default-mode */
       if ( $mode == 0 ) $out .= $bin;
       /* Human-mode (easy to read) */
       if ( $mode == 1 ) $out .= $bin . " ";
       /* Array-mode (easy to use) */
       if ( $mode == 2 ) $out[$a] = $bin;
   }
   return $out;
}
function cripto()
{
	if(isset($_POST['stringa']))
	{
		$mid="";
		for($k=0;$k<strlen($_POST['stringa']);$k++)
		{
			$bin=decbin(ord(substr($_POST['stringa'],$k,1)))|decbin(33);
			$mid.=$bin;
		}
		$cripted="";
		for($k=0;$k<strlen($mid);$k+=4)
		{			
			$char=chr(bindec(ord(substr($mid,$k,4))));
			var_dump(ord(substr($mid,$k,1)));
			$cripted.=$char;
		}
		return $mid;
		
	}
}
?>

<form action="#" method="post">
	<input type="text" name="stringa" placeholder="Stringa"/>
    <button type="submit">Cripta</button>
    Stringa criptata: <?=cripto()?>
</form>