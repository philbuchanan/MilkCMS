<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class c {

	# The static config array
	private static $config = array();
	
	# Gets a config value by key
	static function get($key = null, $default = null) {
		if (empty($key)) return self::$config;
		return a::get(self::$config, $key, $default);
	}
	
	# Sets a config value by key
	static function set($key, $value = null) {
		if (is_array($key)) {
			// set all new values
			self::$config = array_merge(self::$config, $key);
		} else {
			self::$config[$key] = $value;
		}
	}
	
	# Loads an additional config file
	static function load($file) {
		if (file_exists($file)) require_once($file);
		return c::get();
	}

}

class a {
	
	# Gets an element of an array by key
	static function get($array, $key, $default = null) {
		return (isset($array[$key])) ? $array[$key] : $default;
	}
	
	# Returns the first element of an array
	static function first($array) {
		return array_shift($array);
	}
	
	# Returns the last element of an array
	static function last($array) {
		return array_pop($array);
	}
	
	# Checks if an array contains a certain string
	static function contains($array, $search) {
		$search = self::search($array, $search);
		return (empty($search)) ? false : true;
	}
	
	# Shows an entire array or object in a human readable way
	static function show($array, $echo = true) {
		$output = '<pre>';
		$output .= htmlspecialchars(print_r($array, true));
		$output .= '</pre>';
		if ($echo == true) echo $output;
		return $output;
	}
	
    # Search for elements in an array by regular expression
    static function search($array, $search) {
		return preg_grep('#' . preg_quote($search) . '#i', $array);
	}
	
}

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
		
		require_once(c::get('root.templates') . '/error.php');
		
	}
	
}