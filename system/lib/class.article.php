<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class Article extends Basic {

	/**
	 * Holds the articles filename
	 */
	private $filename;
	
	
	
	/**
	 * Holds the article files raw (unparsed) content
	 */
	private $file_content;
	
	
	
	/**
	 * The articles data array
	 * All data in this array will be accessible in the templates
	 */
	private $data = array();
	
	
	
	/**
	 * Set up the article
	 *
	 * @param string $filename The name of the file
	 * @param string $file_content The raw file content
	 */
	function __construct($filename, $file_content) {
		parent::__construct();
		
		$this->filename = $filename;
		$this->file_content = $file_content;
		
		$this->set_permalink();
		$this->set_data();
		$this->set_date();
	}
	
	
	
	/**
	 * Get an article value by key
	 *
	 * @param string $key The article key to retrieve
	 * @param bool $echo Whether to echo the value
	 *
	 * return bool|string
	 */
	public function get($key, $echo = true) {
		$key = strtolower($key);
		
		// If no key is set, return early
		if (!array_key_exists($key, $this->data)) {
			return false;
		}
		
		if ($echo) {
			echo $this->data[$key];
		}
		else {
			return $this->data[$key];
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
			$this->data = array_merge($this->data, $key);
		}
		else {
			$this->data[$key] = $value;
		}
	}
	
	
	
	/**
	 * Set the articles permalink based on filename
	 *
	 * return void
	 */
	private function set_permalink() {
		$parts = explode('.', $this->filename);
		$permalink = preg_replace('/^\d+\-/', '', $parts[0]);
		
		// Add the rewrite base to the permalink (root relative URL)
		$url = $this->settings->get('rewritebase') . $permalink;
		
		$this->set('permalink', $url);
	}
	
	
	
	/**
	 * Setup the articles data array based on file contents
	 *
	 * return void
	 */
	private function set_data() {
		$data = explode('----', $this->file_content);
		
		foreach ($data as $items) {
			$details = explode(':', $items, 2);
			
			$key   = trim(strtolower($details[0]));
			$value = trim($details[1]);
			
			$this->set($key, $value);
		}
	}
	
	
	
	/**
	 * Formats the article date based on config file setting
	 *
	 * return void
	 */
	private function set_date() {
		$article_date = $this->get('date', false);
		
		if ($article_date) {
			$this->set('date', strtotime($article_date));
		}
	}

}
