<?php	
	//write to cookies.json
	function write_cookies($cookies){
		//get json for cookie array
		$out = export_cookies($cookies);
		
		//bugfix of ASP.NET_SessionId cookies being renamed ASP_NET_SessionId for an unknown reason
		if(array_key_exists("ASP_NET_SessionId", $cookies)){
			$cookies["ASP.NET_SessionId"] = $cookies["ASP_NET_SessionId"];
			log_it("ASP.NET Bug fix succeeded");
			log_it("Cookie dump " . var_export($cookies, true));
		}
		else{
			log_it("ASP.NET Bug fix failed");
		}
		
		log_it("Attempting to update cookies. Serialized dump: " . $out);
		
		//try to write to cookies.json
		//A security risk - cookie_jar.ser file permissions are set to 777, as student.city will not allow writes to files unless they have public write permissions. Very strange.
		//Must replace this with a database when have more spare time
		//cannot use json, as json functions do not exist on the available version of php on student.city
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
			$in = import_cookies($read);
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
	
	function export_cookies($cookies){
		$exp = "";
		foreach($cookies as $cname=>$cvalue){
			$exp .= $cname . "=" . $cvalue . ";\r\n";
		}
		return $exp;
	}
	function import_cookies($text){
		$cookies = array();
		$cookie_rows = explode(";\r\n",$text);
		foreach($cookie_rows as $cookie_row){
			$temp = explode("=",$cookie_row);
			$cookies[$temp[0]] = $temp[1];
		}
		return $cookies;
	}
?>
