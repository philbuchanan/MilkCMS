<?php

if (!isset($root)) die('Direct access is not allowed');



// Define access
define('ACCESS', true);



// System checks
if (version_compare(phpversion(), '5.4', '<')) {
	die('Please upgrade to PHP 5.4 or higher');
}



// Load settings class
require_once($root . '/system/lib/class.settings.php');

// Set default settings
Settings::set(array(
	'version'        => '1.0',
	'root'           => $root,
	'system_dir'     => $root . '/system',
	'site_dir'       => $root . '/site',
	'config_dir'     => $root . '/site/config',
	'template_dir'   => $root . '/site/template',
	'content_dir'    => $root . '/content',
	'domain'         => 'http://' . $_SERVER['HTTP_HOST'],
	'rewritebase'    => '/',
	'post_extension' => '.txt'
));

// Load config files
Settings::load_configs();

// Set the base URI
Settings::set('base_uri', Settings::get('domain') . Settings::get('rewritebase'));



// Load system classes
require_once($root . '/system/lib/class.app.php');
require_once($root . '/system/lib/class.post.php');
require_once($root . '/system/lib/class.template.php');

// Load parsers
require_once($root . '/system/parsers/markdown.php');
require_once($root . '/system/parsers/smartypants.php');



// Load application
new App();
