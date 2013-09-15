<?php
function roots_setup()
{

    // tell the TinyMCE editor to use editor-style.css
    // if you have issues with getting the editor to show your changes then use the following line:
    // add_editor_style('editor-style.css?' . time());
    add_editor_style('editor-style.css');

    // http://codex.wordpress.org/Post_Thumbnails
    add_theme_support('post-thumbnails');
    // set_post_thumbnail_size(150, 150, false);

    // http://codex.wordpress.org/Post_Formats
    // add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));

    // http://codex.wordpress.org/Function_Reference/add_custom_image_header
    if (!defined('HEADER_TEXTCOLOR')) {
        define('HEADER_TEXTCOLOR', '');
    }
    if (!defined('NO_HEADER_TEXT')) {
        define('NO_HEADER_TEXT', true);
    }
    if (!defined('HEADER_IMAGE')) {
        define('HEADER_IMAGE', get_template_directory_uri() . '/img/logo.png');
    }
    if (!defined('HEADER_IMAGE_WIDTH')) {
        define('HEADER_IMAGE_WIDTH', 123);
    }
    if (!defined('HEADER_IMAGE_HEIGHT')) {
        define('HEADER_IMAGE_HEIGHT', 49);
    }

    global $FRONTEND_STRINGS;
    add_theme_support('menus');
    register_nav_menus(array(
                            'primary_navigation' => $FRONTEND_STRINGS['primary_nav'],
                            'tablet_navigation' => $FRONTEND_STRINGS['tablet_nav'],
                            'tablet_navigation_landscape' => $FRONTEND_STRINGS['tablet_nav_landscape'],
                            'mobile_navigation' => $FRONTEND_STRINGS['mobile_nav']
                       ));

    add_theme_support( 'automatic-feed-links' );
}

add_action('after_setup_theme', 'roots_setup');

/**
 * Register default roots sidebars.
 * Hook into 'widgets_init' function with a lower priority in your child
 * theme to remove these sidebars.
 */
function roots_register_sidebars()
{
    global $FRONTEND_STRINGS;
    register_sidebar(
        array(
             'id' => 'roots-sidebar',
             'name' => $FRONTEND_STRINGS['sidebar'],
             'description' => $FRONTEND_STRINGS['sidebar'],
             'before_widget' => '<article id="%1$s" class="widget %2$s"><div class="container sidebar-widget">',
             'after_widget' => '</div></article>',
             'before_title' => '<h3>',
             'after_title' => '</h3>'
        ));
    register_sidebar(
        array(
             'id' => 'roots-footer',
             'name' => $FRONTEND_STRINGS['footer_0'],
             'description' => $FRONTEND_STRINGS['footer'],
             'before_widget' => '<div class="divider"></div><article id="%1$s" class="widget %2$s"><div class="container">',
             'after_widget' => '</div></article>',
             'before_title' => '<h3>',
             'after_title' => '</h3>'
        ));
    register_sidebar(
        array(
             'id' => 'roots-footer-1',
             'name' => $FRONTEND_STRINGS['footer_1'],
             'description' => $FRONTEND_STRINGS['footer'],
             'before_widget' => '<div class="divider"></div><article id="%1$s" class="widget %2$s"><div class="container">',
             'after_widget' => '</div></article>',
             'before_title' => '<h3>',
             'after_title' => '</h3>'
        ));
    register_sidebar(
        array(
             'id' => 'roots-footer-2',
             'name' => $FRONTEND_STRINGS['footer_2'],
             'description' => $FRONTEND_STRINGS['footer'],
             'before_widget' => '<div class="divider"></div><article id="%1$s" class="widget %2$s"><div class="container">',
             'after_widget' => '</div></article>',
             'before_title' => '<h3>',
             'after_title' => '</h3>'
        ));
}

add_action('widgets_init', 'roots_register_sidebars');

// return post entry meta information
function roots_entry_meta()
{
    global $FRONTEND_STRINGS;
    echo '<time class="updated" datetime="' . get_the_time('c') . '" pubdate>' . sprintf($FRONTEND_STRINGS['posted_on'], get_the_time('l, F jS, Y'), get_the_time()) . '</time>';
    echo '<p class="byline author vcard">' . $FRONTEND_STRINGS['written_by'] . ' <a href="' . get_author_posts_url(get_the_author_meta('id')) . '" rel="author" class="fn">' . get_the_author() . '</a></p>';
}

?>