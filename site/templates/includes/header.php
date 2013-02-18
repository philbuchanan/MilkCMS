<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title><?php echo c::get('title'); if ($template -> template == 'article') echo ' &rarr; ' . $article -> get('title', false); ?></title>
	
	<?php if ($template -> template == 'article') { ?>
		<meta name="description" content="<?php echo substr(strip_tags(Markdown($article -> get('text', false))), 0, 147); ?>..." />
	<?php } ?>
	
	<link rel="stylesheet" href="<?php echo c::get('home'); ?>assets/styles/style.css" type="text/css" media="screen" />
</head>
<body>
<div class="container">
	<h1><a href="<?php echo c::get('home'); ?>"><?php echo c::get('title'); ?></a></h1>