<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class Basic {

	/**
	 * Hold settings object
	 */
	protected $settings;
	
	
	
	function __construct() {
		global $settings;
		
		$this->settings = $settings;
	}

}
