<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class App {

	/**
	 * Set up the application
	 * Routes the request and loads the appropriate template.
	 */
	function __construct() {
		$rewritebase = Settings::get('rewritebase');
		$request_uri = $_SERVER['REQUEST_URI'];
		
		// The requested path
		$request = rtrim(str_replace($rewritebase, '', $request_uri), '/');
		
		$files = new Files();
		
		// Direct the request
		if (empty($request)) {
			$this->write_page($content, 'index');
		}
		else {
			$content_dir = Settings::get('content_dir');
			$extension   = Settings::get('post_extension');
			
			$filepath = $content_dir . '/' . $request . $extension;
			
			if (file_exists($filepath)) {
				$content = array(
					new Post($filepath)
				);
				
				$this->write_page($content, 'single');
			}
			else {
				header('HTTP/1.0 404 Not Found');
			}
		}
	}
	
	
	
	/**
	 * Generate and display the page
	 *
	 * @param array $post_data The posts content array
	 * @param string $template_name The name of the template file to load
	 */
	private function write_page($post_data, $template_name) {
		$template = new Template($template_name);
		
		// Create the posts content array
		$template->content = array(
			'posts' => $this->posts_array_for_template($post_data)
		);
		
		// Get the HTML output
		$output_html = $template->outputHTML();
		
		// Display the page
		//echo $output_html;
		
		echo '<pre>';
		print_r(Settings::get());
		print_r($post_data);
		print_r($template);
		echo '</pre>';
	}
	
	
	
	/**
	 * Get a formatted array of post data
	 *
	 * @param array $posts An array of post objects
	 * return array A formatted array of post content arrays
	 */
	private function posts_array_for_template($posts) {
		$posts_array = array();
		
		foreach ($posts as $post) {
			$posts_array[] = array(
				'title'     => $post->encode_string($post->title),
				'body'      => $post->rendered_body(),
				'permalink' => Settings::get('base_uri') . $post->slug,
				'timestamp' => $post->timestamp,
				'headers'   => $post->headers
			);
		}
		
		return $posts_array;
	}

}
