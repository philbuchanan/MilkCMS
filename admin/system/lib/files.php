<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class files {
	
	public static function listDir($dir = null) {
	
		if (!$dir) $dir = c::get('root.content');
		
		if (!is_dir($dir)) return false;
		$skip = array('.', '..', '.DS_Store');
		
		# Create array	of filenames
		return array_diff(scandir($dir), $skip);
		
	}
	
	public static function countArticles() {
		
		$dir = c::get('root.content');
		return count(glob($dir . '/*.txt'));
		
	}
	
	public static function upload($file, $path) {
	
		if (move_uploaded_file($file, $path)) return true;
		else return false;
	
	}
	
	public static function remove($path) {
	
		if (file_exists($path)) {
			if (is_dir($path)) {
				if (rmdir($path)) return true;
			}
			else {
				if (unlink($path)) return true;
			}
		}
		
		return false;
		
	}

}

?>