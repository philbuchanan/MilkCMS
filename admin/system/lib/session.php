<?php 

if (!defined('ACCESS')) die('Direct access is not allowed');

class session {

	public static function validateUser($username) {
	
		session_regenerate_id();
		$_SESSION['valid'] = 1;
		$_SESSION['username'] = $username;
		
	}
	
	public static function isLoggedIn() {
	
		if (isset($_SESSION['valid']) && $_SESSION['valid']) return true;
		return false;
		
	}
	
	public static function logout() {
	
		cookie::remove('username');
		cookie::remove('password');
		
		$_SESSION = array();
		session_destroy();
		
	}

}

?>