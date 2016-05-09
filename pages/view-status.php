<?php
	$rows = getStatus();
	echo '<table>';
	foreach ($rows as $row) {
		outputHost($row);
	}
	echo '</table>';
?>