<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class articles {
	
	public static function getArticles() {
	
		$start = pagination::get('start');
		$end = pagination::get('end');
		
		$filesarray = files::listDir();
		natsort($filesarray);
		$articlelist = array_reverse($filesarray, false);
		
		$i = $start;
		$articles = array();
		
		while ($i <= $end) {
		
			$details = files::readFiles($articlelist[$i]);
			array_push($articles, $details);
			$i++;
		
		}
		
		return $articles;
		
	}
	
}

?>