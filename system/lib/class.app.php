<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class App extends Basic {

	/**
	 * The currently requested URL
	 */
	private $url;
	
	
	
	/**
	 * Holds the files object
	 */
	private $files;
	
	
	
	/**
	 * Set up the application
	 */
	function __construct() {
		parent::__construct();
		
		// Get the requested URL
		$this->url = $this->get_requested_url();
		
		// Set up the template
		$template = new Template($this->url);
		
		$this->files = new Files();
		
		// Get the array of articles for the loop
		$articles = $this->files->get_articles();
		
		// Last step is to load the template
		//require_once($template->path);
	}
	
	
	
	/**
	 * Parse URL request
	 *
	 * return array The requested path and template object
	 */
	private function get_requested_url() {
		$rewritebase = $this->settings->get('rewritebase');
		$request_uri = $_SERVER['REQUEST_URI'];
		
		return str_replace($rewritebase, '', $request_uri);
	}

}
