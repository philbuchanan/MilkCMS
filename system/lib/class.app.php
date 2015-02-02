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
		
		$posts = array(
			new Post(Settings::get('root.content') . '/2015/01/welcome.txt')
		);
		
		$this->write_page($posts);
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
	private function write_page($posts) {
		$template = new Template($this->template_name);
		
		// Is this a single post page?
		$template->is_single = (count($posts) == 1) ? true : false;
		
		// Create the posts content array
		foreach ($posts as $post) {
			$template->posts[] = array(
				'title'     => html_entity_decode(SmartyPants($post->title), ENT_QUOTES, 'UTF-8'),
				'body'      => $post->rendered_body(),
				'permalink' => Settings::get('base_uri') . '/' . $post->slug,
				'timestamp' => $post->timestamp
			);
		}
		
		// Get the HTML output
		$output_html = $template->outputHTML();
		
		// Display the page
		//echo $output_html;
		
		echo '<pre>';
		print_r($template);
		echo '</pre>';
	}

}
