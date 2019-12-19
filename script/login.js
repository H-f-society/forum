window.onload = function(){ 
	code();//界面刷新时执行code()函数
	$("#login").toggle("explode");
}
function code(){
	var code = document.getElementById("code-num");
	code.value = parseInt(Math.floor(Math.random()*9000)+1000);
	code.style.backgroundColor = ran();
}
function ran(){
	var c = "#";
	for(var i=0; i<6; i++){
		c += parseInt(Math.random()*16).toString(16);
	}
	return c;
}

// $().load(function(){
//   	$("#box").show("fold", 1000);
//   	$( "#toggle" ).effect( "shake" );
// });

$(document).ready(function(){
	$("#h-login").click(function(){
		$("#login").toggle("explode");
		$("#register").hide("explode");
	});
	$("#h-register").click(function(){
		$("#register").toggle("explode");
		$("#login").hide("explode");
	});
});
$(document).ready(function(){
	$(".code").blur(function(){
		var code_num1 = $(this).val();
		var code_num2 = $("#code-num").val();
		$.ajax({
			type: "POST",
			url : "../script/code_num.php",
			data: {
				code1: code_num1, 
				code2: code_num2
			},
			success:function(data){
				if(data == "1"){
					alert("验证码输入错误!");
				}else if(data == "2"){
					alert("请输入验证码!");
				}
			},
			erroe:function(){}
		});
	});
});