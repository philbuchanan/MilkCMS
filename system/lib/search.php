<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class search {

	public $string = '';
	public $results = 0;
	
	public function __construct($url) {
		
		$this -> string = str_replace('+', ' ', str_replace('?search=', '', $url));
		
	}
	
	public function getResults() {
	
		if (!$this -> string) return array();
		
		$files = files::listDir();
		
		$search_results = array();
		foreach ($files as $article) {
			
			$details = new article($article);
			foreach($details as $key => $value) {
			
				if ($key != 'permalink') {
					if (strstr(strtolower($value), strtolower($this -> string))) {
						array_push($search_results, $details);
						break;
					}
				}
				
			}
			
		}
		
		$this -> results = count($search_results);
		
		return $search_results;
		
	}
	
}

?>