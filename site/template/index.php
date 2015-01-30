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
						<p class="article-title"><a href="<?php $article->get('permalink'); ?>"><?php $article->get('title'); ?></a></p>
						<p class="article-date"><?php echo date('l, F j, Y', $article->get('date', false)); ?></p>
					</header>
					<div class="article-content">
						<?php $article->get('content'); ?>
					</div>
				</article>
			<?php endforeach; ?>
		</main>
	</body>
</html>