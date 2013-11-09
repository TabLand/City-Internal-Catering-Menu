<?php
	error_reporting(0);
	include "ua.php";
	//send cookies set
	$cookies1 = "ASP.NET_SessionId=".$_COOKIE["ASP_NET_SessionId"].";";
	$cookies1 .= "ASP_NET_SessionId=".$_COOKIE["ASP_NET_SessionId"].";";


	$opts = array(
			'http'=>array(
				'header'=>
				"Content-Type:application/x-www-form-urlencoded\r\n".
				"Cookie: ".$cookies1."\r\n".
				"Host:hospitality.city.ac.uk\r\n".
				"Origin:http://hospitality.city.ac.uk\r\n".
				"Referer:http://hospitality.city.ac.uk/\r\n".
				"User-Agent: $useragent\r\n".
				"Content-Length: ". strlen(http_build_query($_POST)) . "\r\n",
				"method" => "POST",
				"content" => http_build_query($_POST)
				));

	$url = "http://hospitality.city.ac.uk/Default.aspx?" . http_build_query($_GET);
	
	$context = stream_context_create($opts);
	$data =  file_get_contents($url, false, $context);
	 
  	header("Content-Type: text/html");
	$cookies = array();
	foreach ($http_response_header as $hdr) {
	    if (preg_match('/^Set-Cookie:\s*([^;]+)/', $hdr, $matches)) {
        	parse_str($matches[1], $tmp);
	        $cookies += $tmp;
	    }
	}
	foreach($cookies as $cname =>$cvalue){
		$_COOKIE[$cname] = $cvalue;
		setcookie($cname, $cvalue);
	}
	$cookies1 = "ASP.NET_SessionId=".$_COOKIE["ASP_NET_SessionId"].";";
	$cookies1 .= "ASP_NET_SessionId=".$_COOKIE["ASP_NET_SessionId"].";";


	$opts = array(
			'http'=>array(
				'header'=>
				"Content-Type:application/x-www-form-urlencoded\r\n".
				"Cookie: ".$cookies1."\r\n".
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
