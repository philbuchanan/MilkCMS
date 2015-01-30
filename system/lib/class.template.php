<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class Template extends Basic {

	/**
	 * Holds the template name
	 */
	private $template;
	
	
	
	/**
	 * Holds the template file path
	 */
	public $path;
	
	
	
	/**
	 * Set up the template
	 * Sets up the template object based on the current requested URL.
	 *
	 * @param string $url The cureent requested URL
	 */
	function __construct($url) {
		parent::__construct();
		
		if (empty($url)) {
			$this->set('index');
		}
		else {
			$this->set('article');
		}
	}
	
	
	
	/**
	 * Set the template
	 *
	 * @param string $template The template name to load
	 *
	 * return void
	 */
	private function set($template = 'index') {
		$path = $this->get_path($template);
		
		if (!is_file($path)) {
			die('Template file could not be found');
		}
		
		$this->template = $template;
		$this->path     = $path;
	}
	
	
	
	/**
	 * Get template file path
	 *
	 * @param string $template The name of the template to retrieve
	 *
	 * return string The path of the template
	 */
	private function get_path($template) {
		return $this->settings->get('root.template') . "/$template.php";
	}

}
