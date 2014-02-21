<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
	include "../login_function.php";
	include "../funzioni_mysql.php";
	login(strtolower(filter_var($_POST['username'],FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES)), filter_var($_POST['psw']),FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
?>
</body>
</html>