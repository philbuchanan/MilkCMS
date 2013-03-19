<?php

if (!defined('ACCESS')) die('Direct access is not allowed');



/*
---------------------------------------
Site Rewrite Base
---------------------------------------

This should be the same as in your .htaccess file.

*/

c::set('rewritebase', '/milkcmsdev/');



/*
---------------------------------------
Site Title
---------------------------------------

The title of the site. Displays in the title bar
of your browser.

*/

c::set('title', 'Site Title');



/*
---------------------------------------
Front Page Display
---------------------------------------

Set this to true if you want to display the most
recent article on the homepage instead of the full
archive listing.

You must include an frontpage.php file in your
templates directory to use this option.

*/

c::set('frontasarticle', false);



/*
---------------------------------------
Display Settings
---------------------------------------

The number of articles to show on each index page.

*/

c::set('articlesperpage', 10);



/*
---------------------------------------
Cache Expire Settings
---------------------------------------

How long a cached file should be valid for.

*/

c::set('cacheexpire', 24); # Hours

?>