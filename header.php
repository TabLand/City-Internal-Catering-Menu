<?php
	function arrayToHttpHeader($headers){
		$raw = "";
		foreach($headers as $header){
			$raw .= $header . "\r\n";
		}
		return $raw;
	}

?>
