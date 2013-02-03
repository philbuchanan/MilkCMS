<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class files {
	
	public static function listDir($dir = null) {
	
		if (!$dir) $dir = c::get('root.content');
		
		if (!is_dir($dir)) return false;
		$skip = array('.', '..', '.DS_Store', 'images');
		
		# Create array	of filenames
		return array_diff(scandir($dir), $skip);
		
	}
	
	public static function countArticles() {
		
		$dir = c::get('root.content');
		return count(glob($dir . '/*.txt'));
		
	}

}

?>