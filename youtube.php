<?php
include "search.class.php";
include "tpl.class.php";
$tpl = new Template();
$ga  = new Find();
if($_GET['id'])
{
	$str = file_get_contents('http://www.youtube.com/watch?v='.$_GET['id']);
	$str = explode('SWF_ARGS',$str);
	$str = explode('SWF_GAM_URL',$str[1]);
	$str = explode('fmt_stream_map',$str[0]);
	$str = explode('",',$str[1]);
	$str = str_replace(array('%3A','%2F','%3F','%3D','%26','%252C','%2C34%7C'),array(':','/','?','=','&',',',''),$str[0]);
	$str = explode('http://',$str);
	$str = str_replace('%2C5%7C','',$str[2]);
	header('Location: http://'.$str);
}
else
{
	$html = $tpl->get('theme/play_youtube');
	$array = array('song.ID' => $_POST['id']);
	$tpl->show($tpl->assign($html,$array));
}
?>