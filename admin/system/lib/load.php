<?php 

if (!defined('ACCESS')) die('Direct access is not allowed');

class load {
	
	static function lib() {
		
		$root = c::get('root.system');
		
		require_once($root . '/lib/init.php');
		require_once($root . '/lib/session.php');
		require_once($root . '/lib/users.php');
		require_once($root . '/lib/cookie.php');
		require_once($root . '/lib/action.php');
		require_once($root . '/lib/yaml.php');
		
	}
	
}

?>