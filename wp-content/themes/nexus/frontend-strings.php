<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 10/14/11
 * Time: 10:21 AM
 * To change this template use File | Settings | File Templates.
 */

global $FRONTEND_STRINGS;

$textdomain = 'prime';

$FRONTEND_STRINGS = array(
    /* =============================================
    * COMMON STRINGS
    *==============================================*/
    'optional_title' => __('Title (optional):', $textdomain),
    'limit' => __('Limit: ', $textdomain),
    'url_option' => __('URL: ', $textdomain),
    'text_option' => __('Text: ', $textdomain),
    'size_option' => __('Size: ', $textdomain),
    'width_option' => __('w(px)', $textdomain),
    'height_option' => __('h(px)', $textdomain),
    'size_by_marker' => __(' x ', $textdomain),
    'url_option' => __('URL: ', $textdomain),
    'subtitle' => __('Subtitle', $textdomain),
    'preview_image' => __('Preview Image', $textdomain),
    'bkgd' => __('Background', $textdomain),
    'custom_settings' => __('Custom Settings', $textdomain),
    'no_matching_posts' => __('Sorry, no posts matched your criteria.', $textdomain),
    'edit' => __('Edit', $textdomain),
    'yes' => __('Yes', $textdomain),
    'caption' => __('Caption', $textdomain),
    'with' => __('with', $textdomain),

    'in' => _x('in', 'time in category', $textdomain),
    'read_more' => __('Read more &raquo;', $textdomain),
    'continue_reading' => __('Continue reading &raquo;', $textdomain),
    'posted_in' => __('Posted in ', $textdomain),
    'posted_by' => __('Posted by ', $textdomain),
    'on' => __('on', $textdomain),
/* =============================================
* SOCIAL WIDGET
*==============================================*/
    'social_widget_title' => __('Jigsaw - Social', $textdomain),
    'social_widget_desc' => __('Social Networking Links', $textdomain),
    'social_default_title' => '',
    'facebook_connect' => __('Connect on Facebook', $textdomain),
    'flickr_connect' => __('Connect on Flickr', $textdomain),
    'twitter_connect' => __('Connect on Twitter', $textdomain),
    'google_connect' => __('Connect on Google', $textdomain),
    'linkedin_connect' => __('Connect on LinkedIn', $textdomain),

    /* =============================================
    * TWITTER WIDGET
    *==============================================*/
    'twitter_widget_title' => __('Nexus - Twitter', $textdomain),
    'twitter_widget_desc' => __('A Twitter Feed', $textdomain),
    'twitter_default_title' => __('Tweets', $textdomain),

    /* =============================================
    * EMBED WIDGET
    *==============================================*/
    'embed_widget_title' => __('Nexus - Embed', $textdomain),
    'embed_widget_desc' => __('Embeds the specified URL using WordPress oEmbed support.', $textdomain),
    'embed_default_title' => '',
    'embed_autop' => __('Automatically add paragraphs', $textdomain),

    /* =============================================
    * blog WIDGET
    *==============================================*/
    'blog_widget_title' => __('Nexus - Blog', $textdomain),
    'blog_widget_desc' => __('A Blog Feed', $textdomain),
    'blog_default_title' => __('Recent Posts', $textdomain),

    /* =============================================
    * popular WIDGET
    *==============================================*/
    'popular_widget_title' => __('Nexus - Popular Posts', $textdomain),
    'popular_widget_desc' => __('A Popular Posts Feed', $textdomain),
    'popular_default_title' => __('Popular Posts', $textdomain),

    /* =============================================
    * works WIDGET
    *==============================================*/
    'works_widget_title' => __('Nexus - Works', $textdomain),
    'works_widget_desc' => __('A Portfolio Item Feed', $textdomain),
    'works_default_title' => __('Works', $textdomain),

    /* =============================================
    * search WIDGET
    *==============================================*/
    'search_placeholder' => __('Search...', $textdomain),

    /* =============================================
    * popular works WIDGET
    *==============================================*/
    'popular_works_widget_title' => __('Nexus - Popular Works', $textdomain),
    'popular_works_widget_desc' => __('A Popular Portfolio Item Feed', $textdomain),
    'popular_works_default_title' => __('Popular Works', $textdomain),

    'meta_by' => __('by', $textdomain),
    'meta_on' => __('on', $textdomain),
    'meta_in' => __('in', $textdomain),
    'meta_edit' => __('{ Edit }', $textdomain),

/* =============================================
* ADMIN Frontend Strings
*==============================================*/

    /* =============================================
    * Flex Slider Slide Labels
    *==============================================*/
    'flex_slide_labels' => array(
        'name' => _x('Flex Slides', 'post type general name', $textdomain),
        'singular_name' => _x('Flex Slide', 'post type singular name', $textdomain),
        'add_new' => _x('Add New', 'slide', $textdomain),
        'add_new_item' => __('Add New Flex Slide', $textdomain),
        'edit_item' => __('Edit Flex Slide', $textdomain),
        'new_item' => __('New Flex Slide', $textdomain),
        'view_item' => __('View Flex Slide', $textdomain),
        'search_items' => __('Search Flex Slide', $textdomain),
        'not_found' => __('No flex slides found', $textdomain),
        'not_found_in_trash' => __('No flex slides found in Trash', $textdomain),
        'parent_item_colon' => ''
    ),

    /* =============================================
    * Flex Slider Slide Labels
    *==============================================*/
    'flex_slide_category_labels' => array(
        'name' => _x('Categories', 'taxonomy general name', $textdomain),
        'singular_name' => _x('Category', 'taxonomy singular name', $textdomain),
        'search_items' => __('Search Categories', $textdomain),
        'popular_items' => __('Popular Categories', $textdomain),
        'all_items' => __('All Categories', $textdomain),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => __('Edit Category', $textdomain),
        'update_item' => __('Update Category', $textdomain),
        'add_new_item' => __('Add New Category', $textdomain),
        'new_item_name' => __('New Category Name', $textdomain),
        'separate_items_with_commas' => __('Separate categories with commas', $textdomain),
        'add_or_remove_items' => __('Add or remove categories', $textdomain),
        'choose_from_most_used' => __('Choose from the most used categories', $textdomain),
        'menu_name' => __('Categories', $textdomain),
    ),

    /* =============================================
    * Content Slider Slide Labels
    *==============================================*/
    'content_slide_labels' => array(
        'name' => _x('Content Slides', 'post type general name', $textdomain),
        'singular_name' => _x('Content Slide', 'post type singular name', $textdomain),
        'add_new' => _x('Add New', 'slide', $textdomain),
        'add_new_item' => __('Add New Content Slide', $textdomain),
        'edit_item' => __('Edit Content Slide', $textdomain),
        'new_item' => __('New Content Slide', $textdomain),
        'view_item' => __('View Content Slide', $textdomain),
        'search_items' => __('Search Content Slide', $textdomain),
        'not_found' => __('No content slides found', $textdomain),
        'not_found_in_trash' => __('No content slides found in Trash', $textdomain),
        'parent_item_colon' => ''
    ),

    /* =============================================
    * Content Slider Slide Labels
    *==============================================*/
    'content_slide_category_labels' => array(
        'name' => _x('Categories', 'taxonomy general name', $textdomain),
        'singular_name' => _x('Category', 'taxonomy singular name', $textdomain),
        'search_items' => __('Search Categories', $textdomain),
        'popular_items' => __('Popular Categories', $textdomain),
        'all_items' => __('All Categories', $textdomain),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => __('Edit Category', $textdomain),
        'update_item' => __('Update Category', $textdomain),
        'add_new_item' => __('Add New Category', $textdomain),
        'new_item_name' => __('New Category Name', $textdomain),
        'separate_items_with_commas' => __('Separate categories with commas', $textdomain),
        'add_or_remove_items' => __('Add or remove categories', $textdomain),
        'choose_from_most_used' => __('Choose from the most used categories', $textdomain),
        'menu_name' => __('Categories', $textdomain),
    ),

    /* =============================================
    * CP Slider Slide Labels
    *==============================================*/
    'cp_slide_labels' => array(
        'name' => _x('CP Slides', 'post type general name', $textdomain),
        'singular_name' => _x('CP Slide', 'post type singular name', $textdomain),
        'add_new' => _x('Add New', 'slide', $textdomain),
        'add_new_item' => __('Add New CP Slide', $textdomain),
        'edit_item' => __('Edit CP Slide', $textdomain),
        'new_item' => __('New CP Slide', $textdomain),
        'view_item' => __('View CP Slide', $textdomain),
        'search_items' => __('Search CP Slide', $textdomain),
        'not_found' => __('No content slides found', $textdomain),
        'not_found_in_trash' => __('No content slides found in Trash', $textdomain),
        'parent_item_colon' => ''
    ),

    /* =============================================
    * CP Slider Slide Labels
    *==============================================*/
    'cp_slide_category_labels' => array(
        'name' => _x('Categories', 'taxonomy general name', $textdomain),
        'singular_name' => _x('Category', 'taxonomy singular name', $textdomain),
        'search_items' => __('Search Categories', $textdomain),
        'popular_items' => __('Popular Categories', $textdomain),
        'all_items' => __('All Categories', $textdomain),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => __('Edit Category', $textdomain),
        'update_item' => __('Update Category', $textdomain),
        'add_new_item' => __('Add New Category', $textdomain),
        'new_item_name' => __('New Category Name', $textdomain),
        'separate_items_with_commas' => __('Separate categories with commas', $textdomain),
        'add_or_remove_items' => __('Add or remove categories', $textdomain),
        'choose_from_most_used' => __('Choose from the most used categories', $textdomain),
        'menu_name' => __('Categories', $textdomain),
    ),

    'cp_slide_image_title' => __('Background Image', $textdomain),
    'cp_slide_image_desc' => __('The image that is displayed as the background of the slide', $textdomain),
    'cp_foreground_image_title' => __('Foreground Image', $textdomain),
    'cp_foreground_image_desc' => __('The image that is displayed as a featured, animated in image', $textdomain),

    'cp_image' => __('Background Image', $textdomain),

    'cp_image_desktop_desc' => __('The background image displayed when the site is displayed in the desktop layout', $textdomain),
    'cp_image_tablet_desc' => __('The background image displayed when the site is displayed in the tablet layout', $textdomain),
    'cp_image_mlandscape_desc' => __('The background image displayed when the site is displayed in the mobile landscape layout', $textdomain),
    'cp_image_mportrait_desc' => __(' The background image displayed when the site is displayed in the mobile portrait layout', $textdomain),

    'cp_fg_image' => __('Foreground Image', $textdomain),

    'cp_fg_image_desktop_desc' => __('The foreground image displayed when the site is displayed in the desktop layout', $textdomain),
    'cp_fg_image_tablet_desc' => __('The foreground image displayed when the site is displayed in the tablet layout', $textdomain),
    'cp_fg_image_mlandscape_desc' => __('The foreground image displayed when the site is displayed in the mobile landscape layout', $textdomain),
    'cp_fg_image_mportrait_desc' => __(' The foreground image displayed when the site is displayed in the mobile portrait layout', $textdomain),

    'cp_layout' => __('Content Layout', $textdomain),
    'cp_layout_desc' => __('Where to display the content of the slide', $textdomain),

    /* =============================================
    * Portfolio Items Labels
    *==============================================*/
    'portfolio_item_labels' => array(
        'name' => _x('Portfolio Items', 'post type general name', $textdomain),
        'singular_name' => _x('Portfolio Item', 'post type singular name', $textdomain),
        'add_new' => _x('Add New', 'slide', $textdomain),
        'add_new_item' => __('Add New Portfolio Item', $textdomain),
        'edit_item' => __('Edit Portfolio Item', $textdomain),
        'new_item' => __('New Portfolio Item', $textdomain),
        'view_item' => __('View Portfolio Item', $textdomain),
        'search_items' => __('Search Portfolio Items', $textdomain),
        'not_found' => __('No portfolio items found', $textdomain),
        'not_found_in_trash' => __('No portfolio items found in Trash', $textdomain),
        'parent_item_colon' => ''
    ),

    /* =============================================
    * Portfolio Meta Options
    *==============================================*/
    'portfolio_subtitle_desc' => __('The subtitle of this portfolio item', $textdomain),
    'portfolio_preview_caption' => __('Preview Caption', $textdomain),
    'portfolio_preview_caption_desc' => __('The the caption text displayed in previews of this portfolio item', $textdomain),
    'portfolio_preview_image_desc' => __('The preview image to display for this portfolio item. The image specified here will be used as the source image to resize when the item is displayed in a Portfolio and/or Recent Projects shortcode. If this value is not specified, the <i>Featured Image</i> value of this post will be used as the source image for this item\'s preview image.', $textdomain),

    'portfolio_video_embed_url' => __('Video Embed URL', $textdomain),
    'portfolio_video_embed_desc' => __('The video to show on Lightbox launch in the Portfolio.', $textdomain),
    'portfolio_m4v' => __('HTML 5 Video m4v URL', $textdomain),
    'portfolio_m4v_desc' => __('The m4v video for an HTML5 video display on the Portfolio Item page', $textdomain),
    'portfolio_ogv' => __('HTML 5 Video ogv URL', $textdomain),
    'portfolio_ogv_desc' => __('The ogv video for an HTML5 video display on the Portfolio Item page', $textdomain),
    'portfolio_webmv' => __('HTML 5 Video webmv URL', $textdomain),
    'portfolio_webmv_desc' => __('The webmv video for an HTML5 video display on the Portfolio Item page', $textdomain),
    'portfolio_m4a' => __('HTML 5 Audio m4a URL', $textdomain),
    'portfolio_m4a_desc' => __('The m4a track for an HTML5 audio display on the Portfolio Item page', $textdomain),
    'portfolio_ogg' => __('HTML 5 Audio ogg URL', $textdomain),
    'portfolio_ogg_desc' => __('The ogg track for an HTML5 audio display on the Portfolio Item page', $textdomain),
    'portfolio_bkgd_desc' => __('The background of the portfolio item.', $textdomain),

    /* =============================================
    * Portfolio Filter Labels
    *==============================================*/
    'portfolio_filter_labels' => array(
        'name' => _x('Filters', 'taxonomy general name', $textdomain),
        'singular_name' => _x('Filter', 'taxonomy singular name', $textdomain),
        'search_items' => __('Search Filters', $textdomain),
        'popular_items' => __('Popular Filters', $textdomain),
        'all_items' => __('All Filters', $textdomain),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => __('Edit Filter', $textdomain),
        'update_item' => __('Update Filter', $textdomain),
        'add_new_item' => __('Add New Filter', $textdomain),
        'new_item_name' => __('New Filter Name', $textdomain),
        'separate_items_with_commas' => __('Separate filters with commas', $textdomain),
        'add_or_remove_items' => __('Add or remove filters', $textdomain),
        'choose_from_most_used' => __('Choose from the most used filters', $textdomain),
        'menu_name' => __('Filters', $textdomain),
    ),

    /* =============================================
    * Portfolio Category Labels
    *==============================================*/
    'portfolio_category_labels' => array(
        'name' => _x('Categories', 'taxonomy general name', $textdomain),
        'singular_name' => _x('Category', 'taxonomy singular name', $textdomain),
        'search_items' => __('Search Categories', $textdomain),
        'popular_items' => __('Popular Categories', $textdomain),
        'all_items' => __('All Categories', $textdomain),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => __('Edit Category', $textdomain),
        'update_item' => __('Update Category', $textdomain),
        'add_new_item' => __('Add New Category', $textdomain),
        'new_item_name' => __('New Category Name', $textdomain),
        'separate_items_with_commas' => __('Separate categories with commas', $textdomain),
        'add_or_remove_items' => __('Add or remove categories', $textdomain),
        'choose_from_most_used' => __('Choose from the most used categories', $textdomain),
        'menu_name' => __('Categories', $textdomain),
    ),

    /* =============================================
    * Page Meta Options
    *==============================================*/
    'page_subtitle_desc' => __('The subtitle that appears in the subheader of the page', $textdomain),
    'page_bkgd_desc' => __('The background of the page', $textdomain),
    'page_slider_type_desc' => __('The type of slider to display at the top of the page', $textdomain),
    'page_slide_orderdir_desc' => __('The direction that the slides will be ordered', $textdomain),
    'page_slide_orderby_desc' => __('The field to order the slides by', $textdomain),
    'page_slideshow_speed_desc' => __('The speed of the slideshow in milliseconds (Set to -1 to disable the Autoplay)', $textdomain),

    /* =============================================
    * Post Meta Options
    *==============================================*/
    'post_subtitle_desc' => __('The subtitle that appears in the subheader of the post', $textdomain),
    'post_bkgd_desc' => __('The background of the post.', $textdomain),
    'post_preview_image_desc' => __('The preview image to display for the post. The image specified here will be used as the source image to resize when the post is displayed in the Blog and/or the Recent Posts (horizontal & vertical) shortcodes. If this value is not specified, the <i>Featured Image</i> value of this post will be used as the source image for this post\'s preview image.', $textdomain),

    /* =============================================
    * Flex Slider Meta Options
    *==============================================*/
    'subcaption' => __('Subcaption', $textdomain),
    'flex_slide_caption_desc' => __('The top-level heading for the slide', $textdomain),
    'flex_slide_subcaption_desc' => __('The secondary heading for the slide', $textdomain),

    'flex_slide_caption_pos_desc' => __('The position you want the caption to appear', $textdomain),

    'fs_image_desktop' => __('Slide Image (Desktop layout - 980px)', $textdomain),
    'fs_image_tablet' => __('Slide Image (Tablet layout - 740px)', $textdomain),
    'fs_image_mlandscape' => __('Slide Image (Mobile Landscape layout - 460px)', $textdomain),
    'fs_image_mportrait' => __('Slide Image (Mobile Portrait layout - 300px)', $textdomain),

    'fs_image_desktop_desc' => __('The image displayed when the site is displayed in the desktop layout', $textdomain),
    'fs_image_tablet_desc' => __('The image displayed when the site is displayed in the tablet layout', $textdomain),
    'fs_image_mlandscape_desc' => __('The image displayed when the site is displayed in the mobile landscape layout', $textdomain),
    'fs_image_mportrait_desc' => __(' The image displayed when the site is displayed in the mobile portrait layout', $textdomain),

    'flex_slide_link_url' => __('Link URL', $textdomain),
    'flex_slide_link_url_desc' => __('The URL to navigate to when the slide is clicked', $textdomain),

    /* =============================================
    * Content Slider Meta Options
    *==============================================*/


/* =============================================
* Option Tree ADMIN Frontend Strings
*==============================================*/
    'slide_image_url' => __('Slide Image URL', $textdomain),
    'slide_url' => __('Slide URL', $textdomain),
    'caption' => __('Caption', $textdomain),
    'ot_options' => __('Options', $textdomain),
    'ot_somebody' => __('Somebody', $textdomain),
    'ot_theme_options' => __('Theme Options', $textdomain),
    'ot_settings' => __('Settings', $textdomain),
    'ot_current_editing_warning' => __('Warning: %s is currently editing the %s.', $textdomain),
    'ot_show_settings' => __('Show Settings &amp; Docs', $textdomain),
    'ot_save_all_changes' => __('Save All Changes', $textdomain),
    'ot_new_layout' => __('New Layout', $textdomain),
    'ot_activate_layout' => __('Activate Layout', $textdomain),
    'ot_reload_xml' => __('Reload XML', $textdomain),
    'ot_reset_options' => __('Reset Options', $textdomain),

/* =============================================
* Page Template Strings
*==============================================*/

    /* =============================================
    * 404 Template Strings
    *==============================================*/
    '404' => __('404 Error', $textdomain),
    'not_found' => __('Sorry, we can\'t seem to find the page you were looking for.', $textdomain),
    'page_missing' => __('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', $textdomain),
    'check_spelling' => __('Check your spelling', $textdomain),
    'try_the_following' => __('Please try the following:', $textdomain),
    'return_to_home' => __('Return to the <a href="%s">home page</a>', $textdomain),
    'click_back' => __('Click the <a href="javascript:history.back()">Back</a> button', $textdomain),

    /* =============================================
    * Archive Template Strings
    *==============================================*/
    'daily_archive' => __('Daily Archives', $textdomain),
    'monthly_archive' => __('Monthly Archives', $textdomain),
    'yearly_archive' => __('Yearly Archives', $textdomain),
    'archive_category' => __('Category', $textdomain),
    'archive' => __('Archives', $textdomain),

    /* =============================================
    * Archive Template Strings
    *==============================================*/
    'blog_default_title' => __('The Blog', $textdomain),
    'blog_default_subtitle' => __('Take a look around and join the conversation.', $textdomain),

    'latest_posts' => __('The Latest Posts', $textdomain),
    'browse_month' => __('Browse by Month', $textdomain),
    'browse_category' => __('Browse by Category', $textdomain),

    /* =============================================
    * Comments Template Strings
    *==============================================*/
    'comment_awaiting_mod' => __('Your comment is awaiting moderation.', $textdomain),
    'comment_reply' => __('Reply &raquo;', $textdomain),
    'not_directly' => __('Please do not load this page directly. Thanks!', $textdomain),
    'password_protected' => __('This post is password protected. Enter the password to view comments.', $textdomain),
    'no_comments' => __('There are no comments', $textdomain),
    'one_comment' => __('There is 1 comment', $textdomain),
    'x_comments' => __('There are % comments', $textdomain),
    'no_comments_meta' => __('no comments', $textdomain),
    'one_comment_meta' => __('1 comment', $textdomain),
    'x_comments_meta' => __('% comments', $textdomain),
    'add_yours' => __('Add Yours.', $textdomain),
    'older_comments' => __('&larr; Older comments', $textdomain),
    'newer_comments' => __('Newer comments &rarr;', $textdomain),
    'comments_closed' => __('Comments are closed', $textdomain),
    'share_thoughts' => __('Share Your Thoughts!', $textdomain),
    'leave_reply' => __('Leave a Reply to %s', $textdomain),
    'must_login' => __('You must be <a href="%s">logged in</a> to post a comment.', $textdomain),
    'please_post' => __('Hello <a href="%s/wp-admin/profile.php">%s</a>! Please add your comment below.', $textdomain),
    'your_name' => __('Your Name', $textdomain),
    'your_email' => __('Your Email', $textdomain),
    'your_website' => __('Your Website', $textdomain),
    'required_star' => __(' *', $textdomain),
    'comment' => __('Comment', $textdomain),
    'post_comment' => __('Post Comment', $textdomain),

    'pages' => __('Pages:', $textdomain),

    /* =============================================
    * loop-search Template Strings
    *==============================================*/
    'no_results' => __('Sorry, no results were found.', $textdomain),
    'older_posts' => __('&larr; Older posts', $textdomain),
    'newer_posts' => __('Newer posts &rarr;', $textdomain),
    'search_results' => __('Search Results for', $textdomain),
    'search_for' => __('Search for:', $textdomain),
    'search' => __('Search', $textdomain),

    /* =============================================
    * Shortcode Gen Strings
    *==============================================*/
    'customize_sc' => __('Customize the Shortcode', $textdomain),
    'preview_sc' => __('Preview', $textdomain),

    'back_to_top' => __('Back to Top', $textdomain),

    /* =============================================
    * Prime PaginationStrings
    *==============================================*/
    'pagination_older' => __('Older Posts  &rarr;', $textdomain),
    'pagination_newer' => __('&larr; Newer Posts', $textdomain),
    'portfolio_pagination_next' => __('Forwards  &rarr;', $textdomain),
    'portfolio_pagination_prev' => __('&larr; Back', $textdomain),

    /* =============================================
    * Roots Inc Strings
    *==============================================*/
    'update_site_tagline' => __('Please update your <a href="%s">site tagline</a> <a href="%s" style="float: right;">Hide Notice</a>', $textdomain),
    'primary_nav' => __('Header Menu (Desktop)', $textdomain),
    'tablet_nav' => __('Header Menu (Tablet Portrait)', $textdomain),
    'tablet_nav_landscape' => __('Header Menu (Tablet Landscape)', $textdomain),
    'mobile_nav' => __('Header Menu  (Mobile)', $textdomain),
    'sidebar' => __('Sidebar', $textdomain),
    'footer' => __('Footer', $textdomain),
    'footer_0' => __('Footer 0', $textdomain),
    'footer_1' => __('Footer 1', $textdomain),
    'footer_2' => __('Footer 2', $textdomain),
    'footer_3' => __('Footer 3', $textdomain),

    'posted_on' => __('Posted on %s at %s.', $textdomain),
    'written_by' => __('Written by', $textdomain),
    'htaccess_writable' => __('Please make sure your <a href="%s">.htaccess</a> file is writable ', $textdomain)

);