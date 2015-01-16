<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class App extends Basic {

	/**
	 * Set up the application
	 */
	function __construct() {
		parent::__construct();
		
		echo '<pre>';
		print_r($this->settings->get());
		echo '</pre>';
		
		$article = new Article(array());
	}

}
