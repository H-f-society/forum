<?php include "../conn.php"; ?>
<head>
	<meta charset="utf-8">
	<title>Ants</title>
	<style type="text/css">
		input{
			height: 20px;
			width: 200px;
		}
		table{
			border: 1px solid;
			margin: 50px auto;
		}
	</style>
</head>
	<a href="../../../forum/index.php">返回首页</a>
	<a href="../../../forum/subpages/root.php">返回管理中心</a>
	<form method="get" action="" style="width:315px; border: 1px solid;margin:50px auto;">
		关键字:<input type="text" name="keywork" placeholder="用户名/文章标题/评论内容">
		<select name="sel">
			<option value="user" selected>用户</option>
			<option value="tiezi">文章</option>
			<option value="comment">评论</option>
		</select><br>
		<input type="submit" name="search" value="搜索" style="width:315px;">
	</form>
<?php
	if(isset($_GET["search"])) {
		$keywork = $_GET["keywork"];
		$sel 	 = $_GET["sel"];
		switch($_GET["sel"]){
			case "user": 
				$keyType = "username"; break;
			case "tiezi": 
				$keyType = "title";    break;
			case "comment": 
				$keyType = "content";  break;
		}
		$sql 	= "select * from $sel where $keyType like '%".$keywork."%'";
		$result = mysql_query($sql, $conn);
		$row 	= mysql_fetch_array($result);
		$id = $row["Id"];
		
		header("location:update.php?id=$id&type=$sel");
	}
?>
<?php  
	$id = intval($_GET["id"]);
	switch($_GET["type"]){
		case "user":
			if(isset($_POST["sub"])) {
				$username = $_POST["username"];
				$password = $_POST["password"];
				$age	  = $_POST["age"];
				$sex	  = $_POST["sex"];
				$email	  = $_POST["email"];
				$phone 	  = $_POST["phone"];
				$state	  = $_POST["state"];
				$type     = $_POST["type"];

				$sql = "update user set username='$username',password='$password',age='$age',sex='$sex',email='$email',phone='$phone',type='$type',state='$state' where Id = $id";
				mysql_query($sql, $conn);
				header("location:/../../../../forum/subpages/root.php");
			}

			$result = mysql_query("select * from user where Id = $id");
			$row 	= mysql_fetch_array($result);
			$sex1 = $sex2 = $state1 = $state2 = $type1 = $type2 = "";
			if($row["sex"] == '男'){
				$sex1 = "checked";
			}else{
				$sex2 = "checked";
			}
			if($row["state"] == '启用'){
				$state1 = "checked";
			}else{
				$state2 = "checked";
			}
			if($row['type'] == '管理员'){
				$type1 = "selected";
			}else{
				$type2 = "selected";
			}
?>
			<form method="post">
				<table border="1" width="500px">
					<tr><td>用户名:</td>
						<td><input type="text" name="username" value="<?php echo $row['username'];?>"></td>
					</tr>
					<tr><td>密码:</td>
						<td><input type="text" name="password" value="<?php echo $row['password'];?>"></td>
					</tr>
					<tr><td>年龄:</td>
						<td><input type="text" name="age" value="<?php echo $row['age'];?>"></td>
					</tr>
					<tr><td>性别:</td>
						<td><input type="radio" name="sex" value="男" <?php echo $sex1;?> style="width:20px;height:15px;">男
							<input type="radio" name="sex" value="女" <?php echo $sex2;?> style="width:20px;height:15px;">女
						</td>
					</tr>
					<tr><td>邮箱:</td>
						<td><input type="text" name="email" value="<?php echo $row['email'];?>"></td>
					</tr>
					<tr><td>电话:</td>
						<td><input type="text" name="phone" value="<?php echo $row['phone'];?>"></td>
					</tr>
					<tr><td>状态:</td>
						<td><input type="radio" name="state" value="启用" <?php echo $state1;?> style="width:20px;height:15px;">启用
							<input type="radio" name="state" value="禁用" <?php echo $state2;?> style="width:20px;height:15px;">禁用
						</td>
					</tr>
					<tr><td>用户类型:</td>
						<td><select name="type">
								<option value="管理员" <?php echo $type1;?>>管理员</option>
								<option value="会员"   <?php echo $type2;?>>会员</option>
							</select>
						</td>
					</tr>
					<tr><td></td>
						<td><input type="submit" name="sub" value="修改"></td>
					</tr>
				</table>
			</form>
<?php
			break;
		case "tiezi":
			if(isset($_POST["sub"])) {
				$title      = $_POST["title"];
				$username   = $_POST["username"];
				$time	    = $_POST["time"];
				$praise	    = $_POST["praise"];
				$click_rate = $_POST["click_rate"];
				$content = $_POST["content"];

				$sql = "update tiezi set title='$title',username='$username',time='$time',praise='$praise',click_rate='$click_rate',content='$content' where Id = $id";
				mysql_query($sql, $conn);
				header("location:/../../../../forum/subpages/root.php");
			}
			$result = mysql_query("select * from tiezi where Id = $id");
			$row 	= mysql_fetch_array($result);
?>
			<form method="post">
				<table border="1" width="800px">
					<tr><td>标题:</td>
						<td><input type="text" name="title" value="<?php echo $row['title'];?>"></td>
					</tr>
					<tr><td>作者:</td>
						<td><input type="text" name="username" value="<?php echo $row['username'];?>"></td>
					</tr>
					<tr><td>时间:</td>
						<td><input type="text" name="time" value="<?php echo $row['time'];?>"></td>
					</tr>
					<tr><td>点赞数:</td>
						<td><input type="text" name="praise" value="<?php echo $row['praise'];?>"></td>
					</tr>
					<tr><td>访问量:</td>
						<td><input type="text" name="click_rate" value="<?php echo $row['click_rate'];?>"></td>
					</tr>
					<tr><td>文章内容:</td>
						<td><textarea rows="13" cols="100" name="content"><?php echo $row['content'];?></textarea></td>
					</tr>
					<tr><td></td>
						<td><input type="submit" name="sub" value="修改"></td>
					</tr>
				</table>
			</form>
<?php
			break;
		case "comment":
			if(isset($_POST["sub"])) {
				$article_id = $_POST["article_id"];
				$username   = $_POST["username"];
				$content	= $_POST["content"];
				$time	  	= $_POST["time"];

				$sql = "update comment set article_id='$article_id',username='$username',content='$content',time='$time' where Id = $id";
				mysql_query($sql, $conn);
				header("location:/../../../../forum/subpages/root.php");
			}
			$result = mysql_query("select * from comment where Id = $id");
			$row 	= mysql_fetch_array($result);
?>
			<form method="post">
				<table border="1" width="500px">
					<tr><td>评论文章id:</td>
						<td><input type="text" name="article_id" value="<?php echo $row['article_id'];?>"></td>
					</tr>
					<tr><td>用户名:</td>
						<td><input type="text" name="username" value="<?php echo $row['username'];?>"></td>
					</tr>
					<tr><td>评论内容:</td>
						<td><input type="text" name="content" value="<?php echo $row['content'];?>"></td>
					</tr>
					<tr><td>评论时间:</td>
						<td><input type="text" name="time" value="<?php echo $row['time'];?>"></td>
					</tr>
					<tr><td></td>
						<td><input type="submit" name="sub" value="修改"></td>
					</tr>
				</table>
			</form>
<?php
			
			break;
	}

	
?>
