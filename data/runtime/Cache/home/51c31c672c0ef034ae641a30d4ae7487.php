<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html><html><head><!-- Meta, title, CSS, favglyphicons, etc. --><meta charset="utf-8"><title>商品明细</title><meta name="viewport"
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
</style></head><body><div class="navbar-inverse navbar-fixed-top"><div class="container"><div class="homebtn fl"><a href="__ROOT__/?m=index&a=index&sort=hot">首页</a></div><div class="cate fr"><a href="list.html">分类</a></div></div></div><div class="container"><div class="row"><div class="col-12 detail"><div class="photo2"><div class="photoimg2"><img src="<?php echo ($item["img"]); ?>" alt=""><div class="pay"><?php echo ($item["price"]); ?></div></div><p><a href="<?php echo ($item["url"]); ?>" target="_blank"><?php echo ($item["intro"]); ?></a></p></div></div></div></div><!-- /container --><div class="footer"><div class="container"></div></div></body></html>