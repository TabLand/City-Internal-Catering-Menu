<?php
	//disable error reporting to hide circular redirect errors. TO DO Remove this line and find out what a circular redirect is, and how it can be avoided.
	//error_reporting(0);
	include "ua.php";
	include "cookies.php";
	include "logger.php";	
	//load cookies
	$cookies = read_cookies();
	
	//create http request header array
	$opts = array(
			'http'=>array(
				'header'=>
				"Content-Type:application/x-www-form-urlencoded\r\n".
				conv_cookies4headers($cookies) .
				"Host:hospitality.city.ac.uk\r\n".
				//these two lines may be causing the circular redirect error?
				"Origin:http://hospitality.city.ac.uk\r\n".
				"Referer:http://hospitality.city.ac.uk/\r\n".
				"User-Agent: $useragent\r\n".
				"Content-Length: ". strlen(http_build_query($_POST)) . "\r\n",
				"method" => "POST",
				"content" => http_build_query($_POST)
				));
				
	//main url. Visit atleast once to get a valid asp session cookie
	$url = "http://hospitality.city.ac.uk/Default.aspx?" . http_build_query($_GET);
	$context = stream_context_create($opts);
	
	//get data and headers
	$data =  file_get_contents($url, false, $context);
	//dumping headers for later viewing
	log_it("Http Response Header dump! " . var_export($http_response_header,true));
	
  	header("Content-Type: text/html");
	$cookies_temp = array();
	foreach ($http_response_header as $hdr) {
	    if (preg_match('/^Set-Cookie:\s*([^;]+)/', $hdr, $matches)) {
        	parse_str($matches[1], $tmp);
	        $cookies_temp += $tmp;
	    }
	}
	foreach($cookies_temp as $cname =>$cvalue){
		$cookies[$cname] = $cvalue;
		write_cookies($cookies);
	}
	
	$opts = array(
			'http'=>array(
				'header'=>
				"Content-Type:application/x-www-form-urlencoded\r\n".
				conv_cookies4headers($cookies) .
				"Host:hospitality.city.ac.uk\r\n".
				"Origin:http://hospitality.city.ac.uk\r\n".
				"Referer:http://hospitality.city.ac.uk/\r\n".
				"User-Agent: $useragent\r\n".
				"Content-Length: ". strlen(http_build_query($_POST)) . "\r\n",
				"method" => "POST",
				"content" => http_build_query($_POST)
				));

	
	/*//show request headers
	print_r(getAllHeaders());
	//show response headers
	echo "<br/><br/><br/>";
	print_r($http_response_header);
	foreach($cookies as $cname => $cvalue){
		setcookie($cname,$cvalue);
	}*/
	$url = "http://hospitality.city.ac.uk/ViewMenu.aspx?" . http_build_query($_GET);
	$context = stream_context_create($opts);
	$data =  file_get_contents($url, false, $context);
	
	$data = str_replace("&amp;","&",$data);
	$data = str_replace("/ScriptResource.axd","ScriptResource.php",$data);
  	$data = str_replace("/WebResource.axd","WebResource.php",$data);
  	$data = str_replace("Default.aspx","index.php",$data);
 	$data = str_replace("Stylesheet1.css","file.php?f=Stylesheet1.css",$data);
 	$data = str_replace("Updated/","file.php?f=Updated/",$data);
	$data = str_replace("ImageFiles/","file.php?f=ImageFiles/",$data);
	$data = str_replace("Fairtrade/","file.php?f=Fairtrade/",$data);
	$data = str_replace("EatLearnLive.jpg","file.php?f=EatLearnLive.jpg",$data);
	$data = str_replace("MakeThumbnail.aspx?ProductID=","file.php?f=MakeThumbnail.aspxQuestionProductIDEquals",$data);
	$data = str_replace("ViewMenu.aspx","index.php",$data);
	echo $data;
?>
