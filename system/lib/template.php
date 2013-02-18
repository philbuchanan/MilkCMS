<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class template {
	
	public function get($template = 'index') {
		
		$this -> template = $template;
		
		$path = self::getPath($template);
		
		if (is_file($path)) {
			return $path;
		}
		elseif ($template == 'search') {
			$path = self::getPath('index');
			if (is_file($path)) return $path;
		}
		
		die('Template file could not be found');
		
	}
	
	private static function getPath($template) {
		
		return c::get('root.templates') . "/$template.php";
		
	}

}