<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class article {
	
	public function __construct($file) {
	
		# Get file sections array
		$contents = $this -> getFileContentsArr($file);
		
		# Set article member varibales
		$this -> setMemberVar($contents);
		$this -> setPermalink($file);
	
	}
	
	public function get($key, $echo = true) {
		
		if (!isset($this -> $key)) return false;
		
		if ($echo) echo $this -> $key;
		else return $this -> $key;
		
	}
	
	private function getFileContentsArr($file) {
		
		return explode('----', files::read(c::get('root.content') . '/' . $file));
		
	}
	
	private function setMemberVar($contents) {
		
		foreach ($contents as $items) {
		
			$details = explode(':', $items, 2);
			$key = strtolower(trim($details[0]));
			$value = trim($details[1]);
			$this -> $key = $value;
			
		}
		
	}
	
	private function setPermalink($file) {
		
		$filename = explode('.', $file, 2);
		$this -> permalink = c::get('home') . $filename[0];
		
	}
	
}

?>