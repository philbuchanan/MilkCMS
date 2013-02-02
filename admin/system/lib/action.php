<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class action {

	public static function doAction($action) {
		
		switch ($action) {
			case 'logout':
				self::logout();
				break;
		}
		
	}
	
	# Log out action
	private static function logout() {
	
		session::logout();
		self::toUrl();
		
	}
	
	private static function toUrl($location = null) {
	
		if (!$location) $location = c::get('home');
		header('Location: ' . $location);
		
	}

}

?>