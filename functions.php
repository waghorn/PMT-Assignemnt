<?php
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
?>