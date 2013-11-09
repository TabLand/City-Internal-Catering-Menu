<?php
	if (strpos($_GET["f"],'.css') !== false) header("Content-type: text/css");
	elseif(strpos($_GET["f"],'.jpg') !== false) header("Content-type: image/jpeg");
	elseif(strpos($_GET["f"],'.png') !==false ) header("Content-type: image/png");
	$_GET["f"] = str_replace(" ","%20",$_GET["f"]);
	if(strpos($_GET["f"],'MakeThumbnail.aspx') !==false )	{ 
		$_GET["f"] = str_replace("MakeThumbnail.aspxQuestionProductIDEquals","MakeThumbnail.aspx?ProductID=",$_GET["f"]);
		$cookies1 = "ASP.NET_SessionId=".$_COOKIE["ASP_NET_SessionId"].";";
		$cookies1 .= "ASP_NET_SessionId=".$_COOKIE["ASP_NET_SessionId"].";";	
		$opts = array('http'=>array(
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

		$context = stream_context_create($opts);
		$url = "http://hospitality.city.ac.uk/".$_GET["f"];
		$data = file_get_contents($url,false,$context);
	}
	else {
		$url = "http://hospitality.city.ac.uk/".$_GET["f"];
		$data = file_get_contents($url,false,$context);
	}
	
	echo $data;
?>
