<?php
header("Content-type: text/html; charset=utf-8");
error_reporting(0);
include "search.class.php";
include "tpl.class.php";
$tpl = new Template();
$ga  = new Find();
if($_GET['keyword'] && $_GET['by'])
{
		$html = $tpl->get('theme/main');
		$array = array('key.WORD' => $_GET['keyword'],'key.BY' => $_GET['by']);
		$keyword = $_GET['keyword'];
		$by = $_GET['by'];
		include("header.php");
		$tpl->show($tpl->assign($html,$array));
}
?>