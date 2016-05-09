<?php
	include_once('functions.php');
	
	$page = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : 'view-status';  //default page is 'view-status' page
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
				<img src="/resources/logo.png" height="40">
			</section>
			<section id="search-group">
				<input type="text" id="search-bar">
				<button class="btn btn-primary" id="search-host" onclick=""><img src="/resources/search-icon.png"></button>
			</section>
			<section id="add-group">
				<button id="add-host" onclick=""><img src="/resources/add-icon.png"></button>
			</section>
		</header>
		<main>
			<h1><?php echo $title; ?></h1>
			<?php
			    //Whitelist the possible pages, else include the error page
				switch ($page) {
					case 'view-status':
					case 'view-host':		
					case 'manage-host':
						include_once('pages/' . $page);
						break;
					default:
						include_once('pages/error.php');
				}
			?>
		</main>
		<footer>
			<span>&copy; N3 <?php echo date('Y'); ?>. All rights reserved.</span>
	    </footer>
	</div>	
	<script src="/javascript/javascript.js"></script>
</body>
</html>