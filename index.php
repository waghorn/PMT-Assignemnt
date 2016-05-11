<?php
	session_start();
	include_once('functions.php');
	
	//sanitised GET variables
	$page = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : 'view-status';  //default page is 'view-status' page
    	$hostID = isset($_GET['hostID']) ? htmlspecialchars($_GET['hostID']) : null;

	//Disable all caching
	header("Cache-Control: no-cache, no-store, must-revalidate");
	header("Pragma: no-cache");
	header("Expires: 0"); 

	//Whitelist the possible pages, else include the error page
	switch ($page) {
		case 'view-status':
		case 'view-host':		
		case 'manage-host':
			break;
		default:
			$page = 'error';
	}

	$title = ucwords(str_replace('-',' ', $page)); //converts the page to readable text
?>
<!DOCTYPE html>
<html lang="en-GB">
<head>
	<meta charset="utf-8">
	<!--
		N3
		All rights reserved.
	-->
	<title><?php echo $title; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=3.0, minimum-scale=1.0">

	<Script src="https://code.jquery.com/jquery-2.2.3.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="/css/style.css">

</head>

<body>
	<div id="wrapper">
		<header>
			<section id="logo-group">
				<a href="/"><img src="/resources/logo.png" height="40"></a>
			</section>
			<section id="search-group">
				<input type="text" id="search-bar">
				<button class="btn search-host-link" onclick="">&nbsp;</button>
			</section>
			<section id="add-group">
				<button class="btn add-host-link" onclick="displayPopup('add-host-popup', true);">&nbsp;</button>
			</section>
		</header>
		<main>
			<h1><?php echo $title; ?></h1>
			<?php
				if (isset($_SESSION['info-message'])) {
					$title = $_SESSION['info-message'][0];
					$message = $_SESSION['info-message'][1];

					echo '<div class="info-message ' . strtolower($title) . '">';
					echo '<h2>' . $title . '</h2>';
					echo '<p>' . $message . '</p>';
					echo '</div>';

					unset($_SESSION['info-message']);
				}
				include_once('pages/' . $page . '.php');
			?>
		</main>
		<footer>
			<span>&copy; N3 <?php echo date('Y'); ?>. All rights reserved.</span>
	   	</footer>
		<section class="popup" id="add-host-popup" style="display: none;">
			<form id="add-host-form" action="/form-submission.php?action=add-host" method="POST">
				<label>Host Name:</label>
				<input type="text" name="hostName" placeholer="Library Print Server" required>
				<br>

				<label>IP Address:</label>
				<input type="number" max="255" name="hostOct1" placeholer="192" required>
				.
				<input type="number" max="255" name="hostOct2" placeholer="168" required>
				.
				<input type="number" max="255" name="hostOct3" placeholer="1" required>
				.
				<input type="number" max="255" name="hostOct4" placeholer="25" required>
				<br>

				<label>Port Number:</label>
				<input type="number" name="hostPort" placeholer="80" required>
				<br>

				<label>Status:</label>
				<div class="host-status onoffswitch">
					<input type="checkbox" name="hostStatus" class="onoffswitch-checkbox" id="host-status" checked>
					<label class="onoffswitch-label" for="host-status">
						<span class="onoffswitch-inner"></span>
						<span class="onoffswitch-switch"></span>
					</label>
				</div>
				<br>

				<label>Description:</label>
				<textarea name="hostDescription"></textarea>
				<br>

				<button class="btn btn-default" type="button" onclick="displayPopup('add-host-popup', false);">Cancel</button>
				<button class="btn btn-default" type="submit">Confirm</button>

			</form>
		</section>
	</div>	
	<script src="/javascript/javascript.js"></script>
</body>
</html>