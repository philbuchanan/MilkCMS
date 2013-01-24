<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class search {
	
	public static function get_results($search_string) {
	
		$files = files::listDir();
		natsort($files);
		$articlelist = array_reverse($files, false);
		
		$search_results = array();
		foreach ($articlelist as $article) {
			
			$details = files::readFiles($article);
			if (a::contains($details, strip_tags($search_string))) array_push($search_results, $details);
			
		}
		
		return $search_results;
		
	}
	
}

?>