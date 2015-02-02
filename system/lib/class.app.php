<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class App {

	/**
	 * The currently requested URL
	 */
	private $url;
	
	
	
	/**
	 * Set up the application
	 */
	function __construct() {
		
		// Get the requested URL
		$this->url = $this->get_requested_url();
		
		$article = new Article(Settings::get('root.content') . '/2015/01/welcome.txt');
		
		echo '<pre>';
		print_r($article);
		echo '</pre>';
		
		// Set up the template
		//$template = new Template($this->url);
		
		// Get the array of articles for the loop
		//$articles = $this->files->get_articles();
		
		// Last step is to load the template
		//require_once($template->path);
	}
	
	
	
	/**
	 * Parse URL request
	 *
	 * return array The requested path and template object
	 */
	private function get_requested_url() {
		$rewritebase = Settings::get('rewritebase');
		$request_uri = $_SERVER['REQUEST_URI'];
		
		return str_replace($rewritebase, '', $request_uri);
	}

}
