<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class cookie {
	
	public static function set($name, $value, $days = 365) {
		
		$expire = time() + 60 * 60 * 24 * $days;
		setcookie($name, $value, $expire, c::get('rewritebase'));
		
	}
	
	public static function get($name) {
		
		if (isset($_COOKIE[$name])) return $_COOKIE[$name];
		else return false;
		
	}
	
	public static function remove($name) {
		
		if (isset($_COOKIE[$name])) self::set($name, '', 0);
		
	}
	
}

?>