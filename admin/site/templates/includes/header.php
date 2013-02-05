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