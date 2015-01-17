<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class Files extends Basic {

	/**
	 * Holds the list of file names in the content directory
	 */
	private $files_list = array();
	
	
	
	/**
	 * The total number of files in $files_list
	 */
	private $count;
	
	
	
	/**
	 * Initial class constructor
	 * Loads and makes $settings object available from parent class. Then loads
	 * the content directory.
	 */
	function __construct() {
		parent::__construct();
		
		$this->files_list = $this->list_dir();
		
		$this->count = count($this->files_list);
	}
	
	
	
	/**
	 * List all files in a directory
	 * Returned file list is sorted by date in descending order.
	 *
	 * @param string $dir The directory to load
	 *
	 * return array An array of files
	 */
	public function list_dir($dir = null) {
		// If no directory is set, use default content folder
		if (!$dir) {
			$dir = $this->settings->get('root.content');
		}
		
		$skip = array('.', '..', '.DS_Store', 'images');
		
		$files = array();
		foreach (scandir($dir) as $file) {
			if (in_array($file, $skip)) {
				continue;
			}
			
			$files[$file] = filectime($dir . '/' . $file);
		}
		
		arsort($files);
		$files = array_keys($files);
		
		return ($files) ? $files : false;
	}
	
	
	
	/**
	 * Returns a files contents
	 *
	 * @param string $path The file path
	 *
	 * return string The file contents as a string, else false
	 */
	public function read($path) {
		// If no file path is set or file doesn't exist, return early
		if (!$path || !file_exists($path)) {
			return false;
		}
		
		return file_get_contents($path);
	}

}
