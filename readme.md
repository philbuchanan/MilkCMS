# Milk CMS

A lightweight file based CMS for writing.

Milk CMS is a simple CMS for building single level websites (article listing page and single article page).

Features:

- No database required
- No menus, widgets or plugins
- Simple previous and next pagination
- Markdown integration for simple writing
- Caching of article pages

## Requirements

The current the requirements of Milk CMS are:

- PHP v5.2+
- Apache server
- mod_rewrite module enabled

## Installation

Installing Milk CMS couldn't be easier.

1. Put the content, site and system folders and the index.php, and .htaccess files in the root of your server.
2. Change your site title in site/config/config.php.
3. Place your text files in the content folder, numbered in order.

## Advanced Options

### Install in a sub directory

To install Milk CMS in a sub directory you will need to set the rewrite base to this new director. This needs to be done in two places: the .htaccess file and in the site/config/config.php file.

### Turn caching on

To turn caching on simple set the desired amount of time a cached file should be valid for (in hours) in the site/config/config.php file. Milk CMS will create a cache folder for you the next time an article is accessed on your site.

### Set number of articles to display per page

You can set the number of articles you want to display on a page in the site/config/config.php file.

## How to Format Article Files

The fields used in your article files are entirely up to you, however the specific format of the document is critical. Each field must be separated by four hyphens (----) on its own line. The title of the field should be in snake_case followed by a colon. You may use capitals, but note that Milk CMS will lowercase your field titles for template usage. Here is an example field:

    Title: The Title of the Article
    ----

## Accessing Fields in Templates

Accessing your fields in templates is very easy. In both archive and article templates simply use:

    <?php echo $article['title']; ?>

Milk CMS will only create/reserve one field title, that being *permalink*. A permalink will be automatically generate for each article based on its file name. To access this permalink use:

    <?php echo $article['permalink']; ?>

### The Loop

Milk CMS uses a simple loop in order to iterate through the articles on the archive template. The loop looks like this:

    <?php foreach ($articles as $article) {
        // Your article code
    } ?>

## Other Template Stuff

### Pagination

You can get the previous and next page links using:

    <?php echo pagination::get('prev'); ?>

and

    <?php echo pagination::get('next'); ?>

You can use an if statement to check if the url exists and conditionally show the buttons (if you're on the first of last page).

    <?php if (pagination::get('prev')) {} ?>

### Site Title

You can get the site title using:

    <?php echo c::get('title'); ?>

### Base URL

You can get the base URL for the site using:

    <?php echo c::get('home'); ?>

This can be used for linking to stylesheets:

    <link rel="stylesheet" href="<?php echo c::get('home'); ?>site/templates/style.css" type="text/css" media="screen" />

Or linking to the homepage:

    <a href="<?php echo c::get('home'); ?>" />Home</a>

### Version Number

Echo current version number of Milk CMS:

    <?php echo c::get('version'); ?>

### All Settings

Print all site settings:

    <?php
    echo '<pre>';
    print_r(c::get());
    echo '</pre>';
    ?>