<?php

if (!defined('ACCESS')) die('Direct access is not allowed');



# Stie Rewrite Base
# This should be the same as in your .htaccess file.
c::set('rewritebase', '/');

# Site Title
# The title of the site. Displays in the title bar of your browser.
c::set('title', 'Site Title');

# Display Settings
# The number of articles to show on each index page.
c::set('articlesperpage', 10);

# Cache Expire Settings
# How long a cached file should be valid for.
c::set('cacheexpire', 24); # Hours

?>