<?php 
	require_once "conn.php";

	#阅读量最高的博客置顶单独显示
	$click_rate_max = @mysql_query("select * from tiezi where click_rate in(select max(click_rate) from tiezi)");
	$row_max = @mysql_fetch_array($click_rate_max);
	?>
	<div class="List-articles" style="margin-bottom: 15px; box-shadow: 1px 1px 5px #000;">
		<span style="display:none;" class="article_id">
				<?php echo $row_max["Id"]; ?></span>
		<img src="images/hat.png" class="hat">
		<img src="images/header/1_09.jpg" title="<?php echo $row_max["username"]; ?>">
		<a href="subpages/article.php?id=<?php echo $row_max['Id'];?>">
		<h4 title="<?php echo $row_max["title"]."--------".$row_max["time"]; ?>" class="blog_title">
			<?php echo $row_max["title"]; ?></h4></a>
		<span style="color:#044AFB;" title="阅读量"><?php echo $row_max["click_rate"]; ?></span>
		<span style="color:red;" title="点赞">❤ <?php echo $row_max["praise"]; ?></span>
	</div>
	<?php 

	#取出数据库中博客篇章放入主页，倒序显示
	#select * from tiezi where id > 2 and id < 5
	#吧Id跟换成time可改成按时间顺序倒序显示内容
	$result = @mysql_query("select * from tiezi order by Id desc"); #默认升序，desc为降序
	while($row = @mysql_fetch_array($result)){
		
		$header = array("1_03.jpg", "1_05.jpg", "1_09.jpg", "1_10.jpg", "1_13.jpg", "1_14.jpg", "1_17.jpg", "1_18.jpg");
		$header_result = "images/header/".$header[rand(0, 7)]; #设置随机数，从以上八张图片中随机选出一张
	?>
		<div class="List-articles">
			<span style="display:none;" class="article_id">
				<?php echo $row["Id"]; ?></span>
			<img src="<?php echo $header_result; ?>" title="<?php echo $row["username"]; ?>">
			<a href="subpages/article.php?id=<?php echo $row['Id'];?>">
			<h4 title="<?php echo $row["title"]."--------".$row["time"]; ?>" class="blog_title">
				<?php echo $row["title"]; ?></h4></a>
			<span style="color:#044AFB;" title="阅读量"><?php echo $row["click_rate"]; ?></span>
			<span style="color:red;" title="点赞">❤ <?php echo $row["praise"]; ?></span>
		</div>
	<?php
	}
?>