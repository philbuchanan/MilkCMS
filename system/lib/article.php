<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class article {
	
	public function __construct($file) {
	
		# Separate file sections
		$contents = explode('----', file_get_contents(c::get('root.content') . '/' . $file));
		
		# Set permalink member variable
		$filename = explode('.', $file, 2);
		$this -> permalink = c::get('home') . $filename[0];
		
		# Set article member varibales
		foreach ($contents as $items) {
		
			$details = explode(':', $items, 2);
			$key = strtolower(trim($details[0]));
			$value = trim($details[1]);
			$this -> $key = $value;
			
		}
	
	}
	
	public function get($key, $echo = true) {
		
		if (!isset($this -> $key)) return false;
		
		if ($echo) echo $this -> $key;
		else return $this -> $key;
		
	}
	
}

?>