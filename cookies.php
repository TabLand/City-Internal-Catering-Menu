<?php	
	//write to cookies.json
	function write_cookies($cookies){
		//get json for cookie array
		$out = serialize($cookies);
		//try to write to cookies.json
		
		//A security risk - cookie_jar.ser file permissions are set to 777, as student.city will not allow write to files unless they have public write permissions. Very strange.
		//Must replace this with a database when have more spare time
		//cannot use json, as json functions do not exist on the available version of php on student.city
		
		//solve bug of ASP.NET_SessionId cookies being renamed ASP_NET_SessionId
		
		$write = file_put_contents("cookie_jar.ser", $out, LOCK_EX);
	
		if($write){
			return true;
		}
		else {
			//if we fail, log it!!
			log_it("ERROR!! Unable to write to cookie_jar.ser!!");
			return false;
		}
	}
	
	function read_cookies(){
		//get json for cookie array
		$read = file_get_contents("cookie_jar.ser");
		//decode json
		if($read) {
			$in = unserialize($read);
			return $in;
		}
		else{
			//if we fail, log it!!
			log_it("ERROR!! Unable to read from cookie_jar.ser!!");
			return false;
		}
	}
	//converting a cookie array for use in http request headers using file_get_contents()
	function conv_cookies4headers($cookies){
	
		
		//cookie header, pronounced cheddar
		if(sizeof($cookies)>0){
			$cheader = "Cookie: ";
			foreach($cookies as $cname=>$cvalue){
				//append the new cookies
				$cheader .= $cname . "=" . $cvalue . ";";
			}
			//postfix with a newline
			$cheader .= "\r\n";
		}
		//worst that can happen is that we have no cookies at home
		else {
			$cheader ="";
		}
		//log structure of cookies received
		log_it("Cookie Dump! conv_cookies4headers " . $cheader);
		return $cheader;
	}

?>
