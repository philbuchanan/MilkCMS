<?php

if (!isset($root)) die('Direct access is not allowed');



// Define access
define('ACCESS', true);



// System checks
if (version_compare(phpversion(), '5.4', '<')) {
	die('Please upgrade to PHP 5.4 or higher');
}



// Load system classes
require_once($root . '/system/lib/class.basic.php');
require_once($root . '/system/lib/class.settings.php');
require_once($root . '/system/lib/class.files.php');
require_once($root . '/system/lib/class.app.php');
require_once($root . '/system/lib/class.template.php');
require_once($root . '/system/lib/class.article.php');



// Load application
new App();
