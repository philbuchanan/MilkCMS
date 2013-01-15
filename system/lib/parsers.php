<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class parsers {

	public static function load() {
		
		$dir = c::get('root.site') . '/parsers/';
		
		$parsers = files::listDir($dir);
		
		foreach ($parsers as $parser) {
		
			include_once($dir . $parser);
		
		}
	
	}

}

?>