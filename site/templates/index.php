<?php 

include('includes/header.php');
	
	foreach ($articles as $article) {
		
		?>
		
		<section>
			<h3><a href="<?php $article -> get('permalink'); ?>"><?php echo SmartyPants($article -> get('title', false)); ?></a></h3>
			<article>
				<?php echo SmartyPants(Markdown($article -> get('text', false))); ?>
			</article>
		</section>
		<div style="clear:both;"></div>
		
	<?php } ?>
	
	<nav>
		<p>
		<?php 
			if (pagination::get('prev')) echo '<a href="' . pagination::get('prev') . '" class="prev">&larr; Previous Page</a>';
			if (pagination::get('next')) echo '<a href="' . pagination::get('next') . '" class="next">Next Page &rarr;</a>';
		?>
		</p>
	</nav>
	
<?php include('includes/footer.php'); ?>