<?php
header("Content-type: text/html; charset=utf-8");
include "http.class.php";
class Find
{
	var $http, $keyword, $page, $html, $total, $result, $item, $arr, $name, $singer, $time, $id, $count, $type, $cat, $fybe;
	function cut_string($str,$len,$more){
		if ($str=='' || $str==NULL) return $str;
		if (is_array($str)) return $str;
		$str = trim($str);
		if (strlen($str) <= $len) return $str;
		$str = substr($str,0,$len);
		if ($str != '') {
			if (!substr_count($str," ")) {
				if ($more) $str .= " ...";
				return $str;
			}
			while(strlen($str) && ($str[strlen($str)-1] != " ")) $str = substr($str,0,-1);
			$str = substr($str,0,-1);
			if ($more) $str .= " ...";
		}
		return $str;
	}
	
	function Zing()
	{
		$this->keyword = urlencode($_POST['keyword']);
		if(!$this->keyword || $this->keyword == '') 
			$this->keyword = urlencode('thanh');
		$this->page	   = $_POST['page'];
		if(!$this->page || $this->page == '') 
			$this->page = '1';
		$this->theo	   = $_POST['by'];
		if(!$this->theo || $this->theo == '') 
			$this->theo = '1';
		$this->row	   = base64_encode($_POST['row']);
		$this->http    = new Http();
		$this->http->clear();
		
		if($this->theo != '1')
		{
			$this->http->setTarget('http://mp3.zing.vn/tim-kiem/bai-hat.html?t='.$this->theo.'&q='.$this->keyword.'&p='.$this->page);
		}
		else
		{
			if(!$this->row || $this->row == '')
			{
				//echo 'http://mp3.zing.vn/tim-kiem/bai-hat.html?t='.$this->theo.'&q='.$this->keyword;
				//$this->http->setTarget('http://mp3.zing.vn/mp3/search/do.html?t='.$this->theo.'&q='.$this->keyword);
				$this->http->setTarget('http://mp3.zing.vn/tim-kiem/bai-hat.html?q='.$this->keyword);
			}
			else
			{
				$this->http->setTarget('http://mp3.zing.vn/mp3/search/do.'.$this->page.'.html?t='.$this->theo.'&q='.$this->keyword.'&row='.$this->row);
			}
		}
		$this->http->setReferrer("http://mp3.zing.vn");
		//print_r($this->http);die();
		$this->http->execute();
		
		$this->html   = $this->http->result;
		$this->total  = intval(str_replace('.', '',strip_tags($this->http->get_string_between($this->html,1,0,'tìm được ',' bài hát'))));
		
		if($this->total == 0)
		{
			echo '<center><b style="color:#f63">Không tìm thấy kết quả nào</b></center>';
			exit();
		}
		$this->result = ceil(intval(trim($this->total))/20);
		//echo $this->total . '-' . $this->result;
		//die();
		$this->item   = explode('<div class="content-item ie-fix">',$this->html);
		//echo count($this->item);
		$this->arr[]  = array();
		for($i=1; $i<=count($this->item); $i++)
		{
			
			$this->id		= $this->http->get_string_between($this->item[$i],1,0,'href="/bai-hat/','.html');
			$this->name 	= $this->http->get_string_between($this->item[$i],1,0,'">','</a>');
			$this->singer	= $this->http->get_string_between($this->item[$i],1,0,'Tìm bài hát của ','"');
			$this->cat_name		= $this->http->get_string_between($this->item[$i],1,0,'Xem bài hát ','"');
			$this->cat_id		= $this->http->get_string_between($this->item[$i],1,0,'/the-loai-bai-hat/','.html');
			//$this->info      = $this->http->get_string_between($this->item[$i],1,0,'</a></span> | Thời gian: ',' kb/s');
			$this->info      = $this->http->get_string_between($this->item[$i],1,0,'Lượt nghe: ','</p>');
			$this->rate = $this->http->get_string_between($this->item[$i],0,2,'kb/s</p>','</a> | ');
			//$this->cat      = explode('">',$this->cat);
		 	
			//if($this->cat[0] == 0) $this->cat[0] = '1';
			//$this->cat_id	= $this->cat[0];
			//$this->cat_name	= $this->cat[1];
			
			//if(strpos($this->name,'\'')) $this->name = str_replace('\'','',$this->name);
			//if(strpos($this->singer,'\'')) $this->singer = str_replace('\'','',$this->singer);
			$this->arr[$i]	= 	array(	"name"		=>	$this->name,
										"id"		=> 	$this->id,
										"kat" 		=> 	$this->cat_id,
										"singer"	=>  $this->singer,
										"cat"		=>  $this->cat_name,
										"kbs"		=>  $this->info,
										"rate"      => $this->rate
									  );
		}
		return $this->arr;
	}
	
	function Album()
	{
		$this->keyword = urlencode($_POST['keyword']);
		if(!$this->keyword || $this->keyword == '') $this->keyword = urlencode('thanh');
		$this->page	   = $_POST['page'];
		if(!$this->page || $this->page == '') $this->page = '1';
		$this->row	   = base64_encode($_POST['row']);
		$this->http    = new Http();
		$this->http->clear();
		if($this->page == '1')
		{
			$this->http->setTarget('http://mp3.zing.vn/mp3/search/do.html?t=3&q='.$this->keyword);
		}
		else
		{
			$this->http->setTarget('http://mp3.zing.vn/mp3/search/do.'.$this->page.'.html?t=3&q='.$this->keyword.'&row='.$this->row);
		}
		$this->http->setReferrer("http://mp3.zing.vn");
		$this->http->execute();
		$this->html   = $this->http->result;
		$this->total  = $this->http->get_string_between($this->html,1,0,'Tìm được ',' bài');
		if($this->total == 0)
		{
			echo '<center><b style="color:#f63">Không tìm thấy kết quả nào</b></center>';
			exit();
		}
		$this->result = ceil(trim($this->total)/20);
		$this->item   = explode('<div class="Listicon2">',$this->html);
		$this->arr[]  = array();
		for($i=1; $i<=count($this->item); $i++)
		{
			$this->id		= $this->http->get_string_between($this->item[$i],1,0,'<a id="','" class="btn_share');
			$this->name 	= $this->http->get_string_between($this->item[$i],1,0,'Nghe Album: ','">');
			$this->img  	= $this->http->get_string_between($this->item[$i],1,0,'class="boderalbum"><img src="','" width="50"');
			if(strpos($this->name,'\'')) $this->name = str_replace('\'','',$this->name);
			$this->arr[$i]	= 	array(	"name"		=>	$this->name,
										"id"		=> 	$this->id,
										"img"		=>  $this->img
									  );
		}
		return $this->arr;
	}
	
	function ShowAlbum()
	{
		$this->id = $_GET['id'];
		$this->http    = new Http();
		$this->http->clear();
		$this->http->setTarget('http://mp3.zing.vn/mp3/nghe-album/marguerites.'.$this->id.'.html');
		$this->http->setReferrer("http://mp3.zing.vn");
		$this->http->execute();
		$this->html   = $this->http->result;
		$this->item   = explode('<div class="rwMusic"> ',$this->html);
		$this->arr[]  = array();
		for($i=1; $i<=count($this->item); $i++)
		{
			$this->url		= $this->http->get_string_between($this->item[$i],1,0,'iconAdd">','" alt="Download');
			$this->url      = explode('<a href="',$this->url);
			$this->name 	= $this->http->get_string_between($this->item[$i],1,0,'title="Nghe bài hát ','">');
			$this->singer  	= $this->http->get_string_between($this->item[$i],1,0,'các bài hát của ca sĩ ','" href="/mp3/search/do');
			$this->arr[$i]	= 	array(	"name"		=>	$this->name,
										"url"		=> 	$this->url[1],
										"singer"	=>  $this->singer
									  );
		}
		return $this->arr;
	}
	
	function topAlbum()
	{
		$this->keyword = $_POST['type'];
		if(!$this->keyword || $this->keyword == '') $this->keyword = 'album-hot';
		$this->page	   = $_POST['page'];
		if(!$this->page || $this->page == '') $this->page = '1';
		$this->http    = new Http();
		$this->http->clear();
		
		$this->http->setTarget('http://mp3.zing.vn/'.$this->keyword.'.html?sort=release_date');
		$this->http->setReferrer("http://mp3.zing.vn");
		$this->http->execute();
		$this->html   = $this->http->result;
		
		$this->item   = explode('<div class="album-item">',$this->html);
		$this->arr[]  = array();
		//$j  = 1;
		for($i=1; $i<=count($this->item); $i++)
		{
			//$hot =  strpos($this->item[$i],'Album hot');
			//echo $hot.'</br>';
			//if($hot > 0){
			//$this->data     = $this->http->get_string_between($this->item[$i],1,0,'<h1><a href="http://mp3.zing.vn/mp3/nghe-album/','</a></h1>');
			$this->id		= $this->http->get_string_between($this->item[$i],1,0,'href="/album/','"');
			$this->name 	= $this->http->get_string_between($this->item[$i],1,0,'title="','"');
			$this->img  	= $this->http->get_string_between($this->item[$i],1,0,'src="','"');
			//if(strpos($this->name,'\'')) $this->name = str_replace('\'','',$this->name);
			// $fp = fopen('te.txt', "w");
		 // fwrite($fp, $this->name);
		 // fclose($fp);die();
			$this->arr[$i]	= 	array(	"name"		=>	$this->name,
										"id"		=> 	$this->id,
										"img"		=>  $this->img
									  );
			//$j ++;
			//}
		}
		return $this->arr;
	}
	function topAlbumNCT()
	{
		$this->keyword = $_POST['type'];
		if(!$this->keyword || $this->keyword == '') $this->keyword = 'album-hot';
		$this->page	   = $_POST['page'];
		if(!$this->page || $this->page == '') $this->page = '1';
		$this->http    = new Http();
		$this->http->clear();
		//echo 'http://www.nhaccuatui.com/'.$this->keyword.'.html';die();
		$this->http->setTarget('http://www.nhaccuatui.com/'.$this->keyword.'.html');
		$this->http->setReferrer("http://www.nhaccuatui.com");
		$this->http->execute();
		$this->html   = $this->http->result;
		
		$this->item   = explode('song-item row-rank',$this->html);
		$this->arr[]  = array();
		//$j  = 1;

		for($i=1; $i<=count($this->item); $i++)
		{
			//$hot =  strpos($this->item[$i],'Album hot');
			//echo $hot.'</br>';
			//if($hot > 0){
			//$this->data     = $this->http->get_string_between($this->item[$i],1,0,'<h1><a href="http://mp3.zing.vn/mp3/nghe-album/','</a></h1>');
			$this->id		= $this->http->get_string_between($this->item[$i],1,0,'href="http://www.nhaccuatui.com/playlist/','"');
			$this->name 	= $this->http->get_string_between($this->item[$i],4,0,'title="','"');
			$this->singer   = $this->http->get_string_between($this->item[$i],1,0,'"_blank">','</a>');
			$this->img  	= $this->http->get_string_between($this->item[$i],1,0,'src="','"');
			//if(strpos($this->name,'\'')) $this->name = str_replace('\'','',$this->name);
			 //$fp = fopen('te.txt', "w");
		  //fwrite($fp, $this->singer);
		  //fclose($fp);die();
			$this->arr[$i]	= 	array(	"name"		=>	$this->name . '-'.$this->singer,
										"id"		=> 	$this->id,
										"img"		=>  $this->img
									  );
			//$j ++;
			//}
		}
		return $this->arr;
	}
	function Get()
	{
		$this->id 	   = $_POST['id'];
		$this->http    = new Http();
		$this->http->clear();
		$this->http->setTarget('http://mp3.zing.vn/mp3/nghe-bai-hat/'.$this->id.'.html');
		$this->http->setReferrer("http://mp3.zing.vn");
		$this->http->execute();
		$this->html   = $this->http->result;
		$this->html   = $this->http->get_string_between($this->item[$i],1,0,'title="Tải ca khúc về" href="','" target="ifrTemp">');
		return $this->html;
	}
	
	function topSong()
	{
		$this->page = $_POST['page'];
		$this->keyword = $_POST['type'];
		$this->http = new Http();
		$this->http->clear();
		$this->http->setTarget('http://mp3.zing.vn/bang-xep-hang/'.$this->keyword.'.html');
		$this->http->setReferrer("http://mp3.zing.vn");
		$this->http->execute();
		$this->html = $this->http->result;

		$this->item = explode('album-item',$this->html);
		//$this->count = ceil((count($this->item)-1)/10);
		$this->arr[]	= array();
		for($i=0; $i<=10; $i++)
		{
				
				$this->name 	= $this->http->get_string_between($this->item[$i],0,9,'</a></h3>','">');
				$this->singer	= $this->http->get_string_between($this->item[$i],0,10,'</a></p>','">');
				$this->id		= $this->http->get_string_between($this->item[$i],1,0,'href="/bai-hat/','">');
				$this->img 		= $this->http->get_string_between($this->item[$i],1,0,'src="http://','"');
				
		// 		$fp = fopen('te.txt', "w");
		// fwrite($fp, $this->img);
		// fclose($fp);die();
				$this->arr[$i]	= 	array(	"name"		=>	$this->name,
											"singer"	=>  $this->singer,
											"img"		=>  $this->img,
											"id"		=>	$this->id,
										 );
	    }
		return $this->arr;
	}
	
	function Youtube()
	{
		$this->keyword = str_replace(' ','+',$_POST['keyword']);
		if(!$this->keyword || $this->keyword == '') $this->keyword = 'lo+duyen';
		$this->page	   = $_POST['page'];
		if(!$this->page || $this->page == '') $this->page = '1';
		$this->http    = new Http();
		$this->http->clear();
		$this->http->setTarget('http://www.youtube.com/results?search_query='.$this->keyword.'&suggested_categories=10,22&page='.$this->page);
		$this->http->execute();
		$this->html   = $this->http->result;
		$this->total  = $this->http->get_string_between($this->html,1,0,'of about <strong>','</strong>');
		if($this->total == 0)
		{
			echo '<center><b style="color:#f63">Không tìm thấy kết quả nào</b></center>';
			exit();
		}
		$this->result = ceil(trim($this->total)/20);
		$this->item   = explode('<div class="video-entry yt-uix-hovercard">',$this->html);
		$this->arr[]  = array();
		for($i=1; $i<=count($this->item); $i++)
		{
			$this->id		= $this->http->get_string_between($this->item[$i],1,0,'href="/watch?v=','"');
			$this->name 	= $this->http->get_string_between($this->item[$i],1,0,'hovercard-target"  title="','" rel="nofollow">');
			$this->desc  	= $this->http->get_string_between($this->item[$i],1,0,'class="video-description">
','</div>');
			$this->time  	= $this->http->get_string_between($this->item[$i],1,0,'<span class="hovercard-duration">','</span>');
			$this->upload  	= $this->http->get_string_between($this->item[$i],1,0,'<span class="hovercard-upload-date">','</span>');
			$this->img  	= $this->http->get_string_between($this->item[$i],1,0,"this.getAttribute('ql'), 0, '","', '");
			if(strpos($this->name,'\'')) $this->name = str_replace('\'','',$this->name);
			$this->arr[$i]	= 	array(	"name"		=>	$this->name,
										"id"		=> 	$this->id,
										"desc"		=> 	$this->desc,
										"time"		=> 	$this->time,
										"upload"	=> 	$this->upload,
										"img"		=>  $this->img
									  );
		}
		return $this->arr;
	}
}
?>