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
	
	public static function readFiles($file) {
	
		# Separate file sections
		$contents = explode('----', file_get_contents(c::get('root.content') . '/' . $file));
		$contents_arr = array();
		
		# Generate URL
		$filename = explode('.', $file, 2);
		$contents_arr['permalink'] = c::get('home') . $filename[0];
		
		# Create article array
		foreach ($contents as $items) {
		
			$details = explode(':', $items, 2);
			$contents_arr[strtolower(trim($details[0]))] = trim($details[1]);
			
		}
		
		return $contents_arr;
	
	}
	
	public static function set($filename, $contents) {
		
		$fp = fopen($filename, 'w');
		fwrite($fp, $contents);
		fclose($fp);
		
	}

}

?>