<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class app {

	public static function initiate() {
	
		# Parse URL
		$url = str_replace(c::get('rewritebase'), '', $_SERVER['REQUEST_URI']);
		
		# Load text parsers
		parsers::load();
		
		if (empty($url)) {
		
			if (c::get('frontasarticle')) {
			
				$articles = files::getArticles(0, 0);
				$url = str_replace(c::get('home'), '', $articles[0] -> permalink);
				$article = new article($url . '.txt');
				
				$template = new template();
				require_once($template -> get('frontpage'));
			
			}
			else {
			
				self::loadIndex();
			
			}
		
		}
		else {
		
			if (strstr($url, 'archive')) {
			
				self::loadIndex();
			
			}
			elseif (strstr($url, 'page=')) {
				
				$page = str_replace('page=', '', $url);
				
				if ($page == null) header::error(404);
				else self::loadIndex($page);
				
			}
			elseif (strstr($url, '?search=')) {
				
				# Get search results
				$search = new search($url);
				$articles = $search -> getResults();
				
				$template = new template();
				require_once($template -> get('search'));
				
			}
			else {
			
				if (file_exists(c::get('root.content') . '/' . $url . '.txt')) {
					
					# Is caching turned on?
					if (c::get('cacheexpire')) {
						
						if (!is_dir(c::get('root.cache'))) cache::createCacheDir();
						
						# Check the cache status and get existing or create new cached file
						cache::checkCache($url);
						
					}
					else {
						
						# Get the article
						$article = new article($url . '.txt');
						
						$template = new template();
						require_once($template -> get('article'));
					
					}
				
				}
				else {
				
					if (isset($_GET['e'])) header::error($_GET['e']);
					else header::error(404);
				
				}
				
			}
			
		}
	
	}
	
	private static function loadIndex($page = 1) {
		
		# Get page details
		$pagination = new pagination($page);
		
		$start = $pagination -> start;
		$end   = $pagination -> end;
		
		# Get article list in an array
		$articles = files::getArticles($start, $end);
		
		$template = new template();
		require_once($template -> get());
	
	}

}

?>