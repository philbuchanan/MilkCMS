<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class action {
	
	public static function doAction($action) {
		
		switch ($action) {
			case 'logout':
				self::logout();
				break;
			case 'clearcache':
				return self::clearCache();
				break;
			case 'upload':
				return self::uploadFile();
				break;
			case 'delete':
				return self::deleteFile();
				break;
		}
		
	}
	
	# Log out
	private static function logout() {
	
		session::logout();
		self::toUrl();
		
	}
	
	# Clear cache
	private static function clearCache() {
	
		$message = new message();
		
		$dir = '../cache/';
		
		if (is_dir($dir)) {
			
			# Create array of filenames
			$files = files::listDir($dir);
			foreach ($files as $file) {
				if (!files::remove($dir . $file)) $message -> set('cache.file.error', true);
			}
			
			if (!files::remove($dir)) $message -> set('cache.dir.error', true);
			
			$message -> set('cache.clear.success');
			
		}
		else {
		
			$message -> set('cache.exist.error', true);
			
		}
		
		return $message;
		
	}
	
	# Upload File
	private static function uploadFile() {
	
		$message = new message();
		
		# Check file size
		if ($_FILES['uploadedfile']['size'] <= 0) $message -> set('files.nofile', true);
		if ($_FILES['uploadedfile']['size'] > 100000) $message -> set('files.large', true);
		
		# Check file type
		$filetype = $_FILES['uploadedfile']['type'];
		$imagetypes = array(
			'image/gif',
			'image/jpeg',
			'image/png',
		);
		
		# Set content directories
		$filesdir = '../content/';
		$imagesdir = '../assets/images/uploads/';
		
		if (!is_dir($imagesdir)) mkdir($imagesdir, 0755, true);
		
		# Define target page
		if (in_array($filetype, $imagetypes)) $target_path = $imagesdir . basename($_FILES['uploadedfile']['name']);
		else if ($filetype == 'text/plain') $target_path = $filesdir . basename($_FILES['uploadedfile']['name']);
		else $message -> set('files.compatible', true);
		
		# Move file
		if (files::upload($_FILES['uploadedfile']['tmp_name'], $target_path)) $message -> set('files.upload.success');
		else $message -> set('files.upload.error', true);
		
		return $message;
		
	}
	
	# Delete File
	private static function deleteFile() {
	
		$message = new message();
		
		$dir = '../content/';
		$file = $_GET['file'];
		
		if (files::remove($dir . $file)) $message -> set('file.delete.success');
		else $message -> set('file.delete.error', true);
		
		return $message;
		
	}
	
	private static function toUrl($location = null) {
	
		if (!$location) $location = c::get('home');
		header('Location: ' . $location);
		
	}

}

?>