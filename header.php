<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title><?php echo $title?></title>
<meta name="title" content="<?php echo $title?>" />
<?php if(isset($index)){?>
<meta name="description" content="<?php echo $description?>" />
<meta name="keywords" content="<?php echo $keywords?>" />
<link rel="canonical" href="<?php echo $link?>"/>
<meta property="og:url" content="<?php echo $link?>" />
<meta property="og:title" content="<?php echo $title?>">
<meta property="og:description" content="<?php echo $description?>" />
<meta property="og:type" content="video">
<meta property="og:image" content="<?php echo $image?>" />
<?php }else{?>
<meta name="description" content="Nghe nhac mp3, nghe nhac mp3 online hay nhat, tai nhac mp3 truc tuyen mien phi cuc nhanh, tim nhac phim, nhac vui, nghe nhac hot cap nhat moi hang ngay, cung nhau thuong thuc nhung ca khuc tuyet voi chat luong 320 Kbits tai website ..." />
<meta name="keywords" content="nhac, nhac hinh, nhac tieng, nhac nuoc ngoai, nhac co loi, lyric, nghe nhac, nhac mp3 online, tai nhac, nghe nhac truc tuyen, nhac viet nam, nhac che, nhac phim, mp3, nhac vui" />
<meta property="og:image" content="images/tam_tit.jpg" />
<link rel="canonical" href="http://music.the-vagabond.net"/>
<?php }?>
<meta name="author" content="the-vagabond.net"/> 
<meta name="ROBOTS" content="index, follow" />

<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/layout.css" rel="stylesheet" type="text/css" />

<script src="js/jquery.min.js" type="text/javascript"></script>

<script type="text/javascript" src="js/sprites.js"></script>
<?php if(!isset($index)){?>
<script type="text/javascript" src="js/gSlider.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript">
    			$(window).load(function(){
    				$('.tumbvr')._fw({tumbvr:{
    					duration:2000,
    					easing:'easeOutQuart'
    				}})
    				

    				
    			})
    			</script>
<?php }?>
<!--[if lt IE 7]> <div style=' clear: both; height: 59px; padding:0 0 0 15px; position: relative;'> <a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://www.theie6countdown.com/images/upgrade.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." /></a></div> <![endif]-->
<!--[if lt IE 9]><script src="js/html5.js" type="text/javascript"></script><![endif]-->
<!--[if IE]><link href="css/ie_style.css" rel="stylesheet" type="text/css" /><![endif]-->
</head>
<!--<body id="page1" onLoad="loadAjax('<?php echo $keyword?>','<?php echo $page?>','<?php echo $by?>','<?php echo $row?>')&topSong('bai-hat-Viet-Nam/IWZ9Z08I','1')&topAlbum('the-loai-album/Viet-Nam/IWZ9Z08I','1');"> -->
<body id="page1" onLoad="loadAjax('<?php echo $keyword?>','<?php echo $page?>','<?php echo $by?>','<?php echo $row?>')&topSong('bai-hat-Viet-Nam/IWZ9Z08I','1');">
<div id="main">
	<header>
		<nav>
			<ul>
			<li class="active"><a href="<?php echo URL_SERVER?>">Trang chủ</a></li>
			<li>
				<form method="GET" action="<?php echo URL_SERVER?>/search.php">
					<input type="text" name = "keyword"size=40px style="height: 30px; margin-top: 11px;" onfocus="if (this.value == 'Tìm bài hát, ca sĩ') {this.value = ''; }" onblur="if ($.trim($(this).val()) == '') {this.value = 'Tìm bài hát, ca sĩ'; }" value="Tìm bài hát, ca sĩ">
					<input type="hidden" name = "by">
				</form>
			</li>
		</ul>
	</nav>
</header>