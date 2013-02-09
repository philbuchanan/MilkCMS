<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class cache {
	
	public static function checkCache($filename) {
	
		$cachefile = c::get('root.cache') . "/$filename.html";
			
		# Does cached file exist?
		if (file_exists($cachefile)) {
			
			# Has cached file expired? If so, rewrite it
			if (!self::expired($cachefile)) include($cachefile);
			else self::cacheFile($filename);
		
		}
		else {
			self::cacheFile($filename);
		}
		
	}
	
	public static function createCacheDir() {
		
		if (!mkdir(c::get('root.cache'), 0755)) die('Unable to create cache folder.');
		
	}
	
	private static function expired($file) {
		
		$cachetime = c::get('cacheexpire') * 3600;
		if (time() - $cachetime < filemtime($file)) return false;
		else return true;
		
	}
	
	private static function cacheFile($filename) {
	
		ob_start();
		
		# Get the article
		$article = new article($filename . '.txt');
		
		require_once(template::get('article'));
		
		echo '<!-- From cache. Generated ' . date('r', time()) . '. -->';
		
		# Write cache file
		self::writeCache($filename);
		
		ob_end_flush();
	
	}
	
	private static function writeCache($filename) {
	
		# Write cache file
		$cachefile = c::get('root.cache') . "/$filename.html";
		files::set($cachefile, ob_get_contents());
	
	}

}

?>