<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class users {

	public static function login($username, $password) {
		
		# Load user credentials
		$user = self::load($username);
		
		if (!$user) return false;
		if (!array_key_exists('username', $user) || !array_key_exists('password', $user)) return false;
		
		# Check username and password
		$hash = hash('sha256', $user['salt'] . hash('sha256', $password));
		
		if ($hash != $user['password']) return false;
		else return $user['username'];
		
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

}

?>