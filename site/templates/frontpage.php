<?php include('includes/header.php'); ?>

	<section>
		<h3><a href="<?php $article -> get('permalink'); ?>"><?php echo SmartyPants($article -> get('title', false)); ?></a></h3>
		<article>
			<?php echo SmartyPants(Markdown($article -> get('text', false))); ?>
		</article>
	</section>

<?php include('includes/footer.php'); ?>