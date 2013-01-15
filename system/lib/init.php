<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class app {

	public static function initiate() {
	
		# Parse URL
		$url = str_replace(c::get('rewritebase'), '', $_SERVER['REQUEST_URI']);
		
		# Load text parsers
		parsers::load();
		
		if (empty($url)) {
		
			self::loadIndex();
		
		}
		else {
		
			if (strstr($url, 'page=')) {
				
				$page = str_replace('page=', '', $url);
				self::loadIndex($page);
				
			}
			else {
			
				if (file_exists(c::get('root.content') . '/' . $url . '.txt')) {
				
					# Is caching turned on?
					if (c::get('cacheexpire')) {
					
						# Make cache folder if it doesn't already exist
						if (!is_dir(c::get('root.cache'))) {
							if (!mkdir(c::get('root.cache'))) die('Unable to create cache folder.');
						}
						
						# Check the cache status and get existing or create new cached file
						cache::checkCache($url);
						
					}
					else {
						
						# Get the article
						$article = files::readFiles($url . '.txt');
						
						require_once(c::get('root.templates') . '/article.php');
					
					}
				
				}
				else {
				
					require_once(c::get('root.templates') . '/error.php');
				
				}
				
			}
			
		}
	
	}
	
	private static function loadIndex($page = 1) {
	
		$index = true;
		
		# Get page details
		pagination::pageDetails($page);
		
		# Get article list array
		$content = new articles();
		$articles = $content -> getArticles();
		
		require_once(c::get('root.templates') . '/index.php');
	
	}

}

?>