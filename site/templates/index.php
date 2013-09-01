<?php include('includes/header.php'); ?>

	<?php foreach ($articles as $article) : ?>
	
		<section>
			<h3><a href="<?php $article -> get('permalink'); ?>"><?php echo SmartyPants($article -> get('title', false)); ?></a></h3>
			<article>
				<?php echo SmartyPants(Markdown($article -> get('text', false))); ?>
			</article>
		</section>
	
	<?php endforeach; ?>

<?php include('includes/footer.php'); ?>