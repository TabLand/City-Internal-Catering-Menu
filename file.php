<?php
	include "cookies.php";
	include "logger.php";
	include "useragent.php";
	include "header.php";
	
	$cookies = read_cookies();
	
	$_GET["f"] = str_replace(" ","%20",$_GET["f"]);	
	
	//replace the MakeThumbnail url back so we can get proper thumbnails
	if(strpos($_GET["f"],'MakeThumbnail.aspx') !==false )	{ 
		$_GET["f"] = str_replace("MakeThumbnail.aspxQuestionProductIDEquals","MakeThumbnail.aspx?ProductID=",$_GET["f"]);

	}
	
	$opts = array('http'=>array(
			'header'=>
			//"Content-Type:application/x-www-form-urlencoded\r\n".
			conv_cookies4headers($cookies) .
			"User-Agent: $useragent\r\n"
		));
		
	$context = stream_context_create($opts);
	$url = "http://hospitality.city.ac.uk/".$_GET["f"];
	$data = file_get_contents($url,false,$context);
	
	//dumping headers for later viewing
	log_it("Http Response Header Dump! File.php ". var_export($http_response_header,true));
	
	//send the exact headers received from the server, replacing the old ones
	arrayToHttpHeader($http_response_header);
	
	echo $data;
?>
