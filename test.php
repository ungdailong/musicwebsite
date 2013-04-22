<?php
	$ar=explode('<location>', html_entity_decode(file_get_contents('te.txt'))); $kq=array(); for($i=1;$i<count($ar)-1;$i++) { $t1=explode('</location>',$ar[$i]); $t2=explode('<![CDATA[',$t1[0]); $t3=explode(']]>',$t2[1]); $kq[$i-1]=$t3[0]; } print_r($kq);
?>