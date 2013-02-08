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
	
	public static function getArticles($start = null, $end = null) {
	
		# Set start and end article to retrieve
		if (!$start) $start = pagination::get('start');
		if (!$end) $end = pagination::get('end');
		
		# Get array of files
		$filesarray = files::listDir();
		natsort($filesarray);
		$articlelist = array_reverse($filesarray, false);
		
		# Push artile object into array
		$i = $start;
		$articles = array();
		
		while ($i <= $end) {
		
			array_push($articles, new article($articlelist[$i]));
			$i++;
		
		}
		
		return $articles;
		
	}
	
	public static function countArticles() {
		
		$dir = c::get('root.content');
		return count(glob($dir . '/*.txt'));
		
	}
	
	public static function set($filename, $contents) {
		
		$fp = fopen($filename, 'w');
		fwrite($fp, $contents);
		fclose($fp);
		
	}

}

?>