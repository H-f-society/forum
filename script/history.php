<?php  
	require_once "conn.php";
	#获取当前文件名
	$php_self = substr($_SERVER['PHP_SELF'],strripos($_SERVER['PHP_SELF'],"/")+1);

	$history_top = "select * from tiezi order by click_rate desc limit 10";
	$result_top  = @mysql_query($history_top);
	while($row_top = @mysql_fetch_array($result_top)){
		#主页面和字面都需要调用此文件，但里面的连接路径在两个页面中不同，所以需要判断当前文件名
		#根据文件名作出判断所需要跳转的文件路径
		if($php_self == 'index.php'){
			echo "<a href='subpages/article.php?id=".$row_top["Id"]."'>";
		}else{
			echo "<a href='article.php?id=".$row_top["Id"]."'>";
		}
	?>
			<h3 class="top" title="<?php echo $row_top['title'].'--------'.$row_top['time'];?>">
				<?php #判断当前文件名，调试图片路径
					if($php_self == 'index.php'){
						echo "<img src='images/s2.png'>";
					}else{
						echo "<img src='../images/s2.png'>";
					}
				?>
				<span style="display:none;" class="article_id">
					<?php echo $row_top["Id"]; ?></span>
				<?php echo $row_top["title"]; ?>
			</h3>
			
	<?php
		echo "</a>";
	}
?>