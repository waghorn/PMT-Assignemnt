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
?>