<?php
	$host['hostName'] = isset($_POST['hostName']) ? htmlspecialchars($_POST['hostName']) : null;
	$host['hostOct1'] = isset($_POST['hostOct1']) ? htmlspecialchars($_POST['hostOct1']) : null;
	$host['hostOct2'] = isset($_POST['hostOct2']) ? htmlspecialchars($_POST['hostOct2']) : null;
	$host['hostOct3'] = isset($_POST['hostOct3']) ? htmlspecialchars($_POST['hostOct3']) : null;
	$host['hostOct4'] = isset($_POST['hostOct4']) ? htmlspecialchars($_POST['hostOct4']) : null;
	$host['hostPort'] = isset($_POST['hostPort']) ? htmlspecialchars($_POST['hostPort']) : null;
	$host['hostStatus'] = isset($_POST['hostStatus']) ? htmlspecialchars($_POST['hostStatus']) : 0;
	$host['hostDescription'] = isset($_POST['hostDescription']) ? htmlspecialchars($_POST['hostDescription']) : null;

	$emptyFields = array();

	foreach ($host as $columnName => $data) {
		if (empty($data) && $columnName !== 'hostStatus') {
			$emptyFields[] = $columnName;
		}
	}
	
	if (count($emptyFields) > 0) {
		$response = array('error' => true, 'description' => 'The request was invalid as ' . implode(', ', $emptyFields) . ' are mandatory');
	} else {
		$query = "INSERT INTO host_Table (hostName, hostOct1, hostOct2, hostOct3, hostOct4, hostPort, hostStatus, hostDescription) VALUES(?,?,?,?,?,?,?,?);";
		$connection->runQuery(
				$query,
				array(
					$host['hostName'],
					$host['hostOct1'],
					$host['hostOct2'],
					$host['hostOct3'],	
					$host['hostOct4'],
					$host['hostPort'],
					$host['hostStatus'],
					$host['hostDescription']
				)
		);
		$response = array('error' => false, 'hostID' => $connection->lastInsertID());
	}
?>