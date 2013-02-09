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

- PHP v5.3+
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

## Admin Panel

MilkCMS also has a simple admin panel for handling simple CMS tasks. The panel is installed by default. If you would prefer not to use it, simply delete the 'admin' folder.

Admin panel features:

- upload new articles
- upload supporting images
- empty cache folders
- delete articles

### Admin Panel Setup

Setting up the admin panel is easy. For a basic install, simply edit the default admin user account located in admin/site/accounts/admin.php file. If you are changing the username, make sure the file name and username match. So for admin.php, your file should look like:

    username: admin
    password: hashedpassword
    salt: ###

Be sure to change the password to something of your own choosing. Never leave the password field blank or you site might be easily compromised.

### Adding Accounts

To add additional user accounts simply add new account files to the admin/site/accounts/ folder. Each new account username should match the filename. So if the desired username is 'jdoe', the account filename should be 'jdoe.php'.

Be sure to change the password to something of your own choosing. Never leave the password field blank or you site might be easily compromised.

### Install in a sub directory

If you have chosen to install MilkCMS in a sub directory make sure to change the rewrite base in the admin panel config file as well (admin/site/config/config.php). For example, if you installed MilkCMS in a folder called 'milk', change the admin panel rewrite base to '/milk/admin/'.

## Articles

### How to Format Article Files

The fields used in your article files are entirely up to you, however the specific format of the document is critical. Each field must be separated by four hyphens (----) on its own line. The title of the field should be in snake_case followed by a colon. You may use capitals, but note that Milk CMS will lowercase your field titles for template usage. Here is an example file:

    Title: The Title of the Article
    ----
    Date: 2013/02/01
    ----
    Text:
    
    This is the article!

## Templates

### Accessing Fields in Templates

Accessing your fields in templates is very easy. In both archive and article templates simply use:

    <?php $article -> get('field_name'); ?>

By default, the field will be echoed. If you want to use the field for something else (like checking if the field exists or is empty), you can have the function simply return the value by passing false as the second parameter:

    <?php if ($article -> get('field_name', false)) {
        // Do something
    } ?>

Milk CMS will only create/reserve one field title, that being *permalink*. A permalink will be automatically generated for each article based on its file name. To access this permalink use:

    <?php $article -> get('permalink'); ?>

### The Loop

Milk CMS uses a simple loop in order to iterate through the articles on the archive template. The loop looks like this:

    <?php foreach ($articles as $article) :
        // Your article code
    endforeach; ?>

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

    <link rel="stylesheet" href="<?php echo c::get('home'); ?>assets/styles/style.css" type="text/css" media="screen" />

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