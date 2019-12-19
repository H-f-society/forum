<?php  
	include "../conn.php";

	#获取地址栏中被传过来的ID，查询数据库相关数据并删除
	#返回管理界面
	$id 	= intval($_GET["id"]);
	$t_name = $_GET["type"];
	
	mysql_query("delete $t_name user where Id = $id");
	header("location:/../../../../forum/subpages/root.php");
?>