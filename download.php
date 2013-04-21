<?php   
include "http.class.php";
$http = new Http();
if($_GET['id'])
{
	$http->clear();
	$http->setTarget('http://mp3.zing.vn/mp3/nghe-bai-hat/'.$_GET['id'].'.html');
	$http->setReferrer("http://mp3.zing.vn");
	$http->execute();
	$html = $http->result;
	$url = $http->get_string_between($html,1,0,'title="Tải ca khúc về" href="','" target="ifrTemp">');
	if($_GET['type'] == 'playlist')
	{
		header("Location: ".$url."");
	}
	else
	{
		$name = $http->get_string_between($html,1,0,'Tìm ca khúc có tên liên quan" href="','</a></h1>');
		$name = explode('">',$name);
		$singer = $http->get_string_between($html,1,0,'Tìm ca khúc do ',' trình bày');
		$type = trim(substr($url, -3));
		$filename = $name[1].'__'.$singer;
		$filename = str_replace(' ','-',$filename);
		$filename = $filename.'.'.$type;
		$filename = $http->mark_to_non($filename);
		switch( $type )
		{
		  case "mp3": $ctype="audio/mpeg"; break;
		  case "wav": $ctype="audio/x-wav"; break;
		  case "wma": $ctype="audio/x-ms-wma"; break;
		  case "flv": $ctype="video/x-flv"; break;
		}
		header("Content-type: $ctype; charset=utf-8");
		header("Content-Disposition: attachment;filename=$filename");
		header("Content-Transfer-Encoding: binary");
		header('Pragma: no-cache');
		header('Expires: 0');
		set_time_limit(0);
		readfile($url);
	}
	//header("Location: ".$url."");
}
?>