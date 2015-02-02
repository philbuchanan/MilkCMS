<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>MilkCMS</title>
	</head>
	<body>
		<main>
			<?php foreach($articles as $article) : ?>
				<article>
					<header>
						<h1 class="article-title">
							<?php if ($this->is_single) {
								printf('<a href="%s">%s</a>',
									$article['permalink'],
									$article['title']
								);
							}
							else {
								echo $article['title'];
							} ?>
						</h1>
						<p class="article-date"><?php echo date('l, F j, Y', $article['timestamp']); ?></p>
					</header>
					<div class="article-content">
						<?php echo $article['body']; ?>
					</div>
				</article>
			<?php endforeach; ?>
		</main>
	</body>
</html>