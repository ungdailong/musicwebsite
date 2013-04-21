<?php
header("Content-type: text/html; charset=utf-8");
include "http.class.php";
include "tpl.class.php";
$http = new Http();
$tpl = new Template();
$id 	= $_POST['id'];
$name	= $_POST['name'];
$singer	= $_POST['singer'];
if($_POST['type'] == 'add')
{
	if(strpos($_COOKIE['pl'],$id))
	{
		echo 'Ca khúc này đã có trong playlist';
		exit();
	}
	if(!$_COOKIE['pl'] || $_COOKIE['pl'] == '')
	{
		$value = '~~'.$id.'~`'.$name.'~`'.$singer.'~~';
	}
	else
	{
		$value = $_COOKIE['pl'].$id.'~`'.$name.'~`'.$singer.'~~';
	}
	$adding = setcookie("pl", $value, time()+60*60*24*365);  /* Playlist tồn tại trong 1 năm */
	if(!$adding) echo 'Có lỗi xẩy ra , vui lòng thử lại';
}
else if($_POST['type'] == 'remove')
{
	$value = '~~'.$id.'~`'.$name.'~`'.$singer;
	$value = str_replace($value,'',$_COOKIE['pl']);
	$adding = setcookie("pl", $value, time()+60*60*24*365);
	if(!$adding) echo 'Có lỗi xẩy ra , vui lòng thử lại';
	else echo 'Đã xóa '.$name.' ra khỏi playlist';
}
else if($_POST['type'] == 'remove_all')
{
	$adding = setcookie("pl", '', time()+60*60*24*365);
	if(!$adding) echo 'Có lỗi xẩy ra , vui lòng thử lại';
	else echo 'Đã xóa toàn bộ ca khúc trong playlist';
}
else if($_POST['type'] == 'play')
{
	$html = $tpl->get('theme/play_playlist');
	$array = array('URL.site' => '');
	$tpl->show($tpl->assign($html,$array));
}
else if($_GET['type'] == 'creat')
{
	$item = explode('~~',$_COOKIE['pl']);
	header("Content-Type: application/xml; charset=utf-8");
			$asx = '<?xml version="1.0" encoding="utf-8"?>'.
				   '<playlist version="1" xmlns="http://xspf.org/ns/0/">'.
				   '<trackList>';
	for($i=1; $i<=(count($item)-2); $i++)
	{
		$data = explode('~`',$item[$i]);
		$asx .= '<track>'.
					'<title>'.$data[2].'</title>'.
					'<creator>'.$data[1].'</creator>'.
					'<location>http://the-vagabond.vn/metro/music-zing/download.php?type=playlist&id='.$data[0].'#.mp3</location>'.
					'</track>';
	}
			$asx .= '</trackList>'.
					'</playlist>';
	   echo $asx;
}
else
{
	if(!$_COOKIE['pl'] || $_COOKIE['pl'] == '~~')
	{
		echo '<div id="bottom" style="width:230px; margin-bottom:10px;">Vui lòng chọn bài hát</div>';
		exit();
	}
	$main	= $tpl->get('theme/playlist');
	$row	= $tpl->get_block($main,'list_row',1);
	$html = "";
	$item = explode('~~',$_COOKIE['pl']);
	for($i=1; $i<=(count($item)-2); $i++)
	{
		$data = explode('~`',$item[$i]);
		$html.= $tpl->assign($row,
				array( 'song.NAME'		=> $data[1],
					   'song.ID' 		=> $data[0],
					   'song.SINGER' 	=> $data[2],
					   'song.NUM' 		=> $i
					 )
			);
	}
	$main = $tpl->assign_blocks($main,array(
					'list' => $html
					)
				);
	$tpl->show($main);
}
?>