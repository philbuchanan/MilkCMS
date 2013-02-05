<?php if (session::isLoggedIn()) { ?>
	<ul class="actions">
		<li><a href="<?php echo c::get('home'); ?>">Upload Article</a></li>
		<li><a href="<?php echo c::get('home'); ?>articles">Manage Articles</a></li>
		<?php if (is_dir('../cache/')) { ?><li><a href="<?php echo c::get('home'); ?>?action=clearcache">Delete Cache</a></li><?php } ?>
		<li class="logout"><a href="<?php echo c::get('home'); ?>?action=logout">Log Out</a></li>
	</ul>
	<div class="clear"></div>
<?php } ?>