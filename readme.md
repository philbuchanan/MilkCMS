# Milk CMS

A lightweight file based CMS for writing.

Milk CMS is a simple CMS for building single level websites (post listing page and single post pages).

Features:

- No database required
- No menus, widgets or plugins
- Simple previous and next pagination
- Markdown integration for simple writing

## Requirements

The current requirements of Milk CMS are:

- PHP v5.4+
- Apache server
- mod_rewrite module enabled

## Installation

Installing Milk CMS couldn't be easier.

1. Put the content, site, and system, index.php, and .htaccess files and folders in the root of your server.
2. Change your site title and description in site/config/config.php.
3. Place your text files in the content folder.

## Posts

### How to Format Post Files

The fields used in your post files are entirely up to you, however the specific format of the document is critical. Each post must start with the title on line 1. The second line of the text document must include any number of "=" characters.

Here is an example file:

    The Title of the Post
    =====================
    Date: 2015/01/01 12:00:00pm
    Field: Value
    
    This is the post body!

Save your .txt files in the content folder, organized into year and month folders. The year should be 4 digits and the month should be 2 digits (with leading zeros). For example, posts plblished in January 2015 should look like this: `/content/2015/01/`.

The text files should be numbered in the reverse cronological order. The first post published in the month should be `1-` followed by the URL slug you want for the post. Make sure to only use lowercase letters and hyphens in your file names. Do not use periods. Also don't use numbers at the beginning of the file name.

Here are a few examples of some filenames:

    // Good
    1-welcome.txt
    2-this-and-that.txt
    3-ten-things-you-should-know.txt
    4-welcome-to-my-1st-blog-post.txt
    
    // Bad
    welcome.txt                       // You should number your posts
    2-this&that.txt                   // Don't use special characters
    3-10-things-you-should-know.txt   // Don't start your slugs with numbers
    4-welcome to my 1st.blog.post.txt // Don't use periods or spaces in file names

## Templates

You can create your own template for your site by modifiying the existing tempate found in /site/template/.

### Content

All content output by the CMS is stored in the `$content` array.

To see all the content stored in the `$content` array:

    <?php var_dump($content); ?>

To accesses a specific item within the `$content` array:

    <?php echo $content['site_title']; // Will echo the site title ?>

#### Loop

All the posts data for a particular template are stored in the `$content['posts']` array.

Milk CMS uses a simple loop in order to iterate through the posts. The loop looks like this:

    <?php foreach ($content['posts'] as $post) :
        // Your post code
    endforeach; ?>

From inside the loop, you can access specific post data items by using this syntax:

    <?php echo $post['title']; // Will echo the post title ?>
    <?php echo $post['permalink']; // Will echo the post permalink ?>
    <?php echo $post['body']; // Will echo the post body HTML ?>

The publish date of the post is stored as a Unix timestamp. You can use the PHP `date()` function to display the date however you'd like:

    <?php echo date('l, F j, Y', $post['timestamp']); // Will display as "Thursday, January 1, 2015" ?>
