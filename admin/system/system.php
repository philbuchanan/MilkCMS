<?php

if (!isset($root)) die('Direct access is not allowed');
define('ACCESS', true);

# Load helpers
require_once($root . '/system/lib/helper.php');

# Set system config
c::set('version', '0.1');
c::set('root',        $root);
c::set('root.system', $root . '/system');
c::set('root.site',   $root . '/site');
c::set('root.content',$root . '/../content');
c::set('server_name', $_SERVER['SERVER_NAME']);
c::set('domain',      'http://' . $_SERVER['HTTP_HOST']);
c::set('rewritebase', '/admin/');

# Load site config
c::load(c::get('root.site') . '/config/config.php');
c::load(c::get('root.site') . '/config/config.' . c::get('server_name') . '.php');

# Set home url
c::set('home', c::get('domain') . c::get('rewritebase'));

# System checks
if (floatval(phpversion()) < 5.3) die('Please upgrade to PHP 5.3 or higher');
if (!is_dir(c::get('root.site'))) die('The site directory could not be found');

# Load system classes
require_once(c::get('root.system') . '/lib/load.php');
load::lib();

# Load app
app::initiate();

?>