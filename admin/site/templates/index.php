<?php include('includes/header.php'); ?>
	
	<h2>Upload An Article</h2>
	<form class="upload-form" enctype="multipart/form-data" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
		<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
		<label for="uploadedfile">Upload an image or text file:</label>
		<input name="uploadedfile" id="uploadedfile" type="file" class="upload" />
		<input type="submit" name="upload" value="Upload File" />
	</form>
	
	<?php include('includes/nav.php'); ?>
	
	<?php if (isset($status['message'])) { ?>
		<p class="message <?php if ($status['error']) echo 'error'; elseif (!$status['error']) echo 'success'; ?>"><?php echo $status['message']; ?></p>
	<?php } ?>
	
<?php include('includes/footer.php'); ?>