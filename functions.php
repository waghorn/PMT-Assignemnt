<?php
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

	function outputHost($row) {
		echo '<div class="host-container">';
		echo '<a class="host-view-section btn btn-default btn-default-no-end-right" href="/view-host/' . $row['hostID'] . '" class="view-host-link">';
		echo '<img src="/resources/';
		if ($row['hostStatus'] == 0) {
			echo 'grey';
		} else if ($row['faultIsError'] == 0) {
			echo 'green';
		} else {
			echo 'red';
		}
		echo '-icon.png" height="25">';
		echo $row['hostName'];
		echo '</a>';
		echo '<a href="/manage-host/' . $row['hostID'] . '" class="btn btn-default btn-default-no-end-left manage-host-link">&nbsp;</a>';
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
				faultDescription,
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

	function outputPing($row) {
		echo '<tr class="ping">';
		echo '<td><img src="/resources/';
		if ($row['faultIsError'] == 0) {
			echo 'green';
		} else {
			echo 'red';
		}
		echo '-icon.png" height="20"></td>';
		echo '<td>' . getPrettyTime($row['pingTime']) . '</td>';
		echo '<td>' . $row['faultDescription'] . '</td>';
		echo '<td>' . (isset($row['pingResponse']) ? $row['pingResponse'] . ' ms' : '-') . '</td>';
		echo '</tr>';
	}

	function getPrettyTime($timestampString) {
		$date = new DateTime($timestampString);
		$now = new DateTime();

		$interval = $date->diff($now);
		
		if ($interval->h > 36) { //over 2 days
			return $date->format('d/m/y h:i:s A');
		} else if ($interval->h > 12) { //over 1 day
			return 'Yesterday at ' . $date->format('h:i:s A');
		} else if ($interval->h > 1) { //over 1 hour
			return $date->format('h:i:s A');
		} else if ($interval->i > 1) { //over 1 minute
			return $interval->i . ' minutes ago';
		} else if ($interval->i == 1) { //exactly 1 minute
			return $interval->i . ' minute ago';
		} else if ($interval->s > 5) { //over 5 seconds ago
			return $interval->s . ' seconds ago';
		} else { //just now
			return 'Just now';
		}
	}

	function getHost($hostID) {
		include_once('database-connection.php');
		$connection = new DatabaseConnection();
		$rows = $connection->runQuery("
			SELECT 
        			hostName,
        			hostOct1,
				hostOct2,
				hostOct3,
				hostOct4,
        			hostPort,
				hostStatus,
				hostDescription				
			FROM
				host_Table h
			WHERE
				h.hostID = ?
		", array($hostID));
		unset($connection);
		return $rows[0];

	}

	function outputHostSummary($hostID) {
		$host = getHost($hostID);

		echo $host['hostName'] . ' | ' . $host['hostOct1'] . '.' . $host['hostOct2'] . '.' . $host['hostOct3'] . '.' . $host['hostOct4'] . ' | ' . $host['hostPort'] . ' | ';
		if ($host['hostStatus'] == 1) {
			echo 'Active';
		} else {
			echo 'Inactive';
		}
		echo ' | ' . $host['hostDescription'];
	}
?>