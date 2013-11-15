<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html><html><head><!-- Meta, title, CSS, favglyphicons, etc. --><meta charset="utf-8"><title>首页</title><meta name="viewport"
	content="width=device-width, user-scalable=no, initial-scale=1.0"><meta name="description" content=""><!-- Bootstrap --><link href="__STATIC__/css/custom/assets/css/bootstrap.css"
	rel="stylesheet" media="screen"><link href="__STATIC__/css/custom/css/changan.css" rel="stylesheet"
	media="screen"><script src="__STATIC__/css/custom/assets/js/jquery-1.9.0.js"></script><script src="__STATIC__/css/custom/assets/js/jquery-migrate-1.0.0.js"></script><script src="__STATIC__/css/custom/assets/js/bootstrap.min.js"></script><script src="__STATIC__/css/custom/assets/js/holder/holder.js"></script><style type="text/css">* {
	margin: 0;
	padding: 0;
}

h1 {
	text-align: center;
	height: 100px;
}

body {
	background-color: RGB(232, 231, 226);
}

.all {
	margin: 0 auto;
	width: 1000px;
}

.number {
	float: left;
	width: 225px;
}

.content {
	margin: 5px;
	background-color: white;
}

img {
	margin: 5px;
}

.loading {
	position: absolute;
	width: 100%;
	height: 40px;
	display: none;
	text-align: center;
	background-color: RGB(189, 203, 207);
}

#toTop {
	position: fixed;
	_position: fixed;
	font-size: 12px;
	color: Blue;
	width: 15px;
	text-align: center;
	right: 300px;
	bottom: 100px;
	cursor: pointer;
	background-color: RGB(243, 247, 251);
	display: none;
}
</style><script type="text/javascript">	window.onload = function() {
		//初始参数 
		var reset = 0; //某些滚动条会触发三次scroll事件 用这个解决 
		var surplusHeight = 800; //差值 
		var imgWidth = "206px"; //img的宽度 
		var imgHeight = 0; //img的高度 
		var textHeight = 0; //文字高度 
		var showTopButtonHeight = 500;//回到顶部按钮的距离 
		var bigDivCount = 4; //一次性加载个数
		var loading = document.getElementById("loading");
		var toTop = document.getElementById("toTop");
		//得到浏览器的名称 
		var browser = getBrowser();
		//初始化 
		//loadImg();
		//主会场 
		window.onscroll = fun_scroll;
		//滚动方法 
		function fun_scroll() {
			//是否已全部加载
			var end = $("#end").val();
			if (end == '1') {
				return;
			}
			//body的高度 
			var topAll = (browser == "Firefox") ? document.documentElement.scrollHeight
					: document.body.scrollHeight;
			//卷上去的高度 
			var top_top = document.body.scrollTop
					|| document.documentElement.scrollTop;
			//回到顶部按钮操作 
			if (top_top > showTopButtonHeight)
				toTop.style.display = "block";
			else
				toTop.style.display = "none";
			//控制滚动条次数以及判断是否到达底部 
			if (reset == 0) {
				var topAll = (browser == "Firefox") ? document.documentElement.scrollHeight
						: document.body.scrollHeight; //body的高度 
				var top_top = document.body.scrollTop
						|| document.documentElement.scrollTop; //卷上去的高度 
				var result = topAll - top_top;
				if (result < surplusHeight) {
					setTimeout(loadImg, 1000);
					reset = 1;
				}
			} else {
				setTimeout(function() {
					reset = 0;
				}, 1000);
			}
		}
		//加载图片 
		function loadImg() {
			loading.style.display = "none";
			var pageNum = document.getElementById("pageNum").value;
			$.ajax({
				url : '__ROOT__/?m=book&a=index_ajax&sort=hot&p=' + pageNum,
				type : "POST",
				dataType : "json",
				success : function(result) {
					$("#pageNum").val(result.msg);
					$("#end").val(result.dialog);
					var datas = result.data;
					for ( var i in datas) {
						var item = datas[i];
							$("#one").append(
									addDiv(item.img, item.price,
											'__ROOT__/?m=item&a=index&id='
													+ item.id, item.title));
					}
				}
			});
			setTimeout(
					function() {
						var hh = (browser == "Firefox") ? document.documentElement.scrollHeight
								: document.body.scrollHeight;
						loading.style.top = hh + "px";
						var end = $("#end").val();
						if (end != '1') {
							loading.style.display = "block";
						}
					}, 1000);
		}
		//声明一个包含img和title的div 
		function addDiv(img, price, url, title) {
			var html = "<div class='photoimg'><img src='"+img+"' alt=''><div class='pay'>"
					+ price
					+ "</div></div><p><a href='"+url+"'>"
					+ title
					+ "</a></p>";
			return html;
		}

		//得到浏览器的名称 
		function getBrowser() {
			var OsObject = "";
			if (navigator.userAgent.indexOf("MSIE") > 0) {
				return "MSIE";
			}
			if (isFirefox = navigator.userAgent.indexOf("Firefox") > 0) {
				return "Firefox";
			}
			if (isSafari = navigator.userAgent.indexOf("Safari") > 0) {
				return "Safari";
			}
			if (isCamino = navigator.userAgent.indexOf("Camino") > 0) {
				return "Camino";
			}
			if (isMozilla = navigator.userAgent.indexOf("Gecko/") > 0) {
				return "Gecko";
			}
		}
		//回到顶部  这段代码先屏蔽
		//toTop.onclick = function () { 
		//var count = 500; //每次的距离 
		//var speed = 200; //速度 
		//var timer = setInterval(function () { 
		//var top_top = document.body.scrollTop || document.documentElement.scrollTop; 
		//var tt = top_top - count; 
		//tt = (tt < 300) ? 0 : tt; 
		//if (top_top > 0) 
		//window.scrollTo(tt, tt); 
		//else 
		//clearInterval(timer); 
		//}, speed) 
		//}; 
	}
</script></head><body><div class="navbar-inverse navbar-fixed-top"><div class="container"><div class="homebtn fl"><a href="index.html">首页</a></div><div class="cate fr"><a href="list.html">分类</a></div></div></div><input type="hidden" id="pageNum" value="<?php echo ($p); ?>"><input type="hidden" id="end" value="0"><!-- Carousel--><div class="container"><div class="row"><div class="col-12 detail"><div class="photo3"   id="one"><?php if(is_array($item_list)): $i = 0; $__LIST__ = $item_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><div class="photoimg3"><img src="<?php echo ($data["img"]); ?>" alt=""><div class="pay"><?php echo ($data["price"]); ?></div></div><p><a href="__ROOT__/?m=item&a=index&id=<?php echo ($data["id"]); ?>"><?php echo ($data["title"]); ?></a></p><?php endforeach; endif; else: echo "" ;endif; ?></div></div></div></div><!-- /container --><div id="loading" class="loading"><img
				src="http://files.jb51.net/file_images/article/201211/200803131036175436.gif" /></div><div id="toTop"><span>△回顶部</span></div><div class="footer"><div class="container"></div></div></body></html>