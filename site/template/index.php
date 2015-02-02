<!DOCTYPE html>
<html lang="en-CA">
	<head>
		<meta charset="utf-8">
		<title><?php echo Settings::get('site_title'); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<header>
			<p class="site-title"><?php echo Settings::get('site_title'); ?></p>
			<p class="site-description"><?php echo Settings::get('site_description'); ?></p>
		</header>
		<main>
			<?php foreach($content['posts'] as $post) : ?>
				<article class="post">
					<header>
						<h1 class="post-title">
							<?php if (count($content['posts']) > 1) {
								printf('<a href="%s">%s</a>',
									$post['permalink'],
									$post['title']
								);
							}
							else {
								echo $post['title'];
							} ?>
						</h1>
						<p class="post-date"><?php echo date('l, F j, Y', $post['timestamp']); ?></p>
					</header>
					<div class="post-content">
						<?php echo $post['body']; ?>
					</div>
				</article>
			<?php endforeach; ?>
		</main>
	</body>
</html>