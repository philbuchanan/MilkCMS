<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class App extends Basic {

	/**
	 * Set up the application
	 */
	function __construct() {
		parent::__construct();
		
		$files = new Files();
		
		$articles = $files->get_articles();
		
		echo '<pre>';
		print_r ($articles);
		echo '</pre>';
	}

}
