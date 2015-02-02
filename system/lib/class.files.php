<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class Files {

	public $files_list = array();
	
	
	
	function __construct() {
		$this->get_files_list(Settings::get('content_dir'));
		
		echo '<pre>';
		print_r($this->files_list);
		echo '</pre>';
	}
	
	
	
	/**
	 * Add all files in a directory and subdirectories to the $files_list array
	 *
	 * @param string $dir The directory to load
	 * @param int $count The min number of files to retrieve
	 * return void
	 */
	private function get_files_list($dir) {
		$skip = array('.', '..', '.DS_Store', 'images');
		
		$files = array_diff(scandir($dir, SCANDIR_SORT_DESCENDING), $skip);
		
		foreach ($files as $file) {
			if (is_dir($dir . '/' . $file)) {
				$this->get_files_list($dir . '/' . $file);
			}
			else {
				$this->files_list[] = $dir . '/' . $file;
			}
		}
	}

}
