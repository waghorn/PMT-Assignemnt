<?php
	$host = getHost($hostID);
	if (!isset($host)) {
		header('Location: /host-not-found');
	} 

	echo '<button class="btn delete-host-link" onclick="displayPopup(\'delete-host-popup\', true);">&nbsp;</button>';

	echo '<form id="manage-host-form" action="/form-submission.php?action=update-host" method="POST">';
	echo '<input type="hidden" style="display: none;" name="hostID" value="' . $hostID . '">';

	echo '<label>Host Name:</label>';
	echo '<input type="text" name="hostName" value="' . $host['hostName'] . '" required>';
	echo '<br>';

	echo '<label>IP Address:</label>';
	echo '<input type="number" max="255" name="hostOct1" value="' . $host['hostOct1'] . '" required>';
	echo '.';
	echo '<input type="number" max="255" name="hostOct2" value="' . $host['hostOct2'] . '" required>';
	echo '.';
	echo '<input type="number" max="255" name="hostOct3" value="' . $host['hostOct3'] . '" required>';
	echo '.';
	echo '<input type="number" max="255" name="hostOct4" value="' . $host['hostOct4'] . '" required>';
	echo '<br>';

	echo '<label>Port Number:</label>';
	echo '<input type="number" name="hostPort" value="' . $host['hostPort'] . '" required>';
	echo '<br>';

	echo '<label>Status:</label>';
	echo '<div class="host-status onoffswitch">';
	echo '<input type="checkbox" name="hostStatus" class="onoffswitch-checkbox" id="host-status"' . ($host['hostStatus'] == 1 ? ' checked' : '') . '>';
	echo '<label class="onoffswitch-label" for="host-status">';
	echo '<span class="onoffswitch-inner"></span>';
	echo '<span class="onoffswitch-switch"></span>';
	echo '</label>';
	echo '</div>';
	echo '<br>';

	echo '<label>Description:</label>';
	echo '<textarea name="hostDescription">' . $host['hostDescription'] . '</textarea>';
	echo '<br>';

	echo '<button class="btn save-host-link" type="submit">&nbsp;</button>';

	echo '</form>';
?>

<section class="popup" id="delete-host-popup" style="display: none;" onclick="displayPopup('delete-host-popup' , false);">
       <div class="message-box">
                  <h1>Are you sure?</h1>
                  <p>Deleting this host cannot be undone</p>
                  <button type="button" class="btn btn-default">Cancel</button>
		  <form id="delete-host-form" action="/form-submission.php?action=delete-host" method="POST">
			<input type="hidden" style="display: none;" name="hostID" value="<?php echo $hostID; ?>">
			<button class="btn btn-default" type="submit">Confirm</button>
		  </form>
       </div>
</section>