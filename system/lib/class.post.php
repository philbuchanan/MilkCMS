<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class Post {

	private $source_filename;
	
	public $title = '';
	public $slug = '';
	public $meta = array();
	public $body = '';
	
	public $timestamp;
	public $year;
	public $month;
	public $day;
	
	
	
	/**
	 * Set up the post
	 * Loads the file content for a given source filename.
	 *
	 * @param string $source_filename
	 */
	function __construct($source_filename) {
		$this->source_filename = $source_filename;
		
		// Set the slug based on the filename
		$filename = basename($source_filename);
		$filename_parts = explode('.', $filename);
		$this->slug = $filename_parts[0];
		
		// Get file content parts
		$segments = explode("\n\n", trim(file_get_contents($source_filename)), 2);
		$meta     = explode("\n", $segments[0]);
		
		// Set the post title
		$this->title = $meta[0];
		
		// Parse the post meta
		foreach ($meta as $item) {
			$fields = explode(':', $item, 2);
			
			if (count($fields) > 1) {
				$field_name  = strtolower($fields[0]);
				$field_value = trim($fields[1]);
				
				$this->meta[$field_name] = $field_value;
			}
		}
		array_shift($segments);
		
		// Set the post body
		$this->body = isset($segments[0]) ? $segments[0] : '';
		
		// Set post publish date
		if (array_key_exists('date', $this->meta)) {
			$date = $this->meta['date'];
			
			// Remove the date from the meta array
			// Date should always use the timestamp for display
			unset($this->meta['date']);
			
			$this->timestamp = date('U', strtotime($date));
			
			$this->year  = intval(date('Y', $this->timestamp));
			$this->month = intval(date('m', $this->timestamp));
			$this->day   = intval(date('d', $this->timestamp));
		}
	}
	
	
	
	/**
	 * Run the post body through Markdown and SmartyPants parsers
	 *
	 * return string
	 */
	public function rendered_body() {
		return SmartyPants(Markdown($this->body));
	}
	
	
	
	/**
	 * Encode HTML entities for a given string
	 * Also runs SmartyPants on string
	 *
	 * @param string $string
	 * return string
	 */
	public function encode_string($string) {
		return html_entity_decode(SmartyPants($string), ENT_QUOTES, 'UTF-8');
	}

}
