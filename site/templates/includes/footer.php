	<nav>
		<p>
		<?php 
			if ($template -> template == 'index') {
				$pagination -> getPrevPage();
				$pagination -> getNextPage();
			}
			else {
				echo '<a href="' . c::get('home') . '">&larr; Back to posts</a>';
			}
		?>
		</p>
	</nav>
</div>
</body>
</html>