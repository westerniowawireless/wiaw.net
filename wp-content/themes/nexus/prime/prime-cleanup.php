<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Hiron
 * Date: 12/1/11
 * Time: 10:07 AM
 * To change this template use File | Settings | File Templates.
 */

//override WordPress oEmbed provider so that we can enable the api.
wp_oembed_add_provider('#http://(www\.)?vimeo\.com/.*#i', 'http://www.vimeo.com/api/oembed.{format}?api=1', true);

add_filter('widget_text', 'do_shortcode');
// remove_filter('the_content', 'wpautop');

function unregister_problem_widgets()
{
    unregister_widget('WP_Widget_Calendar');
}

add_action('widgets_init', 'unregister_problem_widgets');

function custom_excerpt_length($length)
{
    return 27;
}

add_filter('excerpt_length', 'custom_excerpt_length', 999);

if (!function_exists('prime_post_meta')) {
    function prime_post_meta()
    {
        global $FRONTEND_STRINGS;
        ?>

    <p class="post-meta">
        <span class="post-author"><span
            class="small"><?php echo $FRONTEND_STRINGS['meta_by']; ?></span> <?php the_author_posts_link(); ?></span>
        <span class="post-date"><span
            class="small"><?php echo $FRONTEND_STRINGS['meta_on']; ?></span> <?php the_time(get_option('date_format')); ?></span>
        <span class="post-category"><span
            class="small"><?php echo $FRONTEND_STRINGS['meta_in']; ?></span> <?php the_category(', '); ?></span>
        <?php edit_post_link($FRONTEND_STRINGS['meta_edit'], '<span class="small">', '</span>'); ?>
    </p>
    <?php

    }
}

add_filter('roots_sidebar_inside_before', 'add_mobile_sidebar_divider');

if (!function_exists('add_mobile_sidebar_divider')) {
    function add_mobile_sidebar_divider()
    {
        echo "<div class=\"divider mobile-divider\"></div><div class=\"clear\"></div>";
    }
}


if (!function_exists('prime_title_and_subtitle')) {
    /**
     * A helper method that echos the provided title and subtitl in spans and injects a separator between the
     * two. The separator is retrieved via get_option_tree('title_subtitle_separator').
     * @param $title
     * @param $subtitle
     * @return void
     */
    function prime_title_and_subtitle($title, $subtitle)
    {
        $sep = get_prime_options('title_subtitle_separator');
        $title = empty($subtitle) ? $title : ($title . $sep);
        ?>
    <span class="title"><?php echo $title; ?></span><span
        class="subtitle"><?php echo $subtitle; ?>
              </span>
    <?php

    }
}

/**
 * Removes wpautop and improper nesting of p and br tags
 */

if (!function_exists("prime_remove_autop")) {
    function prime_remove_autop($content)
    {
        $content = do_shortcode(shortcode_unautop($content));
        $content = preg_replace('#^<\/p>|^<br\s?\/?>|<p>$|<p>\s*(&nbsp;)?\s*<\/p>#', '', $content);
        return $content;
    }
}

function prime_formatter($content)
{
    $new_content = '';
    $pattern_full = '{(\[raw\].*?\[/raw\])}is';
    $pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
    $pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

    foreach ($pieces as $piece) {
        if (preg_match($pattern_contents, $piece, $matches)) {
            $new_content .= shortcode_unautop($matches[1]);
        } else {
            $new_content .= wptexturize(wpautop($piece));
        }
    }

    return $new_content;
}

function prime_remove_raw($content)
{
    $new_content = prime_formatter($content);
    $new_content = str_replace('[raw]', '', $new_content);
    $new_content = str_replace('[/raw]', '', $new_content);
    return $new_content;
}

remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');

add_filter('the_content', 'prime_formatter', 10);

add_filter('the_excerpt', 'prime_remove_raw', 10);


function prime_portfolio_template($templates = '')
{
    $page = get_queried_object();

    $portfolio_instance = get_option(PRIME_OPTIONS_KEY);

    if (isset($portfolio_instance['portfolio_instance_slider'])) {
        foreach ($portfolio_instance['portfolio_instance_slider'] as $p) {
            if ($p['portfolio_page'] == $page->ID) {
                $templates = locate_template('theme-portfolio.php', false);
            }
        }
    }

    return $templates;
}

add_filter('page_template', 'prime_portfolio_template');

/**
 * Adds wmode param to the flash embeds
 * http://mehigh.biz/wordpress/adding-wmode-transparent-to-wordpress-3-media-embeds.html
 * @param $html
 * @param $url
 * @param $attr
 * @return mixed
 */
function add_video_wmode_transparent($html, $url, $attr)
{
    $controls = isset($attr['controls']) ? $attr['controls'] : 1;
    $autoplay = isset($attr['autoplay']) ? $attr['autoplay'] : 0;
    $ret_str = $html;

    if (strpos($html, "<embed src=") !== false) {
        //Embed based params
        $ret_str = str_replace('</param><embed', '</param><param name="autoplay" value="' . $autoplay . '"><param name="controls" value="' . $controls . '"></param><param name="autoplay" value="1"><param name="enablejsapi" value="1"><param name="wmode" value="opaque"></param><embed controls="0" wmode="opaque" ', $html);
    }
    elseif (strpos($html, 'feature=oembed') !== false)
    {
        $new_str = sprintf('feature=oembed&wmode=opaque&controls=%s&autoplay=%s&enablejsapi=1', $controls, $autoplay);
        //oEmbed providers. YouTube is provided through this
        $ret_str = str_replace('feature=oembed', $new_str, $html);
    }

    return $ret_str;
}

add_filter('embed_oembed_html', 'add_video_wmode_transparent', 10, 3);

function get_custom_sidebar_id($n)
{
    return $n['id'];
}

global $had_first_widget;
$had_first_widget = false;
// first and last classes for widgets
// http://wordpress.org/support/topic/how-to-first-and-last-css-classes-for-sidebar-widgets
function prime_widget_first_last_classes($params)
{
    global $my_widget_num;
    global $had_first_widget;
    $this_id = $params[0]['id'];
    $arr_registered_widgets = wp_get_sidebars_widgets();

    $option_tree = get_option(PRIME_OPTIONS_KEY);

    $sidebars = isset($option_tree['unlimited_sidebar_slider']) ? $option_tree['unlimited_sidebar_slider'] : array();
    $custom_ids = array_values(array_map('get_custom_sidebar_id', $sidebars));

    $index_custom = array_search($this_id, $custom_ids);
    $is_custom = $index_custom !== false;


    $custom_first = $index_custom == 0;
    $custom_last = $index_custom == (count($custom_ids) - 1);

    if (!$my_widget_num) {
        $my_widget_num = array();
    }

    if (!isset($arr_registered_widgets[$this_id]) || !is_array($arr_registered_widgets[$this_id])) {
        return $params;
    }

    if (isset($my_widget_num[$this_id])) {
        $my_widget_num[$this_id]++;
    } else {
        $my_widget_num[$this_id] = 1;
    }

    $class = 'class="widget-' . $my_widget_num[$this_id] . ' ';

    $allowed_widget_first = !$is_custom || ($is_custom && $custom_first);
    $allowed_widget_last = !$is_custom || ($is_custom && $custom_last);

    if ($my_widget_num[$this_id] == 1 && !$had_first_widget) {
        $class .= 'widget-first ';
        $had_first_widget = true;
    } elseif ($my_widget_num[$this_id] == count($arr_registered_widgets[$this_id]) && $allowed_widget_last) {
        $class .= 'widget-last ';
    }

    $params[0]['before_widget'] = str_replace('class="', $class, $params[0]['before_widget']);

    return $params;

}

add_filter('dynamic_sidebar_params', 'prime_widget_first_last_classes');


// Adds a class to parent menu items
add_filter('wp_nav_menu_objects', 'prime_cleanup_wp_nav_menu_objects');

function prime_cleanup_wp_nav_menu_objects($items)
{

    foreach ($items as &$item) {
        if (hasSub($item->ID, $items)) {
            $item->classes[] = 'menu-parent-item'; // all elements of field "classes" of a menu item get join together and render to class attribute of <li> element in HTML
        }
    }
    return $items;
}

function hasSub($menu_item_id, &$items)
{
    foreach ($items as $item) {
        if ($item->menu_item_parent && $item->menu_item_parent == $menu_item_id) {
            return true;
        }
    }
    return false;
}

;

function prime_menu_fallback()
{
    return;
}