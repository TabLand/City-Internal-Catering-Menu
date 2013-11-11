<?php
	function arrayToHttpHeader($headers){
	
		$raw = "";
		foreach($headers as $header){
			if (strpos($header,'Content-Length') === false)	$raw .= $header . "\r\n";
		}
		return $raw;
	}
	function build_request_array($cookies, $post){
	
	}
?>
