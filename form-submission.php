<?php
	session_start();
	$action = isset($_GET['action']) ? htmlspecialchars($_GET['action']) : null;

	if (!isset($action)) {
		$response = array('error' => true, 'description' => 'No action parameter was found');
	} else {
		include_once('database-connection.php');
		$connection = new DatabaseConnection();

		switch ($action) {
			case 'add-host':
			case 'update-host':
			case 'delete-host':
				include_once('form-submission/' . $action . '.php');
				break;
			default:
				$response = array('error' => true, 'description' => 'The action specified could not be found');
		}
		unset($connection);
	}

	header('Content-Type: application/json');
	echo json_encode($response);
	
?>