<?php

$fp = fsockopen('hospitality.city.ac.uk', 80);
if($fp){
	$vars = array(
	   // '__EVENTTARGET' => 'ctl00$MainPlaceHolder$lbViewMenu'
	);
	$content = http_build_query($vars);

	fwrite($fp, "POST / HTTP/1.1\r\n");
	fwrite($fp, "Host: hospitality.city.ac.uk\r\n");
	fwrite($fp, "Content-Type: application/x-www-form-urlencoded\r\n");
	fwrite($fp, "Cookie: ASP_NET_SessionId=dvuuii45uljfv255isuvgyrw;\r\n");
	fwrite($fp, "Content-Length: ".strlen($content)."\r\n");
	fwrite($fp, "Connection: close\r\n");
	fwrite($fp, "\r\n");

	fwrite($fp, $content);

	header('Content-type: text/plain');
	while (!feof($fp)) {
	    echo fgets($fp, 128);
	}
	fclose($fp);
}
?>    