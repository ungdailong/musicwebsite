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
	//nhaccuatui
	/*
	$http->setTarget('http://www.nhaccuatui.com/playlist/'.$id.'.html');
	$http->setReferrer("http://www.nhaccuatui.com");
	$http->execute();
	$html = $http->result;
	$title = $http->get_string_between($html,1,0,'<title>','</title>');
	$xml_id = $http->get_string_between($html,1,0,'"playlist", "','"');
	$xml = 'http://www.nhaccuatui.com/flash/xml?key2='.$xml_id;
	 

	$http->clear();
	$http->setTarget($xml);
	$http->setReferrer("http://www.nhaccuatui.com");
	$http->execute();
	$html = $http->result;
	$t = $html;
	
	
  
	$url_ = explode('<location>',$html);
	print_r($url_);die();
	
	$url = array();
	foreach ($url_ as $key => $value) {
		echo $value;
		$urlt = explode(']]',$value);
		$url[] = $urlt[0];
	}
	
	die();
	$name_ = explode('
<title>
<![CDATA[ ',$html);
	$name1 = array_shift($name_);
	$name = array();
	foreach ($name_ as $key => $value) {
		$namet = explode(']]',$value);
		$name[] = $namet[0];
	}
	
	$singer_ = explode('<performer><![CDATA[',$html);
	$singer1 = array_shift($singer_);
	$singer = array();
	foreach ($singer_ as $key => $value) {
		$singert = explode(']]',$value);
		$singer[] = $singert[0];
	}
	*/
	 //mp3.zing.vn
	$http->setTarget('http://mp3.zing.vn/album/'.$id.'.html');
	$http->setReferrer("http://mp3.zing.vn");
	$http->execute();
	$html = $http->result;
	$title = $http->get_string_between($html,1,0,'<title>','</title>');
	$xml = $http->get_string_between($html,1,0,'xmlURL=','&amp;textad');
	
	
	$http->clear();
	$http->setTarget($xml);
	$http->setReferrer("http://mp3.zing.vn");
	$http->execute();
	$html = $http->result;
	
	$url_ = explode('<source><![CDATA[',$html);
	$url1 = array_shift($url_);
	$url = array();
	foreach ($url_ as $key => $value) {
		$urlt = explode(']]',$value);
		$url[] = $urlt[0];
	}
	
	$mp3 = array();
	foreach ($url as $key => $value) {
		$ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $value);  
	    curl_setopt($ch, CURLOPT_REFERER, "http://mp3.zing.vn");
	    curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
	    curl_setopt($ch, CURLOPT_HEADER, 1);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	    $output = curl_exec($ch);
	    curl_close($ch);
	 	$mp3[] =  str_replace('mp3.zdn', 'hot2.cache11.vcdn',$http->get_string_between($output,1,0,'Location: ','
'));
	 	//die();
	}
	$url = $mp3;
	//print_r($url);
	//die();
	unset($mp3);
	//////////
	$name_ = explode('<title><![CDATA[ ',$html);
	$name1 = array_shift($name_);
	$name = array();
	foreach ($name_ as $key => $value) {
		$namet = explode(']]',$value);
		$name[] = $namet[0];
	}
	
	$singer_ = explode('<performer><![CDATA[',$html);
	$singer1 = array_shift($singer_);
	$singer = array();
	foreach ($singer_ as $key => $value) {
		$singert = explode(']]',$value);
		$singer[] = $singert[0];
	}
	
	
	// $fp = fopen("te.txt","w");
	// 	fwrite($fp,$url_[1]);
	// 	fclose($fp);
	// 	die();
	///
	//$title = $name.'-'.$singer;
	$html_javascript = 'new jPlayerPlaylist({
		jPlayer: "#jplayer",
		cssSelectorAncestor: "#jp_container_1"
	}, [';
	foreach ($url as $key => $value) {
		$html_javascript .= '{title:"'.$name[$key].'",mp3:"'.$url[$key].'"},';
		//$html_javascript .=	'title:"'.$name[$key].'",';
		//$html_javascript .= 'mp3:"'.$url[$key].'"';
		//$html_javascript .= '},';
	}
	$html_javascript .= '],{playlistOptions:{autoPlay: true},
		swfPath: "js/Jplayer1.swf",
		supplied: "mp3",
		solution: "html,flash"
	});';
	//echo $html_javascript;die();
	///////////////////////////
	$keyword = $name;
	include "header.php";

	//include "top_album.php";
	$html_album_hot = file_get_contents("top_album.php");
	$htmls = $tpl->get('theme/play_album');
	$array = array('song.URL' 		=> $url,
				   'song.NAME' 		=> $name,
				   'song.ID' 		=> $id,
				   'song.SINGER' 	=> $singer,
				   'html.album_hot' => $html_album_hot,
				   'html.javascript' => $html_javascript,
				   'song.TITLE' => $title
				   );
	$tpl->show($tpl->assign($htmls,$array));
}
?>