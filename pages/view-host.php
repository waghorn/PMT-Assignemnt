<?php
	$host = getHost($hostID);
	if (!isset($host)) {
		header('Location: /host-not-found');
	} 

	outputHostSummary($host);
	echo '<a href="/manage-host/' . $hostID . '" class="btn manage-host-link">&nbsp;</a>';

	$pings = getPings($hostID);

	echo '<table>';
	echo '<tr><th></th><th>Time</th><th>Description</th><th>Response Time</th></tr>';
	foreach ($pings as $ping) {
		outputPing($ping);
	}
	echo '</table>';
?>