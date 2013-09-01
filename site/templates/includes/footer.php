	<nav>
		<?php 
			if ($template -> template == 'index') {
				$pagination -> getPrevPage();
				$pagination -> getNextPage();
			}
			else {
				echo '<a href="' . c::get('home') . '">&larr; Back to posts</a>';
			}
		?>
	</nav>
</div>
<footer>
	<div class="container">
		<p class="copyright">&copy; <?php echo date('Y'); ?> <?php echo c::get('title'); ?></p>
	</div>
</footer>
</body>
</html>