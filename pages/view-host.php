View host page! - This page is for hostID <?php echo $hostID; ?>

<?php
	$host = getHost($hostID);
	

	$pings = getPings($hostID);
	print_r($pings);
	echo 'a';
?>