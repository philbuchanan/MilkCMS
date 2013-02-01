<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class users {

	public static function login($username, $password) {
		
		# Load user credentials
		$user = self::load($username);
		
		if (!$user) return false;
		
		# Check username and password
		$hash = hash('sha256', $user['salt'] . hash('sha256', $password));
		
		if ($hash != $user['pass']) return false;
		else return $user['user'];
		
	}
	
	private static function load($username) {
	
		# Check for existing user account file
		$file = c::get('root.site') . '/accounts/' . $username . '.php';
		
		if (!file_exists($file)) return false;
		
		# Load account credentials
		ob_start();
		require($file);
		$account = ob_get_contents();
		ob_end_clean();
		
		$account = yaml($account);
		
		if (!is_array($account)) return false;
		
		return $account;
	
	}
	
	private static function hashPassword($password) {
	
		# Create password hash
		$hash = hash('sha256', $password);
		
		# Create salt
		function createSalt() {
			$string = md5(uniqid(rand(), true));
			return substr($string, 0, 3);
		}
		$salt = createSalt();
		$hash = hash('sha256', $salt . $hash);
		
		$passdetails = array($hash, $salt);
		
		return $passdetails;
	
	}

}

?>