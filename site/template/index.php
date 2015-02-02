<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>MilkCMS</title>
	</head>
	<body>
		<main>
			<?php foreach($posts as $post) : ?>
				<article class="post">
					<header>
						<h1 class="post-title">
							<?php if ($this->is_single) {
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