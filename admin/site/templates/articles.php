<?php include('includes/header.php'); ?>
	
	<h2>Articles</h2>
	
	<p>There are <?php echo files::countArticles(); ?> articles.</p>
	
	<p>Delete files is permanent and cannot be undone.</p>
	
	<ul class="files">
		<?php foreach($files as $file) { ?>
			<li><a href="<?php echo c::get('home') . '../' . str_replace('.txt', '', $file); ?>" target="_blank"><?php echo $file; ?></a><span><a href="#" onclick="confirmAction('This will delete the file <?php echo $file; ?> permanently.', '<?php echo c::get('home'); ?>articles?action=delete&file=<?php echo $file; ?>');">Delete</a></span></li>
		<?php } ?>
	</ul>
	
<?php include('includes/footer.php'); ?>