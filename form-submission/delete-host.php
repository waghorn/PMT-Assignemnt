<?php
	$host['hostID'] = isset($_POST['hostID']) ? htmlspecialchars($_POST['hostID']) : null;

	if (empty($host['hostID'])) {
		$response = array('error' => true, 'description' => 'The request was invalid as hostID is mandatory');
	} else {
		$query = "DELETE FROM host_Table WHERE hostID=?;";
		$connection->runQuery($query, array($host['hostID']));
		$_SESSION['info-message'] = array('Success', 'Host successfully deleted');
		header("Location: /");
	}
?>