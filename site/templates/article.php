<?php include('includes/header.php'); ?>
	
	<section>
		<h2><?php echo SmartyPants($article['title']); ?></h2>
		<article>
			<?php echo SmartyPants(Markdown($article['text'])); ?>
		</article>
	</section>
	
<?php include('includes/footer.php'); ?>