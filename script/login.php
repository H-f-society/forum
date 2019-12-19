<?php  
	/*登录与注册页面，后台处理
	*/
	session_start();
	require_once "conn.php";

	#登录界面表单信息验证，登录帐号与密码设置初始变量
	$L_username = $L_password = "";
	#注册界面表单信息验证。
	$R_username = $R_password = $R_againpwd  = $R_email = "";

	#whether the information submitted is post
	#判断表单提交信息是否为post值
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		#登录界面表单信息验证。
		if(isset($_POST["btn_login"])){
			#放入test_input()函数过滤表单信息
			$L_username = test_input($_POST["L_username"]);	#用户名
			$L_password = test_input($_POST["L_password"]);	#密码
			#数据库查找(用户名或邮箱)与登录密码是否存在且匹配，mysql_query()执行sql语句
			#mysql_num_rows()返回结果集中行的数目
			$sql_db_table_user_pwd = "select * from $table_name where ($table_username = '$L_username' or $table_email = '$L_username') and $table_password = '$L_password'";/* and status='启用'*/
			$result_user_pwd = mysql_query($sql_db_table_user_pwd);
			$L_row = mysql_num_rows($result_user_pwd);
			if($L_row != 0){
				#将登录信息存入session，重定向到主页index.php
			 	$_SESSION["username"] = $L_username;
			 	#$_SESSION["password"] = $L_password;
			 	#session_id();
			 	#setcookie("sessionId", session_id());
			 	header("location:../index.php");
			}else{
				?>
				<script type="text/javascript">
					alert("用户名或密码错误(或用户已被禁用)!");
				</script>
				<?php
			}
		}
		#注册界面表单信息验证。
		if(isset($_POST["btn_register"])){
			#放入test_input()函数过滤表单信息
			$R_username = test_input($_POST["R_username"]);	#用户名
			$R_password = test_input($_POST["R_password"]);	#密码
			$R_againpwd = test_input($_POST["R_againpwd"]);	#确认密码
			$R_email	= test_input($_POST["R_email"]);   	#邮箱
			#查询数据库中用户名或电子邮箱是否存在
			$sql_db_table_user_email = "select * from $table_name where username = '$R_username' or email = '$R_email'";
			$result_userr_email = mysql_query($sql_db_table_user_email);
			#用户名与邮箱不存在，可以注册此账户，不存在时提示错误
			$R_row = mysql_num_rows($result_userr_email);
			if($R_row == 0){
				#匹配两次输入密码
				if($R_password != $R_againpwd){
					?>
					<script type="text/javascript">
						alert("密码不一致!");
					</script>
					<?php
				}else{
					#将注册表单信息添加到数据库中
					$Insert = "insert into $table_name(username, password, email) values('$R_username', '$R_password', '$R_email')";
					if(mysql_query($Insert)){
						#将已成功注册的信息存入session，重定向到主页index.php
						$_SESSION["username"] = $R_username;
						#$_SESSION["password"] = $R_password;
						header("location:../index.php");
						mysql_close();
					}
				}
			}else{
				?>
				<script type="text/javascript">
					alert("用户名或邮箱已被注册!");
				</script>
				<?php
			}
		}

	}
	#过滤表单提交信息，过滤掉数据加进来的恶意代码
	#trim() 移除字符串两侧的空白字符或其他预定义字符。
	#stripslashes() 删除由 addslashes() 函数添加的反斜杠
	#htmlspecialchars() 把预定义的字符转换为 HTML 实体。
	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);		
		$data = htmlspecialchars($data);	
		return $data;
	}

	if(@$_GET["exit"]==true){
		unset($_SESSION['username']);
	}
?>