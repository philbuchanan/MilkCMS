<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class Template {

	private $template_path;
	
	public $content = array();
	
	
	
	/**
	 * Sets up the template
	 *
	 * @param string $template_name The name of the template file
	 */
	function __construct($template_name) {
		$path = Settings::get('template_dir') . "/$template_name.php";
		
		// If specific template file doesn't exist, default to index
		if (!is_file($path)) {
			$path = Settings::get('template_dir') . "/index.php";
		}
		
		// If no template can be found, kill app
		if (!is_file($path)) {
			throw new Exception('Template file could not be found');
		}
		
		$this->template_path = $path;
	}
	
	
	
	/**
	 * Get a formatted array of post data
	 *
	 * @param array $posts An array of post objects
	 * return array A formatted array of post content arrays
	 */
	public function posts_array_for_template($posts) {
		$posts_array = array();
		
		foreach ($posts as $post) {
			$posts_array[] = array(
				'title'     => $post->encode_string($post->title),
				'body'      => $post->rendered_body(),
				'permalink' => Settings::get('base_uri') . $post->slug,
				'timestamp' => $post->timestamp,
				'meta'      => $post->meta
			);
		}
		
		return $posts_array;
	}
	
	
	
	/**
	 * Output the template HTML
	 *
	 * return string The rendered template content
	 */
	public function outputHTML() {
		ob_start();
		$content = $this->content;
		include($this->template_path);
		$contents = ob_get_contents();
		ob_end_clean();
		
		return $contents;
	}

}
