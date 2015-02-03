<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

Settings::set(array(

	/**
	 * Rewrite base
	 * This should match the rewrite base set in the .htaccess file
	 */
	'rewritebase' => '/',
	
	
	
	/**
	 * Site title
	 */
	'site_title' => 'Milk CMS',
	
	
	
	/**
	 * Site description
	 */
	'site_description' => 'A lightweight file based CMS for writing.',
	
	
	
	/**
	 * Number of posts to display on the index page
	 */
	'posts_per_page' => 10,
	
	
	
	/**
	 * Post file extension
	 * Uncomment the following line to change the post file extension from the
	 * default (.txt).
	 */
	//Settings::set('post_extension', '.md'),

));