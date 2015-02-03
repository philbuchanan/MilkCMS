<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class Files {

	/**
	 * Returns an array or files in the specified directory and subdirectories
	 * Array is in reverse chronological order.
	 *
	 * @param string $dir The directory to load
	 * @param int $limit
	 * return array
	 */
	public static function file_list($dir = null, $limit = 0) {
		$out = array();
		
		// Set the default direcotry if none is specified
		if (!$dir) {
			$dir = Settings::get('content_dir');
		}
		
		// Files and directories to skip
		$skip = array('.', '..', '.DS_Store', 'images');
		
		if (is_dir($dir)) {
			$files = array_diff(scandir($dir, SCANDIR_SORT_DESCENDING), $skip);
			
			foreach ($files as $file) {
				// have we reached the limit?
				if ($limit && count($out) >= $limit) {
					break;
				}
				
				$full_path = "$dir/$file";
				
				// If file is a driectory, get its file contents
				if (is_dir($full_path)) {
					$out = array_merge($out, self::file_list($full_path, $limit - count($out)));
				}
				else {
					$out[] = "$dir/$file";
				}
			}
		}
		
		return $out;
	}
	
	
	
	/**
	 * Get paged file list
	 *
	 * @param int $page_number
	 * return array
	 */
	public static function paged_file_list($page_number) {
		$posts_per_page = Settings::get('posts_per_page');
		
		$start = $page_number > 1 ? (($page_number - 1) * $posts_per_page) : 0;
		
		$file_paths = self::file_list(null, $start + $posts_per_page);
		
		return array_slice($file_paths, $start);
	}
	
	
	
	
	/**
	 * Get file list for specific year and month
	 * Year and month must be pased as strings. Year should be 4 characters and
	 * month should be 2 (with leading zeros).
	 *
	 * @param string $year YYYY
	 * @param string $month MM
	 * return array File list array
	 */
	public static function posts_in_year_month($year, $month) {
		$content_dir = Settings::get('content_dir');
		
		return self::file_list("$content_dir/$year/$month");
	}
	
	
	
	/**
	 * Find a files full path based on year, month and slug
	 * File names should NOT start with a number! This function will remove the
	 * initial number from the slug. Year and month must be pased as strings.
	 * Year should be 4 characters and month should be 2 (with leading zeros).
	 *
	 * @param string $year
	 * @param string $month
	 * @param string $slug
	 * return string|false Returns the file path, or false if no file exists
	 */
	public static function post_path($year, $month, $slug) {
		if (preg_match('/\d+\-/', $slug)) {
			return false;
		}
		
		$files = self::posts_in_year_month($year, $month);
		
		$file_path = false;
		
		foreach ($files as $file) {
			$pos = strpos($file, $slug . Settings::get('post_extension'));
			
			if ($pos !== false) {
				$file_path = $file;
			}
		}
		
		return $file_path;
	}

}
