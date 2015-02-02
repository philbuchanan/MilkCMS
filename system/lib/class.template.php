<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class Template {

	private $template_path;
	
	public $template_name = 'index';
	public $is_single = false;
	
	public $articles = array();
	
	
	
	/**
	 * Sets up the template
	 *
	 * @param string $template_name The name of the template file
	 */
	function __construct($template_name) {
		$this->template_name = $template_name;
		
		$path = Settings::get('root.template') . "/$template_name.php";
		
		if (!is_file($path)) {
			die('Template file could not be found');
		}
		
		$this->template_path = $path;
	}
	
	
	
	/**
	 * Output the template HTML
	 */
	public function outputHTML() {
		ob_start();
		$articles = $this->articles;
		include($this->template_path);
		$contents = ob_get_contents();
		ob_end_clean();
		
		return $contents;
	}
}
