<?php 

if (!defined('ACCESS')) die('Direct access is not allowed');

class header {
	
	public static function error($code) {
	
		switch($code) {
			case 301:
				header('HTTP/1.0 301 Moved Permanently');
				break;
			case 404:
				header('HTTP/1.0 404 Not Found');
				break;
		}
		
		require_once(template::get('error'));
		
	}
	
}