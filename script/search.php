<?php  
	require_once "conn.php";

	#if(isset($_POST["search"])){
		$keywork = $_POST["h-search"];
		$sql 	 = "select * from tiezi where title like '%".$keywork."%'";
		$result  = mysql_query($sql, $conn);
		$row 	 = mysql_fetch_array($result);
		$id = $row["Id"];

		header("location:../../../forum/subpages/article.php?id=$id");
		#获取当前文件名来修改路径
		// $php_self = substr($_SERVER['PHP_SELF'],strripos($_SERVER['PHP_SELF'],"/")+1);
		// if($php_self == 'index.php'){
		// 	header("location:");
		// }
	#}
?>