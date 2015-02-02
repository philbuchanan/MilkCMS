<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class App {

	/**
	 * The currently requested URL
	 */
	private $url;
	
	
	
	/**
	 * The current page template
	 */
	private $template_name = 'index';
	
	
	
	/**
	 * Set up the application
	 */
	function __construct() {
		// Get the requested URL
		$this->url = $this->get_requested_url();
		
		$articles = array(
			new Article(Settings::get('root.content') . '/2015/01/welcome.txt')
		);
		
		$this->write_page($articles);
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
	
	
	
	/**
	 * Generate and display the page
	 */
	private function write_page($articles) {
		$template = new Template($this->template_name);
		
		// Is this a single article page?
		$template->is_single = (count($articles) == 1) ? true : false;
		
		// Create the articles content array
		foreach ($articles as $article) {
			$template->articles[] = array(
				'title'     => html_entity_decode(SmartyPants($article->title), ENT_QUOTES, 'UTF-8'),
				'body'      => $article->rendered_body(),
				'permalink' => Settings::get('base_uri') . '/' . $article->slug,
				'timestamp' => $article->timestamp
			);
		}
		
		// Get the HTML output
		$output_html = $template->outputHTML();
		
		// Display the page
		echo $output_html;
	}

}
