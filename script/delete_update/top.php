<?php 
	if(@$_GET["top"] != "" && @$_GET["type"]){
		$top  = $_GET["top"];
		$type = $_GET["type"];
		$sql  = "select * from $type where Id = $top";

		$result = mysql_query($sql, $conn);
		$row 	= mysql_fetch_array($result);
		echo "<table border='1' width='96%' style='margin:0 auto;'>";
		switch($_GET["type"]){
			case "user": 
			?> <tr bgcolor="#A3CECF">
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
					<td>取消置顶</td>
					<td>修改</td>
					<td>删除</td>
				</tr>
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
					<td><a href="../../../forum/subpages/root.php">取消置顶</a></td>
					<td><a href="../script/delete_update/update.php?id=<?php echo $row['Id']; ?>&type=user">修改</a></td>
					<td><a href="../script/delete_update/delete.php?id=<?php echo $row['Id']; ?>&type=user">删除</a></td>
				</tr>
			<?php
				break;
			case "tiezi":
			?> <tr bgcolor="#A3CECF">
					<td>Id</td>
					<td>标题</td>
					<td>作者</td>
					<td>时间</td>
					<td>点赞</td>
					<td>访问量</td>
					<td>取消置顶</td>
					<td>修改</td>
					<td>删除</td>
				</tr>
				<tr><td><?php echo $row["Id"]; ?></td>
					<td><?php echo $row["title"]; ?></td>
					<td><?php echo $row["username"]; ?></td>
					<td><?php echo $row["time"]; ?></td>
					<td><?php echo $row["praise"]; ?></td>
					<td><?php echo $row["click_rate"]; ?></td>
					<td><a href="../../../forum/subpages/root.php">取消置顶</a></td>
					<td><a href="../script/delete_update/update.php?id=<?php echo $row['Id']; ?>&type=tiezi">修改</a></td>
					<td><a href="../script/delete_update/delete.php?id=<?php echo $row['Id']; ?>&tyoe=tiezi">删除</a></td>
				</tr>
			<?php 
				break;
			case "comment": 
			?> <tr bgcolor="#A3CECF">
					<td>Id</td>
					<td>评论文章id</td>
					<td>用户名</td>
					<td>评论内容</td>
					<td>评论时间</td>
					<td>取消置顶</td>
					<td>修改</td>
					<td>删除</td>
				</tr>
				<tr><td><?php echo $row["Id"]; ?></td>
					<td><?php echo $row["article_id"]; ?></td>
					<td><?php echo $row["username"]; ?></td>
					<td><?php echo $row["content"]; ?></td>
					<td><?php echo $row["time"]; ?></td>
					<td><a href="../../../forum/subpages/root.php">取消置顶</a></td>
					<td><a href="../script/delete_update/update.php?id=<?php echo $row['Id']; ?>&type=comment">修改</a></td>
					<td><a href="../script/delete_update/delete.php?id=<?php echo $row['Id']; ?>&type=comment">删除</a></td>
				</tr>
			<?php
				break;
		}
		echo "</table><br><br>";
	}
?>