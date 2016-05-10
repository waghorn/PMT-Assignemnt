<?php
	echo '<div class="host-summary-container">';
	outputHostSummary($hostID);
	echo '<a href="/manage-host/' . $hostID . '" class="btn manage-host-link">&nbsp;</a>';
	echo '</div>';
?>


<h2>Latest Pings</h2>
<?php
	$pings = getPings($hostID);

	echo '<table class="table table-striped table-hover table-condensed table-responsive">';
	echo '<tr><th>Status</th><th>Time</th><th>Description</th><th>Response Time</th></tr>';
	foreach ($pings as $ping) {
		outputPing($ping);
	}
	echo '</table>';
?>
