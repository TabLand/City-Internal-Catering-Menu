<?php
	$url = "http://hospitality.city.ac.uk/Default.aspx";
	$postdata = http_build_query(
	    array(
        	'__EVENTTARGET' => 'ctl00$MainPlaceHolder$lbViewMenu',
        	'__EVENTARGUMENT' => ''
	    )
	);

$opts = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => $postdata
    )
);

$context  = stream_context_create($opts);
$result = file_get_contents($url, false, $context);
echo $result;
?>
