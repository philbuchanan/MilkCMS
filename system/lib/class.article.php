<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class Article {

	private $source_filename;
	
	public $title = '';
	public $slug = '';
	public $headers = array();
	public $body = '';
	
	public $timestamp;
	public $year;
	public $month;
	public $day;
	
	
	
	/**
	 * Set up the article
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
		$headers  = explode("\n", $segments[0]);
		
		$this->title = $headers[0];
		
		// Parse the headers
		foreach ($headers as $header) {
			$fields = explode(':', $header, 2);
			
			if (count($fields) > 1) {
				$field_name  = strtolower($fields[0]);
				$field_value = trim($fields[1]);
				
				$this->headers[$field_name] = $field_value;
			}
		}
		
		array_shift($segments);
		
		$this->body = isset($segments[0]) ? $segments[0] : '';
		
		// Set article publish date
		if (array_key_exists('date', $this->headers)) {
			$date = $this->headers['date'];
			
			$this->timestamp = date('U', strtotime($date));
			
			$this->year  = intval(date('Y', $this->timestamp));
			$this->month = intval(date('m', $this->timestamp));
			$this->day   = intval(date('d', $this->timestamp));
		}
	}

}
