<?php	
	//write to cookies.json
	function write_cookies($cookies){
		
		//bugfix of ASP.NET_SessionId cookies being renamed ASP_NET_SessionId for an unknown reason
		if(array_key_exists("ASP_NET_SessionId", $cookies)){
			$cookies["ASP.NET_SessionId"] = $cookies["ASP_NET_SessionId"];
			log_it("ASP.NET Bug fix succeeded");
			log_it("Cookie dump " . var_export($cookies, true));
		}
		else{
			log_it("ASP.NET Bug fix failed");
		}
		
		//get dump for cookie array
		$out = var_export($cookies,true);
		
		foreach($cookies as $cname=>$value){
			setcookie($cname,$cvalue);
			$_COOKIE[$cname] = $cvalue;
		}
		
		log_it("Attempting to update cookies. Dump: " . $out);
	}
	
	function read_cookies(){
		$cookies = $_COOKIE;
		//bugfix of ASP.NET_SessionId cookies being renamed ASP_NET_SessionId for an unknown reason
		if(array_key_exists("ASP_NET_SessionId", $cookies)){
			$cookies["ASP.NET_SessionId"] = $cookies["ASP_NET_SessionId"];
			log_it("ASP.NET Bug fix succeeded");
			log_it("Cookie dump " . var_export($cookies, true));
		}
		return $cookies;
	}
	//converting a cookie array for use in http request headers using file_get_contents()
	function conv_cookies4headers($cookies){	
		//cookie header, pronounced cheddar
		log_it("Cookie Dump! pre conv_cookies4headers" . var_export($cookies, true));
		
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
		log_it("Cookie Dump! post conv_cookies4headers " . $cheader);
		return $cheader;
	}
	
?>
