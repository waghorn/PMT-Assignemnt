<?php
	//-------------------------------------------------------------------------------------------------
	// PDO is used instead of MySQLi_* due to compatability with other database vendors and the fact
	// that I have used it in the past (and prefer the OO style). There is also better support for parametized
	// queries by passing the parameters as arrays.
	//-------------------------------------------------------------------------------------------------
	class DatabaseConnection {
		private $db;

		function __construct() {
			try {
				$username = "i7623005";
				$password = "4f318527da41caf3888ad3c5f4839c46";
				$host = "127.0.0.1";
				$database = $username;

				$db = new PDO('mysql:host=' . $host . ';dbname=' . $database . ';charset=utf8mb4', $username, $password,  array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
				$GLOBALS['db'] = $db;
			} catch (PDOException $ex) {
				echo 'A fatal error occurred connecting to the database - ' . getFriendlySQLError($ex);
			}
		}

		function runQuery($query, $parameters) {
			try {
				if ($parameters == NULL) {
					$stmt = $GLOBALS['db']->query($query);
				} else {
					$stmt = $GLOBALS['db']->prepare($query);
					$stmt->execute($parameters);
				}

				$results = null;
				if (
                                        strpos($query, 'INSERT') === FALSE &&
				        strpos($query, 'UPDATE') === FALSE &&
				        strpos($query, 'DELETE') === FALSE
                                    ) {
					$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
				}
				return $results;
			} catch (PDOException $ex) {
				echo '{"error":true,"description":"Error performing a query on the database - ' . getFriendlySQLError($ex) . '"}';
			}
		}

		function lastInsertID() {
			return $GLOBALS['db']->lastInsertId();
		}
		
		function __destruct() {
			$GLOBALS['db'] = null;
		}
	}

	//-------------------------------------------------------------------------
	// Full error details included along with freindly message for novice
	// and experienced users alike
	//-------------------------------------------------------------------------
	function getFriendlySQLError($ex) {
		switch ($ex->getCode()) {
			case 23000: //duplicate key
				foreach ($GLOBALS['PRODUCT_COLUMNS'] as $columnName => $properties) {
					if (strpos($ex->getMessage(), 'key \'' . $columnName . '\'') !== FALSE) {
						$errorColumn = humanReadable($columnName);
						break;
					}
				}
				if (isset($errorColumn)) {
					$msg = 'the ' . $errorColumn . ' entered already exists, please edit the existing product or create a new one';
				} else {
					$msg = 'a product already exists with a unqiue field entered, please edit the existing product or create a new one';
				}
				break;
			case 1045: //access denied
				$msg = 'access denied using the entered details, ensure the hostname, database, username and password are correct';
				break;
			case HY000: //general error
				$msg = 'a general error occurred, check the SQL syntax and try again';
				break;
			default:
				$msg = 'an unknown error occurred';
				break;
		}
		$msg .= '.<br><br>Full error details;<br>' . $ex->getMessage();
		return $msg;
	}
?>