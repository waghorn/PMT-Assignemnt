<div class="field-toggle onoffswitch">
	<input type="checkbox" class="onoffswitch-checkbox" id="field-toggle" checked onchange="changeToggle();">
	<label class="onoffswitch-label" for="field-toggle">
		<span class="onoffswitch-inner"></span>
		<span class="onoffswitch-switch"></span>
	</label>
</div>
<?php

	$rows = getStatus();
	foreach ($rows as $row) {
		outputHost($row);
	}
?>