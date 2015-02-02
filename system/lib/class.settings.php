<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class Settings {

	static $settings = array();
	
	
	
	/**
	 * Sets a setting value by key
	 * Accepts an array for setting multiple keys at once.
	 *
	 * @param string $key The setting key to set
	 * @param any $value The value of the setting setting
	 *
	 * return void
	 */
	static function set($key, $value = null) {
		if (is_array($key)) {
			// set all new values
			self::$settings = array_merge(self::$settings, $key);
		}
		else {
			self::$settings[$key] = $value;
		}
	}
	
	
	
	/**
	 * Gets a config value by key
	 *
	 * @param string $key The setting key to retrieve
	 *
	 * return array|string $value The value for the setting or all settings
	 */
	static function get($key = null) {
		// If no key set, return all settings
		if (empty($key)) {
			return self::$settings;
		}
		
		return self::$settings[$key];
	}
	
	
	
	/**
	 * Load the configuration files
	 * Loads the default config file as well as an optional, additional config
	 * file based on the server name (for setting server specifc configuations).
	 *
	 * E.g. config.localhost.php will load a custom config file for localhost
	 */
	static function load_configs() {
		$default_config = self::get('config_dir') . '/config.php';
		$server_config  = self::get('config_dir') . '/config.' . $_SERVER['SERVER_NAME'] . '.php';
		
		require_once($default_config);
		
		// Optionally load a server sepcific config file
		if (file_exists($server_config)) {
			require_once($server_config);
		}
	}

}
