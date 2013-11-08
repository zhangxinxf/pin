<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html><html><head><!-- Meta, title, CSS, favglyphicons, etc. --><meta charset="utf-8"><title>首页</title><meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0"><meta name="description" content=""><!-- Bootstrap --><link href="__STATIC__/css/custom/assets/css/bootstrap.css" rel="stylesheet" media="screen"><link href="__STATIC__/css/custom/css/changan.css" rel="stylesheet" media="screen"><!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries --><!--[if lt IE 9]><script src="assets/js/html5shiv.js"></script><script src="assets/js/respond/respond.min.js"></script><![endif]--><style type="text/css">*{ 
margin:0; 
padding:0; 
} 
h1{ 
text-align:center; 
height:100px; 
} 
body{ 
background-color:RGB(232,231,226); 
} 
.all{ 
margin:0 auto; 
width:1000px; 
} 
.number{ 
float:left; 
width:225px; 
} 
.content 
{ 
margin:5px; 
background-color:white; 
} 
img{ 
margin:5px; 
} 
.loading{ 
position: absolute; 
width:100%; 
height:40px; 
display:none; 
text-align:center; 
background-color:RGB(189,203,207); 
} 
#toTop 
{ 
position:fixed; 
_position:fixed; 
font-size:12px; 
color:Blue; 
width:15px; 
text-align:center; 
right:300px; 
bottom:100px; 
cursor:pointer; 
background-color:RGB(243,247,251); 
display:none; 
} 
</style><script type="text/javascript">window.onload = function () { 
//初始参数 
var reset = 0; //某些滚动条会触发三次scroll事件 用这个解决 
var surplusHeight = 800; //差值 
var imgWidth = "206px"; //img的宽度 
var imgHeight = 0; //img的高度 
var textHeight = 0; //文字高度 
var showTopButtonHeight = 500;//回到顶部按钮的距离 
var bigDivCount = 4; //一次性加载个数
var div1 = $("one"); 
var div2 = $("two"); 
var loading = $("loading"); 
var toTop = $("toTop"); 
//得到浏览器的名称 
var browser = getBrowser(); 
//数据源 
var imgArray = []; //img数组 也就是数据来源 
var textArray = []; //img底下的文字和img对应 
textArray[0] = "小花美女"; 
textArray[1] = "小花美女小花美女"; 
textArray[2] = "小花美女小花美女小花美女"; 
textArray[3] = "小花美女小花美女小花美女小花美女"; 
textArray[4] = "小花美女 小花美女"; 
textArray[5] = "小花美女小花小花美女"; 
textArray[6] = "小花美女"; 
textArray[7] = "小花美女小花美女"; 
textArray[8] = "小花美女小花美女小花美女"; 
textArray[9] = "小花美女小花美女小花美女小花美女小花美女"; 
textArray[10] = "小花美女小花美女小花美女小花美女小花美女"; 
textArray[11] = "小花美女小花美女小花美女小花美女小花美女小花美女"; 
textArray[12] = "小花美女小花美女小花美女小花美女小花美女小花美女小花美女"; 
textArray[13] = "小花美女小花美女小花美女小花美女小花美女小花美女小花美女小花美女"; 
textArray[14] = "小花美女小花美女小花美女小花美女小花美女小花美女小花美女小花美女"; 
textArray[15] = "小花美女小花美女小花美女小花美女小花美女小花美女小花美女小花美女"; 
imgArray[0] = "http://files.jb51.net/file_images/article/201211/960bda11tw1dnw504ga3vj.jpg"; 
imgArray[1] = "http://files.jb51.net/file_images/article/201211/771f735ctw1dnw5gv6dmcj.jpg"; 
imgArray[2] = "http://files.jb51.net/file_images/article/201211/5d5e9605gw1dnw4o6uk3gj.jpg"; 
imgArray[3] = "http://files.jb51.net/file_images/article/201211/6d9cb0b8jw1dnw5m0y5yrj.jpg"; 
imgArray[4] = "http://files.jb51.net/file_images/article/201211/62dae985gw1dnzc4mwvm5j.jpg"; 
imgArray[5] = "http://files.jb51.net/file_images/article/201211/8d95fb4cgw1dnzec2c6cdj.jpg"; 
imgArray[6] = "http://files.jb51.net/file_images/article/201211/872bccc8jw1dnzch2aqtkj.jpg"; 
imgArray[7] = "http://files.jb51.net/file_images/article/201211/5b104465tw1dnzdlozp6tj.jpg"; 
imgArray[8] = "http://files.jb51.net/file_images/article/201211/6de170f6jw1dnzl7jbzidj.jpg"; 
imgArray[9] = "http://files.jb51.net/file_images/article/201211/6a93dbfbgw1dnzeiu1draj.jpg"; 
imgArray[10] = "http://files.jb51.net/file_images/article/201211/6ea59a74jw1dnzm0wbf7vj.jpg"; 
imgArray[11] = "http://files.jb51.net/file_images/article/201211/48bf076ejw1dnzexjhl6dj.jpg"; 
imgArray[12] = "http://files.jb51.net/file_images/article/201211/6da7993fjw1dnvsnesrutj.jpg"; 
imgArray[13] = "http://files.jb51.net/file_images/article/201211/75914d3fgw1dnzlgn33njj.jpg"; 
imgArray[14] = "http://files.jb51.net/file_images/article/201211/6a8dea72gw1dnzlwnfju0j.jpg"; 
imgArray[15] = "http://files.jb51.net/file_images/article/201211/696387aagw1dnzqd829yyj.jpg"; 
//初始化 
loadImg(); 
//主会场 
window.onscroll = fun_scroll; 
//滚动方法 
function fun_scroll() { 
//body的高度 
var topAll = (browser == "Firefox") ? document.documentElement.scrollHeight : document.body.scrollHeight; 
//卷上去的高度 
var top_top = document.body.scrollTop || document.documentElement.scrollTop; 
//回到顶部按钮操作 
if (top_top > showTopButtonHeight) 
toTop.style.display = "block"; 
else 
toTop.style.display = "none"; 
//控制滚动条次数以及判断是否到达底部 
if (reset == 0) { 
var topAll = (browser == "Firefox") ? document.documentElement.scrollHeight : document.body.scrollHeight; //body的高度 
var top_top = document.body.scrollTop || document.documentElement.scrollTop; //卷上去的高度 
var result = topAll - top_top; 
if (result < surplusHeight) { 
setTimeout(loadImg, 1000); 
reset = 1; 
} 
} else { 
setTimeout(function () { reset = 0; }, 1000); 
} 
} 
//加载图片 
function loadImg() { 
loading.style.display = "none"; 
for (var i = 0; i < bigDivCount; i++) { 
div1.appendChild(addDiv()); 
div2.appendChild(addDiv());  
} 
setTimeout(function () { 
var hh = (browser == "Firefox") ? document.documentElement.scrollHeight : document.body.scrollHeight; 
loading.style.top = hh + "px"; 
loading.style.display = "block"; 
}, 1000); 
} 
//声明一个包含img和title的div 
function addDiv() { 
//数组下标的随机值 
var ran = Math.round(Math.random() * (imgArray.length - 1)); 
//title层 
var small_div = document.createElement("div"); 
small_div.innerHTML = textArray[ran]; 
//内部img 
var img = document.createElement("img"); 
img.alt = ""; 
img.src = imgArray[ran]; 
img.style.width = imgWidth; 
//包含img的层 
var div = document.createElement("div"); 
div.className = "content"; 
div.appendChild(img); 
div.appendChild(small_div); 
return div; 
} 
//通过id得到对象 
function $(id) { 
return document.getElementById(id); 
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
</script></head><body><div class="navbar-inverse navbar-fixed-top"><div class="container"><div class="homebtn fl"><a href="index.html">首页</a></div><div class="cate fr"><a href="list.html">分类</a></div></div></div><!-- Carousel--><div class="container"><div class="banner"><img src="__STATIC__/css/custom/images/pic.png"></div><div class="more"><a href="hot.html">热门宝贝</a></div><div class="row show-grid"><div class="col-12"><div class="col-6 photo" id="one"><div class="photoimg"><img src="__STATIC__/css/custom/images/photo.png" alt=""><div class="slogo"><img src="__STATIC__/css/custom/images/slogo.png"></div><div class="pay">80.11</div></div><p><a href="detail.html">OSA2013秋装新款女装衣服上衣蕾丝小衫打底衫显瘦t恤女长房顶上发生地方式地方放大沙发上的袖T32482 </a></p><div class="photoimg"><img src="__STATIC__/css/custom/images/photo.png" alt=""><div class="slogo"><img src="__STATIC__/css/custom/images/slogo.png"></div><div class="pay">80.11</div></div><p><a href="detail.html">OSA2013秋装新款女装衣服上衣蕾丝小衫打底衫显瘦t恤女长房顶上发生地方式地方放大沙发上的袖T32482 </a></p><div class="photoimg"><img src="__STATIC__/css/custom/images/photo.png" alt=""><div class="slogo"><img src="__STATIC__/css/custom/images/slogo.png"></div><div class="pay">80.11</div></div><p><a href="detail.html">OSA2013秋装新款女装衣服上衣蕾丝小衫打底衫显瘦t恤女长房顶上发生地方式地方放大沙发上的袖T32482 </a></p><div class="photoimg"><img src="__STATIC__/css/custom/images/photo.png" alt=""><div class="slogo"><img src="__STATIC__/css/custom/images/slogo.png"></div><div class="pay">80.11</div></div><p><a href="detail.html">OSA2013秋装新款女装衣服上衣蕾丝小衫打底衫显瘦t恤女长房顶上发生地方式地方放大沙发上的袖T32482 </a></p><div class="photoimg"><img src="__STATIC__/css/custom/images/photo.png" alt=""><div class="slogo"><img src="__STATIC__/css/custom/images/slogo.png"></div><div class="pay">80.11</div></div><p><a href="detail.html">OSA2013秋装新款女装衣服上衣蕾丝小衫打底衫显瘦t恤女长房顶上发生地方式地方放大沙发上的袖T32482 </a></p><div class="photoimg"><img src="__STATIC__/css/custom/images/photo.png" alt=""><div class="slogo"><img src="__STATIC__/css/custom/images/slogo.png"></div><div class="pay">80.11</div></div><p><a href="detail.html">OSA2013秋装新款女装衣服上衣蕾丝小衫打底衫显瘦t恤女长房顶上发生地方式地方放大沙发上的袖T32482 </a></p></div><div class="col-6 photo"    id="two"><div class="photoimg"><img src="__STATIC__/css/custom/images/photo.png" alt=""><div class="slogo"><img src="__STATIC__/css/custom/images/slogo.png"></div><div class="pay">80.11</div></div><p><a href="detail.html">OSA2013秋装新款女装衣服上衣蕾丝小衫打底衫显瘦t恤女长房顶上发生地方式地方放大沙发上的袖T32482 </a></p><div class="photoimg"><img src="__STATIC__/css/custom/images/photo.png" alt=""><div class="slogo"><img src="__STATIC__/css/custom/images/slogo.png"></div><div class="pay">80.11</div></div><p><a href="detail.html">OSA2013秋装新款女装衣服上衣蕾丝小衫打底衫显瘦t恤女长房顶上发生地方式地方放大沙发上的袖T32482 </a></p><div class="photoimg"><img src="__STATIC__/css/custom/images/photo.png" alt=""><div class="slogo"><img src="__STATIC__/css/custom/images/slogo.png"></div><div class="pay">80.11</div></div><p><a href="detail.html">OSA2013秋装新款女装衣服上衣蕾丝小衫打底衫显瘦t恤女长房顶上发生地方式地方放大沙发上的袖T32482 </a></p><div class="photoimg"><img src="__STATIC__/css/custom/images/photo.png" alt=""><div class="slogo"><img src="__STATIC__/css/custom/images/slogo.png"></div><div class="pay">80.11</div></div><p><a href="detail.html">OSA2013秋装新款女装衣服上衣蕾丝小衫打底衫显瘦t恤女长房顶上发生地方式地方放大沙发上的袖T32482 </a></p><div class="photoimg"><img src="__STATIC__/css/custom/images/photo.png" alt=""><div class="slogo"><img src="__STATIC__/css/custom/images/slogo.png"></div><div class="pay">80.11</div></div><p><a href="detail.html">OSA2013秋装新款女装衣服上衣蕾丝小衫打底衫显瘦t恤女长房顶上发生地方式地方放大沙发上的袖T32482 </a></p><div class="photoimg"><img src="__STATIC__/css/custom/images/photo.png" alt=""><div class="slogo"><img src="__STATIC__/css/custom/images/slogo.png"></div><div class="pay">80.11</div></div><p><a href="detail.html">OSA2013秋装新款女装衣服上衣蕾丝小衫打底衫显瘦t恤女长房顶上发生地方式地方放大沙发上的袖T32482 </a></p></div></div></div><div id="loading" class="loading"><img src="http://files.jb51.net/file_images/article/201211/200803131036175436.gif" /></div><div id="toTop"><span>△回顶部</span></div></div><!-- /container --><div class="footer"><div class="container">		fsdfsssssssssssssss
	</div></div><!-- JavaScript plugins (requires jQuery) --><script src="__STATIC__/css/custom/assets/js/jquery.js"></script><!-- Include all compiled plugins (below), or include individual files as needed --><script src="__STATIC__/css/custom/assets/js/bootstrap.min.js"></script><script src="__STATIC__/css/custom/assets/js/holder/holder.js"></script><script type="text/javascript"></script></body></html>