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
			
			$this->write_page('index', $posts);
		}
		else if (strstr($request, 'page=')) {
			// Paged
			$page_number = intval(str_replace('page=', '', $request));
			$posts_per_page = Settings::get('posts_per_page');
			
			$start = $page_number > 1 ? (($page_number - 1) * $posts_per_page) : 0;
			$end   = $start + $posts_per_page;
			
			$all_files = Files::file_list();
			
			// Fill the posts array with post objects
			$file_paths = array_slice($all_files, $start, $posts_per_page);
			foreach ($file_paths as $file_path) {
				$posts[] = new Post($file_path);
			}
			
			// Set up additional content array for pagination
			$page_link = Settings::get('base_uri') . 'page=';
			
			$next_page_number = $end < count($all_files) ? $page_number + 1 : '';
			$prev_page_number = $page_number > 1 ? $page_number - 1 : '';
			
			if ($prev_page_number) {
				$pagination['prev_page'] = $page_link . $prev_page_number;
			}
			
			if ($next_page_number) {
				$pagination['next_page'] = $page_link . $next_page_number;
			}
			
			$content = array(
				'pagination' => $pagination
			);
			
			$this->write_page('index', $posts, $content);
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
				
				$this->write_page('single', $posts);
			}
			else {
				header('HTTP/1.0 404 Not Found');
			}
		}
	}
	
	
	
	/**
	 * Generate and display the post index and single post pages
	 *
	 * @param string $template_name The name of the template file to load
	 * @param array $post_data An array of post objects
	 * @param array $content Additional template content
	 */
	private function write_page($template_name, $post_data, $content = array()) {
		$t = new Template($template_name);
		
		// Create the posts content array
		$t->content['posts'] = $t->posts_array_for_template($post_data);
		
		// Add additional template content
		$t->content = array_merge($t->content, $content);
		
		// Get the HTML output
		$output_html = $t->outputHTML();
		
		// Display the page
		//echo $output_html;
		
		echo '<pre>';
		//print_r(Settings::get());
		//print_r($post_data);
		//print_r($content);
		print_r($t);
		echo '</pre>';
	}

}
