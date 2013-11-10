<?php	
	//write to cookies.json
	function write($cookies){
		//get json for cookie array
		$out = json_encode($cookies);
		//try to write to cookies.json
		$write = file_put_contents("cookies.json", $out, LOCK_EX);
		if($write)){
			return true;
		else {
			//if we fail, log it!!
			$message = "\r\nERROR!! Unable to write to cookies.json!! at " . date("F j, Y, g:i a");
			file_put_contents("log", $message, FILE_APPEND);
			return false;
		}
	}
	function read(){
		//get json for cookie array
		$read = file_get_contents("cookies.json");
		//decode json
		if($read) {
			$in = json_decode($read);
			return $in;
		}
		else{
		//if failed, log it!
			//if we fail, log it!!
			$message = "\r\nERROR!! Unable to read from cookies.json!! at " . date("F j, Y, g:i a");
			file_put_contents("log", $message, FILE_APPEND);
			return false;
		}
	}

?>
