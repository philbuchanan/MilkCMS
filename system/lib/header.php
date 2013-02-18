<?php 

if (!defined('ACCESS')) die('Direct access is not allowed');

class header {
	
	public static function error($code) {
	
		self::logError($code);
		
		switch($code) {
			case 301:
				header('HTTP/1.0 301 Moved Permanently');
				break;
			case 403:
				header('HTTP/1.0 403 Forbidden');
				break;
			case 404:
				header('HTTP/1.0 404 Not Found');
				break;
		}
		
		require_once(template::get('error'));
		exit;
		
	}
	
	private static function logError($code) {
		
		# Log path and file
		$logdir = c::get('root') . '/log/';
		if (!is_dir($logdir)) mkdir($logdir, 0755, true);
		$path = $logdir . 'errors.log';
		
		# URI to log
		if (isset($_GET['uri'])) $uri = $_GET['uri'];
		else $uri = $_SERVER['REQUEST_URI'];
		
		# Add new log item
		$logfile = files::read($path);
		$logfile .= date('r') . ' ' . $code . ' ' . $uri . "\n";
		
		# Write log file
		files::set($path, $logfile);
		
	}
	
}