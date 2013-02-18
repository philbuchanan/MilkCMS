<?php 

include('includes/header.php');
	
	foreach ($articles as $article) :
		
		?>
		
		<section>
			<h3><a href="<?php $article -> get('permalink'); ?>"><?php echo SmartyPants($article -> get('title', false)); ?></a></h3>
			<article>
				<?php echo SmartyPants(Markdown($article -> get('text', false))); ?>
			</article>
		</section>
		<div style="clear:both;"></div>
		
	<?php endforeach; ?>
	
	<nav>
		<p>
		<?php 
			$pagination -> getPrevPage();
			$pagination -> getNextPage();
		?>
		</p>
	</nav>
	
<?php include('includes/footer.php'); ?>