<?php include('includes/header.php'); ?>
	
	<section>
		<h2><?php echo SmartyPants($article -> get('title', false)); ?></h2>
		<article>
			<?php echo SmartyPants(Markdown($article -> get('text', false))); ?>
		</article>
	</section>
	
<?php include('includes/footer.php'); ?>