<?php
	outputHostSummary($hostID);
	echo '<a href="/manage-host/' . $hostID . '" class="btn manage-host-link">&nbsp;</a>';
?>


<h2>Latest Pings</h2>
<?php
	$pings = getPings($hostID);

	echo '<table>';
	echo '<tr><th></th><th>Time</th><th>Description</th><th>Response Time</th></tr>';
	foreach ($pings as $ping) {
		outputPing($ping);
	}
	echo '</table>';
?>