<?php 
	function log_it($message){
		//A security risk - log.txt file permissions are set to 777, as student.city will not allow write to files unless they have public write permissions. Very strange.
		//Must replace this with a database when have more spare time
		$anchor = "<a id=\"".date("F j, Y, g:i a")."\"><hr/></a>";
		$message = $anchor . "<pre>" . $message . "</pre>";
		$result = file_put_contents("log.txt",$message . " on " . date("F j, Y, g:i a") . "\r\n<br/>\r\n<br/>", FILE_APPEND);
		return $result;
	}

?>
