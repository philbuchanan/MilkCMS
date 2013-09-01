<?php include('includes/header.php'); ?>

	<h2 class="search-title"><?php if ($search -> results == 0) echo 'No'; else echo $search -> results; ?> search result<?php if ($search -> results > 1 || $search -> results == 0) echo 's'; ?> for &ldquo;<span class="search-string"><?php echo $search -> string; ?></span>&rdquo;</h2>
	
	<form method="get" action="<?php echo c::get('home'); ?>">
		<input type="text" name="search" id="search" value="<?php if (isset($search -> string)) echo $search -> string; ?>" placeholder="Search" onmouseup="this.select()" />
		<input type="submit" value="Search" />
	</form>
	
	<?php foreach ($articles as $article) : ?>
	
		<section>
			<h3><a href="<?php $article -> get('permalink'); ?>"><?php echo Smartypants($article -> get('title', false)); ?></a></h3>
		</section>
	
	<?php endforeach; ?>

<?php include('includes/footer.php'); ?>