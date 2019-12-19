<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ants</title>
	<link rel="stylesheet" type="text/css" href="script/jquery-ui.min.css">
	<link rel="stylesheet" type="text/css" href="css/header.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<script type="text/javascript" src="script/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="script/jquery-ui.min.js"></script>
	<script type="text/javascript" src="script/index.js"></script>
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
		require "script/index.php";
	?>
	<div class="animation_box">
		<?php include "script/conn.php"; ?>
	</div>
	<?php  
		if(isset($_SESSION["username"])){
			$username = $_SESSION["username"];
			$result   = mysql_query("select * from user where username = '$username'", $conn);
			$row 	  = mysql_fetch_array($result);
			if($row["type"] == "管理员"){
				echo "<a href='subpages/root.php' class='root'><b>▶</b></a>";
			}
		}
	?>
	<a class="animation"><b>◀</b></a>
	<a href="#header" class="go_header"><b>▲</b></a>
	<!-- 导航栏 -->
	<div class="header" id="header" name="header">
		<div class="h-box">
			<div class="logo"></div><!-- logo图标 -->
			<div class="h-box-1">
				<ul><li><a href="index.php">首页</a></li>
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
					<ul><li><?php echo $login_info; ?>
							<div><ul>
									<li><a href="#">个人信息</a></li>
									<li><a href="#">我的关注</a></li>
									<li><a href="#">历史浏览</a></li>
									<li><a href="#">充值中心</a></li>
									<li><a href="subpages/login.php?exit=true">退出登录</a></li>
								</ul>
							</div>
						</li>
					</ul>
				</div>
				<div class="h-search">
					<form method="post" action="../forum/script/search.php">
						<input type="text" name="h-search" title="内容搜索栏……">
						<input type="submit" class="btn_GO" name="" value="GO">
					</form>
				</div>
				<!-- 博客编写弹出效果书签按钮 -->
				<div class="bookmark" id="bookmark"></div>
			</div>
		</div>
	</div>
	<!-- 主页主体内容 -->
	<div class="main">
		<div class="main-left">
			<!-- 博客发表窗口 -->
			<div class="Write-blog" id="Write-blog">
				<div class="Write-blog-img">
					<img src="images/s3.png"><h3>发表新博客</h3>
				</div>
				<form method="post" action="" enctype="multipart/form-data">
					<input type="text" name="title" title="请填写博客标题……" placeholder="请填写标题..." required><br>
					<textarea rows="13" cols="100" name="content" title="请填写博客内容……" required></textarea><br>
					<input type="submit" name="Write_blog" value="发表">
					<input type="reset" name="" value="清空">
					<a href="javascript:void(0)" class="Write_blog_a">
						添加图片<input type="file" name="Write_blog_img">
					</a>
				</form>
			</div>
			<!-- 加载数据库文章内容 -->
			<?php require_once "script/WriteBlog.php"; ?>
			<!-- <div class="List-articles">
				<img src="images/logo.png">
				<h2>标题</h2>
				<span>浏览数</span>
				<span>❤ num</span>
			</div> -->
			<?php #require_once "script/load_data.php"; ?>
			<div class="load_data">Loading....</div>
		</div>
		<div class="main-right">
			<div class="user_info">
				<h4><b style="color: red;">||</b>个人信息</h4>
				<div class="user_phone" width="100">
					<img src="images/header/1_05.jpg"  style="border-radius:50%;"></div>
				<div style="width: 120px;">
					<h2><?php echo $u_login_info ?></h2>
					<span><b style="color: red;">等级：</b>99</span>
				</div>
				<div style="width: 330px;">
					<hr> <table>
						<tr><td>原创</td>
							<td>粉丝</td>
							<td>喜欢</td>
							<td>评论</td>
						</tr> <tr>
							<td>517</td>
							<td>8284</td>
							<td>6104</td>
							<td>1万+</td>
						</tr>
					</table><hr>
				</div>
				<div style="width: 330px; margin: 15px auto;">
					<center class="clock"><span id="clock1"></span></center><br>
					<!-- <center class="clock"><span id="clock2"></span></center> -->
				</div>
			</div>
			<div class="history_top">
				<h4><b style="color: red;">||</b>历史排名</h4>
				<?php require_once "script/history.php"; ?>
			</div>
			<div class="Contact_info">
				<h4><b style="color: red;">||</b>联系我们</h4>
				<div><img src="images/download.png"></div>
				<div width="200">
					<span><b>二维码联关注我们</b></span><br><br>
					<span>123456@gmail.com</span><br>
					<span>444-666-22222</span><br>
					<span>QQ客服&nbsp;电话客服</span>
				</div>
				<div id="tabs">
					<script type="text/javascript">
						$(function(){ $( "#tabs" ).tabs(); }); 
					</script>
					<ul><li><a href="#tabs-1">关于</a></li>
						<li><a href="#tabs-2">客服</a></li>
						<li><a href="#tabs-3">成员</a></li>
						<li><a href="#tabs-4">详细信息</a></li>
					</ul>
					<div id="tabs-1">
						<p>我们的团队来自于皇家帝国学院的在校生，我们开发这文学交流平台是为了更多的人分享自己的文章且人更多的人借助我们的平台赏阅好的文章！我们的团队还有好的项目来发中，希望扫码关注我们团队！</p>
					</div>
					<div id="tabs-2"></div>
					<div id="tabs-3"><br>
						<span><b>海口经济学院</b></span><br>
						<span><b>网络学院</b></span><br>
						<span><b>计算机科学与技术2班</b></span>
						<hr>
						<span><b>钟鸿杰</b>：组长<br>&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;代码编写、数据库设计、功能设计、后期运维</span><br>
						<span><b>赵文龙</b>：组员、界面设计、代码编写</span><br>
						<span><b>邓宇轩</b>：组员、PS美工、代码编写</span><br>
					</div>
					<div id="tabs-4">
						<p>团队名称:《Ants》</p>
						<p>名称含义：我们需要像蚂蚁一样团结一致。一个蚂蚁的力量虽然可以把比自己大很多的食物抬起，但是比蚂蚁大几十倍的食物需要更多的蚂蚁合作，如果你有这样的精神可以加入我们的团队！</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>