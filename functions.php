<?php
	//Gets the status of all servers for the homepage
	function getStatus() {
		include_once('database-connection.php');
		$connection = new DatabaseConnection();
		$rows = $connection->runQuery("
			SELECT 
				h.hostID,
        			hostName,
        			CONCAT(hostOct1, '.', hostOct2, '.', hostOct3, '.', hostOct4) AS hostIPAddress,
        			hostPort,
        			hostStatus,
        			faultIsError
			FROM
				host_Table h,
        			ping_Table p,
        			fault_Table f
			WHERE
				f.faultID = p.pingFaultID
			AND
				pingID = 
        				(
					 SELECT
                				 pingID
                 			 FROM
                 				 ping_Table
                			 WHERE
                 				 ping_Table.hostID = h.hostID
                 			 ORDER BY 
                 				 pingTime DESC
                 			 LIMIT 1
                			)
		");
		unset($connection);
		return $rows;
	}
	// Outputs each host and status on the homepage
	function outputHost($row) {
		echo '<div class="host">';
		echo '<a href="/view-host/' . $row['hostID'] . '" class="view-host-link"><img src="/resources/';
		if ($row['hostStatus'] == 0) {
			echo 'grey';
		} else if ($row['faultIsError'] == 0) {
			echo 'green';
		} else {
			echo 'red';
		}
		echo '-icon.png" height="20">';
		echo $row['hostName'] . '</a>';
		echo '<a href="/manage-host/' . $row['hostID'] . '" class="btn btn-default manage-host-link">&nbsp;</a>';
		echo '</div>';
	}

	function getPings($hostID) {
		include_once('database-connection.php');
		$connection = new DatabaseConnection();
		$rows = $connection->runQuery("
			SELECT 
				pingID,
				pingTime,
				pingResponse,
				pingFaultID,
				faultIsError
			FROM
				ping_Table p,
				fault_Table f
			WHERE
				f.faultID = p.pingFaultID
			AND
				p.hostID = ?
			ORDER BY
				p.pingTime DESC
			LIMIT 100
		", array($hostID));
		unset($connection);
		return $rows;
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
		Adds host to the database. Returns user to View Status page on completion
	*/
	function addHost() {
		
	}
	
	/*
		Searches for host. Determines the whether the search term is an IP address, host name etc.
		Takes a search term
		Calls getHost()
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
	
	/*
		Deletes log entries after set amount of time
	*/
	function deleteLogEntry() {
		
	}
	
	/*
		Gets error information
		Takes fault ID
	*/
	function getError($faultId) {
		
	}

?>