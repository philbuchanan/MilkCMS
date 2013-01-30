<?php 

if (!defined('ACCESS')) die('Direct access is not allowed');

class load {
	
	static function lib() {
		
		$root = c::get('root.system');
		
		require_once($root . '/lib/init.php');
		
	}
	
}

?>