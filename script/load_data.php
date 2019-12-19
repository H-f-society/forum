<?php  
	require_once "conn.php";

	@$num = $_POST["num"];
	$result_data = @mysql_query("select * from tiezi where Id > 10 and Id <= $num");
	while($row_data = @mysql_fetch_array($result_data)){
	?>
		<div class="List-articles">
			<span style="display:none;" class="article_id">
				<?php echo $row_data["Id"]; ?></span>
			<img src="images/logo.png" title="<?php echo $row["username"]; ?>">
			<h4 title="<?php echo $row["title"]."--------".$row["time"]; ?>" class="blog_title">
				<?php echo $row_data["title"]; ?></h4>
			<span style="color:#044AFB;" title="阅读量"><?php echo $row_data["click_rate"]; ?></span>
			<span style="color:red;" title="点赞">❤ <?php echo $row_data["praise"]; ?></span>
		</div>
	<?php
	}
?>