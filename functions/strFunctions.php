<?php
	function makeJSSafe($str) {
		$str = str_replace("'", "\'", $str);
		$str = stripNewlines($str);
		$str = stripCarriage($str);
		return $str;
	}
	
	function stripNewlines($str) {
		$str = str_replace("\n", "", $str);
		return $str;
	}
	
	function stripCarriage($str) {
		$str = str_replace("\r", "", $str);
		return $str;
	}
	
	function formatTimestamp($time) {
		$str = date("g:ia - n/j/Y", $time);
		$str = makeJSSafe($str);
		return $str;
	}
?>