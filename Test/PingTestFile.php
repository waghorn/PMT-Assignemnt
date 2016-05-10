<?php
	$address1 = "81.21.76.62";
	$port1 = 3306;
	
	echo "Ping Results - ";
	
	ping($address1, $port1);
	
	function ping($address, $port) {
		$start = microtime(true);
		$fp = fsockopen($address, $port, $errno, $errstr, 30);
		$stop = microtime(true);
		
		if (!$fp) {
			echo "It went wrong - " . $errno . " - " . $errstr;
		}
		else {
			echo "It worked - time: ";
			$time = ($stop - $start) * 1000;
			echo $time;
		}		
		fclose($fp);
	}
?>