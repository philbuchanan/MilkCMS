<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

global $settings;

// Rewrite base should match .htaccess file
$settings->set('rewritebase', '/');
