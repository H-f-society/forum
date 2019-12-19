<?php  
	$hostname 	= "localhost:3306";
	$username 	= "root";
	$password 	= "root";
	
	$db_name  	= "ltan";			#数据库名字
	$table_name = "user"; 			#用户表单名字
	$table_username = "username";	#用户表单中的username
	$table_password = "password";	#用户表单中的password
	$table_email   	= "email";

	#连接服务器
	##连接数据库
	##设置字符集
	$conn = @mysql_connect($hostname, $username, $password) or die("服务器连接失败");
	$mysql_db = @mysql_select_db($db_name, $conn) or die("数据库连接失败");
	//@mysql_set_charset("utf8;");	
	mysql_query("set names utf8;");
?>