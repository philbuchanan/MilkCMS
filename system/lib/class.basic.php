<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class Basic {

	/**
	 * Hold settings object
	 */
	protected $settings;
	
	
	
	/**
	 * Hold settings object
	 */
	protected $files;
	
	
	
	/**
	 * Set up some basics
	 */
	function __construct() {
		$this->settings = new Settings();
		
		$this->set_defaults();
		
		$this->files = new Files($this->settings->get('root.content'));
	}
	
	
	
	/**
	 * Set the defualt settings
	 */
	private function set_defaults() {
		global $root;
		
		$this->settings->set(array(
			'version'       => '1.0',
			'root'          => $root,
			'root.system'   => $root . '/system',
			'root.site'     => $root . '/site',
			'root.config'   => $root . '/site/config',
			'root.template' => $root . '/site/template',
			'root.content'  => $root . '/content',
			'rewritebase'   => '/projects/milkcms/'
		));
		
		$this->settings->load_config();
	}

}
