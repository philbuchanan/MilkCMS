<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class cache {
	
	public static function checkCache($filename) {
	
		# Make cache folder if it doesn't already exist
		if (!is_dir(c::get('root.cache'))) {
		
			if (!mkdir(c::get('root.cache'), 0755)) die('Unable to create cache folder.');
			
			self::cacheFile($filename);
			
		}
		else {
		
			$cachefile = c::get('root.cache') . "/$filename.html";
			
			# Does cached file exist?
			if (file_exists($cachefile)) {
				
				# Has cached file expired?
				$cachetime = c::get('cacheexpire') * 3600;
				if (time() - $cachetime < filemtime($cachefile)) include($cachefile);
				else self::cacheFile($filename);
				
				die();
			
			}
			else {
				self::cacheFile($filename);
			}
			
		}
		
	}
	
	private static function cacheFile($filename) {
	
		ob_start();
		
		# Get the article
		$article = files::readFiles($filename . '.txt');
		
		require_once(c::get('root.templates') . '/article.php');
		
		echo '<!-- From cache. Generated ' . date('r', time()) . '. -->';
		
		# Write cache file
		self::writeCache($filename);
		
		ob_end_flush();
	
	}
	
	private static function writeCache($filename) {
	
		# Write cache file
		$cachefile = c::get('root.cache') . "/$filename.html";
		$fp = fopen($cachefile, 'w');
		fwrite($fp, ob_get_contents());
		fclose($fp);
	
	}

}

?>