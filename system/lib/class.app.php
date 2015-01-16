<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class App {

	/**
	 * Set up the application
	 */
	function __construct() {
		global $settings;
		
		echo '<pre>';
		print_r($settings->get());
		echo '</pre>';
	}

}
