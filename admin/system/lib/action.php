<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class action {

	public static function doAction($action) {
		
		switch ($action) {
			case 'logout':
				self::logout();
				break;
			case 'clearcache':
				if (self::clearCache()) self::toUrl();
				break;
		}
		
	}
	
	# Log out
	private static function logout() {
	
		session::logout();
		self::toUrl();
		
	}
	
	# Clear cache
	private static function clearCache() {
	
		$dir = '../cache/';
		
		if (is_dir($dir)) {
		
			$skip = array('.', '..', '.DS_Store');
			
			# Create array of filenames
			$filesarray = array_diff(scandir($dir), $skip);
			foreach ($filesarray as $file) {
				if (self::removeFile($dir . $file)) return false;
			}
			
			return true;
			
		}
		else {
		
			return false;
			
		}
		
	}
	
	private static function removeFile($file) {
		
		if (unlink($file)) return true;
		else return false;
		
	}
	
	private static function toUrl($location = null) {
	
		if (!$location) $location = c::get('home');
		header('Location: ' . $location);
		
	}

}

?>