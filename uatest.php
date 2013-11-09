<?php
	$opts = array('http'=>array('header'=>"Accept-language: en\r\n"."Cookie: foo=bar\r\n" ."User-Agent: Mozilla/5.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; GTB7.4; InfoPath.2; SV1; .NET CLR 3.3.69573; WOW64; en-US)\r\n"));
	$url = "http://hospitality.city.ac.uk/Default.aspx";
	$context = stream_context_create($opts);
	echo file_get_contents($url, false, $context);
?>
