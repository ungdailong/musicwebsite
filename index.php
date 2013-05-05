<?php
header("Content-type: text/html; charset=utf-8");
error_reporting(0);
include "search.class.php";
include "tpl.class.php";
$tpl = new Template();
$ga  = new Find();
if($_POST['keyword'] && $_POST['by'] != '4' && $_POST['by'] != '5')
{
	if($ga->Zing())
	{
		$arr 	= $ga->arr;
		$main	= $tpl->get('theme/list_song');
		$row	= $tpl->get_block($main,'list_row',1);
		$html = "";
		for($i=1; $i<=(count($arr)-2); $i++)
		{
			if($i%2 != 0)
				$class = "class=even";
			else
				$class = "";
			$html.= $tpl->assign($row,
				array( 'song.NAME'		=> $ga->cut_string($arr[$i]['name'],27,true),
					   'song.SINGER'	=> $ga->cut_string($arr[$i]['singer'],27,true),
					   'song.ID' 		=> $arr[$i]['id'],
					   'song.KAT'		=> $arr[$i]['kat'],
					   'song.CAT'		=> $arr[$i]['cat'],
					   'song.KBS'		=> $arr[$i]['kbs'],
					   'song.TYPE'		=> $arr[$i]['type'],
					   'song.RATE'		=> $arr[$i]['rate'],
					   'song.CLASS'     => $class,
					   'song.NUM'		=> $i,
						'server'		=> URL_SERVER
					 )
			);
		}
		# Phân Trang
	if($ga->page>1){
		$prev=($ga->page-1);
		$pre='<a href="javascript:void(0);" onclick="loadAjax(\''.$ga->keyword.'\',\''.$prev.'\',\''.$_POST['by'].'\',\''.$ga->total.'\');"><img src="theme/img/prev.png" style="border:0px solid;"></a>';
			}
	if($ga->page<$ga->result){
		$next=($ga->page+1);
		$ne='<a href="javascript:void(0);" onclick="loadAjax(\''.$ga->keyword.'\',\''.$next.'\',\''.$_POST['by'].'\',\''.$ga->total.'\');"><img src="theme/img/next.png" style="border:0px solid;"></a>';
			}
			$main=$tpl->assign($main,array(
						'ga_pre'	=>$pre,
						'ga_next'	=>$ne,
						'ga_page'	=>$ga->page,
						'ga_result'	=>$ga->result,
						'ga_total'	=>$ga->total,
						'ga_keyword'=>$_POST['keyword'],
						)
					);
		# Buff Theme
		$main = $tpl->assign_blocks($main,array(
						'list' => $html
						)
					);
		$tpl->show($main);		
	}
}
else if($_POST['by'] == '4' && $_POST['keyword'])
{
	if($ga->Album())
	{
		$arr 	= $ga->arr;
		$main	= $tpl->get('theme/list_album');
		$row	= $tpl->get_block($main,'list_row',1);
		$html = "";
		for($i=1; $i<=(count($arr)-4); $i++)
		{
			$html.= $tpl->assign($row,
				array( 'song.NAME'		=> $ga->cut_string($arr[$i]['name'],27,true),
					   'song.ID' 		=> $arr[$i]['id'],
					   'song.IMG' 		=> $arr[$i]['img'],
					   'song.NUM'		=> $i
					 )
			);
		}
		# Phân Trang
	if($ga->page>1){
		$prev=($ga->page-1);
		$pre='<a href="javascript:void(0);" onclick="loadAjax(\''.$ga->keyword.'\',\''.$prev.'\',\''.$_POST['by'].'\',\''.$ga->total.'\');"><img src="theme/img/prev.png" style="border:0px solid;"></a>';
			}
	if($ga->page<$ga->result){
		$next=($ga->page+1);
		$ne='<a href="javascript:void(0);" onclick="loadAjax(\''.$ga->keyword.'\',\''.$next.'\',\''.$_POST['by'].'\',\''.$ga->total.'\');"><img src="theme/img/next.png" style="border:0px solid;"></a>';
			}
			$main=$tpl->assign($main,array(
						'ga_pre'	=>$pre,
						'ga_next'	=>$ne,
						'ga_page'	=>$ga->page,
						'ga_result'	=>$ga->result,
						'ga_total'	=>$ga->total,
						'ga_keyword'=>$_POST['keyword'],
						)
					);
		# Buff Theme
		$main = $tpl->assign_blocks($main,array(
						'list' => $html
						)
					);
		$tpl->show($main);		
	}
}
else if($_POST['by'] == '5' && $_POST['keyword'])
{
	if($ga->Youtube())
	{
		$arr 	= $ga->arr;
		$main	= $tpl->get('theme/youtube');
		$row	= $tpl->get_block($main,'list_row',1);
		$html = "";
		for($i=1; $i<=(count($arr)-2); $i++)
		{
			$html.= $tpl->assign($row,
				array( 'song.NAME'		=> $ga->cut_string($arr[$i]['name'],27,true),
					   'song.ID' 		=> $arr[$i]['id'],
					   'song.IMG' 		=> $arr[$i]['img'],
					   'song.UPLOAD'	=> $arr[$i]['upload'],
					   'song.TIME' 		=> $arr[$i]['time'],
					   'song.DESC' 		=> $arr[$i]['desc'],
					   'song.NUM'		=> $i
					 )
			);
		}
		# Phân Trang
	if($ga->page>1){
		$prev=($ga->page-1);
		$pre='<a href="javascript:void(0);" onclick="loadAjax(\''.$ga->keyword.'\',\''.$prev.'\',\''.$_POST['by'].'\',\''.$ga->total.'\');"><img src="theme/img/prev.png" style="border:0px solid;"></a>';
			}
	if($ga->page<$ga->result){
		$next=($ga->page+1);
		$ne='<a href="javascript:void(0);" onclick="loadAjax(\''.$ga->keyword.'\',\''.$next.'\',\''.$_POST['by'].'\',\''.$ga->total.'\');"><img src="theme/img/next.png" style="border:0px solid;"></a>';
			}
			$main=$tpl->assign($main,array(
						'ga_pre'	=>$pre,
						'ga_next'	=>$ne,
						'ga_page'	=>$ga->page,
						'ga_result'	=>$ga->result,
						'ga_total'	=>$ga->total,
						'ga_keyword'=>$_POST['keyword'],
						)
					);
		# Buff Theme
		$main = $tpl->assign_blocks($main,array(
						'list' => $html
						)
					);
		$tpl->show($main);		
	}
}
else if($_POST['type'] && $_POST['page'] && !$_POST['types'])
{
	if($ga->topSong())
	{
		$arr = $ga->arr;
		$main	= $tpl->get('theme/top_song');
		$row	= $tpl->get_block($main,'list_row',1);
		$html = "";

		for($i=1; $i<=10; $i++)
		{
			$html.= $tpl->assign($row,
				array( 'song.NAME'		=> $ga->cut_string($arr[$i]['name'],27,true),
					   'song.SINGER'	=> $ga->cut_string($arr[$i]['singer'],27,true),
					   'song.IMG' 		=> 'http://'.$arr[$i]['img'],
					   'song.ID' 		=> $arr[$i]['id'],
					   'song.NUM' 		=> $i,
						'server'		=> URL_SERVER
					 )
			);
		}
		
	
			$main=$tpl->assign($main,array(
						'ga_pre'=>$pre,
						'ga_next'=>$ne,
						'ga_page'=>$ga->page,
						'ga_total'=>$ga->count,
						)
					);
		# Buff Theme
		$main = $tpl->assign_blocks($main,array(
						'list' => $html
						)
					);
		$tpl->show($main);		
	}
}
else if($_POST['type'] && $_POST['page'] && $_POST['types'])
{
	if($ga->topAlbum())
	{
		$arr = $ga->arr;
		$main	= $tpl->get('theme/top_album');
		$row	= $tpl->get_block($main,'list_row',1);
		$html = "";
		for($i=1; $i<=(count($arr)-2); $i++)
		{
			$html.= $tpl->assign($row,
				array( 'song.NAME'		=> $ga->cut_string($arr[$i]['name'],27,true),
					   'song.IMG' 		=> $arr[$i]['img'],
					   'song.ID' 		=> $arr[$i]['id'],
					   'song.NUM' 		=> $i,
					   'song.NAME1'  	=> $arr[$i]['name'],
						'server'		=> URL_SERVER
					 )
			);
		}
		# Buff Theme
		$main = $tpl->assign_blocks($main,array(
						'list' => $html,
						'ga_result' => '1'
						)
					);
		$tpl->show($main);		
	}
}
else if($_GET['id'])
{
	header("Content-Type: application/xml; charset=utf-8");
			$asx = '<?xml version="1.0" encoding="utf-8"?>'.
				   '<playlist version="1" xmlns="http://xspf.org/ns/0/">'.
				   '<trackList>';
	if($ga->ShowAlbum())
	{
		$arr 	= $ga->arr;
		for($i=1; $i<=(count($arr)-2); $i++)
		{
			$asx .= '<track>'.
					'<title>'.$arr[$i]['singer'].'</title>'.
					'<creator>'.$arr[$i]['name'].'</creator>'.
					'<location>'.$arr[$i]['url'].'</location>'.
					'</track>';
		}	
		$asx .= '</trackList>'.
					'</playlist>';
	   echo $asx;
	}
}
else if($_POST['type'] == 'playalbum' && $_POST['id'])
{
		$html = $tpl->get('theme/play_album');
		$array = array('album.ID' => $_POST['id']);
		$tpl->show($tpl->assign($html,$array));
}
else
{
		$input = array("Minh Hằng", "Bùi Bích Phương", "Khởi My", "Vy Oanh", "Thu Thủy","Đông Nhi","Khổng Tú Quỳnh","Thanh Tâm","Ngân Khánh","Miu Lê");
		shuffle($input);
		$html = $tpl->get('theme/main');
		$array = array('key.WORD' => $input[0],'server' => URL_SERVER);
		$title = "Nghe nhạc chất lượng cao Nhạc mp3 nhạc hot top album";
		$keyword = $input[0];
		include("header.php");
		$tpl->show($tpl->assign($html,$array));
}
?>