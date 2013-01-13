<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

# APP CONFIG FILE
$root = c::get('root');





# Stie Rewrite Base
# This should be the same as in your .htaccess file.
c::set('rewritebase', '/milkcmsdev/');

# Site Title
# The title of the site. Displays in the title bar of your browser.
c::set('title', 'Site Title');

# Display Settings
# The number of articles to show on each index page.
c::set('articlesperpage', 10);

?>