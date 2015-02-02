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
	'version'       => '1.0',
	'root'          => $root,
	'root.system'   => $root . '/system',
	'root.site'     => $root . '/site',
	'root.config'   => $root . '/site/config',
	'root.template' => $root . '/site/template',
	'root.content'  => $root . '/content',
	'rewritebase'   => '/'
));

// Load config files
Settings::load_configs();

// Set the base uri
Settings::set('base_uri', Settings::get('rewritebase'));



// Load system classes
require_once($root . '/system/lib/class.app.php');
require_once($root . '/system/lib/class.article.php');
require_once($root . '/system/lib/class.template.php');

// Load parsers
require_once($root . '/system/parsers/markdown.php');
require_once($root . '/system/parsers/smartypants.php');



// Load application
new App();
