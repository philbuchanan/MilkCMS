<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class Settings {

	/**
	 * The settings array
	 */
	private $settings = array();
	
	
	
	/**
	 * Sets a setting value by key
	 * Accepts an array for setting multiple keys at once.
	 *
	 * @param string $key The setting key to set
	 * @param any $value The value of the setting setting
	 *
	 * return void
	 */
	public function set($key, $value = null) {
		if (is_array($key)) {
			// set all new values
			$this->settings = array_merge($this->settings, $key);
		}
		else {
			$this->settings[$key] = $value;
		}
	}
	
	
	
	/**
	 * Gets a config value by key
	 *
	 * @param string $key The setting key to retrieve
	 *
	 * return array|string $value The value for the setting or all settings
	 */
	public function get($key = null) {
		// If no key set, return all settings
		if (empty($key)) {
			return $this->settings;
		}
		
		return $this->settings[$key];
	}

}
