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
		$request_parts = explode('/', $request);
		
		// Direct the request
		if (empty($request)) {
			// Index listing
			$posts_per_page = Settings::get('posts_per_page');
			
			foreach (Files::file_list(null, $posts_per_page) as $file_path) {
				$posts[] = new Post($file_path);
			}
			
			$this->write_page($posts, 'index');
		}
		else if (strstr($request, 'page=')) {
			// Paged
			$page_number = intval(str_replace('page=', '', $request));
			
			foreach (Files::paged_file_list($page_number) as $file_path) {
				$posts[] = new Post($file_path);
			}
			
			$this->write_page($posts, 'index');
		}
		else {
			// Single post
			$year  = $request_parts[0];
			$month = $request_parts[1];
			$slug  = $request_parts[2];
			
			$file_path = Files::post_path($year, $month, $slug);
			
			if ($file_path) {
				$posts = array(
					new Post($file_path)
				);
				
				$this->write_page($posts, 'single');
			}
			else {
				header('HTTP/1.0 404 Not Found');
			}
		}
	}
	
	
	
	/**
	 * Generate and display the post index and single post pages
	 *
	 * @param array $post_data The posts content array
	 * @param string $template_name The name of the template file to load
	 */
	private function write_page($post_data, $template_name) {
		$template = new Template($template_name);
		
		// Create the posts content array
		$template->content = array(
			'posts' => $template->posts_array_for_template($post_data)
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

}
