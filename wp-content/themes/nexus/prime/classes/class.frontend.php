<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Hiron
 * Date: 3/19/12
 * Time: 4:22 PM
 * To change this template use File | Settings | File Templates.
 */

class PrimeFrontend
{
    function PrimeFrontend()
    {
        $this->__construct();
    }

    function __construct()
    {
        add_action('roots_head', array($this, 'enqueue_media'));
        add_action('roots_footer_inside', array($this, 'prime_footer'));
        add_action('roots_main_after', array($this, 'prime_subfooter'));
        add_action('prime_subheader', array($this, 'render_breadcrumbs'));
        add_action('prime_page_intro', array($this, 'render_revslider'));

        add_action('roots_head', array($this, 'writeout_custom_css'));
        add_action('prime_page_intro', array($this, 'render_prime_intro_slider'));
        add_action('roots_content_after', array($this, 'prime_close_page'));
    }

    function prime_head()
    {
        do_action('prime_head');
    }

    function prime_subheader()
    {
        do_action('prime_subheader');
    }

    function render_revslider(){
        do_action('revslider');
    }

    function prime_page_intro()
    {
        do_action('prime_page_intro');
    }

    function prime_footer()
    {
        ?>
    <footer>
        <div class="border border-top"></div>
        <div class="row-fluid clearfix">
            <div class="span4">
                <?php dynamic_sidebar('roots-footer'); ?>
            </div>
            <div class="span4">
                <?php dynamic_sidebar('roots-footer-1'); ?>
            </div>
            <div class="span4">
                <?php dynamic_sidebar('roots-footer-2'); ?>
            </div>
        </div>
    </footer>

    <?php

    }

    function prime_subfooter()
    {
        ?>
    <div class="subfooter"><?php echo get_prime_options('subfooter_left_text'); ?></div>
    <?php
    }

    function prime_close_page() {
        ?>
    <!--[if lt IE 7]>
      <script defer src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
      <script defer>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
    <![endif]-->
    <script type="text/javascript">
        jQuery(window).resize(function() {
            if(jQuery('div.main.has-sidebar').length > 0 && jQuery(window).width() > 767 ) {
                var pageLength = jQuery('div.prime-page').height();
                var sidebarLength = jQuery('div#sidebar').height();
                if(pageLength < sidebarLength) {
                    jQuery('div.prime-page').css('min-height', sidebarLength + 'px');
                }
            }
        });
    </script>
    </body>
    </html>


        <?php
    }

    function writeout_js_global_vars()
    {
        ?>
    <script type="text/javascript">
        /* <![CDATA[ */
        var PrimeAjax = {
            ajaxurl:"<?php echo admin_url('admin-ajax.php'); ?>"
        };
        window.jigsawImagePath = '<?php echo PRIME_THEME_ROOT_URI . 'img/'; ?>';
        /* ]]> */
    </script>
    <?php

    }

    function writeout_custom_css()
    {

        // Retrieve primary theme color - set to orange if not set
        $primary_color = get_prime_options('primary_color');
        // if ($primary_color == null || strlen($primary_color) == 0) $primary_color = '#ff8000';

        // Convert to rgb for use with form focus colors
        $primary_color_rgb_array = html2rgb($primary_color)
        ?>
    <style type="text/css" media="screen">
        a, a:visited, .widget_rss h3 a:hover, body a:hover, body a:visited:hover, .main .tabs > li > a, .tabs > li > a, blockquote, span.pullquote, div.video-embed-shortcode:hover, div#map_canvas:hover, div.recent-posts-carousel h5 a:hover, div.recent-posts-carousel article.item div.description a, div.recent-posts-carousel  article.item div.description a:visited, ul#filters li div:hover, article.item div.description a:hover, .comment a, .comment a:visited, .comment a:hover, .comment .message a.reply:hover, .paginators ul.page-numbers li a.prev:hover, .paginators ul.page-numbers li a.next:hover {
            /*  color: <?php // echo $primary_color; ?>; */
        }

        html.no-touch span.image-overlay, div.video-embed-shortcode:hover, div#map_canvas:hover {
            /*  border-color: <?php // echo $primary_color; ?>; */
        }

        a.image-link span.overlay-thumbnail {
            /*  background : <?php //echo $primary_color; ?>; */
        }

        input:focus, textarea:focus, .search-widget > form.search-form > fieldset.has-focus {
            /*  border-color: rgba(<?php // echo $primary_color_rgb_array[0]; ?>, <?php // echo $primary_color_rgb_array[1]; ?>, <?php // echo $primary_color_rgb_array[2]; ?>, 0.8);*/
            /*  -webkit-box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1), 0 0 8px rgba(<?php // echo $primary_color_rgb_array[0]; ?>, <?php // echo $primary_color_rgb_array[1]; ?>, <?php // echo $primary_color_rgb_array[2]; ?>, 0.6);*/
            /*  -moz-box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1), 0 0 8px rgba(<?php // echo $primary_color_rgb_array[0]; ?>, <?php // echo $primary_color_rgb_array[1]; ?>, <?php // echo $primary_color_rgb_array[2]; ?>, 0.6);*/
            /*   box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1), 0 0 8px rgba(<?php // echo $primary_color_rgb_array[0]; ?>, <?php // echo $primary_color_rgb_array[1]; ?>, <?php // echo $primary_color_rgb_array[2]; ?>, 0.6);*/
        }

        .search-widget > form.search-form > fieldset.has-focus button {
            /*     border-color: rgba(<?php // echo $primary_color_rgb_array[0]; ?>, <?php // echo $primary_color_rgb_array[1]; ?>, <?php // echo $primary_color_rgb_array[2]; ?>, 0.8);*/
        }
    </style>
    <?php
        global $post;
        $options = get_option(PRIME_OPTIONS_KEY);
        $pid = NULL;
        if (is_home()) {
            $pid = get_option('page_for_posts');
        }
        else if ($post) {
            $pid = get_the_ID();
        }

        //
        //        $background = $pid ? get_post_meta($pid, '_prime_background', true) : null;
        //        if ($background && count($background > 0) && ((isset($background['background-color']) && strlen($background['background-color']) > 0) || (isset($background['background-image']) && strlen($background['background-image']) > 0))) {
        //            echo '<style type="text/css" media="screen">';
        //            prime_print_background_css($background, 'html');
        //            echo '</style>';
        //        }
        //        else {
        //            echo '<style type="text/css" media="screen">';
        //            prime_print_background_css($options['default_background'], 'html');
        //            echo '</style>';
        //        }

        // Insert menu spacing
        if (array_key_exists('menu_padding', $options)) {
            $distance = $options['menu_padding'] . 'px';
            $social_distance = intval($options['menu_padding']) + 10;
            $social_distance = $social_distance . 'px';
            ?>
        <style type="text/css">
            ul.topmenu {
                /*margin-top: <?php // echo $distance; ?>;*/
            }

            ul.social-links {
                /* margin-top: <?php // echo $social_distance; ?>; */
            }
        </style>
        <?php
        }


        // HEADER OPTIONS

        $css_string = '';

        // Positioning
        if (array_key_exists('header_top_margin', $options) && strlen(trim($options['header_top_margin'])) != 0) {
            $css_string .= 'header { padding-top: ' . $options['header_top_margin'] . '; }';
        }
        if (array_key_exists('header_bottom_margin', $options) && strlen(trim($options['header_bottom_margin'])) != 0) {
            $css_string .= 'div.menu-wrapper { margin-top: ' . $options['header_bottom_margin'] . '; }';
        }
        if (array_key_exists('logo_top_margin', $options) && strlen(trim($options['logo_top_margin'])) != 0) {
            $css_string .= 'div.logo { padding-top: ' . $options['logo_top_margin'] . '; }';
        }
        if (array_key_exists('tagline_top_margin', $options) && strlen(trim($options['tagline_top_margin'])) != 0) {
            $css_string .= 'div.tagline { margin-top: ' . $options['tagline_top_margin'] . '; }';
        }
        if (array_key_exists('header_content_top_margin', $options) && strlen(trim($options['header_content_top_margin'])) != 0) {
            $css_string .= 'div.header-content { margin-top: ' . $options['header_content_top_margin'] . '; }';
        }
        if (array_key_exists('hide_blog_featured_image', $options)) {
            $css_string .= 'div.post-preview > a.image-link { display: none; visibility: collapse; }';
        }


        // BACKGROUND OPTIONS
        // Creating a separate style tag b/c the utility methods only support immediate printing
        // and not returning the css string.
        echo '<style type="text/css">';

        if (array_key_exists('enable_custom_header_background', $options)) {
            prime_print_background_css($options['header_background'], 'div.header-bg');
            echo 'div.header-bg-fill {display: none; visibility: collapse; }';
        }
        if (array_key_exists('enable_custom_page_background', $options)) {
            prime_print_background_css($options['page_background'], 'html');
        }
        if (array_key_exists('enable_custom_page_content_background', $options)) {
            prime_print_background_css($options['page_content_background'], 'div.page-container, div#nav, div#nav:before, div#nav:after, .flex-control-nav, .flex-control-nav:before, .flex-control-nav:after');
        }
        if (array_key_exists('enable_custom_subheader_background', $options)) {
            prime_print_background_css($options['subheader_background'], 'div.subheader-wrapper');
        }
        if (array_key_exists('enable_custom_sidebar_background', $options)) {
            prime_print_background_css($options['sidebar_background'], 'div.sidebar-wrapper.span4');
        }
        if (array_key_exists('enable_custom_footer_background', $options)) {
            prime_print_background_css($options['footer_background'], 'footer');
        }

        echo '</style>';

        // COLOR OPTIONS
        if (array_key_exists('enable_custom_colors', $options)) {

            // Header Colors
            if (array_key_exists('header_divider_color', $options) && strlen(trim($options['header_divider_color'])) != 0) {
                $css_string .= 'div.tagline, div.social-links > a { border-color: ' . $options['header_divider_color'] . '; }';
            }
            if (array_key_exists('header_tagline_color', $options) && strlen(trim($options['header_tagline_color'])) != 0) {
                $css_string .= prime_print_color_css($options['header_tagline_color'], 'div.tagline', true);
            }
            if (array_key_exists('header_facebook_icon_color', $options) && strlen(trim($options['header_facebook_icon_color'])) != 0) {
                $css_string .= prime_print_color_css($options['header_facebook_icon_color'], 'div.social-links > a.facebook-link:before', true);
            }
            if (array_key_exists('header_facebook_link_color', $options) && strlen(trim($options['header_facebook_link_color'])) != 0) {
                $css_string .= prime_print_color_css($options['header_facebook_link_color'], 'html.std-selector body div.social-links > a.facebook-link, html.std-selector body div.social-links > a.facebook-link:visited, html.std-selector body div.social-links > a.facebook-link:hover, html.ie9 body div.social-links > a.facebook-link, html.ie9 body div.social-links > a.facebook-link:hover, html.ie9 body div.social-links > a.facebook-link:visited, html.ie9 body div.social-links > a.facebook-link:visited:hover', true);
            }
            if (array_key_exists('header_facebook_button_color', $options) && strlen(trim($options['header_facebook_button_color'])) != 0) {
                $css_string .= prime_print_background_color_css($options['header_facebook_button_color'], 'html body div.social-links > a.facebook-link.btn', true);
            }
            if (array_key_exists('header_facebook_button_icon_color', $options) && strlen(trim($options['header_facebook_button_icon_color'])) != 0) {
                $css_string .= prime_print_color_css($options['header_facebook_button_icon_color'], 'html body div.social-links > a.facebook-link.btn:before', true);
            }
            if (array_key_exists('header_facebook_button_text_color', $options) && strlen(trim($options['header_facebook_button_text_color'])) != 0) {
                $css_string .= prime_print_color_css($options['header_facebook_button_text_color'], 'html.std-selector body div.social-links > a.facebook-link.btn, html.std-selector body div.social-links > a.facebook-link.btn:visited, html.std-selector body div.social-links > a.facebook-link.btn:hover', true);
            }
            if (array_key_exists('header_twitter_icon_color', $options) && strlen(trim($options['header_twitter_icon_color'])) != 0) {
                $css_string .= prime_print_color_css($options['header_twitter_icon_color'], 'div.social-links > a.twitter-link:before', true);
            }
            if (array_key_exists('header_twitter_link_color', $options) && strlen(trim($options['header_twitter_link_color'])) != 0) {
                $css_string .= prime_print_color_css($options['header_twitter_link_color'], 'html.std-selector body div.social-links > a.twitter-link, html.std-selector body div.social-links > a.twitter-link:visited, html.std-selector body div.social-links > a.twitter-link:hover, html.ie9 body div.social-links > a.twitter-link, html.ie9 body div.social-links > a.twitter-link:hover, html.ie9 body div.social-links > a.twitter-link:visited, html.ie9 body div.social-links > a.twitter-link:visited:hover', true);
            }
            if (array_key_exists('header_twitter_button_color', $options) && strlen(trim($options['header_twitter_button_color'])) != 0) {
                $css_string .= prime_print_background_color_css($options['header_twitter_button_color'], 'html body div.social-links > a.twitter-link.btn', true);
            }
            if (array_key_exists('header_twitter_button_icon_color', $options) && strlen(trim($options['header_twitter_button_icon_color'])) != 0) {
                $css_string .= prime_print_color_css($options['header_twitter_button_icon_color'], 'html body div.social-links > a.twitter-link.btn:before', true);
            }
            if (array_key_exists('header_twitter_button_text_color', $options) && strlen(trim($options['header_twitter_button_text_color'])) != 0) {
                $css_string .= prime_print_color_css($options['header_twitter_button_text_color'], 'html.std-selector body div.social-links > a.twitter-link.btn, html.std-selector body div.social-links > a.twitter-link.btn:visited, html.std-selector body div.social-links > a.twitter-link.btn:hover', true);
            }
            if (array_key_exists('header_linkedin_icon_color', $options) && strlen(trim($options['header_linkedin_icon_color'])) != 0) {
                $css_string .= prime_print_color_css($options['header_linkedin_icon_color'], 'div.social-links > a.linkedin-link:before', true);
            }
            if (array_key_exists('header_linkedin_link_color', $options) && strlen(trim($options['header_linkedin_link_color'])) != 0) {
                $css_string .= prime_print_color_css($options['header_linkedin_link_color'], 'html.std-selector body div.social-links > a.linkedin-link, html.std-selector body div.social-links > a.linkedin-link:visited, html.std-selector body div.social-links > a.linkedin-link:hover, html.ie9 body div.social-links > a.linkedin-link, html.ie9 body div.social-links > a.linkedin-link:hover, html.ie9 body div.social-links > a.linkedin-link:visited, html.ie9 body div.social-links > a.linkedin-link:visited:hover', true);
            }
            if (array_key_exists('header_linkedin_button_color', $options) && strlen(trim($options['header_linkedin_button_color'])) != 0) {
                $css_string .= prime_print_background_color_css($options['header_linkedin_button_color'], 'html body div.social-links > a.linkedin-link.btn', true);
            }
            if (array_key_exists('header_linkedin_button_icon_color', $options) && strlen(trim($options['header_linkedin_button_icon_color'])) != 0) {
                $css_string .= prime_print_color_css($options['header_linkedin_button_icon_color'], 'html body div.social-links > a.linkedin-link.btn:before', true);
            }
            if (array_key_exists('header_linkedin_button_text_color', $options) && strlen(trim($options['header_linkedin_button_text_color'])) != 0) {
                $css_string .= prime_print_color_css($options['header_linkedin_button_text_color'], 'html.std-selector body div.social-links > a.linkedin-link.btn, html.std-selector body div.social-links > a.linkedin-link.btn:visited, html.std-selector body div.social-links > a.linkedin-link.btn:hover', true);
            }
            if (array_key_exists('header_call_button_color', $options) && strlen(trim($options['header_call_button_color'])) != 0) {
                $css_string .= prime_print_background_color_css($options['header_call_button_color'], 'html.std-selector body span.call-us-button a.btn', true);
            }
            if (array_key_exists('header_call_button_text_color', $options) && strlen(trim($options['header_call_button_text_color'])) != 0) {
                $css_string .= prime_print_color_css($options['header_call_button_text_color'], 'html.std-selector body span.call-us-button a.btn', true);
            }
            if (array_key_exists('header_call_button_icon_color', $options) && strlen(trim($options['header_call_button_icon_color'])) != 0) {
                $css_string .= prime_print_color_css($options['header_call_button_icon_color'], 'html.std-selector body span.call-us-button i.call-us-icon:before', true);
            }
            if (array_key_exists('header_text_color', $options) && strlen(trim($options['header_text_color'])) != 0) {
                $css_string .= prime_print_color_css($options['header_text_color'], 'header > nav, header > nav p, header > nav h1, header > nav h2, header > nav h3, header > nav h4, header > nav h5, header > nav h6', true);
            }

            // Menu Colors
            if (array_key_exists('menu_background_color', $options) && strlen(trim($options['menu_background_color'])) != 0) {
                $css_string .= prime_print_background_color_css($options['menu_background_color'], 'div.menu-wrapper', true);
            }
            if (array_key_exists('menu_item_color', $options) && strlen(trim($options['menu_item_color'])) != 0) {
                $css_string .= prime_print_color_css($options['menu_item_color'], 'ul.topmenu li a strong', true);
            }
            if (array_key_exists('menu_item_hover_color', $options) && strlen(trim($options['menu_item_hover_color'])) != 0) {
                $css_string .= prime_print_color_css($options['menu_item_hover_color'], 'div.menu-wrapper ul.topmenu > li:hover > a strong, div.menu-wrapper ul.topmenu > li.sfHover > a strong', true);
            }
            if (array_key_exists('menu_item_hover_background_color', $options) && strlen(trim($options['menu_item_hover_background_color'])) != 0) {
                $css_string .= 'ul.topmenu > li > a {margin-top: -1px;padding-top: 13px;}';
                $css_string .= prime_print_background_color_css($options['menu_item_hover_background_color'], 'ul.topmenu li.sfHover > a ', true);
            }
            if (array_key_exists('submenu_background_color', $options) && strlen(trim($options['submenu_background_color'])) != 0) {
                $css_string .= prime_print_background_color_css($options['submenu_background_color'], 'ul.topmenu ul.sub-menu, ul.topmenu.mobile-menu', true);
                $css_string .= 'div.mobile-menu-wrapper .mobile-menu-tip {border-bottom-color: ' . $options['submenu_background_color'] . ';}';
            }
            if (array_key_exists('submenu_divider_color', $options) && strlen(trim($options['submenu_divider_color'])) != 0) {
                $css_string .= 'ul.topmenu ul.sub-menu li a, ul.mobile-menu li a { border-color: ' . $options['submenu_divider_color'] . '; }';
            }
            if (array_key_exists('submenu_item_color', $options) && strlen(trim($options['submenu_item_color'])) != 0) {
                $css_string .= prime_print_color_css($options['submenu_item_color'], 'ul.topmenu ul.sub-menu li > a strong, ul.topmenu.mobile-menu > li > a strong, ul.topmenu.mobile-menu > li.sfHover > a strong, html.no-touch ul.topmenu.mobile-menu > li:hover > a strong ', true);
            }
            if (array_key_exists('submenu_item_hover_color', $options) && strlen(trim($options['submenu_item_hover_color'])) != 0) {
                $css_string .= prime_print_color_css($options['submenu_item_hover_color'], 'html.boxed-layout div.menu-wrapper ul.topmenu ul.sub-menu li.sfHover > a strong, html.boxed-layout div.menu-wrapper ul.topmenu ul.sub-menu li:hover > a strong', true);
            }
            if (array_key_exists('submenu_item_hover_background_color', $options) && strlen(trim($options['submenu_item_hover_background_color'])) != 0) {
                $css_string .= prime_print_background_color_css($options['submenu_item_hover_background_color'], 'html.boxed-layout.std-selector div.menu-wrapper ul.topmenu > ul.sub-menu li.sfHover > a, html.boxed-layout.std-selector div.menu-wrapper ul.topmenu ul.sub-menu > li:hover > a', true);
            }
            if (array_key_exists('mobile_menu_button_icon_color', $options) && strlen(trim($options['mobile_menu_button_icon_color'])) != 0) {
                $css_string .= prime_print_background_color_css($options['mobile_menu_button_icon_color'], 'a.mobile-menu-btn span.list-icon-row', true);
            }
            if (array_key_exists('mobile_menu_button_background_color', $options) && strlen(trim($options['mobile_menu_button_background_color'])) != 0) {
                $css_string .= prime_print_background_color_css($options['mobile_menu_button_background_color'], 'html.std-selector body a.mobile-menu-btn.btn', true);
            }

            // Slider Colors
            if (array_key_exists('play_button_color', $options) && strlen(trim($options['play_button_color'])) != 0) {
                $css_string .= prime_print_color_css($options['play_button_color'], 'div#nav > div.nav-controls > a#next, .flex-control-nav li a.icon-play, html.msie .flex-control-nav li a.icon-play', true);
            }
            if (array_key_exists('play_button_hover_color', $options) && strlen(trim($options['play_button_hover_color'])) != 0) {
                $css_string .= prime_print_color_css($options['play_button_hover_color'], 'div#nav > div.nav-controls > a#next:hover, .flex-control-nav li a.icon-play:hover, html.msie .flex-control-nav li a.icon-play:hover', true);
            }
            if (array_key_exists('play_button_active_color', $options) && strlen(trim($options['play_button_active_color'])) != 0) {
                $css_string .= prime_print_color_css($options['play_button_active_color'], 'div#nav > div.nav-controls > a#next:active, .flex-control-nav li a.icon-play:active, html.msie .flex-control-nav li a.icon-play:active', true);
            }

            if (array_key_exists('pause_button_color', $options) && strlen(trim($options['pause_button_color'])) != 0) {
                $css_string .= prime_print_color_css($options['pause_button_color'], 'div#nav > div.nav-controls > a#pause, .flex-control-nav li a.icon-pause, html.msie .flex-control-nav li a.icon-pause', true);
            }
            if (array_key_exists('pause_button_hover_color', $options) && strlen(trim($options['pause_button_hover_color'])) != 0) {
                $css_string .= prime_print_color_css($options['pause_button_hover_color'], 'div#nav > div.nav-controls > a#pause:hover, .flex-control-nav li a.icon-pause:hover, html.msie .flex-control-nav li a.icon-pause:hover', true);
            }
            if (array_key_exists('pause_button_active_color', $options) && strlen(trim($options['pause_button_active_color'])) != 0) {
                $css_string .= prime_print_color_css($options['pause_button_active_color'], 'html.std-selector div#nav > div.nav-controls > a#pause.is-paused, .flex-control-nav li a.icon-pause.is-paused, html.msie div#nav > div.nav-controls > a#pause.is-paused', true);
            }
            if (array_key_exists('pause_button_active_glow_color', $options) && strlen(trim($options['pause_button_active_glow_color'])) != 0) {
                $css_string .= 'html.std-selector div#nav > div.nav-controls > a#pause.is-paused, .flex-control-nav li a.icon-pause.is-paused, html.msie div#nav > div.nav-controls > a#pause.is-paused { text-shadow: 0.1em 0.1em 1em ' . $options['pause_button_active_glow_color'] . ';}';
            }
            if (array_key_exists('paginator_color', $options) && strlen(trim($options['paginator_color'])) != 0) {
                $css_string .= prime_print_background_color_css($options['paginator_color'], '.flex-control-nav li a, div#nav-pager a', true);
            }
            if (array_key_exists('paginator_hover_color', $options) && strlen(trim($options['paginator_hover_color'])) != 0) {
                $css_string .= prime_print_background_color_css($options['paginator_hover_color'], '.flex-control-nav li a:hover, div#nav-pager a:hover', true);
            }
            if (array_key_exists('paginator_current_color', $options) && strlen(trim($options['paginator_current_color'])) != 0) {
                $css_string .= prime_print_background_color_css($options['paginator_current_color'], '.flex-control-nav li a.active, div#nav-pager a.activeSlide', true);
            }
            if (array_key_exists('paginator_background_color', $options) && strlen(trim($options['paginator_background_color'])) != 0) {
                $css_string .= prime_print_background_color_css($options['paginator_background_color'], 'div#nav, div#nav:before, div#nav:after, .flex-control-nav, .flex-control-nav:before, .flex-control-nav:after', true);
                $css_string .= 'div#nav, div#nav:before, div#nav:after, .flex-control-nav, .flex-control-nav:before, .flex-control-nav:after { background:' . $options['paginator_background_color'] . ';}';
            }
            if (array_key_exists('flexslider_caption_background_color', $options) && strlen(trim($options['flexslider_caption_background_color'])) != 0) {
                $css_string .= prime_print_background_color_css($options['flexslider_caption_background_color'], '.flex-caption', true);
            }
            if (array_key_exists('flexslider_caption_text_color', $options) && strlen(trim($options['flexslider_caption_text_color'])) != 0) {
                $css_string .= prime_print_color_css($options['flexslider_caption_text_color'], '.flex-caption > div.caption', true);
            }
            if (array_key_exists('flexslider_subcaption_text_color', $options) && strlen(trim($options['flexslider_subcaption_text_color'])) != 0) {
                $css_string .= prime_print_color_css($options['flexslider_subcaption_text_color'], '.flex-caption > div.subcaption', true);
            }

            // Subheader Colors
            if (array_key_exists('subheader_title_color', $options) && strlen(trim($options['subheader_title_color'])) != 0) {
                $css_string .= prime_print_color_css($options['subheader_title_color'], 'div#subheader > h1', true);
            }
            if (array_key_exists('subheader_subtitle_color', $options) && strlen(trim($options['subheader_subtitle_color'])) != 0) {
                $css_string .= prime_print_color_css($options['subheader_subtitle_color'], 'div#subheader > h2', true);
            }
            if (array_key_exists('subheader_bottom_border_color', $options) && strlen(trim($options['subheader_bottom_border_color'])) != 0) {
                $css_string .= 'div.subheader-wrapper, div.filter-wrapper { border-bottom-color: ' . $options['subheader_bottom_border_color'] . ';}';
            }

            // Page Content Colors
            if (array_key_exists('page_heading_color', $options) && strlen(trim($options['page_heading_color'])) != 0) {
                $css_string .= prime_print_color_css($options['page_heading_color'], 'div.prime-page h1, div.prime-page h2, div.prime-page h3, div.prime-page h4, div.prime-page h5, div.prime-page h6', true);
            }
            if (array_key_exists('page_text_color', $options) && strlen(trim($options['page_text_color'])) != 0) {
                $css_string .= prime_print_color_css($options['page_text_color'], 'div.prime-page, div.prime-page p', true);
            }
            if (array_key_exists('page_link_color', $options) && strlen(trim($options['page_link_color'])) != 0) {
                $css_string .= prime_print_color_css($options['page_link_color'], 'div.prime-page a, div.prime-page a:hover, div.prime-page a:visited', true);
            }
            if (array_key_exists('page_form_glow_color', $options) && strlen(trim($options['page_form_glow_color'])) != 0) {
                $rgb_color = html2rgb($options['page_form_glow_color']);
                $css_string .= 'html.std-selector input:focus, html.std-selector textarea:focus, html.std-selector .search-widget > form.search-form > fieldset.has-focus {
    border-color: rgba(' . $rgb_color[0] . ', ' . $rgb_color[1] . ', ' . $rgb_color[2] . ', 0.8);
    -webkit-box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1), 0 0 8px rgba(' . $rgb_color[0] . ', ' . $rgb_color[1] . ', ' . $rgb_color[2] . ', 0.6);
    -moz-box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1), 0 0 8px rgba(' . $rgb_color[0] . ', ' . $rgb_color[1] . ', ' . $rgb_color[2] . ', 0.6);
    box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1), 0 0 8px rgba(' . $rgb_color[0] . ', ' . $rgb_color[1] . ', ' . $rgb_color[2] . ', 0.6);
}';
            }
            if (array_key_exists('page_image_glow_color', $options) && strlen(trim($options['page_form_glow_color'])) != 0) {
                $css_string .= 'html.no-touch.std-selector a.image-link:hover,  html.std-selector .embed-wrapper:hover {
                    box-shadow: 0 0 4px rgba(0, 0, 0, 0.2), 0 0 20px ' . $options['page_image_glow_color'] . ';}';
            }

            // Shortcode Colors
            if (array_key_exists('divider_color', $options) && strlen(trim($options['divider_color'])) != 0) {
                $css_string .= 'div.divider {border-top-color: ' . $options['divider_color'] . ';}';
            }
            if (array_key_exists('quote_color', $options) && strlen(trim($options['quote_color'])) != 0) {
                $css_string .= prime_print_color_css($options['quote_color'], 'html.std-selector span.pullquote, html.std-selector blockquote, html.std-selector blockquote > p', true);
            }
            if (array_key_exists('blockquote_left_color', $options) && strlen(trim($options['blockquote_left_color'])) != 0) {
                $css_string .= 'blockquote {border-left-color: ' . $options['blockquote_left_color'] . ';}';
            }
            if (array_key_exists('pricing_plan_button_color', $options) && strlen(trim($options['pricing_plan_button_color'])) != 0) {
                $css_string .= prime_print_background_color_css($options['pricing_plan_button_color'], 'html.std-selector div.plan-action > a.btn, html.std-selector div.plan-action > a.btn:hover, html.std-selector div.plan-action > a.btn:visited', true);
            }
            if (array_key_exists('pricing_featured_plan_color', $options) && strlen(trim($options['pricing_featured_plan_color'])) != 0) {
                $css_string .= prime_print_background_color_css($options['pricing_featured_plan_color'], 'html.std-selector div.plan.featured', true);
            }
            if (array_key_exists('recent_posts_divider_color', $options) && strlen(trim($options['recent_posts_divider_color'])) != 0) {
                $css_string .= 'div.recent-posts article.item div.description p.post-date, div.recent-posts-shortcode.vertical div.preview-content p.post-date {border-bottom-color: ' . $options['recent_posts_divider_color'] . ';}';
            }

            // Blog Colors
            if (array_key_exists('category_text_color', $options) && strlen(trim($options['category_text_color'])) != 0) {
                $css_string .= prime_print_color_css($options['category_text_color'], 'html.std-selector body div.recent-posts article.item div.description p.post-meta a,
html.std-selector body div.recent-posts article.item div.description p.post-meta a:visited,
html.std-selector body div.recent-posts-shortcode div.preview-content p.post-meta a,
html.std-selector body div.recent-posts-shortcode div.preview-content p.post-meta a:visited,
html.std-selector body span.categories a, html.std-selector body span.categories a:hover, html.std-selector body span.categories a:visited', true);
            }
            if (array_key_exists('category_background_color', $options) && strlen(trim($options['category_background_color'])) != 0) {
                $css_string .= prime_print_background_color_css($options['category_background_color'], 'html.std-selector body div.recent-posts article.item div.description p.post-meta a,
html.std-selector body div.recent-posts article.item div.description p.post-meta a:visited,
html.std-selector body div.recent-posts-shortcode div.preview-content p.post-meta a,
html.std-selector body div.recent-posts-shortcode div.preview-content p.post-meta a:visited,
html.std-selector body span.categories a, html.std-selector body span.categories a:hover, html.std-selector body span.categories a:visited', true);
            }
            if (array_key_exists('post_meta_separator_color', $options) && strlen(trim($options['post_meta_separator_color'])) != 0) {
                $css_string .= prime_print_color_css($options['post_meta_separator_color'], 'span.spacer', true);
                $css_string .= 'span.spacer {opacity: 1;}';
            }
            if (array_key_exists('comment_background_color', $options) && strlen(trim($options['comment_background_color'])) != 0) {
                $css_string .= prime_print_background_color_css($options['comment_background_color'], '.comment .message', true);
                $css_string .= '.comment .message > .comment-tip { border-right-color: ' . $options['comment_background_color'] . ';}';
            }
            if (array_key_exists('comment_text_color', $options) && strlen(trim($options['comment_text_color'])) != 0) {
                $css_string .= prime_print_color_css($options['comment_text_color'], 'div.message, div.message p, div.message h5', true);
            }
            if (array_key_exists('comment_link_color', $options) && strlen(trim($options['comment_link_color'])) != 0) {
                $css_string .= prime_print_color_css($options['comment_link_color'], 'html.std-selector div.message a, html.std-selector div.message p a, html.std-selector div.message h5 a, html.std-selector div.message h5 time > a, .comment .message h5 a, .comment.author .message h5 a:visited, .comment .message a.comment-reply-link, .comment .message a.comment-reply-link:visited, .comment .message a.comment-reply-link:hover', true);
            }

            // Portfolio Colors
            if (array_key_exists('portfolio_filter_color', $options) && strlen(trim($options['portfolio_filter_color'])) != 0) {
                $css_string .= prime_print_color_css($options['portfolio_filter_color'], 'html.std-selector ul#filters li', true);
            }
            if (array_key_exists('portfolio_filter_hover_color', $options) && strlen(trim($options['portfolio_filter_hover_color'])) != 0) {
                $css_string .= prime_print_color_css($options['portfolio_filter_hover_color'], 'html.std-selector ul#filters li div:hover', true);
            }
            if (array_key_exists('portfolio_filter_active_color', $options) && strlen(trim($options['portfolio_filter_active_color'])) != 0) {
                $css_string .= prime_print_color_css($options['portfolio_filter_active_color'], 'html.std-selector ul#filters li div.current ', true);
            }

            // Footer Colors
            if (array_key_exists('footer_heading_color', $options) && strlen(trim($options['footer_heading_color'])) != 0) {
                $css_string .= prime_print_color_css($options['footer_heading_color'], 'footer h3', true);
            }
            if (array_key_exists('footer_text_color', $options) && strlen(trim($options['footer_text_color'])) != 0) {
                $css_string .= prime_print_color_css($options['footer_text_color'], 'footer, footer p, footer .widget p', true);
            }
            if (array_key_exists('footer_link_color', $options) && strlen(trim($options['footer_link_color'])) != 0) {
                $css_string .= prime_print_color_css($options['footer_link_color'], 'html.std-selector body footer a, html.std-selector body footer p a, html.std-selector body footer .widget p a, html.std-selector body footer a:hover, html.std-selector body footer p a:hover, html.std-selector body footer .widget p a:hover, html.std-selector body footer a:active, html.std-selector body footer p a:active, html.std-selector body footer .widget p a:active, html.std-selector body footer a:visited, html.std-selector body footer p a:visited, html.std-selector body footer .widget p a:visited', true);
            }
            if (array_key_exists('subfooter_text_color', $options) && strlen(trim($options['subfooter_text_color'])) != 0) {
                $css_string .= prime_print_color_css($options['subfooter_text_color'], '.subfooter', true);
            }
            if (array_key_exists('subfooter_link_color', $options) && strlen(trim($options['subfooter_link_color'])) != 0) {
                $css_string .= prime_print_color_css($options['subfooter_link_color'], 'html.std-selector div.subfooter a, html.std-selector div.subfooter a:hover, html.std-selector div.subfooter a:visited, html.std-selector div.subfooter a:active', true);
            }

            // Sidebar Colors
            if (array_key_exists('sidebar_heading_color', $options) && strlen(trim($options['sidebar_heading_color'])) != 0) {
                $css_string .= prime_print_color_css($options['sidebar_heading_color'], 'div#sidebar > article > div.sidebar-widget > h3', true);
            }
            if (array_key_exists('sidebar_text_color', $options) && strlen(trim($options['sidebar_text_color'])) != 0) {
                $css_string .= prime_print_color_css($options['sidebar_text_color'], 'div#sidebar, div#sidebar p, div#sidebar .widget p', true);
            }
            if (array_key_exists('sidebar_link_color', $options) && strlen(trim($options['sidebar_link_color'])) != 0) {
                $css_string .= prime_print_color_css($options['sidebar_link_color'], 'html.std-selector body div#sidebar a, html.std-selector body div#sidebar p a, html.std-selector body div#sidebar .widget p a, html.std-selector body div#sidebar a:hover, html.std-selector body div#sidebar p a:hover, html.std-selector body div#sidebar .widget p a:hover, html.std-selector body div#sidebar a:active, html.std-selector body div#sidebar p a:active, html.std-selector body div#sidebar .widget p a:active, html.std-selector body div#sidebar a:visited, html.std-selector body div#sidebar p a:visited, html.std-selector body div#sidebar .widget p a:visited', true);
            }

        }

        echo '<style type="text/css">' . $css_string . '</style>';


        // Insert font stack
        if (array_key_exists('font_stack', $options)) {
            ?>
        <style type="text/css">
            div[role="document"] {
                font-family: <?php echo $options['font_stack']; ?>;
            }
        </style>
        <?php
        }

        // Insert font size
        if (array_key_exists('font_size', $options)) {
            ?>
        <style type="text/css">
            div[role="document"] {
                font-size: <?php echo $options['font_size']; ?>px;
            }
        </style>
        <?php
        }

        // Insert Custom CSS
        if (array_key_exists('custom_css_code', $options)) {
            echo '<style type="text/css" media="screen">';
            echo(stripslashes($options['custom_css_code']));
            echo '</style>';
        }

    }


    function enqueue_media()
    {
        wp_enqueue_script('underscore');
        ?>
    <script defer src="<?php echo get_template_directory_uri(); ?>/js/libs/jquery.prettyphoto.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/libs/spin.min.js"></script>
    <script defer src="<?php echo get_template_directory_uri(); ?>/js/plugins.js"></script>

    <script defer src="<?php echo get_template_directory_uri(); ?>/js/prime-plugin-base.js"></script>
    <script defer src="<?php echo get_template_directory_uri(); ?>/js/prime-plugins.js"></script>
    <script defer src="<?php echo get_template_directory_uri(); ?>/js/script.js"></script>

    <?php
        // $gmap_api_key = get_prime_options('google_maps_api_key');
        // $gmap_api_key = empty($gmap_api_key) ? NULL : $gmap_api_key;
        // if (!empty($gmap_api_key)) { 
        // }

        $this->writeout_js_global_vars(); ?>

    <link href="<?php echo get_template_directory_uri(); ?>/css/prettyphoto/css/prettyphoto.css" type="text/css"
          rel="stylesheet">


    <?php
        $font_links = get_prime_options('google_font_links');
        echo $font_links;

        ?>

    <?php if(!is_child_theme()) { ?>
        <link type="text/css" rel="stylesheet" href="<?php echo PRIME_THEME_ROOT_URI; ?>/style.css">
        <link type="text/css" rel="stylesheet" href="<?php echo PRIME_THEME_ROOT_URI; ?>/responsive.css">
        <link type="text/css" rel="stylesheet" href="<?php echo PRIME_THEME_ROOT_URI; ?>/css/fonts.css">
        <link type="text/css" rel="stylesheet" href="<?php echo PRIME_THEME_ROOT_URI; ?>/css/print.css">
        <link type="text/css" rel="stylesheet" href="<?php echo PRIME_THEME_ROOT_URI; ?>/css/animate.css">
    <?php } ?>

    <style type="text/css" media="screen">
            /* Header Logo */

            <?php
            $desktop_logo_width = get_prime_options('logo_img_width');
            $desktop_logo_height = get_prime_options('logo_img_height');
            $desktop_logo_url = get_prime_options('logo_img');
            $desktop_logo_url_hires = get_prime_options('logo_img_hires');
            if (strlen(trim($desktop_logo_url_hires)) == 0)
                $desktop_logo_url_hires = $desktop_logo_url;
            ?>
        header div.logo > a, .ie8 header div.logo > a {
            width: <?php echo $desktop_logo_width; ?>px;
            height: <?php echo $desktop_logo_height; ?>px;
            background: transparent url(<?php echo $desktop_logo_url ?>) center center no-repeat;
        }

        @media only screen and (-webkit-min-device-pixel-ratio: 1.5) {
            header div.logo > a, .ie8 header div.logo > a {
                background-image: url(<?php echo $desktop_logo_url_hires; ?>);
                background-size: <?php echo $desktop_logo_width; ?>px <?php echo $desktop_logo_height; ?>px;
            }
        }

            <?php
            $mobile_logo_width = get_prime_options('mobile_logo_img_width');
            $mobile_logo_height = get_prime_options('mobile_logo_img_height');
            $mobile_logo_url = get_prime_options('mobile_logo_img');
            $mobile_logo_url_hires = get_prime_options('mobile_logo_img_hires');
            if (strlen(trim($mobile_logo_url_hires)) == 0)
                $mobile_logo_url_hires = $mobile_logo_url;
            ?>

        @media screen and (max-width: 767px) {
            header div.logo > a {
                width: <?php echo $mobile_logo_width; ?>px;
                height: <?php echo $mobile_logo_height; ?>px;
                background-image: url(<?php echo $mobile_logo_url; ?>);
            }
        }

        @media only screen and (-webkit-min-device-pixel-ratio: 1.5) and (max-width: 767px) {
            header div.logo > a {
                background-image: url(<?php echo $mobile_logo_url_hires; ?>);
                background-size: <?php echo $mobile_logo_width; ?>px <?php echo $mobile_logo_height; ?>px;
            }
        }

    </style>
    <?php

    }

    function render_breadcrumbs()
    {
        if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
        }
    }


    /**
     * Title and Subtitle Helper methods
     */

    /** A helper method that echos the provided title and subtitl in spans and injects a separator between the
     * two. The separator is retrieved via get_option_tree('title_subtitle_separator').
     * @param $title
     * @param $subtitle
     * @return void
     */
    function print_prime_title_and_subtitle($title, $subtitle)
    {
        $sep = get_prime_options('title_subtitle_separator');
        $title = empty($subtitle) ? $title : ($title . $sep);
        ?>
    <h1><?php echo $title; ?></h1>
    <h2><?php echo $subtitle; ?></h2>
    <?php

    }

    /**
     * Echos the title retrieved withe get_post_title() and the subtitle
     * from the post meta subtitle field
     * @return string
     */
    function prime_title_and_subtitle()
    {
        global $post;

        if (is_home() && is_front_page()) {
            //This means that it's a Blog on the Front Page
            $title = get_prime_options('front_page_blog_title');
            $subtitle = get_prime_options('front_page_blog_subtitle');
        }
        else {
            //a blog specified onto a page
            $pid = is_home() ? get_option('page_for_posts') : $post->ID;
            $title = get_the_title($pid);
            $subtitle = get_post_meta($pid, '_prime_subtitle', true);
        }

        $this->print_prime_title_and_subtitle($title, $subtitle);
    }

    /**
     * Echos the blog title and subtitle in spans. Contains logic in order to
     * retrieve the title and subtitle from the static page is Reading Settings
     * are set to a page. Otherwise, it uses the 'front_page_blog_title'
     * and 'front_page_blog_subtitle' options defined through the options framework
     * @return void
     */
    function prime_blog_title_and_subtitle($title = null)
    {
        $latest_posts_home = get_option('show_on_front') == 'posts' ? true : false;
        if ($latest_posts_home) {
            //This means that it's a Blog on the Front Page
            $title = get_prime_options('front_page_blog_title');
            $subtitle = get_prime_options('front_page_blog_subtitle');
        }
        else {
            $pid = get_option('page_for_posts');
            $title = get_the_title($pid);
            $subtitle = get_post_meta($pid, '_prime_subtitle', true);
        }

        $this->print_prime_title_and_subtitle($title, $subtitle);
    }

    /**
     * Comments
     */
    function render_comments()
    {
        global $FRONTEND_STRINGS;
        ?>
    <div class="divider shortcode-divider"></div>
    <section id="comments">

        <div class="comments">
            <h3 class="comments-title"><?php comments_number($FRONTEND_STRINGS['no_comments'], $FRONTEND_STRINGS['one_comment'], $FRONTEND_STRINGS['x_comments']); ?>
                .</h3>

            <?php wp_list_comments('type=comment&callback=prime_comments'); ?>
            <?php // wp_list_comments(); ?>
        </div>
        <div>
            <nav id="comments-nav">
                <div
                    class="comments-previous"><?php previous_comments_link($FRONTEND_STRINGS['older_comments']); ?></div>
                <div class="comments-next"><?php next_comments_link($FRONTEND_STRINGS['newer_comments']); ?></div>
            </nav>
        </div>
    </section>
    <?php

    }

    function render_comments_closed()
    {
        global $FRONTEND_STRINGS;
        ?>
    <section id="comments">
        <div class="notice">
            <p class="bottom"><?php echo $FRONTEND_STRINGS['comments_closed'] ?></p>
        </div>
    </section>
    <?php

    }

    function render_comments_password_required()
    {
        global $FRONTEND_STRINGS;
        ?>
    <section id="comments">
        <div class="notice">
            <p class="bottom"><?php echo $FRONTEND_STRINGS['password_protected'] ?></p>
        </div>
    </section>
    <?php

    }

    function render_comment_form($user_identity, $req, $comment_author, $comment_author_email, $comment_author_url)
    {
        global $post;
        global $FRONTEND_STRINGS;
        ?>
    <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform"
          class="comment-form">
        <fieldset>
            <?php if (is_user_logged_in()) : ?>
            <p class="login-info"><?php printf($FRONTEND_STRINGS['please_post'], get_option('siteurl'), $user_identity); ?>
            </p>
            <?php else : ?>

            <div class="comment-info">
                <label
                    for="author"><?php echo $FRONTEND_STRINGS['your_name']; if ($req) echo $FRONTEND_STRINGS['required_star']; ?></label>
                <input type="text" class="text" name="author" id="author"
                       value="<?php echo esc_attr($comment_author); ?>" size="22"
                       tabindex="1" <?php if ($req) echo "aria-required='true'"; ?>>

                <label
                    for="email"><?php echo $FRONTEND_STRINGS['your_email']; if ($req) echo $FRONTEND_STRINGS['required_star']; ?></label>
                <input type="email" class="text" name="email" id="email"
                       value="<?php echo esc_attr($comment_author_email); ?>" size="22"
                       tabindex="2" <?php if ($req) echo "aria-required='true'"; ?>>

                <label for="url"><?php echo $FRONTEND_STRINGS['your_website']; ?></label>
                <input type="url" class="text" name="url" id="url"
                       value="<?php echo esc_attr($comment_author_url); ?>"
                       size="22" tabindex="3">
            </div>
            <?php endif; ?>
            <div class="comment-message">
                <label for="comment"><?php echo $FRONTEND_STRINGS['comment'] ?></label>
                <textarea name="comment" id="comment" tabindex="4"></textarea>
            </div>

            <input name="submit" class="btn default" type="submit" id="submit" tabindex="5"
                   value="<?php echo $FRONTEND_STRINGS['post_comment']  ?>">

            <?php comment_id_fields(); ?>
            <?php do_action('comment_form', $post->ID); ?>
        </fieldset>
    </form>
    <div class="hidden"><?php comment_form(); ?></div>
    <?php

    }

    function slider_classes()
    {
        if (is_home() && is_front_page()) {
            //frontpage blog page. Get slider vals from
            $slider_type = get_prime_options('_prime_slider_type');
        }
        else {
            global $post;
            $pid = is_home() ? get_option('page_for_posts') : $post->ID;

            $slider_type = get_post_meta($pid, '_prime_slider_type', true);
        }

        echo $slider_type;

    }

    /**
     * Renders the header slider
     */
    function render_prime_intro_slider()
    {
        if (is_home() && is_front_page()) {
            //frontpage blog page. Get slider vals from
            $slider_type = get_prime_options('_prime_slider_type');
        }
        else {
            global $post;
            $pid = is_home() ? get_option('page_for_posts') : $post->ID;

            $slider_type = get_post_meta($pid, '_prime_slider_type', true);
        }

        $slider_helper = NULL;

        switch ($slider_type) {
            case 'flex_slider':
                global $prime_flex_slider;
                $slider_helper = $prime_flex_slider;
                break;
            case 'content_slider':
                global $prime_content_slider;
                $slider_helper = $prime_content_slider;
                break;
            case 'cp_slider':
                global $prime_cp_slider;
                $slider_helper = $prime_cp_slider;
                break;
        }
        if ($slider_helper)
            $slider_helper->render_page_slider();
    }
}

function prime_comments($comment, $args, $depth)
{
    global $FRONTEND_STRINGS;
    $GLOBALS['comment'] = $comment;
    $comment_class = $comment->comment_author_email == get_the_author_meta('email') ? 'author' : '';

    ?>
<div <?php comment_class($comment_class);?> id="comment-<?php comment_ID(); ?>">
    <?php echo get_avatar($comment, $size = '53'); ?>

    <div class="message-wrap">
        <div class="message">
            <div class="comment-tip"></div>
            <h5><?php comment_author_link(); ?> &#8212;
                <time datetime="<?php echo comment_date('c') ?>"><a
                    href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)) ?>"><?php echo comment_date('F j, Y @ g:i a') ?></a>
                </time>
                <?php edit_comment_link($FRONTEND_STRINGS['edit'], '', '') ?>
            </h5>

            <?php if ($comment->comment_approved == '0') : ?>
            <div class="notice">
                <p class="bottom"><?php echo $FRONTEND_STRINGS['comment_awaiting_mod']; ?></p>
            </div>
            <?php endif; ?>

            <p><?php comment_text(); ?></p>
            <?php comment_reply_link(array_merge($args, array('reply_text' => $FRONTEND_STRINGS['comment_reply'], 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
        </div>
    </div>
    <div class="clear"></div>
</div>
<?php } ?>