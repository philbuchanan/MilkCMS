<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class Files extends Basic {

	function __construct() {
		parent::__construct();
	}
	
	
	
	/**
	 * List all files in a directory
	 */
	public function list_dir($dir = null) {
		// If no directory is set, use default content folder
		if (!$dir) {
			$dir = $this->settings->get('root.content');
		}
		
		if (!is_dir($dir)) {
			return false;
		}
		
		$skip = array('.', '..', '.DS_Store', 'images');
		
		// Create array of filenames
		$files = array_diff(scandir($dir), $skip);
		
		natsort($files);
		return array_reverse($files, false);
	}

}
