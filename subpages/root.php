<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ants</title>
	<link rel="stylesheet" type="text/css" href="../script/jquery-ui.min.css">
	<link rel="stylesheet" type="text/css" href="../css/header.css">
	<link rel="stylesheet" type="text/css" href="../css/root.css">
	<script type="text/javascript" src="../script/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="../script/jquery-ui.min.js"></script>
	<script type="text/javascript" src="../script/index.js"></script>

	<style type="text/css">
		td a{ color: #FF001A !important; }
		.btn_GO{
			width: 35px !important;
			height: 25px  !important;
			background-color: red;
			border: 0px !important;
		}
	</style>
</head>
<body>
	<?php
		session_start(); 
		include "../script/conn.php" 
	?>
	<!-- 导航栏 -->
	<div class="header" id="header" name="header">
		<div class="h-box">
			<div class="logo"></div><!-- logo图标 -->
			<div class="h-box-1">
				<ul><li><a href="../index.php">首页</a></li>
					<li><a href="#">博客</a></li>
					<li><a href="#">论坛</a></li>
					<li><a href="#">热搜</a></li>
					<li><a href="#">下载</a>
						<div class="download-img"></div>
					</li>
				</ul>
			</div>
			<div class="h-box-2">
				<div class="login-info">
				<?php  
					#判断当前是否有用户登录状态，若没有用户登录则回到主页面。
					#若有用户登录存在，查询数据库中该登录用户是否是管理员
					#如果不是管理员则返回主页面，即使是非管理员用户得到此管理界面的入口也会被强制退出。
					if(@$_SESSION["username"] == ""){
						$login_info = "<a href='login.php'>登录</a>";
						header("location:../../../forum/index.php");
					}else{
						$username = $_SESSION["username"];
						$result   = mysql_query("select * from user where username='$username'", $conn);
						$row 	  = mysql_fetch_assoc($result);
						if($row["type"] != "管理员"){
							header("location:../../../forum/index.php");
						}else{
							$login_info = "<a href='#'>".$_SESSION["username"]."</a>";
						}
					}
				?>
					<ul><li><?php echo $login_info; ?>
							<div style="z-index: 10px;">
								<ul>
									<li><a href="#">个人信息</a></li>
									<li><a href="#">我的关注</a></li>
									<li><a href="#">历史浏览</a></li>
									<li><a href="#">充值中心</a></li>
									<li><a href="login.php?exit=true">退出登录</a></li>
								</ul>
							</div>
						</li>
					</ul>
				</div>
				<div class="h-search">
					<form method="post" action="../script/search.php">
						<input type="text" name="h-search" title="内容搜索栏……">
						<input type="submit" class="btn_GO" name="search" value="GO">
					</form>
				</div>
			</div>
		</div>
	</div><br><br>
	<?php include "../script/delete_update/top.php"; ?>
	<div id="tabs">
		<script type="text/javascript">
			$(function(){ $( "#tabs" ).tabs(); }); 
		</script>
		<ul><li><a href="#tabs-1">用户表</a></li>
			<li><a href="#tabs-2">博客文章表</a></li>
			<li><a href="#tabs-3">文章评论表</a></li>
		</ul>
		<div id="tabs-1">
		<?php
			$result = mysql_query("select * from user", $conn);
			?>
			<table border="1" width="100%">
				<tr bgcolor="#A3CECF">
					<td>Id</td>
					<td>用户名</td>
					<td>密码</td>
					<td>年龄</td>
					<td>性别</td>
					<td>邮箱</td>
					<td>电话</td>
					<td>状态</td>
					<td>用户类型</td>
					<td>注册时间</td>
					<td>置顶</td>
					<td>修改</td>
					<td>删除</td>
				</tr>

		<?php  
			while($row = mysql_fetch_assoc($result)) {
		?>	
				<tr><td><?php echo $row["Id"]; ?></td>
					<td><?php echo $row["username"]; ?></td>
					<td><?php echo $row["password"]; ?></td>
					<td><?php echo $row["age"]; ?></td>
					<td><?php echo $row["sex"]; ?></td>
					<td><?php echo $row["email"]; ?></td>
					<td><?php echo $row["phone"]; ?></td>
					<td><?php echo $row["state"]; ?></td>
					<td><?php echo $row["type"]; ?></td>
					<td><?php echo $row["time"]; ?></td>
					<td><a href="?top=<?php echo $row['Id']; ?>&type=user">置顶</a></td>
					<td><a href="../script/delete_update/update.php?id=<?php echo $row['Id']; ?>&type=user">修改</a></td>
					<td><a href="../script/delete_update/delete.php?id=<?php echo $row['Id']; ?>&type=user">删除</a></td>
				</tr>
		<?php } ?>
			</table>
		</div>
		<div id="tabs-2">
		<?php  
			if(isset($_GET["page"]) && (int)$_GET["page"]>0) {	#获取页码并检查是否非法
				$Page = $_GET["page"];
			}else {
				$Page = 1;	#如果获取不到页码则显示页码为的第一页
			}
			$PageSize = 10;	#设置每页显示记录数

			$result = mysql_query("select count(Id) from tiezi", $conn);	#创建统计记录总数的结果集
			$row 	= mysql_fetch_row($result);
			$RecordCount = $row[0];		#获取记录总数
			$PageCount 	 = ceil($RecordCount / $PageSize);
			#将某一页的记录放入结果集
			$result = mysql_query("select * from tiezi limit ".($Page - 1)*$PageSize.",".$PageSize, $conn);
			?>
			<table border="1" width="100%">
				<tr bgcolor="#A3CECF">
					<td>Id</td>
					<td>标题</td>
					<td>作者</td>
					<td>时间</td>
					<td>点赞</td>
					<td>访问量</td>
					<td>置顶</td>
					<td>修改</td>
					<td>删除</td>
				</tr>

			<?php  
			while($row = mysql_fetch_assoc($result)) {
			?>	
				<tr><td><?php echo $row["Id"]; ?></td>
					<td><?php echo $row["title"]; ?></td>
					<td><?php echo $row["username"]; ?></td>
					<td><?php echo $row["time"]; ?></td>
					<td><?php echo $row["praise"]; ?></td>
					<td><?php echo $row["click_rate"]; ?></td>
					<td><a href="?top=<?php echo $row['Id']; ?>&type=tiezi">置顶</a></td>
					<td><a href="../script/delete_update/update.php?id=<?php echo $row['Id']; ?>&type=tiezi">修改</a></td>
					<td><a href="../script/delete_update/delete.php?id=<?php echo $row['Id']; ?>&tyoe=tiezi">删除</a></td>
				</tr>
			<?php } ?>
			</table>
			<p>
			<?php 
			if($Page == 1) {
				echo "首页 上一页";
			}else {
				echo "<a href='?page=1'>首页</a> <a href='?page=".($Page - 1)."'>上一页</a>";
			}
			for($i=1; $i<= $PageCount; $i++) {
				if($i == $Page) {
					echo " $i ";
				}else {
					echo " <a href='?page=$i'>$i</a> ";
				}
			}
			if($Page == $PageCount) {
				echo "下一页 末页";
			}else {
				echo "<a href='?page=".($Page + 1)."'>下一页</a> <a href='?page=".$PageCount."'>末页</a>";
			}
			echo " 共".$RecordCount."条记录 ";
			echo " $Page/$PageCount 页";
			?>
			</p>
		</div>
		<div id="tabs-3">
		<?php
			$result = mysql_query("select * from comment", $conn);
			?>
			<table border="1" width="100%">
				<tr bgcolor="#A3CECF">
					<td>Id</td>
					<td>评论文章id</td>
					<td>用户名</td>
					<td>评论内容</td>
					<td>评论时间</td>
					<td>置顶</td>
					<td>修改</td>
					<td>删除</td>
				</tr>

		<?php  
			while($row = mysql_fetch_assoc($result)) {
		?>	
				<tr><td><?php echo $row["Id"]; ?></td>
					<td><?php echo $row["article_id"]; ?></td>
					<td><?php echo $row["username"]; ?></td>
					<td><?php echo $row["content"]; ?></td>
					<td><?php echo $row["time"]; ?></td>
					<td><a href="?top=<?php echo $row['Id']; ?>&type=comment">置顶</a></td>
					<td><a href="../script/delete_update/update.php?id=<?php echo $row['Id']; ?>&type=comment">修改</a></td>
					<td><a href="../script/delete_update/delete.php?id=<?php echo $row['Id']; ?>&type=comment">删除</a></td>
				</tr>
		<?php } ?>
			</table>
		</div>
	</div>
</body>
</html>