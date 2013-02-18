<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class files {
	
	public static function listDir($dir = null) {
	
		if (!$dir) $dir = c::get('root.content');
		
		if (!is_dir($dir)) return false;
		$skip = array('.', '..', '.DS_Store', 'images');
		
		# Create array	of filenames
		$files = array_diff(scandir($dir), $skip);
		
		natsort($files);
		return array_reverse($files, false);
		
	}
	
	public static function read($path) {
		
		if (file_exists($path)) return file_get_contents($path);
		else return false;
		
	}
	
	public static function set($filename, $contents) {
		
		$fp = fopen($filename, 'w');
		fwrite($fp, $contents);
		fclose($fp);
		
	}
	
	public static function getArticles($start, $end) {
		
		# Get array of files
		$files = files::listDir();
		
		# Push artile object into array
		$i = $start;
		$articles = array();
		
		while ($i <= $end) {
		
			array_push($articles, new article($files[$i]));
			$i++;
		
		}
		
		return $articles;
		
	}
	
	public static function countArticles() {
		
		$dir = c::get('root.content');
		return count(glob($dir . '/*.txt'));
		
	}

}

?>