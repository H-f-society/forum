<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="../script/jquery-ui.min.css">
	<link rel="stylesheet" type="text/css" href="../css/login.css">
	<!-- JQuery库文件 -->
	<script type="text/javascript" src="../script/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="../script/jquery-ui.min.js"></script>
	<script type="text/javascript" src="../script/login.js"></script>
</head>
<body>
	<?php 
		require_once "../script/login.php";
	?>
	<div id="box">
		<ul>
			<!-- 登录窗口 -->
			<li><h2 id="h-login">登录</h2>
				<div id="login">
					<!-- 
						htmlspecialchars($_SERVER["PHP_SELF"]), 获取当前文件路径，并转换为字符
						可以将地址栏中的恶意代码转换为字符而无法运行，提高安全 
					-->
					<form method="post" name="login" class="form1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
						<input type="text" name="L_username" placeholder="用户名/邮箱" required><br>
						<input type="password" name="L_password" placeholder="密码" required><br>
						<input type="text" class="code" name="code1" placeholder="验证码" required>
						<input type="button" id="code-num" name="code2" onclick="code()"><br>
						<input type="submit" name="btn_login" value="登录">
					</form>
				</div>
			</li>
			<!-- 注册窗口 -->
			<li><h2 id="h-register">注册</h2>
				<div id="register">
					<form method="post" name="register" class="form2" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
						<input type="text" name="R_username" placeholder="用户名(字母)" required pattern="^[a-zA-Z]*$" value="<?php echo $R_username; ?>"><br>
						<input type="password" name="R_password" placeholder="密码(6-18字母数字)" required pattern=^[a-zA-Z]\w{5,17}$ value="<?php echo $R_password; ?>"><br>
						<input type="password" name="R_againpwd" placeholder="确认密码" required value="<?php echo $R_againpwd; ?>"><br>
						<input type="text" name="R_email" placeholder="邮箱" required pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" value="<?php echo $R_email; ?>"><br>
						<input type="submit" name="btn_register" value="注册">
					</form>
				</div>
			</li>
		</ul>
	</div>
</body>
</html>