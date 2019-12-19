//文章发表窗口动画
$(document).ready(function(){
	$("#header li").hover(function(){
		$(this).find("div:first").stop().animate({height:'toggle'}, 500);
	});

	$("#bookmark").click(function(){
		//$("#Write-blog").toggle("explode");
		$("#Write-blog").toggle( "fold", 1000 );
		//$("#Write-blog").toggle( "clip" );
		//$("#Write-blog").toggle("easeOutBounce");
		//$("#Write-blog").stop().animate({height:'toggle'}, 500);
		//$("#Write-blog").toggle( "bounce", { times: 1 }, "slow" );
		//$("#Write-blog").toggleClass("Write-blog", 1000, "easeOutBounce" );
	});
});
//title=""属性样式动画
$(function() {
	$( document ).tooltip({
		track: true
	});
	$(".blog_title, .top").tooltip({
		show: {
	        effect: "explode",
	        delay : 250
		}
	});
});
$(document).ready(function(){
	$(".animation").click(function(){
		$(".animation_box").toggle("explode");
	});
});
//数据加载，点击load_data加载获取数据库中部分数据
/*$(document).ready(function(){
	$(".load_data").click(function(){
		$.ajax({
			type: "post",
			url: "load_data.php",
			data: {num: 10},
			success: function(data){
				window.location.href = "load_data.php";
			},
			error:function(){}
		});
	});
});*/
//#######################################################
//博客评论功能
// $(document).ready(function(){
// 	$("#comment_btn").click(function(){
// 		var comment_text = $("#comment_text").val();
// 		$.ajax({
// 			type: 'post',
// 			url : "../script/comment.php?id=Id",
// 			data: {comment_content: comment_text},
// 			success : function(data){
// 				window.location.reload();
// 				$(".animation").click(function(){});
// 			},
// 			error : function(){}
// 		});	
// 	});
// });
//获取地址栏参数 
//url为空时为调用当前url地址 
// 调用方法为 var params = getPatams();
// function getParams(url) {
//     var theRequest = new Object();
//     if (!url)
//         url = location.href;
//     if (url.indexOf("?") !== -1){
//         var str = url.substr(url.indexOf("?") + 1) + "&";
//         var strs = str.split("&");
//         for (var i = 0; i < strs.length - 1; i++){
//             var key = strs[i].substring(0, strs[i].indexOf("="));
//             var val = strs[i].substring(strs[i].indexOf("=") + 1);
//             theRequest[key] = val;
//         }
//     }
//     return theRequest;
// }
// var params = getParams();
// //获取地址栏上的userName
// var userName =  params.userName;
//#######################################################
//时钟,不知道加什么特效好随便百度放进来的
(function($) {
	var _options = {};
	var _container = {};
	jQuery.fn.MyDigitClock = function(options) {
	    var id = $(this).get(0).id;
	    _options[id] = $.extend({}, $.fn.MyDigitClock.defaults, options);
	    return this.each(function(){
	        _container[id] = $(this);
	        showClock(id);
	    });
	    function showClock(id){
	        var d = new Date;
	        var h = d.getHours();
	        var m = d.getMinutes();
	        var s = d.getSeconds();
	        var ampm = "";
	        if (_options[id].bAmPm){
	            if (h>12){
	                h = h-12;
	                ampm = " PM";
	            }
	            else{
	                ampm = " AM";
	            }
	        }
	        var templateStr = _options[id].timeFormat + ampm;
	        templateStr = templateStr.replace("{HH}", getDD(h));
	        templateStr = templateStr.replace("{MM}", getDD(m));
	        templateStr = templateStr.replace("{SS}", getDD(s));
	        var obj = $("#"+id);
	        obj.css("fontSize", _options[id].fontSize);
	        obj.css("fontFamily", _options[id].fontFamily);
	        obj.css("color", _options[id].fontColor);
	        obj.css("background", _options[id].background);
	        obj.css("fontWeight", _options[id].fontWeight);
	        //change reading
	        obj.html(templateStr)
	        //toggle hands
	        if (_options[id].bShowHeartBeat){
	            obj.find("#ch1").fadeTo(800, 0.1);
	            obj.find("#ch2").fadeTo(800, 0.1);
	        }
	        setTimeout(function(){showClock(id)}, 1000);
	    }
	    function getDD(num){
	        return (num>=10)?num:"0"+num;
	    }
	    function refreshClock(){
	        setupClock();
	    }
	}
	//default values
	jQuery.fn.MyDigitClock.defaults = {
	    fontSize: '50px',
	    fontFamily: 'Microsoft JhengHei, Century gothic, Arial',
	    fontColor: '##545554',
	    fontWeight: 'bold',
	    //background: '#fff',
	    timeFormat: '{HH}<span id="ch1">:</span>{MM}<span id="ch2">:</span>{SS}',
	    bShowHeartBeat: false,
	    bAmPm:false
	};
})(jQuery);
$(document).ready(function(){
	$(function(){
		$("#clock1").MyDigitClock();
	    $("#clock2").MyDigitClock({
	        fontSize:50, 
	        fontFamily:"Century gothic", 
	        fontColor: "#000", 
	        fontWeight:"bold", 
	        bAmPm:true,
	        //background:'#fff',
	        bShowHeartBeat:true
	    });
	});
});