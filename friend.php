<?php
header("Content-type: text/html; charset=utf-8");
include "tpl.class.php";
$tpl = new Template();
	$html = $tpl->get('theme/friend');
	$array = array( 'song.ID' 		=> $_GET['id'],
					'song.NAME'	 	=> $_GET['name'],
					'song.SINGER' 	=> $_GET['singer']);
	$tpl->show($tpl->assign($html,$array));
?>