<?php
	include "cookies.php";
	include "logger.php";
	echo conv_cookies4headers(read_cookies());
?>
