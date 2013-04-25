<?php
header("Content-type: text/html; charset=utf-8");
error_reporting(0);
include "search.class.php";
include "tpl.class.php";
$tpl = new Template();
$ga  = new Find();
if($_GET['keyword'])
{
		$html = $tpl->get('theme/main');
		$array = array('key.WORD' => $_GET['keyword'],'key.BY' => $_GET['by']);
		$keyword = $_GET['keyword'];
		$by = $_GET['by'];
		$title = $keyword . ' - nghe nhạc chất lượng cao';
		include("header.php");
		$tpl->show($tpl->assign($html,$array));
}
?>