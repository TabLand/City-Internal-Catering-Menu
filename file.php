<?php
	include "cookies.php";
	include "logger.php";
	include "useragent.php";
	
	$cookies = read_cookies();
	
	$_GET["f"] = str_replace(" ","%20",$_GET["f"]);	
	
	if(strpos($_GET["f"],'MakeThumbnail.aspx') !==false )	{ 
		$_GET["f"] = str_replace("MakeThumbnail.aspxQuestionProductIDEquals","MakeThumbnail.aspx?ProductID=",$_GET["f"]);
		
		$opts = array('http'=>array(
				'header'=>
				"Content-Type:application/x-www-form-urlencoded\r\n".
				conv_cookies4headers($cookies) .
				"User-Agent: $useragent\r\n".
				"Content-Length: ". strlen(http_build_query($_POST)) . "\r\n",
				"method" => "POST",
				"content" => http_build_query($_POST)
				));

		$context = stream_context_create($opts);
		$url = "http://hospitality.city.ac.uk/".$_GET["f"];
		$data = file_get_contents($url,false,$context);
	}
	else {
		$url = "http://hospitality.city.ac.uk/".$_GET["f"];
		$data = file_get_contents($url,false,$context);
	}
	
	//dumping headers for later viewing
	log_it("Http Response Header Dump! ". var_export($http_response_header,true));
	
	header(arrayToHttpHeader($http_response_header));
	
	echo $data;
?>
