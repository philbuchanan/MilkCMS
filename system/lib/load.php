<?php 

if (!defined('ACCESS')) die('Direct access is not allowed');

class load {
	
	static function lib() {
		
		$root = c::get('root.system');
		
		require_once($root . '/lib/init.php');
		require_once($root . '/lib/header.php');
		require_once($root . '/lib/files.php');
		require_once($root . '/lib/article.php');
		require_once($root . '/lib/pagination.php');
		require_once($root . '/lib/template.php');
		require_once($root . '/lib/cache.php');
		require_once($root . '/lib/parsers.php');
		require_once($root . '/lib/search.php');
		
	}
	
}

?>