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
	//$fp = fopen("te.txt","w");
		//fwrite($fp,$html);
		
		//fclose($fp);
	$doc = new DOMDocument();
  $doc->load( 'playlist.xml' );
$books = $doc->getElementsByTagName( "track" );
  foreach( $books as $book )
  {
  	echo 1;
  echo $authors = $book->getElementsByTagName( "title" );
  
  
  
  }

  die();
		$fp = fopen("te.txt","r");
$ac = fgets($fp,9999);
fclose($fp);
		//die();
	//$html = fgets("te.txt");
	echo $ac;
	die();
	$url_ = explode('<location>',$html);
	print_r($url_);die();
	//$url1 = array_shift($url_);
	$url = array();
	foreach ($url_ as $key => $value) {
		echo $value;
		$urlt = explode(']]',$value);
		$url[] = $urlt[0];
	}
	//print_r($url);
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
	/* mp3
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
	*/
	
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
		$html_javascript .= '{';
		$html_javascript .=	'title:"'.$name[$key].'",';
		$html_javascript .= 'mp3:"'.$url[$key].'"';
		$html_javascript .= '},';
	}
	$html_javascript .= '],{
		swfPath: "js",
		supplied: "oga, mp3",
		wmode: "window"
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
				   'html.javascript' => $html_javascript
				   );
	$tpl->show($tpl->assign($htmls,$array));
}
?>