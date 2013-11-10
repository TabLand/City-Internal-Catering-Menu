<?php 
	function log_it($message){
		//A security risk - log.txt file permissions are set to 777, as student.city will not allow write to files unless they have public write permissions. Very strange.
		//Must replace this with a database when have more spare time
		$result = file_put_contents("log.txt",$message . " on " . date("F j, Y, g:i a") . "\r\n\r\n", FILE_APPEND);
		return $result;
	}

?>
