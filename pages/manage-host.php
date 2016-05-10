<?php
	$host = getHost($hostID);

	echo '<button class="btn save-host-link">&nbsp;</button>';
	echo '<button class="btn delete-host-link">&nbsp;</button>';

	echo '<form>';

	echo '<label>Host Name:</label>';
	echo '<input type="text" name="hostName" value="' . $host['hostName'] . '">';
	echo '<br>';

	echo '<label>IP Address:</label>';
	echo '<input type="number" max="255" name="hostOct1" value="' . $host['hostOct1'] . '">';
	echo '.';
	echo '<input type="number" max="255" name="hostOct2" value="' . $host['hostOct2'] . '">';
	echo '.';
	echo '<input type="number" max="255" name="hostOct3" value="' . $host['hostOct3'] . '">';
	echo '.';
	echo '<input type="number" max="255" name="hostOct4" value="' . $host['hostOct4'] . '">';
	echo '<br>';

	echo '<label>Port Number:</label>';
	echo '<input type="number" name="hostPort" max="255" value="' . $host['hostPort'] . '">';
	echo '<br>';

	echo '<label>Description:</label>';
	echo '<textarea name="hostDescription">' . $host['hostDescription'] . '</textarea>';
	echo '<br>';

	echo '</form>';
?>