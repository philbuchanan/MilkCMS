<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class pagination {

	private static $pagedetails = array();
	
	static function set($key, $value = null) {
	
		self::$pagedetails[$key] = $value;
		
	}

	static function get($key = null, $default = null) {
	
		if (empty($key)) return self::$pagedetails;
		return a::get(self::$pagedetails, $key, $default);
		
	}
	
	public static function pageDetails($page) {
		
		# Set variables
		$count = files::countArticles();
		$pages = round($count / c::get('articlesperpage'));
		if (($count / c::get('articlesperpage')) > $pages) $pages++;
		$start = ($page * c::get('articlesperpage')) - c::get('articlesperpage');
		$end = ($start + c::get('articlesperpage')) - 1;
		$next = self::nextPage($page, $pages);
		$prev = self::prevPage($page);
		
		self::set('page',	$page);		# Current page
		self::set('pages',	$pages);	# Count pages
		self::set('next',	$next);		# Next page number
		self::set('prev',	$prev);		# Previous page number
		self::set('count',	$count);	# Count articles
		self::set('start',	$start);	# First article number
		
		# Last article number
		if ($end < $count) self::set('end', $end);
		else self::set('end', $count - 1);
		
	}
	
	private static function nextPage($page, $pages) {
		
		$page++;
		
		if ($page > $pages) return false;
		return 'page=' . $page;
		
	}
	
	private static function prevPage($page) {
		
		$page--;
		
		if ($page < 1) return false;
		return 'page=' . $page;
		
	}

}

?>