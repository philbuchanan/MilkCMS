<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class action {
	
	public static function doAction($action) {
		
		switch ($action) {
			case 'logout':
				self::logout();
				break;
			case 'clearcache':
				self::clearCache();
				break;
			case 'upload':
				self::uploadFile();
				break;
			case 'delete':
				self::deleteFile();
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
	
		$dir = '../cache/';
		
		if (is_dir($dir)) {
			
			# Create array of filenames
			$files = files::listDir($dir);
			foreach ($files as $file) {
				if (!files::remove($dir . $file)) self::toUrl('?m=cache.error');
			}
			
			if (!files::remove($dir)) self::toUrl('?m=cache.error');
			
			self::toUrl('?m=cache.clear');
			
		}
		else {
		
			self::toUrl('?m=cache.error');
			
		}
		
	}
	
	# Upload File
	private static function uploadFile() {
		
		# Check file size
		if ($_FILES['uploadedfile']['size'] <= 0) self::toUrl('?m=files.nofile');
		if ($_FILES['uploadedfile']['size'] > 100000) self::toUrl('?m=files.large');
		
		# Check file type
		$filetype = $_FILES['uploadedfile']['type'];
		$imagetypes = array(
			'image/gif',
			'image/jpeg',
			'image/png',
		);
		
		$filesdir = '../content/';
		$imagesdir = '../content/images/';
		
		# Define target page
		if (in_array($filetype, $imagetypes)) $target_path = $imagesdir . basename($_FILES['uploadedfile']['name']);
		else if ($filetype == 'text/plain') $target_path = $filesdir . basename($_FILES['uploadedfile']['name']);
		else self::toUrl('?m=files.compatible');
		
		# Move file
		if (files::upload($_FILES['uploadedfile']['tmp_name'], $target_path)) self::toUrl('?m=files.upload.success');
		else self::toUrl('?m=files.upload.error');
		
	}
	
	# Delete File
	private static function deleteFile() {
		
		$dir = '../content/';
		$file = $_GET['file'];
		
		if (files::remove($dir . $file)) self::toUrl(c::get('home') . 'articles?m=file.delete.success');
		else self::toUrl(c::get('home') . 'articles?m=file.delete.error');
		
	}
	
	private static function toUrl($location = null) {
	
		if (!$location) $location = c::get('home');
		header('Location: ' . $location);
		
	}

}

?>