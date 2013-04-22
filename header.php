<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title><?php echo $title?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/layout.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/prettyPhoto.css" type="text/css">
<script src="js/jquery.min.js" type="text/javascript"></script>

<script type="text/javascript" src="js/sprites.js"></script>
<script type="text/javascript" src="js/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="js/gSlider.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/jquery.prettyPhoto.js"></script>

<!--[if lt IE 7]> <div style=' clear: both; height: 59px; padding:0 0 0 15px; position: relative;'> <a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://www.theie6countdown.com/images/upgrade.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." /></a></div> <![endif]-->
<!--[if lt IE 9]><script src="js/html5.js" type="text/javascript"></script><![endif]-->
<!--[if IE]><link href="css/ie_style.css" rel="stylesheet" type="text/css" /><![endif]-->
</head>
<body id="page1" onLoad="loadAjax('<?php echo $keyword?>','<?php echo $page?>','<?php echo $by?>','<?php echo $row?>')&topSong('bai-hat-Viet-Nam/IWZ9Z08I','1')&showPl()&topAlbum('the-loai-album/Viet-Nam/IWZ9Z08I','1');">
<div id="main">
	<header>
		<nav>
			<ul>
			<li class="active"><a href="index.html">Trang chủ</a></li>
			<!--
			<li><a href="index-1.html">Audio</a></li>
			<li><a href="index-2.html">Video</a></li>
			<li><a href="index-3.html">Gallery</a></li>
			<li><a href="index-4.html">Tour Dates</a></li>
			<li><a href="index-5.html">Contacts</a></li>
		-->
		</ul>
	</nav>
	<!--<h1><a href="index.html">Nổi bật</a></h1> -->
	<div class="jp-audio">
		<h2><cufon class="cufon cufon-canvas" alt="New " style="width: 60px; height: 30px;"><canvas width="99" height="33" style="width: 99px; height: 33px; top: 1px; left: -6px;"></canvas><cufontext>New </cufontext></cufon><cufon class="cufon cufon-canvas" alt="Song" style="width: 63px; height: 30px;"><canvas width="93" height="33" style="width: 93px; height: 33px; top: 1px; left: -6px;"></canvas><cufontext>Song</cufontext></cufon></h2>
		<div class="jp-type-single">
			<div class="jp-interface" id="jp_interface_1">
			<ul class="jp-controls">
				<li><a class="jp-play" href="#"></a></li>
				<li><a class="jp-pause" href="#" style="display: none;"></a></li>
				<li><a class="jp-prev" href="#">Previous Track</a></li>
				<li><a class="jp-next" href="#">Next Track</a></li>
				<li><a class="jp-more-songs" href="#">Listen to More Songs</a></li>
			</ul>
			<div class="jp-progress">
				<div class="jp-seek-bar" style="width: 0%;">
				<div class="jp-play-bar" style="width: 0%;"></div>
				</div>
			</div>
			<div class="jp-title"></div>
			</div>
		</div>
		</div>
	<div class="header-slider">
		<ul>
			<li><img width="377" height="216" alt="Điểm Tin Giải Trí" src="http://image.mp3.zdn.vn/banner/c/7/c7dbb22ec1e651ee487df6d006eb917c_1366374973.jpg"></li>
			<li><img width="377" height="216" alt="Buông Tay" src="http://image.mp3.zdn.vn/banner/d/4/d43ee81d30fd25b583eca84b32d0618c_1366285856.jpg"></li>
			<li><img width="377" height="216" alt="Lại Một Ngày Không Em" src="http://image.mp3.zdn.vn/banner/3/b/3ba01d81ce39bb02384da65c0f22e933_1366019022.jpg"></li>
		</ul>
	</div>
	<a href="#" class="hs-prev"><img src="images/prev.png" alt=""></a>
	<a href="#" class="hs-next"><img src="images/next.png" alt=""></a>
	<!--<a href="#" class="header-more">Read More</a> -->
</header>