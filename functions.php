<?php
	//Gets the status of all servers for the homepage
	function getStatus() {
		include_once('database-connection.php');
		$connection = new DatabaseConnection();
		$rows = $connection->runQuery('
			SELECT
				h.hostID,
				hostName,
				hostOct1,
				hostOct2,
				hostOct3,
				hostOct4,
				(
					SELECT
						pingTime
					FROM
						ping_Table p
					WHERE
						p.hostID = h.hostID
					ORDER BY
						pingTime DESC
					LIMIT
						1
				) AS pingTime,
				(
					SELECT
						pingResponse
					FROM
						ping_Table p
					WHERE
						p.hostID = h.hostID
					ORDER BY
						pingTime DESC
					LIMIT
						1
				) AS pingResponse,
				(
					SELECT
						pingFaultID
					FROM
						ping_Table p
					WHERE
						p.hostID = h.hostID
					ORDER BY
						pingTime DESC
					LIMIT
						1
				) AS pingFaultID
				FROM
					host_Table AS h
		');
		unset($connection);
		return $rows;
	}
	// Outputs each host and status on the homepage
	function outputHost($row) {
		echo '<tr>';
		if ($row['faultIsError'] === 0) {
			echo '<td><img src="/resources/green-icon.png" height="15"></td>';
		} else {
			echo '<td><img src="/resources/red-icon.png" height="15"></td>';
		}
		echo '<td>' . $row['hostName'] . '</td>';
		echo '<td><a href="/view-host/' . $row['hostID'] . '" class="btn-default"><img src="/resources/manage-icon.png"></a></td>';
		echo '</tr>';
	}
	
	/*	
		Pings the destination address
		Takes the IP address and Port number
		Returns Error number if ping fails or 'Thumbs up' if ping returns successful
	*/
	function ping($address, $port) {
		$fp = fsockopen($address, $port, $errno, $errstr, 30)
	}
	
	
	/*
		Gets host data to display
		Takes host ID 
	*/
	function getHost($hostId) {
		
	}
	
	/*
		Adds host to the database
	*/
	function addHost() {
		
	}
	
	/*
		Searches for host
	*/
	function searchHost($searchTerm) {
	
	}
	
	/*
		Updates host data
		Takes host ID
	*/
	function updateHost($hostId) {
		
	}
	
	/*
		Deletes host data from the database
		Takes host ID
	*/
	function deleteHost($hostId) {
		
	}
	/*
		Gets logs for the host from the database
		Takes host ID
	*/
	function getHostLogs($hostId) {
		
	}
	
	/*
		Adds error to error log
		Takes host ID and fault ID
	*/
	function addToLog($hostId, $faultid) {
		
	}
	
	function deleteLogEntry() {
		
	}
	
	function getError() {
		
	}

?>