<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class users {

	public static function login($username, $password) {
		
		# Load user credentials
		$user = yaml::load(c::get('root.site') . '/accounts/' . $username . '.php');
		
		if (!$user) return false;
		if (!array_key_exists('username', $user) || !array_key_exists('password', $user)) return false;
		
		# Check username and password
		$hash = hash('sha256', $user['salt'] . hash('sha256', $password));
		
		if ($hash != $user['password']) return false;
		else return $user['username'];
		
	}

}

?>