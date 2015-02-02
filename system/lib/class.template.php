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
