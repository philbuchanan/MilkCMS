<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class Files extends Basic {

	/**
	 * Holds the directory string
	 */
	private $directory = '';
	
	
	
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
	function __construct($dir = null) {
		parent::__construct();
		
		if (!$dir || !is_dir($dir)) {
			$this->directory = $this->settings->get('root.content');
		}
		else {
			$this->directory = $dir;
		}
		
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
	private function list_dir($dir = null) {
		// If no directory is set, use default directory
		if (!$dir) {
			$dir = $this->directory;
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
	 * Get a list of articles
	 *
	 * @param int $count The number of articles to return
	 * @param int $start Where to start the count
	 *
	 * return array An array of article objects
	 */
	public function get_articles($count = 10, $start = 0) {
		if ($count > $this->count) {
			$count = $this->count;
		}
		
		if ($start < $count && ($start + $count) > $this->count) {
			$i = $start;
		}
		else {
			$i = 0;
		}
		
		while ($i < $count) {
			$file = $this->directory . '/' . $this->files_list[$i];
			
			$articles[] = new Article(array(
				'file'     => $this->files_list[$i],
				'modified' => filectime($file),
				'content'  => $this->get_file_contents($file)
			));
			
			$i++;
		}
		
		if (isset($articles) && count($articles)) {
			return $articles;
		}
		else {
			return false;
		}
	}
	
	
	
	/**
	 * Returns a files contents
	 *
	 * @param string $path The file path
	 *
	 * return string The file contents as a string, else false
	 */
	private function get_file_contents($path) {
		// If no file path is set or file doesn't exist, return early
		if (!$path || !file_exists($path)) {
			return false;
		}
		
		return file_get_contents($path);
	}

}
