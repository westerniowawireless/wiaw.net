<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Hiron
 * Date: 12/1/11
 * Time: 9:00 AM
 * To change this template use File | Settings | File Templates.
 */

$shortcodes_dir = THEME_DIR . '/prime/shortcodes/%s';

//import to shortcodes
require_once sprintf($shortcodes_dir, 'accordion.php');
require_once sprintf($shortcodes_dir, 'alert.php');
require_once sprintf($shortcodes_dir, 'animate.php');
require_once sprintf($shortcodes_dir, 'blockquote.php');
require_once sprintf($shortcodes_dir, 'button.php');
require_once sprintf($shortcodes_dir, 'code.php');
require_once sprintf($shortcodes_dir, 'column.php');
require_once sprintf($shortcodes_dir, 'content-slider.php');
require_once sprintf($shortcodes_dir, 'cpslider.php');
require_once sprintf($shortcodes_dir, 'display.php');
require_once sprintf($shortcodes_dir, 'divider.php');
require_once sprintf($shortcodes_dir, 'dropcap.php');
require_once sprintf($shortcodes_dir, 'flex-slider.php');
require_once sprintf($shortcodes_dir, 'gallery.php');
require_once sprintf($shortcodes_dir, 'icon.php');
require_once sprintf($shortcodes_dir, 'image.php');
require_once sprintf($shortcodes_dir, 'list.php');
require_once sprintf($shortcodes_dir, 'map.php');
require_once sprintf($shortcodes_dir, 'pricing.php');
require_once sprintf($shortcodes_dir, 'pullquote.php');
require_once sprintf($shortcodes_dir, 'recent-posts.php');
require_once sprintf($shortcodes_dir, 'recent-posts-vertical.php');
require_once sprintf($shortcodes_dir, 'recent-projects.php');
require_once sprintf($shortcodes_dir, 'social.php');
require_once sprintf($shortcodes_dir, 'tab.php');
require_once sprintf($shortcodes_dir, 'table.php');
require_once sprintf($shortcodes_dir, 'toggle.php');
require_once sprintf($shortcodes_dir, 'video.php');
require_once sprintf($shortcodes_dir, 'responsive-image.php');
require_once sprintf($shortcodes_dir, 'spacer.php');

//register the shortcodes
//inline register column shortcodes in column.php since there are a lot
add_shortcode('accordion', 'prime_shortcode_accordion');
add_shortcode('accordion_item', 'prime_shortcode_accordion_item');
add_shortcode('animate', 'prime_shortcode_animate');
add_shortcode('cpslider', 'prime_shortcode_cp_slider');
add_shortcode('display', 'prime_shortcode_display');
add_shortcode('display_desktop', 'prime_shortcode_display_desktop');
add_shortcode('display_tablet', 'prime_shortcode_display_tablet');
add_shortcode('display_mobile_landscape', 'prime_shortcode_display_mobile_landscape');
add_shortcode('display_mobile_portrait', 'prime_shortcode_display_mobile_portrait');

add_shortcode('tabs', 'prime_shortcode_tabs');
add_shortcode('tab', 'prime_shortcode_tab_single');
add_shortcode('toggle', 'prime_shortcode_toggle');
add_shortcode('button', 'prime_shortcode_button');
add_shortcode('blockquote', 'prime_shortcode_blockquote');
add_shortcode('pullquote', 'prime_shortcode_pullquote');
add_shortcode('dropcap', 'prime_shortcode_dropcap');
add_shortcode('flex_slider', 'prime_shortcode_flex_slider');
add_shortcode('content_slider', 'prime_shortcode_content_slider');
add_shortcode('prime_gallery', 'prime_shortcode_gallery');
add_shortcode('image', 'prime_shortcode_image');
add_shortcode('list', 'prime_shortcode_list');
add_shortcode('list_item', 'prime_shortcode_list_item');
add_shortcode('alert', 'prime_shortcode_alert');
add_shortcode('message', 'prime_shortcode_message');
add_shortcode('divider', 'prime_shortcode_divider');
add_shortcode('social', 'prime_shortcode_social');
add_shortcode('recent_projects', 'prime_shortcode_recent_projects');
add_shortcode('recent_posts', 'prime_shortcode_recent_posts');
add_shortcode('recent_posts_vert', 'prime_shortcode_recent_posts_vert');
add_shortcode('table', 'prime_shortcode_table');
add_shortcode('video', 'prime_shortcode_video');
add_shortcode('codebox', 'prime_shortcode_codebox');
add_shortcode('icon', 'prime_shortcode_icon');
add_shortcode('spacer', 'prime_shortcode_spacer');
add_shortcode('social', 'prime_shortcode_social');
add_shortcode('pricing', 'prime_shortcode_pricing');
add_shortcode('plan', 'prime_shortcode_plan');
add_shortcode('responsive_image', 'prime_shortcode_responsive_image');
