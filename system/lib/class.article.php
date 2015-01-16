<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class Article {

	/**
	 * The articles data array
	 */
	private $properties = array();
	
	
	
	/**
	 * Set up the article
	 */
	function __construct($data) {
		$this->set($data);
	}
	
	
	
	/**
	 * Get an article value by key
	 *
	 * @param string $key The article key to retrieve
	 * @param bool $echo Whether to echo the value
	 *
	 * return void|value
	 */
	public function get($key, $echo = true) {
		// If no key is set, return early
		if (!array_key_exists($key, $this->properties)) {
			return false;
		}
		
		if ($echo) {
			echo $this->properties[$key];
		}
		else {
			return $this->properties[$key];
		}
	}
	
	
	
	/**
	 * Sets an article properties value by key
	 * Accepts an array for setting multiple keys at once.
	 *
	 * @param string $key The setting key to set
	 * @param any $value The value of the setting setting
	 *
	 * return void
	 */
	private function set($key, $value = null) {
		if (is_array($key)) {
			// set all new values
			$this->properties = array_merge($this->properties, $key);
		}
		else {
			$this->properties[$key] = $value;
		}
	}

}
