<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
	<title><?php echo c::get('title'); if ($template -> template == 'article') echo ' &rarr; ' . $article -> get('title', false); ?></title>
	
	<?php if ($template -> template == 'article') { ?>
		<meta name="description" content="<?php echo substr(strip_tags(Markdown($article -> get('text', false))), 0, 147); ?>..." />
	<?php } ?>
	
	<meta name="viewport" content="width=device-width">
	
	<link rel="shortcut icon" href="<?php echo c::get('home'); ?>assets/images/logos/favicon.ico">
	<link rel="stylesheet" type="text/css" href="<?php echo c::get('home'); ?>assets/styles/style.css">
</head>
<body>
<header>
	<div class="container">
		<h1><a href="<?php echo c::get('home'); ?>"><?php echo c::get('title'); ?></a></h1>
	</div>
</header>
<div class="container">