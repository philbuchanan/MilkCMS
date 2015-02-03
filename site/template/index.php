<!DOCTYPE html>
<html lang="en-CA">
	<head>
		<meta charset="utf-8">
		<title><?php echo $content['site_title']; ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<header>
			<p class="site-title"><?php echo $content['site_title']; ?></p>
			<p class="site-description"><?php echo $content['site_description']; ?></p>
		</header>
		<main>
			<?php foreach($content['posts'] as $post) : ?>
				<article class="post">
					<header>
						<h1 class="post-title">
							<?php if (count($content['posts']) > 1) { ?>
								<a href="<?php echo $post['permalink']; ?>"><?php echo $post['title']; ?></a>
							<?php }	else {
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
			<?php if (isset($content['pagination'])) : ?>
				<nav class="pagination">
					<?php if (isset($content['pagination']['prev_page'])) { ?>
						<a href="<?php echo $content['pagination']['prev_page']; ?>" class="pagination-link prev-page">Newer Posts</a>
					<?php } ?>
					<?php if (isset($content['pagination']['next_page'])) { ?>
						<a href="<?php echo $content['pagination']['next_page']; ?>" class="pagination-link next-page">Older Posts</a>
					<?php } ?>
				</nav>
			<?php endif; ?>
		</main>
	</body>
</html>