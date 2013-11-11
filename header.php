<?php
	function arrayToHttpHeader($headers){
		log_it(" HTTP response header dump, by header.php " . var_export($headers,true));
		foreach($headers as $header){
			//this line checks to make sure the Content-Length header is not added, this can trigger a duplicate content-length http error
			header($header . "\r\n", true);
		}
	}
	function build_request_array($cookies, $post){
	
	}
?>
