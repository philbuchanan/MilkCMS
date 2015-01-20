<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class App extends Basic {

	/**
	 * Holds the template object
	 */
	public $template;
	
	
	
	/**
	 * Set up the application
	 */
	function __construct() {
		parent::__construct();
		
		$files = new Files();
		
		$articles = $files->get_articles();
		
		$url = $this->get_requested_url();
		
		$this->template = $this->get_template($url);
		
		echo '<pre>';
		print_r($this->template);
		echo '</pre>';
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
	
	
	
	/**
	 * Get Template
	 * Gets the template object based on the current requested URL.
	 *
	 * @param string $url The cureent requested URL
	 *
	 * return object The template object
	 */
	private function get_template($url) {
		$template = new Template();
		
		if (empty($url)) {
			$template->set('index');
		}
		else {
			$template->set('article');
		}
		
		return $template;
	}

}
