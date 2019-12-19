<?php 
	@session_start();
	require_once "conn.php";
	// require_once "../subpages/article.php";
	
	$article_id   = @(int)$_GET["id"];			#本页文章id
	$username 	  = @$_SESSION["username"];		#已登录用户id
	$comment_text = @$_POST["comment_content"];	#ajax传过来的评论文本内容

	// #echo $_POST["comment_content"];
	// if(isset($_POST["comment_btn"])){
	// 	#获取本页文章id，登录用户名，ajax传过来的文本内容，添加到comment表中
	// 	$insert_comment = "insert into comment(article_id, username, content) values($article_id, '$username', '$comment_text')";
	// 	mysql_query($insert_comment);
	// }

	$result_com = @mysql_query("select * from comment where article_id = $article_id");
	while($row_com = @mysql_fetch_array($result_com)){
		$header = array("1_03.jpg", "1_05.jpg", "1_09.jpg", "1_10.jpg", "1_13.jpg", "1_14.jpg", "1_17.jpg", "1_18.jpg");
		$header_result = "../images/header/".$header[rand(0, 7)];
	?>
		<div class="comment">
			<img src="<?php echo $header_result; ?>" title="<?php echo $row_com['username']; ?>">
			<h3 title="<?php echo $row_com['content']."--------".$row_com["time"]; ?>"><?php echo $row_com["content"]; ?></h3>
		</div>
	<?php
	}
?>