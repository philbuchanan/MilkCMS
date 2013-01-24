<?php include('includes/header.php'); ?>

<?php $results = count($articles); ?>

<h2 class="search-title"><?php if ($results == 0) echo 'No'; else echo $results; ?> search result<?php if ($results > 1 || $results == 0) echo 's'; ?> for: <span class="search-string"><?php echo $search_string; ?></span></h2>

<form method="get" action="<?php echo c::get('home'); ?>">
	<input id="search" name="search" type="text" value="<?php if (isset($search_string)) echo $search_string; ?>" onmouseup="this.select()" />
	<input type="submit" value="Search" />
</form>
<div style="clear:both"></div>

<?php foreach ($articles as $article) { ?>
	
	<section>
		<h3><a href="<?php echo $article['permalink'] ?>"><?php echo Smartypants($article['title']); ?></a></h3>
	</section>
	
<?php } ?>

<?php include('includes/footer.php'); ?>