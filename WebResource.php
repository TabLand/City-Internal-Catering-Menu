<?php	
	include "useragent.php";
	//send cookies set
	$cookies1 = "";
	foreach($_COOKIE as $cname => $value){
		$cookies1 .= $cname . "=" . $value .";";
	}
	$opts = array('http'=>array('header'=>"Accept-language: en\r\n" .
                  "Cookie: ".$cookies1."\r\n" .
                  "User-Agent: $useragent\r\n"));
	$url = "http://hospitality.city.ac.uk/WebResource.axd?d=" . $_GET["d"] . "&t=" . $_GET["t"];
	$context = stream_context_create($opts);
	$data = file_get_contents($url, false, $context);
	
	//send headers
	arrayToHttpHeader($htt_response_header);
	echo $data;
?>
