<?php
class Template {
	var $template_dir = '';
    var $file_ext     = '.html';
    var $buffer;
	function get($file) 
	{
		if( file_exists( $this -> template_dir . $file . $this -> file_ext ) )
		{
			$this -> buffer = file_get_contents( $this -> template_dir . $file . $this -> file_ext );
			return $this -> buffer;
		}
		else
		{
			echo 'Không tìm thấy file: <b>'.$this -> template_dir . $file . $this -> file_ext.'</b>';
		}
	}
	function w_parse_variables($input, $array)
	{	
		$search = preg_match_all('/{.*?}/', $input, $matches);
		for($i = 0; $i < $search; $i++)
		{
			$matches[0][$i] = str_replace(array('{', '}'), null, $matches[0][$i]);
		}
		foreach($matches[0] as $value)
		{
			$input = str_replace('{' . $value . '}', $array[$value], $input);
		}
		return $input;
	}
	function get_block($str,$block = '',$c = false) {
		preg_replace('#<!-- '.(($c)?'\#':'').'BEGIN '.$block.' -->[\r\n]*(.*?)[\r\n]*<!-- '.(($c)?'\#':'').'END '.$block.' -->#se','$s = stripslashes("\1");',$str);
		if ($s != $str)	$str = $s;
		else $str = '';
		return $str;
	}
	function assign($input,$arr) {
		foreach ($arr as $block => $val) {
				$input = str_replace('{'.$block.'}',$val,$input);
		}
		return $input;
	}
	function assign_blocks($input,$arr) {
		foreach ($arr as $block => $val) {
			$input = preg_replace('#<!-- BEGIN '.$block.' -->[\r\n]*(.*?)[\r\n]*<!-- END '.$block.' -->#s', $val, $input);
		}
		return $input;
	}
	function show($input) {
		echo $input;
	}
}
?>