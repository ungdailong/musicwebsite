<?php
header("Content-type: text/html; charset=utf-8");
error_reporting(0);
include "http.class.php";
include "tpl.class.php";
$http = new Http();
$tpl = new Template();
if($_GET['type'] == 'play')
{
	$id = $_GET['id']; 
	$http->clear();
	$http->setTarget('http://mp3.zing.vn/bai-hat/'.$id.'.html');
	$http->setReferrer("http://mp3.zing.vn");
	$http->execute();
	$html = $http->result;
	
	if(strpos($html,'404.png') > 0){
		die();
	}
// 	$fp = fopen("te.txt","w");
// 	fwrite($fp,$html);
// 	fclose($fp);
	$image = $http->get_string_between($html,1,0,'<meta property="og:image" content="','"');
	$xml = $http->get_string_between($html,1,0,'xmlURL=','&amp;textad');
	if($xml == '' || $xml == null || $xml == ' ')
	{
		$title = 'Thông Báo';
		$keyword = '.';
	}
	else{
		///lay link .mp3
		$http->clear();
		$http->setTarget($xml);
		$http->setReferrer("http://mp3.zing.vn");
		$http->execute();
		$html = $http->result;
		$url = $http->get_string_between($html,1,0,'<source><![CDATA[',']]></source>');
		$name = $http->get_string_between($html,1,0,'<title><![CDATA[ ',']]></title>');
		$singer = $http->get_string_between($html,1,0,'<performer><![CDATA[',']]></performer>');
		
		///
		$title = $name.'-'.$singer;
		$keyword = $singer;
	}
	$index = 'index';
	$description = $title . ' download tải nhạc chờ bài hát '. $title. ' lossless Ca Khúc : '.$title;	
	$keywords = $title . ' Việt Nam, nhac cho, nhac chuong, lyrics, loi bai hat';
	$link = URL_SERVER . '/bai-hat/'.$id;
	include "header.php";
	
	//include "top_album.php";
	$html_album_hot = file_get_contents("top_album.php");
	$htmls = $tpl->get('theme/play_song');
	$array = array('song.URL' 		=> $url,
				   'song.NAME' 		=> $name,
				   'song.ID' 		=> $id,
				   'song.SINGER' 	=> $singer,
				   'html.album_hot' => $html_album_hot,
				   );
	$tpl->show($tpl->assign($htmls,$array));
}
?>