<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class pagination {

	private $pageurl;
	public  $start;
	public  $end;
	public  $page;
	public  $pages;
	public  $next;
	public  $prev;
	public  $articles;
	
	public function __construct($page) {
	
		$this -> pageurl = 'page=';
		
		# Set variables
		$count = files::countArticles();
		$pages = round($count / c::get('articlesperpage'));
		if (($count / c::get('articlesperpage')) > $pages) $pages++;
		$start = ($page * c::get('articlesperpage')) - c::get('articlesperpage');
		$end = ($start + c::get('articlesperpage')) - 1;
		$next = $this -> nextPage($page, $pages);
		$prev = $this -> prevPage($page);
		
		$this -> set('page',     $page);  # Current page
		$this -> set('pages',    $pages); # Count pages
		$this -> set('next',     $next);  # Next page number
		$this -> set('prev',     $prev);  # Previous page number
		$this -> set('articles', $count); # Count articles
		$this -> set('start',    $start); # First article number
		
		# Check if on a valid page
		if ($this -> page > $this -> pages) header::error(404);
		
		# Last article number
		if ($end < $count) $this -> set('end', $end);
		else $this -> set('end', $count - 1);
	
	}
	
	private function set($key, $value = null) {
	
		$this -> $key = $value;
		
	}

	public function get($key) {
	
		if (!isset($this -> $key)) return false;
		else return $this -> $key;
		
	}
	
	private function nextPage($page, $pages) {
		
		$page++;
		
		if ($page > $pages) return false;
		return $page;
		
	}
	
	private function prevPage($page) {
		
		$page--;
		
		if ($page < 1) return false;
		return $page;
		
	}
	
	public function getNextPage($string = null) {
		
		$next = $this -> get('next');
		if ($next) {
			if (!$string) $string = 'Next Page &rarr;';
			echo '<a href="' . c::get('home') . $this -> pageurl . $next . '" class="next">' . $string . '</a>';
		}
		
	}
	
	public function getPrevPage($string = null) {
		
		$next = $this -> get('prev');
		if ($next) {
			if (!$string) $string = '&larr; Previous Page';
			echo '<a href="' . c::get('home') . $this -> pageurl . $next . '" class="prev">' . $string . '</a>';
		}
		
	}

}

?>