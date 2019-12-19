<?php 
	@session_start();
	require_once "conn.php";
	
	#页面顶端导航栏判断是否登录并存在session["username"]值，@屏蔽错误信息提示
	if(@$_SESSION["username"] == ""){
	#if(@$_COOKIE["sessionId"] != session_id()){
		$login_info   = "<a href='subpages/login.php'>登录</a>";
		$a_login_info = "<a href='login.php'>登录</a>";
		$u_login_info = "<a href='subpages/login.php'>请先登录</a>";
	}else{
		$login_info   = "<a href='#'>".$_SESSION["username"]."</a>";
		$a_login_info = "<a href='#'>".$_SESSION["username"]."</a>";
		$u_login_info = "<a href='#'>".$_SESSION["username"]."</a>";
	}

	#发表文章，将内容添加到数据库中
	$title =  $content = "";
	if(isset($_POST["Write_blog"])){
		#判断用户是否登录，若已登录则可以发表新博客
		if(isset($_SESSION["username"]) == ""){
			echo "<script>alert('请先登录!');</script>";
		}else{
			$title 	  = $_POST["title"];		#标题
			$content  = $_POST["content"];		#内容
			$username = $_SESSION["username"];  #已登录的用户名
			#将获取的textArea文本内容中的换行\r\n换成html中的<br/><p>
			$new_content = str_replace("\r\n", "<br><p>", "$content");

			$insert = "insert into tiezi(title, content, username) values('$title', '$new_content', '$username')";
			@mysql_query($insert, $conn);
		}
	}
?>