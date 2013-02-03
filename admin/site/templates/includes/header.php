<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8" />
	<title>Admin</title>
	
	<meta name="robots" content="noindex, nofollow">
	
	<link rel="stylesheet" href="<?php echo c::get('home'); ?>assets/styles/style.css" type="text/css" media="screen" />
</head>
<body>
<div class="container <?php if (!session::isLoggedIn()) echo 'login-container'; ?>">

	<?php if (session::isLoggedIn()) { ?>
		<ul class="actions">
			<li><a href="<?php echo c::get('home'); ?>articles">Show Articles</a></li>
			<li><a href="<?php echo c::get('home'); ?>?action=clearcache">Clear Cache</a></li>
			<li><a href="<?php echo c::get('home'); ?>?action=logout">Log Out</a></li>
		</ul>
		<div class="clear"></div>
	<?php } ?>