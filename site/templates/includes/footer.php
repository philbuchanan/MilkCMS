	<nav>
		<p>
		<?php 
			if ($template -> template == 'index') {
				$pagination -> getPrevPage();
				$pagination -> getNextPage();
			}
			elseif ($template -> template == 'frontpage') {
				echo '<a href="' . c::get('home') . 'archive">View all articles</a>';
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